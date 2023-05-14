class ChatBotsChoice {
    constructor() {
        this.selectBots = document.querySelector('.chatbots__choice select');
        this.name = document.querySelector('.chatbots__fields #name');
        this.token = document.querySelector('.chatbots__fields #token');
        this.url = document.querySelector('.chatbots__fields #url');
        this.status = document.querySelector('.chatbots__status span');
        this.init()
    }

    init() {
        this.selectBots && this.selectBots.addEventListener('change', (e) => {
            const selectedOption = e.target.selectedOptions[0];
            const {name, token, url, webhook} = selectedOption.dataset;

            this.name.value = name;
            this.token.value = token;
            this.url.value = url;
            this.status.textContent = !!Number(webhook) ? 'Активный' : 'Неактивный';
        })
    }
}

new ChatBotsChoice()
