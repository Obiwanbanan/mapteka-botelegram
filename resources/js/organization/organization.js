class Organization {
    constructor() {
        this.inputOrganizationId = document.querySelector('#organization-id');
        this.cardsWrapper = document.querySelector('.organization-cards-wrapper');
        this.searchInput = document.querySelector('.major__content-organization-search #search');
        this.page = 1;
        this.init();
    }

    init() {
        this.edit()
        this.remove()
        this.pagination()
        this.search()
    }

    async ajaxPaginationWithParam() {
        const response = await fetch(`/organization/pagination-with-param`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': window.csrf,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                page: this.page,
                search: this.searchInput.value,
            })
        });
        const resp = await response.json();

        this.cardsWrapper.innerHTML = resp.result;
    }

    pagination() {
        const paginationItem = document.querySelectorAll('.pagination .page-item')

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
