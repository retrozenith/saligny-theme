<?php
/**
 * Page template
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

                <article class="entry-article" id="page-<?php the_ID(); ?>">
                    <div class="entry-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
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
                </article>

            <?php
endwhile; ?>

        </div>
    </div>
</main>

<?php get_footer(); ?>
