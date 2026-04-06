<?php
/**
 * Template Name: Mac Nerds
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MAC NERDS | DIGITALE ANARCHIE</title>
    <?php wp_head(); ?>
</head>
<body <?php body_class('mac-nerds-page'); ?>>

<div class="container mn-container">

    <header class="mn-header">
        <a href="<?php echo home_url(); ?>" class="mn-back">← ZURÜCK ZUR BASIS</a>
        <h1 class="mn-title">MAC NERDS</h1>
        <p class="mn-subtitle">// Terminal-Wissen für möchtegern-Admins — zu gut für Anfänger, zu faul für echte Admins</p>
        <div class="mn-warning">⚠ ALLE BEFEHLE GETESTET. TROTZDEM: BRAIN BEFORE RETURN.</div>
    </header>

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

            // ── SYSTEM ──────────────────────────────────────────
            [
                'cat'  => 'system',
                'cmd'  => 'system_profiler SPHardwareDataType | grep -E "Model|Chip|Memory|Serial"',
                'title'=> 'Hardware-Kurzprofil',
                'desc' => 'Model, Chip, RAM und Seriennummer auf einen Blick. Kein Klicken durch System-Info.',
                'risk' => 'safe',
            ],
            [
                'cat'  => 'system',
                'cmd'  => 'sw_vers',
                'title'=> 'macOS Version',
                'desc' => 'ProductName, Version und Build — schneller als jedes UI-Menü.',
                'risk' => 'safe',
            ],
            [
                'cat'  => 'system',
                'cmd'  => 'sysctl -n machdep.cpu.brand_string',
                'title'=> 'CPU exakter Bezeichner',
                'desc' => 'Zeigt den genauen CPU-String. Nützlich wenn jemand nach deinem Chip fragt und du nicht suchen willst.',
                'risk' => 'safe',
            ],
            [
                'cat'  => 'system',
                'cmd'  => "sudo dscl . list /Users | grep -v '^_'",
                'title'=> 'Alle lokalen User',
                'desc' => 'Listet alle echten User-Accounts — ohne die System-Underscore-Accounts.',
                'risk' => 'safe',
            ],
            [
                'cat'  => 'system',
                'cmd'  => 'scutil --get ComputerName && scutil --get LocalHostName',
                'title'=> 'Computernamen abfragen',
                'desc' => 'Computername und lokaler Hostname. Hilfreich bevor du irgendwas im Netz konfigurierst.',
                'risk' => 'safe',
            ],
            [
                'cat'  => 'system',
                'cmd'  => 'launchctl list | grep -v "^-" | grep -v "com.apple" | sort',
                'title'=> 'Drittanbieter LaunchAgents',
                'desc' => 'Nur die LaunchAgents die nicht von Apple kommen — zeigt was im Hintergrund wirklich läuft.',
                'risk' => 'safe',
            ],
            [
                'cat'  => 'system',
                'cmd'  => 'log show --predicate \'eventMessage contains "error"\' --last 1h --style syslog | tail -40',
                'title'=> 'System-Errors letzte Stunde',
                'desc' => 'Die letzten 40 Fehler aus dem Systemlog der vergangenen Stunde. Echtes Debugging ohne Console.app.',
                'risk' => 'safe',
            ],

            // ── NETZWERK ─────────────────────────────────────────
            [
                'cat'  => 'netzwerk',
                'cmd'  => 'networkQuality',
                'title'=> 'Netzwerkqualität testen',
                'desc' => 'Apples eigenes Speedtest-Tool seit macOS 12. Misst Upload, Download und Responsiveness (RPM).',
                'risk' => 'safe',
            ],
            [
                'cat'  => 'netzwerk',
                'cmd'  => 'lsof -i -n -P | grep LISTEN',
                'title'=> 'Alle offenen Ports',
                'desc' => 'Welcher Prozess hört auf welchem Port? Unverzichtbar wenn ein Port "schon belegt" ist.',
                'risk' => 'safe',
            ],
            [
                'cat'  => 'netzwerk',
                'cmd'  => 'curl -s https://ipinfo.io/json | python3 -m json.tool',
                'title'=> 'Eigene IP + Geo',
                'desc' => 'Zeigt deine öffentliche IP, Stadt, Land und Provider — direkt formatiert im Terminal.',
                'risk' => 'safe',
            ],
            [
                'cat'  => 'netzwerk',
                'cmd'  => 'arp -a | sort',
                'title'=> 'Lokale Geräte im Netz',
                'desc' => 'ARP-Tabelle: alle Geräte die dein Mac gerade "kennt". IP + MAC-Adresse.',
                'risk' => 'safe',
            ],
            [
                'cat'  => 'netzwerk',
                'cmd'  => 'nettop -m tcp -n -l 1 2>/dev/null | head -30',
                'title'=> 'TCP-Verbindungen Snapshot',
                'desc' => 'Einmaliger Snapshot aller aktiven TCP-Verbindungen mit Bytes sent/received.',
                'risk' => 'safe',
            ],
            [
                'cat'  => 'netzwerk',
                'cmd'  => "networksetup -listallhardwareports | awk '/Hardware Port/{port=$NF} /Ethernet Address/{print port\": \"$NF}'",
                'title'=> 'Alle MAC-Adressen',
                'desc' => 'Listet alle Netzwerkinterfaces mit ihrer MAC-Adresse. Praktisch für Router-Whitelists.',
                'risk' => 'safe',
            ],
            [
                'cat'  => 'netzwerk',
                'cmd'  => 'dns-sd -B _services._dns-sd._udp local.',
                'title'=> 'Bonjour-Dienste im Netz',
                'desc' => 'Zeigt alle Bonjour/mDNS-Dienste im lokalen Netzwerk live. Beenden mit Ctrl+C.',
                'risk' => 'safe',
            ],

            // ── DATEIEN ──────────────────────────────────────────
            [
                'cat'  => 'dateien',
                'cmd'  => "find ~ -name '*.DS_Store' -delete 2>/dev/null; echo 'Aufgeräumt.'",
                'title'=> 'DS_Store aufräumen',
                'desc' => 'Löscht alle .DS_Store-Dateien im Home-Verzeichnis. Gut vor git-Commits oder USB-Weitergabe.',
                'risk' => 'safe',
            ],
            [
                'cat'  => 'dateien',
                'cmd'  => 'du -sh ~/* | sort -rh | head -15',
                'title'=> 'Größte Verzeichnisse',
                'desc' => 'Top 15 Verzeichnisse nach Größe, sortiert. Schnell herausfinden wo der Speicher bleibt.',
                'risk' => 'safe',
            ],
            [
                'cat'  => 'dateien',
                'cmd'  => 'mdfind -name "SUCHBEGRIFF"',
                'title'=> 'Spotlight via Terminal',
                'desc' => 'Spotlight-Suche im Terminal. Schneller als Finder und skriptbar. SUCHBEGRIFF ersetzen.',
                'risk' => 'safe',
            ],
            [
                'cat'  => 'dateien',
                'cmd'  => "find /tmp ~/Library/Caches -maxdepth 2 -type f -size +50M 2>/dev/null | sort",
                'title'=> 'Große Cache-Dateien finden',
                'desc' => 'Findet Dateien über 50MB in Temp- und Cache-Verzeichnissen. Vor dem Löschen prüfen.',
                'risk' => 'safe',
            ],
            [
                'cat'  => 'dateien',
                'cmd'  => 'sips -z 800 600 ~/Desktop/bild.jpg',
                'title'=> 'Bild skalieren (sips)',
                'desc' => 'Skaliert ein Bild auf 800×600 ohne Extra-Tool. sips ist macOS-nativ. Pfad anpassen.',
                'risk' => 'safe',
            ],
            [
                'cat'  => 'dateien',
                'cmd'  => "ls -lAh ~/Library/Application\\ Support | sort -k5 -rh | head -20",
                'title'=> 'App Support nach Größe',
                'desc' => 'Zeigt die größten App-Support-Ordner — nützlich nach dem Deinstallieren von Apps.',
                'risk' => 'safe',
            ],

            // ── PERFORMANCE ──────────────────────────────────────
            [
                'cat'  => 'performance',
                'cmd'  => 'top -o cpu -n 15 -l 1 | tail -16',
                'title'=> 'Top 15 CPU-Fresser',
                'desc' => 'Einmaliger Snapshot der 15 CPU-intensivsten Prozesse — ohne interaktiven top-Modus.',
                'risk' => 'safe',
            ],
            [
                'cat'  => 'performance',
                'cmd'  => "vm_stat | perl -ne '/page size of (\\d+)/ and \$s=\$1; /Pages\\s+([^:]+)[^\\d]+(\\d+)/ and printf \"%-25s %7.2f MB\\n\",\$1,\$2*\$s/1048576'",
                'title'=> 'RAM-Nutzung detailliert',
                'desc' => 'Schlüsselt den RAM auf: wired, active, inactive, free, speculative — in MB.',
                'risk' => 'safe',
            ],
            [
                'cat'  => 'performance',
                'cmd'  => 'sudo powermetrics --samplers cpu_power,gpu_power -n 1 -i 1000 2>/dev/null | grep -E "Combined|CPU|GPU|Package"',
                'title'=> 'CPU/GPU Power (Apple Silicon)',
                'desc' => 'Aktueller Stromverbrauch von CPU und GPU in Watt. Nur auf Apple Silicon sinnvoll. Braucht sudo.',
                'risk' => 'safe',
            ],
            [
                'cat'  => 'performance',
                'cmd'  => 'pmset -g batt',
                'title'=> 'Batteriestatus',
                'desc' => 'Zeigt Ladestand, Ladezustand, Zustand der Batterie und ob du am Netzteil hängst.',
                'risk' => 'safe',
            ],
            [
                'cat'  => 'performance',
                'cmd'  => 'ioreg -l | grep -i "CycleCount\\|MaxCapacity\\|CurrentCapacity" | head -6',
                'title'=> 'Batterie-Ladezyklen',
                'desc' => 'Ladezyklen, maximale und aktuelle Kapazität. Zeigt ob die Batterie noch fit ist.',
                'risk' => 'safe',
            ],

            // ── TWEAKS ───────────────────────────────────────────
            [
                'cat'  => 'tweaks',
                'cmd'  => 'defaults write com.apple.dock autohide-delay -float 0 && defaults write com.apple.dock autohide-time-modifier -float 0.3 && killall Dock',
                'title'=> 'Dock: sofortiges Einblenden',
                'desc' => 'Entfernt die Verzögerung beim Dock-Einblenden und verkürzt die Animation. Sofort spürbar.',
                'risk' => 'safe',
            ],
            [
                'cat'  => 'tweaks',
                'cmd'  => 'defaults write NSGlobalDomain ApplePressAndHoldEnabled -bool false',
                'title'=> 'Key-Repeat aktivieren',
                'desc' => 'Deaktiviert den Akzent-Popup bei gedrückter Taste und aktiviert stattdessen Key-Repeat. Logout nötig.',
                'risk' => 'safe',
            ],
            [
                'cat'  => 'tweaks',
                'cmd'  => 'defaults write com.apple.screencapture location ~/Desktop && defaults write com.apple.screencapture type png && killall SystemUIServer',
                'title'=> 'Screenshot-Einstellungen',
                'desc' => 'Setzt Screenshot-Pfad auf Desktop und Format auf PNG. killall SystemUIServer übernimmt sofort.',
                'risk' => 'safe',
            ],
            [
                'cat'  => 'tweaks',
                'cmd'  => 'caffeinate -d -t 7200',
                'title'=> 'Mac 2h wachhalten',
                'desc' => 'Verhindert Sleep/Screensaver für 2 Stunden. -d = Display an. Einfach Ctrl+C zum Beenden.',
                'risk' => 'safe',
            ],
            [
                'cat'  => 'tweaks',
                'cmd'  => "defaults write com.apple.finder AppleShowAllFiles -bool true && killall Finder",
                'title'=> 'Versteckte Dateien im Finder',
                'desc' => 'Zeigt alle versteckten Dateien (Dotfiles) im Finder. Rückgängig: -bool false.',
                'risk' => 'safe',
            ],
            [
                'cat'  => 'tweaks',
                'cmd'  => 'defaults write com.apple.SoftwareUpdate AutomaticCheckEnabled -bool false',
                'title'=> 'Auto-Update-Check deaktivieren',
                'desc' => 'Stoppt den automatischen Update-Check im Hintergrund. Updates manuell über Systemeinstellungen.',
                'risk' => 'caution',
            ],
        ];

        foreach ($cmds as $c):
            $riskLabel = $c['risk'] === 'caution' ? 'CAUTION' : 'SAFE';
            $catUpper  = strtoupper($c['cat']);
            $cmdEsc    = htmlspecialchars($c['cmd'], ENT_QUOTES);
        ?>
        <div class="mn-card" data-cat="<?php echo $c['cat']; ?>">
            <div class="mn-card-meta">
                <span class="mn-cat-tag"><?php echo $catUpper; ?></span>
                <span class="mn-risk mn-risk-<?php echo $c['risk']; ?>"><?php echo $riskLabel; ?></span>
            </div>
            <h3 class="mn-card-title"><?php echo htmlspecialchars($c['title']); ?></h3>
            <p class="mn-card-desc"><?php echo htmlspecialchars($c['desc']); ?></p>
            <div class="mn-cmd-block">
                <code class="mn-cmd-code"><?php echo $cmdEsc; ?></code>
                <button class="mn-copy-btn" data-cmd="<?php echo $cmdEsc; ?>">COPY</button>
            </div>
        </div>
        <?php endforeach; ?>

    </div><!-- /mn-grid -->

</div><!-- /mn-container -->

<script>
(function() {
    // Filter
    const filters = document.querySelectorAll('.mn-filter');
    const cards   = document.querySelectorAll('.mn-card');

    filters.forEach(btn => {
        btn.addEventListener('click', () => {
            filters.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const cat = btn.dataset.cat;
            cards.forEach(card => {
                card.style.display = (cat === 'all' || card.dataset.cat === cat) ? '' : 'none';
            });
        });
    });

    // Copy to clipboard
    document.querySelectorAll('.mn-copy-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const cmd = btn.dataset.cmd;
            navigator.clipboard.writeText(cmd).then(() => {
                const orig = btn.textContent;
                btn.textContent = 'COPIED';
                btn.classList.add('mn-copy-ok');
                setTimeout(() => { btn.textContent = orig; btn.classList.remove('mn-copy-ok'); }, 1500);
            });
        });
    });
})();
</script>

<?php wp_footer(); ?>
</body>
</html>
