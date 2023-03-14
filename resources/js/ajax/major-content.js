const majorMenuBtns = document.querySelectorAll('.major__menu-btn')
majorMenuBtns.forEach((majorMenuBtn) => {
    majorMenuBtn.addEventListener('click', () => {
        const csrf = document.querySelector('meta[name="_token"]').content;
        const menuBtnId = majorMenuBtn.getAttribute('id')
        const majorContent = document.querySelector('.major__content')
        activeMenu(majorMenuBtns, majorMenuBtn)

        let url = '/' + menuBtnId
        $.ajax({
            url: url,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf
            },

            data: {
                "csrf_token": csrf,
                "page": menuBtnId
            },

            success: function (response) {
                majorContent.innerHTML = response.html
                if (menuBtnId === 'organizations') {
                    ajaxAddOrganization()
                    organizationModal()
                    ajaxPharmacies()

                }
            },

        });

    })
})

function activeMenu(majorMenuBtns, majorMenuBtn) {
    majorMenuBtns.forEach((btn) => {
        btn.classList.remove('active-menu')
    });
    majorMenuBtn.classList.add('active-menu')
}


function organizationModal() {
    const openBtn = document.querySelector('.major__content-btn')
    const closeBtn = document.querySelector('.major__content-organization-modal-close')
    const modal = document.querySelector('.major__content-organization-modal')
    const overlay = document.querySelector('.major__content-organization-overlay')
    const registerBtn = modal.querySelector('button')

    if (openBtn) {
        openBtn.addEventListener('click', () => {
            modal.classList.add('active-modal')
            overlay.classList.add('active-modal')

        });
    }
    closeModalOrganization(closeBtn, modal, overlay)
    closeModalOrganization(overlay, modal, overlay)
    closeModalOrganization(registerBtn, modal, overlay)

}

function closeModalOrganization(Btn, modal, overlay) {
    if (Btn) {
        Btn.addEventListener('click', () => {
            modal.classList.remove('active-modal')
            overlay.classList.remove('active-modal')
        })
    }
}

function ajaxAddOrganization() {
    const addOrganizationBtn = document.querySelector('.major__content-organization-add button')
    addOrganizationBtn.addEventListener('click', () => {
        const csrf = document.querySelector('meta[name="_token"]').content;
        const majorContent = document.querySelector('.major__content')
        const form = document.querySelector('.major__content-organization-modal')
        const action = form.querySelector('#action')
        const page = form.querySelector('#page');
        const organizationName = form.querySelector('#organization-name')
        const organizationINN = form.querySelector('#organization-INN')

        $.ajax({
            url: '/organization/add',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf
            },

            data: {
                "action": action.value,
                "page": page.value,
                "organizationName": organizationName.value,
                "organizationINN": organizationINN.value,
            },

            success: function (response) {
                majorContent.innerHTML = response.html
                organizationModal()
            },

        });

    })
}

function ajaxRemoveOrganization() {
    const removeOrganizationBtn = document.querySelector('.major__content-pharmacies-header button')
    removeOrganizationBtn.addEventListener('click', () => {
        const csrf = document.querySelector('meta[name="_token"]').content;
        const majorContent = document.querySelector('.major__content')
        const pharmaciesHeader = document.querySelector('.major__content-pharmacies-header')
        const organizationId = pharmaciesHeader.getAttribute('data-id-organization');
        const action = pharmaciesHeader.querySelector('#action')
        const page = pharmaciesHeader.querySelector('#page');

        $.ajax({
            url: '/organization/remove/' + organizationId,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf
            },

            data: {
                "action": action.value,
                "id": organizationId,
                "page": page.value,

            },

            success: function (response) {
                majorContent.innerHTML = response.html
                organizationModal()
                ajaxPharmacies()
            },

        });

    })
}



function ajaxPharmacies() {
    const organizations = document.querySelectorAll('.major__content-organization')
    organizations.forEach((organization) => {
        organization.addEventListener('click', () => {
            const majorContent = document.querySelector('.major__content')
            const csrf = document.querySelector('meta[name="_token"]').content;
            const organizationId = organization.getAttribute('id');

            $.ajax({
                url: '/organization/pharmacies/' + organizationId,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf
                },

                data: {
                    "id": organizationId,

                },

                success: function (response) {
                    majorContent.innerHTML = response.html
                    ajaxRemoveOrganization()
                },

            });

        })
    })
}

// function ajaxPaginateOrg() {
//     const organizations = document.querySelectorAll('.major__content-organization')
//     organizations.forEach((organization) => {
//         organization.addEventListener('click', () => {
//             const majorContent = document.querySelector('.major__content')
//             // const pagination = document.querySelector('.major__content-organization-pagination')
//             // const nextPage = pagination.querySelector('.next-page')
//             // const prevPage = pagination.querySelector('.prev-page')
//             const csrf = document.querySelector('meta[name="_token"]').content;
//             const organizationId = organization.getAttribute('id');
//             console.log(organizationId)
//
//             $.ajax({
//                 url: '/organization?page=' + pageNumber,
//                 method: 'POST',
//                 headers: {
//                     'X-CSRF-TOKEN': csrf
//                 },
//
//                 data: {
//                     "id": organizationId,
//
//                 },
//
//                 success: function (response) {
//                     majorContent.innerHTML = response.html
//
//                 },
//
//             });
//
//         })
//     })
// }
