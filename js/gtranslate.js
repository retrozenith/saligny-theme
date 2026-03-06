/**
 * GTranslate Widget Auto-Collapse
 * Collapses to show only flag on left edge after 2-3 seconds on narrower screens
 */
document.addEventListener('DOMContentLoaded', function () {
    var gtWrapper = document.querySelector('.gt_switcher_wrapper');
    var collapseTimeout = null;
    var COLLAPSE_DELAY = 3000; // 3 seconds
    var COLLAPSE_BREAKPOINT = 1470; // Collapse on screens <= 1470px

    if (!gtWrapper) {
        return; // Widget not found
    }

    // Check if screen is narrow enough to collapse
    function shouldCollapse() {
        return window.innerWidth <= COLLAPSE_BREAKPOINT;
    }

    // Collapse the widget (show only flag)
    function collapseWidget() {
        if (shouldCollapse()) {
            gtWrapper.classList.add('gt-collapsed');
        }
    }

    // Expand the widget (show full)
    function expandWidget() {
        gtWrapper.classList.remove('gt-collapsed');

        // Clear existing timeout
        if (collapseTimeout) {
            clearTimeout(collapseTimeout);
        }

        // Set new timeout to collapse after delay
        if (shouldCollapse()) {
            collapseTimeout = setTimeout(collapseWidget, COLLAPSE_DELAY);
        }
    }

    // Collapse widget on page load if screen is narrow
    if (shouldCollapse()) {
        collapseTimeout = setTimeout(collapseWidget, COLLAPSE_DELAY);
    }

    // Expand on hover
    gtWrapper.addEventListener('mouseenter', function () {
        expandWidget();
    });

    // Expand on focus/tab
    gtWrapper.addEventListener('focusin', function () {
        expandWidget();
    });

    // Expand on touch (for touch devices)
    gtWrapper.addEventListener('touchstart', function () {
        expandWidget();
    });

    // Collapse when user leaves (mouseout)
    gtWrapper.addEventListener('mouseleave', function () {
        if (shouldCollapse()) {
            collapseTimeout = setTimeout(collapseWidget, COLLAPSE_DELAY);
        }
    });

    // Handle resize - adjust behavior if window is resized
    window.addEventListener('resize', function () {
        if (!shouldCollapse() && gtWrapper.classList.contains('gt-collapsed')) {
            // If resized to wider, expand the widget
            gtWrapper.classList.remove('gt-collapsed');
            if (collapseTimeout) {
                clearTimeout(collapseTimeout);
            }
        } else if (shouldCollapse() && !gtWrapper.classList.contains('gt-collapsed')) {
            // If resized to narrower, start collapse timer
            if (collapseTimeout) {
                clearTimeout(collapseTimeout);
            }
            collapseTimeout = setTimeout(collapseWidget, COLLAPSE_DELAY);
        }
    });
});

