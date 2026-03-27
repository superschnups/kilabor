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

        <!-- TERMINAL COMMAND CARDS -->
        <div class="cmd-cards-section">
            <div class="cmd-card">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hero_07.png" class="cmd-card-img" alt="Weather Scan">
                <div class="cmd-card-body">
                    <span class="cmd-card-label">[ PROTOKOLL #001 ]</span>
                    <h3 class="cmd-card-title">&gt; weather</h3>
                    <p class="cmd-card-text">Das Wetter? Irrelevant. Was zählt ist der Chaos-Level in deinen Schaltkreisen. Dieser Scanner analysiert atmosphärische Destabilisierung, Koffein-Sättigung und die Wahrscheinlichkeit eines kreativen Ausbruchs. Meteorologen hassen diesen Trick.</p>
                    <span class="cmd-card-hint">Eingabe im Terminal: <code>weather</code></span>
                </div>
            </div>
            <div class="cmd-card">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hp_muti_steampunk_01.png" class="cmd-card-img" alt="System Top">
                <div class="cmd-card-body">
                    <span class="cmd-card-label">[ PROTOKOLL #002 ]</span>
                    <h3 class="cmd-card-title">&gt; top</h3>
                    <p class="cmd-card-text">Welche dämonischen Prozesse laufen gerade im Hintergrund? KREATIVITAET.exe frisst 94% CPU. PROKRASTINATION.app wurde erfolgreich suspendiert. SELBSTZWEIFEL.exe ist – endlich – terminiert. Ein Blick in den Maschinenraum des Overlords.</p>
                    <span class="cmd-card-hint">Eingabe im Terminal: <code>top</code></span>
                </div>
            </div>
            <div class="cmd-card">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hp_vater_steampunk_01.jpg" class="cmd-card-img" alt="System Uptime">
                <div class="cmd-card-body">
                    <span class="cmd-card-label">[ PROTOKOLL #003 ]</span>
                    <h3 class="cmd-card-title">&gt; uptime</h3>
                    <p class="cmd-card-text">Das System läuft seit 1974. Ungeplant. Ohne Handbuch. Mit minimaler Wartung und maximalem Kaffee-Input. Aktuelle Laufzeit in Tagen, Stunden, Minuten – live berechnet. Stabilität: unberechenbar. Status: noch online. Irgendwie.</p>
                    <span class="cmd-card-hint">Eingabe im Terminal: <code>uptime</code></span>
                </div>
            </div>
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
        <div id="timeline-modal" class="timeline-hidden">
            <button id="close-timeline">[X] CLOSE</button>
            <h2 id="timeline-title" style="text-align: center; color: var(--accent-orange); margin-top: 20px;">HISTORISCHES ARCHIV</h2>
            <div class="mutter-portrait-wrap">
                <div class="mutter-mirror-frame">
                    <div class="mutter-mirror-inner">
                        <span class="mutter-mirror-deco top">⚙</span>
                        <span class="mutter-mirror-deco bottom">⚙</span>
                        <span class="mutter-mirror-deco left">⚙</span>
                        <span class="mutter-mirror-deco right">⚙</span>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hp_muti_steampunk_02.jpg" alt="Die Matriarchin" class="mutter-mirror-img">
                    </div>
                </div>
            </div>
            <div id="timeline-track" class="timeline-track"></div>
        </div>

        <div class="content-box" style="margin-top: 20px; border-left-color: var(--accent-gold);">
            <h2>STATUS: GEISTESKRANK & GEMINI PLAYER</h2>
            <p>Aktueller Fokus: Systematische Überlastung von WordPress-Strukturen und ästhetische Kriegsführung.</p>
        </div>

        <footer>
            &copy; <?php echo date('Y'); ?> SASCHA RODE | DIGITALE ANARCHIE | HANDCODED WITH GEMINI
        </footer>
    </div>
    <?php wp_footer(); ?>
</body>
</html>
