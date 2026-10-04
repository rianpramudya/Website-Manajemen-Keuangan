export function initializeCountUp() {
    if (matchMedia('(prefers-reduced-motion: reduce)').matches) return;
    const duration = parseFloat(getComputedStyle(document.documentElement).getPropertyValue('--dur-slow'));
    document.querySelectorAll('[data-count-up]').forEach((element, index) => {
        const value = Number(element.dataset.countUp);
        if (!Number.isFinite(value)) return;
        const identity = element.closest('[data-pocket-id]')?.dataset.pocketId;
        const key = `dompet-count:${document.body.dataset.uiUser}:${identity ? 'pocket-' + identity : location.pathname + '-' + index}`;
        let previous = 0;
        try {
            const stored = sessionStorage.getItem(key);
            if (stored !== null && Number.isFinite(Number(stored))) previous = Number(stored);
            sessionStorage.setItem(key, String(value));
        } catch {}
        if (previous === value) return;
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
            const amount = Math.round(previous + (value - previous) * (1 - Math.pow(1 - progress, 3)));
            overlay.innerHTML = `${amount < 0 ? '-Rp ' : 'Rp '}${new Intl.NumberFormat('id-ID').format(Math.abs(amount)).replaceAll('.', '.<wbr>')}`;
            if (progress < 1) requestAnimationFrame(frame); else overlay.remove();
        };
        requestAnimationFrame(frame);
    });
}
