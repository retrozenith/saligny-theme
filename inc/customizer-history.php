<?php
/**
 * Saligny Theme Customizer for History Page
 *
 * @package Saligny_Theme
 */

function saligny_history_customizer_register($wp_customize)
{

    // Panel
    $wp_customize->add_panel('saligny_history_panel', array(
        'title' => __('Istoricul Școlii (Pagina)', 'saligny-theme'),
        'description' => __('Modificați secțiunile pentru pagina "Istoricul Școlii".', 'saligny-theme'),
        'priority' => 30,
    ));

    // ==========================================
    // SECTION 1: TIMELINE
    // ==========================================
    $wp_customize->add_section('saligny_history_timeline', array(
        'title' => __('Cronologie Istoric', 'saligny-theme'),
        'panel' => 'saligny_history_panel',
        'description' => __('Adăugați până la 8 evenimente în axa timpului. Lăsați câmpul An gol pentru a ascunde elementul.', 'saligny-theme'),
    ));

    $wp_customize->add_setting('history_timeline_title', array(
        'default' => '📘 Istoric',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('history_timeline_title', array(
        'label' => __('Titlu Secțiune', 'saligny-theme'),
        'section' => 'saligny_history_timeline',
        'type' => 'text',
    ));

    // Timeline defaults
    $default_timeline = array(
        1 => array('year' => '1966', 'text' => 'La 1 septembrie se înființa „Liceul Industrial de Construcții”, funcționând inițial cu trei săli de clasă și un laborator de fizică...'),
        2 => array('year' => '1976', 'text' => 'De la 1 septembrie, școala și-a schimbat denumirea în „Liceul de Construcții nr. 1”.'),
        3 => array('year' => '1991', 'text' => 'Începând cu 1 septembrie, instituția a devenit „Grupul Școlar Industrial de Construcții Montaj nr. 1”...'),
        4 => array('year' => '1994', 'text' => 'Grupul Școlar de Construcții „Anghel Saligny” a fost selectat ca școală de demonstrație în cadrul programului Phare-VET...'),
        5 => array('year' => '2009', 'text' => 'La 1 septembrie, instituția a primit numele de Colegiul Tehnic „Anghel Saligny”, sub care funcționează și astăzi.'),
        6 => array('year' => '', 'text' => ''),
        7 => array('year' => '', 'text' => ''),
        8 => array('year' => '', 'text' => ''),
    );

    for ($i = 1; $i <= 8; $i++) {
        $wp_customize->add_setting('history_timeline_year_' . $i, array(
            'default' => $default_timeline[$i]['year'],
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('history_timeline_year_' . $i, array(
            'label' => sprintf(__('Eveniment %d - An', 'saligny-theme'), $i),
            'section' => 'saligny_history_timeline',
            'type' => 'text',
        ));

        $wp_customize->add_setting('history_timeline_text_' . $i, array(
            'default' => $default_timeline[$i]['text'],
            'sanitize_callback' => 'wp_kses_post',
        ));
        $wp_customize->add_control('history_timeline_text_' . $i, array(
            'label' => sprintf(__('Eveniment %d - Text', 'saligny-theme'), $i),
            'section' => 'saligny_history_timeline',
            'type' => 'textarea',
        ));
    }

    // ==========================================
    // SECTION 2: EDUCATIONAL OFFER
    // ==========================================
    $wp_customize->add_section('saligny_history_offer', array(
        'title' => __('Oferta Educațională', 'saligny-theme'),
        'panel' => 'saligny_history_panel',
    ));

    $wp_customize->add_setting('history_offer_title', array(
        'default' => '🎓 Oferta educațională',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('history_offer_title', array(
        'label' => __('Titlu Secțiune', 'saligny-theme'),
        'section' => 'saligny_history_offer',
        'type' => 'text',
    ));

    $wp_customize->add_setting('history_offer_text', array(
        'default' => 'Colegiul oferă o gamă largă de calificări în domeniile <strong>construcții, instalații și lucrări publice, mecanică și electric</strong>, precum și pregătire pentru <strong>instructor sportiv</strong> prin filiera vocațională.

De asemenea, unitatea școlarizează adulți prin programe de formare profesională autorizate ANC și prin Școala de Maiștri, în specializările maistru instalator pentru construcții și maistru electromecanic aparate de măsură și automatizări.

<hr class="separator">
Elevii provin atât din municipiul București, cât și din județele Ilfov, Giurgiu și Teleorman, având posibilitatea de cazare în căminul școlii în condiții civilizate și la prețuri accesibile.',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('history_offer_text', array(
        'label' => __('Conținut Text (HTML permis)', 'saligny-theme'),
        'section' => 'saligny_history_offer',
        'type' => 'textarea',
    ));

    // ==========================================
    // SECTION 3: BRIDGE / LOCAL HISTORY
    // ==========================================
    $wp_customize->add_section('saligny_history_bridge', array(
        'title' => __('Repere Istorice (Podul)', 'saligny-theme'),
        'panel' => 'saligny_history_panel',
    ));

    $wp_customize->add_setting('history_bridge_title', array(
        'default' => '🌉 Repere istorice locale',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('history_bridge_title', array(
        'label' => __('Titlu Secțiune', 'saligny-theme'),
        'section' => 'saligny_history_bridge',
        'type' => 'text',
    ));

    $wp_customize->add_setting('history_bridge_subtitle', array(
        'default' => 'Podul „Regele Carol I”',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('history_bridge_subtitle', array(
        'label' => __('Subtitlu Secțiune', 'saligny-theme'),
        'section' => 'saligny_history_bridge',
        'type' => 'text',
    ));

    $wp_customize->add_setting('history_bridge_image', array(
        'default' => get_template_directory_uri() . '/assets/img/Podul-Carol-I.png',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'history_bridge_image', array(
        'label' => __('Imagine Reprezentativă', 'saligny-theme'),
        'section  ' => 'saligny_history_bridge',
        'settings' => 'history_bridge_image',
    )));

    $wp_customize->add_setting('history_bridge_text', array(
        'default' => 'Un simbol al progresului tehnic românesc, Podul „Regele Carol I”, ce leagă Fetești de Cernavodă, este una dintre cele mai impresionante construcții inginerești ale țării.

Realizat între 1890 și 1895 sub coordonarea inginerului Anghel Saligny, podul a stabilit la acea vreme recorduri europene prin deschiderea și lungimea structurilor metalice.

Soluțiile sale tehnice inovatoare au marcat definitiv istoria infrastructurii românești și rămân un reper pentru generațiile de viitori specialiști în domeniul construcțiilor.',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('history_bridge_text', array(
        'label' => __('Conținut Descriere (HTML permis)', 'saligny-theme'),
        'section' => 'saligny_history_bridge',
        'type' => 'textarea',
    ));
}
add_action('customize_register', 'saligny_history_customizer_register');
