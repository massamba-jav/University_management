import './bootstrap';
if (window.flashMessage) {
    // afficher une pastille
    const el = document.createElement('div');
    el.textContent = window.flashMessage;
    el.classList.add('pastille');
    document.body.appendChild(el);
}