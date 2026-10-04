export function initializeProgress() {
    const reduced = matchMedia('(prefers-reduced-motion: reduce)').matches;
    const tokens = getComputedStyle(document.documentElement);
    const stagger = parseFloat(tokens.getPropertyValue('--stagger'));
    const limit = parseInt(tokens.getPropertyValue('--reveal-limit'));
    let index = 0;
    const animate = element => {
        if (reduced) return;
        element.style.animationDelay = `${Math.min(index++, limit - 1) * stagger}ms`;
        element.classList.add('progress-enter');
        if (element.hasAttribute('data-chart-bar')) {
            const label = document.querySelector(`[data-chart-label="${element.dataset.chartIndex}"] .money`);
            if (label) {
                label.style.setProperty('--chart-delay', element.style.animationDelay);
                label.classList.add('chart-value-enter');
            }
        }
    };
    if (!('IntersectionObserver' in window)) {
        document.querySelectorAll('[data-progress], [data-chart-bar]').forEach(animate);
        return;
    }
    const observer = new IntersectionObserver(entries => entries.forEach(entry => {
        if (entry.isIntersecting) { animate(entry.target); observer.unobserve(entry.target); }
    }));
    document.querySelectorAll('[data-progress], [data-chart-bar]').forEach(element => observer.observe(element));
}
