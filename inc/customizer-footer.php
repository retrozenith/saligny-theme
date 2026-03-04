<?php
/**
 * Saligny Theme Customizer for Footer
 *
 * @package Saligny_Theme
 */

function saligny_footer_customizer_register($wp_customize)
{

    // Panel
    $wp_customize->add_panel('saligny_footer_panel', array(
        'title' => __('Subsol (Footer)', 'saligny-theme'),
        'description' => __('Modificați informațiile afișate în subsolul site-ului.', 'saligny-theme'),
        'priority' => 25,
    ));

    // ==========================================
    // SECTION 1: SECRETARIAT (Col 2)
    // ==========================================
    $wp_customize->add_section('saligny_footer_secretariat', array(
        'title' => __('Secretariat Online', 'saligny-theme'),
        'panel' => 'saligny_footer_panel',
    ));

    $wp_customize->add_setting('footer_secretariat_title', array(
        'default' => 'Secretariat Online',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('footer_secretariat_title', array(
        'label' => __('Titlu Secțiune', 'saligny-theme'),
        'section' => 'saligny_footer_secretariat',
        'type' => 'text',
    ));

    $wp_customize->add_setting('footer_secretariat_desc', array(
        'default' => 'Pentru orice informare, vă rugăm să vă adresați serviciului secretariat online:',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('footer_secretariat_desc', array(
        'label' => __('Descriere', 'saligny-theme'),
        'section' => 'saligny_footer_secretariat',
        'type' => 'textarea',
    ));

    $wp_customize->add_setting('footer_secretariat_email', array(
        'default' => 'anghel_saligny@yahoo.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('footer_secretariat_email', array(
        'label' => __('Email', 'saligny-theme'),
        'section' => 'saligny_footer_secretariat',
        'type' => 'text',
    ));

    $wp_customize->add_setting('footer_secretariat_adresa', array(
        'default' => 'Bd. Nicolae Grigorescu nr. 12, Sector 3, București',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('footer_secretariat_adresa', array(
        'label' => __('Adresa', 'saligny-theme'),
        'section' => 'saligny_footer_secretariat',
        'type' => 'text',
    ));

    $wp_customize->add_setting('footer_secretariat_tel', array(
        'default' => '021.340.26.54',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('footer_secretariat_tel', array(
        'label' => __('Telefon', 'saligny-theme'),
        'section' => 'saligny_footer_secretariat',
        'type' => 'text',
    ));

    // ==========================================
    // SECTION 2: USEFUL LINKS (Col 3)
    // ==========================================
    $wp_customize->add_section('saligny_footer_links', array(
        'title' => __('Legături Utile', 'saligny-theme'),
        'panel' => 'saligny_footer_panel',
    ));

    $wp_customize->add_setting('footer_links_title', array(
        'default' => 'Legături Utile',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('footer_links_title', array(
        'label' => __('Titlu Secțiune', 'saligny-theme'),
        'section' => 'saligny_footer_links',
        'type' => 'text',
    ));

    for ($i = 1; $i <= 5; $i++) {
        $wp_customize->add_setting('footer_link_text_' . $i, array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('footer_link_text_' . $i, array(
            'label' => sprintf(__('Link %d - Text', 'saligny-theme'), $i),
            'section' => 'saligny_footer_links',
            'type' => 'text',
        ));

        $wp_customize->add_setting('footer_link_url_' . $i, array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control('footer_link_url_' . $i, array(
            'label' => sprintf(__('Link %d - URL', 'saligny-theme'), $i),
            'section' => 'saligny_footer_links',
            'type' => 'url',
        ));
    }

    // ==========================================
    // SECTION 3: BOTTOM / COPYRIGHT
    // ==========================================
    $wp_customize->add_section('saligny_footer_bottom', array(
        'title' => __('Drepturi de autor (Copyright)', 'saligny-theme'),
        'panel' => 'saligny_footer_panel',
    ));

    $wp_customize->add_setting('footer_copyright_text', array(
        'default' => '&copy; {year} {site_title}. Toate drepturile rezervate.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('footer_copyright_text', array(
        'label' => __('Text Copyright', 'saligny-theme'),
        'description' => __('Poți folosi {year} pentru anul curent și {site_title} pentru numele site-ului.', 'saligny-theme'),
        'section' => 'saligny_footer_bottom',
        'type' => 'text',
    ));
    // ==========================================
    // SECTION 4: SIDEBAR SECRETARIAT WIDGET
    // ==========================================
    $wp_customize->add_section('saligny_sidebar_secretariat', array(
        'title' => __('Widget Secretariat (Sidebar)', 'saligny-theme'),
        'panel' => 'saligny_footer_panel',
    ));

    $wp_customize->add_setting('sidebar_secretariat_title', array('default' => 'Cereri de Adeverințe ONLINE', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('sidebar_secretariat_title', array('label' => __('Titlu Widget', 'saligny-theme'), 'section' => 'saligny_sidebar_secretariat', 'type' => 'text'));

    $wp_customize->add_setting('sidebar_secretariat_heading', array('default' => 'Secretariat ONLINE', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('sidebar_secretariat_heading', array('label' => __('Subtitlu Bold', 'saligny-theme'), 'section' => 'saligny_sidebar_secretariat', 'type' => 'text'));

    $wp_customize->add_setting('sidebar_secretariat_desc', array('default' => 'Pentru orice informare, vă rugăm să vă adresați serviciului secretariat online pe mail-ul unității.', 'sanitize_callback' => 'sanitize_textarea_field'));
    $wp_customize->add_control('sidebar_secretariat_desc', array('label' => __('Descriere', 'saligny-theme'), 'section' => 'saligny_sidebar_secretariat', 'type' => 'textarea'));

    $wp_customize->add_setting('sidebar_secretariat_email', array('default' => 'anghel_saligny@yahoo.com', 'sanitize_callback' => 'sanitize_email'));
    $wp_customize->add_control('sidebar_secretariat_email', array('label' => __('Email Fallback', 'saligny-theme'), 'section' => 'saligny_sidebar_secretariat', 'type' => 'text'));
}
add_action('customize_register', 'saligny_footer_customizer_register');
