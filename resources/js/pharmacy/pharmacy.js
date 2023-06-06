class Pharmacy {
    constructor() {
        this.init();
    }

    init() {
        this.add()
        this.remove()
    }


    add() {
        const addButton = document.querySelector('.major__pharmacy-add button');

        addButton && addButton.addEventListener('click', async () => {
            const formData = new FormData(document.querySelector('.major__pharmacy-add form'));

            const response = await fetch(`/pharmacies/add`, {
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
            window.location.href = resp.url;
        })
    }

    remove() {
        const removeButtons = document.querySelectorAll('.major__content-pharmacies .remove');
        removeButtons && removeButtons.forEach((removeButton) => {
            removeButton && removeButton.addEventListener('click', async () => {
                const response = await fetch(`/pharmacies/remove`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': window.csrf,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({id: removeButton.id})
                });
                const resp = await response.json();

                if (!resp.status) {
                    iziToast.error({
                        message: resp.message,
                        position: 'topRight',
                    });

                    return;
                }

                const tr = removeButton.closest('tr');
                if (tr) {
                    tr.remove();
                }
                iziToast.success({
                    message: resp.message,
                    position: 'topRight',
                });
            })
        })
    }
}

new Pharmacy();
