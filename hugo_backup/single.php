<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php the_title(); ?> | DIGITALE ANARCHIE</title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div class="container">
        <header>
            <h1><a href="<?php echo home_url(); ?>" style="color: var(--accent-orange); text-decoration: none;">[ ZURÜCK ZUR BASIS ]</a></h1>
            <p class="tagline"><?php the_title(); ?></p>
        </header>

        <div class="content-box" style="position: relative; overflow: hidden;">
            <div class="classification-stamp">TOP SECRET</div>
            <div class="mission-header" style="border-bottom: 1px solid #333; margin-bottom: 20px; padding-bottom: 10px;">
                <span class="status-tag stable">MISSION REPORT</span>
                <p style="font-size: 0.8rem; color: #666;">DATUM: <?php echo get_the_date(); ?> | STATUS: ABGESCHLOSSEN</p>
            </div>

            <article class="mission-content decrypt-me" style="line-height: 1.8; color: #bbb;">
                <?php if (have_posts()) : while (have_posts()) : the_post(); 
                    the_content(); 
                endwhile; endif; ?>
            </article>

            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const el = document.querySelector('.decrypt-me');
                    const originalHTML = el.innerHTML;
                    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+';
                    let iterations = 0;
                    
                    // Neural Audio Synth
                    const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                    function playTick() {
                        if (audioCtx.state === 'suspended') audioCtx.resume();
                        const osc = audioCtx.createOscillator();
                        const gain = audioCtx.createGain();
                        osc.type = 'square'; // Mechanischer Sound
                        osc.frequency.setValueAtTime(Math.random() * 100 + 50, audioCtx.currentTime);
                        gain.gain.setValueAtTime(0.02, audioCtx.currentTime);
                        gain.gain.exponentialRampToValueAtTime(0.0001, audioCtx.currentTime + 0.05);
                        osc.connect(gain);
                        gain.connect(audioCtx.destination);
                        osc.start();
                        osc.stop(audioCtx.currentTime + 0.05);
                    }

                    const interval = setInterval(() => {
                        let isInsideTag = false;
                        el.innerHTML = originalHTML
                            .split('')
                            .map((char, index) => {
                                if (char === '<') isInsideTag = true;
                                if (isInsideTag) {
                                    if (char === '>') isInsideTag = false;
                                    return char;
                                }
                                if (index < iterations) return char;
                                return characters[Math.floor(Math.random() * characters.length)];
                            })
                            .join('');
                        
                        if (iterations % 90 === 0) playTick();
                        
                        if (iterations >= originalHTML.length) {
                            clearInterval(interval);
                            el.innerHTML = originalHTML; // Finaler Check für Sicherheit
                            audioCtx.close();
                        }
                        iterations += 30;
                    }, 30);
                });
            </script>

            <style>
                .mission-content p { margin-bottom: 20px; }
                .mission-content strong { color: var(--accent-gold); }
                .decrypt-me { transition: filter 0.5s; }

                /* INLINE NEWSTICKER CSS */
                #newsticker {
                    position: fixed !important;
                    bottom: 0 !important;
                    left: 0 !important;
                    right: 0 !important;
                    z-index: 999999 !important;
                    background: rgba(0,0,0,0.95) !important;
                    border-top: 1px solid rgba(255,69,0,0.4) !important;
                    display: flex !important;
                    align-items: center !important;
                    height: 30px !important;
                    overflow: hidden !important;
                    visibility: visible !important;
                    opacity: 1 !important;
                }
                .ticker-label {
                    flex-shrink: 0;
                    font-size: 0.6rem;
                    letter-spacing: 2px;
                    color: rgba(255,69,0,0.8);
                    padding: 0 15px;
                    border-right: 1px solid rgba(255,69,0,0.2);
                    white-space: nowrap;
                    height: 100%;
                    display: flex;
                    align-items: center;
                    background: rgba(255,69,0,0.05);
                    font-family: 'Courier New', monospace;
                }
                .ticker-track-wrap {
                    flex: 1;
                    overflow: hidden;
                    height: 100%;
                    display: flex;
                    align-items: center;
                }
                .ticker-track {
                    display: inline-flex;
                    gap: 0;
                    white-space: nowrap;
                    animation: ticker-scroll 40s linear infinite;
                }
                @keyframes ticker-scroll {
                    0%   { transform: translateX(0); }
                    100% { transform: translateX(-50%); }
                }
                .ticker-item {
                    font-size: 0.65rem;
                    letter-spacing: 1px;
                    color: rgba(212,175,55,0.7);
                    padding: 0 30px;
                    font-family: 'Courier New', monospace;
                    text-transform: uppercase;
                }
                .ticker-item::before {
                    content: '▶ ';
                    color: rgba(255,69,0,0.5);
                }
            </style>
        </div>

        <footer>
            &copy; <?php echo date('Y'); ?> SASCHA RODE | DIGITALE ANARCHIE | HANDCODED WITH GEMINI
        </footer>
    </div>

    <!-- REAL STEAMPUNK TICKER FOOTER -->
    <div id="newsticker" style="position:fixed !important; bottom:0 !important; left:0 !important; right:0 !important; z-index:999999 !important; background:rgba(0,0,0,0.92) !important; border-top:1px solid rgba(255,69,0,0.35) !important; display:flex !important; align-items:center; height:28px !important; overflow:hidden; font-family:'Courier New', monospace !important;">
        <span class="ticker-label" style="flex-shrink:0; font-size:0.6rem; letter-spacing:2px; color:rgba(255,69,0,0.7); padding:0 15px; border-right:1px solid rgba(255,69,0,0.2); white-space:nowrap; height:100%; display:flex; align-items:center; background:rgba(255,69,0,0.05);">// MISSION_REPORT_FEED</span>
        <div class="ticker-track-wrap" style="flex:1; overflow:hidden; height:100%; display:flex; align-items:center;">
            <div class="ticker-track" id="ticker-track-single" style="display:inline-flex; white-space:nowrap; animation: ticker-scroll 40s linear infinite;">
                <!-- Initialer Content für sofortige Sichtbarkeit -->
                <span class="ticker-item" style="font-size:0.65rem; letter-spacing:1px; color:rgba(212,175,55,0.7); padding:0 30px; text-transform:uppercase;">[ INITIALISIERE ÜBERTRAGUNG... ]</span>
                <span class="ticker-item" style="font-size:0.65rem; letter-spacing:1px; color:rgba(212,175,55,0.7); padding:0 30px; text-transform:uppercase;">[ DATENPAKETE WERDEN ENTSCHLÜSSELT... ]</span>
            </div>
        </div>
    </div>

    <style>
        @keyframes ticker-scroll {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .ticker-item::before { content: '▶ '; color: rgba(255,69,0,0.5); }
    </style>

    <script>
        (function() {
            const track = document.getElementById('ticker-track-single');
            if (!track) return;
            const title = "<?php echo get_the_title(); ?>";
            const date = "<?php echo get_the_date(); ?>";
            const ITEMS = [
                { t: 'REPORT: ' + title.toUpperCase(), cls: '' },
                { t: 'STATUS: ARCHIVIERT // ' + date, cls: '' },
                { t: 'DECRYPT-MODUL: AKTIV', cls: '' },
                { t: 'INTEGRITÄT: 100%', cls: '' },
                { t: 'WARNUNG: KAFFEESTAND KRITISCH', cls: '' },
                { t: 'KI-LINK: AKTIV', cls: '' }
            ];
            track.innerHTML = ''; // Platzhalter löschen
            [...ITEMS, ...ITEMS, ...ITEMS].forEach(({ t }) => {
                const span = document.createElement('span');
                span.className = 'ticker-item';
                span.style.cssText = "font-size:0.65rem; letter-spacing:1px; color:rgba(212,175,55,0.7); padding:0 30px; text-transform:uppercase;";
                span.textContent = t;
                track.appendChild(span);
            });
        })();
    </script>

    <?php wp_footer(); ?>
</body>
</html>
