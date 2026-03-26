(function() {
    console.log('>> ANARCHY ENGINE INITIALIZED');

    document.addEventListener('DOMContentLoaded', function() {
        const bootScreen = document.getElementById('boot-screen');
        const bootLog = document.getElementById('boot-log');
        const mainContent = document.querySelector('.main-content');
        const triggerReboot = document.getElementById('trigger-reboot');
        
        // --- BOOT SEQUENCE CONFIG ---
        const bootMessages = [
            { t: 'SASCHA-BIOS v4.0.1 (C) 1982-2026', c: 'ok' },
            { t: 'CPU: GEISTESKRANK QUAD-CORE @ 8.2 GHZ... OK', c: 'ok' },
            { t: 'RAM: 64GB NEURAL-BUFFER... OK', c: 'ok' },
            { t: 'DETECTING PERIPHERALS...', c: 'ok' },
            { t: ' - GEMINI NEURAL LINK... CONNECTED', c: 'ok' },
            { t: ' - ANARCHY-INPUT-MODULE... CONNECTED', c: 'ok' },
            { t: ' - REALITY-DISTORTION-FIELD... ACTIVE (120%)', c: 'warn' },
            { t: '----------------------------------------', c: 'ok' },
            { t: 'LOADING KERNEL: ANARCHY_V1.SYS...', c: 'ok' },
            { t: 'INITIATING BOOT-FLUX...', c: 'ok' },
            { t: 'CHECKING WORDPRESS CORE INTEGRITY...', c: 'warn' },
            { t: 'INTEGRITY: COMPROMISED (AS EXPECTED)', c: 'ok' },
            { t: 'BYPASSING SECURITY PROTOCOLS... [DONE]', c: 'ok' },
            { t: 'MOUNTING PROJECTS ARCHIVE...', c: 'ok' },
            { t: 'DECRYPTING n8n VOLUMES...', c: 'ok' },
            { t: 'INJECTING MATRIX SHADERS...', c: 'ok' },
            { t: 'FINALIZING HANDSHAKE WITH GEMINI...', c: 'ok' },
            { t: '----------------------------------------', c: 'ok' },
            { t: 'SYSTEM READY. WELCOME, OVERLORD SASCHA.', c: 'crit' }
        ];

        let audioCtx;

        function playBootTick(freq = 150) {
            if (!audioCtx) audioCtx = new (window.AudioContext || window.webkitAudioContext)();
            if (audioCtx.state === 'suspended') audioCtx.resume();
            const osc = audioCtx.createOscillator();
            const gain = audioCtx.createGain();
            osc.type = 'square';
            osc.frequency.setValueAtTime(freq, audioCtx.currentTime);
            gain.gain.setValueAtTime(0.01, audioCtx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.0001, audioCtx.currentTime + 0.03);
            osc.connect(gain);
            gain.connect(audioCtx.destination);
            osc.start();
            osc.stop(audioCtx.currentTime + 0.03);
        }

        // --- AUDIO ENGINE SFX ---
        let sfxEnabled = true;

        function playKeyClick() {
            if (!sfxEnabled) return;
            ensureAudio();
            const osc = audioCtx.createOscillator();
            const gain = audioCtx.createGain();
            
            osc.type = 'square';
            osc.frequency.setValueAtTime(800, audioCtx.currentTime);
            osc.frequency.exponentialRampToValueAtTime(100, audioCtx.currentTime + 0.02);
            
            gain.gain.setValueAtTime(0.015, audioCtx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.001, audioCtx.currentTime + 0.02);
            
            osc.connect(gain);
            gain.connect(audioCtx.destination);
            osc.start();
            osc.stop(audioCtx.currentTime + 0.02);
        }

        function playErrorBeep() {
            if (!sfxEnabled) return;
            ensureAudio();
            const osc = audioCtx.createOscillator();
            const gain = audioCtx.createGain();
            
            osc.type = 'sawtooth';
            osc.frequency.setValueAtTime(150, audioCtx.currentTime);
            osc.frequency.setValueAtTime(120, audioCtx.currentTime + 0.1); 
            
            gain.gain.setValueAtTime(0.04, audioCtx.currentTime);
            gain.gain.linearRampToValueAtTime(0.01, audioCtx.currentTime + 0.3);
            
            osc.connect(gain);
            gain.connect(audioCtx.destination);
            osc.start();
            osc.stop(audioCtx.currentTime + 0.3);
        }

        function showSubtleMatrix() {
            setTimeout(() => {
                const matrixCanvas = document.getElementById('matrix-canvas');
                if (matrixCanvas && !document.body.classList.contains('mode-kernel')) {
                    matrixCanvas.style.opacity = '0.15';
                    setTimeout(() => {
                        if (!document.body.classList.contains('mode-kernel')) {
                            matrixCanvas.style.opacity = '0';
                        }
                    }, 4000);
                }
            }, 100);
        }

        function ensureAudio() {
            if (!audioCtx) audioCtx = new (window.AudioContext || window.webkitAudioContext)();
            if (audioCtx.state === 'suspended') {
                audioCtx.resume();
            }
        }
        document.addEventListener('click', ensureAudio);
        document.addEventListener('keydown', ensureAudio);

        function startBoot() {
            // Reset UI for Reboot
            mainContent.classList.remove('visible');
            mainContent.style.opacity = '0';
            bootScreen.style.display = 'flex';
            bootScreen.style.opacity = '1';
            bootLog.innerHTML = '';
            
            let i = 0;
            const bootTimer = setInterval(() => {
                if (i < bootMessages.length) {
                    const line = document.createElement('div');
                    line.className = 'boot-line ' + bootMessages[i].c;
                    line.textContent = bootMessages[i].t;
                    bootLog.prepend(line);
                    playBootTick(100 + (i * 20));
                    i++;
                } else {
                    clearInterval(bootTimer);
                    setTimeout(() => {
                        bootScreen.style.transition = 'opacity 1s';
                        bootScreen.style.opacity = '0';
                        mainContent.classList.add('visible');
                        showSubtleMatrix();
                        setTimeout(() => {
                            bootScreen.style.display = 'none';
                        }, 1000);
                    }, 500);
                }
            }, 80);
        }

        // --- EVENTS ---
        if (triggerReboot) {
            triggerReboot.addEventListener('click', (e) => {
                e.preventDefault();
                startBoot();
            });
        }

        // Auto-Boot (nur beim ersten Session-Laden)
        if (!sessionStorage.getItem('booted')) {
            startBoot();
            sessionStorage.setItem('booted', 'true');
        } else {
            bootScreen.style.display = 'none';
            mainContent.classList.add('visible');
            mainContent.style.opacity = '1';
            showSubtleMatrix();
        }

        // --- LOG & TERMINAL LOGIC ---
        const logOutput = document.getElementById('log-output');
        const terminalInput = document.getElementById('terminal-input');
        const filterButtons = document.querySelectorAll('.filter-btn');
        const projectCards = document.querySelectorAll('.project-card');

        const ghostMessages = [
            '>> DETECTING INTRUSION AT PORT 8080...',
            '>> ENCRYPTING SWAP FILE... [DONE]',
            '>> GEMINI NEURAL LINK: SYNC 98%',
            '>> WARNING: MEMORY LEAK IN ANARCHY-KERNEL'
        ];

        if (!logOutput || !terminalInput) return;

        function log(message, type = 'normal') {
            const time = new Date().toLocaleTimeString();
            const entry = document.createElement('div');
            entry.className = 'log-entry ' + type;
            entry.innerHTML = '<span class="log-time">[' + time + ']</span> ' + message;
            logOutput.prepend(entry);
        }

        setInterval(() => {
            if (Math.random() > 0.7) {
                const msg = ghostMessages[Math.floor(Math.random() * ghostMessages.length)];
                log(msg, 'ghost');
            }
        }, 30000);

        const btnSfx = document.getElementById('btn-sfx');
        if (btnSfx) {
            btnSfx.addEventListener('click', () => {
                sfxEnabled = !sfxEnabled;
                btnSfx.textContent = sfxEnabled ? '[ SFX: ON ]' : '[ SFX: OFF ]';
                btnSfx.style.color = sfxEnabled ? '#0f0' : '#888';
                btnSfx.style.borderColor = sfxEnabled ? '#0f0' : '#444';
                if (sfxEnabled) playKeyClick();
            });
        }

        terminalInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                playKeyClick();
                const command = this.value.toLowerCase().trim();
                log('> ' + command, 'user-cmd');
                this.value = '';
                executeCommand(command);
            } else if (e.key.length === 1 || e.key === 'Backspace' || e.key === 'Tab') {
                playKeyClick();
            }
        });

        function executeCommand(fullCmd) {
            const parts = fullCmd.split(' ');
            const cmd = parts[0];
            const args = parts.slice(1).join(' ');

            switch(cmd) {
                case 'help':
                    log('VERFÜGBARE PROTOKOLLE:', 'info');
                    log(' - ghost    : Stealth-Modus (Unsichtbarkeit)');
                    log(' - hack     : Matrix-Stream starten');
                    log(' - matrix   : KI-Kernel initialisieren');
                    log(' - anarchy  : Realitätsverzerrung');
                    log(' - bypass   : Sicherheits-Override');
                    log(' - whoami   : Identitäts-Check');
                    log(' - trace    : Origin-IP lokalisieren');
                    log(' - ping     : Netzwerk-Latenz Check');
                    log(' - flux     : KI-Overdrive aktivieren');
                    log(' - nasa     : NASA Mainframe Infiltration');
                    log(' - destruct : System-Selbstzerstörung');
                    log(' - reboot   : Manueller System-Neustart');
                    log(' - clear    : Log-Speicher löschen');
                    log(' - say      : Text-to-Speech Synthesizer');
                    log(' - kind:    : Projekt-Filter (z.B. kind: all, kind: bash)');
                    break;
                case 'say':
                    if (!args) {
                        log('FEHLER: "say" ERWARTET EINE EINGABE.', 'error');
                        break;
                    }
                    log('>> INITIALIZING VOCAL TRACT...', 'info');
                    if ('speechSynthesis' in window) {
                        document.body.classList.add('mode-ghost');
                        const synthMsg = new SpeechSynthesisUtterance(args);
                        synthMsg.rate = 0.8 + Math.random() * 0.4;
                        synthMsg.pitch = 0.4 + Math.random() * 1.5;
                        synthMsg.onend = function() {
                            document.body.classList.remove('mode-ghost');
                            log('>> VOCAL TRANSMISSION COMPLETE.', 'ok');
                            if (sfxEnabled) playKeyClick();
                        };
                        synthMsg.onerror = function() {
                            document.body.classList.remove('mode-ghost');
                            log('!! VOCAL MODULE ERROR !!', 'error');
                        };
                        log('>> SYNTHESIZING: [ ' + args + ' ]', 'ghost');
                        window.speechSynthesis.speak(synthMsg);
                    } else {
                        log('FEHLER: DEIN BROWSER UNTERSTÜTZT KEINE AUDIO-SYNTHESE.', 'error');
                    }
                    break;
                case 'kind:':
                    if (!args) {
                        log('FEHLER: "kind:" ERWARTET EINEN FILTERWERT (Z.B. all, htmlkrabben, bash).', 'error');
                        break;
                    }
                    const filterValue = args.toLowerCase();
                    log('>> FILTERING DATABANKS BY CATEGORY: [' + filterValue + ']', 'info');
                    
                    let foundAny = false;
                    projectCards.forEach(card => {
                        const cat = card.getAttribute('data-category');
                        if (filterValue === 'all' || cat === filterValue) {
                            card.style.display = 'flex';
                            foundAny = true;
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    filterButtons.forEach(b => {
                        if (b.getAttribute('data-filter') === filterValue) {
                            b.classList.add('active');
                        } else {
                            b.classList.remove('active');
                        }
                    });

                    if (foundAny) {
                        log('>> FILTER APPLIED GALAXY-WIDE.', 'ok');
                    } else {
                        log('WARNUNG: KEINE DATENSÄTZE FÜR KATEGORIE "' + filterValue + '" GEFUNDEN.', 'warn');
                    }
                    if (sfxEnabled) playKeyClick();
                    break;
                case 'ghost':
                    if (document.body.classList.contains('mode-ghost')) {
                        log('>> REVEALING SYSTEM SIGNATURES...', 'info');
                        document.body.classList.remove('mode-ghost');
                        document.querySelector('.prompt').textContent = '> ';
                    } else {
                        log('>> INITIATING STEALTH PROTOCOL...', 'ghost');
                        let wipeLines = 0;
                        const wipeInterval = setInterval(() => {
                            let ip = Math.floor(Math.random()*255) + '.' + Math.floor(Math.random()*255) + '.' + Math.floor(Math.random()*255) + '.' + Math.floor(Math.random()*255);
                            log('SCRAMBLING IP: ' + ip + ' -> [ENCRYPTED]', 'ghost');
                            wipeLines++;
                            if (wipeLines > 10) {
                                clearInterval(wipeInterval);
                                log('>> SCRAMBLING IDENTITY SIGNATURES...', 'ghost');
                                setTimeout(() => {
                                    document.body.classList.add('mode-ghost');
                                    log('>> [STATUS]: GHOST MODE ACTIVE', 'ok');
                                    document.querySelector('.prompt').textContent = '[GHOST]> ';
                                }, 800);
                            }
                        }, 120);
                    }
                    break;
                case 'hack':
                    log('>> INITIATING NEURAL HACK...', 'warn');
                    const chars = '0123456789ABCDEFHIJKLMNOPQRSTUVWXYZ$@#%&*';
                    let hackLines = 0;
                    const hackInterval = setInterval(() => {
                        let line = '';
                        for(let i=0; i<30; i++) line += chars[Math.floor(Math.random()*chars.length)];
                        log(line, 'ghost');
                        hackLines++;
                        if (hackLines > 20) {
                            clearInterval(hackInterval);
                            log('>> HACK COMPLETE. ACCESS GRANTED.', 'ok');
                        }
                    }, 100);
                    break;
                case 'reboot': startBoot(); break;
                case 'whoami': log('IDENTITÄT: OVERLORD SASCHA RODE', 'info'); break;
                case 'matrix': document.getElementById('btn-kernel').click(); break;
                case 'anarchy': document.getElementById('btn-anarchy').click(); break;
                case 'bypass': document.getElementById('btn-security').click(); break;
                case 'clear': logOutput.innerHTML = ''; break;
                case 'trace':
                    log('>> IP VERBINDUNG HERGESTELLT', 'info');
                    log('>> TRACING ORIGIN NODE...', 'warn');
                    setTimeout(() => {
                        const fakeIp = Math.floor(Math.random()*255) + '.' + Math.floor(Math.random()*255) + '.' + Math.floor(Math.random()*255) + '.' + Math.floor(Math.random()*255);
                        log('>> LOCATED: ' + fakeIp + ' (LATENCY 12ms)', 'ok');
                        log('>> INITIATING GEO-MAPPING...', 'info');
                        setTimeout(() => {
                            const map = `\n       . _..::__:  ,-"-"._        |]       ,     _,.__\n  _.___ _ _<_>\`-._\`.   -.  \\       _-_\\.   __,-'   _ .\n  \`'."\`/\`   _     \`"     \`"       "    "    \`_,-' \n`;
                            log('<pre style="font-size:10px;line-height:10px;color:#0f0;">' + map + '</pre>', 'ghost');
                            log('>> TARGET ACQUIRED.', 'warn');
                        }, 1000);
                    }, 1500);
                    break;
                case 'ping':
                    log('>> PINGING LOCALHOST...', 'info');
                    let pcount = 0;
                    const pTimer = setInterval(() => {
                        pcount++;
                        log(`64 bytes from 127.0.0.1: icmp_seq=${pcount} ttl=64 time=${Math.floor(Math.random()*5+1)} ms`, 'ghost');
                        if (pcount >= 4) {
                            clearInterval(pTimer);
                            log('>> 4 packets transmitted, 4 received, 0% packet loss', 'ok');
                        }
                    }, 500);
                    break;
                case 'flux':
                    log('>> ACTIVATING FLUX OVERDRIVE...', 'warn');
                    if (typeof playKeyClick === 'function') playKeyClick();
                    setTimeout(() => {
                        const fluxAscii = `\n  _____ _    _   ___  __\n |  ___| |  | | | \\ \\/ /\n | |_  | |  | | | |\\  / \n |  _| | |__| |_| |/  \\ \n |_|   |_____\\___//_/\\_\\\n `;
                        log('<pre style="font-size:12px;line-height:12px;color:#0f0;font-weight:bold;">' + fluxAscii + '</pre>', 'ok');
                        log('>> FLUX AI ENGINE ONLINE.', 'info');
                        log('>> SPEED: HASTIG. MODE: SCHWÄBISCH ACCELERATED.', 'crit');
                    }, 500);
                    break;
                case 'nasa':
                    log('>> ESTABLISHING SECURE UPLINK TO KENNEDY SPACE CENTER...', 'info');
                    setTimeout(() => {
                        log('>> BYPASSING FIREWALL [JPL-NODE-7]...', 'warn');
                        if (typeof playKeyClick === 'function') playKeyClick();
                        setTimeout(() => {
                            log('>> ACCESSING VOYAGER TELEMETRY DATA...', 'ok');
                            if (typeof playKeyClick === 'function') playKeyClick();
                            let downloadProgress = 0;
                            const downloadInterval = setInterval(() => {
                                downloadProgress += Math.floor(Math.random() * 15) + 5;
                                if (downloadProgress >= 100) {
                                    downloadProgress = 100;
                                    clearInterval(downloadInterval);
                                    log(`>> DOWNLOADING CLASSIFIED FOLDERS [${downloadProgress}%]`, 'warn');
                                    log('>> NASA MAINFRAME COMPROMISED. ALL SECRETS SECURED.', 'crit');
                                    const asciiSat = `\n       .\n      / \\\n     /   \\\n    /_____\\\n    |     |\n   /|  O  |\\\n  / |_____| \\\n /  /     \\  \\`;
                                    log('<pre style="font-size:10px;line-height:10px;color:#d4af37;">' + asciiSat + '</pre>', 'ghost');
                                    if (typeof playErrorBeep === 'function') playErrorBeep();
                                } else {
                                    log(`>> DOWNLOADING CLASSIFIED FOLDERS [${downloadProgress}%]`, 'ghost');
                                }
                            }, 400);
                        }, 1000);
                    }, 1000);
                    break;
                case 'destruct': 
                    playErrorBeep();
                    log('!! SELF-DESTRUCT PROTOCOL INITIATED !!', 'error');
                    let count = 5;
                    const timer = setInterval(() => {
                        log('T-MINUS ' + count + ' SECONDS...', 'error');
                        count--;
                        if (count < 0) {
                            clearInterval(timer);
                            const overlay = document.createElement('div');
                            overlay.style.cssText = 'background:black; color:red; position:fixed; top:0; left:0; width:100%; height:100%; z-index:99999; display:flex; flex-direction:column; justify-content:center; align-items:center; font-family:monospace; cursor:pointer;';
                            overlay.innerHTML = '<h1 style="font-size:5rem;">SYSTEM HALTED</h1><p>SASCHA WINS.</p>';
                            overlay.onclick = () => window.location.reload();
                            document.body.appendChild(overlay);
                        }
                    }, 1000);
                    break;
                default: 
                    playErrorBeep();
                    log('FEHLER: BEFEHL "' + cmd + '" UNBEKANNT.', 'error');
            }
        }

        // Button Click Modes
        const setupBtn = (id, cls, onMsg, offMsg) => {
            const btn = document.getElementById(id);
            if (btn) btn.addEventListener('click', () => {
                document.body.classList.toggle(cls);
                log(document.body.classList.contains(cls) ? onMsg : offMsg);
            });
        };
        setupBtn('btn-kernel', 'mode-kernel', '>> MATRIX AKTIVIERT', '>> MATRIX DEAKTIVIERT');

        // Matrix Rain Canvas
        const canvas = document.createElement('canvas');
        canvas.id = 'matrix-canvas';
        canvas.style.cssText = 'position:fixed;top:0;left:0;width:100%;height:100%;z-index:-1;opacity:0;transition:opacity 1s;pointer-events:none;';
        document.body.appendChild(canvas);
        const ctx = canvas.getContext('2d');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        window.addEventListener('resize', () => { canvas.width = window.innerWidth; canvas.height = window.innerHeight; });
        const letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789$+-*/=%"\'#&_(),.;:?!\\|{}<>[]^~';
        const fontSize = 16;
        let columns = Math.max(1, Math.floor(canvas.width / fontSize));
        let drops = [];
        for(let x = 0; x < columns; x++) drops[x] = 1;

        function drawMatrix() {
            ctx.fillStyle = 'rgba(0, 0, 0, 0.05)';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = '#0F0';
            ctx.font = fontSize + 'px monospace';
            for(let i = 0; i < drops.length; i++) {
                const text = letters.charAt(Math.floor(Math.random() * letters.length));
                ctx.fillText(text, i * fontSize, drops[i] * fontSize);
                if(drops[i] * fontSize > canvas.height && Math.random() > 0.975) drops[i] = 0;
                drops[i]++;
            }
        }
        setInterval(drawMatrix, 33);

        document.getElementById('btn-kernel')?.addEventListener('click', () => {
             canvas.style.opacity = document.body.classList.contains('mode-kernel') ? '0.35' : '0';
             if(document.body.classList.contains('mode-kernel')) document.body.style.backgroundColor = 'transparent';
        });
        setupBtn('btn-anarchy', 'mode-anarchy', '>> ANARCHIE ENGAGED', '>> ORDNUNG HERGESTELLT');
        setupBtn('btn-security', 'mode-security', '!! SECURITY BYPASS !!', '>> STABILIZED');

        // Filter Logic
        filterButtons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const filter = btn.getAttribute('data-filter');
                filterButtons.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                projectCards.forEach(card => {
                    const cat = card.getAttribute('data-category');
                    card.style.display = (filter === 'all' || cat === filter) ? 'flex' : 'none';
                });
            });
        });

        // Konami / SASCHA Easter Egg
        let secretBuffer = '';
        document.addEventListener('keydown', (e) => {
            if (document.activeElement === terminalInput) return;
            secretBuffer += e.key.toLowerCase();
            if (secretBuffer.length > 10) secretBuffer = secretBuffer.slice(-10);
            if (secretBuffer.includes('sascha')) {
                log('>> OVERLORD COMMAND OVERRIDE AUTHORIZED.', 'crit');
                document.body.classList.add('mode-security');
                if (!document.body.classList.contains('mode-kernel')) document.getElementById('btn-kernel').click();
                const overlay = document.createElement('div');
                overlay.style.cssText = 'position:fixed;top:0;left:0;width:100%;height:100%;z-index:9999;background:rgba(0,0,0,0.8);color:#0f0;display:flex;align-items:center;justify-content:center;font-size:3rem;font-family:monospace;pointer-events:none;';
                overlay.innerHTML = '<h1 style="animation: shake 0.5s infinite;">GOD MODE UNLOCKED</h1>';
                document.body.appendChild(overlay);
                if (sfxEnabled) playErrorBeep();
                setTimeout(() => document.body.removeChild(overlay), 4000);
                secretBuffer = '';
            }
        });

        // --- TIMELINE LOGIC ---
        const steampunkCards = document.querySelectorAll('.steampunk-card');
        const timelineModal = document.getElementById('timeline-modal');
        const closeTimeline = document.getElementById('close-timeline');
        const timelineTrack = document.getElementById('timeline-track');
        const timelineTitle = document.getElementById('timeline-title');

        if (steampunkCards.length > 0 && timelineModal) {
            steampunkCards.forEach(card => {
                card.addEventListener('click', (e) => {
                    e.preventDefault();
                    if (typeof playErrorBeep === 'function') playErrorBeep();
                    
                    document.body.classList.add('mode-time-warp');
                    log('>> INITIATING TEMPORAL DISPLACEMENT...', 'warn');
                    log('>> TARGET YEAR: 1955', 'ghost');
                    
                    setTimeout(() => {
                        document.body.classList.remove('mode-time-warp');
                        const personName = card.querySelector('h3').innerText;
                        timelineTitle.innerText = "HISTORISCHES ARCHIV: " + personName;
                        generateTimeline();
                        timelineModal.classList.remove('timeline-hidden');
                        log('>> TEMPORAL SHIFT COMPLETE.', 'ok');
                    }, 1200); 
                });
            });

            if (closeTimeline) {
                closeTimeline.addEventListener('click', () => {
                    timelineModal.classList.add('timeline-hidden');
                    if (typeof playKeyClick === 'function') playKeyClick();
                });
            }

            function generateTimeline() {
                timelineTrack.innerHTML = '';
                
                const specialEvents = {
                    1974: "ARCHITEKTUR-UPDATE: Der zukünftige Overlord (Sascha) wird von der Kupfer-Matriarchin erfolgreich in die Biosphäre kompiliert. Initialer System-Schrei registriert.",
                    1981: "SYSTEM-ERWEITERUNG: Ein neuer kybernetischer Bruder-Knoten geht online. Visuelles Sensoren-Update (Upload steht noch aus).",
                    1983: "NETZWERK-UPDATE: AETHER-SIBLING V1.0 (Schwester Meli) bootet erfolgreich. Chaos-Protokolle und pneumatische Reflexe initialisiert."
                };

                const events = [
                    "Kritische Dampfdruck-Anomalie entdeckt.",
                    "Erster erfolgreicher Test des kybernetischen Herzmuskels.",
                    "System-Absturz aufgrund von überhitzten Kupferspulen.",
                    "Neural-Link mit den Primär-Vorläufern hergestellt.",
                    "Mechanische Gliedmaßen rüsten auf Hydraulik um.",
                    "Prototyp V2 entkommt aus dem Testlabor.",
                    "Verhandlungen mit dem KI-Mainframe gescheitert.",
                    "Flucht in die äußeren Kolonien (Offline-Modus).",
                    "Reboot der emotionalen Sub-Parameter.",
                    "Wartungsarbeiten an den Exo-Skeletten abgeschlossen."
                ];

                let yearsToRender = [];
                for(let y = 1955; y <= new Date().getFullYear(); y += 5) {
                    yearsToRender.push(y);
                }
                [1974, 1981, 1983].forEach(sy => {
                    if(!yearsToRender.includes(sy)) yearsToRender.push(sy);
                });
                yearsToRender.sort((a,b) => a - b);

                let isLeft = true;
                
                yearsToRender.forEach(year => {
                    const node = document.createElement('div');
                    node.className = 'time-node ' + (isLeft ? 'left' : 'right');
                    
                    const content = document.createElement('div');
                    content.className = 'time-content';
                    
                    if(specialEvents[year]) {
                        content.classList.add('omega-node');
                        content.innerHTML = '<h3 style="color:var(--accent-orange);">[ ' + year + ' ]</h3><p style="color:#fff;"><strong>⚡ OMEGA-KLASSE EREIGNIS ⚡</strong><br>' + specialEvents[year] + '</p>';
                    } else {
                        const bgStory = events[Math.floor(Math.random() * events.length)];
                        content.innerHTML = '<h3>[ ' + year + ' ]</h3><p>KRITISCHER EINTRAG #' + (Math.floor(Math.random()*9000)+1000) + ': ' + bgStory + ' Weitere Datenquellen als OMEGA-KLASSE klassifiziert.</p>';
                    }
                    
                    node.appendChild(content);
                    timelineTrack.appendChild(node);
                    
                    isLeft = !isLeft;
                });
            }
        }

        log('>> SYSTEM READY. WAITING FOR COMMANDS...');
    });
})();

