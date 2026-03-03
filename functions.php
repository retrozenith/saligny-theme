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

    // Theme JavaScript
    wp_enqueue_script('saligny-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0.0', true);

    // Slider script
    wp_enqueue_script('saligny-slider', get_template_directory_uri() . '/js/slider.js', array(), '1.0.0', true);
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
    );
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

    // Create pages
    $pages = array(
        'Despre Noi' => 'Colegiul Tehnic Anghel Saligny Bucuresti este o instituție de învățământ cu tradiție, oferind specializări tehnice și vocaționale de înaltă calitate.',
        'Istoricul Școlii' => 'Colegiul Tehnic „Anghel Saligny" din București are o istorie bogată, fiind una dintre cele mai vechi și prestigioase instituții de învățământ tehnic din România.',
        'Inginerul Anghel Saligny' => 'Anghel Saligny (1854-1925) a fost un inginer român, considerat unul dintre cei mai mari ingineri constructori din istoria României.',
        'Misiune si Viziune' => 'Misiunea noastră este de a forma specialiști competenți în domeniul tehnic, capabili să răspundă cerințelor pieței muncii.',
        'Educatie' => 'Oferta noastră educațională cuprinde filiera tehnologică și filiera vocațională, cu multiple specializări.',
        'Profilul Educational' => 'Colegiul oferă o gamă largă de calificări profesionale în domenii tehnice și vocaționale.',
        'Calificări și Curriculum' => 'Calificările oferite de colegiul nostru sunt recunoscute la nivel european.',
        'Baza Materiala' => 'Colegiul dispune de laboratoare moderne, ateliere echipate și săli de clasă confortabile.',
        'Contact' => '<h3>Adresa</h3><p>Str. Ing. Zablovschi nr. 4, Sector 3, 031534 București</p><h3>Telefon</h3><p>021 323 8035</p><h3>Email</h3><p>anghel_saligny@yahoo.com</p>',
        'Secretariat ONLINE' => 'Pentru orice informare, va rugam sa va adresati serviciului secretariat in mediul on-line pe mail-ul unitatii: anghel_saligny@yahoo.com',
        'Management' => 'Echipa de conducere a Colegiului Tehnic Anghel Saligny.',
        'Transparenta Institutionala' => 'Informații publice conform Legii nr. 544/2001 privind liberul acces la informațiile de interes public.',
    );

    foreach ($pages as $title => $content) {
        $existing = get_page_by_title($title, OBJECT, 'page');
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
            'title' => 'Bine ați venit pe noul site al Colegiului Tehnic Anghel Saligny!',
            'content' => 'Suntem bucuroși să vă prezentăm noul website al Colegiului Tehnic Anghel Saligny Bucuresti. Aici veți găsi toate informațiile necesare despre oferta noastră educațională, activitățile desfășurate și proiectele școlii.',
            'category' => 'noutati',
        ),
            array(
            'title' => 'Începere an școlar 2025-2026',
            'content' => 'ANUNȚ! Luni, 08.09.2025, ora 8.30, elevii sunt așteptați de profesorii diriginți în sala lor de clasă, pentru a li se comunica programul pentru prima săptămână de școală.',
            'category' => 'noutati',
        ),
            array(
            'title' => 'De la formare profesională la performanță internațională',
            'content' => 'În perioada 2–6 decembrie 2025, Colegiul Tehnic „Anghel Saligny" din București a participat, în calitate de invitat internațional, la competiția WorldSkills Polonia – Gdansk 2025. Elevii noștri au reprezentat România cu mândrie și profesionalism.',
            'category' => 'activitati',
        ),
            array(
            'title' => 'Performanță remarcabilă la competiția națională WorldSkills România',
            'content' => 'În data de 22 mai 2025, Colegiul Tehnic „Anghel Saligny" a fost reprezentat cu succes la prima ediție a competiției WorldSkills România, Secțiunea Instalatori.',
            'category' => 'activitati',
        ),
            array(
            'title' => 'Procedura de selecție participanți mobilități Erasmus+ VET 2025-2026',
            'content' => 'Anunțăm deschiderea procedurii de selecție a participanților la mobilitățile Erasmus+ VET pentru anul școlar 2025-2026.',
            'category' => 'proiecte',
        ),
            array(
            'title' => 'Activități Erasmus+ - European Internship for Compensation Systems',
            'content' => 'Colegiul a participat cu succes la proiectul Erasmus+ „European Internship for Compensation Systems" derulat în Turcia, în luna iunie 2023.',
            'category' => 'proiecte',
        ),
    );

    foreach ($sample_posts as $post_data) {
        $existing = get_page_by_title($post_data['title'], OBJECT, 'post');
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
            // Despre Noi
            $despre_noi_page = get_page_by_title('Despre Noi', OBJECT, 'page');
            $despre_id = wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Despre Noi',
                'menu-item-object-id' => $despre_noi_page ? $despre_noi_page->ID : 0,
                'menu-item-object' => 'page',
                'menu-item-type' => $despre_noi_page ? 'post_type' : 'custom',
                'menu-item-url' => $despre_noi_page ? '' : home_url('/'),
                'menu-item-status' => 'publish',
            ));

            // Sub-items for Despre Noi
            $sub_pages = array('Istoricul Școlii', 'Inginerul Anghel Saligny', 'Misiune si Viziune', 'Educatie', 'Baza Materiala', 'Management', 'Transparenta Institutionala');
            foreach ($sub_pages as $sub_title) {
                $sub_page = get_page_by_title($sub_title, OBJECT, 'page');
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

            // Proiecte (category link)
            $proiecte_cat = get_category_by_slug('proiecte');
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Proiecte',
                'menu-item-url' => $proiecte_cat ? get_category_link($proiecte_cat->term_id) : home_url('/category/proiecte/'),
                'menu-item-type' => 'custom',
                'menu-item-status' => 'publish',
            ));

            // Activitati
            $activitati_cat = get_category_by_slug('activitati');
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Activitati',
                'menu-item-url' => $activitati_cat ? get_category_link($activitati_cat->term_id) : home_url('/category/activitati/'),
                'menu-item-type' => 'custom',
                'menu-item-status' => 'publish',
            ));

            // Reviste
            $reviste_cat = get_category_by_slug('reviste');
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Reviste',
                'menu-item-url' => $reviste_cat ? get_category_link($reviste_cat->term_id) : home_url('/category/reviste/'),
                'menu-item-type' => 'custom',
                'menu-item-status' => 'publish',
            ));

            // Secretariat
            $secretariat_page = get_page_by_title('Secretariat ONLINE', OBJECT, 'page');
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Secretariat',
                'menu-item-object-id' => $secretariat_page ? $secretariat_page->ID : 0,
                'menu-item-object' => 'page',
                'menu-item-type' => $secretariat_page ? 'post_type' : 'custom',
                'menu-item-url' => $secretariat_page ? '' : home_url('/'),
                'menu-item-status' => 'publish',
            ));

            // Contact
            $contact_page = get_page_by_title('Contact', OBJECT, 'page');
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
    update_option('blogname', 'Colegiul Tehnic Anghel Saligny Bucuresti');

    // Set permalink structure
    update_option('permalink_structure', '/%postname%/');
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'saligny_theme_activation');

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
// DESIGNER CREDIT
// ============================================
add_action('wp_footer', function () {
    echo '<p class="designer-credit" style="text-align:center; font-size:12px;">
            Website realizat de <a href="https://github.com/retrozenith" target="_blank" rel="noopener">Cristea Florian Victor</a>
          </p>';
});
