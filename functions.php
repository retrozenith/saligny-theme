<?php
/**
 * Saligny Theme functions and definitions
 *
 * @package Saligny_Theme
 */

// ============================================
// THEME SETUP
// ============================================
function saligny_setup()
{
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');

    // Custom image sizes
    add_image_size('saligny-slider', 1200, 500, true);
    add_image_size('saligny-card-thumb', 300, 300, true);
    add_image_size('saligny-featured', 800, 400, true);

    // Custom logo support
    add_theme_support('custom-logo', array(
        'height' => 120,
        'width' => 120,
        'flex-height' => true,
        'flex-width' => true,
    ));

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Meniu Principal', 'saligny-theme'),
        'footer' => __('Meniu Footer', 'saligny-theme'),
    ));

    // HTML5 support
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add support for responsive embedded content
    add_theme_support('responsive-embeds');

    // Editor styles
    add_theme_support('editor-styles');
}
add_action('after_setup_theme', 'saligny_setup');

// ============================================
// ENQUEUE SCRIPTS & STYLES
// ============================================
function saligny_scripts()
{
    // Google Fonts - Inter
    wp_enqueue_style(
        'saligny-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap',
        array(),
        null
    );

    // Theme stylesheet
    wp_enqueue_style('saligny-style', get_stylesheet_uri(), array('saligny-google-fonts'), filemtime(get_stylesheet_directory() . '/style.css'));

    // GTranslate custom styling
    wp_enqueue_style('saligny-gtranslate', get_template_directory_uri() . '/css/gtranslate-custom.css', array(), filemtime(get_stylesheet_directory() . '/css/gtranslate-custom.css'));

    // Theme JavaScript
    wp_enqueue_script('saligny-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0.0', true);

    // Slider script
    wp_enqueue_script('saligny-slider', get_template_directory_uri() . '/js/slider.js', array(), '1.0.0', true);

    // GTranslate auto-hide script (mobile)
    wp_enqueue_script('saligny-gtranslate', get_template_directory_uri() . '/js/gtranslate.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'saligny_scripts');

// ============================================
// REGISTER SIDEBARS / WIDGET AREAS
// ============================================
function saligny_widgets_init()
{
    register_sidebar(array(
        'name' => __('Sidebar Principal', 'saligny-theme'),
        'id' => 'sidebar-1',
        'description' => __('Adăugați widget-uri aici.', 'saligny-theme'),
        'before_widget' => '<div id="%1$s" class="sidebar-widget widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Footer Coloana 1', 'saligny-theme'),
        'id' => 'footer-1',
        'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Footer Coloana 2', 'saligny-theme'),
        'id' => 'footer-2',
        'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Footer Coloana 3', 'saligny-theme'),
        'id' => 'footer-3',
        'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'saligny_widgets_init');

// ============================================
// CONTENT WIDTH
// ============================================
function saligny_content_width()
{
    $GLOBALS['content_width'] = apply_filters('saligny_content_width', 800);
}
add_action('after_setup_theme', 'saligny_content_width', 0);

// ============================================
// CUSTOM EXCERPT LENGTH
// ============================================
function saligny_excerpt_length($length)
{
    return 25;
}
add_filter('excerpt_length', 'saligny_excerpt_length');

function saligny_excerpt_more($more)
{
    return ' [&hellip;]';
}
add_filter('excerpt_more', 'saligny_excerpt_more');

// ============================================
// HELPER: Get posts by category slug
// ============================================
function saligny_get_category_posts($category_slug, $count = 5)
{
    $cat = get_category_by_slug($category_slug);
    if (!$cat)
        return array();

    return get_posts(array(
        'category' => $cat->term_id,
        'posts_per_page' => $count,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
    ));
}

// ============================================
// HELPER: Find content by exact title (WP 6.2+ safe)
// ============================================
function saligny_get_content_by_title($title, $post_type = 'page')
{
    $query = new WP_Query(array(
        'post_type' => $post_type,
        'post_status' => array('publish', 'draft', 'pending', 'private', 'future'),
        'posts_per_page' => 1,
        'title' => $title,
        'orderby' => 'ID',
        'order' => 'ASC',
        'no_found_rows' => true,
        'ignore_sticky_posts' => true,
    ));

    if (!empty($query->posts)) {
        return $query->posts[0];
    }

    // Fallback by slug for environments where title query var is unreliable.
    $slug = sanitize_title($title);
    if ($slug !== '') {
        $fallback = new WP_Query(array(
            'post_type' => $post_type,
            'post_status' => array('publish', 'draft', 'pending', 'private', 'future'),
            'posts_per_page' => 1,
            'name' => $slug,
            'orderby' => 'ID',
            'order' => 'ASC',
            'no_found_rows' => true,
            'ignore_sticky_posts' => true,
        ));

        if (!empty($fallback->posts)) {
            return $fallback->posts[0];
        }
    }

    return null;
}

// ============================================
// HELPER: Default post thumbnail
// ============================================
function saligny_post_thumbnail($size = 'saligny-card-thumb')
{
    if (has_post_thumbnail()) {
        the_post_thumbnail($size);
    }
    else {
        echo '<img src="' . esc_url(get_template_directory_uri() . '/assets/img/default-thumb.svg') . '" alt="' . esc_attr(get_the_title()) . '">';
    }
}

// ============================================
// HELPER: SVG Icon system
// ============================================
function saligny_icon($name, $size = '1em')
{
    $style = 'style="width:' . esc_attr($size) . ';height:' . esc_attr($size) . ';vertical-align:-0.125em;fill:currentColor;flex-shrink:0;"';
    $icons = array(
        'megaphone' => '<svg ' . $style . ' viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>',
        'target' => '<svg ' . $style . ' viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="6" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="2"/></svg>',
        'building' => '<svg ' . $style . ' viewBox="0 0 24 24"><path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z"/></svg>',
        'clipboard' => '<svg ' . $style . ' viewBox="0 0 24 24"><path d="M19 3h-4.18C14.4 1.84 13.3 1 12 1s-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm2 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>',
        'newspaper' => '<svg ' . $style . ' viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM8 20H4v-4h4v4zm0-6H4v-4h4v4zm0-6H4V4h4v4zm6 12h-4V4h4v16zm6 0h-4v-4h4v4zm0-6h-4v-4h4v4zm0-6h-4V4h4v4z"/></svg>',
        'document' => '<svg ' . $style . ' viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg>',
        'calendar' => '<svg ' . $style . ' viewBox="0 0 24 24"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM9 10H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2z"/></svg>',
        'graduation' => '<svg ' . $style . ' viewBox="0 0 24 24"><path d="M12 3L1 9l11 6 9-4.91V17h2V9M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82z"/></svg>',
        'school' => '<svg ' . $style . ' viewBox="0 0 24 24"><path d="M12 3L1 9l11 6 9-4.91V17h2V9M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82z"/></svg>',
        'user' => '<svg ' . $style . ' viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>',
        'folder' => '<svg ' . $style . ' viewBox="0 0 24 24"><path d="M10 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2h-8l-2-2z"/></svg>',
        'tag' => '<svg ' . $style . ' viewBox="0 0 24 24"><path d="M21.41 11.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.1 0-2 .9-2 2v7c0 .55.22 1.05.59 1.42l9 9c.36.36.86.58 1.41.58.55 0 1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41 0-.55-.23-1.06-.59-1.42zM5.5 7C4.67 7 4 6.33 4 5.5S4.67 4 5.5 4 7 4.67 7 5.5 6.33 7 5.5 7z"/></svg>',
        'pin' => '<svg ' . $style . ' viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>',
        'phone' => '<svg ' . $style . ' viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>',
        'email' => '<svg ' . $style . ' viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>',
        'archive' => '<svg ' . $style . ' viewBox="0 0 24 24"><path d="M20.54 5.23l-1.39-1.68C18.88 3.21 18.47 3 18 3H6c-.47 0-.88.21-1.16.55L3.46 5.23C3.17 5.57 3 6.02 3 6.5V19c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6.5c0-.48-.17-.93-.46-1.27zM12 17.5L6.5 12H10v-2h4v2h3.5L12 17.5zM5.12 5l.81-1h12l.94 1H5.12z"/></svg>',
        'settings' => '<svg ' . $style . ' viewBox="0 0 24 24"><path d="M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.06-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.73,8.87 C2.62,9.08,2.66,9.34,2.86,9.48l2.03,1.58C4.84,11.36,4.8,11.69,4.8,12s0.02,0.64,0.06,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.43-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.49-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z"/></svg>',
        'home' => '<svg ' . $style . ' viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>',
        'facebook' => '<svg ' . $style . ' viewBox="0 0 24 24"><path d="M12 2.04C6.5 2.04 2 6.53 2 12.06C2 17.06 5.66 21.21 10.44 21.96V14.96H7.9V12.06H10.44V9.85C10.44 7.34 11.93 5.96 14.22 5.96C15.31 5.96 16.45 6.15 16.45 6.15V8.62H15.19C13.95 8.62 13.56 9.39 13.56 10.18V12.06H16.34L15.89 14.96H13.56V21.96A10 10 0 0 0 22 12.06C22 6.53 17.5 2.04 12 2.04Z"/></svg>',
        'instagram' => '<svg ' . $style . ' viewBox="0 0 24 24"><path d="M7.8,2H16.2C19.4,2 22,4.6 22,7.8V16.2A5.8,5.8 0 0,1 16.2,22H7.8C4.6,22 2,19.4 2,16.2V7.8A5.8,5.8 0 0,1 7.8,2M7.6,4A3.6,3.6 0 0,0 4,7.6V16.4C4,18.39 5.61,20 7.6,20H16.4A3.6,3.6 0 0,0 20,16.4V7.6C20,5.61 18.39,4 16.4,4H7.6M17.25,5.5A1.25,1.25 0 0,1 18.5,6.75A1.25,1.25 0 0,1 17.25,8A1.25,1.25 0 0,1 16,6.75A1.25,1.25 0 0,1 17.25,5.5M12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9Z"/></svg>',
        'search' => '<svg ' . $style . ' viewBox="0 0 24 28" role="img" aria-label="Search"><circle cx="10" cy="10" r="6.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><line x1="15.2" y1="15.2" x2="21" y2="21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>',        );
    return isset($icons[$name]) ? $icons[$name] : '';
}

// ============================================
// HELPER: Render category icon
// ============================================
function saligny_category_icon($slug)
{
    $map = array(
        'noutati' => 'megaphone',
        'activitati' => 'target',
        'proiecte' => 'building',
        'secretariat' => 'clipboard',
        'reviste' => 'newspaper',
    );
    $icon_name = isset($map[$slug]) ? $map[$slug] : 'document';
    return saligny_icon($icon_name);
}

// ============================================
// ADD MENU CSS CLASSES
// ============================================
function saligny_menu_item_classes($classes, $item, $args)
{
    if ($args->theme_location === 'primary') {
        if (in_array('menu-item-has-children', $classes)) {
            $classes[] = 'has-dropdown';
        }
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'saligny_menu_item_classes', 10, 3);

// ============================================
// THEME ACTIVATION: Create default content
// ============================================
function saligny_theme_activation()
{
    // Create categories
    $categories = array(
        'noutati' => 'Noutati',
        'activitati' => 'Activitati',
        'proiecte' => 'Proiecte',
        'secretariat' => 'Secretariat',
        'reviste' => 'Reviste',
    );

    foreach ($categories as $slug => $name) {
        if (!term_exists($slug, 'category')) {
            wp_insert_term($name, 'category', array('slug' => $slug));
        }
    }

    // Remove default "Uncategorized" if it exists and has no posts
    $uncategorized = get_category_by_slug('uncategorized');
    if ($uncategorized && $uncategorized->count == 0) {
    // Don't delete it, just leave it
    }

    $oferta_default_content = <<<'HTML'
<h2>Oferta liceu</h2>
<p>Oferta școlii noastre este una generoasă:</p>
<ul>
<li>Calificări diverse în filiera tehnologică, profil tehnic, domeniile: construcții, instalații și lucrări publice, mecanică și electric, resurse naturale și protecția mediului.</li>
<li>Calificarea instructor sportiv, prin filiera vocațională, profil sportiv.</li>
<li>Calificare prin școala profesională în meseria de sudor.</li>
<li>Cursuri de pregătire prin școala postliceală în domeniul construcții, instalații și lucrări publice (tehnician urbanism și amenajarea teritoriului, tehnician devize și măsurători în construcții).</li>
<li>Cursuri de calificare profesională pentru adulți în domeniile construcții și mecanică.</li>
<li>Școala de maiștri pentru calificările Maistru instalator pentru construcții și Maistru electromecanic aparate de măsură și automatizări.</li>
</ul>

<h3>Structura claselor (an școlar 2014-2015)</h3>
<p><strong>Liceu zi</strong>: IX (7 clase), X (6 clase), XI (6 clase), XII (7 clase).</p>
<p><strong>Liceu seral</strong>: IX (1 clasă), X (2 clase), XI (2 clase), XII (2 clase), XIII (1 clasă).</p>
<p><strong>Școala de maiștri</strong>: 3 clase (I Me, I Mi, II Me).</p>
<p><strong>Școala profesională</strong>: 2 clase (Xs, XI s) - calificare Sudor.</p>
<p><strong>Învățământ postliceal</strong>: 4 clase (I PL - 2, II PL - 2).</p>
HTML;

    // Create pages
    $pages = array(
        'Profesori' => 'Corpul profesoral al Colegiului Tehnic "Anghel Saligny" este format din cadre didactice cu experiență și dedicare către educația tinerilor.',
        'Elevi' => 'Informații utile pentru elevii Colegiului Tehnic "Anghel Saligny".',
        'Părinți' => 'Informații și resurse pentru părinții elevilor noștri.',
        'Oferta educațională' => $oferta_default_content,
        'Examene' => 'Calendarul examenelor și informații despre evaluările naționale și internaționale.',
        'Proiecte și programe' => 'Colegiul nostru participă la numeroase proiecte și programe educaționale, atât la nivel național, cât și internațional.',
        'Învățământ profesional dual' => 'Programul de învățământ profesional dual combină pregătirea teoretică cu experiența practică în companii partenere.',
        'Erasmus' => 'Proiectele Erasmus+ oferă elevilor și cadrelor didactice oportunități de mobilitate și învățare în țări europene.',
        'Programul Educație și Ocupare 2021-2027 (PEO)' => 'Informații despre Programul Educație și Ocupare 2021-2027, finanțat prin fonduri europene.',
        'OLIMPIADĂ' => 'Rezultatele și informațiile despre participarea elevilor noștri la olimpiadele școlare.',
        'Despre Noi' => 'Colegiul Tehnic "Anghel Saligny" Bucuresti este o instituție de învățământ cu tradiție, oferind specializări tehnice și vocaționale de înaltă calitate.',
        'Istoricul Școlii' => 'Colegiul Tehnic "Anghel Saligny" din București are o istorie bogată, fiind una dintre cele mai vechi și prestigioase instituții de învățământ tehnic din România.',
        'Inginerul Anghel Saligny' => 'Anghel Saligny (1854-1925) a fost un inginer român, considerat unul dintre cei mai mari ingineri constructori din istoria României.',
        'Misiune si Viziune' => 'Misiunea noastră este de a forma specialiști competenți în domeniul tehnic, capabili să răspundă cerințelor pieței muncii.',
        'Educatie' => 'Oferta noastră educațională cuprinde filiera tehnologică și filiera vocațională, cu multiple specializări.',
        'Profilul Educational' => 'Colegiul oferă o gamă largă de calificări profesionale în domenii tehnice și vocaționale.',
        'Calificări și Curriculum' => 'Calificările oferite de colegiul nostru sunt recunoscute la nivel european.',
        'Baza Materiala' => 'Colegiul dispune de laboratoare moderne, ateliere echipate și săli de clasă confortabile.',
        'Contact' => '<h3>Adresa</h3><p>Str. Ing. Zablovschi nr. 4, Sector 3, 031534 București</p><h3>Telefon</h3><p>021 323 8035</p><h3>Email</h3><p>anghel_saligny@yahoo.com</p>',
        'Secretariat ONLINE' => 'Pentru orice informare, va rugam sa va adresati serviciului secretariat in mediul on-line pe mail-ul unitatii: anghel_saligny@yahoo.com',
        'Management' => 'Echipa de conducere a Colegiului Tehnic "Anghel Saligny".',
        'Transparenta Institutionala' => 'Informații publice conform Legii nr. 544/2001 privind liberul acces la informațiile de interes public.',
    );

    foreach ($pages as $title => $content) {
        $existing = saligny_get_content_by_title($title, 'page');
        if (!$existing) {
            wp_insert_post(array(
                'post_title' => $title,
                'post_content' => $content,
                'post_status' => 'publish',
                'post_type' => 'page',
                'post_author' => 1,
            ));
        }
    }

    // Create sample posts
    $sample_posts = array(
            array(
            'title' => 'Bine ați venit pe noul site al Colegiului Tehnic "Anghel Saligny"!',
            'content' => 'Suntem bucuroși să vă prezentăm noul website al Colegiului Tehnic "Anghel Saligny" Bucuresti. Aici veți găsi toate informațiile necesare despre oferta noastră educațională, activitățile desfășurate și proiectele școlii.',
            'category' => 'noutati',
        ),
            array(
            'title' => 'Începere an școlar 2025-2026',
            'content' => 'ANUNȚ! Luni, 08.09.2025, ora 8.30, elevii sunt așteptați de profesorii diriginți în sala lor de clasă, pentru a li se comunica programul pentru prima săptămână de școală.',
            'category' => 'noutati',
        ),
            array(
            'title' => 'De la formare profesională la performanță internațională',
            'content' => 'În perioada 2–6 decembrie 2025, Colegiul Tehnic "Anghel Saligny" din București a participat, în calitate de invitat internațional, la competiția WorldSkills Polonia – Gdansk 2025. Elevii noștri au reprezentat România cu mândrie și profesionalism.',
            'category' => 'activitati',
        ),
            array(
            'title' => 'Performanță remarcabilă la competiția națională WorldSkills România',
            'content' => 'În data de 22 mai 2025, Colegiul Tehnic "Anghel Saligny" a fost reprezentat cu succes la prima ediție a competiției WorldSkills România, Secțiunea Instalatori.',
            'category' => 'activitati',
        ),
            array(
            'title' => 'Procedura de selecție participanți mobilități Erasmus+ VET 2025-2026',
            'content' => 'Anunțăm deschiderea procedurii de selecție a participanților la mobilitățile Erasmus+ VET pentru anul școlar 2025-2026.',
            'category' => 'proiecte',
        ),
            array(
            'title' => 'Activități Erasmus+ - European Internship for Compensation Systems',
            'content' => 'Colegiul a participat cu succes la proiectul Erasmus+ "European Internship for Compensation Systems" derulat în Turcia, în luna iunie 2023.',
            'category' => 'proiecte',
        ),
    );

    foreach ($sample_posts as $post_data) {
        $existing = saligny_get_content_by_title($post_data['title'], 'post');
        if (!$existing) {
            $cat = get_category_by_slug($post_data['category']);
            wp_insert_post(array(
                'post_title' => $post_data['title'],
                'post_content' => $post_data['content'],
                'post_status' => 'publish',
                'post_type' => 'post',
                'post_author' => 1,
                'post_category' => $cat ? array($cat->term_id) : array(),
            ));
        }
    }

    // Create primary menu
    $menu_name = 'Meniu Principal';
    $menu_exists = wp_get_nav_menu_object($menu_name);

    if (!$menu_exists) {
        $menu_id = wp_create_nav_menu($menu_name);

        if (!is_wp_error($menu_id)) {
            // Pagina principală
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Pagina principală',
                'menu-item-url' => home_url('/'),
                'menu-item-type' => 'custom',
                'menu-item-status' => 'publish',
            ));

            // Noutăți (News category)
            $noutati_cat = get_category_by_slug('noutati');
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Noutăți',
                'menu-item-url' => $noutati_cat ? get_category_link($noutati_cat->term_id) : home_url('/category/noutati/'),
                'menu-item-type' => 'custom',
                'menu-item-status' => 'publish',
            ));

            // Profesori
            $profesori_page = saligny_get_content_by_title('Profesori', 'page');
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Profesori',
                'menu-item-object-id' => $profesori_page ? $profesori_page->ID : 0,
                'menu-item-object' => 'page',
                'menu-item-type' => $profesori_page ? 'post_type' : 'custom',
                'menu-item-url' => $profesori_page ? '' : home_url('/'),
                'menu-item-status' => 'publish',
            ));

            // Elevi
            $elevi_page = saligny_get_content_by_title('Elevi', 'page');
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Elevi',
                'menu-item-object-id' => $elevi_page ? $elevi_page->ID : 0,
                'menu-item-object' => 'page',
                'menu-item-type' => $elevi_page ? 'post_type' : 'custom',
                'menu-item-url' => $elevi_page ? '' : home_url('/'),
                'menu-item-status' => 'publish',
            ));

            // Părinți
            $parinti_page = saligny_get_content_by_title('Părinți', 'page');
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Părinți',
                'menu-item-object-id' => $parinti_page ? $parinti_page->ID : 0,
                'menu-item-object' => 'page',
                'menu-item-type' => $parinti_page ? 'post_type' : 'custom',
                'menu-item-url' => $parinti_page ? '' : home_url('/'),
                'menu-item-status' => 'publish',
            ));

            // Oferta educațională
            $oferta_page = saligny_get_content_by_title('Oferta educațională', 'page');
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Oferta educațională',
                'menu-item-object-id' => $oferta_page ? $oferta_page->ID : 0,
                'menu-item-object' => 'page',
                'menu-item-type' => $oferta_page ? 'post_type' : 'custom',
                'menu-item-url' => $oferta_page ? '' : home_url('/'),
                'menu-item-status' => 'publish',
            ));

            // Examene
            $examene_page = saligny_get_content_by_title('Examene', 'page');
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Examene',
                'menu-item-object-id' => $examene_page ? $examene_page->ID : 0,
                'menu-item-object' => 'page',
                'menu-item-type' => $examene_page ? 'post_type' : 'custom',
                'menu-item-url' => $examene_page ? '' : home_url('/'),
                'menu-item-status' => 'publish',
            ));

            // Proiecte și programe (parent)
            $proiecte_page = saligny_get_content_by_title('Proiecte și programe', 'page');
            $proiecte_id = wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Proiecte și programe',
                'menu-item-object-id' => $proiecte_page ? $proiecte_page->ID : 0,
                'menu-item-object' => 'page',
                'menu-item-type' => $proiecte_page ? 'post_type' : 'custom',
                'menu-item-url' => $proiecte_page ? '' : home_url('/'),
                'menu-item-status' => 'publish',
            ));

            // Învățământ profesional dual (sub-item of Proiecte)
            $dual_page = saligny_get_content_by_title('Învățământ profesional dual', 'page');
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Învățământ profesional dual',
                'menu-item-object-id' => $dual_page ? $dual_page->ID : 0,
                'menu-item-object' => 'page',
                'menu-item-type' => $dual_page ? 'post_type' : 'custom',
                'menu-item-url' => $dual_page ? '' : home_url('/'),
                'menu-item-status' => 'publish',
                'menu-item-parent-id' => $proiecte_id,
            ));

            // Erasmus (sub-item of Proiecte)
            $erasmus_page = saligny_get_content_by_title('Erasmus', 'page');
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Erasmus',
                'menu-item-object-id' => $erasmus_page ? $erasmus_page->ID : 0,
                'menu-item-object' => 'page',
                'menu-item-type' => $erasmus_page ? 'post_type' : 'custom',
                'menu-item-url' => $erasmus_page ? '' : home_url('/'),
                'menu-item-status' => 'publish',
                'menu-item-parent-id' => $proiecte_id,
            ));

            // PEO (sub-item of Proiecte)
            $peo_page = saligny_get_content_by_title('Programul Educație și Ocupare 2021-2027 (PEO)', 'page');
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Programul Educație și Ocupare 2021-2027 (PEO)',
                'menu-item-object-id' => $peo_page ? $peo_page->ID : 0,
                'menu-item-object' => 'page',
                'menu-item-type' => $peo_page ? 'post_type' : 'custom',
                'menu-item-url' => $peo_page ? '' : home_url('/'),
                'menu-item-status' => 'publish',
                'menu-item-parent-id' => $proiecte_id,
            ));

            // OLIMPIADĂ
            $olimpiada_page = saligny_get_content_by_title('OLIMPIADĂ', 'page');
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'OLIMPIADĂ',
                'menu-item-object-id' => $olimpiada_page ? $olimpiada_page->ID : 0,
                'menu-item-object' => 'page',
                'menu-item-type' => $olimpiada_page ? 'post_type' : 'custom',
                'menu-item-url' => $olimpiada_page ? '' : home_url('/'),
                'menu-item-status' => 'publish',
            ));

            // Contact
                        // Despre Noi (moved to end)
                        $despre_noi_page = saligny_get_content_by_title('Despre Noi', 'page');
                        $despre_id = wp_update_nav_menu_item($menu_id, 0, array(
                            'menu-item-title' => 'Despre Noi',
                            'menu-item-object-id' => $despre_noi_page ? $despre_noi_page->ID : 0,
                            'menu-item-object' => 'page',
                            'menu-item-type' => $despre_noi_page ? 'post_type' : 'custom',
                            'menu-item-url' => $despre_noi_page ? '' : home_url('/'),
                            'menu-item-status' => 'publish',
                        ));

                        // Sub-items for Despre Noi
                        $sub_pages = array('Istoricul Școlii', 'Inginerul Anghel Saligny', 'Misiune si Viziune', 'Management', 'Baza Materiala', 'Transparenta Institutionala');
                        foreach ($sub_pages as $sub_title) {
                            $sub_page = saligny_get_content_by_title($sub_title, 'page');
                            if ($sub_page) {
                                wp_update_nav_menu_item($menu_id, 0, array(
                                    'menu-item-title' => $sub_title,
                                    'menu-item-object-id' => $sub_page->ID,
                                    'menu-item-object' => 'page',
                                    'menu-item-type' => 'post_type',
                                    'menu-item-status' => 'publish',
                                    'menu-item-parent-id' => $despre_id,
                                ));
                            }
                        }

                        // Contact
            $contact_page = saligny_get_content_by_title('Contact', 'page');
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Contact',
                'menu-item-object-id' => $contact_page ? $contact_page->ID : 0,
                'menu-item-object' => 'page',
                'menu-item-type' => $contact_page ? 'post_type' : 'custom',
                'menu-item-url' => $contact_page ? '' : home_url('/'),
                'menu-item-status' => 'publish',
            ));

            // Assign menu to location
            $locations = get_theme_mod('nav_menu_locations');
            $locations['primary'] = $menu_id;
            set_theme_mod('nav_menu_locations', $locations);
        }
    }

    // Set site tagline
    update_option('blogdescription', 'Învățăm să construim lumea așa cum o visăm. Împreună!');
    update_option('blogname', 'Colegiul Tehnic "Anghel Saligny" Bucuresti');

    // Safety net: ensure menu structure is complete even if menu already existed.
    saligny_ensure_primary_menu_integrity();

    // Set permalink structure
    update_option('permalink_structure', '/%postname%/');
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'saligny_theme_activation');

