<?php
/**
 * Front Page Template
 *
 * @package Saligny_Theme
 */

get_header();
?>

<main id="main-content" class="site-content" role="main">
    <div class="content-wrap">
        <div class="main-content">

            <!-- MAIN HERO SECTION -->
            <section class="hero-main">
                <div class="hero-main__content">
                    <span class="hero-main__badge"><?php echo esc_html(get_theme_mod('front_hero_badge', 'Din 1959')); ?></span>
                    <h1 class="hero-main__title"><?php echo wp_kses_post(get_theme_mod('front_hero_title', '65 de ani de<br><span>Excelență Tehnică</span>')); ?></h1>
                    <p class="hero-main__description"><?php echo esc_html(get_theme_mod('front_hero_desc', 'Pregătim generațiile viitorului printr-o educație practică, inovatoare și adaptată cerințelor pieței muncii moderne.')); ?></p>
                    
                    <div class="hero-main__actions">
                        <a href="<?php echo esc_url(get_theme_mod('front_hero_btn1_url', home_url('/despre-noi/'))); ?>" class="btn-primary"><?php echo esc_html(get_theme_mod('front_hero_btn1_text', 'Descoperă Colegiul')); ?></a>
                        <a href="<?php echo esc_url(get_theme_mod('front_hero_btn2_url', home_url('/contact/'))); ?>" class="btn-outline"><?php echo esc_html(get_theme_mod('front_hero_btn2_text', 'Admitere & Contact')); ?></a>
                    </div>
                </div>

                <div class="hero-main__stats">
                    <?php
for ($i = 1; $i <= 3; $i++):
    $default_icons = array(1 => 'settings', 2 => 'home', 3 => 'target');
    $default_titles = array(1 => 'Profil Tehnic - Mecanică', 2 => 'Construcții & Instalații', 3 => 'Profil Sportiv');
    $default_descs = array(1 => 'Mecatronică, Întreținere și Reparații', 2 => 'Desenatori, Structuri și Finisaje', 3 => 'Instructori Sportivi');

    $icon = get_theme_mod('front_stat_icon_' . $i, $default_icons[$i]);
    $title = get_theme_mod('front_stat_title_' . $i, $default_titles[$i]);
    $desc = get_theme_mod('front_stat_desc_' . $i, $default_descs[$i]);

    if ($title):
?>
                    <div class="stat-card">
                        <span class="stat-icon"><?php echo saligny_icon($icon); ?></span>
                        <div class="stat-info">
                            <strong><?php echo esc_html($title); ?></strong>
                            <span><?php echo esc_html($desc); ?></span>
                        </div>
                    </div>
                    <?php
    endif;
endfor; ?>
                </div>
            </section>

            <!-- HERO SLIDER -->
            <div class="hero-slider" id="hero-slider">
                <?php
$slider_posts = get_posts(array(
    'posts_per_page' => 5,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'meta_query' => array(
            array(
            'key' => '_thumbnail_id',
            'compare' => 'EXISTS',
        ),
    ),
));

// If no posts with thumbnails, get latest posts regardless
if (empty($slider_posts)) {
    $slider_posts = get_posts(array(
        'posts_per_page' => 4,
        'post_status' => 'publish',
    ));
}

$i = 0;
global $post;
foreach ($slider_posts as $post):
    setup_postdata($post);
?>
                    <a href="<?php the_permalink(); ?>" class="slide <?php echo $i === 0 ? 'active' : ''; ?>" style="display:block;color:inherit;text-decoration:none;">
                        <?php if (has_post_thumbnail($post->ID)): ?>
                            <?php echo get_the_post_thumbnail($post->ID, 'saligny-slider'); ?>
                        <?php
    else: ?>
                            <div style="width:100%;height:100%;background:linear-gradient(135deg, #1a3a5c <?php echo($i * 20); ?>%, #2a5a8c <?php echo 50 + $i * 10; ?>%, #c8a84e 100%);display:flex;align-items:center;justify-content:center;">
                                <span style="color:white;font-size:3rem;opacity:0.3;"><?php echo saligny_icon('school', '3rem'); ?></span>
                            </div>
                        <?php
    endif; ?>
                        <div class="slide-overlay">
                            <div class="slide-title"><?php echo esc_html($post->post_title); ?></div>
                            <div class="slide-caption"><?php echo wp_trim_words($post->post_content, 15); ?></div>
                        </div>
                    </a>
                <?php
    $i++;
endforeach;
wp_reset_postdata();
?>

                <button class="slider-nav slider-prev" aria-label="Anterior">‹</button>
                <button class="slider-nav slider-next" aria-label="Următorul">›</button>

                <div class="slider-dots">
                    <?php for ($d = 0; $d < count($slider_posts); $d++): ?>
                        <button class="dot <?php echo $d === 0 ? 'active' : ''; ?>" data-index="<?php echo $d; ?>" aria-label="Slide <?php echo $d + 1; ?>"></button>
                    <?php
