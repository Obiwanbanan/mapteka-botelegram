import {organizationAddModal} from "./organization-add-modal";
import {ajaxPharmacies} from "../pharmacy/pharmacy-main";
import {ajaxAddOrganization} from "./organization-add";

export function ajaxSearchOrganization() {
    const btn = document.querySelector('.major__content-organization-search button')
    btn.addEventListener('click', () => {
        const csrf = document.querySelector('meta[name="_token"]').content;
        const majorContent = document.querySelector('.major__content')
        const form = document.querySelector('.major__content-organization-search')
        const action = form.querySelector('#action')
        const search = form.querySelector('#search')

        $.ajax({
            url: '/organization',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf
            },

            data: {
                "action": action.value,
                "search": search.value,
                "page": 'organizations',
            },

            success: function (response) {
                majorContent.innerHTML = response.html
                organizationAddModal()
                ajaxAddOrganization()
                ajaxPharmacies()
                ajaxSearchOrganization()
            },

        });

    })
}