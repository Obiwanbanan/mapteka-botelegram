import {organizationAddModal} from "./organization-add-modal";
import {ajaxPharmacies} from "../pharmacy/pharmacy-main";

export function ajaxAddOrganization() {
    const addOrganizationBtn = document.querySelector('.major__content-organization-add button')
    addOrganizationBtn.addEventListener('click', () => {
        const csrf = document.querySelector('meta[name="_token"]').content;
        const majorContent = document.querySelector('.major__content')
        const form = document.querySelector('.major__content-organization-modal')
        const action = form.querySelector('#action')
        const page = form.querySelector('#page');
        const organizationName = form.querySelector('#organization-name')
        const organizationINN = form.querySelector('#organization-INN')
        const selectBots = form.querySelector('select')
        const botId = selectBots.options[selectBots.selectedIndex].id

        $.ajax({
            url: '/organization',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf
            },

            data: {
                "action": action.value,
                "page": page.value,
                "organizationName": organizationName.value,
                "organizationINN": organizationINN.value,
                "botId": botId,
            },

            success: function (response) {
                majorContent.innerHTML = response.html
                organizationAddModal()
                ajaxAddOrganization()
                ajaxPharmacies()
            },

        });

    })
}
