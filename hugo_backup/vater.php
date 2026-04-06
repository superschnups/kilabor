<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VATER | DIGITALE ANARCHIE</title>
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
            box-shadow:
                0 0 0 6px rgba(212,175,55,0.04),
                0 0 30px rgba(212,175,55,0.08),
                inset 0 0 25px rgba(0,0,0,0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 5px;
            filter: sepia(0.2);
        }
        .portrait-initial {
            font-size: 3rem;
            color: rgba(212,175,55,0.35);
            line-height: 1;
            font-family: 'Courier New', monospace;
        }
        .portrait-hint {
            font-size: 0.42rem;
            letter-spacing: 3px;
            color: rgba(212,175,55,0.2);
        }

        .person-deco { position: absolute; color: rgba(212,175,55,0.3); font-size: 0.75rem; }
        .person-deco.top    { top: 2px;    left: 50%; transform: translateX(-50%); }
        .person-deco.bottom { bottom: 2px; left: 50%; transform: translateX(-50%); }
        .person-deco.left   { left: 2px;   top: 50%;  transform: translateY(-50%); }
        .person-deco.right  { right: 2px;  top: 50%;  transform: translateY(-50%); }

        .person-name {
            font-size: 2.2rem;
            color: var(--accent-gold);
            letter-spacing: 8px;
            margin: 20px 0 6px;
            text-shadow: 0 0 25px rgba(212,175,55,0.18);
            text-transform: uppercase;
        }
        .person-role {
            font-size: 0.65rem;
            color: rgba(212,175,55,0.35);
            letter-spacing: 2px;
            margin-bottom: 6px;
        }
        .person-badge {
            display: inline-block;
            font-size: 0.52rem;
            letter-spacing: 3px;
            border: 1px solid rgba(212,175,55,0.2);
            color: rgba(212,175,55,0.4);
            padding: 3px 12px;
            margin-bottom: 8px;
        }

        .person-desc {
            max-width: 560px;
            margin: 14px auto 0;
            font-size: 0.75rem;
            color: rgba(192,192,192,0.55);
            line-height: 1.7;
            text-align: center;
            border-top: 1px solid rgba(212,175,55,0.06);
            padding-top: 14px;
        }

        .timeline-section { margin-top: 40px; }
        .timeline-section-title {
            font-size: 0.65rem;
            letter-spacing: 5px;
            color: rgba(212,175,55,0.3);
            text-align: center;
            margin-bottom: 24px;
            padding-bottom: 8px;
            border-bottom: 1px solid rgba(212,175,55,0.07);
        }

        .timeline-track {
            position: relative;
            max-width: 760px;
            margin: 0 auto;
        }
        .timeline-track::after {
            content: '';
            position: absolute;
            left: 50%;
            top: 0; bottom: 0;
            width: 2px;
            background: linear-gradient(to bottom, transparent, rgba(212,175,55,0.15) 8%, rgba(212,175,55,0.15) 92%, transparent);
            transform: translateX(-50%);
        }
        .time-node {
            position: relative;
            width: 44%;
            margin-bottom: 22px;
            padding: 0 14px;
        }
        .time-node.left  { margin-left: 0;   text-align: right; }
        .time-node.right { margin-left: 56%; text-align: left; }
        .time-node::before {
            content: '◆';
            position: absolute;
            top: 12px;
            font-size: 0.5rem;
            color: rgba(212,175,55,0.35);
        }
        .time-node.left::before  { right: -18px; }
        .time-node.right::before { left: -18px; }
        .time-content {
            background: rgba(0,0,0,0.55);
            border: 1px solid rgba(212,175,55,0.09);
            padding: 10px 14px;
        }
        .time-content.omega {
            border-color: rgba(255,69,0,0.35);
            box-shadow: inset 0 0 20px rgba(255,69,0,0.06), 0 0 15px rgba(255,69,0,0.07);
        }
        .tc-year {
            color: var(--accent-gold);
            font-size: 0.85rem;
            letter-spacing: 2px;
            margin-bottom: 4px;
        }
        .tc-year.omega-year { color: var(--accent-orange); }
        .tc-text { font-size: 0.7rem; color: rgba(192,192,192,0.58); line-height: 1.55; }
        .tc-tag { font-size: 0.48rem; letter-spacing: 2px; color: rgba(212,175,55,0.22); margin-top: 5px; }

        @media (max-width: 600px) {
            .time-node { width: 100%; margin-left: 0 !important; text-align: left !important; padding-left: 26px; }
            .timeline-track::after { left: 8px; }
            .time-node.left::before, .time-node.right::before { left: 3px; right: auto; }
        }

        /* NUKLEAR-TEST STYLES */
        #newsticker {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 99999 !important;
            background: #ff00ff !important;
            border: 5px solid #00ffff !important;
            display: flex !important;
            align-items: center;
            height: 60px !important;
            overflow: hidden;
            box-shadow: 0 0 50px #ff00ff;
        }
        .ticker-label {
            background: #000 !important;
            color: #fff !important;
            font-size: 1rem !important;
            padding: 0 20px;
        }
        .ticker-item {
            color: #000 !important;
            font-size: 1.2rem !important;
            font-weight: bold !important;
            padding: 0 40px;
        }
    </style>
    <script>console.log(">> NUKLEAR-TICKER INITIALIZED IN VATER.PHP");</script>
