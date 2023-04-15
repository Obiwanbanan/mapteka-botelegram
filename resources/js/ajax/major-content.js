import {ajaxAddOrganization} from "./organization-add";
import {organizationModal} from "./organization-modal";
import {ajaxPharmacies} from "./pharmacy-main";
import {ajaxSearchOrganization} from "./organization-search";

const majorMenuBtns = document.querySelectorAll('.major__menu-btn')
majorMenuBtns.forEach((majorMenuBtn) => {
    majorMenuBtn.addEventListener('click', () => {
        const csrf = document.querySelector('meta[name="_token"]').content;
        const menuBtnId = majorMenuBtn.getAttribute('id')
        const majorContent = document.querySelector('.major__content')
        activeMenu(majorMenuBtns, majorMenuBtn)

        $.ajax({
            url: '/organization',
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
                    ajaxSearchOrganization()
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

//
// function organizationModal() {
//     const openBtn = document.querySelector('.major__content-btn')
//     const closeBtn = document.querySelector('.major__content-organization-modal-close')
//     const modal = document.querySelector('.major__content-organization-modal')
//     const overlay = document.querySelector('.major__content-organization-overlay')
//     const registerBtn = modal.querySelector('button')
//
//     if (openBtn) {
//         openBtn.addEventListener('click', () => {
//             modal.classList.add('active-modal')
//             overlay.classList.add('active-modal')
//
//         });
//     }
//     closeModalOrganization(closeBtn, modal, overlay)
//     closeModalOrganization(overlay, modal, overlay)
//     closeModalOrganization(registerBtn, modal, overlay)
// }
//
// function closeModalOrganization(Btn, modal, overlay) {
//     if (Btn) {
//         Btn.addEventListener('click', () => {
//             modal.classList.remove('active-modal')
//             overlay.classList.remove('active-modal')
//         })
//     }
// }
//
// function ajaxAddOrganization() {
//     const addOrganizationBtn = document.querySelector('.major__content-organization-add button')
//     addOrganizationBtn.addEventListener('click', () => {
//         const csrf = document.querySelector('meta[name="_token"]').content;
//         const majorContent = document.querySelector('.major__content')
//         const form = document.querySelector('.major__content-organization-modal')
//         const action = form.querySelector('#action')
//         const page = form.querySelector('#page');
//         const organizationName = form.querySelector('#organization-name')
//         const organizationINN = form.querySelector('#organization-INN')
//
//         $.ajax({
//             url: '/organization/add',
//             method: 'POST',
//             headers: {
//                 'X-CSRF-TOKEN': csrf
//             },
//
//             data: {
//                 "action": action.value,
//                 "page": page.value,
//                 "organizationName": organizationName.value,
//                 "organizationINN": organizationINN.value,
//             },
//
//             success: function (response) {
//                 majorContent.innerHTML = response.html
//                 organizationModal()
//             },
//
//         });
//
//     })
// }
//
// function ajaxRemoveOrganization() {
//     const removeOrganizationBtn = document.querySelector('.major__content-pharmacies-header .remove')
//     removeOrganizationBtn.addEventListener('click', () => {
//         const csrf = document.querySelector('meta[name="_token"]').content;
//         const majorContent = document.querySelector('.major__content')
//         const pharmaciesHeader = document.querySelector('.major__content-pharmacies-header')
//         const organizationId = pharmaciesHeader.getAttribute('data-id-organization');
//         const action = pharmaciesHeader.querySelector('#action')
//         const page = pharmaciesHeader.querySelector('#page');
//
//         $.ajax({
//             url: '/organization/remove/' + organizationId,
//             method: 'POST',
//             headers: {
//                 'X-CSRF-TOKEN': csrf
//             },
//
//             data: {
//                 "action": action.value,
//                 "id": organizationId,
//                 "page": page.value,
//
//             },
//
//             success: function (response) {
//                 majorContent.innerHTML = response.html
//                 organizationModal()
//                 ajaxPharmacies()
//             },
//
//         });
//
//     })
// }
//
//
// function ajaxPharmacies() {
//     const organizations = document.querySelectorAll('.major__content-organization')
//     organizations.forEach((organization) => {
//         organization.addEventListener('click', () => {
//             const majorContent = document.querySelector('.major__content')
//             const csrf = document.querySelector('meta[name="_token"]').content;
//             const organizationId = organization.getAttribute('id');
//
//             $.ajax({
//                 url: 'organization/pharmacies',
//                 method: 'POST',
//                 headers: {
//                     'X-CSRF-TOKEN': csrf
//                 },
//
//                 data: {
//                     "organizationId": organizationId,
//                 },
//
//                 success: function (response) {
//                     majorContent.innerHTML = response.html
//                     ajaxRemoveOrganization()
//                     ajaxRemovePharmacy()
//                     ajaxEditPharmacy()
//                     EditPharmacyModal()
//                     ajaxAddPharmacy()
//                     pharmacyAddModal()
//                 },
//
//             });
//
//         })
//     })
// }

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

//
// function ajaxEditPharmacy() {
//     const editPharmacyBtn = document.querySelector('.major__pharmacy-edit-modal button')
//     editPharmacyBtn.addEventListener('click', () => {
//         const csrf = document.querySelector('meta[name="_token"]').content;
//         const majorContent = document.querySelector('.major__content')
//         const form = document.querySelector('.major__pharmacy-edit-modal')
//         const action = form.querySelector('#action')
//         const page = form.querySelector('#page');
//         const name = form.querySelector('#name')
//         const address = form.querySelector('#address')
//         const coordinate_X = form.querySelector('#coordinate_X')
//         const coordinate_Y = form.querySelector('#coordinate_Y')
//         const pharmaciesHeader = document.querySelector('.major__content-pharmacies-header')
//         const organizationId = pharmaciesHeader.getAttribute('data-id-organization');
//         const pharmacyId = editPharmacyBtn.getAttribute('id');
//
//         $.ajax({
//             url: 'organization/pharmacies',
//             method: 'POST',
//             headers: {
//                 'X-CSRF-TOKEN': csrf
//             },
//
//             data: {
//                 "action": action.value,
//                 "page": page.value,
//                 "name": name.value,
//                 "address": address.value,
//                 "coordinate_X": coordinate_X.value,
//                 "coordinate_Y": coordinate_Y.value,
//                 "organizationId": organizationId,
//                 "pharmacyId": pharmacyId,
//             },
//
//             success: function (response) {
//                 majorContent.innerHTML = response.html
//                 organizationModal()
//                 EditPharmacyModal()
//                 ajaxEditPharmacy()
//                 ajaxRemovePharmacy()
//             },
//
//         });
//
//     })
// }
//
// function EditPharmacyModal() {
//     const openBtns = document.querySelectorAll('.major__content-pharmacies .edit')
//     const closeBtn = document.querySelector('.major__pharmacy-edit-modal-close')
//     const modal = document.querySelector('.major__pharmacy-edit-modal')
//     const overlay = document.querySelector('.major__content-organization-overlay')
//     const registerBtn = modal.querySelector('button')
//
//
//     openBtns.forEach((openBtn) => {
//
//         if (openBtn) {
//             openBtn.addEventListener('click', (e) => {
//                 const id = openBtn.getAttribute('id');
//                 const tr = e.target.parentElement.parentElement;
//                 const name = tr.querySelector('.name').textContent;
//                 const address = tr.querySelector('.address').textContent;
//
//                 const formName = modal.querySelector('#name')
//                 const formAddress = modal.querySelector('#address')
//
//                 modal.classList.add('active-modal')
//                 overlay.classList.add('active-modal')
//                 registerBtn.setAttribute('id', id)
//                 formName.value = name
//                 formAddress.value = address
//             });
//         }
//         closeModalOrganization(closeBtn, modal, overlay)
//         closeModalOrganization(overlay, modal, overlay)
//         closeModalOrganization(registerBtn, modal, overlay)
//     })
//
//
// }
//
// function ajaxRemovePharmacy() {
//     const removePharmacyBtns = document.querySelectorAll('.major__content-pharmacies tbody .remove')
//     removePharmacyBtns.forEach((btn) => {
//         btn.addEventListener('click', () => {
//             const csrf = document.querySelector('meta[name="_token"]').content;
//             const majorContent = document.querySelector('.major__content')
//             const pharmaciesHeader = document.querySelector('.major__content-pharmacies-header')
//             const organizationId = pharmaciesHeader.getAttribute('data-id-organization');
//             const pharmacyId = btn.getAttribute('id');
//             const action = btn.querySelector('#action')
//             $.ajax({
//                 url: '/organization/pharmacies',
//                 method: 'POST',
//                 headers: {
//                     'X-CSRF-TOKEN': csrf
//                 },
//
//                 data: {
//                     "action": action.value,
//                     "pharmacyId": pharmacyId,
//                     "organizationId": organizationId,
//                 },
//
//                 success: function (response) {
//                     majorContent.innerHTML = response.html
//                     ajaxPharmacies()
//                     EditPharmacyModal()
//                     ajaxEditPharmacy()
//                     ajaxRemovePharmacy()
//                 },
//             });
//         })
//     })
// }
//
// function ajaxAddPharmacy() {
//     const addPharmacyBtn = document.querySelector('.major__pharmacy-add-modal button')
//     addPharmacyBtn.addEventListener('click', () => {
//         console.log('qweqwe')
//         const csrf = document.querySelector('meta[name="_token"]').content;
//         const majorContent = document.querySelector('.major__content')
//         const form = document.querySelector('.major__pharmacy-add-modal')
//         const pharmaciesHeader = document.querySelector('.major__content-pharmacies-header')
//         const organizationId = pharmaciesHeader.getAttribute('data-id-organization');
//         const name = form.querySelector('#pharmacy-name')
//         const address = form.querySelector('#pharmacy-address')
//         const coordinate_X = form.querySelector('#pharmacy-coordinate_X')
//         const coordinate_Y = form.querySelector('#pharmacy-coordinate_Y')
//         const action = form.querySelector('#action')
//         $.ajax({
//             url: '/organization/pharmacies',
//             method: 'POST',
//             headers: {
//                 'X-CSRF-TOKEN': csrf
//             },
//
//             data: {
//                 "action": action.value,
//                 "name": name.value,
//                 "address": address.value,
//                 "coordinate_X": coordinate_X.value,
//                 "coordinate_Y": coordinate_Y.value,
//                 "organizationId": organizationId,
//             },
//
//             success: function (response) {
//                 majorContent.innerHTML = response.html
//             },
//         });
//     })
// }
//
// function pharmacyAddModal() {
//     const openBtn = document.querySelector('.major__content-pharmacies-additional .add')
//     const closeBtn = document.querySelector('.major__pharmacy-add-modal-close')
//     const modal = document.querySelector('.major__pharmacy-add-modal')
//     const overlay = document.querySelector('.major__content-organization-overlay')
//     const registerBtn = modal.querySelector('button')
//
//     if (openBtn) {
//         openBtn.addEventListener('click', () => {
//             modal.classList.add('active-modal')
//             overlay.classList.add('active-modal')
//
//         });
//     }
//     closeModalOrganization(closeBtn, modal, overlay)
//     closeModalOrganization(overlay, modal, overlay)
//     closeModalOrganization(registerBtn, modal, overlay)
// }
