export function initializeCountUp() {
    if (matchMedia('(prefers-reduced-motion: reduce)').matches) return;
    const duration = parseFloat(getComputedStyle(document.documentElement).getPropertyValue('--dur-slow'));
    document.querySelectorAll('[data-count-up]').forEach(element => {
        const value = Number(element.dataset.countUp);
        if (!Number.isFinite(value)) return;
        const overlay = document.createElement('span');
        overlay.className = 'count-up-overlay';
        overlay.setAttribute('aria-hidden', 'true');
        let surface = element;
        while (surface && getComputedStyle(surface).backgroundColor === 'rgba(0, 0, 0, 0)') surface = surface.parentElement;
        if (surface) overlay.style.backgroundColor = getComputedStyle(surface).backgroundColor;
        element.append(overlay);
        const started = performance.now();
        const frame = now => {
            const progress = Math.min((now - started) / duration, 1);
            const amount = Math.round(value * (1 - Math.pow(1 - progress, 3)));
            overlay.textContent = `${amount < 0 ? '-Rp ' : 'Rp '}${new Intl.NumberFormat('id-ID').format(Math.abs(amount))}`;
            if (progress < 1) requestAnimationFrame(frame); else overlay.remove();
        };
        requestAnimationFrame(frame);
    });
}
