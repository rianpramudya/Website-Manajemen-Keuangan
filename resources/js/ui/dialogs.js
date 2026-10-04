export function initializeDialogs() {
    const triggers = new WeakMap();
    const close = dialog => {
        if (!dialog || !dialog.open || dialog.classList.contains('is-closing')) return;
        const finish = () => { dialog.close(); dialog.classList.remove('is-closing'); triggers.get(dialog)?.focus(); };
        if (matchMedia('(prefers-reduced-motion: reduce)').matches) { finish(); return; }
        dialog.classList.add('is-closing');
        dialog.addEventListener('animationend', finish, { once: true });
    };
    document.addEventListener('click', event => {
        const opener = event.target.closest('[data-open-dialog]');
        if (opener) {
            const dialog = document.getElementById(opener.dataset.openDialog);
            if (dialog) { triggers.set(dialog, opener); dialog.showModal(); }
        }
        const closer = event.target.closest('[data-close-dialog]');
        if (closer) close(closer.closest('dialog'));
        if (event.target.closest('[data-dismiss-toast]')) event.target.closest('[data-toast]').remove();
    });
    document.querySelectorAll('dialog').forEach(dialog => {
        dialog.addEventListener('close', () => triggers.get(dialog)?.focus());
        dialog.addEventListener('cancel', event => { event.preventDefault(); close(dialog); });
        dialog.addEventListener('keydown', event => {
            if (event.key !== 'Tab') return;
            const focusable = [...dialog.querySelectorAll('button, input:not([type="hidden"]), select, textarea, a[href], [tabindex="0"]')].filter(element => !element.disabled && element.getClientRects().length);
            const first = focusable[0];
            const last = focusable.at(-1);
            if (event.shiftKey && document.activeElement === first) { event.preventDefault(); last?.focus(); }
            if (!event.shiftKey && document.activeElement === last) { event.preventDefault(); first?.focus(); }
        });
        if (dialog.dataset.initialOpen === 'true') dialog.showModal();
    });
    window.addEventListener('open-modal', event => document.getElementById(event.detail)?.showModal());
    window.addEventListener('close-modal', event => {
        const dialog = document.getElementById(event.detail);
        if (dialog) close(dialog);
    });
    try {
        const previous = sessionStorage.getItem('dompet-form-dialog');
        sessionStorage.removeItem('dompet-form-dialog');
        if (previous && document.querySelector('[role="alert"]')) {
            const dialog = document.getElementById(previous);
            if (dialog && !dialog.open) dialog.showModal();
        }
    } catch {}
    const lifetime = parseFloat(getComputedStyle(document.documentElement).getPropertyValue('--toast-life'));
    document.querySelectorAll('[data-toast][data-success="true"]').forEach(toast => setTimeout(() => toast.remove(), lifetime));
}
