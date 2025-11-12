// front cache en mémoire
const frontCache = {};

/**
 * Montre le loader
 */
function showLoader() {
    const loader = document.getElementById('loader');
    if (!loader) return;
    loader.classList.remove('hidden');
    loader.setAttribute('aria-busy', 'true');
}

/**
 * Cache le loader
 */
function hideLoader() {
    const loader = document.getElementById('loader');
    if (!loader) return;
    loader.classList.add('hidden');
    loader.setAttribute('aria-busy', 'false');
}

/**
 * charge le tableau pour le type et la page
 * @param {string} type
 * @param {number} page
 */
async function loadTable(type, page = 1) {
    const key = `${type}|${page}`;
    const container = document.getElementById('table-container');
    // indiquer loading visuel avant vidage pour éviter flicker
    showLoader();
    container.classList.add('empty');
    container.innerHTML = ''; // on videra puis on rendra le tableau ou le message d'erreur

    if (frontCache[key]) {
        renderTable(frontCache[key], type);
        hideLoader();
        return;
    }

    try {
        const url = `/data/${encodeURIComponent(type)}?page=${page}`;
        const res = await fetch(url, { headers: { 'Accept': 'application/json' }});
        if (!res.ok) {
            const err = await res.json().catch(()=>({ error: 'Erreur' }));
            container.classList.remove('empty');
            container.innerHTML = `<div class="error">Erreur: ${err.error || res.statusText}</div>`;
            hideLoader();
            return;
        }
        const json = await res.json();
        frontCache[key] = json;
        renderTable(json, type);
    } catch (e) {
        container.classList.remove('empty');
        container.innerHTML = `<div class="error">Erreur réseau</div>`;
        console.error(e);
    } finally {
        hideLoader();
    }
}

/**
 * Rend le tableau à partir des données JSON
 * @param {object} payload
 * @param {string} type
 */
function renderTable(payload, type) {
    const container = document.getElementById('table-container');
    container.innerHTML = '';
    container.classList.remove('empty');

    const { columns = [], data = [], pagination = {} } = payload;

    // header description
    const heading = document.createElement('div');
    heading.className = 'table-heading';
    heading.innerHTML = `<h2>${type.charAt(0).toUpperCase()+type.slice(1)}</h2>`;
    container.appendChild(heading);

    // table
    const table = document.createElement('table');
    table.className = 'tbl';

    const thead = document.createElement('thead');
    const trHead = document.createElement('tr');
    columns.forEach(col => {
        const th = document.createElement('th');
        th.textContent = col;
        trHead.appendChild(th);
    });
    thead.appendChild(trHead);
    table.appendChild(thead);

    const tbody = document.createElement('tbody');
    if (data.length === 0) {
        const tr = document.createElement('tr');
        const td = document.createElement('td');
        td.setAttribute('colspan', Math.max(1, columns.length));
        td.className = 'no-data';
        td.textContent = 'Aucune donnée';
        tr.appendChild(td);
        tbody.appendChild(tr);
    } else {
        data.forEach(row => {
            const tr = document.createElement('tr');
            columns.forEach(col => {
                const td = document.createElement('td');
                const val = row[col];
                td.textContent = (val === null || val === undefined) ? '' : String(val);
                tr.appendChild(td);
            });
            // highlight aléatoire : 30% de chances
            if (Math.random() <= 0.3) tr.classList.add('highlight');
            tbody.appendChild(tr);
        });
    }
    table.appendChild(tbody);
    container.appendChild(table);

    // pagination
    const pagEl = renderPagination(pagination, type);
    container.appendChild(pagEl);
}

/**
 * Rend la pagination (élément DOM)
 * @param {object} pagination
 * @param {string} type
 * @returns {HTMLElement}
 */
function renderPagination(pagination, type) {
    const wrapper = document.createElement('div');
    wrapper.className = 'pagination';

    const prevBtn = document.createElement('button');
    prevBtn.className = 'page-btn';
    prevBtn.textContent = 'Précédent';
    prevBtn.disabled = !pagination.prev_page_url;
    prevBtn.addEventListener('click', () => {
        const prevPage = Math.max(1, (pagination.current_page || 1) - 1);
        loadTable(type, prevPage);
    });

    const nextBtn = document.createElement('button');
    nextBtn.className = 'page-btn';
    nextBtn.textContent = 'Suivant';
    nextBtn.disabled = !pagination.next_page_url;
    nextBtn.addEventListener('click', () => {
        const nextPage = (pagination.current_page || 1) + 1;
        loadTable(type, nextPage);
    });

    wrapper.appendChild(prevBtn);

    // pages list (simple)
    const pageList = document.createElement('div');
    pageList.className = 'page-list';
    const current = pagination.current_page || 1;
    const last = pagination.last_page || 1;
    const windowSize = 5;
    let start = Math.max(1, current - Math.floor(windowSize/2));
    let end = Math.min(last, start + windowSize - 1);
    start = Math.max(1, end - windowSize + 1);

    for (let p = start; p <= end; p++) {
        const pbtn = document.createElement('button');
        pbtn.className = 'page-num';
        if (p === current) pbtn.classList.add('active');
        pbtn.textContent = String(p);
        pbtn.addEventListener('click', () => loadTable(type, p));
        pageList.appendChild(pbtn);
    }

    wrapper.appendChild(pageList);
    wrapper.appendChild(nextBtn);

    return wrapper;
}

/**
 * Attacher événements aux boutons
 */
function init() {
    document.querySelectorAll('.tbl-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const type = btn.getAttribute('data-type');
            if (!type) return;
            loadTable(type, 1);
        });
    });
}

document.addEventListener('DOMContentLoaded', init);