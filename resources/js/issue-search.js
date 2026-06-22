export function initIssueSearch() {
    const input = document.getElementById('issue-search');
    const list = document.getElementById('issues-list');
    const statusSelect = document.getElementById('filter-status');
    const prioritySelect = document.getElementById('filter-priority');
    const tagSelect = document.getElementById('filter-tag');

    if (!input || !list) {
        return;
    }

    let debounceTimer;

    const fetchResults = () => {
        const params = new URLSearchParams({
            q: input.value,
            status: statusSelect?.value ?? '',
            priority: prioritySelect?.value ?? '',
            tag: tagSelect?.value ?? '',
        });

        fetch(`/issues?${params.toString()}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
        })
            .then((response) => response.text())
            .then((html) => {
                list.innerHTML = html;
            });
    };

    input.addEventListener('input', () => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(fetchResults, 350);
    });

    [statusSelect, prioritySelect, tagSelect].forEach((select) => {
        select?.addEventListener('change', fetchResults);
    });
}
