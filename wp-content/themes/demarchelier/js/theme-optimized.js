/**
 * Demarchelier Bistro Theme JavaScript - Optimized for Mobile Performance
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
        initIntersectionObserver();
        initContactForm();
        initLazyLoading();
        initAccessibility();
        initPreloader();
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
     * Intersection Observer for Scroll Animations - Replaces scroll event listeners
     */
    function initIntersectionObserver() {
        if (!('IntersectionObserver' in window)) {
            // Fallback for older browsers
            initFallbackScrollAnimations();
            return;
        }

        // Create reusable IntersectionObserver for animations
        const animationObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    // Add a small delay to make animations more noticeable
                    setTimeout(function() {
                        entry.target.classList.add('is-visible');
                    }, 100);
                    // Unobserve after animation is triggered
                    animationObserver.unobserve(entry.target);
                }
            });
        }, {
            rootMargin: '20px 0px', // Reduced further for more precise triggering
            threshold: 0.2 // Increased threshold for more reliable triggering
        });

        // Observe all animation elements
        const animationElements = document.querySelectorAll('.fade-in-up, .fade-in-left, .fade-in-right');
        animationElements.forEach(function(element) {
            animationObserver.observe(element);
        });

        // Create separate observer for parallax effects
        const parallaxObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('parallax-active');
                } else {
                    entry.target.classList.remove('parallax-active');
                }
            });
        }, {
            rootMargin: '50px 0px',
            threshold: 0
        });

        // Observe hero section for parallax
        const heroSection = document.querySelector('.hero');
        if (heroSection) {
            parallaxObserver.observe(heroSection);
        }
    }

    /**
     * Fallback scroll animations for older browsers
     */
    function initFallbackScrollAnimations() {
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
        
        function checkScrollAnimations() {
            const scrollTop = $(window).scrollTop();
            const triggerPoint = scrollTop + windowHeight - 100; // Reduced trigger point
            
            animationElements.forEach(function(item) {
                if (item.top < triggerPoint && !item.element.hasClass('visible')) {
                    // Add small delay for fallback animations too
                    setTimeout(function() {
                        item.element.addClass('visible');
                    }, 100);
                }
            });
        }
        
        // Initialize elements on load
        $(window).on('load', function() {
            initAnimationElements();
            checkScrollAnimations();
        });
        
        // Recalculate on resize
        $(window).on('resize', debounce(function() {
            windowHeight = $(window).height();
            initAnimationElements();
        }, 250));
        
        // Initial check
        initAnimationElements();
        checkScrollAnimations();
        
        // Throttled scroll handler
        let scrollTicking = false;
        $(window).on('scroll', function() {
            if (!scrollTicking) {
                requestAnimationFrame(function() {
                    checkScrollAnimations();
                    scrollTicking = false;
                });
                scrollTicking = true;
            }
        });
    }

    /**
     * Hero Carousel and Parallax - Optimized
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
        
        // Optimized parallax effect using CSS transforms only
        function updateParallax() {
            if (!ticking) {
                requestAnimationFrame(function() {
                    const scrolled = window.pageYOffset;
                    const maxScroll = heroHeight * 0.8; // Limit parallax to 80% of hero height
                    
                    if (scrolled <= maxScroll) {
                        const bgRate = scrolled * -0.3; // Background moves slower
                        
                        // Move background images slower (creates parallax effect)
                        heroBgs.each(function() {
                            $(this).css('transform', `translateZ(-100px) scale(1.2) translateY(${bgRate}px)`);
                        });
                        
                        // Keep hero content completely static (no text parallax)
                        // No transform changes needed - CSS handles the static positioning
                    }
                    ticking = false;
                });
                ticking = true;
            }
        }
        
        // Change image every 5 seconds
        setInterval(nextBg, 5000);
        
        // Update hero height on resize
        $(window).on('resize', debounce(function() {
            heroHeight = $('.hero').outerHeight();
        }, 250));
        
        // Throttled scroll handler for parallax
        let parallaxTicking = false;
        $(window).on('scroll', function() {
            if (!parallaxTicking) {
                requestAnimationFrame(function() {
                    updateParallax();
                    parallaxTicking = false;
                });
                parallaxTicking = true;
            }
        });
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
     * Lazy Loading for Images with IntersectionObserver
     */
    function initLazyLoading() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.classList.remove('lazy');
                            imageObserver.unobserve(img);
                        }
                    }
                });
            }, {
                rootMargin: '300px 0px', // Keep 300px for image preloading (this is good for performance)
                threshold: 0.1
            });

            document.querySelectorAll('img[data-src]').forEach(function(img) {
                imageObserver.observe(img);
            });
        }
    }

    /**
     * Preloader - Wait for hero images to load
     */
    function initPreloader() {
        let preloaderHidden = false;
        let heroImagesLoaded = 0;
        let totalHeroImages = 0;
        
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
        
        function updateProgressText(loaded, total) {
            const progressText = document.getElementById('progress-text');
            
            if (progressText) {
                if (loaded === 0) {
                    progressText.textContent = 'Loading...';
                } else if (loaded < total) {
                    progressText.textContent = `Loading... ${loaded}/${total}`;
                } else {
                    progressText.textContent = 'Finalizing...';
                }
            }
        }
        
        function checkHeroImagesLoaded() {
            heroImagesLoaded++;
            console.log(`Hero image ${heroImagesLoaded}/${totalHeroImages} loaded`);
            
            // Update progress text
            updateProgressText(heroImagesLoaded, totalHeroImages);
            
            // Hide preloader when all hero images are loaded
            if (heroImagesLoaded >= totalHeroImages && totalHeroImages > 0) {
                console.log('All hero images loaded, waiting for first image to be visible...');
                
                // Update progress text
                updateProgressText(heroImagesLoaded, totalHeroImages);
                
                // Wait for the first hero image to be fully visible before hiding preloader
                const firstHeroBg = document.querySelector('.hero-bg.active');
                if (firstHeroBg) {
                    // Wait for the fade-in transition to complete
                    setTimeout(function() {
                        // Double-check that the image is actually visible
                        const computedStyle = window.getComputedStyle(firstHeroBg);
                        const opacity = parseFloat(computedStyle.opacity);
                        
                        if (opacity >= 0.9) {
                            console.log('First hero image is fully visible, hiding preloader');
                            hidePreloader();
                        } else {
                            console.log('Hero image not fully visible yet, waiting...');
                            // Wait a bit more if not fully visible
                            setTimeout(hidePreloader, 500);
                        }
                    }, 1000); // Wait 1 second for the fade-in transition to complete
                } else {
                    hidePreloader();
                }
            }
        }
        
        // Preload hero images and track their loading
        function preloadHeroImages() {
            const heroBgs = document.querySelectorAll('.hero-bg');
            totalHeroImages = heroBgs.length;
            
            if (totalHeroImages === 0) {
                console.log('No hero images found, hiding preloader immediately');
                hidePreloader();
                return;
            }
            
            console.log(`Found ${totalHeroImages} hero images to preload`);
            
            heroBgs.forEach(function(bgElement) {
                const style = window.getComputedStyle(bgElement);
                const backgroundImage = style.backgroundImage;
                
                if (backgroundImage && backgroundImage !== 'none') {
                    // Extract URL from background-image
                    const url = backgroundImage.replace(/url\(['"]?(.*?)['"]?\)/i, '$1');
                    
                    if (url) {
                        const img = new Image();
                        img.onload = function() {
                            console.log('Hero image loaded:', url);
                            // Add a subtle fade-in effect for the first image
                            if (heroImagesLoaded === 0) {
                                const firstHeroBg = document.querySelector('.hero-bg.active');
                                if (firstHeroBg) {
                                    // Ensure the first image starts invisible and fades in
                                    firstHeroBg.style.opacity = '0';
                                    firstHeroBg.style.transition = 'opacity 0.8s ease-out';
                                    
                                    // Trigger the fade-in after a small delay
                                    setTimeout(function() {
                                        firstHeroBg.style.opacity = '1';
                                    }, 100);
                                }
                            }
                            checkHeroImagesLoaded();
                        };
                        img.onerror = function() {
                            console.log('Hero image failed to load:', url);
                            checkHeroImagesLoaded(); // Still count it to avoid infinite waiting
                        };
                        img.src = url;
                    } else {
                        checkHeroImagesLoaded(); // Count it even if no URL found
                    }
                } else {
                    checkHeroImagesLoaded(); // Count it even if no background image
                }
            });
        }
        
        // Initialize progress text
        updateProgressText(0, 0);
        
        // Start preloading when DOM is ready
        preloadHeroImages();
        
        // Fallback: hide preloader after 3 seconds max
        setTimeout(function() {
            if (!preloaderHidden) {
                console.log('Fallback: hiding preloader after timeout');
                hidePreloader();
            }
        }, 3000);
        
        // Emergency fallback: hide after 5 seconds no matter what
        setTimeout(function() {
            if (!preloaderHidden) {
                console.log('Emergency fallback: forcing preloader removal');
                const preloader = $('#preloader');
                if (preloader.length) {
                    preloader.remove(); // Force remove if still stuck
                }
            }
        }, 5000);
    }

    /**
     * Accessibility Enhancements
     */
    function initAccessibility() {
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
    }

    /**
     * Performance Optimizations
     */
    
    // Debounce function
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

    /**
     * Google Maps Loading Optimization
     */
    function initMapLoading() {
        const mapContainer = $('.location-map');
        const mapIframe = mapContainer.find('iframe');
        
        if (mapContainer.length && mapIframe.length) {
            // Add loading class initially
            mapContainer.addClass('loading');
            
            // Listen for iframe load event
            mapIframe.on('load', function() {
                // Remove loading class and add loaded class
                mapContainer.removeClass('loading').addClass('loaded');
                
                // Fade in the iframe
                $(this).css('opacity', '1');
            });
            
            // Fallback: if iframe doesn't load within 5 seconds, show it anyway
            setTimeout(function() {
                if (mapContainer.hasClass('loading')) {
                    mapContainer.removeClass('loading').addClass('loaded');
                    mapIframe.css('opacity', '1');
                }
            }, 5000);
        }
    }

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

    // Initialize map loading
    initMapLoading();

})(jQuery); 