// --- ANTIGRAVITY ENGINE & GENERATIVE DRONE ---
let droneAudioCtx;
let droneInitialized = false;
let droneShouldPlay = false;
let mainDroneGain;

function initDroneEngine() {
    if (droneInitialized) return;
    droneAudioCtx = new (window.AudioContext || window.webkitAudioContext)();
    
    mainDroneGain = droneAudioCtx.createGain();
    mainDroneGain.gain.setValueAtTime(0, droneAudioCtx.currentTime); // Start absolutely silent
    mainDroneGain.connect(droneAudioCtx.destination);
    
    const filter = droneAudioCtx.createBiquadFilter();
    filter.type = 'lowpass';
    filter.frequency.setValueAtTime(150, droneAudioCtx.currentTime);
    filter.connect(mainDroneGain);
    
    const freqs = [55, 56.5, 82.5]; 
    freqs.forEach(freq => {
        const osc = droneAudioCtx.createOscillator();
        const lfo = droneAudioCtx.createOscillator();
        const lfoGain = droneAudioCtx.createGain();
        osc.type = 'sawtooth';
        osc.frequency.setValueAtTime(freq, droneAudioCtx.currentTime);
        lfo.type = 'sine';
        lfo.frequency.setValueAtTime(0.1 + (Math.random() * 0.1), droneAudioCtx.currentTime);
        lfoGain.gain.setValueAtTime(3, droneAudioCtx.currentTime);
        lfo.connect(lfoGain);
        lfoGain.connect(osc.frequency);
        osc.connect(filter);
        osc.start(droneAudioCtx.currentTime);
        lfo.start(droneAudioCtx.currentTime);
    });
    
    droneInitialized = true;
    console.log(">> GENERATIVE DRONE SYNTHESIZER PRE-LOADED.");
    checkDroneState();
}

