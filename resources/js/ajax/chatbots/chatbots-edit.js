import {removeBot} from "./chatbots-remove";

export function editBot() {
    const edit = document.querySelector('.chatbots__edit button')

    if (edit) {
        edit.addEventListener('click', (e) => {
            const fields = document.querySelector('.chatbots__fields')
            const buttons = document.querySelector('.chatbots__buttons')
            const name = fields.querySelector('#name')
            const token = fields.querySelector('#token')
            const url = fields.querySelector('#url')
            const cancel = document.querySelector('.chatbots__buttons-cancel')
            const accept = document.querySelector('.chatbots__buttons-accept')

            name.removeAttribute('disabled');
            token.removeAttribute('disabled');
            url.removeAttribute('disabled');
            buttons.classList.add('active')

            if (cancel) {
                disabledButtons(cancel, name, token, url, buttons)
            }

            if (accept) {
                disabledButtons(accept, name, token, url, buttons)
                updateAjax(accept, name, token, url)
            }
        })
    }
}

function disabledButtons(
    cancel,
    name,
    token,
    url,
    buttons
) {
    cancel.addEventListener('click', (e) => {
        name.disabled = true;
        token.disabled = true;
        url.disabled = true;
        buttons.classList.remove('active')
    })
}

function updateAjax(
    accept,
    name,
    token,
    url
) {
    accept.addEventListener('click', (e) => {
        const csrf = document.querySelector('meta[name="_token"]').content;
        const majorContent = document.querySelector('.major__content')
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
                "name": name.value,
                "token": token.value,
                "url": url.value,
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
