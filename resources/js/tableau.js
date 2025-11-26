// Ce fichier n'est plus responsable du rendu des tableaux.
// On garde uniquement un progressive enhancement optionnel (ex: loader)
// pour transitions, mais on ne fait plus de fetch/render dynamiques.

document.addEventListener('DOMContentLoaded', () => {
    const loader = document.getElementById('loader');
    if (!loader) return;

    // Exemple: montrer le loader lors d'un clic de pagination (liens serveur)
    document.querySelectorAll('.pagination a, .tbl-controls a').forEach(a => {
        a.addEventListener('click', () => {
            loader.classList.remove('hidden');
            loader.setAttribute('aria-busy', 'true');
        });
    });
});