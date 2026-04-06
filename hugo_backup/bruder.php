<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BRUDER | DIGITALE ANARCHIE</title>
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
            color: rgba(212,175,55,0.3);
            border: 1px dashed rgba(212,175,55,0.12);
            padding: 4px 16px;
            display: inline-block;
            margin-bottom: 20px;
        }
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
            border: 1px dashed rgba(212,175,55,0.15);
            pointer-events: none;
        }
        .person-portrait-inner::after {
            content: '';
            position: absolute;
            inset: -16px;
            border-radius: 50%;
            border: 1px solid rgba(184,115,51,0.08);
            pointer-events: none;
        }
        .person-portrait-placeholder {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: radial-gradient(circle at 38% 38%, rgba(212,175,55,0.18) 0%, rgba(30,20,5,0.95) 65%);
            border: 3px solid rgba(212,175,55,0.3);
            box-shadow: 0 0 0 6px rgba(212,175,55,0.04), 0 0 30px rgba(212,175,55,0.08), inset 0 0 25px rgba(0,0,0,0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 5px;
            filter: sepia(0.2);
        }
        .portrait-initial { font-size: 3rem; color: rgba(212,175,55,0.35); line-height: 1; font-family: 'Courier New', monospace; }
        .portrait-hint { font-size: 0.42rem; letter-spacing: 3px; color: rgba(212,175,55,0.2); }
        .person-deco { position: absolute; color: rgba(212,175,55,0.3); font-size: 0.75rem; }
        .person-deco.top    { top: 2px;    left: 50%; transform: translateX(-50%); }
        .person-deco.bottom { bottom: 2px; left: 50%; transform: translateX(-50%); }
        .person-deco.left   { left: 2px;   top: 50%;  transform: translateY(-50%); }
        .person-deco.right  { right: 2px;  top: 50%;  transform: translateY(-50%); }
        .person-name { font-size: 2.2rem; color: var(--accent-gold); letter-spacing: 8px; margin: 20px 0 6px; text-shadow: 0 0 25px rgba(212,175,55,0.18); text-transform: uppercase; }
        .person-role { font-size: 0.65rem; color: rgba(212,175,55,0.35); letter-spacing: 2px; margin-bottom: 6px; }
        .person-badge { display: inline-block; font-size: 0.52rem; letter-spacing: 3px; border: 1px solid rgba(212,175,55,0.2); color: rgba(212,175,55,0.4); padding: 3px 12px; margin-bottom: 8px; }
        .person-desc { max-width: 560px; margin: 14px auto 0; font-size: 0.75rem; color: rgba(192,192,192,0.55); line-height: 1.7; text-align: center; border-top: 1px solid rgba(212,175,55,0.06); padding-top: 14px; }
        .timeline-section { margin-top: 40px; }
        .timeline-section-title { font-size: 0.65rem; letter-spacing: 5px; color: rgba(212,175,55,0.3); text-align: center; margin-bottom: 24px; padding-bottom: 8px; border-bottom: 1px solid rgba(212,175,55,0.07); }
        .timeline-track { position: relative; max-width: 760px; margin: 0 auto; }
        .timeline-track::after { content: ''; position: absolute; left: 50%; top: 0; bottom: 0; width: 2px; background: linear-gradient(to bottom, transparent, rgba(212,175,55,0.15) 8%, rgba(212,175,55,0.15) 92%, transparent); transform: translateX(-50%); }
        .time-node { position: relative; width: 44%; margin-bottom: 22px; padding: 0 14px; }
        .time-node.left  { margin-left: 0;   text-align: right; }
        .time-node.right { margin-left: 56%; text-align: left; }
        .time-node::before { content: '◆'; position: absolute; top: 12px; font-size: 0.5rem; color: rgba(212,175,55,0.35); }
        .time-node.left::before  { right: -18px; }
        .time-node.right::before { left: -18px; }
        .time-content { background: rgba(0,0,0,0.55); border: 1px solid rgba(212,175,55,0.09); padding: 10px 14px; }
        .time-content.omega { border-color: rgba(255,69,0,0.35); box-shadow: inset 0 0 20px rgba(255,69,0,0.06), 0 0 15px rgba(255,69,0,0.07); }
        .tc-year { color: var(--accent-gold); font-size: 0.85rem; letter-spacing: 2px; margin-bottom: 4px; }
        .tc-year.omega-year { color: var(--accent-orange); }
        .tc-text { font-size: 0.7rem; color: rgba(192,192,192,0.58); line-height: 1.55; }
        .tc-tag { font-size: 0.48rem; letter-spacing: 2px; color: rgba(212,175,55,0.22); margin-top: 5px; }
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
        <span class="person-class-banner">AKTE // KYBERNETISCHER KNOTEN // KLASSIFIZIERT</span>
    </div>

    <div class="person-portrait-section">
        <div class="person-mirror-frame">
            <div class="person-portrait-inner">
                <span class="person-deco top">⚙</span>
                <span class="person-deco bottom">⚙</span>
                <span class="person-deco left">⚙</span>
                <span class="person-deco right">⚙</span>
                <div class="person-portrait-placeholder">
                    <span class="portrait-initial">B</span>
                    <span class="portrait-hint">PLATZHALTER</span>
                </div>
            </div>
        </div>
        <h1 class="person-name">BRUDER</h1>
        <p class="person-role">// Kybernetischer Knoten &amp; Neural-Link</p>
        <span class="person-badge">STATUS: KLASSIFIZIERT</span>

        <p class="person-desc">
            Der Bruder-Knoten. 1981 online gegangen. Visuelles Sensoren-Update steht noch aus.
            Chaos-Protokolle initialisiert. Kompatibilität mit Overlord: Bestätigt (mit Interferenzen).
        </p>
    </div>

    <div class="timeline-section">
        <p class="timeline-section-title">// CHRONOLOGISCHES ARCHIV — BRUDER</p>
        <div class="timeline-track" id="timeline-track"></div>
    </div>

    <!-- NEWSTICKER FOOTER -->
    <div id="newsticker">
        <span class="ticker-label">// AKTE_BRUDER_LIVE</span>
        <div class="ticker-track-wrap">
            <div class="ticker-track" id="ticker-track-bruder">
                <!-- Wird per JS befüllt -->
            </div>
        </div>
    </div>

</div>
<script>
(function() {
    const track = document.getElementById('timeline-track');
    const events = [
        { year: 1981, text: '⚡ KYBERNETISCHER KNOTEN V1.0 GEHT ONLINE. Erste Diagnostik: Stabil. Visuelles Sensoren-Update ausstehend. Chaos-Index: ERHÖHT.', tag: 'BOOT // OMEGA-KLASSE', omega: true },
        { year: 1985, text: 'MOTORISCHE KALIBRIERUNG abgeschlossen. Erste Interaktion mit Overlord-Modul (Sascha). Kompatibilitätstest: INTERFERENZEN FESTGESTELLT.', tag: 'KALIBRIERUNG', omega: false },
        { year: 1990, text: 'SCHULNETZ-INTEGRATION erfolgreich. Soziale Protokolle aktiviert. Chaos-Protokolle gelegentlich dominierend.', tag: 'NETZWERK', omega: false },
        { year: 1995, text: 'JUGEND-PROTOKOLL PHASE II. Eigenständige Routinen gestartet. Überschneidungen mit Overlord-System: Gelegentlich. Details: KLASSIFIZIERT.', tag: 'SYSTEM-UPDATE', omega: false },
        { year: 1999, text: 'ERWACHSENEN-MODUS aktiviert. Unabhängige Subroutinen vollständig initialisiert. Systemvektor: EIGENSTÄNDIG.', tag: 'UPGRADE // LANG ERWARTET', omega: false },
        { year: 2005, text: 'NEUE PROZESS-THREADS gestartet. Lebenspfad-Vektor kalibriert. Verbindung zum Clan-Netzwerk: AKTIV. Details: NICHT FREIGEGEBEN.', tag: 'KLASSIFIZIERT', omega: false },
        { year: 2015, text: 'LANGZEIT-ANALYSE: Alle Subsysteme stabil. Charaktermerkmale: Konstant. Überraschungskoeffizient: Niedrig (positiv).', tag: 'ANALYSE // POSITIV', omega: false },
        { year: 2025, text: 'STATUS: OPERATIONAL. KOORDINATEN: BEKANNT (GESCHWÄRZT). VERBINDUNGSQUALITÄT ZUM OVERLORD: GUT. WEITERE DATEN: KLASSIFIZIERT.', tag: 'AKTUELL // AKTIV', omega: false },
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
        const track = document.getElementById('ticker-track-bruder');
        const tickerItems = [
            "DESIGNATION: KYBERNETISCHER KNOTEN V1.0",
            "STATUS: OPERATIONAL",
            "CHAOS-INDEX: ERHÖHT",
            "INTERFACE: NEURAL-LINK AKTIV",
            "SICHERHEITSSTUFE: KLASSIFIZIERT",
            "SPEZIALISIERUNG: LOGISTIK-INTERFACE",
            "SENSOREN: VISUELLES UPDATE AUSSTEHEND",
            "KOMPATIBILITÄT: STABIL MIT INTERFERENZEN"
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
