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
            
            // Always close the menu first
            header.removeClass('nav-open');
            toggle.attr('aria-expanded', 'false');
            toggle.removeClass('active');
            
            // Only handle internal links (not external or special links)
            if (href && href.startsWith('#') && href.length > 1) {
                e.preventDefault();
                
                const targetId = href.substring(1);
                const targetElement = $('#' + targetId);
                
                if (targetElement.length) {
                    // Small delay to ensure menu is closed before scrolling
                    setTimeout(function() {
                        // Calculate proper offset accounting for header only (menu is now closed)
                        const headerHeight = header.outerHeight();
                        const totalOffset = headerHeight + 60; // 60px extra padding for breathing room
                        const targetOffset = targetElement.offset().top - totalOffset;
                        
                        // Smooth scroll to target with proper offset
                        $('html, body').animate({
                            scrollTop: targetOffset
                        }, 800, 'easeOutCubic');
                    }, 100); // 100ms delay
                }
            }
        });
    }



    /**
     * Scroll Animations
     */
    function initScrollAnimations() {
        function checkScrollAnimations() {
            const elements = $('.fade-in-up, .fade-in-left, .fade-in-right');
            
            elements.each(function() {
                const element = $(this);
                const elementTop = element.offset().top;
                const elementVisible = 150;
                
                if (elementTop < $(window).scrollTop() + $(window).height() - elementVisible) {
                    element.addClass('visible');
                }
            });
        }
        
        // Check animations on scroll and load
        $(window).on('scroll', checkScrollAnimations);
        $(window).on('load', checkScrollAnimations);
        
        // Initial check
        checkScrollAnimations();
    }

    /**
     * Preloader
     */
    function initPreloader() {
        function hidePreloader() {
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
        
        // Fallback: hide preloader after 2 seconds max
        setTimeout(hidePreloader, 2000);
        
        // Additional fallback: hide on DOM ready
        $(document).ready(function() {
            setTimeout(hidePreloader, 1000);
        });
    }

    /**
     * Hero Carousel and Parallax
     */
    function initHero() {
        const heroBgs = $('.hero-bg');
        const heroContent = $('.hero .inner');
        let currentBg = 0;
        
        function nextBg() {
            heroBgs.eq(currentBg).removeClass('active');
            currentBg = (currentBg + 1) % heroBgs.length;
            heroBgs.eq(currentBg).addClass('active');
        }
        
        // Parallax effect on scroll
        function updateParallax() {
            const scrolled = window.pageYOffset;
            const heroHeight = $('.hero').outerHeight();
            const maxScroll = heroHeight * 0.8; // Limit parallax to 80% of hero height
            
            if (scrolled <= maxScroll) {
                const rate = scrolled * -0.3; // Reduced movement rate
                const contentRate = scrolled * 0.2;
                
                // Move background images slower (creates parallax effect)
                heroBgs.each(function() {
                    $(this).css('transform', `translateZ(-100px) scale(1.2) translateY(${rate}px)`);
                });
                
                // Move content slightly faster
                if (heroContent.length) {
                    heroContent.css('transform', `translateZ(50px) translateY(${contentRate}px)`);
                }
            }
        }
        
        // Change image every 5 seconds
        setInterval(nextBg, 5000);
        
        // Add scroll listener for parallax
        $(window).on('scroll', updateParallax);
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
     * Smooth Scrolling for Anchor Links
     */
    $('a[href^="#"]').on('click', function(e) {
        const target = $(this.getAttribute('href'));
        
        if (target.length) {
            e.preventDefault();
            
            $('html, body').animate({
                scrollTop: target.offset().top - 80 // Account for fixed header
            }, 800);
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

    // Apply debouncing to scroll events
    const debouncedScroll = debounce(function() {
        checkScrollAnimations();
        updateParallax();
    }, 10);

    $(window).on('scroll', debouncedScroll);

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