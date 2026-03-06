<?php
/**
 * Saligny Theme Customizer for Contact Page
 *
 * @package Saligny_Theme
 */

function saligny_contact_customizer_register($wp_customize)
{

    // Panel
    $wp_customize->add_panel('saligny_contact_panel', array(
        'title' => __('Pagina de Contact', 'saligny-theme'),
        'description' => __('Modificați datele afișate pe pagina de Contact.', 'saligny-theme'),
        'priority' => 24,
    ));

    // ==========================================
    // SECTION 1: CONTACT DETAILS
    // ==========================================
    $wp_customize->add_section('saligny_contact_details', array(
        'title' => __('Date de Contact', 'saligny-theme'),
        'panel' => 'saligny_contact_panel',
    ));

    // Address
    $wp_customize->add_setting('contact_address', array(
        'default' => 'Bulevardul Nicolae Grigorescu nr. 12<br>Sector 3, București',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('contact_address', array('label' => __('Adresa Fizică', 'saligny-theme'), 'section' => 'saligny_contact_details', 'type' => 'textarea'));

    // Phone / Fax
    $wp_customize->add_setting('contact_phone_text', array(
        'default' => 'Tel: <a href="tel:+40213402654">021.340.26.54</a><br>Fax: 021.340.26.54',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('contact_phone_text', array('label' => __('Telefon & Fax', 'saligny-theme'), 'section' => 'saligny_contact_details', 'type' => 'textarea'));

    // Email
    $wp_customize->add_setting('contact_email_text', array(
        'default' => '<a href="mailto:anghel_saligny@yahoo.com">anghel_saligny@yahoo.com</a>',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('contact_email_text', array('label' => __('Email-uri', 'saligny-theme'), 'section' => 'saligny_contact_details', 'type' => 'textarea'));

    // Website
    $wp_customize->add_setting('contact_website_text', array(
        'default' => '<a href="https://www.anghel-saligny.info.ro" target="_blank" rel="noopener">www.anghel-saligny.info.ro</a>',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('contact_website_text', array('label' => __('Website Oficial', 'saligny-theme'), 'section' => 'saligny_contact_details', 'type' => 'textarea'));

    // Transport
    $wp_customize->add_setting('contact_transport_text', array(
        'default' => '<strong>Autobuz:</strong> 101, 102, 253, 330, 335<br>
<strong>Troleibuz:</strong> 70, 79, 92<br>
<strong>Tramvai:</strong> 36, 40, 55<br>
<strong>Metrou:</strong> Stația Titan',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('contact_transport_text', array('label' => __('Transport', 'saligny-theme'), 'section' => 'saligny_contact_details', 'type' => 'textarea'));

    // ==========================================
    // SECTION 2: SCHEDULE
    // ==========================================
    $wp_customize->add_section('saligny_contact_schedule', array(
        'title' => __('Program Secretariat', 'saligny-theme'),
        'panel' => 'saligny_contact_panel',
    ));

    $wp_customize->add_setting('contact_schedule_weekdays', array(
        'default' => '08:00 – 16:00',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('contact_schedule_weekdays', array('label' => __('Luni – Vineri', 'saligny-theme'), 'section' => 'saligny_contact_schedule', 'type' => 'text'));

    $wp_customize->add_setting('contact_schedule_weekend', array(
        'default' => 'Închis',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('contact_schedule_weekend', array('label' => __('Sâmbătă – Duminică', 'saligny-theme'), 'section' => 'saligny_contact_schedule', 'type' => 'text'));

}
add_action('customize_register', 'saligny_contact_customizer_register');
