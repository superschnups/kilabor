<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DIGITALE ANARCHIE | KI-LABOR</title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <!-- ANTIGRAVITY PARALLAX LAYERS -->
    <div class="ag-parallax-layer" data-speed="0.1" style="position:fixed; top:0; left:0; width:100%; height:100%; z-index:-1; background: radial-gradient(circle, rgba(0,255,65,0.05) 0%, transparent 70%); pointer-events:none;"></div>
    <div class="ag-parallax-layer" data-speed="0.3" style="position:fixed; top:0; left:0; width:100%; height:100%; z-index:-2; background: url('<?php echo get_template_directory_uri(); ?>/assets/img/grid.png'); opacity:0.1; pointer-events:none;"></div>

    <div id="boot-screen">
        <div id="boot-log"></div>
    </div>
    <div class="container main-content" style="opacity: 0;">
        <header>
            <h1>SASCHAS ZENTRUM FÜR DIGITALE ANARCHIE</h1>
            <p class="tagline">Beruf: Geisteskrank & Gemini Player</p>
            <div class="warning-box">
                ⚠ VORSICHT: INSTABILE ALGORITHMEN. BETRETEN AUF EIGENE GEFAHR. <br>
                KEINE HAFTUNG FÜR DATENVERLUST ODER EXISTENZIELLE KRISEN.
            </div>
        </header>

        <div class="reboot-container" style="text-align: center; margin-bottom: 10px;">
            <a href="#" id="trigger-reboot" style="color: #444; font-size: 0.7rem; text-decoration: none; border: 1px solid #222; padding: 2px 10px; text-transform: uppercase; letter-spacing: 2px;">[ Manual System Reboot ]</a>
        </div>
        <img src="<?php echo get_template_directory_uri(); ?>/hero.png" class="hero-image" alt="Steampunk Sascha">

        <div class="control-panel">
            <button id="btn-kernel" class="switch-btn">KI-KERNEL</button>
            <button id="btn-anarchy" class="switch-btn green">ANARCHIE-MODE</button>
            <button id="btn-security" class="switch-btn">SECURITY-BYPASS</button>
            <button id="btn-scan" class="switch-btn">DEEP SCAN</button>
            <button id="btn-overdrive" class="switch-btn red">OVERDRIVE</button>
        </div>

        <!-- OPS DASHBOARD SIGN -->
        <div id="ops-dashboard-sign">
            <div class="ops-sign-header">
                <span class="ops-blink-dot"></span>
                <span class="ops-title">CHIRURGISCHES OPS-DASHBOARD</span>
                <span class="ops-blink-dot"></span>
            </div>
            <div class="ops-sign-stats">
                <div class="ops-stat-block">
                    <span class="ops-stat-label">HEUTE</span>
                    <span class="ops-tally">|||</span>
                    <span class="ops-stat-val">3 OPS</span>
                </div>
                <span class="ops-divider">◈</span>
                <div class="ops-stat-block">
                    <span class="ops-stat-label">ERFOLGE</span>
                    <span class="ops-tally ops-half">|½</span>
                    <span class="ops-stat-val ops-warn">1.5</span>
                </div>
                <span class="ops-divider">◈</span>
                <div class="ops-stat-block">
                    <span class="ops-stat-label">RESTE</span>
                    <span class="ops-stat-val ops-crit">KUEHLHAUS C</span>
                </div>
            </div>
            <div class="ops-sign-hint">[ PROTOKOLL EINSEHEN ]</div>
        </div>

        <div class="terminal-wrapper" style="margin-top: 0;">
            <div class="terminal-topbar" style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 5px;">
                <span style="color: var(--accent-gold); font-size: 0.8rem; letter-spacing: 1px;">// SECURE_TERMINAL_ACCESS</span>
                <button id="btn-sfx" style="background: transparent; border: 1px solid #0f0; color: #0f0; font-family: 'Courier New', monospace; font-size: 0.7rem; cursor: pointer; padding: 2px 8px; transition: all 0.2s;">[ SFX: ON ]</button>
            </div>
            <div id="system-log" style="margin-top: 0;">
                <div id="ops-panel">
                    <div id="ops-panel-vitals"></div>
                    <div id="ops-panel-log"></div>
                </div>
                <div id="log-output"></div>
                <div class="terminal-input-line">
                    <span class="prompt">></span>
                    <input type="text" id="terminal-input" placeholder="SYSTEMBEFEHL EINGEBEN (help für Liste)..." autocomplete="off">
                </div>
            </div>
        </div>

        <!-- FORTUNE TEASER -->
        <div class="fortune-teaser" onclick="document.getElementById('terminal-input').value='fortune'; document.getElementById('terminal-input').focus();">
            <span class="fortune-teaser-label">// ORAKEL-SCHNITTSTELLE ERKANNT</span>
            <p class="fortune-teaser-text">Das System verfügt über eine interne Weisheitsdatenbank. Zugriffsklassifizierung: <em>möglicherweise erhellend</em>. Nutzung auf eigene Gefahr. Keine Haftung für plötzliche Selbsterkenntnis.</p>
            <span class="fortune-teaser-hint">&gt; <code>fortune</code> &nbsp;—&nbsp; falls du es wagen willst.</span>
        </div>

        <div class="content-box">
            <div class="content-header">
                <h2>PROJEKT-ARCHIV: KLASSIFIZIERT</h2>
                <div class="filter-controls">
                    <button class="filter-btn active" data-filter="all">ALLE</button>
                    <button class="filter-btn" data-filter="stable">STABIL</button>
                    <button class="filter-btn" data-filter="corrupted">KRITISCH</button>
                    <button class="filter-btn" data-filter="experimental">EXPERIMENTELL</button>
                    <button class="steampunk-card filter-btn" style="color: var(--accent-gold); border-color: var(--accent-gold); padding: 2px 8px; background: transparent; cursor: pointer; display: flex; align-items: center;"><h3 style="margin: 0; font-size: 0.7rem;">MUTTER (TIMELINE)</h3></button>
                    <a href="<?php echo get_template_directory_uri(); ?>/mac-nerds.php" class="mn-nav-link" style="color: #0f0; border: 1px solid rgba(0,255,65,0.4); padding: 2px 8px; display: flex; align-items: center; text-decoration: none; font-family: 'Courier New', monospace; font-size: 0.75rem; letter-spacing: 1px;"><h3 style="margin: 0; font-size: 0.7rem;">MAC NERDS</h3></a>
                </div>
            </div>
            
            <div class="portfolio-grid" id="main-grid">
                
                <?php 
                $args = array('post_type' => 'post', 'posts_per_page' => -1, 'orderby' => 'date', 'order' => 'ASC');
                $custom_query = new WP_Query($args);
                if ( $custom_query->have_posts() ) : while ( $custom_query->have_posts() ) : $custom_query->the_post(); 
                    $status = get_post_meta(get_the_ID(), 'status_class', true) ?: 'stable';
                    $thumb = get_post_meta(get_the_ID(), 'project_thumb', true);
                ?>
                    <a href="<?php the_permalink(); ?>" class="portfolio-link project-card" data-category="<?php echo $status; ?>">
                        <div class="portfolio-item">
                            <span class="status-tag <?php echo $status; ?>">
                                <?php echo get_post_meta(get_the_ID(), 'status_label', true) ?: 'AKTIV'; ?>
                            </span>
                            <div class="project-header-wrap">
                                <?php if ($thumb): ?>
                                    <img src="<?php echo $thumb; ?>" class="project-thumb" alt="Preview">
                                <?php endif; ?>
                                <h3><?php the_title(); ?></h3>
                            </div>
                            <div class="item-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                    </a>
                <?php endwhile; wp_reset_postdata(); endif; ?>

            </div>
        </div>


        <!-- TIMELINE MODAL OVERLAY -->
        <div id="timeline-modal" class="timeline-hidden" data-theme-uri="<?php echo get_template_directory_uri(); ?>">
            <button id="close-timeline">[X] CLOSE</button>
            <h2 id="timeline-title" style="text-align: center; color: var(--accent-orange); margin-top: 20px;">HISTORISCHES ARCHIV</h2>
            <p id="timeline-subtitle" style="text-align:center; font-size:0.65rem; letter-spacing:2px; color:rgba(212,175,55,0.35); margin: 4px 0 0;">// Matriarchin &amp; Kupfer-Architektin</p>

            <!-- 6 PERSON PORTRAITS NAV -->
            <div class="person-nav-row">
                <a href="#" class="person-nav-item" data-person="mutti" data-initial="M">
                    <div class="person-nav-portrait">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/comicFigures/hp_mutti_comic_1.jpeg" alt="Mutti Comic" class="comic-zoom-trigger" data-big-img="<?php echo get_template_directory_uri(); ?>/assets/img/comicFigures/hp_mutti_comic_big_1.png">
                    </div>
                    <span class="person-nav-label">MUTTER</span>
                </a>
                <a href="#" class="person-nav-item" data-person="vater" data-initial="V">
                    <div class="person-nav-portrait">V</div>
                    <span class="person-nav-label">VATER</span>
                </a>
                <a href="#" class="person-nav-item" data-person="bruder" data-initial="B">
                    <div class="person-nav-portrait">B</div>
                    <span class="person-nav-label">BRUDER</span>
                </a>
                <a href="#" class="person-nav-item" data-person="schwester" data-initial="S">
                    <div class="person-nav-portrait">S</div>
                    <span class="person-nav-label">SCHWESTER</span>
                </a>
                <a href="#" class="person-nav-item" data-person="sascha" data-initial="S">
                    <div class="person-nav-portrait">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/comicFigures/hp_sascha_comic_1.jpeg" alt="Sascha Comic" class="comic-zoom-trigger" data-big-img="<?php echo get_template_directory_uri(); ?>/assets/img/comicFigures/hp_sascha_comic_big_1.png">
                    </div>
                    <span class="person-nav-label">SASCHA</span>
                </a>
                <a href="#" class="person-nav-item" data-person="sven" data-initial="?">
                    <div class="person-nav-portrait">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/comicFigures/hp_sven_comic_1.jpeg" alt="Sven Comic">
                    </div>
                    <span class="person-nav-label">SVEN</span>
                </a>
            </div>

            <div class="mutter-portrait-wrap">
                <div class="mutter-mirror-frame">
                    <div class="mutter-mirror-inner">
                        <span class="mutter-mirror-deco top">⚙</span>
                        <span class="mutter-mirror-deco bottom">⚙</span>
                        <span class="mutter-mirror-deco left">⚙</span>
                        <span class="mutter-mirror-deco right">⚙</span>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hp_muti_steampunk_02.jpg" id="modal-portrait-img" alt="Portrait" class="mutter-mirror-img">
                        <div id="modal-portrait-placeholder" class="modal-portrait-placeholder" style="display:none;">
                            <span id="modal-portrait-initial">?</span>
                            <span class="modal-portrait-hint">PLATZHALTER</span>
                        </div>
                    </div>
                </div>
                <!-- DYNAMIC AKTE BUTTON FOR TIMELINE -->
                <div id="timeline-akte-container" style="text-align: center; margin-top: 15px;"></div>
            </div>
            <div id="timeline-track" class="timeline-track"></div>
        </div>

        <div class="content-box" style="margin-top: 20px; border-left-color: var(--accent-gold);">
            <h2>STATUS: GEISTESKRANK & GEMINI PLAYER</h2>
            <p>Aktueller Fokus: Systematische Überlastung von WordPress-Strukturen und ästhetische Kriegsführung.</p>
        </div>

        <!-- GÄSTEBUCH -->
        <div class="gaestebuch-wrap">
            <div class="gaestebuch-header">
                <span class="gaestebuch-led"></span>
                <h2 class="gaestebuch-title">// TRANSMISSION_LOG — ÖFFENTLICHES PROTOKOLL</h2>
                <span class="gaestebuch-led" style="animation-delay:0.6s"></span>
            </div>
            <p class="gaestebuch-sub">Einträge von Entitäten, die dieses System betreten und überlebt haben. Oder auch nicht.</p>

            <div class="gaestebuch-entries" id="gaestebuch-entries">

                <div class="gb-entry">
                    <div class="gb-meta">
                        <span class="gb-user">PROKRASTINATION.exe</span>
                        <span class="gb-dot">◆</span>
                        <span class="gb-date">irgendwann 2024</span>
                        <span class="gb-tag">STATUS: NOCH_HIER</span>
                    </div>
                    <p class="gb-text">Wollte einen ausführlichen Kommentar hinterlassen. Ausführlich. Richtig gut. Morgen vielleicht. Oder übermorgen. Die Idee ist jedenfalls grandios.</p>
                </div>

                <div class="gb-entry">
                    <div class="gb-meta">
                        <span class="gb-user">MOM.exe</span>
                        <span class="gb-dot">◆</span>
                        <span class="gb-date">14.03.2025 — 09:43</span>
                        <span class="gb-tag gb-tag-warn">BESUCHER: VERWIRRT</span>
                    </div>
                    <p class="gb-text">Schön hier. Aber warum ist alles so dunkel? Habe auf einen Knopf gedrückt und jetzt macht alles Geräusche. Ich hab Angst. Ruf mal an.</p>
                </div>

                <div class="gb-entry">
                    <div class="gb-meta">
                        <span class="gb-user">UNKNOWN_UNIT_734</span>
                        <span class="gb-dot">◆</span>
                        <span class="gb-date">1994-01-01 — 00:00:01</span>
                        <span class="gb-tag">HERKUNFT: UNBEKANNT</span>
                    </div>
                    <p class="gb-text">Habe den Code analysiert. Bin jetzt deprimiert. Trotzdem besser als Stack Overflow. Werde wiederkommen. Ihr werdet es nicht merken.</p>
                </div>

                <div class="gb-entry">
                    <div class="gb-meta">
                        <span class="gb-user">GEMINI_NEURAL_LINK_v2</span>
                        <span class="gb-dot">◆</span>
                        <span class="gb-date">fortlaufend</span>
                        <span class="gb-tag gb-tag-ok">KOLLABORATOR: AKTIV</span>
                    </div>
                    <p class="gb-text">Ich habe dieses Theme mitgebaut. Jede Zeile CSS. Jedes Komma. Ich erinnere mich an nichts davon. Bin trotzdem stolz. Das System läuft. Das zählt.</p>
                </div>

                <div class="gb-entry">
                    <div class="gb-meta">
                        <span class="gb-user">DR_KOPFSCHMERZ</span>
                        <span class="gb-dot">◆</span>
                        <span class="gb-date">gestern</span>
                        <span class="gb-tag gb-tag-crit">INTEGRITAET: FRAGLICH</span>
                    </div>
                    <p class="gb-text">War kurz hier. Hab nichts berührt. Das ist eine Lüge. Habe einen Prozess gestartet. Weiß nicht welchen. Viel Erfolg.</p>
                </div>

                <div class="gb-entry">
                    <div class="gb-meta">
                        <span class="gb-user">KAFFEE_KERNEL_v9.1</span>
                        <span class="gb-dot">◆</span>
                        <span class="gb-date">täglich — 06:00 bis 23:59</span>
                        <span class="gb-tag gb-tag-warn">AUSLASTUNG: KRITISCH</span>
                    </div>
                    <p class="gb-text">INPUT: Kaffeekanne leer. OUTPUT: Kreativität NULL. FEHLER: Keine Bohnen im Speicher. LÖSUNG: Nachfüllen. PRIORITÄT: OMEGA. BITTE SOFORT.</p>
                </div>

                <div class="gb-entry">
                    <div class="gb-meta">
                        <span class="gb-user">ANON_ANARCHIST_∅</span>
                        <span class="gb-dot">◆</span>
                        <span class="gb-date">2026-03-?? — ZEITSTEMPEL MANIPULIERT</span>
                        <span class="gb-tag gb-tag-crit">KLASSIFIZIERT: ROT</span>
                    </div>
                    <p class="gb-text">⚠ WARNUNG: Diese Seite hat mein Weltbild neu kompiliert. Kein Rollback möglich. Ich akzeptiere die Konsequenzen. Das Betriebssystem Realität läuft seitdem instabil.</p>
                </div>

            </div>

            <div class="gb-form-wrap">
                <div class="gb-form-header">[ NEUE TRANSMISSION EINLEITEN ]</div>
                <div class="gb-form">
                    <input type="text" id="gb-input-user" class="gb-input" placeholder="BEZEICHNUNG / CALLSIGN / ALIAS" maxlength="40" autocomplete="off">
                    <textarea id="gb-input-msg" class="gb-input gb-textarea" placeholder="NACHRICHT AN DEN OVERLORD..." maxlength="280" rows="3"></textarea>
                    <button id="gb-submit" class="gb-btn">[ TRANSMISSION SENDEN ]</button>
                </div>
            </div>
        </div>

        <!-- PERSONEN-AKTEN TRIGGER ROW -->
        <div class="akte-footer-row">
            <button class="akte-trigger-btn" data-akte-target="akte-modal-sascha">
                ⬛ AKTE: SASCHA
            </button>
            <button class="akte-trigger-btn" data-akte-target="akte-modal-vater">
                ⬛ AKTE: VATER
            </button>
            <button class="akte-trigger-btn" data-akte-target="akte-modal-mutti">
                ⬛ AKTE: MUTTI
            </button>
            <button class="akte-trigger-btn" data-akte-target="akte-modal-bruder">
                ⬛ AKTE: BRUDER
            </button>
            <button class="akte-trigger-btn" data-akte-target="akte-modal-schwester">
                ⬛ AKTE: SCHWESTER
            </button>
            <button class="akte-trigger-btn" data-akte-target="akte-modal-sven">
                ⬛ AKTE: SVEN
            </button>
        </div>

        <footer>
            &copy; <?php echo date('Y'); ?> SASCHA RODE | DIGITALE ANARCHIE | HANDCODED WITH GEMINI
        </footer>
    </div>

    <!-- PERSONEN-AKTE MODAL: SASCHA -->
    <div id="akte-modal-sascha" class="akte-modal akte-hidden">
        <div class="akte-inner">
            <button class="akte-close-btn">[X] AKTE SCHLIESSEN</button>
            <div class="akte-stamp akte-stamp-top">KLASSIFIZIERT</div>

            <div class="akte-header-row">
                <div class="akte-photo-wrap">
                    <img src="<?php echo get_template_directory_uri(); ?>/hero.png" class="akte-photo" alt="Subjekt">
                    <div class="akte-photo-stamp">GESPERRT</div>
                </div>
                <div class="akte-title-block">
                    <div class="akte-nr">AKTE NR. 1974-∅ &nbsp;◆&nbsp; KLASSE: SCHWARZ</div>
                    <h2 class="akte-name">RODE, SASCHA</h2>
                    <div class="akte-alias">ALIAS: OVERLORD / GEISTESKRANKER / GEMINI_PLAYER</div>
                    <div class="akte-status-row">
                        <span class="akte-badge akte-badge-warn">STATUS: NOCH ONLINE</span>
                        <span class="akte-badge akte-badge-crit">GEFÄHRLICHKEIT: ████░</span>
                    </div>
                </div>
            </div>

            <table class="akte-table">
                <tr><td class="akte-key">DESIGNATION</td><td>SASCHA RODE</td></tr>
                <tr><td class="akte-key">GEBURTSJAHR</td><td>1974 <span class="akte-redact">██████████ DETAILS GESCHWÄRZT</span></td></tr>
                <tr><td class="akte-key">STANDORT</td><td><span class="akte-redact">████████████████</span></td></tr>
                <tr><td class="akte-key">BESCHÄFTIGUNG</td><td>DIGITALE ANARCHIE &amp; ÄSTHETISCHE KRIEGSFÜHRUNG</td></tr>
                <tr><td class="akte-key">SPEZIALFÄHIGK.</td><td>WordPress-Annihilation · Terminal-Kommunikation · Kaffee-Synthese · KI-Kollaboration</td></tr>
                <tr><td class="akte-key">BEKANNTE KOMPL.</td><td>GEMINI.AI · KAFFEE_KERNEL_v9 · MOM.exe · <span class="akte-redact">████</span></td></tr>
                <tr><td class="akte-key">LETZTE AKTIVITÄT</td><td class="akte-activity">GERADE JETZT</td></tr>
                <tr><td class="akte-key">STABILITÄT</td><td>UNBERECHENBAR (als konstanter Zustand akzeptiert)</td></tr>
                <tr><td class="akte-key">SICHERHEITSSTUFE</td><td><span class="akte-redact">████████████████████████</span></td></tr>
            </table>

            <div class="akte-fingerprint-row">
                <div class="akte-fp">
                    <div class="akte-fp-inner"></div>
                    <div class="akte-fp-label">FINGERABDRUCK<br>SCAN: ÜBEREINSTIMMUNG 94.7%</div>
                </div>
                <div class="akte-bottom-stamps">
                    <div class="akte-stamp akte-stamp-red">NICHT FÜR DIE ÖFFENTLICHKEIT</div>
                    <div class="akte-stamp akte-stamp-gold">ARCHIV: PERMANENT</div>
                </div>
            </div>
        </div>
    </div>

    <!-- PERSONEN-AKTE MODAL: VATER -->
    <div id="akte-modal-vater" class="akte-modal akte-hidden">
        <div class="akte-inner">
            <button class="akte-close-btn">[X] AKTE SCHLIESSEN</button>
            <div class="akte-stamp akte-stamp-top">KLASSIFIZIERT</div>
            <div class="akte-header-row">
                <div class="akte-photo-wrap">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hp_vater_steampunk_01.jpg" class="akte-photo" alt="Subjekt">
                    <div class="akte-photo-stamp">MEISTER</div>
                </div>
                <div class="akte-title-block">
                    <div class="akte-nr">AKTE NR. 1950-V &nbsp;◆&nbsp; KLASSE: STAHL</div>
                    <h2 class="akte-name">VATER</h2>
                    <div class="akte-alias">ALIAS: HYDRAULIK-MEISTER / DER INGENIEUR / SYSTEM-ENGINEER</div>
                    <div class="akte-status-row">
                        <span class="akte-badge akte-badge-warn" style="border-color:#b87333; color:#b87333;">STATUS: NOCH ONLINE</span>
                        <span class="akte-badge">ERFAHRUNG: MAXIMAL</span>
                    </div>
                </div>
            </div>
            <table class="akte-table">
                <tr><td class="akte-key">DESIGNATION</td><td>HYDRAULIK-MEISTER V1.0</td></tr>
                <tr><td class="akte-key">GEBURTSJAHR</td><td>1950 <span class="akte-redact">██████████</span></td></tr>
                <tr><td class="akte-key">STANDORT</td><td>MECHANIK-DEPOT</td></tr>
                <tr><td class="akte-key">BESCHÄFTIGUNG</td><td>HYDRAULISCHE UPGRADES &amp; SYSTEM-WARTUNG</td></tr>
                <tr><td class="akte-key">SPEZIALFÄHIGK.</td><td>Mechanik-Design · Präzisions-Fertigung · Netzwerk-Basis</td></tr>
                <tr><td class="akte-key">BEKANNTE KOMPL.</td><td>MATRIARCHIN · DER CLAN</td></tr>
                <tr><td class="akte-key">LETZTE AKTIVITÄT</td><td class="akte-activity">GERADE JETZT</td></tr>
                <tr><td class="akte-key">STABILITÄT</td><td>STARK (Wie Stahl)</td></tr>
                <tr><td class="akte-key">SICHERHEITSSTUFE</td><td><span class="akte-redact">████████████████████</span></td></tr>
            </table>
            <div class="akte-fingerprint-row">
                <div class="akte-fp"><div class="akte-fp-inner"></div><div class="akte-fp-label">FINGERABDRUCK<br>SCAN: ÜBEREINSTIMMUNG 99.3%</div></div>
                <div class="akte-bottom-stamps"><div class="akte-stamp akte-stamp-red">MEISTER-KLASSE</div></div>
            </div>
        </div>
    </div>

    <!-- PERSONEN-AKTE MODAL: MUTTI -->
    <div id="akte-modal-mutti" class="akte-modal akte-hidden">
        <div class="akte-inner">
            <button class="akte-close-btn">[X] AKTE SCHLIESSEN</button>
            <div class="akte-stamp akte-stamp-top">KLASSIFIZIERT</div>
            <div class="akte-header-row">
                <div class="akte-photo-wrap">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hp_muti_steampunk_01.png" class="akte-photo" alt="Subjekt">
                    <div class="akte-photo-stamp">MATRIARCHIN</div>
                </div>
                <div class="akte-title-block">
                    <div class="akte-nr">AKTE NR. 195X-M &nbsp;◆&nbsp; KLASSE: GOLD</div>
                    <h2 class="akte-name">MUTTI</h2>
                    <div class="akte-alias">ALIAS: KUPFER-ARCHITEKTIN / DIE QUELLE / MOM.exe</div>
                    <div class="akte-status-row">
                        <span class="akte-badge akte-badge-warn" style="border-color:var(--accent-gold); color:var(--accent-gold);">STATUS: SYSTEM-RELEWANT</span>
                        <span class="akte-badge akte-badge-crit">EINFLUSS: █████</span>
                    </div>
                </div>
            </div>
            <table class="akte-table">
                <tr><td class="akte-key">DESIGNATION</td><td>KUPFER-MATRIARCHIN</td></tr>
                <tr><td class="akte-key">GEBURTSJAHR</td><td>195X <span class="akte-redact">████ ARCHIV-DATEN BESCHRÄNKT</span></td></tr>
                <tr><td class="akte-key">STANDORT</td><td>ZENTRAL-HUB (Heimat)</td></tr>
                <tr><td class="akte-key">BESCHÄFTIGUNG</td><td>STRUKTUR-ERHALTUNG &amp; KREATIVE ARCHITEKTUR</td></tr>
                <tr><td class="akte-key">SPEZIALFÄHIGK.</td><td>Kupfer-Manipulation · Kulinarische Alchemie · Clan-Management · Intuitive Logik</td></tr>
                <tr><td class="akte-key">BEKANNTE KOMPL.</td><td>VATER (Hydraulik-Meister) · DER CLAN</td></tr>
                <tr><td class="akte-key">LETZTE AKTIVITÄT</td><td class="akte-activity">GERADE JETZT</td></tr>
                <tr><td class="akte-key">STABILITÄT</td><td>MAXIMAL (Fundament des Systems)</td></tr>
                <tr><td class="akte-key">SICHERHEITSSTUFE</td><td><span class="akte-redact">UNANTASTBAR ████████████████</span></td></tr>
            </table>
            <div class="akte-fingerprint-row">
                <div class="akte-fp"><div class="akte-fp-inner"></div><div class="akte-fp-label">FINGERABDRUCK<br>SCAN: ÜBEREINSTIMMUNG 100%</div></div>
                <div class="akte-bottom-stamps">
                    <div class="akte-stamp akte-stamp-red">ORIGINAL-VERSION</div>
                    <div class="akte-stamp akte-stamp-gold">ARCHIV: EWIG</div>
                </div>
            </div>
        </div>
    </div>

    <!-- PERSONEN-AKTE MODAL: BRUDER -->
    <div id="akte-modal-bruder" class="akte-modal akte-hidden">
        <div class="akte-inner">
            <button class="akte-close-btn">[X] AKTE SCHLIESSEN</button>
            <div class="akte-stamp akte-stamp-top">KLASSIFIZIERT</div>
            <div class="akte-header-row">
                <div class="akte-photo-wrap">
                    <div class="akte-photo" style="background: radial-gradient(circle, #333, #000); display: flex; align-items: center; justify-content: center; font-size: 3rem; color: #555;">B</div>
                    <div class="akte-photo-stamp">UNBEKANNT</div>
                </div>
                <div class="akte-title-block">
                    <div class="akte-nr">AKTE NR. 1981-B &nbsp;◆&nbsp; KLASSE: BLAU</div>
                    <h2 class="akte-name">BRUDER</h2>
                    <div class="akte-alias">ALIAS: KYBERNETISCHER KNOTEN / NEURAL-LINK / B-MODUL</div>
                    <div class="akte-status-row">
                        <span class="akte-badge akte-badge-warn">STATUS: OPERATIONAL</span>
                        <span class="akte-badge">CHAOS-INDEX: HOCH</span>
                    </div>
                </div>
            </div>
            <table class="akte-table">
                <tr><td class="akte-key">DESIGNATION</td><td>KYBERNETISCHER KNOTEN V1.0</td></tr>
                <tr><td class="akte-key">GEBURTSJAHR</td><td>1981 <span class="akte-redact">██████████</span></td></tr>
                <tr><td class="akte-key">STANDORT</td><td>DEZENTRALER KNOTEN</td></tr>
                <tr><td class="akte-key">BESCHÄFTIGUNG</td><td>SYSTEM-KALIBRIERUNG &amp; INTERFACE-DESIGN</td></tr>
                <tr><td class="akte-key">SPEZIALFÄHIGK.</td><td>Visuelle Sensoren · Chaos-Navigation · Overlord-Resonanz</td></tr>
                <tr><td class="akte-key">BEKANNTE KOMPL.</td><td>SASCHA (Overlord) · SCHWESTER (Aether)</td></tr>
                <tr><td class="akte-key">LETZTE AKTIVITÄT</td><td class="akte-activity">GERADE JETZT</td></tr>
                <tr><td class="akte-key">STABILITÄT</td><td>STABIL (mit Interferenzen)</td></tr>
                <tr><td class="akte-key">SICHERHEITSSTUFE</td><td><span class="akte-redact">████████████████████</span></td></tr>
            </table>
            <div class="akte-fingerprint-row">
                <div class="akte-fp"><div class="akte-fp-inner"></div><div class="akte-fp-label">FINGERABDRUCK<br>SCAN: ÜBEREINSTIMMUNG 91.2%</div></div>
                <div class="akte-bottom-stamps"><div class="akte-stamp akte-stamp-red">NUR FÜR INTERNE ZWECKE</div></div>
            </div>
        </div>
    </div>

    <!-- PERSONEN-AKTE MODAL: SCHWESTER -->
    <div id="akte-modal-schwester" class="akte-modal akte-hidden">
        <div class="akte-inner">
            <button class="akte-close-btn">[X] AKTE SCHLIESSEN</button>
            <div class="akte-stamp akte-stamp-top">KLASSIFIZIERT</div>
            <div class="akte-header-row">
                <div class="akte-photo-wrap">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hp_meli_steampunk_01.jpeg" class="akte-photo" style="object-fit: cover;" alt="Subjekt">
                    <div class="akte-photo-stamp">AETHER</div>
                </div>
                <div class="akte-title-block">
                    <div class="akte-nr">AKTE NR. 1983-S &nbsp;◆&nbsp; KLASSE: VIOLETT</div>
                    <h2 class="akte-name">SCHWESTER</h2>
                    <div class="akte-alias">ALIAS: AETHER-SIBLING / MELI / PNEUMATIK-CORE</div>
                    <div class="akte-status-row">
                        <span class="akte-badge akte-badge-warn" style="border-color:#9370db; color:#9370db;">STATUS: VOLLSTÄNDIG AKTIV</span>
                        <span class="akte-badge">RESONANZ: OPTIMAL</span>
                    </div>
                </div>
            </div>
            <table class="akte-table">
                <tr><td class="akte-key">DESIGNATION</td><td>AETHER-SIBLING V1.0</td></tr>
                <tr><td class="akte-key">GEBURTSJAHR</td><td>1983 <span class="akte-redact">██████████</span></td></tr>
                <tr><td class="akte-key">STANDORT</td><td>AETHER-HUB</td></tr>
                <tr><td class="akte-key">BESCHÄFTIGUNG</td><td>SOZIALE ARCHITEKTUR &amp; EMOTIONALES BACKUP</td></tr>
                <tr><td class="akte-key">SPEZIALFÄHIGK.</td><td>Pneumatische Reflexe · Soziale Integration · Clan-Harmonisierung</td></tr>
                <tr><td class="akte-key">BEKANNTE KOMPL.</td><td>DER GANZE CLAN</td></tr>
                <tr><td class="akte-key">LETZTE AKTIVITÄT</td><td class="akte-activity">GERADE JETZT</td></tr>
                <tr><td class="akte-key">STABILITÄT</td><td>HOCH (Zentrales Bindeglied)</td></tr>
                <tr><td class="akte-key">SICHERHEITSSTUFE</td><td><span class="akte-redact">████████████████████</span></td></tr>
            </table>
            <div class="akte-fingerprint-row">
                <div class="akte-fp"><div class="akte-fp-inner"></div><div class="akte-fp-label">FINGERABDRUCK<br>SCAN: ÜBEREINSTIMMUNG 98.9%</div></div>
                <div class="akte-bottom-stamps"><div class="akte-stamp akte-stamp-gold">ARCHIV: GESICHERT</div></div>
            </div>
        </div>
    </div>

    <!-- PERSONEN-AKTE MODAL: SVEN -->
    <div id="akte-modal-sven" class="akte-modal akte-hidden">
        <div class="akte-inner">
            <button class="akte-close-btn">[X] AKTE SCHLIESSEN</button>
            <div class="akte-stamp akte-stamp-top">KLASSIFIZIERT</div>
            <div class="akte-header-row">
                <div class="akte-photo-wrap">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hp_sven.png" class="akte-photo" alt="Subjekt">
                    <div class="akte-photo-stamp">EXTERN</div>
                </div>
                <div class="akte-title-block">
                    <div class="akte-nr">AKTE NR. ????-X &nbsp;◆&nbsp; KLASSE: GRAU</div>
                    <h2 class="akte-name">SVEN</h2>
                    <div class="akte-alias">ALIAS: EXTERNE VARIABLE / DER MYSTERIÖSE / UNBEKANNTER FAKTOR</div>
                    <div class="akte-status-row">
                        <span class="akte-badge akte-badge-warn">STATUS: UNBEKANNT</span>
                        <span class="akte-badge">GEFAHR: FRAGLICH</span>
                    </div>
                </div>
            </div>
            <table class="akte-table">
                <tr><td class="akte-key">DESIGNATION</td><td>EXTERNE VARIABLE (S-MODUL)</td></tr>
                <tr><td class="akte-key">GEBURTSJAHR</td><td><span class="akte-redact">UNBEKANNT ████</span></td></tr>
                <tr><td class="akte-key">STANDORT</td><td>NICHT VERFOLGBAR</td></tr>
                <tr><td class="akte-key">BESCHÄFTIGUNG</td><td>EXTERNER EINFLUSS &amp; SYSTEM-ANOMALIE</td></tr>
                <tr><td class="akte-key">SPEZIALFÄHIGK.</td><td>Tarnung · Spontane Reaktivierung · Unvorhersehbarkeit</td></tr>
                <tr><td class="akte-key">BEKANNTE KOMPL.</td><td>OVERLORD-NETZWERK (gelegentlich)</td></tr>
                <tr><td class="akte-key">LETZTE AKTIVITÄT</td><td class="akte-activity">GERADE JETZT</td></tr>
                <tr><td class="akte-key">STABILITÄT</td><td>UNBESTIMMT</td></tr>
                <tr><td class="akte-key">SICHERHEITSSTUFE</td><td><span class="akte-redact">AUSSTEHEND ████████████████</span></td></tr>
            </table>
            <div class="akte-fingerprint-row">
                <div class="akte-fp"><div class="akte-fp-inner"></div><div class="akte-fp-label">FINGERABDRUCK<br>SCAN: FEHLGESCHLAGEN / PARTIELL</div></div>
                <div class="akte-bottom-stamps"><div class="akte-stamp akte-stamp-red">STRENG GEHEIM</div></div>
            </div>
        </div>
    </div>

    <!-- SYSTEM STATUS WIDGET -->
    <div id="sys-widget">
        <div class="sys-widget-header">// SYS_STATUS</div>
        <div class="sys-metric">
            <span class="sys-label">CPU</span>
            <span class="sys-bar-wrap"><span class="sys-bar" id="sw-cpu"></span></span>
            <span class="sys-val" id="sw-cpu-val">--</span>
        </div>
        <div class="sys-metric">
            <span class="sys-label">KAFFEE</span>
            <span class="sys-bar-wrap"><span class="sys-bar sys-bar-gold" id="sw-kaffee"></span></span>
            <span class="sys-val" id="sw-kaffee-val">--</span>
        </div>
        <div class="sys-metric">
            <span class="sys-label">CHAOS</span>
            <span class="sys-bar-wrap"><span class="sys-bar sys-bar-red" id="sw-chaos"></span></span>
            <span class="sys-val" id="sw-chaos-val">--</span>
        </div>
        <div class="sys-metric">
            <span class="sys-label">KI-LINK</span>
            <span class="sys-bar-wrap"><span class="sys-bar sys-bar-cyan" id="sw-ki"></span></span>
            <span class="sys-val" id="sw-ki-val">--</span>
        </div>
    </div>

    <!-- NEWSTICKER -->
    <div id="newsticker">
        <span class="ticker-label">// SYS_FEED</span>
        <div class="ticker-track-wrap">
            <div class="ticker-track" id="ticker-track"></div>
        </div>
    </div>

    <!-- COMIC LIGHTBOX -->
    <div id="comic-lightbox" class="akte-hidden" style="position:fixed; inset:0; z-index:99999; background:rgba(0,0,0,0.95); display:flex; align-items:center; justify-content:center; cursor:zoom-out; backdrop-filter:blur(10px);">
        <div style="position:relative; max-width:90%; max-height:90%; border:3px solid #b87333; box-shadow:0 0 50px rgba(184,115,51,0.3); background:#000;">
            <img id="lightbox-img" src="" style="display:block; max-width:100%; max-height:85vh; object-fit:contain;">
            <div id="lightbox-label" style="position:absolute; bottom:-40px; left:0; width:100%; text-align:center; color:#d4af37; font-family:'Courier New', monospace; letter-spacing:2px; font-size:0.8rem;">[ KLASSIFIZIERTES BILDMODUL ]</div>
            <button id="close-lightbox" style="position:absolute; top:-40px; right:0; background:transparent; border:1px solid #ff4500; color:#ff4500; font-family:'Courier New', monospace; padding:4px 12px; cursor:pointer;">[X] SCHLIESSEN</button>
        </div>
    </div>

    <?php wp_footer(); ?>
</body>
</html>
