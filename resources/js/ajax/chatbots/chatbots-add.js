class ChatBotsAdd {
    constructor() {
        this.button = document.querySelector('.major__content--add-bot button');

        this.init()
    }

    init() {
        this.button && this.button.addEventListener('click', () => {
            const csrf = document.querySelector('meta[name="_token"]').content;
            const majorContent = document.querySelector('.major__content')
            const form = document.querySelector('.major__content--add-bot')
            const action = form.querySelector('#action')
            const name = form.querySelector('#name')
            const token = form.querySelector('#token')
            const url = form.querySelector('#url')

            $.ajax({
                url: 'chat-bots/add',
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': csrf
                },

                data: {
                    "action": action.value,
                    "name": name.value,
                    "token": token.value,
                    "url": url.value,
                },

                success: function (response) {
                    majorContent.innerHTML = response.html
                },
            });
        })
    }
}

new ChatBotsAdd()

