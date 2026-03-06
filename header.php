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

<header class="w-full shadow-md sticky top-0 z-50 bg-white" id="site-header" role="banner">
    <!-- Top Bar -->
    <div class="bg-primary-dark text-white/90 text-sm py-2">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center space-y-2 sm:space-y-0 text-xs sm:text-sm">
            <div class="flex flex-wrap items-center gap-4 sm:gap-6 justify-center sm:justify-start">
                <a href="tel:0213238035" class="flex items-center space-x-2 hover:text-gold transition">
                    <?php echo saligny_icon('phone', '1rem'); ?>
                    <span>021 323 8035</span>
                </a>
                <div class="hidden md:flex items-center space-x-2">
                    <?php echo saligny_icon('pin', '1rem'); ?>
                    <span>Str. Ing. Zablovschi nr. 4, București</span>
                </div>
                <a href="mailto:anghel_saligny@yahoo.com" class="flex items-center space-x-2 hover:text-gold transition">
                    <?php echo saligny_icon('email', '1rem'); ?>
                    <span>anghel_saligny@yahoo.com</span>
                </a>
            </div>
            <div class="flex items-center space-x-4 justify-center sm:justify-end">
                <?php
$facebook_url = get_theme_mod('header_social_facebook', 'https://facebook.com/AnghelSalignyBuc');
$instagram_url = get_theme_mod('header_social_instagram', 'https://instagram.com/');
if ($facebook_url): ?>
                    <a href="<?php echo esc_url($facebook_url); ?>" target="_blank" aria-label="Facebook" rel="noopener" class="hover:text-gold transition flex items-center"><?php echo saligny_icon('facebook', '1rem'); ?></a>
                <?php
endif;
if ($instagram_url): ?>
                    <a href="<?php echo esc_url($instagram_url); ?>" target="_blank" aria-label="Instagram" rel="noopener" class="hover:text-gold transition flex items-center"><?php echo saligny_icon('instagram', '1rem'); ?></a>
                <?php
endif; ?>
                <span class="w-px h-4 bg-white/30 hidden sm:block"></span>
                <a href="#" class="flex items-center space-x-2 hover:text-gold transition font-medium">
                    <?php echo saligny_icon('user', '1rem'); ?>
                    <span>Autentificare</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6 flex flex-wrap justify-between items-center bg-white relative">
        <!-- Site Branding -->
        <div class="flex items-center space-x-4 shrink-0">
            <?php if (has_custom_logo()): ?>
                <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full border-2 border-gold overflow-hidden shrink-0">
                    <?php the_custom_logo(); ?>
                </div>
            <?php
else: ?>
                <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full border-2 border-primary-dark overflow-hidden shrink-0">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/logo.jpg'); ?>" alt="<?php bloginfo('name'); ?>" class="w-full h-full object-cover">
                </div>
            <?php
endif; ?>

            <div class="flex flex-col">
                <h1 class="font-serif text-xl sm:text-2xl lg:text-3xl font-bold text-primary-dark tracking-tight leading-tight">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-gold transition-colors"><?php bloginfo('name'); ?></a>
                </h1>
                <?php $description = get_bloginfo('description', 'display');
if ($description): ?>
                    <p class="hidden sm:block text-xs sm:text-sm text-text-muted mt-1 italic"><?php echo esc_html($description); ?></p>
                <?php
endif; ?>
            </div>
        </div>

        <!-- Mobile Menu Toggle -->
        <button class="lg:hidden flex flex-col space-y-1.5 p-2 bg-transparent border-none cursor-pointer group z-50 relative" id="menu-toggle" aria-label="<?php esc_attr_e('Meniu', 'saligny-theme'); ?>" aria-expanded="false">
            <span class="block w-6 h-0.5 bg-primary-dark transition-transform origin-center"></span>
            <span class="block w-6 h-0.5 bg-primary-dark transition-opacity"></span>
            <span class="block w-6 h-0.5 bg-primary-dark transition-transform origin-center"></span>
        </button>

        <!-- Navigation Menu -->
        <nav class="hidden lg:flex items-center flex-1 justify-end ml-8" id="main-navigation" role="navigation" aria-label="<?php esc_attr_e('Navigare principală', 'saligny-theme'); ?>">
            <?php
wp_nav_menu(array(
    'theme_location' => 'primary',
    'menu_class' => 'flex items-center space-x-2 xl:space-x-6 text-sm font-extrabold text-primary-dark uppercase tracking-wide',
    'container' => false,
    'fallback_cb' => 'saligny_fallback_menu',
    'depth' => 3,
));
?>
            <button class="ml-6 text-primary-dark hover:text-gold transition p-2" aria-label="Search">
                <svg width="1.25em" height="1.25em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </button>
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
