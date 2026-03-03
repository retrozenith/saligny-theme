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
