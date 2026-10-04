import { readFile, readdir, writeFile } from 'node:fs/promises';
import { join } from 'node:path';

async function sources(directory) {
    const entries = await readdir(directory, { withFileTypes: true });
    const groups = await Promise.all(entries.map(entry => {
        const path = join(directory, entry.name);
        return entry.isDirectory() ? sources(path) : /\.(js|blade\.php)$/.test(path) ? readFile(path, 'utf8').then(text => [text]) : [];
    }));
    return groups.flat();
}

const selection = JSON.parse(await readFile('node_modules/@phosphor-icons/web/src/regular/selection.json', 'utf8'));
const content = (await sources('resources')).join('\n');
const names = new Set(['wallet', 'spinner', 'coin']);
for (const match of content.matchAll(/["'`]([a-z][a-z0-9-]*)["'`]/g)) names.add(match[1]);
for (const match of content.matchAll(/ph-([a-z][a-z0-9-]*)/g)) names.add(match[1]);
const icons = selection.icons.filter(icon => names.has(icon.properties.name));
const rules = icons.map(({ properties }) => `.ph.ph-${properties.name}::before { content: "\\${properties.code.toString(16)}"; }`).join('\n');
const base = `@font-face { font-family: Phosphor; src: url('../../node_modules/@phosphor-icons/web/src/regular/Phosphor.woff2') format('woff2'); font-weight: normal; font-style: normal; font-display: swap; }
.ph { font-family: Phosphor !important; font-style: normal; font-weight: normal; font-variant: normal; text-transform: none; line-height: 1; letter-spacing: 0; font-feature-settings: 'liga'; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }
`;
await writeFile('resources/css/phosphor.css', base + rules + '\n');
