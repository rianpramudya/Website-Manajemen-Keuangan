const storageKey = 'dompet-ui-event';
function readPending() {
    try { const pending = JSON.parse(sessionStorage.getItem(storageKey)); sessionStorage.removeItem(storageKey); return pending; } catch { return null; }
}
function coinBetween(source, target, transfer) {
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
export function initializeFinanceEvents() {
    const pending = readPending();
    const successful = document.querySelector('[data-toast][data-success="true"]');
    const reduced = matchMedia('(prefers-reduced-motion: reduce)').matches;
    const lowPower = navigator.hardwareConcurrency && navigator.hardwareConcurrency <= 2;
    if (pending && successful && !reduced) {
        if (pending.kind === 'transaction') document.querySelector('[data-transaction-id]')?.classList.add('is-new');
        if (pending.kind === 'pay') document.querySelector(`[data-paid-bill="${pending.bill}"] .badge-success`)?.classList.add('stamp');
        if (!lowPower && (pending.type === 'income' || pending.kind === 'income')) {
            const target = document.querySelector(`[data-pocket-id="${pending.category}"]`) || document.querySelector('.pocket');
            if (target) coinBetween(null, target, false);
        }
        if (!lowPower && pending.kind === 'transfer') {
            const source = document.querySelector(`[data-pocket-id="${pending.from}"]`);
            const target = document.querySelector(`[data-pocket-id="${pending.to}"]`);
            if (source && target) coinBetween(source, target, true);
        }
        if (pending.kind === 'delete-bill' || pending.kind === 'delete-transaction') {
            const marker = document.createElement('div');
            marker.className = 'panel remove-item';
            marker.setAttribute('aria-hidden', 'true');
            marker.textContent = 'Catatan dihapus';
            const page = document.querySelector('.page');
            page?.prepend(marker);
            const duration = parseFloat(getComputedStyle(document.documentElement).getPropertyValue('--dur-base'));
            setTimeout(() => marker.remove(), duration);
        }
    }
    document.querySelectorAll('form').forEach(form => form.addEventListener('submit', event => {
        if (form.dataset.confirm && !confirm(form.dataset.confirm)) { event.preventDefault(); return; }
        if (event.defaultPrevented) return;
        const value = name => form.elements.namedItem(name)?.value;
        const kind = form.dataset.removeId ? 'delete-transaction' : form.dataset.financeEvent;
        if (!kind) return;
        try { sessionStorage.setItem(storageKey, JSON.stringify({ kind, type: value('type'), category: value('category_id'), from: value('from_category_id'), to: value('to_category_id'), bill: form.dataset.billId })); } catch {}
    }));
}
