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
foreach ($slider_posts as $post):
    setup_postdata($post);
?>
                    <div class="slide <?php echo $i === 0 ? 'active' : ''; ?>">
                        <?php if (has_post_thumbnail($post->ID)): ?>
                            <?php echo get_the_post_thumbnail($post->ID, 'saligny-slider'); ?>
                        <?php
    else: ?>
                            <div style="width:100%;height:100%;background:linear-gradient(135deg, #1a3a5c <?php echo($i * 20); ?>%, #2a5a8c <?php echo 50 + $i * 10; ?>%, #c8a84e 100%);display:flex;align-items:center;justify-content:center;">
                                <span style="color:white;font-size:3rem;opacity:0.3;">🏫</span>
                            </div>
                        <?php
    endif; ?>
                        <div class="slide-overlay">
                            <div class="slide-title"><?php echo esc_html($post->post_title); ?></div>
                            <div class="slide-caption"><?php echo wp_trim_words($post->post_content, 15); ?></div>
                        </div>
                    </div>
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
                <div class="welcome-icon">🎓</div>
                <h2>Te interesează domeniul tehnic?</h2>
                <p>La Colegiul Tehnic Anghel Saligny - Bucuresti, dispunem de o paletă largă de specializări, laboratoare și ateliere moderne, dar mai ales de profesori bine pregătiți care îți vor marca evoluția profesională.</p>
                <p>Îți dorești o carieră sportivă și ai nevoie de o îndrumare competentă? La Colegiul Tehnic Anghel Saligny, am fost și vom fi alături de numeroși campioni naționali și internaționali pe drumul lor către victorie.</p>
                <p>Dacă vrei să îmbini utilul cu plăcutul, să-ți faci prieteni din colegii de școală și să te bucuri de experiența unor profesori valoroși într-un mediu modern, atunci noi suntem alegerea ideală.</p>
            </div>

            <!-- NOUTATI SECTION -->
            <?php
$noutati_posts = saligny_get_category_posts('noutati', 5);
if (!empty($noutati_posts)):
?>
            <div class="category-block">
                <div class="category-header category-header--noutati">
                    <h2>📢 Noutăți</h2>
                    <?php $noutati_cat = get_category_by_slug('noutati'); ?>
                    <?php if ($noutati_cat): ?>
                        <a href="<?php echo esc_url(get_category_link($noutati_cat->term_id)); ?>" class="view-all">Vezi toate →</a>
                    <?php
    endif; ?>
                </div>
                <div class="category-posts">
                    <?php foreach ($noutati_posts as $post):
        setup_postdata($post); ?>
                        <article class="post-card">
                            <div class="post-card__thumb">
                                <?php saligny_post_thumbnail('saligny-card-thumb'); ?>
                            </div>
                            <div class="post-card__content">
                                <h3 class="post-card__title">
                                    <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html($post->post_title); ?></a>
                                </h3>
                                <div class="post-card__meta">
                                    📅 <?php echo get_the_date('M j, Y', $post->ID); ?>
                                </div>
                                <p class="post-card__excerpt"><?php echo wp_trim_words($post->post_content, 25); ?></p>
                            </div>
                        </article>
                    <?php
    endforeach;
    wp_reset_postdata(); ?>
                </div>
            </div>
            <?php
endif; ?>

            <!-- ACTIVITATI SECTION -->
            <?php
$activitati_posts = saligny_get_category_posts('activitati', 5);
if (!empty($activitati_posts)):
?>
            <div class="category-block">
                <div class="category-header category-header--activitati">
                    <h2>🎯 Activități</h2>
                    <?php $activitati_cat = get_category_by_slug('activitati'); ?>
                    <?php if ($activitati_cat): ?>
                        <a href="<?php echo esc_url(get_category_link($activitati_cat->term_id)); ?>" class="view-all">Vezi toate →</a>
                    <?php
    endif; ?>
                </div>
                <div class="category-posts">
                    <?php foreach ($activitati_posts as $post):
        setup_postdata($post); ?>
                        <article class="post-card">
                            <div class="post-card__thumb">
                                <?php saligny_post_thumbnail('saligny-card-thumb'); ?>
                            </div>
                            <div class="post-card__content">
                                <h3 class="post-card__title">
                                    <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html($post->post_title); ?></a>
                                </h3>
                                <div class="post-card__meta">
                                    📅 <?php echo get_the_date('M j, Y', $post->ID); ?>
                                </div>
                                <p class="post-card__excerpt"><?php echo wp_trim_words($post->post_content, 25); ?></p>
                            </div>
                        </article>
                    <?php
    endforeach;
    wp_reset_postdata(); ?>
                </div>
            </div>
            <?php
endif; ?>

            <!-- PROIECTE SECTION -->
            <?php
$proiecte_posts = saligny_get_category_posts('proiecte', 5);
if (!empty($proiecte_posts)):
?>
            <div class="category-block">
                <div class="category-header category-header--proiecte">
                    <h2>🏗️ Proiecte</h2>
                    <?php $proiecte_cat = get_category_by_slug('proiecte'); ?>
                    <?php if ($proiecte_cat): ?>
                        <a href="<?php echo esc_url(get_category_link($proiecte_cat->term_id)); ?>" class="view-all">Vezi toate →</a>
                    <?php
    endif; ?>
                </div>
                <div class="category-posts">
                    <?php foreach ($proiecte_posts as $post):
        setup_postdata($post); ?>
                        <article class="post-card">
                            <div class="post-card__thumb">
                                <?php saligny_post_thumbnail('saligny-card-thumb'); ?>
                            </div>
                            <div class="post-card__content">
                                <h3 class="post-card__title">
                                    <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html($post->post_title); ?></a>
                                </h3>
                                <div class="post-card__meta">
                                    📅 <?php echo get_the_date('M j, Y', $post->ID); ?>
                                </div>
                                <p class="post-card__excerpt"><?php echo wp_trim_words($post->post_content, 25); ?></p>
                            </div>
                        </article>
                    <?php
    endforeach;
    wp_reset_postdata(); ?>
                </div>
            </div>
            <?php
endif; ?>

            <?php
// If no category posts exist yet, show latest posts
if (empty($noutati_posts) && empty($activitati_posts) && empty($proiecte_posts)):
?>
            <div class="category-block">
                <div class="category-header category-header--noutati">
                    <h2>📢 Ultimele Postări</h2>
                </div>
                <div class="category-posts">
                    <?php
    $latest = get_posts(array('posts_per_page' => 5, 'post_status' => 'publish'));
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
                                    📅 <?php echo get_the_date(); ?>
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

        <?php get_sidebar(); ?>
    </div>
</main>

<?php get_footer(); ?>
