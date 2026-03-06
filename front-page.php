<?php
/**
 * Front Page Template
 *
 * @package Saligny_Theme
 */

get_header();
?>

<main id="main-content" class="w-full bg-bg-light text-text-main font-sans overflow-x-hidden min-h-screen" role="main">
    
    <!-- CLASSIC HERO SECTION -->
    <section class="relative w-full h-[550px] lg:h-[700px] flex items-center justify-start overflow-hidden" id="acasa">
        <!-- Background Image & Gradient Overlay -->
        <?php $hero_bg = get_template_directory_uri() . '/assets/img/intrare-2.jpg'; ?>
        <div class="absolute inset-0 z-0">
            <img src="<?php echo esc_url($hero_bg); ?>" alt="Ero image" class="w-full h-full object-cover object-center">
            <div class="absolute inset-0 bg-gradient-to-r from-white/95 via-white/80 to-transparent"></div>
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 w-full max-w-7xl mx-auto px-6 lg:px-8 flex flex-col items-start justify-center flex-grow">
            <div class="max-w-3xl">
                <h1 class="font-heading text-5xl sm:text-6xl lg:text-7xl font-extrabold leading-[1.1] mb-6 text-primary tracking-tight">
                    Inspirație, Inovație și Descoperire.
                </h1>
                
                <p class="text-lg sm:text-xl lg:text-2xl text-text-main leading-relaxed mb-10 max-w-2xl font-sans drop-shadow-sm font-medium">
                    <?php echo esc_html(get_theme_mod('front_hero_desc', 'O carieră de succes începe cu educația de calitate. Împreună punem bazele cunoștințelor ce vor fi fundația unei cariere de succes.')); ?>
                </p>
                
                <div class="flex flex-wrap gap-4 mt-4">
                    <a href="<?php echo esc_url(get_theme_mod('front_hero_btn1_url', home_url('/despre-noi/'))); ?>" class="inline-flex items-center justify-center px-10 py-4 lg:py-5 lg:px-12 text-sm lg:text-base uppercase tracking-wider font-bold text-white bg-secondary hover:bg-primary rounded-md shadow-lg transition-all duration-300 border-2 border-secondary hover:border-primary">
                        <?php echo esc_html(get_theme_mod('front_hero_btn1_text', 'Află mai multe')); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- PROGRAMS -->
    <section class="py-20 px-6 lg:px-12 bg-white" id="specializari">
        <div class="max-w-7xl mx-auto text-center mb-16">
            <h2 class="font-heading text-3xl md:text-5xl font-extrabold text-primary mb-6">Oferta Educațională</h2>
            <div class="w-20 h-1.5 bg-secondary mx-auto"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
            <?php
$programs = [
    ['icon' => '⚡', 'title' => 'Electrotehnică și Automatizări', 'desc' => 'Sisteme electrice, circuite, automatizări industriale și proiectarea instalațiilor de joasă tensiune.', 'tag' => 'Profil Tehnic'],
    ['icon' => '🔧', 'title' => 'Construcții, Instalații și Lucrări Publice', 'desc' => 'Proiectarea și execuția construcțiilor civile și industriale, instalații sanitare și termice.', 'tag' => 'Profil Tehnic'],
    ['icon' => '🖥️', 'title' => 'Tehnician Operator Tehnică de Calcul', 'desc' => 'Rețele de calculatoare, sisteme de operare, programare și mentenanță hardware.', 'tag' => 'Informatică'],
    ['icon' => '🏗️', 'title' => 'Tehnici Poligrafice', 'desc' => 'Design grafic, prepress, tipografie și producție editorială modernă.', 'tag' => 'Arte și Design'],
    ['icon' => '🔌', 'title' => 'Instalații Electrice', 'desc' => 'Montaj și întreținere instalații electrice, tablouri de distribuție, sisteme de protecție.', 'tag' => 'Profil Tehnic'],
    ['icon' => '📐', 'title' => 'Desen Tehnic și Arhitectural', 'desc' => 'CAD 2D/3D, proiectare asistată de calculator, vizualizare și randare arhitecturală.', 'tag' => 'Design Tehnic'],
];
foreach ($programs as $p): ?>
                <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-sm border border-border flex flex-col gap-4 hover:shadow-md hover:border-primary/20 transition-all duration-300">
                    <div class="flex items-center gap-4 mb-2">
                        <div class="w-16 h-16 shrink-0 rounded-xl bg-bg-light border border-border flex items-center justify-center text-[2rem] text-primary">
                            <?php echo $p['icon']; ?>
                        </div>
                        <h3 class="font-heading text-lg sm:text-xl font-bold text-primary leading-tight"><?php echo esc_html($p['title']); ?></h3>
                    </div>
                    <p class="text-text-light text-sm leading-relaxed mb-4 font-sans text-left"><?php echo esc_html($p['desc']); ?></p>
                    <div class="mt-auto flex justify-start">
                        <span class="inline-flex items-center justify-center px-4 py-2 bg-primary/10 text-primary text-[11px] font-bold rounded-md uppercase tracking-wider"><?php echo esc_html($p['tag']); ?></span>
                    </div>
                </div>
            <?php
