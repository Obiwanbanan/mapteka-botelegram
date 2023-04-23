import {organizationModal} from "./organization-modal";
import {ajaxPharmacies} from "../pharmacy/pharmacy-main";
import {ajaxAddOrganization} from "./organization-add";

export function ajaxRemoveOrganization() {
    const removeOrganizationBtn = document.querySelector('.major__content-pharmacies-header .remove')
    removeOrganizationBtn.addEventListener('click', () => {
        const csrf = document.querySelector('meta[name="_token"]').content;
        const majorContent = document.querySelector('.major__content')
        const pharmaciesHeader = document.querySelector('.major__content-pharmacies-header')
        const organizationId = pharmaciesHeader.getAttribute('data-id-organization');
        const action = pharmaciesHeader.querySelector('#action')
        const page = pharmaciesHeader.querySelector('#page');

        $.ajax({
            url: '/organization',
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
                ajaxAddOrganization()
                ajaxPharmacies()
            },

        });

    })
}