// ============================================
// MENU HEALTH CHECK: ensure required pages/menu items exist
// ============================================
function saligny_nav_required_pages()
{
    $oferta_default_content = <<<'HTML'
<h2>Oferta liceu</h2>
<p>Oferta școlii noastre este una generoasă:</p>
<ul>
<li>Calificări diverse în filiera tehnologică, profil tehnic, domeniile: construcții, instalații și lucrări publice, mecanică și electric, resurse naturale și protecția mediului.</li>
<li>Calificarea instructor sportiv, prin filiera vocațională, profil sportiv.</li>
<li>Calificare prin școala profesională în meseria de sudor.</li>
<li>Cursuri de pregătire prin școala postliceală în domeniul construcții, instalații și lucrări publice (tehnician urbanism și amenajarea teritoriului, tehnician devize și măsurători în construcții).</li>
<li>Cursuri de calificare profesională pentru adulți în domeniile construcții și mecanică.</li>
<li>Școala de maiștri pentru calificările Maistru instalator pentru construcții și Maistru electromecanic aparate de măsură și automatizări.</li>
</ul>

<h3>Structura claselor (an școlar 2014-2015)</h3>
<p><strong>Liceu zi</strong>: IX (7 clase), X (6 clase), XI (6 clase), XII (7 clase).</p>
<p><strong>Liceu seral</strong>: IX (1 clasă), X (2 clase), XI (2 clase), XII (2 clase), XIII (1 clasă).</p>
<p><strong>Școala de maiștri</strong>: 3 clase (I Me, I Mi, II Me).</p>
<p><strong>Școala profesională</strong>: 2 clase (Xs, XI s) - calificare Sudor.</p>
<p><strong>Învățământ postliceal</strong>: 4 clase (I PL - 2, II PL - 2).</p>
HTML;

    return array(
        'Profesori' => 'Corpul profesoral al Colegiului Tehnic "Anghel Saligny" este format din cadre didactice cu experiență și dedicare către educația tinerilor.',
        'Elevi' => 'Informații utile pentru elevii Colegiului Tehnic "Anghel Saligny".',
        'Părinți' => 'Informații și resurse pentru părinții elevilor noștri.',
        'Oferta educațională' => $oferta_default_content,
        'Examene' => 'Calendarul examenelor și informații despre evaluările naționale și internaționale.',
        'Proiecte și programe' => 'Colegiul nostru participă la numeroase proiecte și programe educaționale, atât la nivel național, cât și internațional.',
        'Învățământ profesional dual' => 'Programul de învățământ profesional dual combină pregătirea teoretică cu experiența practică în companii partenere.',
        'Erasmus' => 'Proiectele Erasmus+ oferă elevilor și cadrelor didactice oportunități de mobilitate și învățare în țări europene.',
        'Programul Educație și Ocupare 2021-2027 (PEO)' => 'Informații despre Programul Educație și Ocupare 2021-2027, finanțat prin fonduri europene.',
        'OLIMPIADĂ' => 'Rezultatele și informațiile despre participarea elevilor noștri la olimpiadele școlare.',
        'Despre Noi' => 'Colegiul Tehnic "Anghel Saligny" Bucuresti este o instituție de învățământ cu tradiție, oferind specializări tehnice și vocaționale de înaltă calitate.',
        'Istoricul Școlii' => 'Colegiul Tehnic "Anghel Saligny" din București are o istorie bogată, fiind una dintre cele mai vechi și prestigioase instituții de învățământ tehnic din România.',
        'Inginerul Anghel Saligny' => 'Anghel Saligny (1854-1925) a fost un inginer român, considerat unul dintre cei mai mari ingineri constructori din istoria României.',
        'Misiune si Viziune' => 'Misiunea noastră este de a forma specialiști competenți în domeniul tehnic, capabili să răspundă cerințelor pieței muncii.',
        'Baza Materiala' => 'Colegiul dispune de laboratoare moderne, ateliere echipate și săli de clasă confortabile.',
        'Management' => 'Echipa de conducere a Colegiului Tehnic "Anghel Saligny".',
        'Transparenta Institutionala' => 'Informații publice conform Legii nr. 544/2001 privind liberul acces la informațiile de interes public.',
        'Contact' => '<h3>Adresa</h3><p>Str. Ing. Zablovschi nr. 4, Sector 3, 031534 București</p><h3>Telefon</h3><p>021 323 8035</p><h3>Email</h3><p>anghel_saligny@yahoo.com</p>',
    );
}