endforeach; ?>
        </div>
    </section>

    <!-- ABOUT STRIP -->
    <div class="bg-primary text-white" id="despre">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-0">
            <div class="p-10 lg:py-20 lg:px-12 border-b md:border-b-0 md:border-r border-white/10">
                <div class="inline-flex items-center gap-2 text-xs font-bold tracking-widest uppercase text-secondary mb-4">
                    <span class="inline-block w-6 h-0.5 bg-secondary"></span> Despre Noi
                </div>
                <h2 class="font-heading text-3xl md:text-5xl font-extrabold leading-[1.15] tracking-tight">Tradiție,<br />Inovație și<br />Excelență.</h2>
                <p class="text-white/80 text-lg leading-relaxed mt-6 font-sans">
                    Cu peste 70 de ani de tradiție în formarea tehnică, Colegiul "Anghel Saligny" combină rigorile educației clasice cu cerințele unui mediu industrial în continuă transformare. Infrastructura noastră modernă și parteneriatul cu companii locale și naționale asigură o tranziție rapidă de la bancă la locul de muncă.
                </p>
                <div class="mt-10 flex gap-8 flex-wrap">
                    <?php
$about_highlights = [
    ['label' => 'Acreditare ARACIP', 'val' => 'Excelent'],
    ['label' => 'Nivel Calificare', 'val' => 'EQF 4 & 5'],
    ['label' => 'Locație', 'val' => 'București, Sector 4'],
];
foreach ($about_highlights as $h): ?>
                        <div class="border-l-2 border-secondary pl-4">
                            <div class="text-xs text-white/60 uppercase tracking-widest mb-1"><?php echo esc_html($h['label']); ?></div>
                            <div class="font-heading font-bold text-xl"><?php echo esc_html($h['val']); ?></div>
                        </div>
                    <?php
endforeach; ?>
                </div>
            </div>

            <div class="p-10 lg:py-20 lg:px-12 flex flex-col justify-center gap-8 bg-primary-dark">
                <?php
$features = [
    ['icon' => 'microscope', 'title' => 'Laboratoare Moderne', 'desc' => 'Dotări tehnice de ultimă generație: automate programabile, echipamente electrotehnice și stații CAD.'],
    ['icon' => 'building', 'title' => 'Practică în Firme Partenere', 'desc' => 'Stagii de practică în companii de top din București și România, cu posibilități de angajare directă.'],
    ['icon' => 'award', 'title' => 'Certificări Profesionale', 'desc' => 'Absolvenții obțin certificate de calificare recunoscute la nivel național și european.'],
];
foreach ($features as $f): ?>
                    <div class="flex items-start gap-5">
                        <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center shrink-0 text-secondary">
                            <?php echo saligny_icon($f['icon'], '1.5rem'); ?>
                        </div>
                        <div>
                            <h3 class="font-heading text-xl font-bold mb-2"><?php echo esc_html($f['title']); ?></h3>
                            <p class="text-white/70 leading-relaxed font-sans"><?php echo esc_html($f['desc']); ?></p>
                        </div>
                    </div>
                <?php
endforeach; ?>
            </div>
        </div>
    </div>

    <!-- NEWS LOOP -->
    <section class="py-20 px-6 lg:px-12 bg-bg-light" id="noutati">
        <div class="max-w-[1400px] mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-end gap-6 mb-12 border-b border-border pb-6">
                <div>
                    <div class="inline-flex items-center gap-2 text-xs font-bold tracking-widest uppercase text-secondary mb-3">
                        <span class="inline-block w-6 h-0.5 bg-secondary"></span> Noutăți
                    </div>
                    <h2 class="font-heading text-3xl md:text-4xl font-extrabold text-primary">Noutăți și Evenimente</h2>
                </div>
                <a href="#" class="inline-flex items-center gap-2 text-primary font-bold hover:text-secondary transition-colors uppercase tracking-wider text-sm">
                    Toate Știrile →
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
$latest = get_posts(array('posts_per_page' => 3, 'post_status' => 'publish'));
if (!empty($latest)):
    global $post;
    foreach ($latest as $post):
        setup_postdata($post);
?>
                        <article class="bg-white rounded-lg shadow-sm overflow-hidden border border-border flex flex-col group hover:shadow-md transition-shadow">
                            <?php if (has_post_thumbnail()): ?>
                                <a href="<?php the_permalink(); ?>" class="block h-48 overflow-hidden">
                                    <?php the_post_thumbnail('medium_large', array('class' => 'w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500')); ?>
                                </a>
                            <?php
        else: ?>
                                <div class="h-48 bg-primary/5 flex items-center justify-center text-primary/20">
                                    <?php echo saligny_icon('file', '3rem'); ?>
                                </div>
                            <?php
        endif; ?>
                            
                            <div class="p-6 flex-grow flex flex-col">
                                <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-secondary mb-3">
                                    <?php echo saligny_icon('calendar', '1em'); ?>
                                    <span><?php echo get_the_date('j F Y'); ?></span>
                                </div>
                                <h3 class="font-heading text-xl font-bold leading-tight mb-4 shrink-0">
                                    <a href="<?php the_permalink(); ?>" class="text-primary hover:text-secondary transition-colors">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                                <div class="text-text-light text-sm leading-relaxed mb-6 font-sans flex-grow">
                                    <?php echo wp_trim_words(get_the_content(), 20); ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-2 text-sm font-bold text-primary hover:text-secondary transition-colors mt-auto pt-2 border-t border-border/50">
                                    Citește Mai Mult →
                                </a>
                            </div>
                        </article>
                <?php
    endforeach;
    wp_reset_postdata();
else:
?>
                    <p class="p-8 text-text-light col-span-3 text-center">Nu există articole publicate încă.</p>
                <?php
endif; ?>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
