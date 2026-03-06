/**
 * Navigation scripts
 */
document.addEventListener('DOMContentLoaded', function () {
    var menuToggle = document.getElementById('menu-toggle');
    var mainNav = document.getElementById('main-navigation');
    var siteHeader = document.getElementById('site-header');
    var topBar = siteHeader ? siteHeader.querySelector('.top-bar') : null;
    var MOBILE_BREAKPOINT = 1024;
    var lastScrollY = window.pageYOffset;
    var headerScrolled = false;

    function syncTopBarHeight() {
        if (!siteHeader || !topBar) return;
        siteHeader.style.setProperty('--top-bar-height', topBar.scrollHeight + 'px');
    }

    syncTopBarHeight();
    window.addEventListener('load', syncTopBarHeight);
    window.addEventListener('resize', syncTopBarHeight);

    // Desktop scroll behavior: hide top bar only after clear downward scroll,
    // show it back with a softer threshold when scrolling up.
    if (siteHeader) {
        window.addEventListener('scroll', function () {
            var currentScrollY = window.pageYOffset;
            var delta = currentScrollY - lastScrollY;
            var isDesktop = window.innerWidth > MOBILE_BREAKPOINT;

                // Thresholds differ: desktop needs more scroll to trigger hide.
            var noiseThreshold = isDesktop ? 6 : 3;
            var hideThreshold  = isDesktop ? 100 : 40;

            // Ignore tiny noise to avoid jitter.
            if (Math.abs(delta) < noiseThreshold) {
                lastScrollY = currentScrollY;
                return;
            }

            if (delta > 0 && currentScrollY > hideThreshold && !headerScrolled) {
                siteHeader.classList.add('scrolled');
                headerScrolled = true;
            }

            if (delta < 0 && headerScrolled) {
                siteHeader.classList.remove('scrolled');
                headerScrolled = false;
            }

            if (currentScrollY <= 10 && headerScrolled) {
                siteHeader.classList.remove('scrolled');
                headerScrolled = false;
            }

            lastScrollY = currentScrollY;
        });
    }

    if (menuToggle && mainNav) {
        var menuClose = document.getElementById('menu-close');
        var navOverlay = document.getElementById('nav-overlay');

        function openMenu() {
            menuToggle.classList.add('active');
            mainNav.classList.add('active');
            if (navOverlay) navOverlay.classList.add('active');
            menuToggle.setAttribute('aria-expanded', 'true');
            document.body.style.overflow = 'hidden';
        }

        function closeMenu() {
            menuToggle.classList.remove('active');
            mainNav.classList.remove('active');
            if (navOverlay) navOverlay.classList.remove('active');
            menuToggle.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
            // Close all sub-menus
            var openItems = mainNav.querySelectorAll('.open');
            for (var i = 0; i < openItems.length; i++) {
                openItems[i].classList.remove('open');
            }
        }

        menuToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            if (mainNav.classList.contains('active')) {
                closeMenu();
            } else {
                openMenu();
            }
        });

        if (menuClose) {
            menuClose.addEventListener('click', function () {
                closeMenu();
            });
        }

        if (navOverlay) {
            navOverlay.addEventListener('click', function () {
                closeMenu();
            });
        }

        // Handle mobile sub-menu toggles for ALL items with children
        mainNav.addEventListener('click', function (e) {
            if (window.innerWidth > MOBILE_BREAKPOINT) return;

            var link = e.target.closest('.menu-item-has-children > a');
            if (!link) return;

            e.preventDefault();
            e.stopPropagation();

            var parentLi = link.parentElement;

            // Close sibling menus at the same level
            var siblings = parentLi.parentElement.children;
            for (var i = 0; i < siblings.length; i++) {
                if (siblings[i] !== parentLi) {
                    siblings[i].classList.remove('open');
                }
            }

            parentLi.classList.toggle('open');
        });

        // Close menu on outside click
        document.addEventListener('click', function (e) {
            if (!menuToggle.contains(e.target) && !mainNav.contains(e.target)) {
                menuToggle.classList.remove('active');
                mainNav.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', 'false');

                // Close all sub-menus
                var openItems = mainNav.querySelectorAll('.open');
                for (var i = 0; i < openItems.length; i++) {
                    openItems[i].classList.remove('open');
                }
            }
        });
    }

    // Close mobile menu on resize to desktop
    window.addEventListener('resize', function () {
        if (window.innerWidth > MOBILE_BREAKPOINT) {
            if (menuToggle) {
                menuToggle.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', 'false');
            }
            if (mainNav) {
                mainNav.classList.remove('active');
                var openItems = mainNav.querySelectorAll('.open');
                for (var i = 0; i < openItems.length; i++) {
                    openItems[i].classList.remove('open');
                }
            }
        }
    });

    // Smooth scroll for anchor links
    var anchors = document.querySelectorAll('a[href^="#"]');
    for (var i = 0; i < anchors.length; i++) {
        anchors[i].addEventListener('click', function (e) {
            var href = this.getAttribute('href');
            // Only process valid anchor selectors (not full URLs with hash)
            if (href && href.indexOf('#') === 0 && href.indexOf('http') !== 0) {
                var target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        });
    }

    // Add animation on scroll
    if ('IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function (entries) {
            for (var i = 0; i < entries.length; i++) {
                if (entries[i].isIntersecting) {
                    entries[i].target.style.opacity = '1';
                    entries[i].target.style.transform = 'translateY(0)';
                }
            }
        }, { threshold: 0.1 });

        var animatedEls = document.querySelectorAll('.category-block, .sidebar-widget, .welcome-section');
        for (var i = 0; i < animatedEls.length; i++) {
            animatedEls[i].style.opacity = '0';
            animatedEls[i].style.transform = 'translateY(20px)';
            animatedEls[i].style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(animatedEls[i]);
        }
    }
});
