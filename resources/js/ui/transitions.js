export function transitionUpdate(update, container) {
    if (matchMedia('(prefers-reduced-motion: reduce)').matches) { update(); return; }
    if (document.startViewTransition) {
        document.documentElement.classList.add('filter-transition');
        const transition = document.startViewTransition(update);
        transition.finished.finally(() => document.documentElement.classList.remove('filter-transition'));
    } else { update(); container?.classList.remove('content-crossfade'); if (container) { container.getBoundingClientRect(); container.classList.add('content-crossfade'); } }
}
export function initializeTransitions() {
    if (matchMedia('(prefers-reduced-motion: reduce)').matches) return;
    const namePockets = () => document.querySelectorAll('[data-pocket-id]').forEach(card => {
        card.style.viewTransitionName = `pocket-${card.dataset.pocketId}`;
    });
    namePockets();
    window.addEventListener('pagereveal', namePockets);
    window.addEventListener('pageswap', namePockets);
}
