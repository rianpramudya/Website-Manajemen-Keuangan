import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

export default {
    safelist: ['badge-success', 'badge-danger', 'badge-warning', 'badge-info', 'badge-neutral'],
    content: ['./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php', './storage/framework/views/*.php', './resources/views/**/*.blade.php', './resources/js/**/*.js'],
    theme: { extend: {
        fontFamily: { sans: ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans] },
        colors: Object.fromEntries(['bg', 'surface', 'text', 'muted', 'border', 'control-border', 'primary', 'primary-hover', 'on-primary', 'primary-soft', 'accent', 'on-accent', 'success', 'success-soft', 'warning', 'warning-soft', 'danger', 'danger-soft', 'info', 'info-soft', 'focus'].map(name => [name, `var(--color-${name})`])),
        borderRadius: { control: 'var(--radius-control)', card: 'var(--radius-card)', modal: 'var(--radius-modal)' },
        boxShadow: { card: 'var(--shadow-card)', overlay: 'var(--shadow-overlay)' },
        transitionDuration: { fast: 'var(--dur-fast)', base: 'var(--dur-base)', slow: 'var(--dur-slow)', moment: 'var(--dur-moment)' },
        transitionTimingFunction: { out: 'var(--ease-out)', in: 'var(--ease-in)', spring: 'var(--ease-spring)' },
    } },
    plugins: [forms],
};
