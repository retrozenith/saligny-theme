<?php
/**
 * Saligny Theme Customizer for Front Page
 *
 * @package Saligny_Theme
 */

function saligny_frontpage_customizer_register($wp_customize)
{

    // Panel
    $wp_customize->add_panel('saligny_frontpage_panel', array(
        'title' => __('Prima Pagină (Acasă)', 'saligny-theme'),
        'description' => __('Modificați secțiunile de pe prima pagină.', 'saligny-theme'),
        'priority' => 22,
    ));

    // ==========================================
    // SECTION 1: HERO (Main Hero)
    // ==========================================
    $wp_customize->add_section('saligny_front_hero', array(
        'title' => __('Secțiunea Hero (Principală)', 'saligny-theme'),
        'panel' => 'saligny_frontpage_panel',
    ));

    $wp_customize->add_setting('front_hero_badge', array(
        'default' => 'Din 1959',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('front_hero_badge', array(
        'label' => __('Insignă (Badge)', 'saligny-theme'),
        'section' => 'saligny_front_hero',
        'type' => 'text',
    ));

    $wp_customize->add_setting('front_hero_title', array(
        'default' => '65 de ani de<br><span>Excelență Tehnică</span>',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('front_hero_title', array(
        'label' => __('Titlu Principal (HTML permis)', 'saligny-theme'),
        'description' => __('Poți folosi <br> pentru linie nouă și <span> pentru culoare aurie.', 'saligny-theme'),
        'section' => 'saligny_front_hero',
        'type' => 'textarea',
    ));

    $wp_customize->add_setting('front_hero_desc', array(
        'default' => 'Pregătim generațiile viitorului printr-o educație practică, inovatoare și adaptată cerințelor pieței muncii moderne.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('front_hero_desc', array(
        'label' => __('Descriere scurtă', 'saligny-theme'),
        'section' => 'saligny_front_hero',
        'type' => 'textarea',
    ));

    // Buttons
    $wp_customize->add_setting('front_hero_btn1_text', array('default' => 'Descoperă Colegiul', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('front_hero_btn1_text', array('label' => __('Buton 1 - Text', 'saligny-theme'), 'section' => 'saligny_front_hero', 'type' => 'text'));

    $wp_customize->add_setting('front_hero_btn1_url', array('default' => home_url('/despre-noi/'), 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control('front_hero_btn1_url', array('label' => __('Buton 1 - URL', 'saligny-theme'), 'section' => 'saligny_front_hero', 'type' => 'url'));

    $wp_customize->add_setting('front_hero_btn2_text', array('default' => 'Admitere & Contact', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('front_hero_btn2_text', array('label' => __('Buton 2 - Text', 'saligny-theme'), 'section' => 'saligny_front_hero', 'type' => 'text'));

    $wp_customize->add_setting('front_hero_btn2_url', array('default' => home_url('/contact/'), 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control('front_hero_btn2_url', array('label' => __('Buton 2 - URL', 'saligny-theme'), 'section' => 'saligny_front_hero', 'type' => 'url'));

    // ==========================================
    // SECTION 2: STATS CARDS (Bottom Hero)
    // ==========================================
    $wp_customize->add_section('saligny_front_stats', array(
        'title' => __('Secțiunea Cele 3 Carduri', 'saligny-theme'),
        'description' => __('Modificați cele 3 casete informative de sub secțiunea Hero.', 'saligny-theme'),
        'panel' => 'saligny_frontpage_panel',
    ));

    $default_stats = array(
        1 => array('icon' => 'settings', 'title' => 'Profil Tehnic - Mecanică', 'desc' => 'Mecatronică, Întreținere și Reparații'),
        2 => array('icon' => 'home', 'title' => 'Construcții & Instalații', 'desc' => 'Desenatori, Structuri și Finisaje'),
        3 => array('icon' => 'target', 'title' => 'Profil Sportiv', 'desc' => 'Instructori Sportivi'),
    );

    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting('front_stat_icon_' . $i, array('default' => $default_stats[$i]['icon'], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control('front_stat_icon_' . $i, array('label' => sprintf(__('Card %d - Nume Iconiță', 'saligny-theme'), $i), 'description' => 'Ex: settings, home, target, school, building, megaphone', 'section' => 'saligny_front_stats', 'type' => 'text'));

        $wp_customize->add_setting('front_stat_title_' . $i, array('default' => $default_stats[$i]['title'], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control('front_stat_title_' . $i, array('label' => sprintf(__('Card %d - Titlu', 'saligny-theme'), $i), 'section' => 'saligny_front_stats', 'type' => 'text'));

        $wp_customize->add_setting('front_stat_desc_' . $i, array('default' => $default_stats[$i]['desc'], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control('front_stat_desc_' . $i, array('label' => sprintf(__('Card %d - Subtitlu/Desc', 'saligny-theme'), $i), 'section' => 'saligny_front_stats', 'type' => 'text'));
    }

    // ==========================================
    // SECTION 3: WELCOME SECTION
    // ==========================================
    $wp_customize->add_section('saligny_front_welcome', array(
        'title' => __('Secțiunea Bun Venit', 'saligny-theme'),
        'panel' => 'saligny_frontpage_panel',
    ));

    $wp_customize->add_setting('front_welcome_icon', array('default' => 'graduation', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('front_welcome_icon', array('label' => __('Iconiță', 'saligny-theme'), 'section' => 'saligny_front_welcome', 'type' => 'text'));

    $wp_customize->add_setting('front_welcome_title', array('default' => 'Te interesează domeniul tehnic?', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('front_welcome_title', array('label' => __('Titlu', 'saligny-theme'), 'section' => 'saligny_front_welcome', 'type' => 'text'));

    $wp_customize->add_setting('front_welcome_text', array(
        'default' => '<p>La Colegiul Tehnic Anghel Saligny - Bucuresti, dispunem de o paletă largă de specializări, laboratoare și ateliere moderne, dar mai ales de profesori bine pregătiți care îți vor marca evoluția profesională.</p>
<p>Îți dorești o carieră sportivă și ai nevoie de o îndrumare competentă? La Colegiul Tehnic Anghel Saligny, am fost și vom fi alături de numeroși campioni naționali și internaționali pe drumul lor către victorie.</p>
<p>Dacă vrei să îmbini utilul cu plăcutul, să-ți faci prieteni din colegii de școală și să te bucuri de experiența unor profesori valoroși într-un mediu modern, atunci noi suntem alegerea ideală.</p>',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('front_welcome_text', array('label' => __('Conținut Text (HTML)', 'saligny-theme'), 'section' => 'saligny_front_welcome', 'type' => 'textarea'));

    // ==========================================
    // SECTION 4: CATEGORY BLOCKS
    // ==========================================
    $wp_customize->add_section('saligny_front_cats', array(
        'title' => __('Blocuri Categorii (Blogging)', 'saligny-theme'),
        'description' => __('Configurezi ce categorii de articole sunt afișate pe prima pagină.', 'saligny-theme'),
        'panel' => 'saligny_frontpage_panel',
    ));

    $default_cats = array(
        1 => array('title' => 'Noutăți', 'icon' => 'megaphone', 'slug' => 'noutati'),
        2 => array('title' => 'Activități', 'icon' => 'target', 'slug' => 'activitati'),
        3 => array('title' => 'Proiecte', 'icon' => 'building', 'slug' => 'proiecte'),
    );

    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting('front_cat_title_' . $i, array('default' => $default_cats[$i]['title'], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control('front_cat_title_' . $i, array('label' => sprintf(__('Bloc %d - Titlu', 'saligny-theme'), $i), 'section' => 'saligny_front_cats', 'type' => 'text'));

        $wp_customize->add_setting('front_cat_icon_' . $i, array('default' => $default_cats[$i]['icon'], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control('front_cat_icon_' . $i, array('label' => sprintf(__('Bloc %d - Iconiță', 'saligny-theme'), $i), 'section' => 'saligny_front_cats', 'type' => 'text'));

        $wp_customize->add_setting('front_cat_slug_' . $i, array('default' => $default_cats[$i]['slug'], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control('front_cat_slug_' . $i, array('label' => sprintf(__('Bloc %d - Slug Categorie (Ex: noutati)', 'saligny-theme'), $i), 'section' => 'saligny_front_cats', 'type' => 'text'));
    }
}
add_action('customize_register', 'saligny_frontpage_customizer_register');
