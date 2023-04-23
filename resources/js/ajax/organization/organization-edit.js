import {organizationAddModal} from "./organization-add-modal";
import {ajaxPharmacies} from "../pharmacy/pharmacy-main";
import {ajaxAddOrganization} from "./organization-add";
import {ajaxSearchOrganization} from "./organization-search";

export function organizationEdit() {
    const btn = document.querySelector('.major__organization-edit-modal button')
    btn.addEventListener('click', () => {
        const csrf = document.querySelector('meta[name="_token"]').content;
        const majorContent = document.querySelector('.major__content')
        const form = document.querySelector('.major__organization-edit-modal')
        const name = form.querySelector('#name')
        const INN = form.querySelector('#INN')
        const select = form.querySelector('select')
        const botId = select.options[select.selectedIndex].id
        const pharmaciesHeader = document.querySelector('.major__content-pharmacies-header')
        const organizationId = pharmaciesHeader.getAttribute('data-id-organization');

        $.ajax({
            url: 'organization',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf
            },

            data: {
                "action": 'update',
                "page": 'organizations',
                "name": name.value,
                "INN": INN.value,
                "organizationId": organizationId,
                "botId": botId,
            },
            success: function (response) {
                majorContent.innerHTML = response.html
                ajaxAddOrganization()
                organizationAddModal()
                ajaxPharmacies()
                ajaxSearchOrganization()
            },
        });
    })
}
