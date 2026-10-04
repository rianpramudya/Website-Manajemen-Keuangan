import { celebrateMilestone } from './confetti';
import { animateCoin } from './coins';

const storageKey = 'dompet-ui-event';
function readPending() {
    try { const pending = JSON.parse(sessionStorage.getItem(storageKey)); sessionStorage.removeItem(storageKey); return pending; } catch { return null; }
}
export function initializeFinanceEvents() {
    const pending = readPending();
    const successful = document.querySelector('[data-toast][data-success="true"]');
    const reduced = matchMedia('(prefers-reduced-motion: reduce)').matches;
    const lowPower = navigator.hardwareConcurrency && navigator.hardwareConcurrency <= 2;
    const bills = document.querySelector('[data-monthly-unpaid]');
    const milestone = pending && (pending.first === true || (pending.monthly && bills?.dataset.monthlyUnpaid === '0' && Number(bills.dataset.monthlyPaid) > 0));
    if (pending && successful && !reduced) {
        if (milestone) celebrateMilestone();
        if (pending.kind === 'transaction') document.querySelector('[data-transaction-id]')?.classList.add('is-new');
        if (pending.kind === 'pocket') {
            const cards = [...document.querySelectorAll('[data-pocket-id]')];
            const newest = cards.sort((a, b) => Number(b.dataset.pocketId) - Number(a.dataset.pocketId))[0];
            newest?.classList.add('pocket-created');
        }
        if (pending.kind === 'bulk-pay') (pending.bills || []).forEach(id => document.querySelector(`[data-paid-bill="${id}"] .badge-success`)?.classList.add('stamp'));
        if (pending.kind === 'pay') document.querySelector(`[data-paid-bill="${pending.bill}"] .badge-success`)?.classList.add('stamp');
        if (!milestone && !lowPower && (pending.type === 'income' || pending.kind === 'income')) {
            const target = document.querySelector(`[data-pocket-id="${pending.category}"]`) || document.querySelector('.pocket');
            if (target) animateCoin(null, target, false);
        }
        if (!milestone && !lowPower && pending.kind === 'transfer') {
            const source = document.querySelector(`[data-pocket-id="${pending.from}"]`);
            const target = document.querySelector(`[data-pocket-id="${pending.to}"]`);
            if (source && target) animateCoin(source, target, true);
        }

    }
    document.querySelectorAll('form').forEach(form => form.addEventListener('submit', event => {
        if (form.dataset.confirm && !confirm(form.dataset.confirm)) { event.preventDefault(); return; }
        if (event.defaultPrevented) return;
        const value = name => form.elements.namedItem(name)?.value;
        const kind = form.dataset.removeId ? 'delete-transaction' : form.dataset.financeEvent;
        if (!kind) return;
        try { sessionStorage.setItem(storageKey, JSON.stringify({ kind, first: form.dataset.firstTransaction === 'true', monthly: form.dataset.monthly === 'true' || [...form.querySelectorAll('input[type="checkbox"]:checked')].some(input => input.closest('[data-frequency]')?.dataset.frequency === 'monthly'), type: value('type'), category: value('category_id'), from: value('from_category_id'), to: value('to_category_id'), bill: form.dataset.billId, bills: [...form.querySelectorAll('input[type="checkbox"]:checked')].map(input => input.closest('.bulk-row')?.querySelector('input[type="hidden"]')?.value).filter(Boolean) })); } catch {}
    }));
}
