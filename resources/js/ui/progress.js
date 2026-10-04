export function initializeProgress() {
    const tokens = getComputedStyle(document.documentElement);
    const reduced = matchMedia('(prefers-reduced-motion: reduce)').matches;
    const animate = element => {
        const target = Math.max(0, Math.min(100, Number(element.dataset.progress))) / 100;
        element.style.transform = `scaleX(${target})`;
        if (!reduced) element.animate([{ transform: 'scaleX(0)' }, { transform: `scaleX(${target})` }], { duration: parseFloat(tokens.getPropertyValue('--dur-slow')), easing: tokens.getPropertyValue('--ease-out') });
    };
    if (!('IntersectionObserver' in window)) { document.querySelectorAll('[data-progress]').forEach(animate); return; }
    const observer = new IntersectionObserver(entries => entries.forEach(entry => { if (entry.isIntersecting) { animate(entry.target); observer.unobserve(entry.target); } }));
    document.querySelectorAll('[data-progress]').forEach(element => observer.observe(element));
}
