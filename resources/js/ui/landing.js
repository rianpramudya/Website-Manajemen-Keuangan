export function initializeLanding() {
    const element = document.querySelector('[data-landing-idle]');
    if (!element || matchMedia('(prefers-reduced-motion: reduce)').matches || !('IntersectionObserver' in window)) return;
    element.classList.add('landing-idle');
    let visible = true;
    const update = () => element.classList.toggle('landing-idle-paused', !visible || document.hidden);
    const observer = new IntersectionObserver(entries => entries.forEach(entry => { visible = entry.isIntersecting; update(); }));
    observer.observe(element);
    document.addEventListener('visibilitychange', update);
}
