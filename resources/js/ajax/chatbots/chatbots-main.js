import {addBotModal} from "./chatbots-modal";
import {addBot} from "./chatbots-add";
import {editBot} from "./chatbots-edit";
import {removeBot} from "./chatbots-remove";

export function chatbotsMain() {
    const csrf = document.querySelector('meta[name="_token"]').content;
    const majorContent = document.querySelector('.major__content')

    $.ajax({
        url: 'chatBots',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrf
        },

        data: {
            "page": 'chatbots',
        },

        success: function (response) {
            majorContent.innerHTML = response.html
            addBotModal()
            addBot()
            choiceBot()
            editBot()
            removeBot()
        },
    });
}
