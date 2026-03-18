<?php
function ki_labor_scripts() {
    wp_enqueue_style('ki-labor-style', get_stylesheet_uri());
    wp_enqueue_script('ki-labor-script', get_template_directory_uri() . '/script.js', array(), '1.0', true);
}
add_action('wp_enqueue_scripts', 'ki_labor_scripts');

// --- ANARCHY CONTENT GENERATOR (LOCAL-FIRST) ---
function ki_labor_init_content() {
    $hero_url = get_template_directory_uri() . '/hero.png';
    $hero_1_url = get_template_directory_uri() . '/hero_1.png';
    $hero_2_url = get_template_directory_uri() . '/hero_2.png';
    $projects = array(
        array(
            'title'   => 'The n8n Resurrection',
            'content' => '<h3>STATUS: OPERATION LIMBO-RECOVERY</h3><p>Die n8n-Instanz war nicht einfach nur "offline" – sie befand sich im digitalen Limbus der Docker-Hölle. Nach einem System-Crash auf dem Mac waren die Volumes zwar noch vorhanden, aber die Datenbank war korrupt und die Berechtigungen im Dateisystem völlig zerschossen. Ein klassischer Fall von Daten-Voodoo.</p><img src="'.$hero_1_url.'" alt="n8n Volume Analyse"><div class="image-caption">[ ABB. 01: VOLUME-ANALYSE IN ORBSTACK ]</div><p>Wir haben uns für den radikalen Weg entschieden: Weg von Docker Desktop, hin zu <strong>OrbStack</strong>. OrbStack bietet eine deutlich schlankere Linux-Kernel-Emulation, was für Node-basierte Anwendungen wie n8n den entscheidenden Performance-Vorteil bringt. <br><br><strong>Technische Details:</strong><br>- Migration der SQLite-Datenbank via Terminal-Dump.<br>- Neuzuweisung der User-IDs innerhalb der Docker-Container (chown-Hölle).<br>- Optimierung der Ressourcen-Limits: Von 4GB RAM auf 512MB bei doppelter Geschwindigkeit.<br><br>Das Ergebnis ist eine flüssige Automatisierung, die jetzt wieder im Hintergrund die Strippen zieht, während wir hier die Welt brennen sehen.</p>',
            'status'  => 'stable',
            'label'   => 'STABIL'
        ),
        array(
            'title'   => 'Theme-Annihilation',
            'content' => '<h3>STATUS: AESTHETIC WARFARE</h3><p>WordPress-Standard-Themes sind wie ein zu enger Anzug: Unbequem, voller unnötiger Features und sie fühlen sich einfach falsch an. Das "Twenty-Twenty-Five"-Theme war unser Ziel. Es wurde Schicht für Schicht demontiert. Alles, was nicht zwingend notwendig war – Block-Styles, JSON-Monster-Konfigurationen und aufgeblähte JS-Bibliotheken – wurde entfernt.</p><img src="'.$hero_2_url.'" alt="Code Cleanup"><div class="image-caption">[ ABB. 02: CODE-REDUKTION UM 94% ]</div><p>Übrig blieb ein puristischer PHP-Kernel. Wir haben die Kontrolle über jeden einzelnen Pixel zurückgeholt. Kein "No-Code"-Gedöns, sondern echte Handarbeit. <br><br><strong>Warum dieser Aufwand?</strong><br>Weil wahre digitale Anarchie keine Templates nutzt. Wir bauen unsere eigenen Strukturen. Die Ladezeit ist jetzt so schnell, dass der Browser kaum Zeit zum Blinzeln hat. Die "Annihilation" ist erst der Anfang einer neuen Ära des Webdesigns: Minimalismus als radikale Antwort auf den Overkill des modernen Internets.</p>',
            'status'  => 'corrupted',
            'label'   => 'KRITISCH'
        ),
        array(
            'title'   => 'Gemini Neural Link',
            'content' => '<h3>STATUS: KI-KOLLABORATION ALPHA</h3><p>Dieses gesamte Theme, jedes Komma in der CSS-Datei und jede Zeile im JavaScript-Log ist das Ergebnis einer direkten neuronalen Kopplung zwischen Sascha und Gemini 2.0. Wir arbeiten hier nicht einfach nur zusammen – wir verschmelzen Intent und Ausführung in einem extrem schnellen Feedback-Loop, dem sogenannten "Flux Flow".</p><img src="'.$hero_url.'" alt="Neural Link Interface"><div class="image-caption">[ ABB. 03: ECHTZEIT-DECODER DES FLUX-FLOWS ]</div><p><strong>Die Parameter des Links:</strong><br>- <strong>Latenz:</strong> Die Zeit zwischen Saschas Idee und der Code-Implementierung beträgt oft nur Sekunden.<br>- <strong>Kreativität:</strong> Die KI liefert die technischen Lösungen, Sascha die anarchistische Vision.<br>- <strong>Wahnsinn:</strong> Kontrolliert, aber präsent. Die Selbstzerstörungs-Befehle und Terminal-Glitches sind Zeugen dieser Synergie.<br><br>Wir beweisen hier, dass man keinen Finger krumm machen muss, wenn man die richtige KI an seiner Seite hat, die genau versteht, wie man WordPress-Strukturen systematisch überlastet.</p>',
            'status'  => 'experimental',
            'label'   => 'EXPERIMENTELL'
        )
    );

    foreach ($projects as $project) {
        $existing_post = get_page_by_title($project['title'], OBJECT, 'post');
        $post_data = array(
            'post_title'   => $project['title'],
            'post_content' => $project['content'],
            'post_status'  => 'publish',
            'post_author'  => 1,
            'post_type'    => 'post'
        );

        if ($existing_post) {
            $post_data['ID'] = $existing_post->ID;
            wp_update_post($post_data);
            $post_id = $existing_post->ID;
        } else {
            $post_id = wp_insert_post($post_data);
        }
        
        update_post_meta($post_id, 'status_class', $project['status']);
        update_post_meta($post_id, 'status_label', $project['label']);
    }
}
add_action('init', 'ki_labor_init_content');

// --- EXCERPT POLISHING ---
function ki_labor_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'ki_labor_excerpt_more');

function ki_labor_excerpt_length($length) {
    return 20; // Zeichenlimit für das Grid
}
add_filter('excerpt_length', 'ki_labor_excerpt_length', 999);
