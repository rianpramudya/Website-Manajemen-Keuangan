export function animateCoin(source, target, transfer) {
    const tokens = getComputedStyle(document.documentElement);
    const destination = target.getBoundingClientRect();
    const origin = source?.getBoundingClientRect();
    if (destination.top < 0 || destination.bottom > innerHeight || (origin && (origin.top < 0 || origin.bottom > innerHeight))) return;
    const coin = document.createElement('span');
    coin.className = 'coin';
    coin.setAttribute('aria-hidden', 'true');
    coin.textContent = 'Rp';
    const x = destination.left + destination.width / 2;
    const y = destination.top;
    coin.style.left = `${x}px`;
    coin.style.top = `${y}px`;
    document.body.append(coin);
    const fromX = origin ? origin.left + origin.width / 2 - x : 0;
    const fromY = origin ? origin.top - y : -parseFloat(tokens.getPropertyValue('--space-8'));
    const frames = transfer ? [{ transform: `translate(${fromX}px, ${fromY}px)`, opacity: 0 }, { transform: `translate(${fromX / 2}px, ${fromY - parseFloat(tokens.getPropertyValue('--space-8'))}px)`, opacity: 1 }, { transform: 'translate(0, 0)', opacity: 0 }] : [{ transform: `translateY(${fromY}px)`, opacity: 0 }, { transform: 'translateY(0)', opacity: 1 }, { transform: 'translateY(0)', opacity: 0 }];
    coin.animate(frames, { duration: parseFloat(tokens.getPropertyValue('--dur-moment')), easing: tokens.getPropertyValue('--ease-out') }).finished.finally(() => coin.remove());
}
