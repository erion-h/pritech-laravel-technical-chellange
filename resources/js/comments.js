function csrfToken() {
    return document.querySelector('meta[name="csrf-token"]').content;
}

function clearErrors(form) {
    form.querySelectorAll('[data-error-for]').forEach((el) => {
        el.textContent = '';
    });
}

function showErrors(form, errors) {
    Object.entries(errors).forEach(([field, messages]) => {
        const el = form.querySelector(`[data-error-for="${field}"]`);
        if (el) {
            el.textContent = messages[0];
        }
    });
}

export function initComments() {
    const form = document.getElementById('comment-form');
    const list = document.getElementById('comments-list');

    if (!form || !list) {
        return;
    }

    form.addEventListener('submit', (event) => {
        event.preventDefault();
        clearErrors(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken(),
                'Accept': 'application/json',
            },
            body: new FormData(form),
        })
            .then(async (response) => {
                if (response.status === 422) {
                    const { errors } = await response.json();
                    showErrors(form, errors);
                    return;
                }

                const { html } = await response.json();
                list.querySelector('[data-empty-placeholder]')?.remove();
                let container = list.querySelector('.space-y-4');
                if (!container) {
                    container = document.createElement('div');
                    container.className = 'space-y-4';
                    list.prepend(container);
                }
                container.insertAdjacentHTML('afterbegin', html);
                form.reset();
            });
    });
}
