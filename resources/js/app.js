import Alpine from 'alpinejs';
import { initIssueTags } from './issue-tags';
import { initIssueMembers } from './issue-members';
import { initComments } from './comments';
import { initIssueSearch } from './issue-search';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    initIssueTags();
    initIssueMembers();
    initComments();
    initIssueSearch();
});
