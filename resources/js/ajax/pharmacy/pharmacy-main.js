import {EditPharmacyModal} from "./pharmacy-modal";
import {ajaxRemovePharmacy} from "./pharmacy-remove";
import {ajaxEditPharmacy} from "./pharmacy-edit";
import {ajaxAddPharmacy} from "./pharmacy-add";
import {pharmacyAddModal} from "./pharmacy-add-modal";
import {ajaxRemoveOrganization} from "../organization/organization-remove";
import {ajaxSearchPharmacy} from "./pharmacy-search";

export function ajaxPharmacies() {
    const organizations = document.querySelectorAll('.major__content-organization')
    organizations.forEach((organization) => {
        organization.addEventListener('click', () => {
            const majorContent = document.querySelector('.major__content')
            const csrf = document.querySelector('meta[name="_token"]').content;
            const organizationId = organization.getAttribute('id');

            $.ajax({
                url: 'organization/pharmacies',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf
                },

                data: {
                    "organizationId": organizationId,
                },

                success: function (response) {
                    majorContent.innerHTML = response.html
                    ajaxPharmacies()
                    EditPharmacyModal()
                    ajaxRemovePharmacy()
                    ajaxRemoveOrganization()
                    ajaxEditPharmacy()
                    ajaxAddPharmacy()
                    pharmacyAddModal()
                    ajaxSearchPharmacy()
                },
            });
        })
    })
}

