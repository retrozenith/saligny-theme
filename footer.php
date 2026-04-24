    <footer class="site-footer" role="contentinfo">
        <div class="footer-widgets">
            <div class="footer-widget">
                <?php if (is_active_sidebar('footer-1')): ?>
                    <?php dynamic_sidebar('footer-1'); ?>
                <?php
else: ?>
                    <h3>Postări Recente</h3>
                    <ul>
                        <?php
    $recent_posts = get_posts(array('numberposts' => 5, 'post_status' => 'publish'));
    foreach ($recent_posts as $recent_post):
?>
                            <li><a href="<?php echo esc_url(get_permalink($recent_post->ID)); ?>"><?php echo esc_html($recent_post->post_title); ?></a></li>
                        <?php
    endforeach;
    wp_reset_postdata(); ?>
                    </ul>
                <?php
endif; ?>
            </div>

            <div class="footer-widget">
                <?php if (is_active_sidebar('footer-2')): ?>
                    <?php dynamic_sidebar('footer-2'); ?>
                <?php
else: ?>
                    <h3><?php echo esc_html(get_theme_mod('footer_secretariat_title', 'Secretariat Online')); ?></h3>
                    <p><?php echo esc_html(get_theme_mod('footer_secretariat_desc', 'Pentru orice informare, vă rugăm să vă adresați serviciului secretariat online:')); ?></p>
                    <p><strong><?php echo saligny_icon('email'); ?> <?php echo esc_html(get_theme_mod('footer_secretariat_email', 'anghel_saligny@yahoo.com')); ?></strong></p>
                    <p style="margin-top: 12px;"><?php echo saligny_icon('pin'); ?> <?php echo esc_html(get_theme_mod('footer_secretariat_adresa', 'Bd. Nicolae Grigorescu nr. 12, Sector 3, București')); ?></p>
                    <p><?php echo saligny_icon('phone'); ?> <?php echo esc_html(get_theme_mod('footer_secretariat_tel', '021.340.26.54')); ?></p>
                <?php
endif; ?>
            </div>

            <div class="footer-widget">
                <?php if (is_active_sidebar('footer-3')): ?>
                    <?php dynamic_sidebar('footer-3'); ?>
                <?php
else: ?>
                    <h3><?php echo esc_html(get_theme_mod('footer_links_title', 'Legături Utile')); ?></h3>
                    <ul>
                        <?php
    // Verificăm dacă există linkuri customizate, dacă nu afișăm default
    $has_custom_links = false;
    for ($i = 1; $i <= 5; $i++) {
        if (get_theme_mod('footer_link_text_' . $i)) {
            $has_custom_links = true;
            break;
        }
    }

    if ($has_custom_links) {
        for ($i = 1; $i <= 5; $i++) {
            $text = get_theme_mod('footer_link_text_' . $i);
            $url = get_theme_mod('footer_link_url_' . $i);
            if ($text && $url) {
                echo '<li><a href="' . esc_url($url) . '">' . esc_html($text) . '</a></li>';
            }
        }
    }
    else {
        // Default links
        echo '<li><a href="https://www.edu.ro/" target="_blank" rel="noopener">Ministerul Educației</a></li>';
        echo '<li><a href="https://www.ismb.edu.ro/" target="_blank" rel="noopener">ISMB</a></li>';
        echo '<li><a href="https://www.anc.edu.ro/" target="_blank" rel="noopener">Autoritatea Națională pentru Calificări</a></li>';
        echo '<li><a href="' . esc_url(home_url('/contact/')) . '">Contact</a></li>';
        echo '<li><a href="' . esc_url(home_url('/transparenta-institutionala/')) . '">Transparență Instituțională</a></li>';
    }
?>
                    </ul>
                <?php
endif; ?>
            </div>
        </div>

        <div class="footer-social-mobile">
            <?php
            $facebook_url  = get_theme_mod('header_social_facebook', 'https://facebook.com/AnghelSalignyBuc');
            $instagram_url = get_theme_mod('header_social_instagram', 'https://instagram.com/colegiulanghelsaligny');
            if ($facebook_url): ?>
                <a href="<?php echo esc_url($facebook_url); ?>" target="_blank" aria-label="Facebook" rel="noopener"><?php echo saligny_icon('facebook', '1.3rem'); ?></a>
            <?php endif; ?>
            <?php if ($instagram_url): ?>
                <a href="<?php echo esc_url($instagram_url); ?>" target="_blank" aria-label="Instagram" rel="noopener"><?php echo saligny_icon('instagram', '1.3rem'); ?></a>
            <?php endif; ?>
        </div>

        <div class="footer-bottom">
            <?php
$copyright = get_theme_mod('footer_copyright_text', '&copy; {year} {site_title}. Toate drepturile rezervate.');
$copyright = str_replace('{year}', date('Y'), $copyright);
$copyright = str_replace('{site_title}', get_bloginfo('name'), $copyright);
?>
            <p><?php echo wp_kses_post($copyright); ?></p>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
