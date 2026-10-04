export function initializeReveal() {
    const reduced = matchMedia('(prefers-reduced-motion: reduce)');
    if (reduced.matches || !('IntersectionObserver' in window)) return;
    const tokens = getComputedStyle(document.documentElement);
    const stagger = parseFloat(tokens.getPropertyValue('--stagger'));
    const limit = parseInt(tokens.getPropertyValue('--reveal-limit'));
    const elements = [...document.querySelectorAll('[data-reveal]')].filter(element => !element.matches('.page-header:has(> .action-bar)'));
    if (CSS.supports('animation-timeline', 'view()')) { elements.slice(0, limit).forEach(element => element.classList.add('scroll-reveal')); return; }
    let index = 0;
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            const delay = index < limit ? index++ * stagger : 0;
            entry.target.style.animationDelay = `${delay}ms`;
            entry.target.classList.add('reveal-in');
            observer.unobserve(entry.target);
        });
    });
    elements.forEach(element => observer.observe(element));
}
