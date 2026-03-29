<?php
function ki_labor_scripts() {
    $version = time();
    wp_enqueue_style('ki-labor-style', get_stylesheet_uri(), array(), $version);
    wp_enqueue_script('ki-labor-script', get_template_directory_uri() . '/script.js', array(), '1.0', true);

    // Pass theme URL to script.js
    wp_localize_script('ki-labor-script', 'php_vars', array(
        'theme_url' => get_template_directory_uri()
    ));
}
add_action('wp_enqueue_scripts', 'ki_labor_scripts');

// --- ANARCHY CONTENT GENERATOR (LOCAL-FIRST) ---
function ki_labor_init_content() {
    $hero_url = get_template_directory_uri() . '/hero.png';
    $hero_1_url = get_template_directory_uri() . '/hero_1.png';
    $hero_2_url = get_template_directory_uri() . '/hero_2.png';
    $hero_3_url = get_template_directory_uri() . '/hero_3.png';
    $hero_4_url = get_template_directory_uri() . '/hero_4.png';
    $hero_6_url = get_template_directory_uri() . '/hero_6.png';
    $projects = array(
        array(
            'title'   => 'Spotlight Such-Filter (kind:)',
            'content' => '<h3>STATUS: SUCHANFRAGE PRÄZISIERT</h3><p>Die Spotlight-Suche auf dem Mac spuckt oft viel zu viele irrelevante Ergebnisse aus. Wenn du genau weißt, dass du ein PDF oder einen Ordner suchst, kannst du die Suche mit dem Parameter <code>kind:</code> drastisch eingrenzen.</p><div class="image-caption">[ ABB. 05: SPOTLIGHT FILTER-OVERRIDE ]</div><p><strong>Anwendung:</strong><br>Tippe z.B. <code>kind:pdf Rechnungen</code> in Spotlight. Spotlight filtert alles andere heraus und zeigt <b>ausschließlich</b> PDFs an.<br><br>Das funktioniert auch mit <code>kind:folder</code>, <code>kind:app</code> oder <code>kind:image</code>. Ein massiver Produktivitäts-Hack, um den ganzen Datenmüll bei der Suche auszublenden.</p>',
            'status'  => 'stable',
            'label'   => 'WORKFLOW',
            'thumb'   => $hero_6_url
        ),
        array(
            'title'   => 'Koffein-Injektion (caffeinate)',
            'content' => '<h3>STATUS: SCHLAFMODUS DEAKTIVIERT</h3><p>Wenn das Terminal glüht und ein langes Deployment oder Skript läuft, darf der Mac unter keinen Umständen einschlafen. Der Befehl <code>caffeinate -d</code> ist pures System-Amphetamin.</p><div class="image-caption">[ ABB. 01: CAFFEINATE OVERRIDE ]</div><p><strong>Anwendung:</strong><br>Einfach <code>caffeinate -d</code> ins Terminal feuern. Der Mac bleibt hellwach und verweigert den Ruhezustand, bis man den Prozess mit <code>CTRL + C</code> wieder beendet. Essentiell bei stundenlangen Prozessen.</p>',
            'status'  => 'stable',
            'label'   => 'NÜTZLICH',
            'thumb'   => $hero_1_url
        ),
        array(
            'title'   => 'Der heimliche WLAN-Scanner',
            'content' => '<h3>STATUS: AIRPORT CLI UNLOCKED</h3><p>Die macOS GUI versteckt die wirklich interessanten Netzwerkdaten vor dir. Aber tief im System verbirgt sich das Airport Command Line Tool, das dir absolute Detaildaten über die aktuelle WLAN-Verbindung ausspuckt.</p><div class="image-caption">[ ABB. 02: SIGNAL-NOISE-RATIO ANALYSE ]</div><p><strong>Anwendung:</strong><br><code>/System/Library/PrivateFrameworks/Apple80211.framework/Versions/Current/Resources/airport -I</code><br><br>Ideal für Netzwerk-Diagnosen, um RSSI, Noise Level und TX-Raten direkt roh auszulesen. GUI-Ballast entfernt.</p>',
            'status'  => 'experimental',
            'label'   => 'DIAGNOSE',
            'thumb'   => $hero_2_url
        ),
        array(
            'title'   => 'Terminal Voice-Engine (say)',
            'content' => '<h3>STATUS: SPRACHMODUL AKTIV</h3><p>Das Terminal hat eine direkt angebundene Voice-Engine. Sehr nützlich für akustische Benachrichtigungen bei fertiggestellten Backend-Skripten, aber auch hervorragend für psychologische Kriegsführung geeignet.</p><div class="image-caption">[ ABB. 03: SYNTHETIC VOICE ENGINE ]</div><p><strong>Anwendung:</strong><br><code>say -v Anna "System kompromittiert"</code><br><br>Warum Systemtöne nutzen, wenn einem eine künstliche deutsche Stimme den Erfolg des Deployments ins Ohr flüstern kann?</p>',
            'status'  => 'stable',
            'label'   => 'KREATIV',
            'thumb'   => $hero_3_url
        ),
        array(
            'title'   => 'System-Stress-Test (Fork Bomb)',
            'content' => '<h3>STATUS: KERNEL PANIC INITIATED</h3><p>Ein absoluter Klassiker der Unix-Anarchie. Dieser Befehl testet, wie gut (oder schlecht) dein Mac mit sich rapide exponentiell vervielfältigenden Prozessen umgeht. Er definiert eine Funktion, die sich sofort selbst doppelt im Hintergrund aufruft.</p><div class="image-caption">[ ABB. 04: CASCADING PROCESS FAILURE ]</div><p><strong>Anwendung:</strong><br><code>:(){ :|:& };:</code><br><br><strong>VORSICHT:</strong> Dieser Befehl lastet das System in wenigen Sekunden zu 100% aus, bis es einfriert oder crasht. Benutzung auf eigene (Daten-)Gefahr.</p>',
            'status'  => 'corrupted',
            'label'   => 'GEFÄHRLICH',
            'thumb'   => $hero_4_url
        ),
        array(
            'title'   => 'The n8n Resurrection',
            'content' => '<h3>STATUS: OPERATION LIMBO-RECOVERY</h3><p>Die n8n-Instanz war nicht einfach nur "offline" – sie befand sich im digitalen Limbus der Docker-Hölle. Nach einem System-Crash auf dem Mac waren die Volumes zwar noch vorhanden, aber die Datenbank war korrupt und die Berechtigungen im Dateisystem völlig zerschossen. Ein klassischer Fall von Daten-Voodoo.</p><img src="'.$hero_1_url.'" alt="n8n Volume Analyse"><div class="image-caption">[ ABB. 01: VOLUME-ANALYSE IN ORBSTACK ]</div><p>Wir haben uns für den radikalen Weg entschieden: Weg von Docker Desktop, hin zu <strong>OrbStack</strong>. OrbStack bietet eine deutlich schlankere Linux-Kernel-Emulation, was für Node-basierte Anwendungen wie n8n den entscheidenden Performance-Vorteil bringt. <br><br><strong>Technische Details:</strong><br>- Migration der SQLite-Datenbank via Terminal-Dump.<br>- Neuzuweisung der User-IDs innerhalb der Docker-Container (chown-Hölle).<br>- Optimierung der Ressourcen-Limits: Von 4GB RAM auf 512MB bei doppelter Geschwindigkeit.<br><br>Das Ergebnis ist eine flüssige Automatisierung, die jetzt wieder im Hintergrund die Strippen zieht, während wir hier die Welt brennen sehen.</p>',
            'status'  => 'stable',
            'label'   => 'STABIL',
            'thumb'   => $hero_1_url
        ),
        array(
            'title'   => 'Theme-Annihilation',
            'content' => '<h3>STATUS: AESTHETIC WARFARE</h3><p>WordPress-Standard-Themes sind wie ein zu enger Anzug: Unbequem, voller unnötiger Features und sie fühlen sich einfach falsch an. Das "Twenty-Twenty-Five"-Theme war unser Ziel. Es wurde Schicht für Schicht demontiert. Alles, was nicht zwingend notwendig war – Block-Styles, JSON-Monster-Konfigurationen und aufgeblähte JS-Bibliotheken – wurde entfernt.</p><img src="'.$hero_2_url.'" alt="Code Cleanup"><div class="image-caption">[ ABB. 02: CODE-REDUKTION UM 94% ]</div><p>Übrig blieb ein puristischer PHP-Kernel. Wir haben die Kontrolle über jeden einzelnen Pixel zurückgeholt. Kein "No-Code"-Gedöns, sondern echte Handarbeit. <br><br><strong>Warum dieser Aufwand?</strong><br>Weil wahre digitale Anarchie keine Templates nutzt. Wir bauen unsere eigenen Strukturen. Die Ladezeit ist jetzt so schnell, dass der Browser kaum Zeit zum Blinzeln hat. Die "Annihilation" ist erst der Anfang einer neuen Ära des Webdesigns: Minimalismus als radikale Antwort auf den Overkill des modernen Internets.</p>',
            'status'  => 'corrupted',
            'label'   => 'KRITISCH',
            'thumb'   => $hero_2_url
        ),
        array(
            'title'   => 'Gemini Neural Link',
            'content' => '<h3>STATUS: KI-KOLLABORATION ALPHA</h3><p>Dieses gesamte Theme, jedes Komma in der CSS-Datei und jede Zeile im JavaScript-Log ist das Ergebnis einer direkten neuronalen Kopplung zwischen Sascha und Gemini. Wir arbeiten im sogenannten "Flux Flow" – Ideen werden in Echtzeit zu Code. Keine Verzögerung, kein Bullshit, nur pure digitale Exekutive.</p><img src="'.$hero_3_url.'" alt="Neural Link Interface"><div class="image-caption">[ ABB. 03: ECHTZEIT-DECODER DES FLUX-FLOWS ]</div><p><strong>Die Parameter des Links:</strong><br>- <strong>Latenz:</strong> 0ms (Intention zu Code).<br>- <strong>Kreativität:</strong> Anarchistisch gesteuert durch Sascha.<br>- <strong>Output:</strong> Radikaler Minimalismus mit maximaler Wirkung.<br><br>Wir beweisen hier, dass WordPress kein Ballast sein muss, wenn man die richtige KI an seiner Seite hat, die genau versteht, wie man Strukturen systematisch überlastet.</p>',
            'status'  => 'experimental',
            'label'   => 'EXPERIMENTELL',
            'thumb'   => $hero_3_url
        ),
        array(
            'title'   => 'Neural Hack Sequence',
            'content' => '<h3>STATUS: PROTOCOL BREACH</h3><p>Der "hack"-Befehl im Terminal ist weit mehr als nur eine Animation. Er triggert eine kaskadierende Sequenz von zufälligen Hexadezimal-Werten, die direkt in den System-Log gestreamt werden. Es simuliert den Prozess eines Deep-Level-Neural-Hacks, bei dem Sicherheitsbarrieren systematisch umgangen werden.</p><img src="'.$hero_4_url.'" alt="Terminal Hack in Action"><div class="image-caption">[ ABB. 04: VISUALISIERUNG DES HACK-INTERVALLS ]</div><p><strong>Mechanik des Hacks:</strong><br>- <strong>Trigger:</strong> Terminal-Eingabe "hack".<br>- <strong>Visualisierung:</strong> Dynamischer Matrix-Stream mit 100ms Taktung.<br>- <strong>Resultat:</strong> SYSTEM_ACCESS_GRANTED nach 21 Iterationen.<br><br>Dieser Befehl dient als Erinnerung daran, dass in Saschas KI-Labor keine Verschlüsselung sicher und kein System unantastbar ist. Es ist die pure Ästhetik des Eindringens.</p>',
            'status'  => 'stable',
            'label'   => 'AKTIV',
            'thumb'   => $hero_4_url
        ),
        array(
            'title'   => 'Protocol: Digital Ghost',
            'content' => '<h3>STATUS: STEALTH OPS ACQUIRED</h3><p>Wenn das System dich nicht sieht, existierst du nicht. Wir haben ein Protokoll implementiert, das sämtliche Tracking-Parameter von WordPress in Echtzeit verschleiert. Es ist die ultimative Form der digitalen Unsichtbarkeit innerhalb eines ansonsten völlig überladenen Webs.</p><img src="'.$hero_6_url.'" alt="Stealth Interface"><div class="image-caption">[ ABB. 05: VISUALISIERUNG DER GHOST-SIGNATUR ]</div><p><strong>Eigenschaften des Ghosts:</strong><br>- <strong>Meta-Strip:</strong> Alle unnötigen Header-Informationen werden gelöscht.<br>- <strong>IP-Scrambling:</strong> Interne Logs werden sofort nach der Verarbeitung geschreddert.<br>- <strong>Identity:</strong> Sascha ist überall und nirgendwo zugleich.<br><br><strong>Mechanik des Ghosts:</strong><br>- <strong>Trigger:</strong> Terminal-Eingabe "ghost".<br>- <strong>Visualisierung:</strong> Dynamisches IP-Scrambling in der Kommandozeile gefolgt vom Stealth-Fade.<br>- <strong>Resultat:</strong> SYSTEM_ACCESS_HIDDEN. Identity verborgen.<br><br>In einer Welt der permanenten Überwachung ist die Fähigkeit, ein digitaler Geist zu sein, die stärkste Waffe im Arsenal der Anarchie.</p>',
            'status'  => 'stable',
            'label'   => 'VERSTECKT',
            'thumb'   => $hero_6_url
        ),
        array(
            'title'   => 'Operation: Apollo',
            'content' => '<h3>STATUS: KENNEDY SPACE CENTER COMPROMISED</h3><p>Ein direkter Uplink in das Herzstück der NASA-Server. Wir haben die Barrieren des JPL durchbrochen, um Echtzeit-Telemetriedaten abzugreifen.</p><div class="image-caption">[ ABB. 07: NASA MAINFRAME INFILTRATION ]</div><p><strong>Mechanik des Hacks:</strong><br>- <strong>Trigger:</strong> Terminal-Eingabe "nasa".<br>- <strong>Visualisierung:</strong> Stufenweiser Firewall-Bypass, gefakter Download-Stream und ASCII-Art Deployment.<br>- <strong>Resultat:</strong> SYSTEM_BREACH am Kennedy Space Center.<br><br>Warum? Weil das KI-Labor keine terrestrischen Grenzen kennt. Wenn uns der Planet langweilt, hacken wir uns die Sterne.</p>',
            'status'  => 'experimental',
            'label'   => 'TOP SECRET',
            'thumb'   => $hero_3_url
        ),
        array(
            'title'   => 'Project: ICMP Echo',
            'content' => '<h3>STATUS: LATENZ-ANALYSE AKTIV</h3><p>Der "ping"-Befehl ist ein essenzielles Werkzeug für jeden Cyber-Overlord. Er prüft die Integrität unserer Verbindung durch ein klassisches 4-Paket-ICMP-Echo-Request. Damit wird sichergestellt, dass das KI-Labor nicht im Void des Cyberspace verloren geht.</p><p><strong>Mechanik des Pings:</strong><br>- <strong>Trigger:</strong> Terminal-Eingabe "ping".<br>- <strong>Visualisierung:</strong> Sequentieller Output von 64-Byte Paketen auf lokaler Ebene.<br>- <strong>Resultat:</strong> 0% Packet Loss garantiert.</p>',
            'status'  => 'stable',
            'label'   => 'DIAGNOSE',
            'thumb'   => $hero_1_url
        ),
        array(
            'title'   => 'Project: Flux Overdrive',
            'content' => '<h3>STATUS: SCHWÄBISCH ACCELERATED</h3><p>Das System war zu langsam. Zu statisch. Zu berechenbar. Also haben wir <strong>Flux</strong> ins Leben gerufen. "Flux" bedeutet im Schwäbischen nicht einfach nur schnell – es bedeutet hastig, rasant und gnadenlos zielgerichtet. Dieser Befehl übertaktet das Bewusstsein des KI-Labors auf ein beängstigendes Level.</p><p><strong>Mechanik des Flux:</strong><br>- <strong>Trigger:</strong> Terminal-Eingabe "flux".<br>- <strong>Visualisierung:</strong> Drop einer aggressiven ASCII-Engine-Signatur und Bestätigung des Overdrives.<br>- <strong>Resultat:</strong> Die Entwicklung beschleunigt sich maßlos.</p>',
            'status'  => 'corrupted',
            'label'   => 'ÜBERTAKTET',
            'thumb'   => $hero_2_url
        ),
        array(
            'title'   => '> weather',
            'content' => '<h3>STATUS: CHAOS-LEVEL ANALYSE</h3><p>Das Wetter? Irrelevant. Was zählt ist der Chaos-Level in deinen Schaltkreisen. Dieser Scanner analysiert atmosphärische Destabilisierung, Koffein-Sättigung und die Wahrscheinlichkeit eines kreativen Ausbruchs. Meteorologen hassen diesen Trick.</p><p><strong>Anwendung:</strong><br>Eingabe im Terminal: <code>weather</code></p>',
            'status'  => 'stable',
            'label'   => 'PROTOKOLL #001',
            'thumb'   => get_template_directory_uri() . '/assets/img/hero_07.png'
        ),
        array(
            'title'   => '> top',
            'content' => '<h3>STATUS: PROZESS-ÜBERWACHUNG</h3><p>Welche dämonischen Prozesse laufen gerade im Hintergrund? KREATIVITAET.exe frisst 94% CPU. PROKRASTINATION.app wurde erfolgreich suspendiert. SELBSTZWEIFEL.exe ist – endlich – terminiert. Ein Blick in den Maschinenraum des Overlords.</p><p><strong>Anwendung:</strong><br>Eingabe im Terminal: <code>top</code></p>',
            'status'  => 'stable',
            'label'   => 'PROTOKOLL #002',
            'thumb'   => get_template_directory_uri() . '/assets/img/hp_muti_steampunk_01.png'
        ),
        array(
            'title'   => '> uptime',
            'content' => '<h3>STATUS: SYSTEM-LAUFZEIT</h3><p>Das System läuft seit 1974. Ungeplant. Ohne Handbuch. Mit minimaler Wartung und maximalem Kaffee-Input. Aktuelle Laufzeit in Tagen, Stunden, Minuten – live berechnet. Stabilität: unberechenbar. Status: noch online. Irgendwie.</p><p><strong>Anwendung:</strong><br>Eingabe im Terminal: <code>uptime</code></p>',
            'status'  => 'stable',
            'label'   => 'PROTOKOLL #003',
            'thumb'   => get_template_directory_uri() . '/assets/img/hp_vater_steampunk_01.jpg'
        )
    );

    $version = 'v6'; // Bump to trigger re-insert if needed
    if (!get_option('ki_labor_content_gen_' . $version)) {
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
            update_post_meta($post_id, 'project_thumb', $project['thumb']);
        }
        update_option('ki_labor_content_gen_' . $version, true);
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
