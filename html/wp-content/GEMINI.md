# GEMINI MEMORY: KI-LABOR / DIGITALE ANARCHIE

## PROJEKT-STAND (18. MÄRZ 2026)

### 🚀 Kern-Features
- **BIOS-Boot-Sequenz:** In `script.js` implementiert. Nutzt Web Audio API für mechanische Ticks. Läuft einmal pro Session (sessionStorage) oder via `[ Manual System Reboot ]` Link / Terminal `reboot`.
- **Interaktives Terminal:** Im `#system-log` integriert. 
  - Befehle: `help`, `reboot`, `whoami`, `destruct`, `matrix`, `anarchy`, `bypass`, `status`, `clear`.
  - `destruct` triggert einen 5-Sekunden-Countdown mit "SASCHA WINS" Blackout-Overlay (Klick zum Reboot).
- **Mission-Reports (`single.php`):**
  - **Decrypt-Effekt:** Text entschlüsselt sich beim Laden mit mechanischen Sounds (Web Audio API).
  - **Classification Stamp:** Roter "TOP SECRET | EYES ONLY" Stempel oben rechts.
  - **Content:** Wird dynamisch über `ki_labor_init_content()` in `functions.php` generiert (Local-First-Ansatz).

### 🖼 Medien-Assets
- `hero.png`: Standard Steampunk Sascha (Zentrales Bild).
- `hero_1.png`: Eingebunden im "n8n Resurrection" Report.
- `hero_2.png`: Eingebunden im "Theme-Annihilation" Report.
- CSS-Filter: Bilder in Reports sind auf 500px begrenzt, zentriert und haben einen "Gritty-Look" (Grayscale/Contrast).

### 🛠 Dateien & Struktur
- `themes/ki-labor/functions.php`: Beinhaltet den Content-Generator für Posts.
- `themes/ki-labor/script.js`: Beinhaltet die gesamte Interaktions-Logik (Boot, Terminal, Filter, Modes).
- `themes/ki-labor/style.css`: Beinhaltet CRT-Flicker, Scanlines, Glitch-Animationen und das Grid-Styling.
- `themes/ki-labor/single.php`: Template für die Mission-Reports inkl. Decrypt-Script.

## TODO FÜR MORGEN
- [ ] Bild für "Gemini Neural Link" einbinden.
- [ ] Terminal-Befehl `hack` (Matrix-Regen im Log) implementieren.
- [ ] Check ob Sound-Engine auf allen Browsern stabil triggert.

**MEMO AN GEMINI:** Beim Start der nächsten Session ZUERST diese Datei lesen um den "Flux Flow" wiederherzustellen. Sascha ist der einzige "Boss".
