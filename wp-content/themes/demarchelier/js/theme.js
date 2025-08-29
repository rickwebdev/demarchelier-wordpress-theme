/**
 * Demarchelier Bistro Theme JavaScript
 * 
 * @package Demarchelier
 */

(function($) {
    'use strict';

    // Custom easing function for smooth scrolling
    $.easing.easeOutCubic = function (x, t, b, c, d) {
        return c * ((t = t/d - 1) * t * t + 1) + b;
    };

    // DOM ready
    $(document).ready(function() {
        initMobileNav();
        initHero();
        initAboutCarousel();
        initScrollAnimations();
        initPreloader();
        initContactForm();
    });

    /**
     * Mobile Navigation Toggle
     */
    function initMobileNav() {
        const toggle = $('.menu-toggle');
        const header = $('.site-header');
        
        toggle.on('click', function() {
            const open = header.toggleClass('nav-open').hasClass('nav-open');
            toggle.attr('aria-expanded', open ? 'true' : 'false');
            toggle.toggleClass('active');
        });

        // Enhanced mobile navigation link handling with better event delegation
        $(document).on('click', '.nav-open #primary-nav a, .nav-open nav a', function(e) {
            const href = $(this).attr('href');
            
            // Only handle internal links (not external or special links)
            if (href && href.startsWith('#') && href.length > 1) {
                e.preventDefault();
                
                const targetId = href.substring(1);
                const targetElement = $('#' + targetId);
                
                if (targetElement.length) {
                    // Close menu immediately without delay
                    header.removeClass('nav-open');
                    toggle.attr('aria-expanded', 'false');
                    toggle.removeClass('active');
                    
                    // Calculate proper offset accounting for header only (menu is now closed)
                    const headerHeight = header.outerHeight();
                    const totalOffset = headerHeight + 40; // Reduced padding for faster feel
                    const targetOffset = targetElement.offset().top - totalOffset;
                    
                    // Faster smooth scroll to target with proper offset
                    $('html, body').animate({
                        scrollTop: targetOffset
                    }, 400, 'easeOutCubic'); // Reduced from 800ms to 400ms
                }
            } else {
                // For external links, just close the menu
                header.removeClass('nav-open');
                toggle.attr('aria-expanded', 'false');
                toggle.removeClass('active');
            }
        });
    }



    /**
     * Scroll Animations
     */
    function initScrollAnimations() {
        let animationElements = [];
        let windowHeight = $(window).height();
        
        function initAnimationElements() {
            animationElements = $('.fade-in-up, .fade-in-left, .fade-in-right').map(function() {
                return {
                    element: $(this),
                    top: $(this).offset().top,
                    visible: 150
                };
            }).get();
        }
        
        window.checkScrollAnimations = function() {
            const scrollTop = $(window).scrollTop();
            const triggerPoint = scrollTop + windowHeight - 150;
            
            animationElements.forEach(function(item) {
                if (item.top < triggerPoint && !item.element.hasClass('visible')) {
                    item.element.addClass('visible');
                }
            });
        };
        
        // Initialize elements on load
        $(window).on('load', function() {
            initAnimationElements();
            window.checkScrollAnimations();
        });
        
        // Recalculate on resize
        $(window).on('resize', debounce(function() {
            windowHeight = $(window).height();
            initAnimationElements();
        }, 250));
        
        // Initial check
        initAnimationElements();
        window.checkScrollAnimations();
    }

    /**
     * Preloader
     */
    function initPreloader() {
        let preloaderHidden = false;
        
        function hidePreloader() {
            if (preloaderHidden) return; // Prevent multiple calls
            preloaderHidden = true;
            
            const preloader = $('#preloader');
            if (preloader.length) {
                preloader.addClass('hidden');
                setTimeout(function() {
                    preloader.hide();
                }, 500);
            }
        }
        
        // Hide preloader immediately if document is already loaded
        if (document.readyState === 'complete') {
            hidePreloader();
            return;
        }
        
        // Wait for everything to load
        $(window).on('load', function() {
            hidePreloader();
        });
        
        // Fallback: hide preloader after 1.5 seconds max (reduced from 2s)
        setTimeout(hidePreloader, 1500);
        
        // Additional fallback: hide on DOM ready with shorter delay
        $(document).ready(function() {
            setTimeout(hidePreloader, 500); // Reduced from 1000ms
        });
        
        // Emergency fallback: hide after 3 seconds no matter what
        setTimeout(function() {
            if (!preloaderHidden) {
                const preloader = $('#preloader');
                if (preloader.length) {
                    preloader.remove(); // Force remove if still stuck
                }
            }
        }, 3000);
    }

    /**
     * Hero Carousel and Parallax
     */
    function initHero() {
        const heroBgs = $('.hero-bg');
        const heroContent = $('.hero .inner');
        let currentBg = 0;
        let heroHeight = $('.hero').outerHeight();
        let ticking = false;
        
        function nextBg() {
            heroBgs.eq(currentBg).removeClass('active');
            currentBg = (currentBg + 1) % heroBgs.length;
            heroBgs.eq(currentBg).addClass('active');
        }
        
        // Parallax effect on scroll
        window.updateParallax = function() {
            if (!ticking) {
                requestAnimationFrame(function() {
                    const scrolled = window.pageYOffset;
                    const maxScroll = heroHeight * 0.8; // Limit parallax to 80% of hero height
                    
                    if (scrolled <= maxScroll) {
                        const rate = scrolled * -0.3; // Reduced movement rate
                        
                        // Move background images slower (creates parallax effect)
                        heroBgs.each(function() {
                            $(this).css('transform', `translateZ(-100px) scale(1.2) translateY(${rate}px)`);
                        });
                        
                        // Keep hero content stable - let CSS handle all positioning
                        // No JavaScript transform manipulation to prevent jumping
                    }
                    ticking = false;
                });
                ticking = true;
            }
        };
        
        // Change image every 5 seconds
        setInterval(nextBg, 5000);
        
        // Update hero height on resize
        $(window).on('resize', debounce(function() {
            heroHeight = $('.hero').outerHeight();
        }, 250));
    }

    /**
     * About Carousel
     */
    function initAboutCarousel() {
        const aboutImages = $('.about-carousel-image');
        const indicators = $('.about-carousel-indicator');
        
        if (aboutImages.length <= 1) {
            return; // No carousel needed if only one image
        }
        
        let currentImage = 0;
        let autoPlayInterval;
        
        function showImage(index) {
            aboutImages.removeClass('active');
            indicators.removeClass('active');
            aboutImages.eq(index).addClass('active');
            indicators.eq(index).addClass('active');
            currentImage = index;
        }
        
        function nextImage() {
            const nextIndex = (currentImage + 1) % aboutImages.length;
            showImage(nextIndex);
        }
        
        // Handle indicator clicks
        indicators.on('click', function() {
            const index = $(this).data('index');
            showImage(index);
            
            // Reset autoplay timer
            clearInterval(autoPlayInterval);
            autoPlayInterval = setInterval(nextImage, 4000);
        });
        
        // Pause autoplay on hover
        $('.about-carousel').hover(
            function() { clearInterval(autoPlayInterval); },
            function() { autoPlayInterval = setInterval(nextImage, 4000); }
        );
        
        // Start autoplay
        autoPlayInterval = setInterval(nextImage, 4000);
    }

    /**
     * Contact Form Handling
     */
    function initContactForm() {
        $('#contact-form').on('submit', function(e) {
            e.preventDefault();
            
            const form = $(this);
            const submitBtn = form.find('button[type="submit"]');
            const originalText = submitBtn.text();
            
            // Get form data
            const formData = {
                action: 'contact_form',
                nonce: demarchelier_ajax.nonce,
                fullname: form.find('#fullname').val(),
                email: form.find('#email').val(),
                subject: form.find('#subject').val(),
                comment: form.find('#comment').val()
            };
            
            // Show loading state
            submitBtn.text('Sending...').prop('disabled', true);
            
            // Send AJAX request
            $.ajax({
                url: demarchelier_ajax.ajax_url,
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        showMessage('Message sent successfully!', 'success');
                        form[0].reset();
                    } else {
                        showMessage(response.data || 'Failed to send message. Please try again.', 'error');
                    }
                },
                error: function() {
                    showMessage('An error occurred. Please try again.', 'error');
                },
                complete: function() {
                    submitBtn.text(originalText).prop('disabled', false);
                }
            });
        });
    }

    /**
     * Show Message
     */
    function showMessage(message, type) {
        const messageClass = type === 'success' ? 'success' : 'error';
        const messageHtml = `<div class="form-message ${messageClass}">${message}</div>`;
        
        // Remove existing messages
        $('.form-message').remove();
        
        // Add new message
        $('#contact-form').before(messageHtml);
        
        // Auto remove after 5 seconds
        setTimeout(function() {
            $('.form-message').fadeOut(function() {
                $(this).remove();
            });
        }, 5000);
    }

    /**
     * Smooth Scrolling for Anchor Links (excluding mobile nav links which are handled separately)
     */
    $(document).on('click', 'a[href^="#"]', function(e) {
        // Skip if this is a mobile nav link (handled by initMobileNav)
        if ($(this).closest('.nav-open').length) {
            return;
        }
        
        const target = $(this.getAttribute('href'));
        
        if (target.length) {
            e.preventDefault();
            
            const headerHeight = $('.site-header').outerHeight();
            const targetOffset = target.offset().top - headerHeight - 20;
            
            $('html, body').animate({
                scrollTop: targetOffset
            }, 400, 'easeOutCubic'); // Faster animation
        }
    });

    /**
     * Lazy Loading for Images
     */
    function initLazyLoading() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(function(img) {
                imageObserver.observe(img);
            });
        }
    }

    // Initialize lazy loading
    initLazyLoading();

    /**
     * Accessibility Enhancements
     */
    
    // Skip link functionality
    $('.skip-link').on('click', function(e) {
        const target = $($(this).attr('href'));
        if (target.length) {
            e.preventDefault();
            target.focus();
        }
    });

    // Keyboard navigation for mobile menu
    $('.menu-toggle').on('keydown', function(e) {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            $(this).click();
        }
    });

    /**
     * Performance Optimizations
     */
    
    // Debounce scroll events
    function debounce(func, wait, immediate) {
        let timeout;
        return function() {
            const context = this, args = arguments;
            const later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            const callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }

    // Apply throttling to scroll events with requestAnimationFrame
    let scrollTicking = false;
    
    function handleScroll() {
        if (!scrollTicking) {
            requestAnimationFrame(function() {
                if (window.checkScrollAnimations) window.checkScrollAnimations();
                if (window.updateParallax) window.updateParallax();
                scrollTicking = false;
            });
            scrollTicking = true;
        }
    }
    
    $(window).on('scroll', handleScroll);

    /**
     * SEO and Analytics
     */
    
    // Track outbound links
    $('a[href^="http"]').on('click', function() {
        const href = $(this).attr('href');
        if (href.indexOf(window.location.hostname) === -1) {
            // Track outbound link (if analytics is set up)
            if (typeof gtag !== 'undefined') {
                gtag('event', 'click', {
                    'event_category': 'outbound',
                    'event_label': href
                });
            }
        }
    });

    // Track form submissions
    $('#contact-form').on('submit', function() {
        if (typeof gtag !== 'undefined') {
            gtag('event', 'form_submit', {
                'event_category': 'engagement',
                'event_label': 'contact_form'
            });
        }
    });

})(jQuery); 