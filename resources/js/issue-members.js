function csrfToken() {
    return document.querySelector('meta[name="csrf-token"]').content;
}

export function initIssueMembers() {
    const form = document.getElementById('attach-member-form');
    const list = document.getElementById('members-list');

    if (!form || !list) {
        return;
    }

    const issueId = form.dataset.issueId;
    const select = document.getElementById('attach-member-select');

    form.addEventListener('submit', (event) => {
        event.preventDefault();

        const userId = select.value;
        if (!userId) {
            return;
        }

        fetch(`/issues/${issueId}/members`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken(),
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ user_id: userId }),
        })
            .then((response) => response.json())
            .then(({ html }) => {
                list.querySelector('[data-empty-placeholder]')?.remove();
                list.insertAdjacentHTML('beforeend', html);
                select.querySelector(`option[value="${userId}"]`).disabled = true;
                select.value = '';
            });
    });

    list.addEventListener('click', (event) => {
        const button = event.target.closest('[data-detach-member]');
        if (!button) {
            return;
        }

        const userId = button.dataset.userId;

        fetch(`/issues/${issueId}/members/${userId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken(),
                'Accept': 'application/json',
            },
        }).then((response) => {
            if (response.ok) {
                button.closest('[data-member-chip]').remove();
                const option = select.querySelector(`option[value="${userId}"]`);
                if (option) {
                    option.disabled = false;
                }
                if (!list.querySelector('[data-member-chip]')) {
                    list.insertAdjacentHTML('afterbegin', `<span class="text-sm text-gray-500" data-empty-placeholder>${list.dataset.emptyText}</span>`);
                }
            }
        });
    });
}
