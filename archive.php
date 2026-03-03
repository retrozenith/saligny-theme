<?php
/**
 * Archive / Category template
 *
 * @package Saligny_Theme
 */

get_header();
?>

<main id="main-content" class="site-content" role="main">
    <div class="content-wrap">
        <div class="main-content">

            <div class="archive-header">
                <?php
the_archive_title('<h1 class="archive-title">', '</h1>');
the_archive_description('<p class="archive-description">', '</p>');
?>
            </div>

            <?php if (have_posts()): ?>
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
                                    <?php echo saligny_icon('calendar'); ?> <?php echo get_the_date(); ?>
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
                    <h2>Nicio postare în această categorie</h2>
                    <p>Nu există postări în această categorie momentan. Reveniți în curând!</p>
                </div>
            <?php
endif; ?>

        </div>
    </div>
</main>

<?php get_footer(); ?>
