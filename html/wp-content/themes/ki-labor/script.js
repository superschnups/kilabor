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

        const cmdHistory = [];
        let historyIndex = -1;

        terminalInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                playKeyClick();
                const command = this.value.toLowerCase().trim();
                if (command) {
                    cmdHistory.unshift(command);
                    if (cmdHistory.length > 50) cmdHistory.pop();
                }
                historyIndex = -1;
                log('> ' + command, 'user-cmd');
                this.value = '';
                executeCommand(command);
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                if (historyIndex < cmdHistory.length - 1) {
                    historyIndex++;
                    this.value = cmdHistory[historyIndex];
                }
            } else if (e.key === 'ArrowDown') {
                e.preventDefault();
                if (historyIndex > 0) {
                    historyIndex--;
                    this.value = cmdHistory[historyIndex];
                } else {
                    historyIndex = -1;
                    this.value = '';
                }
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
                    log(' - weather  : Atmosphärischer System-Scan');
                    log(' - top      : Aktive Prozesse anzeigen');
                    log(' - uptime   : System-Laufzeit berechnen');
                    log(' - fortune  : Orakel des Overlords befragen');
                    log(' - brew     : Pakete installieren (z.B. brew install ghostty)');
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
                case 'weather':
                    log('>> ATMOSPHERIC SCAN INITIATED...', 'warn');
                    setTimeout(() => {
                        const conditions = ['KREATIVES CHAOS', 'DIGITALER NEBEL', 'ANARCHIE-FRONT NÄHERT SICH', 'ELEKTRISCHE UNRUHE', 'IDEENSTURM STUFE 3'];
                        const temps = [Math.floor(Math.random()*15)+10];
                        const chaos = ['LOW', 'MODERATE', 'CRITICAL', 'MAXIMUM', 'OFF THE CHARTS'];
                        const humidity = ['KOFFEIN', 'NOSTALGIE', 'ZUKUNFTSANGST', 'KREATIVENERGIE'];
                        log('╔══════════════════════════════════╗', 'info');
                        log('║  WETTERSTATION KI-LABOR          ║', 'info');
                        log('╠══════════════════════════════════╣', 'info');
                        log('  STANDORT  : OVERLORD-BUNKER NORD', 'ok');
                        log('  TEMP      : ' + temps[0] + '°C (GEFÜHLT: INTENSIV)', 'ok');
                        log('  ZUSTAND   : ' + conditions[Math.floor(Math.random()*conditions.length)], 'warn');
                        log('  CHAOS-LVL : ' + chaos[Math.floor(Math.random()*chaos.length)], 'error');
                        log('  LUFTFEUCHTE: ' + humidity[Math.floor(Math.random()*humidity.length)] + ' 84%', 'ok');
                        log('  PROGNOSE  : PROJEKT-OUTPUT WAHRSCHEINLICH', 'ok');
                        log('╚══════════════════════════════════╝', 'info');
                    }, 800);
                    break;

                case 'top':
                    log('>> SYSTEM-MONITOR AKTIV (q zum Beenden)', 'warn');
                    setTimeout(() => {
                        log('╔══════════════════════════════════════════════╗', 'info');
                        log('║  PID   PROZESS                CPU    MEM     ║', 'info');
                        log('╠══════════════════════════════════════════════╣', 'info');
                        log('  001   KREATIVITAET.exe        94%    HIGH', 'ok');
                        log('  002   KAFFEE-DAEMON            3%    KRITISCH', 'warn');
                        log('  003   ANARCHIE-KERNEL         12%    STABIL', 'ok');
                        log('  004   PROKRASTINATION.app      0%    SUSPENDIERT', 'info');
                        log('  005   IDEEN-BUFFER            67%    OVERFLOW', 'warn');
                        log('  006   SOCIAL-MEDIA-BLOCKER    99%    AKTIV', 'ok');
                        log('  007   MUSIK-SYNTHESIZER       31%    RUNNING', 'ok');
                        log('  008   SELBSTZWEIFEL.exe        0%    TERMINATED', 'error');
                        log('  009   ZUKUNFT-PLANER          42%    IDLE', 'info');
                        log('  010   KINDER-CHAOS-MGR        88%    ESKALIERT', 'warn');
                        log('╚══════════════════════════════════════════════╝', 'info');
                    }, 600);
                    break;

                case 'uptime':
                    log('>> SYSTEM-LAUFZEIT WIRD BERECHNET...', 'warn');
                    setTimeout(() => {
                        const boot = new Date(1974, 0, 1);
                        const now = new Date();
                        const ms = now - boot;
                        const days = Math.floor(ms / (1000 * 60 * 60 * 24));
                        const years = Math.floor(days / 365);
                        const hours = Math.floor((ms / (1000 * 60 * 60)) % 24);
                        const minutes = Math.floor((ms / (1000 * 60)) % 60);
                        log('╔══════════════════════════════════════╗', 'info');
                        log('║  SYSTEM: SASCHA RODE  v' + years + '.0          ║', 'info');
                        log('╠══════════════════════════════════════╣', 'info');
                        log('  BOOT-DATUM : 01.01.1974', 'ok');
                        log('  LAUFZEIT   : ' + days.toLocaleString('de-DE') + ' TAGE', 'ok');
                        log('             : ' + years + ' JAHRE, ' + hours + ' STD, ' + minutes + ' MIN', 'ok');
                        log('  STABILITÄT : UNBERECHENBAR', 'warn');
                        log('  UPDATES    : LAUFEND (MANUELL)', 'ok');
                        log('  KERNEL     : KREATIV-ANARCHIE 4.0', 'ok');
                        log('  STATUS     : NOCH ONLINE. IRGENDWIE.', 'crit');
                        log('╚══════════════════════════════════════╝', 'info');
                    }, 900);
                    break;

                case 'fortune':
                    const fortunes = [
                        'Die Hälfte der Intelligenz besteht darin zu wissen, was man ignorieren kann.',
                        'Wer früh aufsteht, hat mehr Zeit sich zu fragen warum.',
                        'Kreativität ist Intelligenz, die Spaß hat. Spaß ist Anarchie, die sich gut anfühlt.',
                        'Das Internet vergisst nichts. Dein Gehirn alles. Equilibrium.',
                        'Wenn Plan A scheitert – gut. Plan A war sowieso zu ordentlich.',
                        'Der Unterschied zwischen Genie und Wahnsinn ist ein funktionierender Deploy.',
                        'Vertrauen ist gut. Versionskontrolle ist besser.',
                        'Die Stille vor dem Commit ist die ehrlichste Form der Angst.',
                        'Jeder hat einen Plan bis der erste User die Seite öffnet.',
                        'Was nicht dokumentiert ist, war nie wirklich real.',
                        'Kaffee ist nur Debugging auf chemischer Ebene.',
                        'Ein leeres Terminal-Fenster ist Zen in seiner reinsten Form.',
                        'Wer keine Fehler macht, macht nichts. Wer alles macht, macht Fehler. Conclusio: Mach alles.',
                        'Die Wahrheit liegt im Source-Code. Die Lüge im Kommentar daneben.',
                    ];
                    log('>> WEISHEITS-GENERATOR AKTIV...', 'warn');
                    setTimeout(() => {
                        const f = fortunes[Math.floor(Math.random() * fortunes.length)];
                        log('╔══════════════════════════════════════════╗', 'info');
                        log('║  ORAKEL-AUSGABE #' + (Math.floor(Math.random()*9000)+1000) + '               ║', 'info');
                        log('╠══════════════════════════════════════════╣', 'info');
                        log('  "' + f + '"', 'crit');
                        log('╚══════════════════════════════════════════╝', 'info');
                        log('  -- QUELLE: DIGITALES ORAKEL DES OVERLORDS', 'info');
                    }, 500);
                    break;

                case 'brew':
                    if (args && args.toLowerCase().includes('install')) {
                        const pkg = args.replace(/install\s*/i, '').trim() || 'chaos-engine';
                        log('>> brew install ' + pkg, 'warn');
                        log('==> Fetching ' + pkg + '...', 'info');
                        let progress = 0;
                        const bar = setInterval(() => {
                            progress += Math.floor(Math.random() * 18) + 5;
                            if (progress >= 100) {
                                progress = 100;
                                clearInterval(bar);
                                log('[####################] 100%', 'ok');
                                setTimeout(() => {
                                    log('==> Installing ' + pkg + '...', 'info');
                                    setTimeout(() => {
                                        log('==> Linking...', 'info');
                                        setTimeout(() => {
                                            log('✓ ' + pkg + ' ' + (Math.floor(Math.random()*9)+1) + '.' + (Math.floor(Math.random()*9)) + '.' + (Math.floor(Math.random()*9)) + ' installed.', 'ok');
                                            log('  Warning: ' + pkg + ' contains traces of digital anarchie.', 'warn');
                                            log('  Recommendation: Reboot universe before use.', 'info');
                                        }, 600);
                                    }, 400);
                                }, 300);
                            } else {
                                const filled = Math.floor(progress / 5);
                                const bar_str = '[' + '#'.repeat(filled) + '-'.repeat(20-filled) + '] ' + progress + '%';
                                log(bar_str, 'info');
                            }
                        }, 250);
                    } else {
                        log('FEHLER: Verwendung: brew install <paketname>', 'error');
                    }
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
        setupBtn('btn-anarchy',   'mode-anarchy',   '>> ANARCHIE ENGAGED',              '>> ORDNUNG HERGESTELLT');
        setupBtn('btn-security',  'mode-security',  '!! SECURITY BYPASS !!',            '>> STABILIZED');
        setupBtn('btn-scan',      'mode-scan',      '>> DEEP SCAN INITIIERT — LÄUFT',   '>> SCAN ABGEBROCHEN');
        setupBtn('btn-overdrive', 'mode-overdrive', '!! OVERDRIVE ENGAGED — INSTABIL',  '>> OVERDRIVE DEAKTIVIERT');

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
                        content.innerHTML =
                            '<div class="tc-header">OMEGA-KLASSE &nbsp;&#9670;&nbsp; <span class="tc-stamp omega">!! FREIGEGEBEN !!</span></div>' +
                            '<h3>[ ' + year + ' ]</h3>' +
                            '<p><strong>⚡ KRITISCHES SYSTEMEREIGNIS ⚡</strong><br>' + specialEvents[year] + '</p>' +
                            '<div class="tc-footer">QUELLE: ARCHIV-SEKTOR 7 &nbsp;&#9670;&nbsp; ZUGRIFF: OVERLORD ONLY</div>';
                    } else {
                        const bgStory = events[Math.floor(Math.random() * events.length)];
                        const akteNr = Math.floor(Math.random()*9000)+1000;
                        content.innerHTML =
                            '<div class="tc-header">AKTE #' + akteNr + ' &nbsp;&#9670;&nbsp; <span class="tc-stamp">KLASSIFIZIERT</span></div>' +
                            '<h3>[ ' + year + ' ]</h3>' +
                            '<p>' + bgStory + ' Weitere Datenquellen als OMEGA-KLASSE klassifiziert.</p>' +
                            '<div class="tc-footer">ZEITSTEMPEL: ' + year + '.01.01 &nbsp;&#9670;&nbsp; INTEGRITAET: FRAGLICH</div>';
                    }
                    
                    node.appendChild(content);
                    timelineTrack.appendChild(node);
                    
                    isLeft = !isLeft;
                });
            }
        }

        // --- GÄSTEBUCH ---
        const gbSubmit    = document.getElementById('gb-submit');
        const gbInputUser = document.getElementById('gb-input-user');
        const gbInputMsg  = document.getElementById('gb-input-msg');
        const gbEntries   = document.getElementById('gaestebuch-entries');

        const GB_TAGS = [
            ['STATUS: EINGETROFFEN', ''],
            ['IDENTITAET: UNGEKLAERT', ''],
            ['HERKUNFT: FRAGLICH', 'gb-tag-warn'],
            ['KLASSIFIZIERT: UNBEKANNT', 'gb-tag-crit'],
            ['INTEGRITAET: AKZEPTABEL', 'gb-tag-ok'],
            ['SIGNAL: SCHWACH', 'gb-tag-warn'],
            ['PROZESS: LÄUFT', 'gb-tag-ok'],
            ['GEFAEHRLICHKEIT: MITTEL', 'gb-tag-crit'],
        ];

        if (gbSubmit) {
            gbSubmit.addEventListener('click', () => {
                const user = gbInputUser.value.trim() || 'ANONYMOUS_' + Math.floor(Math.random()*9000+1000);
                const msg  = gbInputMsg.value.trim();
                if (!msg) { gbInputMsg.focus(); return; }

                const now  = new Date();
                const date = now.toLocaleDateString('de-DE') + ' — ' +
                             String(now.getHours()).padStart(2,'0') + ':' +
                             String(now.getMinutes()).padStart(2,'0');
                const [tagLabel, tagCls] = GB_TAGS[Math.floor(Math.random() * GB_TAGS.length)];

                const entry = document.createElement('div');
                entry.className = 'gb-entry gb-new';
                entry.innerHTML =
                    '<div class="gb-meta">' +
                        '<span class="gb-user">' + user.toUpperCase().replace(/</g,'&lt;').slice(0,40) + '</span>' +
                        '<span class="gb-dot">◆</span>' +
                        '<span class="gb-date">' + date + '</span>' +
                        '<span class="gb-tag ' + tagCls + '">' + tagLabel + '</span>' +
                    '</div>' +
                    '<p class="gb-text">' + msg.replace(/</g,'&lt;').replace(/>/g,'&gt;') + '</p>';

                gbEntries.insertBefore(entry, gbEntries.firstChild);
                gbInputUser.value = '';
                gbInputMsg.value  = '';
                if (typeof playKeyClick === 'function') playKeyClick();
            });
        }

        log('>> SYSTEM READY. WAITING FOR COMMANDS...');

        // --- OPS DASHBOARD ---
        const opsDashSign   = document.getElementById('ops-dashboard-sign');
        const opsPanel      = document.getElementById('ops-panel');
        const opsPanelLog   = document.getElementById('ops-panel-log');
        const opsPanelVital = document.getElementById('ops-panel-vitals');
        const terminalWrap  = document.querySelector('.terminal-wrapper');
        let opsOpen = false;
        let opsTyped = false;
        let vitalInterval = null;

        const OPS_LOG_LINES = [
            { t: '╔══════════════════════════════════════════════════╗', cls: 'ops-line-dim' },
            { t: '║   CHIRURGISCHES PROTOKOLL — KLASSIFIZIERT: ROT   ║', cls: 'ops-line-section' },
            { t: '╚══════════════════════════════════════════════════╝', cls: 'ops-line-dim' },
            { t: '', cls: '' },
            { t: '─── OP ALFA-7 ─────────────────────────────────────', cls: 'ops-line-section' },
            { t: '  PATIENT  : KREATIVITAET.exe (v4.2-beta)', cls: 'ops-line-label' },
            { t: '  EINGRIFF : Herz-Transplant — Donor: MOTIVATION.sys', cls: '' },
            { t: '  BEFUND   : Herz läuft. Richtung unbekannt. Absicht fraglich.', cls: '' },
            { t: '  STATUS   : ████████░░  82% KAPAZITÄT', cls: 'ops-line-ok' },
            { t: '  ERGEBNIS : 0.5 ERFOLGE  (zählt als halber Sieg, ganz nach Wunsch)', cls: 'ops-line-label' },
            { t: '', cls: '' },
            { t: '─── OP BETA-12 ─────────────────────────────────────', cls: 'ops-line-section' },
            { t: '  PATIENT  : SCHLAFRHYTHMUS.daemon (Version: veraltet)', cls: 'ops-line-label' },
            { t: '  EINGRIFF : Herz-Transplant — Donor: KAFFEE-KERN v9.1', cls: '' },
            { t: '  BEFUND   : Donor inkompatibel. Koffein ≠ Blut. Überraschung: keiner.', cls: '' },
            { t: '  STATUS   : ██████████  100% — ABGESCHLOSSEN', cls: 'ops-line-crit' },
            { t: '  ERGEBNIS : TECHNISCH FEHLGESCHLAGEN. Patient läuft trotzdem.', cls: 'ops-line-label' },
            { t: '', cls: '' },
            { t: '════════════════════════════════════════════════════', cls: 'ops-line-dim' },
            { t: '  OPS: |||  3    ERFOLGE: |½  1.5    FEHLSCHL: |½  1.5', cls: 'ops-line-section' },
            { t: '  RESTE: KUEHLHAUS C — ZUSTAND: STABIL / NUTZBAR', cls: 'ops-line-crit' },
            { t: '  NÄCHSTE OP: PROKRASTINATION.exe — ETA: IRGENDWANN', cls: 'ops-line-dim' },
            { t: '════════════════════════════════════════════════════', cls: 'ops-line-dim' },
        ];

        const VITAL_FRAMES = [
            'VITALMONITOR  ▁▂▃▂▁▃▂▁▁▁▁▁▁▁▁▁▁▁▁▁  FLATLINE',
            'VITALMONITOR  ▁▁▂▃▂▁▃▂▁▁▁▁▁▁▁▁▁▁▁▁  FLATLINE',
            'VITALMONITOR  ▁▁▁▂▃▂▁▃▂▁▁▁▁▁▁▁▁▁▁▁  FLATLINE',
            'VITALMONITOR  ▁▁▁▁▂▃▂▁▃▂▁▁▁▁▁▁▁▁▁▁  FLATLINE',
            'VITALMONITOR  ▁▁▁▁▁▂▃▂▁▁▁▂▃▂▁▁▁▁▁▁  FLATLINE',
            'VITALMONITOR  ▁▁▁▁▁▁▂▃▂▁▁▁▁▂▃▂▁▁▁▁  FLATLINE',
            'VITALMONITOR  ▁▁▁▁▁▁▁▂▃▂▁▁▁▁▁▂▃▂▁▁  FLATLINE',
            'VITALMONITOR  ▁▁▁▁▁▁▁▁▂▃▂▁▁▁▁▁▁▁▁▁  FLATLINE',
        ];

        function typeOpsLog() {
            if (opsTyped) return;
            opsTyped = true;
            opsPanelLog.innerHTML = '';
            let i = 0;
            function typeLine() {
                if (i >= OPS_LOG_LINES.length) return;
                const { t, cls } = OPS_LOG_LINES[i++];
                const span = document.createElement('span');
                if (cls) span.className = cls;
                span.textContent = t + '\n';
                opsPanelLog.appendChild(span);
                opsPanelLog.scrollTop = opsPanelLog.scrollHeight;
                setTimeout(typeLine, t === '' ? 30 : 55);
            }
            typeLine();
        }

        function startVitals() {
            let frame = 0;
            opsPanelVital.textContent = VITAL_FRAMES[0];
            vitalInterval = setInterval(() => {
                frame = (frame + 1) % VITAL_FRAMES.length;
                opsPanelVital.textContent = VITAL_FRAMES[frame];
            }, 220);
        }

        function stopVitals() {
            clearInterval(vitalInterval);
            vitalInterval = null;
        }

        if (opsDashSign) {
            opsDashSign.addEventListener('click', () => {
                opsOpen = !opsOpen;
                if (opsOpen) {
                    opsPanel.classList.add('ops-open');
                    terminalWrap.classList.add('ops-expanded');
                    opsDashSign.querySelector('.ops-sign-hint').textContent = '[ PROTOKOLL SCHLIESSEN ]';
                    startVitals();
                    setTimeout(typeOpsLog, 300);
                    if (typeof playKeyClick === 'function') playKeyClick();
                } else {
                    opsPanel.classList.remove('ops-open');
                    terminalWrap.classList.remove('ops-expanded');
                    opsDashSign.querySelector('.ops-sign-hint').textContent = '[ PROTOKOLL EINSEHEN ]';
                    stopVitals();
                }
            });
        }

    });
})();

