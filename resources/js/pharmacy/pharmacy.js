class Pharmacy {
    constructor() {
        this.cardsWrapper = document.querySelector('.pharmacy-cards-wrapper');
        this.searchInput = document.querySelector('.major__content-pharmacies-search #search');
        this.organizationId = this.searchInput?.dataset.organizationId;
        this.page = 1;

        this.init();
    }

    init() {
        this.add()
        this.remove()
        this.pagination()
        this.search()
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

    async ajaxPaginationWithParam() {
        console.log(window.csrf)
        const response = await fetch(`/pharmacies/pagination-with-param`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': window.csrf,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                page: this.page,
                search: this.searchInput.value,
                organizationId: this.organizationId
            })
        });
        const resp = await response.json();

        this.cardsWrapper.innerHTML = resp.result;
    }

    pagination() {
        const paginationItem = document.querySelectorAll('.pharmacy-cards-wrapper .pagination .page-item')

        paginationItem && paginationItem.forEach((item) => {
            item.addEventListener('click', async () => {
                if (item.classList.contains('disabled')) {
                    return;
                }

                if (item.classList.contains('prev')) {
                    this.page = this.page - 1;
                }

                if (item.classList.contains('next')) {
                    this.page = this.page + 1;
                }

                if (!item.classList.contains('next') && !item.classList.contains('prev') && !item.classList.contains('dots')) {
                    this.page = Number(item.textContent.trim());
                }

                await this.ajaxPaginationWithParam()
                this.pagination();
            })
        })
    }

    search() {
        this.searchInput && this.searchInput.addEventListener('input', () => {
            clearTimeout(this.timer);

            this.timer = setTimeout(async () => {
                await this.ajaxPaginationWithParam();
                this.pagination()
            }, 400);
        });
    }
}

new Pharmacy();
