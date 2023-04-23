import {addBotModal} from "./chatbots-add-modal";
import {choiceBot} from "./chatbots-choice";
import {editBot} from "./chatbots-edit";

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
                url: 'chatBots',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf
                },

                data: {
                    "page": 'chatbots',
                    "action": action.value,
                    "name": name.value,
                    "username": username.value,
                    "token": token.value,
                },

                success: function (response) {
                    majorContent.innerHTML = response.html
                    addBot()
                    addBotModal()
                    choiceBot()
                    editBot()
                },
            });
        })
    }
}
