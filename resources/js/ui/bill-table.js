export function registerBillTable(Alpine) {
    Alpine.data('billTable', (rows, date) => ({
        paymentDate: date,
        rows,
        toggleAll(event) { this.rows.forEach(row => row.selected = event.target.checked); },
        updateAmountFromPercent(row) {
            let pct = parseFloat(row.percent);
            if (isNaN(pct) || pct < 0) pct = 0;
            row.pay_amount = Math.round((pct / 100) * row.original_total);
        },
        updatePercentFromAmount(row) {
            let amt = parseFloat(row.pay_amount);
            if (isNaN(amt) || amt < 0) amt = 0;
            row.percent = row.original_total > 0 ? parseFloat(((amt / row.original_total) * 100).toFixed(1)) : 0;
        },
        calculateRemaining(row) { return Math.max(0, row.original_total - (row.pay_amount || 0)); },
        getStatusText(row) {
            const remaining = this.calculateRemaining(row);
            if (remaining <= 0) return 'Lunas';
            if (row.pay_amount > 0 && remaining < row.original_total) return 'Sebagian';
            return 'Belum lunas';
        },
        get grandTotal() { return this.rows.filter(row => row.selected).reduce((sum, row) => sum + (parseInt(row.pay_amount) || 0), 0); },
        formatNumber(num) { return new Intl.NumberFormat('id-ID').format(num); },
    }));
}
export function initializeBillFilter() {
    document.querySelector('[data-bill-filter]')?.addEventListener('change', event => {
        let visible = 0;
        document.querySelectorAll('[data-bill-frequency]').forEach(card => {
            card.hidden = event.target.value !== 'all' && card.dataset.billFrequency !== event.target.value;
            if (!card.hidden) visible++;
        });
        document.querySelector('[data-bill-no-results]').hidden = visible > 0;
    });
}
