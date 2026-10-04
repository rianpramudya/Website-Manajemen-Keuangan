import './bootstrap';
import '@fontsource/plus-jakarta-sans/400.css';
import '@fontsource/plus-jakarta-sans/500.css';
import '@fontsource/plus-jakarta-sans/600.css';
import '@fontsource/plus-jakarta-sans/700.css';
import '@fontsource/plus-jakarta-sans/800.css';
import '@phosphor-icons/web/regular';
import Alpine from 'alpinejs';
import { initializeForms } from './ui/forms';
import { initializeDialogs } from './ui/dialogs';

import { initializeCountUp } from './ui/count-up';
import { initializeReveal } from './ui/reveal';
import { initializeProgress } from './ui/progress';
import { initializePocketSearch } from './ui/pockets';

import { registerBillTable, initializeBillFilter } from './ui/bill-table';
import { initializeFinanceEvents } from './ui/finance-events';

registerBillTable(Alpine);
window.Alpine = Alpine;
Alpine.start();
initializeFinanceEvents();
initializeForms();
initializeDialogs();
initializeCountUp();
initializeReveal();
initializeProgress();
initializePocketSearch();
initializeBillFilter();
