import { scheduleFrame } from './frames';
export function initializeDialogs() {
    const triggers = new WeakMap();
    const close = dialog => {
        if (!dialog || !dialog.open || dialog.classList.contains('is-closing')) return;
        let completed = false, timeout;
        const finish = () => {
            if (completed) return;
            completed = true; clearTimeout(timeout);
            dialog.close(); dialog.classList.remove('is-closing'); triggers.get(dialog)?.focus();
        };
        if (matchMedia('(prefers-reduced-motion: reduce)').matches) { finish(); return; }
        dialog.classList.add('is-closing');
        dialog.addEventListener('animationend', finish, { once: true });
        timeout = setTimeout(finish, parseFloat(getComputedStyle(document.documentElement).getPropertyValue('--dur-fast')));
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
        const handle = dialog.querySelector('.dialog-handle');
        let startY = null;
        handle?.addEventListener('pointerdown', event => { if (!matchMedia('(max-width: 767px)').matches) return; startY = event.clientY; handle.setPointerCapture(event.pointerId); });
        handle?.addEventListener('pointermove', event => { if (startY === null) return; const distance = Math.max(0, event.clientY - startY); dialog.style.transform = `translateY(${distance}px)`; });
        handle?.addEventListener('pointerup', event => { if (startY === null) return; const distance = event.clientY - startY; startY = null; dialog.style.transform = ''; if (distance > parseFloat(getComputedStyle(document.documentElement).getPropertyValue('--space-8'))) close(dialog); });
        handle?.addEventListener('pointercancel', () => { startY = null; dialog.style.transform = ''; });
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
    document.querySelectorAll('[data-toast][data-success="true"]').forEach(toast => {
        let remaining = lifetime, started = performance.now(), timer, paused = true;
        const start = () => { if (!paused || toast.matches(':hover') || toast.contains(document.activeElement)) return; paused = false; started = performance.now(); toast.classList.remove('toast-paused'); timer = setTimeout(() => toast.remove(), remaining); };
        const pause = () => { if (paused) return; paused = true; clearTimeout(timer); remaining -= performance.now() - started; toast.classList.add('toast-paused'); };
        toast.addEventListener('pointerenter', pause); toast.addEventListener('pointerleave', start);
        toast.addEventListener('focusin', pause); toast.addEventListener('focusout', start);
        start();
    });
    const updateViewport = () => {
        const keyboard = window.visualViewport ? Math.max(0, innerHeight - window.visualViewport.height - window.visualViewport.offsetTop) : 0;
        document.documentElement.style.setProperty('--keyboard-offset', `${keyboard}px`);
        document.body.classList.toggle('keyboard-open', keyboard > parseFloat(getComputedStyle(document.documentElement).getPropertyValue('--nav-height')));
        return false;
    };
    window.visualViewport?.addEventListener('resize', () => scheduleFrame(updateViewport));
}
