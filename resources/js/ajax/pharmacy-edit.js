import {organizationModal} from "./organization-modal";
import {EditPharmacyModal} from "./pharmacy-modal";
import {ajaxRemovePharmacy} from "./pharmacy-remove";
import {ajaxAddPharmacy} from "./pharmacy-add";
import {pharmacyAddModal} from "./pharmacy-add-modal";

export function ajaxEditPharmacy() {
    const editPharmacyBtn = document.querySelector('.major__pharmacy-edit-modal button')
    editPharmacyBtn.addEventListener('click', () => {
        const csrf = document.querySelector('meta[name="_token"]').content;
        const majorContent = document.querySelector('.major__content')
        const form = document.querySelector('.major__pharmacy-edit-modal')
        const action = form.querySelector('#action')
        const page = form.querySelector('#page');
        const name = form.querySelector('#name')
        const address = form.querySelector('#address')
        const coordinate_X = form.querySelector('#coordinate_X')
        const coordinate_Y = form.querySelector('#coordinate_Y')
        const pharmaciesHeader = document.querySelector('.major__content-pharmacies-header')
        const organizationId = pharmaciesHeader.getAttribute('data-id-organization');
        const pharmacyId = editPharmacyBtn.getAttribute('id');

        $.ajax({
            url: 'organization/pharmacies',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf
            },

            data: {
                "action": action.value,
                "page": page.value,
                "name": name.value,
                "address": address.value,
                "coordinate_X": coordinate_X.value,
                "coordinate_Y": coordinate_Y.value,
                "organizationId": organizationId,
                "pharmacyId": pharmacyId,
            },
            success: function (response) {
                majorContent.innerHTML = response.html
                organizationModal()
                EditPharmacyModal()
                ajaxEditPharmacy()
                ajaxRemovePharmacy()
                ajaxAddPharmacy()
                pharmacyAddModal()
            },
        });
    })
}
