export function initializeForms() {
    document.querySelectorAll('[data-money-input]').forEach(input => {
        const format = () => {
            const raw = input.value.replaceAll('.', '');
            if (/^-?\d+$/.test(raw)) input.value = raw.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        };
        input.addEventListener('input', format);
        format();
    });
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', event => {
            if (event.defaultPrevented) return;
            form.querySelectorAll('[data-money-input]').forEach(input => { input.value = input.value.replaceAll('.', ''); });
            const button = event.submitter;
            if (button && !button.hasAttribute('data-no-loading')) {
                const label = button.querySelector('[data-button-label]');
                if (label) label.textContent = 'Menyimpan…';
                button.setAttribute('aria-busy', 'true');
                queueMicrotask(() => { button.disabled = true; });
            }
        });
    });
}
