function csrfToken() {
    return document.querySelector('meta[name="csrf-token"]').content;
}

export function initIssueTags() {
    const form = document.getElementById('attach-tag-form');
    const list = document.getElementById('tags-list');

    if (!form || !list) {
        return;
    }

    const issueId = form.dataset.issueId;
    const select = document.getElementById('attach-tag-select');

    form.addEventListener('submit', (event) => {
        event.preventDefault();

        const tagId = select.value;
        if (!tagId) {
            return;
        }

        fetch(`/issues/${issueId}/tags`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken(),
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ tag_id: tagId }),
        })
            .then((response) => response.json())
            .then(({ html }) => {
                list.querySelector('[data-empty-placeholder]')?.remove();
                list.insertAdjacentHTML('beforeend', html);
                select.querySelector(`option[value="${tagId}"]`).disabled = true;
                select.value = '';
            });
    });

    list.addEventListener('click', (event) => {
        const button = event.target.closest('[data-detach-tag]');
        if (!button) {
            return;
        }

        const tagId = button.dataset.tagId;

        fetch(`/issues/${issueId}/tags/${tagId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken(),
                'Accept': 'application/json',
            },
        }).then((response) => {
            if (response.ok) {
                button.closest('[data-tag-chip]').remove();
                const option = select.querySelector(`option[value="${tagId}"]`);
                if (option) {
                    option.disabled = false;
                }
                if (!list.querySelector('[data-tag-chip]')) {
                    list.insertAdjacentHTML('afterbegin', `<span class="text-sm text-gray-500" data-empty-placeholder>${list.dataset.emptyText}</span>`);
                }
            }
        });
    });
}
