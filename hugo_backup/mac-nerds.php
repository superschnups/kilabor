<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MAC NERDS | DIGITALE ANARCHIE</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --accent-orange: #ff4500;
            --accent-gold: #d4af37;
            --bg: #050500;
            --text: #c0c0c0;
        }
        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Courier New', monospace;
            min-height: 100vh;
        }
        a { color: inherit; }

        .mn-container { max-width: 960px; margin: 0 auto; padding: 30px 16px 60px; }

        .mn-back {
            display: inline-block;
            font-size: 0.65rem;
            letter-spacing: 3px;
            color: rgba(255,69,0,0.45);
            text-decoration: none;
            margin-bottom: 20px;
            transition: color 0.2s;
        }
        .mn-back:hover { color: rgba(255,69,0,0.85); }

        .mn-title {
            font-size: 2.2rem;
            letter-spacing: 8px;
            color: var(--accent-orange);
            margin-bottom: 8px;
            text-shadow: 0 0 30px rgba(255,69,0,0.3);
            text-transform: uppercase;
        }
        .mn-subtitle {
            font-size: 0.7rem;
            letter-spacing: 2px;
            color: rgba(150,130,80,0.5);
            margin-bottom: 14px;
        }
        .mn-warning {
            display: inline-block;
            font-size: 0.6rem;
            letter-spacing: 2px;
            border: 1px dashed rgba(255,180,0,0.3);
            color: rgba(255,180,0,0.5);
            padding: 4px 12px;
            margin-bottom: 30px;
        }

        .mn-filter-bar {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            margin-bottom: 24px;
            border-bottom: 1px solid rgba(255,69,0,0.1);
            padding-bottom: 16px;
        }
        .mn-filter {
            background: transparent;
            border: 1px solid rgba(255,69,0,0.2);
            color: rgba(255,100,0,0.4);
            font-family: 'Courier New', monospace;
            font-size: 0.6rem;
            letter-spacing: 2px;
            padding: 4px 12px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .mn-filter:hover, .mn-filter.active {
            border-color: rgba(255,69,0,0.6);
            color: rgba(255,100,0,0.85);
            background: rgba(255,69,0,0.05);
        }

        .mn-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 12px;
        }
        .mn-card {
            background: rgba(8,5,0,0.98);
            border: 1px solid rgba(255,69,0,0.12);
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .mn-card:hover {
            border-color: rgba(255,69,0,0.3);
            box-shadow: 0 0 16px rgba(255,69,0,0.06);
        }
        .mn-card-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .mn-cat-tag {
            font-size: 0.5rem;
            letter-spacing: 3px;
            color: rgba(212,175,55,0.4);
            border: 1px solid rgba(212,175,55,0.15);
            padding: 1px 6px;
        }
        .mn-risk {
            font-size: 0.5rem;
            letter-spacing: 2px;
            padding: 1px 6px;
            border: 1px solid;
        }
        .mn-risk-safe    { border-color: rgba(0,200,80,0.25);  color: rgba(0,200,80,0.5); }
        .mn-risk-caution {
            border-color: rgba(255,180,0,0.3);
            color: rgba(255,180,0,0.6);
            animation: blink 2s step-end infinite;
        }
        @keyframes blink { 50% { opacity: 0.3; } }

        .mn-card-title {
            font-size: 0.9rem;
            letter-spacing: 1px;
            color: rgba(220,200,150,0.85);
            font-weight: normal;
        }
        .mn-card-desc {
            font-size: 0.72rem;
            line-height: 1.55;
            color: rgba(160,150,120,0.6);
            flex: 1;
        }
        .mn-cmd-block {
            display: flex;
            align-items: stretch;
            border: 1px solid rgba(0,255,65,0.15);
            background: rgba(0,0,0,0.55);
            margin-top: 4px;
        }
        .mn-cmd-code {
            flex: 1;
            font-family: 'Courier New', monospace;
            font-size: 0.68rem;
            color: rgba(0,255,65,0.75);
            padding: 8px 10px;
            word-break: break-all;
            line-height: 1.5;
        }
        .mn-copy-btn {
            flex-shrink: 0;
            background: transparent;
            border: none;
            border-left: 1px solid rgba(0,255,65,0.15);
            color: rgba(0,255,65,0.35);
            font-family: 'Courier New', monospace;
            font-size: 0.55rem;
            letter-spacing: 2px;
            padding: 0 10px;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .mn-copy-btn:hover  { background: rgba(0,255,65,0.05); color: rgba(0,255,65,0.85); }
        .mn-copy-btn.copied { color: rgba(0,255,65,1); background: rgba(0,255,65,0.08); }
    </style>
</head>
<body>
<div class="mn-container">

    <a href="/" class="mn-back">← ZURÜCK ZUR BASIS</a>
    <h1 class="mn-title">MAC NERDS</h1>
    <p class="mn-subtitle">// Terminal-Wissen für möchtegern-Admins — zu gut für Anfänger, zu faul für echte Admins</p>
    <div class="mn-warning">⚠ ALLE BEFEHLE GETESTET. TROTZDEM: BRAIN BEFORE RETURN.</div>

    <div class="mn-filter-bar">
        <button class="mn-filter active" data-cat="all">ALLE</button>
        <button class="mn-filter" data-cat="system">SYSTEM</button>
        <button class="mn-filter" data-cat="netzwerk">NETZWERK</button>
        <button class="mn-filter" data-cat="dateien">DATEIEN</button>
        <button class="mn-filter" data-cat="performance">PERFORMANCE</button>
        <button class="mn-filter" data-cat="tweaks">TWEAKS</button>
    </div>

    <div class="mn-grid" id="mn-grid">

    <?php
    $cmds = [
        // SYSTEM
        ['cat'=>'system','title'=>'Hardware-Kurzprofil',
         'cmd'=>'system_profiler SPHardwareDataType | grep -E "Model|Chip|Memory|Serial"',
         'desc'=>'Model, Chip, RAM und Seriennummer auf einen Blick — ohne Klicken durch Systeminfo.',
         'risk'=>'safe'],
        ['cat'=>'system','title'=>'macOS Version',
         'cmd'=>'sw_vers',
         'desc'=>'ProductName, Version und Build. Schneller als jedes UI-Menü.',
         'risk'=>'safe'],
        ['cat'=>'system','title'=>'CPU exakter Bezeichner',
         'cmd'=>'sysctl -n machdep.cpu.brand_string',
         'desc'=>'Zeigt den genauen CPU-String wenn jemand fragt und du nicht suchen willst.',
         'risk'=>'safe'],
        ['cat'=>'system','title'=>'Alle lokalen User',
         'cmd'=>"sudo dscl . list /Users | grep -v '^_'",
         'desc'=>'Listet alle echten User-Accounts ohne System-Underscore-Accounts.',
         'risk'=>'safe'],
        ['cat'=>'system','title'=>'Computernamen abfragen',
         'cmd'=>'scutil --get ComputerName && scutil --get LocalHostName',
         'desc'=>'Computername und lokaler Hostname. Hilfreich vor Netzwerkkonfigurationen.',
         'risk'=>'safe'],
        ['cat'=>'system','title'=>'Drittanbieter LaunchAgents',
         'cmd'=>'launchctl list | grep -v "^-" | grep -v "com.apple" | sort',
         'desc'=>'Nur die LaunchAgents die nicht von Apple kommen — zeigt was wirklich im Hintergrund läuft.',
         'risk'=>'safe'],
        ['cat'=>'system','title'=>'System-Errors letzte Stunde',
         'cmd'=>"log show --predicate 'eventMessage contains \"error\"' --last 1h --style syslog | tail -40",
         'desc'=>'Die letzten 40 Fehler aus dem Systemlog. Echtes Debugging ohne Console.app.',
         'risk'=>'safe'],

        // NETZWERK
        ['cat'=>'netzwerk','title'=>'Netzwerkqualität testen',
         'cmd'=>'networkQuality',
         'desc'=>'Apples eigenes Speedtest-Tool seit macOS 12. Misst Upload, Download und Responsiveness (RPM).',
         'risk'=>'safe'],
        ['cat'=>'netzwerk','title'=>'Alle offenen Ports',
         'cmd'=>'lsof -i -n -P | grep LISTEN',
         'desc'=>'Welcher Prozess hört auf welchem Port? Unverzichtbar wenn ein Port "schon belegt" ist.',
         'risk'=>'safe'],
        ['cat'=>'netzwerk','title'=>'Eigene IP + Geo',
         'cmd'=>'curl -s https://ipinfo.io/json | python3 -m json.tool',
         'desc'=>'Öffentliche IP, Stadt, Land und Provider — direkt formatiert im Terminal.',
         'risk'=>'safe'],
        ['cat'=>'netzwerk','title'=>'Lokale Geräte im Netz',
         'cmd'=>'arp -a | sort',
         'desc'=>'ARP-Tabelle: alle Geräte die dein Mac gerade kennt. IP + MAC-Adresse.',
         'risk'=>'safe'],
        ['cat'=>'netzwerk','title'=>'Alle MAC-Adressen',
         'cmd'=>"networksetup -listallhardwareports | awk '/Hardware Port/{port=\$NF} /Ethernet Address/{print port\": \"\$NF}'",
         'desc'=>'Alle Netzwerkinterfaces mit MAC-Adresse. Praktisch für Router-Whitelists.',
         'risk'=>'safe'],
        ['cat'=>'netzwerk','title'=>'Bonjour-Dienste im Netz',
         'cmd'=>'dns-sd -B _services._dns-sd._udp local.',
         'desc'=>'Zeigt alle Bonjour/mDNS-Dienste im lokalen Netz live. Beenden mit Ctrl+C.',
         'risk'=>'safe'],

        // DATEIEN
        ['cat'=>'dateien','title'=>'DS_Store aufräumen',
         'cmd'=>"find ~ -name '*.DS_Store' -delete 2>/dev/null && echo 'Aufgeräumt.'",
         'desc'=>'Löscht alle .DS_Store-Dateien im Home-Verzeichnis. Gut vor git-Commits oder USB-Weitergabe.',
         'risk'=>'safe'],
        ['cat'=>'dateien','title'=>'Größte Verzeichnisse',
         'cmd'=>'du -sh ~/* | sort -rh | head -15',
         'desc'=>'Top 15 Verzeichnisse nach Größe, sortiert. Schnell herausfinden wo der Speicher bleibt.',
         'risk'=>'safe'],
        ['cat'=>'dateien','title'=>'Spotlight via Terminal',
         'cmd'=>'mdfind -name "SUCHBEGRIFF"',
         'desc'=>'Spotlight-Suche im Terminal. Schneller als Finder und skriptbar. SUCHBEGRIFF ersetzen.',
         'risk'=>'safe'],
        ['cat'=>'dateien','title'=>'Große Cache-Dateien finden',
         'cmd'=>"find /tmp ~/Library/Caches -maxdepth 2 -type f -size +50M 2>/dev/null | sort",
         'desc'=>'Findet Dateien über 50MB in Temp- und Cache-Verzeichnissen. Vor dem Löschen prüfen.',
         'risk'=>'safe'],
        ['cat'=>'dateien','title'=>'Bild skalieren (sips)',
         'cmd'=>'sips -z 800 600 ~/Desktop/bild.jpg',
         'desc'=>'Skaliert ein Bild auf 800×600 ohne Extra-Tool. sips ist macOS-nativ. Pfad anpassen.',
         'risk'=>'safe'],
        ['cat'=>'dateien','title'=>'App Support nach Größe',
         'cmd'=>"ls -lAh ~/Library/Application\\ Support | sort -k5 -rh | head -20",
         'desc'=>'Größte App-Support-Ordner — nützlich nach dem Deinstallieren von Apps.',
         'risk'=>'safe'],

        // PERFORMANCE
        ['cat'=>'performance','title'=>'Top 15 CPU-Fresser',
         'cmd'=>'top -o cpu -n 15 -l 1 | tail -16',
         'desc'=>'Einmaliger Snapshot der 15 CPU-intensivsten Prozesse ohne interaktiven top-Modus.',
         'risk'=>'safe'],
        ['cat'=>'performance','title'=>'RAM-Nutzung detailliert',
         'cmd'=>"vm_stat | perl -ne '/page size of (\\d+)/ and \$s=\$1; /Pages\\s+([^:]+)[^\\d]+(\\d+)/ and printf \"%-25s %7.2f MB\\n\",\$1,\$2*\$s/1048576'",
         'desc'=>'Schlüsselt den RAM auf: wired, active, inactive, free, speculative — in MB.',
         'risk'=>'safe'],
        ['cat'=>'performance','title'=>'CPU/GPU Power (Apple Silicon)',
         'cmd'=>'sudo powermetrics --samplers cpu_power,gpu_power -n 1 -i 1000 2>/dev/null | grep -E "Combined|CPU|GPU|Package"',
         'desc'=>'Aktueller Stromverbrauch von CPU und GPU in Watt. Nur auf Apple Silicon. Braucht sudo.',
         'risk'=>'safe'],
        ['cat'=>'performance','title'=>'Batteriestatus',
         'cmd'=>'pmset -g batt',
         'desc'=>'Ladestand, Ladezustand, Zustand der Batterie und ob du am Netzteil hängst.',
         'risk'=>'safe'],
        ['cat'=>'performance','title'=>'Batterie-Ladezyklen',
         'cmd'=>'ioreg -l | grep -i "CycleCount\|MaxCapacity\|CurrentCapacity" | head -6',
         'desc'=>'Ladezyklen, maximale und aktuelle Kapazität. Zeigt ob die Batterie noch fit ist.',
         'risk'=>'safe'],

        // TWEAKS
        ['cat'=>'tweaks','title'=>'Dock: sofortiges Einblenden',
         'cmd'=>'defaults write com.apple.dock autohide-delay -float 0 && defaults write com.apple.dock autohide-time-modifier -float 0.3 && killall Dock',
         'desc'=>'Entfernt die Verzögerung beim Dock-Einblenden und verkürzt die Animation. Sofort aktiv.',
         'risk'=>'safe'],
        ['cat'=>'tweaks','title'=>'Key-Repeat aktivieren',
         'cmd'=>'defaults write NSGlobalDomain ApplePressAndHoldEnabled -bool false',
         'desc'=>'Deaktiviert Akzent-Popup bei gedrückter Taste und aktiviert Key-Repeat. Logout nötig.',
         'risk'=>'safe'],
        ['cat'=>'tweaks','title'=>'Screenshot-Einstellungen',
         'cmd'=>'defaults write com.apple.screencapture location ~/Desktop && defaults write com.apple.screencapture type png && killall SystemUIServer',
         'desc'=>'Screenshot-Pfad auf Desktop, Format auf PNG. killall SystemUIServer übernimmt sofort.',
         'risk'=>'safe'],
        ['cat'=>'tweaks','title'=>'Mac 2h wachhalten',
         'cmd'=>'caffeinate -d -t 7200',
         'desc'=>'Verhindert Sleep und Screensaver für 2 Stunden. Ctrl+C zum Beenden.',
         'risk'=>'safe'],
        ['cat'=>'tweaks','title'=>'Versteckte Dateien im Finder',
         'cmd'=>"defaults write com.apple.finder AppleShowAllFiles -bool true && killall Finder",
         'desc'=>'Zeigt alle Dotfiles im Finder. Rückgängig: selber Befehl mit -bool false.',
         'risk'=>'safe'],
        ['cat'=>'tweaks','title'=>'Auto-Update-Check deaktivieren',
         'cmd'=>'defaults write com.apple.SoftwareUpdate AutomaticCheckEnabled -bool false',
         'desc'=>'Stoppt den automatischen Update-Check im Hintergrund. Updates manuell über Systemeinstellungen.',
         'risk'=>'caution'],
    ];

    foreach ($cmds as $c):
        $cmdEsc = htmlspecialchars($c['cmd'], ENT_QUOTES);
    ?>
        <div class="mn-card" data-cat="<?= $c['cat'] ?>">
            <div class="mn-card-meta">
                <span class="mn-cat-tag"><?= strtoupper($c['cat']) ?></span>
                <span class="mn-risk mn-risk-<?= $c['risk'] ?>"><?= $c['risk'] === 'caution' ? 'CAUTION' : 'SAFE' ?></span>
            </div>
            <div class="mn-card-title"><?= htmlspecialchars($c['title']) ?></div>
            <div class="mn-card-desc"><?= htmlspecialchars($c['desc']) ?></div>
            <div class="mn-cmd-block">
                <code class="mn-cmd-code"><?= $cmdEsc ?></code>
                <button class="mn-copy-btn" data-cmd="<?= $cmdEsc ?>">COPY</button>
            </div>
        </div>
    <?php endforeach; ?>

    </div>
</div>

<script>
    document.querySelectorAll('.mn-filter').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.mn-filter').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const cat = btn.dataset.cat;
            document.querySelectorAll('.mn-card').forEach(card => {
                card.style.display = (cat === 'all' || card.dataset.cat === cat) ? '' : 'none';
            });
        });
    });

    document.querySelectorAll('.mn-copy-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            navigator.clipboard.writeText(btn.dataset.cmd).then(() => {
                btn.textContent = 'COPIED';
                btn.classList.add('copied');
                setTimeout(() => { btn.textContent = 'COPY'; btn.classList.remove('copied'); }, 1500);
            });
        });
    });
</script>
<?php wp_footer(); ?>
</body>
</html>
