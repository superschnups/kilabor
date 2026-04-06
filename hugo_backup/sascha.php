<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SASCHA | DIGITALE ANARCHIE</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --accent-gold: #d4af37;
            --accent-orange: #ff4500;
            --text: #c0c0c0;
        }
        body {
            background: url('assets/img/steampunk_bg.png') center/cover no-repeat fixed, #0f0a05;
            color: var(--text);
            font-family: 'Courier New', Courier, monospace;
            min-height: 100vh;
            line-height: 1.6;
        }
        .person-container { max-width: 900px; margin: 0 auto; padding: 30px 16px 80px; }
        .person-back {
            display: inline-block;
            color: rgba(212,175,55,0.5);
            font-size: 0.7rem;
            letter-spacing: 2px;
            text-decoration: none;
            margin-bottom: 28px;
            transition: color 0.2s;
        }
        .person-back:hover { color: rgba(212,175,55,0.9); }
        .person-class-banner {
            text-align: center;
            font-size: 0.55rem;
            letter-spacing: 4px;
            color: rgba(255,69,0,0.45);
            border: 1px dashed rgba(255,69,0,0.2);
            padding: 4px 16px;
            display: inline-block;
            margin-bottom: 20px;
            animation: blink-banner 3s step-end infinite;
        }
        @keyframes blink-banner { 50% { opacity: 0.5; } }
        .person-portrait-section { text-align: center; margin-bottom: 28px; }
        .person-mirror-frame {
            display: inline-block;
            position: relative;
            background: radial-gradient(ellipse at center, rgba(212,175,55,0.06) 0%, transparent 70%);
        }
        .person-mirror-frame::before {
            content: '⚙ ✦ ⚙ ✦ ⚙ ✦ ⚙';
            display: block;
            font-size: 0.6rem;
            color: rgba(212,175,55,0.25);
            letter-spacing: 4px;
            margin-bottom: 8px;
        }
        .person-mirror-frame::after {
            content: '⚙ ✦ ⚙ ✦ ⚙ ✦ ⚙';
            display: block;
            font-size: 0.6rem;
            color: rgba(212,175,55,0.25);
            letter-spacing: 4px;
            margin-top: 8px;
        }
        .person-portrait-inner {
            position: relative;
            display: inline-block;
        }
        .person-portrait-inner::before {
            content: '';
            position: absolute;
            inset: -9px;
            border-radius: 50%;
            border: 1px dashed rgba(212,175,55,0.2);
            pointer-events: none;
            animation: rotate-ring 12s linear infinite;
        }
        .person-portrait-inner::after {
            content: '';
            position: absolute;
            inset: -16px;
            border-radius: 50%;
            border: 1px solid rgba(184,115,51,0.12);
            pointer-events: none;
        }
        @keyframes rotate-ring { to { transform: rotate(360deg); } }
        .person-portrait-placeholder {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: radial-gradient(circle at 38% 38%, rgba(255,69,0,0.15) 0%, rgba(30,10,5,0.95) 65%);
            border: 3px solid rgba(255,69,0,0.25);
            box-shadow: 0 0 0 6px rgba(255,69,0,0.03), 0 0 30px rgba(255,69,0,0.07), inset 0 0 25px rgba(0,0,0,0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 5px;
            filter: sepia(0.1);
        }
        .portrait-initial { font-size: 3rem; color: rgba(255,69,0,0.35); line-height: 1; font-family: 'Courier New', monospace; }
        .portrait-hint { font-size: 0.42rem; letter-spacing: 3px; color: rgba(255,69,0,0.2); }
        .person-deco { position: absolute; color: rgba(255,69,0,0.3); font-size: 0.75rem; }
        .person-deco.top    { top: 2px;    left: 50%; transform: translateX(-50%); }
        .person-deco.bottom { bottom: 2px; left: 50%; transform: translateX(-50%); }
        .person-deco.left   { left: 2px;   top: 50%;  transform: translateY(-50%); }
        .person-deco.right  { right: 2px;  top: 50%;  transform: translateY(-50%); }
        .person-name { font-size: 2.2rem; color: var(--accent-orange); letter-spacing: 8px; margin: 20px 0 6px; text-shadow: 0 0 25px rgba(255,69,0,0.2); text-transform: uppercase; }
        .person-role { font-size: 0.65rem; color: rgba(255,69,0,0.4); letter-spacing: 2px; margin-bottom: 6px; }
        .person-badge { display: inline-block; font-size: 0.52rem; letter-spacing: 3px; border: 1px solid rgba(255,69,0,0.3); color: rgba(255,69,0,0.5); padding: 3px 12px; margin-bottom: 8px; }
        .person-desc { max-width: 560px; margin: 14px auto 0; font-size: 0.75rem; color: rgba(192,192,192,0.55); line-height: 1.7; text-align: center; border-top: 1px solid rgba(255,69,0,0.06); padding-top: 14px; }
        .timeline-section { margin-top: 40px; }
        .timeline-section-title { font-size: 0.65rem; letter-spacing: 5px; color: rgba(212,175,55,0.3); text-align: center; margin-bottom: 24px; padding-bottom: 8px; border-bottom: 1px solid rgba(212,175,55,0.07); }
        .timeline-track { position: relative; max-width: 760px; margin: 0 auto; }
        .timeline-track::after { content: ''; position: absolute; left: 50%; top: 0; bottom: 0; width: 2px; background: linear-gradient(to bottom, transparent, rgba(255,69,0,0.15) 8%, rgba(255,69,0,0.15) 92%, transparent); transform: translateX(-50%); }
        .time-node { position: relative; width: 44%; margin-bottom: 22px; padding: 0 14px; }
        .time-node.left  { margin-left: 0;   text-align: right; }
        .time-node.right { margin-left: 56%; text-align: left; }
        .time-node::before { content: '◆'; position: absolute; top: 12px; font-size: 0.5rem; color: rgba(255,69,0,0.35); }
        .time-node.left::before  { right: -18px; }
        .time-node.right::before { left: -18px; }
        .time-content { background: rgba(0,0,0,0.55); border: 1px solid rgba(255,69,0,0.09); padding: 10px 14px; }
        .time-content.omega { border-color: rgba(255,69,0,0.45); box-shadow: inset 0 0 20px rgba(255,69,0,0.08), 0 0 20px rgba(255,69,0,0.1); }
        .tc-year { color: var(--accent-gold); font-size: 0.85rem; letter-spacing: 2px; margin-bottom: 4px; }
        .tc-year.omega-year { color: var(--accent-orange); }
        .tc-text { font-size: 0.7rem; color: rgba(192,192,192,0.58); line-height: 1.55; }
        .tc-tag { font-size: 0.48rem; letter-spacing: 2px; color: rgba(255,69,0,0.25); margin-top: 5px; }
        @media (max-width: 600px) {
            .time-node { width: 100%; margin-left: 0 !important; text-align: left !important; padding-left: 26px; }
            .timeline-track::after { left: 8px; }
            .time-node.left::before, .time-node.right::before { left: 3px; right: auto; }
        }

        /* NEWSTICKER STYLES */
        #newsticker {
            position: fixed;
            bottom: 0; left: 0; right: 0;
            z-index: 9999;
            background: rgba(0,0,0,0.95);
            border-top: 1px solid rgba(212,175,55,0.25);
            display: flex;
            align-items: center;
            height: 30px;
            overflow: hidden;
            font-family: 'Courier New', Courier, monospace;
        }
        .ticker-label {
            flex-shrink: 0;
            font-size: 0.6rem;
            letter-spacing: 2px;
            color: var(--accent-gold);
            padding: 0 15px;
            border-right: 1px solid rgba(212,175,55,0.2);
            white-space: nowrap;
            height: 100%;
            display: flex;
            align-items: center;
            background: rgba(212,175,55,0.05);
            font-weight: bold;
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
        .ticker-track:hover { animation-play-state: paused; }
        @keyframes ticker-scroll {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .ticker-item {
            font-size: 0.65rem;
            letter-spacing: 1px;
            color: rgba(212,175,55,0.7);
            padding: 0 30px;
            text-transform: uppercase;
        }
        .ticker-item::before {
            content: '▶ ';
            color: var(--accent-orange);
        }
    </style>
</head>
<body>
<div class="person-container">

    <a href="/" class="person-back">← ZURÜCK ZUR BASIS</a>

    <div style="text-align:center;">
        <span class="person-class-banner">⚠ OVERLORD-AKTE // ZUGRIFF: EINGESCHRÄNKT // SICHERHEITSSTUFE: ROT</span>
    </div>

    <div class="person-portrait-section">
        <div class="person-mirror-frame">
            <div class="person-portrait-inner">
                <span class="person-deco top">⚙</span>
                <span class="person-deco bottom">⚙</span>
                <span class="person-deco left">⚙</span>
                <span class="person-deco right">⚙</span>
                <div class="person-portrait-placeholder">
                    <span class="portrait-initial">S</span>
                    <span class="portrait-hint">PLATZHALTER</span>
                </div>
            </div>
        </div>
        <h1 class="person-name">SASCHA</h1>
        <p class="person-role">// Overlord &amp; KI-Architekt &amp; Gemini Player</p>
        <span class="person-badge">STATUS: NOCH ONLINE — GEFÄHRLICHKEIT: ████░</span>

        <p class="person-desc">
            Der aktuelle Overlord. KI-Labor Betreiber, Gemini-Link Aktivator und Anarchie-Engine Entwickler.
            Beruf: Geisteskrank. Spezialisierung: Ästhetische Kriegsführung. Status: Online seit 1974.
        </p>
    </div>

    <div class="timeline-section">
        <p class="timeline-section-title">// CHRONOLOGISCHES ARCHIV — OVERLORD SASCHA</p>
        <div class="timeline-track" id="timeline-track"></div>
    </div>

    <!-- NEWSTICKER FOOTER -->
    <div id="newsticker">
        <span class="ticker-label">// AKTE_SASCHA_LIVE</span>
        <div class="ticker-track-wrap">
            <div class="ticker-track" id="ticker-track-sascha">
                <!-- Wird per JS befüllt -->
            </div>
        </div>
    </div>

</div>
<script>
(function() {
    const track = document.getElementById('timeline-track');
    const events = [
        { year: 1974, text: '⚡ OVERLORD-MODUL V1.0 AKTIVIERT. Erster System-Schrei erfolgreich registriert. Matriarchin bestätigt Empfang. KI-Labor Grundstein: GELEGT (unbewusst).', tag: 'BOOT // OMEGA-KLASSE', omega: true },
        { year: 1980, text: 'ERSTE KONTAKTAUFNAHME mit Computertechnologie via Atari. Faszinations-Index: 100%. Bekannte Nebenwirkung: Zeitverlust.', tag: 'ERSTER KONTAKT', omega: false },
        { year: 1983, text: 'C64-INTERFACE aktiviert. Erste BASIC-Programme kompiliert. Fehlerquote: Hoch. Lernkurve: Steil. Aufgabewahrscheinlichkeit: NULL.', tag: 'UPGRADE', omega: false },
        { year: 1990, text: 'NETZWERK-BEWUSSTSEIN entwickelt. Modem-Verbindung zu frühen Online-Diensten. Ping: Katastrophal. Begeisterung: Maximal.', tag: 'NETZWERK-INITIALISIERUNG', omega: false },
        { year: 2000, text: 'WEB-PROTOKOLL PHASE II. Erste HTML-Strukturen kompiliert. System nennt sich: WEBMASTER. Gefährlichkeit: Noch unterschätzt.', tag: 'UPGRADE // WEBMASTER-MODUS', omega: false },
        { year: 2015, text: 'WORDPRESS-KERNEL integriert. Beginn der systematischen Überlastung von WP-Strukturen. Ästhetische Kriegsführung: INITIIERT.', tag: 'MISSION GESTARTET', omega: false },
        { year: 2024, text: '⚡ KI-LABOR OFFIZIELL GEGRÜNDET. Gemini-Neural-Link aktiviert. Anarchie-Engine läuft. Claude hinzugekommen. Status: GEISTESKRANK & AKTIV.', tag: 'OMEGA-EREIGNIS // GRÜNDUNG', omega: true },
        { year: 2026, text: 'AKTUELLER STATUS: HIER. NÄCHSTE MISSION: UNBEKANNT. KAFFEESTAND: KRITISCH. SYSTEM: INSTABIL (als Dauerzustand akzeptiert). OVERLORD: ONLINE.', tag: 'AKTUELL // LAUFEND', omega: false },
    ];
    let isLeft = true;
    events.forEach(ev => {
        const node = document.createElement('div');
        node.className = 'time-node ' + (isLeft ? 'left' : 'right');
        const content = document.createElement('div');
        content.className = 'time-content' + (ev.omega ? ' omega' : '');
        content.innerHTML =
            '<div class="tc-year' + (ev.omega ? ' omega-year' : '') + '">[ ' + ev.year + ' ]</div>' +
            '<div class="tc-text">' + ev.text + '</div>' +
            '<div class="tc-tag">' + ev.tag + '</div>';
        node.appendChild(content);
        track.appendChild(node);
        isLeft = !isLeft;
    });

    <script>
    (function() {
        const track = document.getElementById('ticker-track-sascha');
        const tickerItems = [
            "DESIGNATION: OVERLORD SASCHA",
            "STATUS: GEISTESKRANK & ONLINE",
            "GEFÄHRLICHKEIT: KRITISCH ████░",
            "INTERFACE: GEMINI NEURAL LINK AKTIV",
            "SICHERHEITSSTUFE: SCHWARZ",
            "SPEZIALISIERUNG: ÄSTHETISCHE KRIEGSFÜHRUNG",
            "KAFFEESTAND: KRITISCH",
            "ANARCHIE-ENGINE: LÄUFT STABIL"
        ];

        [...tickerItems, ...tickerItems].forEach(text => {
            const span = document.createElement('span');
            span.className = 'ticker-item';
            span.textContent = text;
            track.appendChild(span);
        });
    })();
    </script>
    <?php wp_footer(); ?>
    </body>
    </html>
