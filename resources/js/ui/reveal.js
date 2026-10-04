export function initializeReveal() {
    const reduced = matchMedia('(prefers-reduced-motion: reduce)');
    if (reduced.matches || !('IntersectionObserver' in window)) return;
    const tokens = getComputedStyle(document.documentElement);
    const stagger = parseFloat(tokens.getPropertyValue('--stagger'));
    const limit = parseInt(tokens.getPropertyValue('--reveal-limit'));
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
    document.querySelectorAll('[data-reveal]').forEach(element => observer.observe(element));
}
