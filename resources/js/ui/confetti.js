export function celebrateMilestone() {
    if (matchMedia('(prefers-reduced-motion: reduce)').matches || navigator.hardwareConcurrency <= 2) return;
    const tokens = getComputedStyle(document.documentElement);
    const duration = parseFloat(tokens.getPropertyValue('--dur-moment'));
    const count = parseInt(tokens.getPropertyValue(matchMedia('(pointer: coarse)').matches ? '--confetti-mobile' : '--confetti-desktop'));
    const container = document.createElement('div'); container.className = 'confetti'; container.setAttribute('aria-hidden', 'true'); document.body.append(container);
    const palettes = ['yellow', 'teal', 'violet', 'sky'];
    const animations = [];
    for (let index = 0; index < count; index++) {
        const piece = document.createElement('span'); piece.dataset.palette = palettes[index % palettes.length]; container.append(piece);
        const spread = (index / (count - 1) - .5) * innerWidth;
        const lift = -innerHeight / (3 + index % 3);
        animations.push(piece.animate([{ transform: 'translate(0, 0) rotate(0deg)', opacity: 1 }, { transform: `translate(${spread / 2}px, ${lift}px) rotate(${index * 30}deg)`, opacity: 1 }, { transform: `translate(${spread}px, ${innerHeight / 3}px) rotate(${index * 60}deg)`, opacity: 0 }], { duration, easing: tokens.getPropertyValue('--ease-out').trim() }).finished);
    }
    Promise.all(animations).finally(() => container.remove());
}
