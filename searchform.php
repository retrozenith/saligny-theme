<?php
/**
 * Search form template
 *
 * @package Saligny_Theme
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label>
        <span class="sr-only"><?php esc_html_e('Căutare:', 'saligny-theme'); ?></span>
        <input type="search" class="search-field" placeholder="<?php esc_attr_e('Caută pe site...', 'saligny-theme'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
    </label>
    <button type="submit" class="search-submit">🔍</button>
</form>