</head>
<body>
<div class="person-container">

    <a href="/" class="person-back">← ZURÜCK ZUR BASIS</a>

    <div style="text-align:center;">
        <span class="person-class-banner">AKTE // HYDRAULIK-MEISTER // KLASSIFIZIERT</span>
    </div>

    <div class="person-portrait-section">
        <div class="person-mirror-frame">
            <div class="person-portrait-inner">
                <span class="person-deco top">⚙</span>
                <span class="person-deco bottom">⚙</span>
                <span class="person-deco left">⚙</span>
                <span class="person-deco right">⚙</span>
                <div class="person-portrait-placeholder">
                    <span class="portrait-initial">V</span>
                    <span class="portrait-hint">PLATZHALTER</span>
                </div>
            </div>
        </div>
        <h1 class="person-name">VATER</h1>
        <p class="person-role">// Hydraulik-Meister &amp; System-Engineer</p>
        <span class="person-badge">STATUS: KLASSIFIZIERT</span>

        <p class="person-desc">
            Der Ingenieur des Clans. Spezialisiert auf mechanische Systeme und hydraulische Upgrades.
            Verantwortlich für die Grundarchitektur des Netzwerks. Weitere Details: GESCHWÄRZT.
        </p>
    </div>

    <div class="timeline-section">
        <p class="timeline-section-title">// CHRONOLOGISCHES ARCHIV — VATER</p>
        <div class="timeline-track" id="timeline-track"></div>
    </div>

    <!-- NEWSTICKER FOOTER -->
    <div id="newsticker">
        <span class="ticker-label">// AKTE_VATER_LIVE</span>
        <div class="ticker-track-wrap">
            <div class="ticker-track" id="ticker-track-vater">
                <!-- Wird per JS befüllt -->
            </div>
        </div>
    </div>

</div>
<script>
(function() {
    const track = document.getElementById('timeline-track');
    const events = [
        { year: 1950, text: 'SYSTEM INITIALISIERT. Hydraulik-Meister V1.0 startet erstmals. Diagnostik: Stabil. Herkunft: Klassifiziert.', tag: 'BOOT // KLASSIFIZIERT', omega: false },
        { year: 1960, text: 'ERSTE MECHANISCHE UPGRADES abgeschlossen. Handwerkliche Fähigkeiten auf OMEGA-LEVEL kalibriert. Präzision: 99.3%', tag: 'HARDWARE-UPDATE', omega: false },
        { year: 1970, text: 'NETZWERK-VERBINDUNG mit Matriarchin-Modul hergestellt. Langzeit-Protokoll initialisiert. Stabilität: Bestätigt.', tag: 'NETZWERK-INITIALISIERUNG', omega: false },
        { year: 1974, text: '⚡ KRITISCH: SYSTEM-AUSGABE REGISTRIERT. Der zukünftige Overlord (Sascha) wird erfolgreich kompiliert und in die Biosphäre integriert.', tag: 'OMEGA-KLASSE // KRITISCHES EREIGNIS', omega: true },
        { year: 1981, text: 'ZWEITE SYSTEM-AUSGABE: Bruder-Knoten V1.0 geht online. Netzwerkkapazität erweitert. Chaos-Index leicht erhöht.', tag: 'NETZWERK-ERWEITERUNG', omega: false },
        { year: 1983, text: 'DRITTE SYSTEM-AUSGABE: AETHER-SIBLING (Schwester) bootet erfolgreich. Clan-Netzwerk vollständig operational.', tag: 'NETZWERK-ERWEITERUNG', omega: false },
        { year: 1995, text: 'HYDRAULIK-UPGRADE v3.0 installiert. Langzeitstabilität über 40 Jahre bestätigt. Wartungsintervalle: Unregelmäßig.', tag: 'WARTUNG // LANGZEIT', omega: false },
        { year: 2000, text: 'MILLENNIUM-PROTOKOLL aktiviert. System läuft ohne kritische Fehler. Diagnose: Solide wie immer. Details: GESCHWÄRZT.', tag: 'SYSTEMCHECK', omega: false },
        { year: 2025, text: 'STATUS: NOCH ONLINE. Alle Primärsysteme funktionsfähig. Erfahrungswert: MAXIMAL. Weitere Daten: NICHT AUTORISIERT.', tag: 'AKTUELL // KLASSIFIZIERT', omega: false },
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
        const track = document.getElementById('ticker-track-vater');
        const tickerItems = [
            "DESIGNATION: HYDRAULIK-MEISTER V1.0",
            "STATUS: NOCH ONLINE",
            "ERFAHRUNG: MAXIMAL",
            "SICHERHEITSSTUFE: KLASSIFIZIERT",
            "SPEZIALISIERUNG: PRÄZISIONS-MECHANIK",
            "STABILITÄT: WIE STAHL",
            "NETZWERK: CLAN-FUNDAMENT",
            "AKTIVITÄT: DAUERHAFT ÜBERWACHT"
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
