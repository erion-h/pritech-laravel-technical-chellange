import Alpine from 'alpinejs';
import { initIssueTags } from './issue-tags';
import { initComments } from './comments';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    initIssueTags();
    initComments();
});