function saligny_nav_menu_blueprint()
{
    return array(
        array('key' => 'home', 'title' => 'Pagina principală', 'type' => 'custom', 'url' => home_url('/')),
        array('key' => 'noutati', 'title' => 'Noutăți', 'type' => 'category', 'slug' => 'noutati', 'fallback_url' => home_url('/category/noutati/')),
        array('key' => 'profesori', 'title' => 'Profesori', 'type' => 'page'),
        array('key' => 'elevi', 'title' => 'Elevi', 'type' => 'page'),
        array('key' => 'parinti', 'title' => 'Părinți', 'type' => 'page'),
        array('key' => 'oferta', 'title' => 'Oferta educațională', 'type' => 'page'),
        array('key' => 'examene', 'title' => 'Examene', 'type' => 'page'),
        array('key' => 'proiecte', 'title' => 'Proiecte și programe', 'type' => 'page'),
        array('key' => 'dual', 'title' => 'Învățământ profesional dual', 'type' => 'page', 'parent_key' => 'proiecte'),
        array('key' => 'erasmus', 'title' => 'Erasmus', 'type' => 'page', 'parent_key' => 'proiecte'),
        array('key' => 'peo', 'title' => 'Programul Educație și Ocupare 2021-2027 (PEO)', 'type' => 'page', 'parent_key' => 'proiecte'),
        array('key' => 'olimpiada', 'title' => 'OLIMPIADĂ', 'type' => 'page'),
        array('key' => 'despre', 'title' => 'Despre Noi', 'type' => 'page'),
        array('key' => 'istoric', 'title' => 'Istoricul Școlii', 'type' => 'page', 'parent_key' => 'despre'),
        array('key' => 'saligny', 'title' => 'Inginerul Anghel Saligny', 'type' => 'page', 'parent_key' => 'despre'),
        array('key' => 'misiune', 'title' => 'Misiune si Viziune', 'type' => 'page', 'parent_key' => 'despre'),
        array('key' => 'management', 'title' => 'Management', 'type' => 'page', 'parent_key' => 'despre'),
        array('key' => 'baza', 'title' => 'Baza Materiala', 'type' => 'page', 'parent_key' => 'despre'),
        array('key' => 'transparenta', 'title' => 'Transparenta Institutionala', 'type' => 'page', 'parent_key' => 'despre'),
        array('key' => 'contact', 'title' => 'Contact', 'type' => 'page'),
    );
}

