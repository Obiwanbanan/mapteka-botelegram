import {addBotModal} from "./chatbots-add-modal";
import {choiceBot} from "./chatbots-choice";
import {editBot} from "./chatbots-edit";
import {addBot} from "./chatbots-add";

export function removeBot() {
    const btn = document.querySelector('.chatbots__remove button')
    if (btn) {
        btn.addEventListener('click', () => {
            const csrf = document.querySelector('meta[name="_token"]').content;
            const majorContent = document.querySelector('.major__content')
            const selectBots = document.querySelector('.chatbots__choice select')
            const botId = selectBots.options[selectBots.selectedIndex].value

            $.ajax({
                url: 'chatBots',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf
                },

                data: {
                    "page": 'chatbots',
                    "action": 'remove',
                    "botId": botId,
                },

                success: function (response) {
                    majorContent.innerHTML = response.html
                    addBot()
                    addBotModal()
                    choiceBot()
                    editBot()
                    removeBot()
                },
            });
        })
    }
}
