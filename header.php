<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo esc_attr(get_bloginfo('description')); ?>">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="sr-only" href="#main-content"><?php esc_html_e('Sari la conținut', 'saligny-theme'); ?></a>

<header class="site-header" id="site-header" role="banner">
    <div class="top-bar">
        <div class="top-bar-inner">
            <?php
            $facebook_url = get_theme_mod('header_social_facebook', 'https://facebook.com/AnghelSalignyBuc');
            $instagram_url = get_theme_mod('header_social_instagram', 'https://instagram.com/colegiulanghelsaligny');
            $contact_email = get_theme_mod('header_contact_email', 'anghel_saligny@yahoo.com');
            $contact_number = get_theme_mod('header_contact_phone', '021.340.26.54');
            $contact_address = get_theme_mod('header_contact_address', 'Bd. Nicolae Grigorescu nr. 12, Sector 3, Bucuresti');
            $contact_number_href = preg_replace('/[^0-9+]/', '', (string) $contact_number);
            ?>

            <div class="top-bar-social">
                <?php if ($facebook_url): ?>
                    <a href="<?php echo esc_url($facebook_url); ?>" target="_blank" aria-label="Facebook" rel="noopener"><?php echo saligny_icon('facebook', '1.1rem'); ?></a>
                <?php endif; ?>

                <?php if ($instagram_url): ?>
                    <a href="<?php echo esc_url($instagram_url); ?>" target="_blank" aria-label="Instagram" rel="noopener"><?php echo saligny_icon('instagram', '1.1rem'); ?></a>
                <?php endif; ?>
            </div>

            <div class="top-bar-contact">
                <?php if ($contact_email): ?>
                    <p>
                        <?php echo saligny_icon('email'); ?>
                        <a href="mailto:<?php echo esc_attr($contact_email); ?>"><?php echo esc_html($contact_email); ?></a>
                    </p>
                <?php endif; ?>

                <?php if ($contact_address): ?>
                    <p>
                        <?php echo saligny_icon('pin'); ?>
                        <?php echo esc_html($contact_address); ?>
                    </p>
                <?php endif; ?>

                <?php if ($contact_number): ?>
                    <p>
                        <?php echo saligny_icon('phone'); ?>
                        <a href="tel:<?php echo esc_attr($contact_number_href); ?>"><?php echo esc_html($contact_number); ?></a>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="header-inner">
        <div class="site-branding">
            <?php if (has_custom_logo()): ?>
                <div class="site-logo">
                    <?php the_custom_logo(); ?>
                </div>
            <?php
else: ?>
                <div class="site-logo">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/logo.jpg'); ?>" alt="<?php bloginfo('name'); ?>" width="60" height="60">
                </div>
            <?php
endif; ?>

            <div class="site-title-group">
                <h1 class="site-title">
                    <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
                </h1>
                <?php
$description = get_bloginfo('description', 'display');
if ($description): ?>
                    <p class="site-tagline"><?php echo esc_html($description); ?></p>
                <?php
endif; ?>
            </div>
        </div>

        <button class="menu-toggle" id="menu-toggle" aria-label="<?php esc_attr_e('Meniu', 'saligny-theme'); ?>" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav class="main-navigation" id="main-navigation" role="navigation" aria-label="<?php esc_attr_e('Navigare principală', 'saligny-theme'); ?>">
            <div class="mobile-menu-header">
                <span class="mobile-menu-title">Meniu</span>
                <button class="menu-close" id="menu-close" aria-label="Închide meniul">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>
                </button>
            </div>
            <?php
wp_nav_menu(array(
    'theme_location' => 'primary',
    'menu_class' => 'nav-menu',
    'container' => false,
    'fallback_cb' => 'saligny_fallback_menu',
    'depth' => 3,
));
?>
        </nav>
        <div class="nav-overlay" id="nav-overlay"></div>
    </div>
</header>

<?php
// Fallback menu if no custom menu is set
function saligny_fallback_menu()
{
    echo '<ul class="nav-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">Acasă</a></li>';

    $pages = get_pages(array('sort_column' => 'menu_order', 'number' => 7));
    foreach ($pages as $page) {
        echo '<li><a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html($page->post_title) . '</a></li>';
    }
    echo '</ul>';
}
?>
