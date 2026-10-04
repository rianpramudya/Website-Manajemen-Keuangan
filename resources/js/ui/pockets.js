import { transitionUpdate } from './transitions';
export function initializePocketSearch() {
    const search = document.querySelector('[data-pocket-search]');
    if (!search) return;
    search.addEventListener('input', () => transitionUpdate(() => {
        let visible = 0;
        document.querySelectorAll('[data-search-name]').forEach(card => {
            card.hidden = !card.dataset.searchName.toLocaleLowerCase('id').includes(search.value.toLocaleLowerCase('id'));
            if (!card.hidden) visible++;
        });
        document.querySelector('[data-pocket-no-results]').hidden = visible > 0 || !search.value;
    }, document.querySelector('[data-pocket-grid]')));
}