function saligny_lowercase_text($value)
{
    $value = trim((string) $value);
    if ($value === '') {
        return '';
    }

    if (function_exists('mb_strtolower')) {
        return mb_strtolower($value);
    }

    return strtolower($value);
}

function saligny_ensure_primary_menu_integrity()
{
    if (!function_exists('wp_update_nav_menu_item')) {
        return;
    }

    // 1) Ensure required pages exist.
    $required_pages = saligny_nav_required_pages();
    foreach ($required_pages as $title => $content) {
        $existing_page = saligny_get_content_by_title($title, 'page');
        if (!$existing_page) {
            wp_insert_post(array(
                'post_title' => $title,
                'post_content' => $content,
                'post_status' => 'publish',
                'post_type' => 'page',
                'post_author' => 1,
            ));
        }
    }

    // 2) Ensure menu exists.
    $menu_name = 'Meniu Principal';
    $menu_obj = wp_get_nav_menu_object($menu_name);
    if (!$menu_obj) {
        $new_menu_id = wp_create_nav_menu($menu_name);
        if (is_wp_error($new_menu_id)) {
            return;
        }
        $menu_obj = wp_get_nav_menu_object($new_menu_id);
    }

    if (!$menu_obj || empty($menu_obj->term_id)) {
        return;
    }

    $menu_id = (int) $menu_obj->term_id;

    // 3) Ensure menu is assigned to primary location.
    $locations = get_theme_mod('nav_menu_locations', array());
    if (!isset($locations['primary']) || (int) $locations['primary'] !== $menu_id) {
        $locations['primary'] = $menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }

    $existing_items = wp_get_nav_menu_items($menu_id);
    $item_ids_by_key = array();

    if (!empty($existing_items)) {
        foreach ($existing_items as $existing_item) {
            $normalized_title = saligny_lowercase_text($existing_item->title);
            if ($normalized_title !== '') {
                $item_ids_by_key[$normalized_title] = (int) $existing_item->ID;
            }
        }
    }

    // 4) Add missing menu items from blueprint.
    $blueprint = saligny_nav_menu_blueprint();
    $created_ids = array();

    foreach ($blueprint as $node) {
        $node_title_key = saligny_lowercase_text($node['title']);
        if (isset($item_ids_by_key[$node_title_key])) {
            $created_ids[$node['key']] = $item_ids_by_key[$node_title_key];
            continue;
        }

        $menu_item_args = array(
            'menu-item-title' => $node['title'],
            'menu-item-status' => 'publish',
        );

        if (isset($node['parent_key']) && isset($created_ids[$node['parent_key']])) {
            $menu_item_args['menu-item-parent-id'] = $created_ids[$node['parent_key']];
        }

        if ($node['type'] === 'page') {
            $page = saligny_get_content_by_title($node['title'], 'page');
            if ($page) {
                $menu_item_args['menu-item-object-id'] = $page->ID;
                $menu_item_args['menu-item-object'] = 'page';
                $menu_item_args['menu-item-type'] = 'post_type';
            } else {
                $menu_item_args['menu-item-url'] = home_url('/');
                $menu_item_args['menu-item-type'] = 'custom';
            }
        } elseif ($node['type'] === 'category') {
            $category = get_category_by_slug($node['slug']);
            $menu_item_args['menu-item-url'] = $category ? get_category_link($category->term_id) : $node['fallback_url'];
            $menu_item_args['menu-item-type'] = 'custom';
        } else {
            $menu_item_args['menu-item-url'] = isset($node['url']) ? $node['url'] : home_url('/');
            $menu_item_args['menu-item-type'] = 'custom';
        }

        $new_item_id = wp_update_nav_menu_item($menu_id, 0, $menu_item_args);
        if (!is_wp_error($new_item_id) && $new_item_id) {
            $created_ids[$node['key']] = (int) $new_item_id;
        }
    }

    // 5) Always keep "Pagina principală" as first top-level item.
    saligny_force_home_first_in_menu($menu_id);
}

