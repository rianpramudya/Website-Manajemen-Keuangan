import { scheduleFrame } from './frames';
export function initializeTilt() {
    if (!matchMedia('(hover: hover) and (pointer: fine)').matches || matchMedia('(prefers-reduced-motion: reduce)').matches || navigator.hardwareConcurrency <= 2) return;
    const tokens = getComputedStyle(document.documentElement);
    const limit = Number(tokens.getPropertyValue('--tilt-limit'));
    const parallax = parseFloat(tokens.getPropertyValue('--tilt-parallax'));
    document.querySelectorAll('.pocket[href]').forEach(card => {
        let targetX = 0, targetY = 0, x = 0, y = 0;
        const render = () => {
            x += (targetX - x) * .2; y += (targetY - y) * .2;
            card.style.setProperty('--tilt-x', `${x}deg`); card.style.setProperty('--tilt-y', `${y}deg`);
            card.style.setProperty('--stitch-x', `${y / limit * parallax}px`); card.style.setProperty('--stitch-y', `${x / limit * parallax}px`);
            if (Math.abs(targetX - x) + Math.abs(targetY - y) < .01) { if (!targetX && !targetY) card.classList.remove('tilt-active'); return false; }
            return true;
        };
        card.addEventListener('pointermove', event => {
            const bounds = card.getBoundingClientRect();
            targetX = Math.max(-limit, Math.min(limit, -(event.clientY - bounds.top - bounds.height / 2) / bounds.height * limit * 2));
            targetY = Math.max(-limit, Math.min(limit, (event.clientX - bounds.left - bounds.width / 2) / bounds.width * limit * 2));
            card.classList.add('tilt-active'); scheduleFrame(render);
        });
        card.addEventListener('pointerleave', () => { targetX = targetY = 0; scheduleFrame(render); });
    });
}
