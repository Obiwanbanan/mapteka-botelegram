import {ajaxAddOrganization} from "./organization-add";
import {organizationAddModal} from "./organization-add-modal";
import {ajaxPharmacies} from "../pharmacy/pharmacy-main";

class Search {
    constructor() {
        this.url = '/organization/search';
        this.button = document.querySelector('.major__content-organization-search button');
        this.searchInput = document.querySelector('.major__content-organization-search #search');
        this.csrf = document.querySelector('meta[name="_token"]').content;


        this.init()
    }

    init() {
        this.search()
    }



    search() {
        if (this.searchInput) {
            this.searchInput.addEventListener('input', () => {
                clearTimeout(this.timer);

                this.timer = setTimeout(() => {
                    this.ajaxFilterOrSearch();
                }, 400);
            });

            this.searchButton && this.searchButton.addEventListener('click', () => {
                this.ajaxFilterOrSearch();
            })
        }

    }



    ajaxFilterOrSearch() {
        $.ajax({
            url: this.url,
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': this.csrf
            },

            data: {
                "search": this.searchInput.value,
                "action": 'search',
            },
            success: function (response) {
                console.log(response)
            },
        });
    }
}

new Search();
