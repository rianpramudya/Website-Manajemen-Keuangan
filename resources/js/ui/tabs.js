import { transitionUpdate } from './transitions';
export function initializeTabs() {
    document.querySelectorAll('[data-tabs]').forEach(group => {
        const list = group.querySelector('[data-tab-list]');
        const buttons = [...list.querySelectorAll('[data-tab]')];
        const panels = [...group.querySelectorAll('[data-tab-panel]')];
        const activate = index => {
            buttons.forEach((button, i) => { button.setAttribute('aria-selected', String(i === index)); button.tabIndex = i === index ? 0 : -1; });
            panels.forEach((panel, i) => { panel.hidden = i !== index; });
        };
        list.hidden = false; list.setAttribute('role', 'tablist');
        buttons.forEach((button, index) => {
            button.setAttribute('role', 'tab');
            panels[index].setAttribute('role', 'tabpanel');
            button.addEventListener('click', () => transitionUpdate(() => activate(index), group));
            button.addEventListener('keydown', event => {
                const offset = event.key === 'ArrowRight' ? 1 : event.key === 'ArrowLeft' ? -1 : 0;
                if (!offset && !['Home', 'End'].includes(event.key)) return;
                event.preventDefault();
                const next = event.key === 'Home' ? 0 : event.key === 'End' ? buttons.length - 1 : (index + offset + buttons.length) % buttons.length;
                activate(next); buttons[next].focus();
            });
        });
        const desktop = matchMedia('(min-width: 1024px)');
        const resize = () => { if (desktop.matches) { list.hidden = true; panels.forEach(panel => panel.hidden = false); } else { list.hidden = false; activate(0); } };
        desktop.addEventListener('change', resize); resize();
    });
}
