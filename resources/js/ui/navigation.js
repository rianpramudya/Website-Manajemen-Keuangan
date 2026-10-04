export function initializeNavigation() {
    const navigation = document.querySelector('[data-navigation]');
    if (!navigation) return;
    const links = [...navigation.querySelectorAll('.nav-link')];
    const active = links.findIndex(link => link.hasAttribute('aria-current'));
    if (active < 0) return;
    let previous = active;
    try {
        previous = Number(sessionStorage.getItem('dompet-nav') ?? active);
        sessionStorage.setItem('dompet-nav', String(active));
    } catch {}
    navigation.style.setProperty('--nav-index', String(previous));
    navigation.classList.add('nav-ready');
    navigation.getBoundingClientRect();
    navigation.style.setProperty('--nav-index', String(active));
    links.forEach((link, index) => link.addEventListener('click', () => {
        navigation.style.setProperty('--nav-index', String(index));
        try { sessionStorage.setItem('dompet-nav', String(index)); } catch {}
    }));
}
