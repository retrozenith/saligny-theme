<?php
/**
 * Default template (blog index)
 *
 * @package Saligny_Theme
 */

get_header();
?>

<main id="main-content" class="site-content" role="main">
    <div class="content-wrap">
        <div class="main-content">

            <?php if (have_posts()): ?>

                <div class="archive-header">
                    <h1 class="archive-title">Ultimele Postări</h1>
                    <p class="archive-description">Toate noutățile de la Colegiul Tehnic Anghel Saligny Bucuresti.</p>
                </div>

                <div class="posts-grid">
                    <?php while (have_posts()):
        the_post(); ?>
                        <article class="grid-post-card" id="post-<?php the_ID(); ?>">
                            <?php if (has_post_thumbnail()): ?>
                                <div class="grid-post-card__thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('saligny-featured'); ?>
                                    </a>
                                </div>
                            <?php
        endif; ?>
                            <div class="grid-post-card__body">
                                <h2 class="grid-post-card__title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <div class="grid-post-card__meta">
                                    <?php echo saligny_icon('calendar'); ?> <?php echo get_the_date(); ?> &nbsp;|&nbsp; <?php the_category(', '); ?>
                                </div>
                                <p class="grid-post-card__excerpt"><?php echo get_the_excerpt(); ?></p>
                            </div>
                        </article>
                    <?php
    endwhile; ?>
                </div>

                <div class="pagination">
                    <?php
    the_posts_pagination(array(
        'mid_size' => 2,
        'prev_text' => '← Anterior',
        'next_text' => 'Următorul →',
    ));
?>
                </div>

            <?php
else: ?>
                <div class="welcome-section">
                    <h2>Nicio postare găsită</h2>
                    <p>Nu există postări în acest moment. Reveniți în curând!</p>
                </div>
            <?php
endif; ?>

        </div>
    </div>
</main>

<?php get_footer(); ?>
