import {organizationModal} from "./organization-modal";
import {EditPharmacyModal} from "./pharmacy-modal";
import {ajaxRemovePharmacy} from "./pharmacy-remove";
import {ajaxAddPharmacy} from "./pharmacy-add";
import {pharmacyAddModal} from "./pharmacy-add-modal";
import {ajaxEditPharmacy} from "./pharmacy-edit";


export function ajaxSearchPharmacy() {
    const btn = document.querySelector('.major__content-pharmacies-search button')
    btn.addEventListener('click', () => {
        const csrf = document.querySelector('meta[name="_token"]').content;
        const majorContent = document.querySelector('.major__content')
        const form = document.querySelector('.major__content-pharmacies-search')
        const action = form.querySelector('#action')
        const search = form.querySelector('#search')
        const pharmaciesHeader = document.querySelector('.major__content-pharmacies-header')
        const organizationId = pharmaciesHeader.getAttribute('data-id-organization');
        console.log(organizationId)

        $.ajax({
            url: 'organization/pharmacies',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf
            },

            data: {
                "action": action.value,
                "search": search.value,
                "page": 'pharmacy',
                "organizationId": organizationId,
            },

            success: function (response) {
                majorContent.innerHTML = response.html
                organizationModal()
                EditPharmacyModal()
                ajaxEditPharmacy()
                ajaxRemovePharmacy()
                ajaxAddPharmacy()
                pharmacyAddModal()
                ajaxSearchPharmacy()
            },

        });

    })
}
