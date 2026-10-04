export function initializeDeletion() {
    document.querySelectorAll('form[data-remove-id], form[data-finance-event="delete-bill"]').forEach(form => {
        form.addEventListener('submit', async event => {
            event.preventDefault();
            const button = event.submitter;
            if (button?.disabled) return;
            const body = new FormData(form);
            if (button) { button.disabled = true; button.setAttribute('aria-busy', 'true'); }
            try {
                const response = await fetch(form.action, { method: 'POST', body, credentials: 'same-origin', headers: { Accept: 'text/html' } });
                const html = new DOMParser().parseFromString(await response.text(), 'text/html');
                const success = html.querySelector('[data-toast][data-success="true"]');
                if (!response.ok || !success) {
                    const error = html.querySelector('[role="alert"]');
                    const feedback = document.createElement('p');
                    feedback.className = 'field-error';
                    feedback.setAttribute('role', 'alert');
                    feedback.textContent = error?.textContent || 'Penghapusan belum terkonfirmasi. Periksa kembali daftar sebelum mencoba lagi.';
                    form.append(feedback);
                    return;
                }
                const message = success.querySelector('p')?.textContent;
                try { sessionStorage.setItem('dompet-confirmed-delete', message); } catch {}
                const row = form.dataset.removeId ? document.querySelector(`[data-transaction-id="${form.dataset.removeId}"]`) : document.querySelector(`[data-bill-id="${form.dataset.billId}"]:not(form)`);
                const dialog = form.closest('dialog');
                dialog?.close();
                if (row && !matchMedia('(prefers-reduced-motion: reduce)').matches) {
                    const tokens = getComputedStyle(document.documentElement);
                    await row.animate([{ opacity: 1, transform: 'scale(1)' }, { opacity: 0, transform: `scale(${tokens.getPropertyValue('--press-scale')})` }], { duration: parseFloat(tokens.getPropertyValue('--dur-base')), easing: tokens.getPropertyValue('--ease-in') }).finished;
                }
                location.assign(response.url);
            } catch {
                const feedback = document.createElement('p');
                feedback.className = 'field-error';
                feedback.setAttribute('role', 'alert');
                feedback.textContent = 'Koneksi terputus. Periksa daftar untuk memastikan status penghapusan.';
                form.append(feedback);
            } finally {
                if (button) { button.disabled = false; button.removeAttribute('aria-busy'); }
            }
        });
    });
    let message;
    try { message = sessionStorage.getItem('dompet-confirmed-delete'); sessionStorage.removeItem('dompet-confirmed-delete'); } catch {}
    if (message && !document.querySelector('[data-toast]')) {
        const toast = document.createElement('div');
        toast.className = 'toast toast-success';
        toast.setAttribute('role', 'status');
        toast.setAttribute('aria-live', 'polite');
        toast.dataset.toast = '';
        toast.dataset.success = 'true';
        const content = document.createElement('p');
        content.textContent = message;
        const close = document.createElement('button');
        close.className = 'btn btn-tertiary';
        close.dataset.dismissToast = '';
        close.textContent = 'Tutup';
        close.setAttribute('aria-label', 'Tutup pemberitahuan');
        toast.append(content, close);
        document.body.append(toast);
    }
}
