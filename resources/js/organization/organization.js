class Organization {
    constructor() {
        this.inputOrganizationId = document.querySelector('#organization-id');
        this.init();
    }

    init() {
        this.edit()
        this.remove()
    }


    edit() {
        const editButton = document.querySelector('.major__organization-edit-form button');

        editButton && editButton.addEventListener('click', async () => {
            const formData = new FormData(document.querySelector('.major__organization-edit-form'));

            const response = await fetch(`/organization/${this.inputOrganizationId.value}/update`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': window.csrf
                },
                body: formData,
            });
            const resp = await response.json();

            if (!resp.status) {
                iziToast.error({
                    message: resp.message,
                    position: 'topRight',
                });

                return;
            }

            iziToast.success({
                message: resp.message,
                position: 'topRight',
            });
        })
    }

    remove() {
        const removeButton = document.querySelector('#major__organization-remove');
        removeButton && removeButton.addEventListener('click', async () => {

            const response = await fetch(`/organization/remove`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': window.csrf,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({id: this.inputOrganizationId.value})
            });
            const resp = await response.json();

            if (!resp.status) {
                iziToast.error({
                    message: resp.message,
                    position: 'topRight',
                });

                return;
            }

            window.location.href = resp.url;
        })
    }
}

new Organization();
