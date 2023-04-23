import {addBotModal} from "./chatbots-add-modal";
import {addBot} from "./chatbots-add";

export function choiceBot() {
    const  selectBots = document.querySelector('.chatbots__choice select')
    if (selectBots) {
                selectBots.addEventListener('change', (e) => {
                    const csrf = document.querySelector('meta[name="_token"]').content;
                    const botId = selectBots.options[selectBots.selectedIndex].id
                    const body = document.querySelector('.chatbots__body')

                    $.ajax({
                        url: 'chatBots',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrf
                        },

                        data: {
                            "page": 'chatbots-body',
                            "action": 'choice',
                            "botId": botId,
                        },

                        success: function (response) {
                            body.innerHTML = response.html
                            addBotModal()
                            addBot()
                        },
                    });
                })
            }
}
