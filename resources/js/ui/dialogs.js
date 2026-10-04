export function initializeDialogs() {
    const triggers = new WeakMap();
    const close = dialog => {
        dialog.close();
        triggers.get(dialog)?.focus();
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
        if (dialog.dataset.initialOpen === 'true') dialog.showModal();
    });
    window.addEventListener('open-modal', event => document.getElementById(event.detail)?.showModal());
    window.addEventListener('close-modal', event => {
        const dialog = document.getElementById(event.detail);
        if (dialog) close(dialog);
    });
    const lifetime = parseFloat(getComputedStyle(document.documentElement).getPropertyValue('--toast-life'));
    document.querySelectorAll('[data-toast][data-success="true"]').forEach(toast => setTimeout(() => toast.remove(), lifetime));
}
