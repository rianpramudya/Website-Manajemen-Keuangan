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

window.Alpine = Alpine;
Alpine.start();
initializeForms();
initializeDialogs();
