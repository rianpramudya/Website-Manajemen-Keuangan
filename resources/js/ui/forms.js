export function initializeForms() {
    document.querySelectorAll('[data-money-input]').forEach(input => {
        const format = () => {
            const [integer, fraction] = input.value.replaceAll('.', '').split(',');
            if (/^-?\d*$/.test(integer)) input.value = integer.replace(/\B(?=(\d{3})+(?!\d))/g, '.') + (fraction !== undefined ? `,${fraction}` : '');
        };
        input.value = input.value.replace('.', ',');
        input.addEventListener('input', format);
        format();
    });
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', event => {
            if (event.defaultPrevented) return;
            try {
                const dialog = form.closest('dialog');
                if (dialog) sessionStorage.setItem('dompet-form-dialog', dialog.id);
                else sessionStorage.removeItem('dompet-form-dialog');
            } catch {}
            form.querySelectorAll('[data-money-input]').forEach(input => { input.value = input.value.replaceAll('.', '').replace(',', '.'); });
            const button = event.submitter;
            if (button && !button.hasAttribute('data-no-loading')) {
                const label = button.querySelector('[data-button-label]');
                if (label) label.textContent = 'Menyimpan…';
                const icon = button.querySelector('.ph');
                if (icon) { icon.className = 'ph ph-spinner loading-indicator'; icon.setAttribute('aria-hidden', 'true'); }
                button.setAttribute('aria-busy', 'true');
                queueMicrotask(() => { button.disabled = true; });
            }
        });
    });
}
