import {addBotModal} from "./settings-add-bot-modal";

export function addBot() {
    const btn = document.querySelector('.major__content-add-bot-modal button')
    if (btn) {
        btn.addEventListener('click', () => {
            const csrf = document.querySelector('meta[name="_token"]').content;
            const majorContent = document.querySelector('.major__content')
            const form = document.querySelector('.major__content--add-bot')
            const action = form.querySelector('#action')
            const name = form.querySelector('#name')
            const username = form.querySelector('#username')
            const token = form.querySelector('#token')
            $.ajax({
                url: 'settings',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf
                },

                data: {
                    "page": 'settings',
                    "action": action.value,
                    "name": name.value,
                    "username": username.value,
                    "token": token.value,
                },

                success: function (response) {
                    majorContent.innerHTML = response.html
                    addBot()
                    addBotModal()
                },
            });
        })
    }
}