endfor; ?>
                </div>
            </div>

            <!-- WELCOME / ABOUT SECTION -->
            <div class="welcome-section fade-in-up">
                <div class="welcome-icon"><?php echo saligny_icon(get_theme_mod('front_welcome_icon', 'graduation'), '2.5rem'); ?></div>
                <h2><?php echo esc_html(get_theme_mod('front_welcome_title', 'Te interesează domeniul tehnic?')); ?></h2>
                <?php
$welcome_text = get_theme_mod('front_welcome_text');
if ($welcome_text) {
    echo wp_kses_post($welcome_text);
}
else {
    echo '<p>La Colegiul Tehnic Anghel Saligny - Bucuresti, dispunem de o paletă largă de specializări, laboratoare și ateliere moderne, dar mai ales de profesori bine pregătiți care îți vor marca evoluția profesională.</p>
                    <p>Îți dorești o carieră sportivă și ai nevoie de o îndrumare competentă? La Colegiul Tehnic Anghel Saligny, am fost și vom fi alături de numeroși campioni naționali și internaționali pe drumul lor către victorie.</p>
                    <p>Dacă vrei să îmbini utilul cu plăcutul, să-ți faci prieteni din colegii de școală și să te bucuri de experiența unor profesori valoroși într-un mediu modern, atunci noi suntem alegerea ideală.</p>';
}
?>
            </div>

            <!-- DYNAMIC CATEGORY BLOCKS -->
            <?php
$default_cats = array(
    1 => array('title' => 'Noutăți', 'icon' => 'megaphone', 'slug' => 'noutati'),
    2 => array('title' => 'Activități', 'icon' => 'target', 'slug' => 'activitati'),
    3 => array('title' => 'Proiecte', 'icon' => 'building', 'slug' => 'proiecte'),
);

$any_posts_found = false;

for ($i = 1; $i <= 3; $i++) {
    $block_title = get_theme_mod('front_cat_title_' . $i, $default_cats[$i]['title']);
    $block_icon = get_theme_mod('front_cat_icon_' . $i, $default_cats[$i]['icon']);
    $block_slug = get_theme_mod('front_cat_slug_' . $i, $default_cats[$i]['slug']);

    if ($block_slug) {
        $cat_posts = saligny_get_category_posts($block_slug, 5);
        if (!empty($cat_posts)):
            $any_posts_found = true;
?>
                        <div class="category-block">
                            <div class="category-header category-header--<?php echo esc_attr($block_slug); ?>">
                                <h2><?php echo saligny_icon($block_icon); ?> <?php echo esc_html($block_title); ?></h2>
                                <?php $cat_obj = get_category_by_slug($block_slug); ?>
                                <?php if ($cat_obj): ?>
                                    <a href="<?php echo esc_url(get_category_link($cat_obj->term_id)); ?>" class="view-all">Vezi toate →</a>
                                <?php
            endif; ?>
                            </div>
                            <div class="category-posts">
                                <?php
            global $post;
            foreach ($cat_posts as $post):
                setup_postdata($post);
?>
                                    <article class="post-card">
                                        <div class="post-card__thumb">
                                            <?php saligny_post_thumbnail('saligny-card-thumb'); ?>
                                        </div>
                                        <div class="post-card__content">
                                            <h3 class="post-card__title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h3>
                                            <div class="post-card__meta">
                                                <?php echo saligny_icon('calendar'); ?> <?php echo get_the_date('M j, Y'); ?>
                                            </div>
                                            <p class="post-card__excerpt"><?php echo wp_trim_words(get_the_content(), 25); ?></p>
                                        </div>
                                    </article>
                                <?php
            endforeach;
            wp_reset_postdata(); ?>
                            </div>
                        </div>
            <?php
        endif;
    }
}
?>

            <?php
// If no category posts exist yet, show latest posts
if (!$any_posts_found):
?>
            <div class="category-block">
                <div class="category-header category-header--noutati">
                    <h2><?php echo saligny_icon('megaphone'); ?> Ultimele Postări</h2>
                </div>
                <div class="category-posts">
                    <?php
    $latest = get_posts(array('posts_per_page' => 5, 'post_status' => 'publish'));
    global $post;
    foreach ($latest as $post):
        setup_postdata($post);
?>
                        <article class="post-card">
                            <div class="post-card__thumb">
                                <?php saligny_post_thumbnail('saligny-card-thumb'); ?>
                            </div>
                            <div class="post-card__content">
                                <h3 class="post-card__title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <div class="post-card__meta">
                                    <?php echo saligny_icon('calendar'); ?> <?php echo get_the_date(); ?>
                                </div>
                                <p class="post-card__excerpt"><?php echo wp_trim_words(get_the_content(), 25); ?></p>
                            </div>
                        </article>
                    <?php
    endforeach;
    wp_reset_postdata(); ?>
                </div>
            </div>
            <?php
endif; ?>

    </div>
</main>

<?php get_footer(); ?>
