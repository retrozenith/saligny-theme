<?php
/**
 * Sidebar template
 *
 * @package Saligny_Theme
 */
?>

<aside class="site-sidebar" role="complementary">

    <!-- Category Quick Links -->
    <div class="sidebar-widget widget-categories">
        <h3 class="widget-title">Categorii</h3>
        <div class="widget-content">
            <ul>
                <?php
$sidebar_categories = array(
    'noutati' => array('icon' => 'megaphone', 'name' => 'Noutăți'),
    'activitati' => array('icon' => 'target', 'name' => 'Activități'),
    'secretariat' => array('icon' => 'clipboard', 'name' => 'Secretariat'),
    'proiecte' => array('icon' => 'building', 'name' => 'Proiecte'),
    'reviste' => array('icon' => 'newspaper', 'name' => 'Reviste'),
);

foreach ($sidebar_categories as $slug => $cat_info):
    $cat = get_category_by_slug($slug);
    if ($cat):
        $is_current = is_category($cat->term_id) ? 'current-cat' : '';
?>
                    <li class="<?php echo $is_current; ?>">
                        <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>">
                            <span class="cat-icon"><?php echo saligny_icon($cat_info['icon']); ?></span>
                            <?php echo esc_html($cat_info['name']); ?>
                        </a>
                    </li>
                <?php
    endif;
endforeach;
?>
            </ul>
        </div>
    </div>

    <!-- Secretariat ONLINE Widget -->
    <div class="sidebar-widget secretariat-widget">
        <h3 class="widget-title"><?php echo saligny_icon('clipboard'); ?> <?php echo esc_html(get_theme_mod('sidebar_secretariat_title', 'Cereri de Adeverințe ONLINE')); ?></h3>
        <div class="widget-content">
            <div class="secretariat-icon"><?php echo saligny_icon('document', '2rem'); ?></div>
            <p><strong><?php echo esc_html(get_theme_mod('sidebar_secretariat_heading', 'Secretariat ONLINE')); ?></strong></p>
            <p><?php echo esc_html(get_theme_mod('sidebar_secretariat_desc', 'Pentru orice informare, vă rugăm să vă adresați serviciului secretariat online pe mail-ul unității.')); ?></p>
            <?php
$secretariat_page = get_page_by_title('Secretariat ONLINE', OBJECT, 'page');
if ($secretariat_page):
?>
                <a href="<?php echo esc_url(get_permalink($secretariat_page->ID)); ?>" class="btn-secretariat">Află mai multe</a>
            <?php
else: ?>
                <a href="mailto:<?php echo esc_attr(get_theme_mod('sidebar_secretariat_email', 'anghel_saligny@yahoo.com')); ?>" class="btn-secretariat">Contactează-ne</a>
            <?php
endif; ?>
        </div>
    </div>

    <!-- Search -->
    <div class="sidebar-widget">
        <h3 class="widget-title"><?php echo saligny_icon('document'); ?> Căutare</h3>
        <div class="widget-content">
            <?php get_search_form(); ?>
        </div>
    </div>

    <!-- Dynamic sidebar widgets -->
    <?php if (is_active_sidebar('sidebar-1')): ?>
        <?php dynamic_sidebar('sidebar-1'); ?>
    <?php
endif; ?>

    <!-- Archives -->
    <div class="sidebar-widget">
        <h3 class="widget-title"><?php echo saligny_icon('calendar'); ?> Arhivă</h3>
        <div class="widget-content">
            <select onchange="if(this.value) window.location=this.value;">
                <option value="">Selectează luna</option>
                <?php wp_get_archives(array('type' => 'monthly', 'format' => 'option')); ?>
            </select>
        </div>
    </div>

    <!-- Tags Cloud -->
    <?php
$tags = get_tags(array('number' => 30, 'orderby' => 'count', 'order' => 'DESC'));
if (!empty($tags)):
?>
    <div class="sidebar-widget">
        <h3 class="widget-title"><?php echo saligny_icon('tag'); ?> Etichete</h3>
        <div class="widget-content">
            <div class="tagcloud">
                <?php foreach ($tags as $tag): ?>
                    <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>"><?php echo esc_html($tag->name); ?></a>
                <?php
    endforeach; ?>
            </div>
        </div>
    </div>
    <?php
endif; ?>

</aside>
