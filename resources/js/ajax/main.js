// import {ajaxAddOrganization} from "./organization/organization-add";
// import {organizationAddModal} from "./organization/organization-add-modal";
// import {ajaxPharmacies} from "./pharmacy/pharmacy-main";
// import {ajaxSearchOrganization} from "./organization/organization-search";
// import {chatbotsMain} from "./chatbots/chatbots-main";
//
// const majorMenuBtns = document.querySelectorAll('.major__menu-btn')
// majorMenuBtns.forEach((majorMenuBtn) => {
//     majorMenuBtn.addEventListener('click', () => {
//         const csrf = document.querySelector('meta[name="_token"]').content;
//         const menuBtnId = majorMenuBtn.getAttribute('id')
//         const majorContent = document.querySelector('.major__content')
//         activeMenu(majorMenuBtns, majorMenuBtn)
//
//         $.ajax({
//             url: '/menu',
//             method: 'POST',
//             headers: {
//                 'X-CSRF-TOKEN': csrf
//             },
//
//             data: {
//                 "csrf_token": csrf,
//                 "page": menuBtnId
//             },
//
//             success: function (response) {
//                 majorContent.innerHTML = response.html
//                 if (menuBtnId === 'organizations') {
//                     ajaxAddOrganization()
//                     organizationAddModal()
//                     ajaxPharmacies()
//                     ajaxSearchOrganization()
//                 }
//                 if (menuBtnId === 'chatbots') {
//                     chatbotsMain()
//                 }
//
//
//             },
//         });
//     })
// })
//
// function activeMenu(majorMenuBtns, majorMenuBtn) {
//     majorMenuBtns.forEach((btn) => {
//         btn.classList.remove('active-menu')
//     });
//     majorMenuBtn.classList.add('active-menu')
// }
//


