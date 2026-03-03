/**
 * Navigation scripts
 */
document.addEventListener('DOMContentLoaded', function () {
    var menuToggle = document.getElementById('menu-toggle');
    var mainNav = document.getElementById('main-navigation');
    var MOBILE_BREAKPOINT = 1024;

    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            this.classList.toggle('active');
            mainNav.classList.toggle('active');

            var expanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !expanded);

            // If we are closing the main menu, close all sub-menus too
            if (expanded) {
                var openItems = mainNav.querySelectorAll('.open');
                for (var i = 0; i < openItems.length; i++) {
                    openItems[i].classList.remove('open');
                }
            }
        });

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
            var target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
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
