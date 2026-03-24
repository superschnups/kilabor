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
            </style>
        </div>

        <footer>
            &copy; <?php echo date('Y'); ?> SASCHA RODE | DIGITALE ANARCHIE | HANDCODED WITH GEMINI
        </footer>
    </div>
    <?php wp_footer(); ?>
</body>
</html>
