import Alpine from 'alpinejs';
import { initIssueTags } from './issue-tags';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    initIssueTags();
});