function saligny_force_home_first_in_menu($menu_id)
{
    $items = wp_get_nav_menu_items($menu_id);
    if (empty($items)) {
        return;
    }

    $home_item = null;
    $top_level_items = array();
    $home_url = untrailingslashit(home_url('/'));

    foreach ($items as $item) {
        if ((int) $item->menu_item_parent === 0) {
            $top_level_items[] = $item;
        }

        $title = saligny_lowercase_text(wp_strip_all_tags($item->title));
        $item_url = untrailingslashit((string) $item->url);
        if ($title === 'pagina principală' || $item_url === $home_url) {
            $home_item = $item;
        }
    }

    if (!$home_item) {
        return;
    }

    usort($top_level_items, function ($a, $b) {
        return ((int) $a->menu_order) <=> ((int) $b->menu_order);
    });

    if (!empty($top_level_items) && (int) $top_level_items[0]->ID === (int) $home_item->ID && (int) $home_item->menu_item_parent === 0) {
        return;
    }

    // Ensure homepage is top-level.
    update_post_meta((int) $home_item->ID, '_menu_item_menu_item_parent', 0);

    // Reorder top-level items with homepage first.
    $order = 1;
    wp_update_post(array(
        'ID' => (int) $home_item->ID,
        'menu_order' => $order,
    ));
    $order++;

    foreach ($top_level_items as $item) {
        if ((int) $item->ID === (int) $home_item->ID) {
            continue;
        }

        wp_update_post(array(
            'ID' => (int) $item->ID,
            'menu_order' => $order,
        ));
        $order++;
    }
}

