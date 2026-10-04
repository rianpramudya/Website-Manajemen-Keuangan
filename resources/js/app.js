import './bootstrap';
import '@fontsource/plus-jakarta-sans/latin-400.css';
import '@fontsource/plus-jakarta-sans/latin-500.css';
import '@fontsource/plus-jakarta-sans/latin-600.css';
import '@fontsource/plus-jakarta-sans/latin-700.css';
import '@fontsource/plus-jakarta-sans/latin-800.css';
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
import { initializeLanding } from './ui/landing';

import { initializeDeletion } from './ui/deletion';

window.Alpine = Alpine;
initializeDeletion();
initializeFinanceEvents();
initializeForms();
initializeDialogs();
Alpine.start();
initializeCountUp();
initializeReveal();
initializeProgress();
initializePocketSearch();
initializeBillFilter();
initializeLanding();

import { initializeNavigation } from './ui/navigation';
initializeNavigation();

import { initializeTilt } from './ui/tilt';
initializeTilt();
