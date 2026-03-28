<?php
/**
 * Voeg toe aan /wp-content/themes/parkhotel/functions.php
 *
 * Registreert de eigen CSS/JS voor de Vergaderen template
 * en zorgt dat de assets alleen geladen worden op die specifieke pagina.
 */

add_action('wp_enqueue_scripts', function() {
    // Controleer of de huidige pagina de Vergaderen template gebruikt
    if (is_page_template('page-vergaderen.php')) {

        // Vergaderen stylesheet
        wp_enqueue_style(
            'phh-vergaderen',
            get_template_directory_uri() . '/vergaderen/style.css',
            [], // geen dependencies
            '1.0.0'
        );

        // Vergaderen script
        wp_enqueue_script(
            'phh-vergaderen',
            get_template_directory_uri() . '/vergaderen/script.js',
            [], // geen dependencies (geen jQuery nodig)
            '1.0.0',
            true // in footer laden
        );

        // Optioneel: Google Fonts (als het thema dit nog niet laadt)
        wp_enqueue_style(
            'phh-google-fonts',
            'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,700;1,400&family=Lato:wght@300;400;700&display=swap',
            [],
            null
        );
    }
});
