<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DIGITALE ANARCHIE | KI-LABOR</title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
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

        <div id="system-log">
            <div id="log-output"></div>
            <div class="terminal-input-line">
                <span class="prompt">></span>
                <input type="text" id="terminal-input" placeholder="SYSTEMBEFEHL EINGEBEN (help für Liste)..." autocomplete="off">
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
                </div>
            </div>
            
            <div class="portfolio-grid" id="main-grid">
                
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
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
                <?php endwhile; endif; ?>

            </div>
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
