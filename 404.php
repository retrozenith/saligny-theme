<?php
/**
 * 404 page template
 *
 * @package Saligny_Theme
 */

get_header();
?>

<main id="main-content" class="site-content" role="main">
    <div class="content-wrap full-width">
        <div class="main-content" style="text-align: center; padding: 60px 20px;">

            <div class="welcome-section" style="max-width: 600px; margin: 0 auto;">
                <div style="font-size: 5rem; margin-bottom: 20px;"><?php echo saligny_icon('document', '5rem'); ?></div>
                <h1 class="entry-title" style="font-size: 3rem; margin-bottom: 16px;">404</h1>
                <h2 style="font-size: 1.3rem; margin-bottom: 16px; color: var(--color-text-light);">Pagina nu a fost găsită</h2>
                <p style="margin-bottom: 24px; color: var(--color-text-muted);">Ne pare rău, pagina pe care o căutați nu există sau a fost mutată.</p>

                <div style="margin-bottom: 24px;">
                    <?php get_search_form(); ?>
                </div>

                <a href="<?php echo esc_url(home_url('/')); ?>" style="display: inline-block; padding: 12px 28px; background: var(--color-primary); color: white; border-radius: var(--radius-sm); font-weight: 600; transition: all 0.2s ease;">
                    ← Înapoi la pagina principală
                </a>
            </div>

        </div>
    </div>
</main>

<?php get_footer(); ?>