function saligny_nav_health_check()
{
    if (!is_admin()) {
        return;
    }

    if (defined('DOING_AJAX') && DOING_AJAX) {
        return;
    }

    // Run health check on every admin page load (light check, caches result)
    static $check_done = false;
    if ($check_done) {
        return;
    }
    $check_done = true;

    saligny_ensure_primary_menu_integrity();
}
add_action('admin_init', 'saligny_nav_health_check');

function saligny_admin_menu_notice()
{
    if (!current_user_can('manage_options')) {
        return;
    }

    $menu_obj = wp_get_nav_menu_object('Meniu Principal');
    if (!$menu_obj) {
        echo '<div class="notice notice-warning is-dismissible"><p>';
        echo '<strong>Atenție:</strong> Meniul principal lipsește. Se va recrea automat în câteva secunde.<br>';
        echo 'Dacă problema persista, contactează dezvoltatorul temei.';
        echo '</p></div>';
    }
}
add_action('admin_notices', 'saligny_admin_menu_notice');

function saligny_force_home_first_after_menu_save($menu_id)
{
    $menu_obj = wp_get_nav_menu_object($menu_id);
    if (!$menu_obj || empty($menu_obj->name)) {
        return;
    }

    if ($menu_obj->name !== 'Meniu Principal') {
        return;
    }

    saligny_force_home_first_in_menu((int) $menu_id);
}
add_action('wp_update_nav_menu', 'saligny_force_home_first_after_menu_save');

