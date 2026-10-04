export function initializeReveal() {
    const reduced = matchMedia('(prefers-reduced-motion: reduce)');
    if (reduced.matches || !('IntersectionObserver' in window)) return;
    const tokens = getComputedStyle(document.documentElement);
    const duration = parseFloat(tokens.getPropertyValue('--dur-slow'));
    const stagger = parseFloat(tokens.getPropertyValue('--stagger'));
    const limit = parseInt(tokens.getPropertyValue('--reveal-limit'));
    let index = 0;
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            const delay = index < limit ? index++ * stagger : 0;
            entry.target.animate([{ opacity: 0, transform: `translateY(${tokens.getPropertyValue('--reveal-distance')})` }, { opacity: 1, transform: 'none' }], { duration, delay, easing: tokens.getPropertyValue('--ease-out'), fill: 'backwards' });
            observer.unobserve(entry.target);
        });
    });
    document.querySelectorAll('[data-reveal]').forEach(element => observer.observe(element));
}
