const http = require('http');
const fs = require('fs');
const path = require('path');

const DATA_FILE = path.join(__dirname, 'data/mac_nerds.json');
const CATS_FILE = path.join(__dirname, 'data/mac_nerds_cats.json');
const PORT = 3001;
const RISKS = ['safe', 'warning', 'danger'];

function readData() { return JSON.parse(fs.readFileSync(DATA_FILE, 'utf8')); }
function writeData(d) { fs.writeFileSync(DATA_FILE, JSON.stringify(d, null, 4), 'utf8'); }
function readCats() { return JSON.parse(fs.readFileSync(CATS_FILE, 'utf8')); }
function writeCats(c) { fs.writeFileSync(CATS_FILE, JSON.stringify(c, null, 2), 'utf8'); }

function esc(s) {
    return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

function html(data, cats) {
    const catOptions = cats.map(c => `<option value="${c}">${c}</option>`).join('');
    const catBadges = cats.map(c => `
        <div class="cat-badge">
            <span>${esc(c)}</span>
            <button class="cat-del" onclick="deleteCat('${esc(c)}')" title="Löschen">✕</button>
        </div>`).join('');

    const rows = data.map((cmd, i) => `
        <tr>
            <td><span class="cat">${esc(cmd.cat)}</span></td>
            <td>${esc(cmd.title)}</td>
            <td><code>${esc(cmd.cmd)}</code></td>
            <td class="desc-cell">${esc(cmd.desc)}</td>
            <td><span class="risk risk-${cmd.risk}">${cmd.risk}</span></td>
            <td class="actions">
                <button onclick="editRow(${i})">✏</button>
                <button class="del" onclick="delRow(${i})">✕</button>
            </td>
        </tr>`).join('');

    const json = JSON.stringify(data).replace(/</g,'\\u003c');
    const catsJson = JSON.stringify(cats).replace(/</g,'\\u003c');

    return `<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>MAC NERDS // ADMIN</title>
<style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { background: #0a0a0a; color: #d4af37; font-family: 'Courier New', monospace; padding: 30px 20px; }
    h1 { color: #ff4500; letter-spacing: 8px; font-size: 1.6rem; margin-bottom: 6px; }
    p.sub { color: rgba(212,175,55,0.4); font-size: 0.7rem; letter-spacing: 3px; margin-bottom: 30px; }

    .box { background: #111; border: 1px solid rgba(184,115,51,0.3); padding: 24px; margin-bottom: 24px; }
    .box h2 { font-size: 0.85rem; letter-spacing: 4px; color: #b87333; margin-bottom: 18px; }

    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    .form-grid .full { grid-column: 1 / -1; }
    label { display: block; font-size: 0.65rem; letter-spacing: 2px; color: rgba(212,175,55,0.5); margin-bottom: 4px; }
    input, textarea, select {
        width: 100%; background: #000; border: 1px solid rgba(184,115,51,0.25);
        color: #d4af37; font-family: 'Courier New', monospace; font-size: 0.8rem;
        padding: 8px 10px; outline: none; transition: border-color 0.2s;
    }
    input:focus, textarea:focus, select:focus { border-color: #d4af37; }
    textarea { resize: vertical; min-height: 60px; }
    select option { background: #111; }

    .btn-row { display: flex; gap: 10px; margin-top: 16px; flex-wrap: wrap; }
    button {
        background: transparent; border: 1px solid rgba(212,175,55,0.4);
        color: #d4af37; font-family: 'Courier New', monospace; font-size: 0.75rem;
        letter-spacing: 2px; padding: 8px 20px; cursor: pointer; transition: all 0.2s;
    }
    button:hover { background: rgba(212,175,55,0.1); border-color: #d4af37; }
    button.primary { border-color: #ff4500; color: #ff4500; }
    button.primary:hover { background: rgba(255,69,0,0.1); }
    button.del { border-color: rgba(255,69,0,0.3); color: rgba(255,69,0,0.6); padding: 4px 10px; }
    button.del:hover { background: rgba(255,69,0,0.1); border-color: #ff4500; color: #ff4500; }
    button.reset-btn { border-color: rgba(212,175,55,0.2); color: rgba(212,175,55,0.4); }
    button.green { border-color: rgba(76,175,80,0.5); color: #4caf50; }
    button.green:hover { background: rgba(76,175,80,0.1); }

    /* KATEGORIEN */
    .cats-wrap { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; }
    .cat-badge {
        display: flex; align-items: center; gap: 6px;
        background: rgba(184,115,51,0.1); border: 1px solid rgba(184,115,51,0.3);
        padding: 4px 10px; font-size: 0.75rem; color: #b87333;
    }
    .cat-del {
        background: transparent; border: none; color: rgba(255,69,0,0.5);
        cursor: pointer; font-size: 0.7rem; padding: 0 2px; letter-spacing: 0;
    }
    .cat-del:hover { color: #ff4500; background: transparent; }
    .cat-add-row { display: flex; gap: 10px; align-items: flex-end; margin-top: 16px; }
    .cat-add-row input { max-width: 200px; }

    /* TABELLE */
    .table-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
    .count { font-size: 0.65rem; color: rgba(212,175,55,0.4); letter-spacing: 2px; }
    table { width: 100%; border-collapse: collapse; font-size: 0.78rem; }
    th { text-align: left; color: rgba(212,175,55,0.4); font-size: 0.6rem; letter-spacing: 3px;
         border-bottom: 1px solid rgba(184,115,51,0.2); padding: 6px 10px; }
    td { padding: 10px; border-bottom: 1px solid rgba(184,115,51,0.1); vertical-align: top; }
    td.desc-cell { font-size: 0.7rem; color: rgba(212,175,55,0.5); max-width: 220px; }
    tr:hover td { background: rgba(212,175,55,0.03); }
    code { color: #7ec8a4; font-size: 0.72rem; word-break: break-all; }
    td.actions { white-space: nowrap; }
    td.actions button { padding: 4px 10px; margin-right: 4px; }
    .cat { font-size: 0.6rem; letter-spacing: 2px; padding: 2px 7px; border: 1px solid rgba(184,115,51,0.4); color: #b87333; }
    .risk { font-size: 0.6rem; letter-spacing: 2px; padding: 2px 7px; border: 1px solid; white-space: nowrap; }
    .risk-safe { color: #4caf50; border-color: rgba(76,175,80,0.4); }
    .risk-warning { color: #ff9800; border-color: rgba(255,152,0,0.4); }
    .risk-danger { color: #ff4500; border-color: rgba(255,69,0,0.4); }

    .toast { position: fixed; bottom: 30px; right: 30px; background: #111;
             border: 1px solid #4caf50; color: #4caf50; padding: 10px 20px;
             font-size: 0.75rem; letter-spacing: 2px; opacity: 0; transition: opacity 0.3s; pointer-events: none; }
    .toast.err { border-color: #ff4500; color: #ff4500; }
    .toast.show { opacity: 1; }

    @media (max-width: 700px) {
        .form-grid { grid-template-columns: 1fr; }
        table { font-size: 0.68rem; }
        td.desc-cell { display: none; }
    }
</style>
</head>
<body>

<h1>MAC NERDS</h1>
<p class="sub">// LOKALES ADMIN-PANEL · localhost:${PORT}</p>

<!-- KATEGORIEN -->
<div class="box">
    <h2>KATEGORIEN</h2>
    <div class="cats-wrap" id="cats-wrap">${catBadges}</div>
    <div class="cat-add-row">
        <div>
            <label>NEUE KATEGORIE</label>
            <input type="text" id="new-cat" placeholder="z.B. sicherheit" maxlength="30"
                   onkeydown="if(event.key==='Enter') addCat()">
        </div>
        <button class="green" onclick="addCat()">[ + HINZUFÜGEN ]</button>
    </div>
</div>

<!-- BEFEHL FORMULAR -->
<div class="box">
    <h2 id="form-title">+ NEUER BEFEHL</h2>
    <form id="cmd-form">
        <input type="hidden" id="edit-index" value="-1">
        <div class="form-grid">
            <div>
                <label>KATEGORIE</label>
                <select id="f-cat">${catOptions}</select>
            </div>
            <div>
                <label>RISIKO</label>
                <select id="f-risk">${RISKS.map(r=>`<option value="${r}">${r}</option>`).join('')}</select>
            </div>
            <div class="full">
                <label>TITEL</label>
                <input type="text" id="f-title" placeholder="z.B. Netzwerkqualität testen" required>
            </div>
            <div class="full">
                <label>BEFEHL</label>
                <input type="text" id="f-cmd" placeholder="z.B. networkQuality" required>
            </div>
            <div class="full">
                <label>BESCHREIBUNG</label>
                <textarea id="f-desc" placeholder="Was macht der Befehl?"></textarea>
            </div>
        </div>
        <div class="btn-row">
            <button type="submit" class="primary" id="submit-btn">[ SPEICHERN ]</button>
            <button type="button" class="reset-btn" onclick="resetForm()">[ ABBRECHEN ]</button>
        </div>
    </form>
</div>

<!-- TABELLE -->
<div class="box">
    <div class="table-header">
        <h2>BEFEHLE</h2>
        <span class="count" id="count-label">${data.length} EINTRÄGE</span>
    </div>
    <table>
        <thead>
            <tr><th>CAT</th><th>TITEL</th><th>BEFEHL</th><th>BESCHREIBUNG</th><th>RISIKO</th><th></th></tr>
        </thead>
        <tbody id="cmd-table">${rows}</tbody>
    </table>
</div>

<div class="toast" id="toast"></div>

<script>
let DATA = ${json};
let CATS = ${catsJson};

function toast(msg, err) {
    const t = document.getElementById('toast');
    t.textContent = msg;
    t.className = 'toast' + (err ? ' err' : '') + ' show';
    setTimeout(() => t.classList.remove('show'), 2000);
}

// ── KATEGORIEN ──────────────────────────────
function renderCats() {
    document.getElementById('cats-wrap').innerHTML = CATS.map(c => \`
        <div class="cat-badge">
            <span>\${c}</span>
            <button class="cat-del" onclick="deleteCat('\${c}')" title="Löschen">✕</button>
        </div>\`).join('');
    const sel = document.getElementById('f-cat');
    const cur = sel.value;
    sel.innerHTML = CATS.map(c => \`<option value="\${c}">\${c}</option>\`).join('');
    if (CATS.includes(cur)) sel.value = cur;
}

function addCat() {
    const inp = document.getElementById('new-cat');
    const val = inp.value.trim().toLowerCase().replace(/[^a-z0-9äöü-]/g, '');
    if (!val) return;
    if (CATS.includes(val)) { toast('Kategorie existiert bereits', true); return; }
    CATS.push(val);
    CATS.sort();
    saveCats(() => { inp.value = ''; renderCats(); toast('✓ KATEGORIE GESPEICHERT'); });
}

function deleteCat(cat) {
    const inUse = DATA.some(d => d.cat === cat);
    if (inUse && !confirm(\`Kategorie "\${cat}" wird noch von Befehlen verwendet. Trotzdem löschen?\`)) return;
    CATS = CATS.filter(c => c !== cat);
    saveCats(() => { renderCats(); toast('✓ GELÖSCHT'); });
}

function saveCats(cb) {
    fetch('/save-cats', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(CATS)
    }).then(r => r.json()).then(r => { if (r.ok) cb(); else toast('Fehler: ' + r.error, true); });
}

// ── BEFEHLE ──────────────────────────────────
function editRow(i) {
    const c = DATA[i];
    document.getElementById('edit-index').value = i;
    document.getElementById('f-cat').value = c.cat;
    document.getElementById('f-risk').value = c.risk;
    document.getElementById('f-title').value = c.title;
    document.getElementById('f-cmd').value = c.cmd;
    document.getElementById('f-desc').value = c.desc;
    document.getElementById('form-title').textContent = '✏ BEFEHL BEARBEITEN';
    document.getElementById('submit-btn').textContent = '[ AKTUALISIEREN ]';
    document.querySelector('.box:nth-child(2)').scrollIntoView({ behavior: 'smooth' });
}

function resetForm() {
    document.getElementById('cmd-form').reset();
    document.getElementById('edit-index').value = -1;
    document.getElementById('form-title').textContent = '+ NEUER BEFEHL';
    document.getElementById('submit-btn').textContent = '[ SPEICHERN ]';
}

function delRow(i) {
    if (!confirm('Befehl löschen?')) return;
    DATA.splice(i, 1);
    saveData();
}

document.getElementById('cmd-form').addEventListener('submit', e => {
    e.preventDefault();
    const entry = {
        cat:   document.getElementById('f-cat').value,
        title: document.getElementById('f-title').value.trim(),
        cmd:   document.getElementById('f-cmd').value.trim(),
        desc:  document.getElementById('f-desc').value.trim(),
        risk:  document.getElementById('f-risk').value,
    };
    const idx = parseInt(document.getElementById('edit-index').value);
    if (idx >= 0) DATA[idx] = entry; else DATA.push(entry);
    saveData();
    resetForm();
});

function saveData() {
    fetch('/save', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(DATA)
    }).then(r => r.json()).then(r => {
        if (r.ok) { toast('✓ GESPEICHERT'); setTimeout(() => location.reload(), 500); }
        else toast('Fehler: ' + r.error, true);
    });
}
</script>
</body>
</html>`;
}

const server = http.createServer((req, res) => {
    const json = (status, obj) => {
        res.writeHead(status, { 'Content-Type': 'application/json' });
        res.end(JSON.stringify(obj));
    };
    const body = (cb) => {
        let b = '';
        req.on('data', c => b += c);
        req.on('end', () => cb(b));
    };

    if (req.method === 'GET' && req.url === '/') {
        res.writeHead(200, { 'Content-Type': 'text/html; charset=utf-8' });
        res.end(html(readData(), readCats()));

    } else if (req.method === 'POST' && req.url === '/save') {
        body(b => {
            try { writeData(JSON.parse(b)); json(200, { ok: true }); }
            catch(e) { json(400, { ok: false, error: e.message }); }
        });

    } else if (req.method === 'POST' && req.url === '/save-cats') {
        body(b => {
            try { writeCats(JSON.parse(b)); json(200, { ok: true }); }
            catch(e) { json(400, { ok: false, error: e.message }); }
        });

    } else {
        res.writeHead(404); res.end('Not found');
    }
});

server.listen(PORT, '127.0.0.1', () => {
    console.log(`\n  MAC NERDS ADMIN → http://localhost:${PORT}\n`);
});
