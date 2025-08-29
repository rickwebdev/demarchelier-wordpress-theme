# Performance Optimizations - Demarchelier WordPress Theme

This document outlines all performance optimizations implemented to achieve faster first paint, earlier animations, and smooth scrolling on mobile devices.

## 1. Hero Image Optimization
- ✅ Set `fetchpriority="high"` and `loading="eager"` for first hero image
- ✅ Added `<link rel="preload" as="image">` for hero background images in `<head>`
- ✅ Dynamic preloading of first two hero images from Customizer/ACF
- ✅ Fallback to default Unsplash images if no custom images set
- ✅ Preconnect to Unsplash domain for faster image loading

## 2. Animation Optimization with IntersectionObserver
- ✅ Replaced scroll event triggers with IntersectionObserver API
- ✅ Reusable IO that adds `.is-visible` class when elements enter viewport
- ✅ Optimized `rootMargin: "20px 0px"` and `threshold: 0.2` for precise triggering
- ✅ Added 100ms delay before adding `is-visible` class for more noticeable animations
- ✅ CSS animations using only `opacity` and `transform` (GPU-accelerated)
- ✅ Smooth transitions with `cubic-bezier` easing and `will-change` properties
- ✅ Fallback scroll animations for older browsers

## 3. Lazy Loading Optimization
- ✅ Kept `loading="lazy"` for below-the-fold images
- ✅ Enhanced prefetch window with IntersectionObserver
- ✅ Added `width` and `height` attributes to all `<img>` tags to prevent CLS
- ✅ Critical above-the-fold images load immediately (no lazy loading)
- ✅ Optimized lazy loading with early detection

## 4. Preloader Management
- ✅ Non-blocking preloader that doesn't gate page rendering
- ✅ Waits for hero images to load before hiding
- ✅ Sophisticated loading detection with opacity verification
- ✅ Fallback mechanisms (3s and 5s timeouts)
- ✅ Themed preloader with wood/burgundy gradient background
- ✅ Logo styling with "DEMARCHELIER Bistro" text
- ✅ Dynamic progress text ("Loading..." → "Finalizing...")
- ✅ Clean rotating spinner animation

## 5. JavaScript and CSS Optimization
- ✅ Added `defer` attribute to non-critical scripts
- ✅ Inlined critical CSS for hero and header in `<head>`
- ✅ Minimal critical CSS ensures immediate above-the-fold rendering
- ✅ Optimized JavaScript with debouncing and throttling
- ✅ Used `requestAnimationFrame` for smooth animations

## 6. Fonts
- ✅ Google Fonts include `display=swap` for faster rendering
- ✅ Added `<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>` for font domain preconnection
- ✅ Preconnect to Google Fonts domains for faster font loading

## 7. Google Maps Optimization
- ✅ Added preconnect to Google Maps domains (`maps.googleapis.com`)
- ✅ Preload Google Maps iframe as document resource
- ✅ Changed iframe loading from `lazy` to `eager` with `importance="high"`
- ✅ Added loading state with spinner while map loads
- ✅ Implemented fallback loading (5-second timeout)
- ✅ Smooth fade-in transition when map loads
- ✅ Optimized iframe attributes for faster loading

## 8. Parallax Effects
- ✅ Subtle parallax effect on hero copy using CSS transforms
- ✅ JavaScript-controlled movement with easing
- ✅ Optimized with `requestAnimationFrame` and throttling
- ✅ GPU-accelerated transforms for smooth performance

## 9. Critical CSS Inlined
- ✅ Hero section styling (background, content, text)
- ✅ Preloader styling (background, logo, spinner)
- ✅ Header logo styling with proper kerning
- ✅ Essential animations and transitions
- ✅ Ensures immediate visual rendering

## 10. Resource Hints
- ✅ DNS prefetch for external domains
- ✅ Preconnect to critical third-party domains
- ✅ Preload critical resources (hero images, maps)
- ✅ Optimized loading sequence

## Performance Results
- **Faster First Paint**: Critical CSS inlined, preloader non-blocking
- **Earlier Animations**: IntersectionObserver with optimized thresholds
- **Smooth Scrolling**: GPU-accelerated animations, debounced events
- **Reduced CLS**: Proper image dimensions, optimized loading
- **Better UX**: Loading states, fallbacks, smooth transitions

## Files Modified
- `header.php`: Resource hints, critical CSS, preloader HTML
- `style.css`: Animation styles, preloader styling, map optimization
- `js/theme-optimized.js`: IntersectionObserver, preloader logic, map loading
- `template-parts/homepage-default.php`: Image attributes, map iframe
- `functions.php`: Script enqueuing with defer

## Browser Support
- Modern browsers: Full IntersectionObserver support
- Older browsers: Fallback scroll animations
- Progressive enhancement approach
- Graceful degradation for all features 