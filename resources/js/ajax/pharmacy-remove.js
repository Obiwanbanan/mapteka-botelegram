import {ajaxRemoveOrganization} from "./organization-remove";
import {ajaxEditPharmacy} from "./pharmacy-edit";
import {EditPharmacyModal} from "./pharmacy-modal";
import {ajaxAddPharmacy} from "./pharmacy-add";
import {pharmacyAddModal} from "./pharmacy-add-modal";

export function ajaxRemovePharmacy() {
    const removePharmacyBtns = document.querySelectorAll('.major__content-pharmacies tbody .remove')
    removePharmacyBtns.forEach((btn) => {
        btn.addEventListener('click', () => {
            const csrf = document.querySelector('meta[name="_token"]').content;
            const majorContent = document.querySelector('.major__content')
            const pharmaciesHeader = document.querySelector('.major__content-pharmacies-header')
            const organizationId = pharmaciesHeader.getAttribute('data-id-organization');
            const pharmacyId = btn.getAttribute('id');
            const action = btn.querySelector('#action')
            $.ajax({
                url: '/organization/pharmacies',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf
                },

                data: {
                    "action": action.value,
                    "pharmacyId": pharmacyId,
                    "organizationId": organizationId,
                },

                success: function (response) {
                    majorContent.innerHTML = response.html
                    ajaxRemoveOrganization()
                    ajaxRemovePharmacy()
                    ajaxEditPharmacy()
                    EditPharmacyModal()
                    ajaxAddPharmacy()
                    pharmacyAddModal()
                },
            });
        })
    })
}
