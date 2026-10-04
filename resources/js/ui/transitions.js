export function transitionUpdate(update, container) {
    if (matchMedia('(prefers-reduced-motion: reduce)').matches) { update(); return; }
    if (document.startViewTransition) {
        document.documentElement.classList.add('filter-transition');
        const transition = document.startViewTransition(update);
        const cleanup = () => document.documentElement.classList.remove('filter-transition');
        transition.ready.catch(() => {});
        transition.updateCallbackDone.catch(() => {});
        transition.finished.then(cleanup, cleanup);
    } else { update(); container?.classList.remove('content-crossfade'); if (container) { container.getBoundingClientRect(); container.classList.add('content-crossfade'); } }
}
export function initializeTransitions() {
    if (matchMedia('(prefers-reduced-motion: reduce)').matches) return;
    const namePockets = () => document.querySelectorAll('[data-pocket-id]').forEach(card => {
        card.style.viewTransitionName = `pocket-${card.dataset.pocketId}`;
    });
    namePockets();
    const handle = event => {
        namePockets();
        event.viewTransition?.ready.catch(() => {});
        event.viewTransition?.updateCallbackDone.catch(() => {});
        event.viewTransition?.finished.catch(() => {});
    };
    window.addEventListener('pagereveal', handle);
    window.addEventListener('pageswap', handle);
}
