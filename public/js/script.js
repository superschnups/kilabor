// ═══════════════════════════════════════
// KI-LABOR CORE ENGINE (HUGO EDITION)
// ═══════════════════════════════════════
(function() {
    document.addEventListener('DOMContentLoaded', () => {
        // --- CORE ELEMENTS ---
        const bootScreen = document.getElementById('boot-screen');
        const bootLog    = document.getElementById('boot-log');
        const mainContent = document.querySelector('.main-content');
        const terminalInput = document.getElementById('terminal-input');
        const logOutput = document.getElementById('log-output');
        const fortuneText = document.getElementById('fortune-text');

        // --- MATRIX RAIN INITIALIZATION ---
        const canvas = document.createElement('canvas');
        canvas.id = 'matrix-canvas';
        canvas.style.cssText = 'position:fixed;top:0;left:0;width:100%;height:100%;z-index:-1;opacity:0;transition:opacity 1s;pointer-events:none;';
        document.body.appendChild(canvas);
        const ctx = canvas.getContext('2d');
        let w, h, columns;
        const drops = [];

        function initMatrix() {
            w = canvas.width = window.innerWidth;
            h = canvas.height = window.innerHeight;
            columns = Math.floor(w / 20);
            for (let i = 0; i < columns; i++) drops[i] = 1;
        }

        function drawMatrix() {
            ctx.fillStyle = 'rgba(0, 0, 0, 0.05)';
            ctx.fillRect(0, 0, w, h);
            ctx.fillStyle = '#0f0';
            ctx.font = '15px monospace';
            for (let i = 0; i < drops.length; i++) {
                const text = String.fromCharCode(Math.random() * 128);
                ctx.fillText(text, i * 20, drops[i] * 20);
                if (drops[i] * 20 > h && Math.random() > 0.975) drops[i] = 0;
                drops[i]++;
            }
        }

        window.addEventListener('resize', initMatrix);
        initMatrix();
        setInterval(drawMatrix, 50);

        // --- AUDIO ENGINE ---
        let audioCtx;
        function playTick(freq = 150, dur = 0.03, type = 'square') {
            if (!audioCtx) audioCtx = new (window.AudioContext || window.webkitAudioContext)();
            if (audioCtx.state === 'suspended') audioCtx.resume();
            const osc = audioCtx.createOscillator();
            const gain = audioCtx.createGain();
            osc.type = type;
            osc.frequency.setValueAtTime(freq, audioCtx.currentTime);
            gain.gain.setValueAtTime(0.01, audioCtx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.0001, audioCtx.currentTime + dur);
            osc.connect(gain);
            gain.connect(audioCtx.destination);
            osc.start();
            osc.stop(audioCtx.currentTime + dur);
        }

        // --- INITIAL EFFECTS TRIGGER ---
        function triggerInitialEffects() {
            // --- INITIAL TERMINAL LOGS ---
            if (logOutput) {
                log('>> SYSTEM_CORE_LOADED: ANARCHY_v5.0', 'ok');
                log('>> NEURAL_LINK_ESTABLISHED: GEMINI_STABLE', 'ok');
                log('>> DETECTING_INTRUSION_AT_PORT_8080...', 'warn');
                log('>> ENCRYPTING_SWAP_FILE... [DONE]', 'ok');
                log('>> ANALYZING_CLAN_STRUCTURE: 6_NODES_FOUND', 'info');
                log('>> WARNING: MEMORY_LEAK_IN_ANARCHY_KERNEL', 'warn');
                log('>> STATUS: GEISTESKRANK & ONLINE', 'crit');
                log('----------------------------------------', 'ok');
            }
            
            // --- INITIAL BRIGHTER MATRIX EFFECT (7 SECONDS) ---
            if (canvas) {
                canvas.style.opacity = '0.25';
                setTimeout(() => {
                    // Only fade out if not in kernel mode
                    if (!document.body.classList.contains('mode-kernel')) {
                        canvas.style.opacity = '0';
                    }
                }, 7000);
            }
        }

        // --- BOOT SEQUENCE ---
        const BOOT_LINES = [
            { t: 'BOOTING HUGO_ANARCHY_ENGINE v5.0...', c: 'ok' },
            { t: 'CONNECTING TO GEMINI NEURAL LINK...', c: 'ok' },
            { t: 'BYPASSING WORDPRESS_REMNANTS...', c: 'warn' },
            { t: 'LOADING STEAMPUNK_ASSETS...', c: 'ok' },
            { t: 'INITIALIZING TERMINAL...', c: 'ok' },
            { t: 'DATA_INTEGRITY: 100% (STATIC_MODE)', c: 'ok' },
            { t: '----------------------------------------', c: 'ok' },
            { t: 'WELCOME BACK, OVERLORD SASCHA.', c: 'crit' }
        ];

        function startBoot() {
            if (sessionStorage.getItem('hugo_boot_complete') && bootScreen) {
                bootScreen.style.display = 'none';
                if (mainContent) {
                    mainContent.classList.add('visible');
                    mainContent.style.opacity = '1';
                }
                triggerInitialEffects(); // Trigger effects even if skipped
                return;
            }

            if (!bootScreen) {
                triggerInitialEffects(); // Just in case
                return;
            }

            let idx = 0;
            const interval = setInterval(() => {
                if (idx >= BOOT_LINES.length) {
                    clearInterval(interval);
                    setTimeout(() => {
                        bootScreen.style.opacity = '0';
                        setTimeout(() => {
                            bootScreen.style.display = 'none';
                            if (mainContent) {
                                mainContent.classList.add('visible');
                                mainContent.style.opacity = '1';
                            }
                            sessionStorage.setItem('hugo_boot_complete', 'true');
                            triggerInitialEffects(); // Trigger effects after manual boot
                        }, 1000);
                    }, 800);
                    return;
                }
                const line = document.createElement('div');
                line.className = 'boot-line ' + BOOT_LINES[idx].c;
                line.textContent = BOOT_LINES[idx].t;
                bootLog.appendChild(line);
                playTick(100 + (idx * 20));
                idx++;
            }, 150);
        }

        startBoot();

        // --- TERMINAL ENGINE ---
        if (terminalInput) {
            terminalInput.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    const input = terminalInput.value.trim();
                    terminalInput.value = '';
                    handleCommand(input);
                }
            });
        }

        function log(msg, cls = '') {
            if (!logOutput) return;
            const entry = document.createElement('div');
            entry.className = 'log-entry ' + cls;
            entry.innerHTML = msg;
            logOutput.prepend(entry);
        }

        function handleCommand(raw) {
            const parts = raw.split(' ');
            const cmd = parts[0].toLowerCase();
            const args = parts.slice(1).join(' ');

            log('<span class="user-cmd">sascha@ki-labor:~$ ' + raw + '</span>');

            switch(cmd) {
                case 'help':
                    log('VERFÜGBARE BEFEHLE:', 'info');
                    log(' - whoami   : Zeigt Identität');
                    log(' - status   : System-Vitals');
                    log(' - matrix   : Matrix-Mode');
                    log(' - anarchy  : Anarchie-Mode');
                    log(' - clear    : Log löschen');
                    log(' - reboot   : System-Neustart');
                    log(' - flux     : Overdrive aktivieren');
                    log(' - hack     : Neural Hack simulieren');
                    log(' - uptime   : System-Laufzeit');
                    log(' - weather  : Chaos-Wetterbericht');
                    log(' - top      : Prozess-Monitor');
                    log(' - fortune  : Digitales Orakel');
                    break;
                case 'whoami': log('IDENTITÄT: OVERLORD SASCHA RODE', 'ok'); break;
                case 'status': log('STATUS: GEISTESKRANK & ONLINE', 'warn'); break;
                case 'clear': logOutput.innerHTML = ''; break;
                case 'reboot': 
                    sessionStorage.removeItem('hugo_boot_complete');
                    window.location.reload(); 
                    break;
                case 'matrix': document.querySelector('[data-mode="kernel"]')?.click(); break;
                case 'anarchy': document.querySelector('[data-mode="anarchy"]')?.click(); break;
                case 'bypass': document.querySelector('[data-mode="bypass"]')?.click(); break;
                case 'trace': document.querySelector('[data-mode="trace"]')?.click(); break;
                case 'flux': document.querySelector('[data-mode="overdrive"]')?.click(); break;
                case 'hack':
                    log('>> INITIATING NEURAL HACK...', 'warn');
                    let hIdx = 0;
                    const hInt = setInterval(() => {
                        log(Math.random().toString(16).substring(2, 15), 'ghost');
                        if (hIdx++ > 15) {
                            clearInterval(hInt);
                            log('>> ACCESS GRANTED.', 'ok');
                        }
                    }, 100);
                    break;
                case 'deep-scan':
                    log('>> INITIALIZING DEEP SYSTEM SCAN...', 'info');
                    setTimeout(() => {
                        log('>> ANALYZING KERNEL MODULES...', 'ok');
                        log('>> CHECKING NEURAL PATHWAYS...', 'ok');
                        log('>> SCANNING FOR ANOMALIES... [FOUND: 42]', 'warn');
                        log('>> SYSTEM INTEGRITY: ANARCHIC', 'crit');
                    }, 1000);
                    break;
                case 'uptime':
                    const years = new Date().getFullYear() - 1974;
                    log('SYSTEM ONLINE SEIT: 01.01.1974', 'info');
                    log('LAUFZEIT: ' + years + ' JAHRE (STABILITÄT: FRAGLICH)', 'ok');
                    break;
                case 'fortune': generateFortune(); break;
                default: 
                    log('FEHLER: BEFEHL "' + cmd + '" NICHT GEFUNDEN.', 'error');
                    playTick(150, 0.2, 'sawtooth');
            }
            playTick(400 + Math.random() * 200);
        }

        // --- FORTUNE ENGINE ---
        const fortunes = [
            'Die Hälfte der Intelligenz besteht darin zu wissen, was man ignorieren kann.',
            'Kreativität ist Intelligenz, die Spaß hat.',
            'Wenn Plan A scheitert – gut. Plan A war sowieso zu ordentlich.',
            'Kaffee ist nur Debugging auf chemischer Ebene.',
            'Die Wahrheit liegt im Source-Code. Die Lüge im Kommentar daneben.'
        ];

        function generateFortune() {
            const f = fortunes[Math.floor(Math.random() * fortunes.length)];
            if (fortuneText) fortuneText.innerHTML = `<em>"${f}"</em>`;
            log('>> ORAKEL: ' + f, 'info');
        }

        document.getElementById('fortune-trigger')?.addEventListener('click', generateFortune);

        // --- MODE SWITCHER ---
        document.querySelectorAll('.switch-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const mode = btn.getAttribute('data-mode');
                
                // Special actions for bypass and scan
                const terminalLog = document.getElementById('system-log');
                
                if (mode === 'bypass') {
                    document.body.classList.toggle('mode-bypass');
                    btn.classList.toggle('active');
                    if (document.body.classList.contains('mode-bypass')) {
                        if (terminalLog) terminalLog.style.height = '500px';
                        handleCommand('hack');
                    } else if (terminalLog) {
                        terminalLog.style.height = '250px';
                    }
                    return;
                }
                if (mode === 'scan') {
                    document.body.classList.toggle('mode-scan');
                    btn.classList.toggle('active');
                    if (document.body.classList.contains('mode-scan')) {
                        if (terminalLog) terminalLog.style.height = '500px';
                        handleCommand('deep-scan');
                    } else if (terminalLog) {
                        terminalLog.style.height = '250px';
                    }
                    return;
                }

                document.body.classList.toggle('mode-' + mode);
                btn.classList.toggle('active');
                playTick(300);
            });
        });

        // --- OPS DASHBOARD LOGIC ---
        const opsSign = document.getElementById('ops-dashboard-sign');
        let originalLogContent = '';
        let isOpsOpen = false;

        if (opsSign) {
            opsSign.style.cursor = 'pointer';
            opsSign.addEventListener('click', () => {
                const terminalLog = document.getElementById('system-log');
                const logOutput = document.getElementById('log-output');
                const opsHint = opsSign.querySelector('div:last-child');
                
                if (!terminalLog || !logOutput) return;

                if (!isOpsOpen) {
                    // ÖFFNEN
                    originalLogContent = logOutput.innerHTML;
                    isOpsOpen = true;
                    terminalLog.style.height = '600px';
                    logOutput.innerHTML = `
                        <div style="color: #666; font-size: 0.7rem; border-bottom: 1px solid #333; padding-bottom: 10px; margin-bottom: 20px; display: flex; justify-content: space-between;">
                            <span>VITALMONITOR</span>
                            <span>▁▂▃▂▁▃▂▁▁▁▁▁▁</span>
                            <span>FLATLINE</span>
                        </div>
                        
                        <div class="op-report" style="margin-bottom: 30px;">
                            <div style="color: #ff4500; font-size: 0.8rem; margin-bottom: 10px;">-- OP ALFA-7 --</div>
                            <div style="display: grid; grid-template-columns: 120px 1fr; gap: 5px; font-size: 0.75rem;">
                                <span style="color: #666;">PATIENT:</span> <span style="color: #ccc;">KREATIVITAET.exe (v4.2-beta)</span>
                                <span style="color: #666;">EINGRIFF:</span> <span style="color: #ccc;">Herz-Transplant — Donor: MOTIVATION.sys</span>
                                <span style="color: #666;">BEFUND:</span> <span style="color: #ccc;">Herz läuft. Richtung unbekannt. Absicht fraglich.</span>
                                <span style="color: #666;">STATUS:</span> 
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="width: 150px; height: 10px; background: #111; border: 1px solid #0f0; position: relative;">
                                        <div style="width: 82%; height: 100%; background: #0f0; box-shadow: 0 0 10px #0f0;"></div>
                                    </div>
                                    <span style="color: #0f0;">82% KAPAZITÄT</span>
                                </div>
                                <span style="color: #666;">ERGEBNIS:</span> <span style="color: #0f0;">0.5 ERFOLGE (zählt als halber Sieg, ganz nach Wunsch)</span>
                            </div>
                        </div>

                        <div class="op-report" style="margin-bottom: 30px;">
                            <div style="color: #ff4500; font-size: 0.8rem; margin-bottom: 10px;">-- OP BETA-12 --</div>
                            <div style="display: grid; grid-template-columns: 120px 1fr; gap: 5px; font-size: 0.75rem;">
                                <span style="color: #666;">PATIENT:</span> <span style="color: #ccc;">SCHLAFRHYTHMUS.daemon (Version: veraltet)</span>
                                <span style="color: #666;">EINGRIFF:</span> <span style="color: #ccc;">Herz-Transplant — Donor: KAFFEE-KERN v9.1</span>
                                <span style="color: #666;">BEFUND:</span> <span style="color: #ccc;">Donor inkompatibel. Koffein ≠ Blut. Überraschung: keiner.</span>
                                <span style="color: #666;">STATUS:</span> 
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="width: 150px; height: 10px; background: #111; border: 1px solid #f00; position: relative;">
                                        <div style="width: 100%; height: 100%; background: #f00; box-shadow: 0 0 10px #f00;"></div>
                                    </div>
                                    <span style="color: #f00;">100% — ABGESCHLOSSEN</span>
                                </div>
                                <span style="color: #666;">ERGEBNIS:</span> <span style="color: #f00;">TECHNISCH FEHLGESCHLAGEN. Patient läuft trotzdem.</span>
                            </div>
                        </div>

                        <div style="border-top: 1px solid #333; padding-top: 15px; font-size: 0.65rem; color: #444; line-height: 1.6;">
                            OPS: ||| 3 &nbsp;&nbsp; ERFOLGE: |½ 1.5 &nbsp;&nbsp; FEHLCHL: |½ 1.5 <br>
                            RESTE: KUEHLHAUS C — ZUSTAND: STABIL / NUTZBAR <br>
                            NÄCHSTE OP: PROKRASTINATION.exe — ETA: IRGENDWANN
                        </div>
                    `;
                    if (opsHint) opsHint.textContent = '[ PROTOKOLL SCHLIESSEN ]';
                    playTick(600, 0.1, 'sawtooth');
                } else {
                    // SCHLIESSEN
                    isOpsOpen = false;
                    terminalLog.style.height = '250px';
                    logOutput.innerHTML = originalLogContent;
                    if (opsHint) opsHint.textContent = '[ PROTOKOLL EINSEHEN ]';
                    playTick(300, 0.1, 'square');
                }
            });
        }
    });
})();