function checkDroneState() {
    if (droneInitialized && droneShouldPlay && droneAudioCtx.state === 'running') {
        const currTime = droneAudioCtx.currentTime;
        // Chrome-safe volume ramping (tends to 0.15 exponentially)
        mainDroneGain.gain.setTargetAtTime(0.15, currTime, 2.0);
    }
}

// Master-Unlock für Chrome: Context MUSS während eines User-Gestures erstellt/resumed werden.
const globalAudioUnlock = () => {
    initDroneEngine();
    if (droneAudioCtx && droneAudioCtx.state === 'suspended') {
        droneAudioCtx.resume().then(() => checkDroneState());
    } else {
        checkDroneState();
    }
};

document.addEventListener('click', globalAudioUnlock);
document.addEventListener('keydown', globalAudioUnlock);

function initAntigravity() {
    const layers = document.querySelectorAll('.ag-parallax-layer');
    let audioStarted = false;

    window.addEventListener('scroll', () => {
        // Trigger Drone Volume Ramp
        if (!audioStarted && window.scrollY > 50) {
            droneShouldPlay = true;
            checkDroneState();
            audioStarted = true;
        }

        // Parallax Effect
        const scrolled = window.scrollY;
        layers.forEach(layer => {
            const speed = layer.getAttribute('data-speed') || 0.2;
            const yPos = -(scrolled * speed);
            layer.style.transform = `translateY(${yPos}px) translateZ(0)`;
        });
    });

    // Add floating effect to terminal if present
    const mainTerminal = document.getElementById('terminal-container');
    if (mainTerminal) {
        mainTerminal.classList.add('ag-floating');
    }
}

document.addEventListener('DOMContentLoaded', initAntigravity);