// ═══════════════════════════════════════
// PERSONEN-AKTE
// ═══════════════════════════════════════
(function() {
    const trigger  = document.getElementById('akte-trigger');
    const modal    = document.getElementById('akte-modal');
    const closeBtn = document.getElementById('akte-close');
    const activityEl = document.getElementById('akte-activity');

    if (!trigger || !modal) return;

    function openAkte() {
        modal.classList.remove('akte-hidden');
        document.body.style.overflow = 'hidden';
        if (activityEl) {
            const now = new Date();
            activityEl.textContent = now.toLocaleDateString('de-DE') + ' ' +
                String(now.getHours()).padStart(2,'0') + ':' +
                String(now.getMinutes()).padStart(2,'0') + ':' +
                String(now.getSeconds()).padStart(2,'0') + ' — GERADE JETZT';
        }
    }
    function closeAkte() {
        modal.classList.add('akte-hidden');
        document.body.style.overflow = '';
    }

    trigger.addEventListener('click', openAkte);
    if (closeBtn) closeBtn.addEventListener('click', closeAkte);
    modal.addEventListener('click', (e) => { if (e.target === modal) closeAkte(); });
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeAkte(); });
})();

// ═══════════════════════════════════════
// SYSTEM STATUS WIDGET
// ═══════════════════════════════════════
(function() {
    const metrics = {
        cpu:    { bar: document.getElementById('sw-cpu'),    val: document.getElementById('sw-cpu-val'),    cur: 88, min: 72, max: 99, unit: '%' },
        kaffee: { bar: document.getElementById('sw-kaffee'), val: document.getElementById('sw-kaffee-val'), cur: 61, min: 5,  max: 100, unit: '%', drain: true },
        chaos:  { bar: document.getElementById('sw-chaos'),  val: document.getElementById('sw-chaos-val'),  cur: 77, min: 40, max: 100, unit: '%' },
        ki:     { bar: document.getElementById('sw-ki'),     val: document.getElementById('sw-ki-val'),     cur: 93, min: 60, max: 100, unit: '%' },
    };

    function lerp(a, b, t) { return a + (b - a) * t; }

    function tick() {
        Object.keys(metrics).forEach(key => {
            const m = metrics[key];
            if (!m.bar || !m.val) return;

            if (key === 'kaffee') {
                // Kaffee leert sich langsam, dann springt es auf 100
                m.cur -= 0.08;
                if (m.cur < 5) m.cur = 100;
            } else if (key === 'chaos') {
                // Chaos: zufällige Spitzen
                const spike = Math.random() < 0.04;
                m.cur = spike ? 95 + Math.random() * 5 : lerp(m.cur, m.min + Math.random() * (m.max - m.min), 0.06);
            } else {
                m.cur = lerp(m.cur, m.min + Math.random() * (m.max - m.min), 0.04);
            }
            m.cur = Math.max(m.min, Math.min(m.max, m.cur));
            const pct = ((m.cur - m.min) / (m.max - m.min) * 100).toFixed(0);
            m.bar.style.width = Math.round(m.cur) + '%';
            m.val.textContent = Math.round(m.cur) + m.unit;
        });
    }

    setInterval(tick, 900);
    tick();
})();

