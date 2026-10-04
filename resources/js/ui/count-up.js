export function initializeCountUp() {
    if (matchMedia('(prefers-reduced-motion: reduce)').matches) return;
    const tokens = getComputedStyle(document.documentElement);
    const stagger = parseFloat(tokens.getPropertyValue('--stagger'));
    const limit = parseInt(tokens.getPropertyValue('--reveal-limit'));
    [...document.querySelectorAll('[data-count-up]')].slice(0, limit).forEach((element, index) => {
        const value = Number(element.dataset.countUp);
        if (!Number.isFinite(value)) return;
        const identity = element.closest('[data-pocket-id]')?.dataset.pocketId;
        const key = `dompet-count:${document.body.dataset.uiUser}:${identity ? 'pocket-' + identity : location.pathname + '-' + index}`;
        let previous = null;
        try { previous = sessionStorage.getItem(key); sessionStorage.setItem(key, String(value)); } catch {}
        if (Number(previous) === value && previous !== null) return;
        const overlay = document.createElement('span');
        overlay.className = 'odometer-overlay';
        overlay.setAttribute('aria-hidden', 'true');
        overlay.append(element.querySelector('.money-prefix').cloneNode(true));
        const digits = element.querySelector('.money-digits').textContent;
        let position = 0;
        for (const character of digits) {
            if (!/\d/.test(character)) { overlay.append(character === '.' ? document.createTextNode('.') : document.createTextNode(character)); if (character === '.') overlay.append(document.createElement('wbr')); continue; }
            const window = document.createElement('span');
            window.className = 'odometer-digit';
            const strip = document.createElement('span');
            strip.className = 'odometer-strip';
            strip.style.setProperty('--digit-delay', `${Math.min(position++, limit - 1) * stagger}ms`);
            for (const digit of ['0', character]) { const cell = document.createElement('span'); cell.textContent = digit; strip.append(cell); }
            window.append(strip); overlay.append(window);
        }
        element.classList.add('odometer-running'); element.append(overlay);
        const strips = [...overlay.querySelectorAll('.odometer-strip')];
        strips.at(-1)?.addEventListener('animationend', () => { overlay.remove(); element.classList.remove('odometer-running'); }, { once: true });
    });
}
