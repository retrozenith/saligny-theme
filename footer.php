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
    $recent_posts = wp_get_recent_posts(array('numberposts' => 5, 'post_status' => 'publish'));
    foreach ($recent_posts as $post):
?>
                            <li><a href="<?php echo esc_url(get_permalink($post['ID'])); ?>"><?php echo esc_html($post['post_title']); ?></a></li>
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
                    <h3>Secretariat Online</h3>
                    <p>Pentru orice informare, vă rugăm să vă adresați serviciului secretariat online:</p>
                    <p><strong>📧 anghel_saligny@yahoo.com</strong></p>
                    <p style="margin-top: 12px;">📍 Bd. Nicolae Grigorescu nr. 12, Sector 3, București</p>
                    <p>📞 021.340.26.54</p>
                <?php
endif; ?>
            </div>

            <div class="footer-widget">
                <?php if (is_active_sidebar('footer-3')): ?>
                    <?php dynamic_sidebar('footer-3'); ?>
                <?php
else: ?>
                    <h3>Legături Utile</h3>
                    <ul>
                        <li><a href="https://www.edu.ro/" target="_blank" rel="noopener">Ministerul Educației</a></li>
                        <li><a href="https://www.ismb.edu.ro/" target="_blank" rel="noopener">ISMB</a></li>
                        <li><a href="https://www.anc.edu.ro/" target="_blank" rel="noopener">Autoritatea Națională pentru Calificări</a></li>
                        <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a></li>
                        <li><a href="<?php echo esc_url(home_url('/transparenta-institutionala/')); ?>">Transparență Instituțională</a></li>
                    </ul>
                <?php
endif; ?>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Toate drepturile rezervate.</p>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
