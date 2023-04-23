import {choiceBot} from "./chatbots-choice";
import {removeBot} from "./chatbots-remove";

export function editBot() {
    const edit = document.querySelector('.chatbots__edit button')

    if (edit) {
        edit.addEventListener('click', (e) => {
            const fields = document.querySelector('.chatbots__fields')
            const buttons = document.querySelector('.chatbots__buttons')
            const name = fields.querySelector('#name')
            const token = fields.querySelector('#token')
            const cancel = document.querySelector('.chatbots__buttons-cancel')
            const accept = document.querySelector('.chatbots__buttons-accept')

            name.removeAttribute('disabled');
            token.removeAttribute('disabled');
            buttons.classList.add('active')

            if (cancel) {
                disabledButtons(cancel, name, token, buttons)
            }

            if (accept) {
                disabledButtons(accept, name, token, buttons)
                updateAjax(accept, name, token)
            }
        })
    }
}

function disabledButtons(
    cancel,
    name,
    token,
    buttons
) {
    cancel.addEventListener('click', (e) => {
        name.disabled = true;
        token.disabled = true;
        buttons.classList.remove('active')
    })
}

function updateAjax(
    accept,
    name,
    token
) {
    accept.addEventListener('click', (e) => {
        const csrf = document.querySelector('meta[name="_token"]').content;
        const majorContent = document.querySelector('.major__content')
        const nameValue = name.value
        const tokenValue = token.value
        const selectBots = document.querySelector('.chatbots__choice select')
        const botId = selectBots.options[selectBots.selectedIndex].id

        $.ajax({
            url: 'chatBots',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf
            },

            data: {
                "page": 'chatbots',
                "action": 'update',
                "name": nameValue,
                "token": tokenValue,
                "botId": botId,
            },

            success: function (response) {
                majorContent.innerHTML = response.html
                choiceBot()
                editBot()
                removeBot()
            },
        });
    })


}
