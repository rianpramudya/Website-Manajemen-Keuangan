export function initializeProgress() {
    const reduced = matchMedia('(prefers-reduced-motion: reduce)').matches;
    const animate = element => { if (!reduced) element.classList.add('progress-enter'); };
    if (!('IntersectionObserver' in window)) { document.querySelectorAll('[data-progress]').forEach(animate); return; }
    const observer = new IntersectionObserver(entries => entries.forEach(entry => { if (entry.isIntersecting) { animate(entry.target); observer.unobserve(entry.target); } }));
    document.querySelectorAll('[data-progress]').forEach(element => observer.observe(element));
}
