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
    <!-- Top Bar (Dark Blue) -->
    <div class="bg-primary text-white py-2.5 hidden sm:block">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center text-[13px] font-sans">
            <div class="flex flex-wrap items-center gap-8">
                <a href="tel:0213105234" class="flex items-center gap-2.5 hover:text-white/80 transition">
                    <span class="text-secondary text-base">📞</span> <span class="font-medium tracking-wide">021 310 52 34</span>
                </a>
                <div class="flex items-center gap-2.5">
                    <span class="text-secondary text-base">📍</span> <span class="font-medium tracking-wide">Str. Sf. Apostoli, Nr. 20, Sector 5, București</span>
                </div>
                <a href="mailto:secretariat@ctas.ro" class="flex items-center gap-2.5 hover:text-white/80 transition">
                    <span class="text-secondary text-base">✉️</span> <span class="font-medium tracking-wide">secretariat@ctas.ro</span>
                </a>
            </div>
            <div class="flex items-center">
                <a href="#" class="flex items-center gap-2.5 hover:text-white/80 transition font-medium border-l border-white/20 pl-6 py-1">
                    <span class="text-secondary text-base">👤</span> <span>Autentificare</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Header (White) -->
    <div class="bg-white border-b border-border shadow-sm">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-4 sm:py-6 flex flex-wrap justify-between items-center gap-4">
            
            <!-- Site Branding -->
            <div class="flex items-center shrink-0">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center gap-4 no-underline shrink-0 group">
                    <div class="w-14 h-14 sm:w-16 sm:h-16 bg-secondary text-white flex items-center justify-center font-heading font-extrabold text-[20px] sm:text-[24px] tracking-tighter relative overflow-hidden shrink-0 rounded-sm shadow-md transition-transform group-hover:scale-105">
                        CAS
                    </div>
                    <div class="flex flex-col justify-center">
                        <h1 class="font-heading text-[18px] sm:text-[22px] font-extrabold text-primary tracking-tight uppercase leading-none mb-1">
                            Colegiul Tehnic
                        </h1>
                        <span class="text-text-main text-[13px] sm:text-[14px] font-bold tracking-[0.15em] uppercase text-secondary">
                            Anghel Saligny
                        </span>
                    </div>
                </a>
            </div>

            <!-- Mobile Menu Toggle -->
            <button class="lg:hidden flex flex-col space-y-1.5 p-2 bg-transparent border-none cursor-pointer z-50 relative ml-auto" id="menu-toggle" aria-label="<?php esc_attr_e('Meniu', 'saligny-theme'); ?>" aria-expanded="false">
                <span class="block w-6 h-[2px] bg-primary transition-transform origin-center"></span>
                <span class="block w-6 h-[2px] bg-primary transition-opacity"></span>
                <span class="block w-6 h-[2px] bg-primary transition-transform origin-center"></span>
            </button>
                <span class="block w-6 h-[2px] bg-primary transition-opacity"></span>
                <span class="block w-6 h-[2px] bg-primary transition-transform origin-center"></span>
            </button>

            <!-- Navigation Menu -->
            <nav class="hidden lg:flex items-center" id="main-navigation" role="navigation" aria-label="<?php esc_attr_e('Navigare principală', 'saligny-theme'); ?>">
                <?php
wp_nav_menu(array(
    'theme_location' => 'primary',
    'menu_class' => 'flex items-center m-0 p-0 list-none gap-2 xl:gap-8 font-heading text-[14px] font-bold text-text-main',
    'container' => false,
    'fallback_cb' => 'saligny_fallback_menu',
    'depth' => 3,
));
?>
            </nav>
            
        </div>
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
