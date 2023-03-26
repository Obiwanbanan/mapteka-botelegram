import {EditPharmacyModal} from "./pharmacy-modal";
import {ajaxRemovePharmacy} from "./pharmacy-remove";
import {pharmacyAddModal} from "./pharmacy-add-modal";
import {ajaxEditPharmacy} from "./pharmacy-edit";

export function ajaxAddPharmacy() {
    const addPharmacyBtn = document.querySelector('.major__pharmacy-add-modal button')
    addPharmacyBtn.addEventListener('click', () => {
        const csrf = document.querySelector('meta[name="_token"]').content;
        const majorContent = document.querySelector('.major__content')
        const form = document.querySelector('.major__pharmacy-add-modal')
        const pharmaciesHeader = document.querySelector('.major__content-pharmacies-header')
        const organizationId = pharmaciesHeader.getAttribute('data-id-organization');
        const name = form.querySelector('#pharmacy-name')
        const address = form.querySelector('#pharmacy-address')
        const coordinate_X = form.querySelector('#pharmacy-coordinate_X')
        const coordinate_Y = form.querySelector('#pharmacy-coordinate_Y')
        const action = form.querySelector('#action')
        $.ajax({
            url: '/organization/pharmacies',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf
            },

            data: {
                "action": action.value,
                "name": name.value,
                "address": address.value,
                "coordinate_X": coordinate_X.value,
                "coordinate_Y": coordinate_Y.value,
                "organizationId": organizationId,
            },

            success: function (response) {
                majorContent.innerHTML = response.html
                EditPharmacyModal()
                ajaxEditPharmacy()
                ajaxRemovePharmacy()
                ajaxAddPharmacy()
                pharmacyAddModal()
            },
        });
    })
}