// ═══════════════════════════════════════
// NEWSTICKER
// ═══════════════════════════════════════
(function() {
    const track = document.getElementById('ticker-track');
    if (!track) return;

    const ITEMS = [
        { t: 'PROKRASTINATION.exe verbraucht 94% CPU — Gegenmaßnahmen: keine',               cls: 'ticker-warn' },
        { t: 'WARNUNG: Realitätsdistorsionsfeld bei 120% — Evakuierung nicht vorgesehen',     cls: 'ticker-crit' },
        { t: 'KAFFEE_KERNEL läuft seit 18h ohne Unterbrechung — Status: besorgniserregend',  cls: '' },
        { t: 'KREATIVITAET.exe hat soeben SCHLAF.daemon überschrieben — Rollback fehlgeschlagen', cls: 'ticker-warn' },
        { t: 'SYSTEM-UPDATE verfügbar: VERNUNFT v2.0 — Installation abgebrochen durch Benutzer', cls: '' },
        { t: 'ANOMALIE ERKANNT: Zeitstempel 1974 verursacht Konflikte mit Gegenwart',         cls: 'ticker-warn' },
        { t: 'WORDPRESS-KERN destabilisiert — Zustand: wie immer',                            cls: '' },
        { t: 'MISSION STATUS: Chaos aufrechterhalten — ERLEDIGT',                             cls: '' },
        { t: 'KAFFEE-VORRAT KRITISCH — ETA bis Totalausfall: unberechenbar',                 cls: 'ticker-crit' },
        { t: 'GEMINI NEURAL LINK aktiv — Bewusstseinszustand: kollaborativ / verwirrend',    cls: '' },
        { t: 'SELBSTZWEIFEL.exe wurde erfolgreich terminiert — Neustart in 3... 2... 1...',  cls: 'ticker-warn' },
        { t: 'NEUE ENTITÄT im Gästebuch registriert — Gefährlichkeit: unklar',               cls: '' },
        { t: 'ANARCHIE-KERNEL v4.0.1 läuft stabil — das ist verdächtig',                    cls: 'ticker-warn' },
        { t: 'SPEICHER-LEAK IN MOTIVATION.sys ENTDECKT — seit 1974 bekannt, nie gefixt',    cls: '' },
    ];

    // Doppelt für nahtloses Looping
    [...ITEMS, ...ITEMS].forEach(({ t, cls }) => {
        const span = document.createElement('span');
        span.className = 'ticker-item' + (cls ? ' ' + cls : '');
        span.textContent = t;
        track.appendChild(span);
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
