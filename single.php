<?php
/**
 * Single post template
 *
 * @package Saligny_Theme
 */

get_header();
?>

<main id="main-content" class="site-content" role="main">
    <div class="content-wrap">
        <div class="main-content">

            <?php while (have_posts()):
    the_post(); ?>

                <article class="entry-article" id="post-<?php the_ID(); ?>">
                    <div class="entry-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                        <div class="entry-meta">
                            <span>📅 <?php echo get_the_date(); ?></span>
                            <span>👤 <?php the_author(); ?></span>
                            <span>📁 <?php the_category(', '); ?></span>
                        </div>
                    </div>

                    <?php if (has_post_thumbnail()): ?>
                        <div class="entry-thumbnail">
                            <?php the_post_thumbnail('saligny-featured'); ?>
                        </div>
                    <?php
    endif; ?>

                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>

                    <?php
    $tags_list = get_the_tag_list('', ', ');
    if ($tags_list):
?>
                        <div class="entry-footer-meta">
                            <span>🏷️ Etichete: <?php echo $tags_list; ?></span>
                        </div>
                    <?php
    endif; ?>
                </article>

                <!-- Post Navigation -->
                <div class="post-navigation">
                    <?php
    $prev_post = get_previous_post();
    $next_post = get_next_post();
?>
                    <?php if ($prev_post): ?>
                        <a href="<?php echo esc_url(get_permalink($prev_post)); ?>">
                            <span class="nav-label">← Anterior</span>
                            <?php echo esc_html($prev_post->post_title); ?>
                        </a>
                    <?php
    else: ?>
                        <span></span>
                    <?php
    endif; ?>

                    <?php if ($next_post): ?>
                        <a href="<?php echo esc_url(get_permalink($next_post)); ?>" style="text-align: right;">
                            <span class="nav-label">Următorul →</span>
                            <?php echo esc_html($next_post->post_title); ?>
                        </a>
                    <?php
    else: ?>
                        <span></span>
                    <?php
    endif; ?>
                </div>

            <?php
endwhile; ?>

        </div>

        <?php get_sidebar(); ?>
    </div>
</main>

<?php get_footer(); ?>
