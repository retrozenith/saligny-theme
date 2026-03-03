<?php
/**
 * Template Name: Contact Page
 * Template for the Contact page with OpenStreetMap
 *
 * @package Saligny_Theme
 */

get_header();
?>

<!-- Leaflet CSS & JS (free, no API key) -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<style>
    .contact-page-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 28px;
        margin-bottom: 32px;
    }

    .contact-info-section {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .contact-card {
        background: var(--color-bg);
        padding: 24px;
        border-radius: var(--radius-md);
        display: grid;
        grid-template-columns: 50px 1fr;
        align-items: center;
        gap: 18px;
        transition: all var(--transition-fast);
        border-left: 3px solid transparent;
    }

    .contact-card:hover {
        transform: translateX(4px);
        border-left-color: var(--color-gold);
        box-shadow: 0 4px 16px var(--color-shadow);
    }

    .contact-card .card-icon {
        font-size: 1.8rem;
        flex-shrink: 0;
        width: 50px;
        height: 50px;
        line-height: 50px;
        text-align: center;
        background: var(--color-white);
        border-radius: var(--radius-sm);
        box-shadow: 0 2px 8px var(--color-shadow);
    }

    .contact-card h4 {
        font-size: 0.95rem;
        color: var(--color-primary);
        margin-top: 0;
        margin-bottom: 4px;
    }

    .contact-card p {
        font-size: 0.88rem;
        color: var(--color-text-light);
        line-height: 1.5;
        margin: 0;
    }

    .contact-card a {
        color: var(--color-primary-light);
        font-weight: 600;
    }

    .contact-card a:hover {
        color: var(--color-gold-dark);
    }

    .map-section {
        border-radius: var(--radius-md);
        overflow: hidden;
        box-shadow: 0 4px 20px var(--color-shadow);
        min-height: 400px;
    }

    #contact-map {
        width: 100%;
        height: 100%;
        min-height: 400px;
        border-radius: var(--radius-md);
    }

    .map-full-width {
        margin-top: 28px;
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: 0 4px 20px var(--color-shadow);
    }

    .map-full-width #contact-map-full {
        width: 100%;
        height: 300px;
    }

    .program-section {
        margin-top: 28px;
        background: var(--color-bg);
        border-radius: var(--radius-md);
        padding: 24px;
    }

    .program-section h3 {
        font-size: 1rem;
        color: var(--color-primary);
        margin-bottom: 12px;
    }

    .program-table {
        width: 100%;
        border-collapse: collapse;
    }

    .program-table td {
        padding: 8px 12px;
        border-bottom: 1px solid var(--color-border);
        font-size: 0.88rem;
        color: var(--color-text);
    }

    .program-table td:first-child {
        font-weight: 600;
        color: var(--color-primary-dark);
        width: 40%;
    }

    @media (max-width: 768px) {
        .contact-page-grid {
            grid-template-columns: 1fr;
        }

        .map-section {
            min-height: 300px;
        }

        #contact-map {
            min-height: 300px;
        }
    }
</style>

<main id="main-content" class="site-content" role="main">
    <div class="content-wrap">
        <div class="main-content">

            <article class="entry-article">
                <div class="entry-header">
                    <h1 class="entry-title"><?php echo saligny_icon('pin'); ?> Contact</h1>
                </div>

                <div class="entry-content">
                    <div class="contact-page-grid">
                        <div class="contact-info-section">
                            <div class="contact-card">
                                <div class="card-icon"><?php echo saligny_icon('school', '1.8rem'); ?></div>
                                <div>
                                    <h4>Adresa</h4>
                                    <p>Bulevardul Nicolae Grigorescu nr. 12<br>Sector 3, București</p>
                                </div>
                            </div>

                            <div class="contact-card">
                                <div class="card-icon"><?php echo saligny_icon('phone', '1.8rem'); ?></div>
                                <div>
                                    <h4>Telefon / Fax</h4>
                                    <p>Tel: <a href="tel:+40213402654">021.340.26.54</a><br>Fax: 021.340.26.54</p>
                                </div>
                            </div>

                            <div class="contact-card">
                                <div class="card-icon"><?php echo saligny_icon('email', '1.8rem'); ?></div>
                                <div>
                                    <h4>Email</h4>
                                    <p><a href="mailto:anghel_saligny@yahoo.com">anghel_saligny@yahoo.com</a></p>
                                </div>
                            </div>

                            <div class="contact-card">
                                <div class="card-icon"><?php echo saligny_icon('document', '1.8rem'); ?></div>
                                <div>
                                    <h4>Website</h4>
                                    <p><a href="https://www.anghel-saligny.info.ro" target="_blank" rel="noopener">www.anghel-saligny.info.ro</a></p>
                                </div>
                            </div>

                            <div class="contact-card">
                                <div class="card-icon"><?php echo saligny_icon('pin', '1.8rem'); ?></div>
                                <div>
                                    <h4>Transport în comun</h4>
                                    <p>
                                        <strong>Autobuz:</strong> 101, 102, 253, 330, 335<br>
                                        <strong>Troleibuz:</strong> 70, 79, 92<br>
                                        <strong>Tramvai:</strong> 36, 40, 55<br>
                                        <strong>Metrou:</strong> Stația Titan
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="map-section">
                            <div id="contact-map"></div>
                        </div>
                    </div>

                    <div class="program-section">
                        <h3><?php echo saligny_icon('calendar'); ?> Program Secretariat</h3>
                        <table class="program-table">
                            <tr><td>Luni – Vineri</td><td>08:00 – 16:00</td></tr>
                            <tr><td>Sâmbătă – Duminică</td><td>Închis</td></tr>
                        </table>
                    </div>
                </div>
            </article>

        </div>

        <?php get_sidebar(); ?>
    </div>
</main>

<?php
wp_enqueue_script('leaflet-js', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js', array(), '1.9.4', true);
wp_enqueue_script('saligny-contact', get_template_directory_uri() . '/js/contact.js', array('leaflet-js'), '1.0', true);
?>

<?php get_footer(); ?>
