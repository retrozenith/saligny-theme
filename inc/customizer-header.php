<?php
/**
 * Saligny Theme Customizer for Header
 *
 * @package Saligny_Theme
 */

function saligny_header_customizer_register($wp_customize)
{

    // Section
    $wp_customize->add_section('saligny_header_options', array(
        'title' => __('Antet (Header)', 'saligny-theme'),
        'description' => __('Modificați linkurile sociale din bara de sus.', 'saligny-theme'),
        'priority' => 20,
    ));

    // Facebook
    $wp_customize->add_setting('header_social_facebook', array(
        'default' => 'https://facebook.com/AnghelSalignyBuc',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('header_social_facebook', array(
        'label' => __('Link Facebook', 'saligny-theme'),
        'section' => 'saligny_header_options',
        'type' => 'url',
    ));

    // Instagram
    $wp_customize->add_setting('header_social_instagram', array(
        'default' => 'https://instagram.com/',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('header_social_instagram', array(
        'label' => __('Link Instagram', 'saligny-theme'),
        'section' => 'saligny_header_options',
        'type' => 'url',
    ));
}
add_action('customize_register', 'saligny_header_customizer_register');