// ============================================
// BODY CLASSES
// ============================================
function saligny_body_classes($classes)
{
    if (is_front_page()) {
        $classes[] = 'is-front-page';
    }
    if (is_singular()) {
        $classes[] = 'is-singular';
    }
    return $classes;
}
add_filter('body_class', 'saligny_body_classes');

// ============================================
// ENSURE PERMALINKS ARE FLUSHED
// ============================================
function saligny_maybe_flush_rewrite_rules()
{
    if (get_option('saligny_permalinks_flushed') !== '1.0.0') {
        flush_rewrite_rules();
        update_option('saligny_permalinks_flushed', '1.0.0');
    }
}
add_action('init', 'saligny_maybe_flush_rewrite_rules');

// ============================================
// ADMIN PAGE: Theme Health & Integrity
// ============================================
function saligny_admin_menu()
{
    add_menu_page(
        'Saligny Theme Health',
        'Tema Saligny',
        'manage_options',
        'saligny-theme-health',
        'saligny_render_theme_health_page',
        'dashicons-wrench',
        60
    );
}
add_action('admin_menu', 'saligny_admin_menu');

function saligny_render_theme_health_page()
{
    if (!current_user_can('manage_options')) {
        wp_die('Acces neautorizat.');
    }

    // Handle form submissions (actions)
    $action_message = '';
    if (isset($_POST['saligny_action']) && wp_verify_nonce($_POST['saligny_nonce'], 'saligny_theme_action')) {
        $action = sanitize_text_field($_POST['saligny_action']);

        if ($action === 'recreate_menu') {
            saligny_ensure_primary_menu_integrity();
            $action_message = '<div class="notice notice-success is-dismissible"><p>✓ Meniu recreat cu succes!</p></div>';
        } elseif ($action === 'run_health_check') {
            delete_option('saligny_nav_health_last_check');
            saligny_nav_health_check();
            $action_message = '<div class="notice notice-success is-dismissible"><p>✓ Health check rulat!</p></div>';
        } elseif ($action === 'flush_permalinks') {
            flush_rewrite_rules();
            $action_message = '<div class="notice notice-success is-dismissible"><p>✓ Linkuri permanente reîncărcate!</p></div>';
        }
    }

    // Gather theme status info
    $menu_obj = wp_get_nav_menu_object('Meniu Principal');
    $menu_items = $menu_obj ? wp_get_nav_menu_items($menu_obj->term_id) : array();

    $theme = wp_get_theme();
    $theme_version = $theme->get('Version');
    $stylesheet = get_stylesheet();

    $has_pages = count(get_pages()) > 0;
    $has_menu = !empty($menu_obj);
    $menu_item_count = count($menu_items);

    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

        <?php echo wp_kses_post($action_message); ?>

        <div style="background: #fff; padding: 20px; border-radius: 8px; margin-top: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <h2 style="margin-top: 0; color: #1a3a5c;">📊 Status Temă</h2>

            <table style="width: 100%; border-collapse: collapse;">
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 12px;"><strong>Tema Activă:</strong></td>
                    <td style="padding: 12px;"><?php echo esc_html($theme->get('Name')); ?></td>
                </tr>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 12px;"><strong>Versiune:</strong></td>
                    <td style="padding: 12px;"><?php echo esc_html($theme_version); ?></td>
                </tr>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 12px;"><strong>Stylesheet:</strong></td>
                    <td style="padding: 12px;"><code><?php echo esc_html($stylesheet); ?></code></td>
                </tr>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 12px;"><strong>Meniu Principal:</strong></td>
                    <td style="padding: 12px;">
                        <?php
                        if ($has_menu) {
                            echo '<span style="color: green;">✓ Existent</span> (' . esc_html($menu_item_count) . ' articole)';
                        } else {
                            echo '<span style="color: red;">✗ Lipsă</span>';
                        }
                        ?>
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 12px;"><strong>Pagini Publicate:</strong></td>
                    <td style="padding: 12px;"><?php echo count(get_pages()); ?></td>
                </tr>
                <tr>
                    <td style="padding: 12px;"><strong>Ultima Verificare Health:</strong></td>
                    <td style="padding: 12px;">
                        <?php
                        $last_check = get_option('saligny_nav_health_last_check');
                        if ($last_check) {
                            echo esc_html(date('Y-m-d H:i:s', (int) $last_check));
                        } else {
                            echo '<em>Niciodată</em>';
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </div>

        <div style="background: #fff; padding: 20px; border-radius: 8px; margin-top: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <h2 style="margin-top: 0; color: #1a3a5c;">⚙️ Acțiuni de Troubleshooting</h2>

            <p style="color: #666; margin-bottom: 20px;">Utilizează aceste butoane pentru a diagnostica și repara problemele temei.</p>

            <form method="POST" style="display: flex; flex-wrap: wrap; gap: 10px;">
                <?php wp_nonce_field('saligny_theme_action', 'saligny_nonce'); ?>

                <button type="submit" name="saligny_action" value="recreate_menu" class="button button-primary" style="padding: 10px 20px; font-size: 14px;">
                    🔄 Recreaza Meniu Principal
                </button>

                <button type="submit" name="saligny_action" value="run_health_check" class="button button-secondary" style="padding: 10px 20px; font-size: 14px;">
                    🏥 Rulează Health Check
                </button>

                <button type="submit" name="saligny_action" value="flush_permalinks" class="button button-secondary" style="padding: 10px 20px; font-size: 14px;">
                    🔗 Reîncarcă Linkuri Permanente
                </button>
            </form>
        </div>

        <?php if ($has_menu && $menu_item_count > 0): ?>
            <div style="background: #fff; padding: 20px; border-radius: 8px; margin-top: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                <h2 style="margin-top: 0; color: #1a3a5c;">📋 Articole Meniu</h2>
                <ul style="columns: 2; list-style: none; padding: 0;">
                    <?php foreach ($menu_items as $item): ?>
                        <li style="padding: 6px 0; border-bottom: 1px solid #eee;">
                            <?php
                            $indent = (int) $item->menu_item_parent > 0 ? '&nbsp;&nbsp;&nbsp;&nbsp;' : '';
                            echo esc_html($indent . '• ' . $item->title);
                            ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div style="background: #f0f2f5; padding: 15px; border-radius: 8px; margin-top: 20px; border-left: 4px solid #1a3a5c;">
            <h3 style="margin-top: 0; color: #1a3a5c;">ℹ️ Informații</h3>
            <p style="margin: 8px 0; font-size: 13px;">
                <strong>Tema Saligny</strong> include verificări automate de integritate în fiecare 6 ore.
                <br>Meniu-ul principal se recreează automat dacă lipsesc articole.
                <br>Pentru asistență, contactează echipa de dezvoltare.
            </p>
        </div>
    </div>
    <?php
}

// ============================================
// CUSTOMIZER
// ============================================
require get_template_directory() . '/inc/customizer-history.php';
require get_template_directory() . '/inc/customizer-header.php';
require get_template_directory() . '/inc/customizer-footer.php';
require get_template_directory() . '/inc/customizer-front.php';
require get_template_directory() . '/inc/customizer-contact.php';

// ============================================
// DESIGNER CREDIT
// ============================================
add_action('wp_footer', function () {
    echo '<p class="designer-credit" style="text-align:center; font-size:12px;">
            Website realizat de <a href="https://github.com/retrozenith" target="_blank" rel="noopener">Cristea Florian Victor</a>
          </p>';
});
