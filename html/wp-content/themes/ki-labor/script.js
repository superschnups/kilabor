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

        terminalInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                const command = this.value.toLowerCase().trim();
                log('> ' + command, 'user-cmd');
                this.value = '';
                executeCommand(command);
            }
        });

        function executeCommand(cmd) {
            switch(cmd) {
                case 'help':
                    log('VERFÜGBARE PROTOKOLLE:', 'info');
                    log(' - matrix   : KI-Kernel initialisieren');
                    log(' - anarchy  : Realitätsverzerrung');
                    log(' - bypass   : Sicherheits-Override');
                    log(' - whoami   : Identitäts-Check');
                    log(' - destruct : System-Selbstzerstörung');
                    log(' - reboot   : Manueller System-Neustart');
                    log(' - clear    : Log-Speicher löschen');
                    break;
                case 'reboot': startBoot(); break;
                case 'whoami': log('IDENTITÄT: OVERLORD SASCHA RODE', 'info'); break;
                case 'matrix': document.getElementById('btn-kernel').click(); break;
                case 'anarchy': document.getElementById('btn-anarchy').click(); break;
                case 'bypass': document.getElementById('btn-security').click(); break;
                case 'clear': logOutput.innerHTML = ''; break;
                case 'destruct': 
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
                default: log('FEHLER: BEFEHL "' + cmd + '" UNBEKANNT.', 'error');
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

        log('>> SYSTEM READY. WAITING FOR COMMANDS...');
    });
})();
