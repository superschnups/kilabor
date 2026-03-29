<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OVERLORDS | DIGITALE ANARCHIE</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg-color: #0d0d0d;
            --text-color: #c0c0c0;
            --accent-gold: #d4af37;
            --accent-orange: #ff4500;
        }
        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            font-family: 'Courier New', Courier, monospace;
            line-height: 1.6;
            overflow-x: hidden;
        }
        a { color: inherit; }

        .ol-container { max-width: 1200px; margin: 0 auto; padding: 30px 16px 60px; }
        .ol-header { margin-bottom: 30px; }
        .ol-back {
            display: inline-block;
            color: rgba(0,255,65,0.6);
            font-size: 0.75rem;
            letter-spacing: 1px;
            text-decoration: none;
            margin-bottom: 10px;
            transition: color 0.2s;
        }
        .ol-back:hover { color: rgba(255,69,0,0.8); }
        .ol-title {
            font-size: 2.5rem;
            color: var(--accent-gold);
            margin: 0 0 10px 0;
            font-weight: bold;
            letter-spacing: 2px;
        }
        .ol-subtitle {
            font-size: 0.9rem;
            color: rgba(0,255,65,0.5);
            margin: 0 0 15px 0;
            letter-spacing: 1px;
        }
        .ol-warning {
            background: rgba(255,69,0,0.08);
            border: 1px solid rgba(255,69,0,0.2);
            color: rgba(255,69,0,0.7);
            padding: 8px 12px;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            margin-bottom: 20px;
        }

        .ol-timeline-section { margin-bottom: 40px; }
        .ol-timeline-title {
            font-size: 1.5rem;
            color: var(--accent-gold);
            margin-bottom: 20px;
            text-align: center;
            letter-spacing: 1px;
        }
        .timeline-container {
            position: relative;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px 0;
            max-height: 500px;
            overflow-y: auto;
            border: 1px solid rgba(0,255,65,0.1);
        }
        .timeline-track {
            position: relative;
            width: 100%;
            min-height: 400px;
        }
        .time-node {
            position: absolute;
            width: 45%;
            padding: 10px;
        }
        .time-node.left  { left: 0;   text-align: right; }
        .time-node.right { right: 0;  text-align: left; }
        .time-content {
            background: rgba(0,0,0,0.8);
            border: 1px solid rgba(0,255,65,0.2);
            padding: 15px;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0,255,65,0.1);
        }
        .tc-header {
            font-size: 0.6rem;
            color: rgba(0,255,65,0.4);
            margin-bottom: 8px;
            letter-spacing: 1px;
        }
        .tc-stamp { color: rgba(255,180,0,0.6); font-weight: bold; }
        .tc-stamp.omega { color: rgba(255,69,0,0.8); }
        .time-content h3 { color: var(--accent-gold); margin: 0 0 10px 0; font-size: 1.1rem; }
        .time-content p  { color: rgba(0,255,65,0.7); font-size: 0.8rem; line-height: 1.4; margin: 0 0 10px 0; }
        .tc-footer { font-size: 0.55rem; color: rgba(0,255,65,0.3); letter-spacing: 0.5px; }

        .time-content.omega-node {
            border-color: #ff4500;
            outline: 2px solid #330000;
            box-shadow: inset 0 0 30px rgba(255,69,0,0.5), 0 0 30px rgba(255,0,0,0.8);
            background: linear-gradient(135deg, rgba(80,20,10,0.95), rgba(30,0,0,0.95));
            animation: omega-pulse 2s infinite alternate, omega-shake 0.5s infinite;
        }
        .time-content.omega-node::after {
            content: ''; position: absolute; top: -8px; left: -8px; right: -8px; bottom: -8px;
            border: 2px solid #0ff;
            border-radius: 6px;
            box-shadow: 0 0 15px #0ff, inset 0 0 10px #0ff;
            animation: electric-arc 0.15s infinite;
            pointer-events: none;
            opacity: 0.9;
            z-index: 2;
        }
        @keyframes omega-pulse {
            0%   { box-shadow: inset 0 0 30px rgba(255,69,0,0.4), 0 0 20px rgba(255,0,0,0.6); }
            100% { box-shadow: inset 0 0 60px rgba(255,69,0,0.9), 0 0 40px rgba(255,0,0,1); }
        }
        @keyframes omega-shake {
            0%, 100% { transform: translate(0,0) rotate(0deg); }
            25%  { transform: translate(0.5px, 0.5px) rotate(0.2deg); }
            50%  { transform: translate(-0.5px,-0.5px) rotate(-0.2deg); }
            75%  { transform: translate(0.5px,-0.5px) rotate(0.2deg); }
        }
        @keyframes electric-arc {
            0%   { clip-path: polygon(0 0, 100% 0, 100% 5%, 0 5%); border-color: #0ff; }
            25%  { clip-path: polygon(95% 0, 100% 0, 100% 100%, 95% 100%); border-color: #fff; }
            50%  { clip-path: polygon(0 95%, 100% 95%, 100% 100%, 0 100%); border-color: #0ff; }
            75%  { clip-path: polygon(0 0, 5% 0, 5% 100%, 0 100%); border-color: #fff; }
            100% { clip-path: polygon(0 0, 100% 0, 100% 5%, 0 5%); border-color: #0ff; }
        }

        .ol-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        .ol-card {
            background: rgba(0,0,0,0.6);
            border: 1px solid rgba(0,255,65,0.15);
            border-radius: 4px;
            overflow: hidden;
            transition: all 0.3s;
        }
        .ol-card:hover {
            border-color: rgba(0,255,65,0.4);
            box-shadow: 0 0 20px rgba(0,255,65,0.1);
            transform: translateY(-2px);
        }
        .ol-card-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }
        .ol-card-body { padding: 15px; }
        .ol-card-status {
            display: inline-block;
            font-size: 0.6rem;
            letter-spacing: 1px;
            padding: 2px 6px;
            border: 1px solid;
            margin-bottom: 8px;
        }
        .ol-card-status.aktiv       { border-color: rgba(0,255,65,0.3);    color: rgba(0,255,65,0.7); }
        .ol-card-status.omega-klasse { border-color: rgba(255,69,0,0.3);   color: rgba(255,69,0,0.7); }
        .ol-card-status.klassifiziert{ border-color: rgba(255,180,0,0.3);  color: rgba(255,180,0,0.7); }
        .ol-card-status.unbekannt   { border-color: rgba(128,128,128,0.3); color: rgba(128,128,128,0.7); }
        .ol-card-name {
            font-size: 1.2rem;
            color: var(--accent-gold);
            margin: 0 0 5px 0;
            font-weight: bold;
        }
        .ol-card-role {
            font-size: 0.8rem;
            color: rgba(0,255,65,0.5);
            margin: 0 0 10px 0;
            letter-spacing: 0.5px;
        }
        .ol-card-desc {
            font-size: 0.85rem;
            color: rgba(0,255,65,0.7);
            line-height: 1.4;
            margin: 0;
        }
    </style>
</head>
<body>

<div class="ol-container">

    <header class="ol-header">
        <a href="/" class="ol-back">← ZURÜCK ZUR BASIS</a>
        <h1 class="ol-title">OVERLORDS</h1>
        <p class="ol-subtitle">// Die Familie — Architekten der digitalen Anarchie</p>
        <div class="ol-warning">⚠ KLASSIFIZIERT: FAMILIÄR. ZUGRIFF: NUR FÜR DIE, DIE ES WISSEN MÜSSEN.</div>
    </header>

    <div class="ol-timeline-section">
        <h2 class="ol-timeline-title">FAMILIEN-TIMELINE</h2>
        <div class="timeline-container">
            <div class="timeline-track" id="timeline-track"></div>
        </div>
    </div>

    <div class="ol-grid" id="ol-grid">

        <?php
        $base = '';
        $overlords = [
            [
                'name'  => 'Mutter',
                'role'  => 'Matriarchin & Kupfer-Architektin',
                'desc'  => 'Die Gründerin des Clans. Kupfer-Matriarchin, die 1974 den ersten System-Schrei registrierte. Architektin der Biosphäre und Hüterin der pneumatischen Reflexe.',
                'img'   => 'assets/img/hp_meli_steampunk_01.jpeg',
                'status'=> 'OMEGA-KLASSE',
            ],
            [
                'name'  => 'Vater',
                'role'  => 'Hydraulik-Meister & System-Engineer',
                'desc'  => 'Der Ingenieur des Clans. Spezialisiert auf mechanische Gliedmaßen und hydraulische Upgrades. Verantwortlich für die Flucht in die äußeren Kolonien.',
                'img'   => 'assets/img/hp_vater_steampunk_01.jpg',
                'status'=> 'KLASSIFIZIERT',
            ],
            [
                'name'  => 'Sascha (Ich)',
                'role'  => 'Overlord & KI-Architekt',
                'desc'  => 'Der aktuelle Overlord. KI-Labor Betreiber, Gemini-Link Aktivator und Anarchie-Engine Entwickler. Status: Online seit 1983.',
                'img'   => 'hero.png',
                'status'=> 'AKTIV',
            ],
            [
                'name'  => 'Bruder',
                'role'  => 'Kybernetischer Knoten & Neural-Link',
                'desc'  => 'Der Bruder-Knoten. 1981 online gegangen. Visuelle Sensoren-Update steht noch aus. Chaos-Protokolle initialisiert.',
                'img'   => 'assets/img/hp_muti_steampunk_01.png',
                'status'=> 'KLASSIFIZIERT',
            ],
            [
                'name'  => 'Schwester',
                'role'  => 'Aether-Sibling & Pneumatische Reflexe',
                'desc'  => 'AETHER-SIBLING V1.0. Schwester Meli. Boot erfolgreich 1983. Chaos-Protokolle und pneumatische Reflexe voll aktiv.',
                'img'   => 'assets/img/hp_muti_steampunk_02.jpg',
                'status'=> 'KLASSIFIZIERT',
            ],
            [
                'name'  => 'Sven',
                'role'  => 'Externe Variable & Unbekannter Faktor',
                'desc'  => 'Der mysteriöse Sven. Externe Einflussgröße im System. Herkunft: Fraglich. Klassifiziert: Unbekannt. Integrität: Akzeptabel.',
                'img'   => 'assets/img/family_alle_pic_01.png',
                'status'=> 'UNBEKANNT',
            ],
        ];

        foreach ($overlords as $ol) {
            echo '<div class="ol-card" data-status="' . $ol['status'] . '">';
            echo '<img src="' . $ol['img'] . '" class="ol-card-img" alt="' . $ol['name'] . '" loading="lazy" width="400" height="200">';
            echo '<div class="ol-card-body">';
            echo '<span class="ol-card-status ' . strtolower(str_replace(' ', '-', $ol['status'])) . '">' . $ol['status'] . '</span>';
            echo '<h3 class="ol-card-name">' . $ol['name'] . '</h3>';
            echo '<p class="ol-card-role">' . $ol['role'] . '</p>';
            echo '<p class="ol-card-desc">' . $ol['desc'] . '</p>';
            echo '</div>';
            echo '</div>';
        }
        ?>

    </div>

</div>

<script>
(function() {
    const timelineTrack = document.getElementById('timeline-track');
    if (!timelineTrack) return;

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
        for (let y = 1955; y <= new Date().getFullYear(); y += 5) {
            yearsToRender.push(y);
        }
        [1974, 1981, 1983].forEach(sy => {
            if (!yearsToRender.includes(sy)) yearsToRender.push(sy);
        });
        yearsToRender.sort((a, b) => a - b);

        let topOffset = 0;
        let isLeft = true;

        yearsToRender.forEach(year => {
            const node = document.createElement('div');
            node.className = 'time-node ' + (isLeft ? 'left' : 'right');
            node.style.top = topOffset + 'px';

            const content = document.createElement('div');
            content.className = 'time-content';

            if (specialEvents[year]) {
                content.classList.add('omega-node');
                content.innerHTML =
                    '<div class="tc-header">OMEGA-KLASSE &nbsp;&#9670;&nbsp; <span class="tc-stamp omega">!! FREIGEGEBEN !!</span></div>' +
                    '<h3>[ ' + year + ' ]</h3>' +
                    '<p><strong>⚡ KRITISCHES SYSTEMEREIGNIS ⚡</strong><br>' + specialEvents[year] + '</p>' +
                    '<div class="tc-footer">QUELLE: ARCHIV-SEKTOR 7 &nbsp;&#9670;&nbsp; ZUGRIFF: OVERLORD ONLY</div>';
                topOffset += 160;
            } else {
                const bgStory = events[Math.floor(Math.random() * events.length)];
                const akteNr = Math.floor(Math.random() * 9000) + 1000;
                content.innerHTML =
                    '<div class="tc-header">AKTE #' + akteNr + ' &nbsp;&#9670;&nbsp; <span class="tc-stamp">KLASSIFIZIERT</span></div>' +
                    '<h3>[ ' + year + ' ]</h3>' +
                    '<p>' + bgStory + ' Weitere Datenquellen als OMEGA-KLASSE klassifiziert.</p>' +
                    '<div class="tc-footer">ZEITSTEMPEL: ' + year + '.01.01 &nbsp;&#9670;&nbsp; INTEGRITAET: FRAGLICH</div>';
                topOffset += 130;
            }

            node.appendChild(content);
            timelineTrack.appendChild(node);

            isLeft = !isLeft;
        });

        timelineTrack.style.minHeight = (topOffset + 50) + 'px';
    }

    generateTimeline();
})();
</script>

</body>
</html>
