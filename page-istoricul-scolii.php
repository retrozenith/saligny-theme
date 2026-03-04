<?php
/**
 * Template Name: Pagina Istoric
 * 
 * @package Saligny_Theme
 */

get_header();
?>

<main id="main-content" class="site-content" role="main">
    <div class="content-wrap">
        <article class="entry-article page-istoric">
            <div class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
            </div>

            <div class="entry-content">
                
                <section class="istoric-section">
                    <h2 class="section-title"><?php echo esc_html(get_theme_mod('history_timeline_title', '📘 Istoric')); ?></h2>
                    <div class="timeline">
                        <?php
$default_timeline = array(
    1 => array('year' => '1966', 'text' => 'La 1 septembrie se înființa „Liceul Industrial de Construcții", funcționând inițial cu trei săli de clasă și un laborator de fizică...'),
    2 => array('year' => '1976', 'text' => 'De la 1 septembrie, școala și-a schimbat denumirea în „Liceul de Construcții nr. 1".'),
    3 => array('year' => '1991', 'text' => 'Începând cu 1 septembrie, instituția a devenit „Grupul Școlar Industrial de Construcții Montaj nr. 1"...'),
    4 => array('year' => '1994', 'text' => 'Grupul Școlar de Construcții „Anghel Saligny" a fost selectat ca școală de demonstrație în cadrul programului Phare-VET...'),
    5 => array('year' => '2009', 'text' => 'La 1 septembrie, instituția a primit numele de Colegiul Tehnic „Anghel Saligny", sub care funcționează și astăzi.'),
    6 => array('year' => '', 'text' => ''),
    7 => array('year' => '', 'text' => ''),
    8 => array('year' => '', 'text' => ''),
);
for ($i = 1; $i <= 8; $i++):
    $year = get_theme_mod('history_timeline_year_' . $i, $default_timeline[$i]['year']);
    $text = get_theme_mod('history_timeline_text_' . $i, $default_timeline[$i]['text']);
    if (!empty($year) && !empty($text)):
?>
                                <div class="timeline-item">
                                    <div class="timeline-year"><?php echo esc_html($year); ?></div>
                                    <div class="timeline-content">
                                        <p><?php echo wp_kses_post($text); ?></p>
                                    </div>
                                </div>
                        <?php
    endif;
endfor;
?>
                    </div>
                </section>

                <section class="istoric-section offer-section">
                    <h2 class="section-title"><?php echo esc_html(get_theme_mod('history_offer_title', '🎓 Oferta educațională')); ?></h2>
                    <div class="offer-content">
                        <?php
$offer_content = get_theme_mod('history_offer_text');
if ($offer_content) {
    echo wp_kses_post($offer_content);
}
else {
    echo '<p>Colegiul oferă o gamă largă de calificări în domeniile <strong>construcții, instalații și lucrări publice, mecanică și electric</strong>, precum și pregătire pentru <strong>instructor sportiv</strong> prin filiera vocațională.</p>
                            <p>De asemenea, unitatea școlarizează adulți prin programe de formare profesională autorizate ANC și prin Școala de Maiștri, în specializările maistru instalator pentru construcții și maistru electromecanic aparate de măsură și automatizări.</p>
                            <hr class="separator">
                            <p>Elevii provin atât din municipiul București, cât și din județele Ilfov, Giurgiu și Teleorman, având posibilitatea de cazare în căminul școlii în condiții civilizate și la prețuri accesibile.</p>';
}
?>
                    </div>
                </section>

                <section class="istoric-section bridge-section">
                    <h2 class="section-title">
                        <?php echo esc_html(get_theme_mod('history_bridge_title', '🌉 Repere istorice locale')); ?> 
                        <br><small><?php echo esc_html(get_theme_mod('history_bridge_subtitle', 'Podul „Regele Carol I”')); ?></small>
                    </h2>
                    <div class="bridge-grid">
                        <div class="bridge-image">
                            <?php
$bridge_img = get_theme_mod('history_bridge_image', get_template_directory_uri() . '/assets/img/Podul-Carol-I.png');
if ($bridge_img):
?>
                                <img src="<?php echo esc_url($bridge_img); ?>" alt="Podul Regele Carol I">
                            <?php
endif; ?>
                        </div>
                        <div class="bridge-text">
                            <?php
$bridge_text = get_theme_mod('history_bridge_text');
if ($bridge_text) {
    // Afisam paragrafe
    echo wpautop(wp_kses_post($bridge_text));
}
else {
?>
                                <p>Un simbol al progresului tehnic românesc, Podul „Regele Carol I”, ce leagă Fetești de Cernavodă, este una dintre cele mai impresionante construcții inginerești ale țării.</p>
                                <p>Realizat între 1890 și 1895 sub coordonarea inginerului Anghel Saligny, podul a stabilit la acea vreme recorduri europene prin deschiderea și lungimea structurilor metalice.</p>
                                <p>Soluțiile sale tehnice inovatoare au marcat definitiv istoria infrastructurii românești și rămân un reper pentru generațiile de viitori specialiști în domeniul construcțiilor.</p>
                            <?php
}?>
                        </div>
                    </div>
                </section>

            </div>
        </article>
    </div>
</main>

<?php get_footer(); ?>
