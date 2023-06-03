class ChatBots {
    constructor() {
        this.inputId = document.querySelector('.chatbots__fields #id');
        this.selectBots = document.querySelector('#select-chatbots');
        this.inputName = document.querySelector('.chatbots__fields #name');
        this.inputToken = document.querySelector('.chatbots__fields #token');
        this.inputUrl = document.querySelector('.chatbots__fields #url');
        this.status = document.querySelector('.chatbots__status span');

        this.init();
    }

    init() {
        this.add()
        this.edit()
        this.remove()
        this.choice()
    }

    add() {
        const addBotButton = document.querySelector('.chat-bots-add button');

        addBotButton && addBotButton.addEventListener('click', async () => {
            const response = await fetch('/chat-bots/add', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': window.csrf
                },
                body: new FormData(document.querySelector('.chat-bots-add form')),
            });
            const resp = await response.json();

            if (!resp.status) {
                iziToast.error({
                    message: resp.message,
                    position: 'topRight',
                });

                return;
            }

            window.location.href = resp.url;
        })
    }

    edit() {
        const editBotButton = document.querySelector('.chatbots__edit button');

        editBotButton && editBotButton.addEventListener('click', async () => {
            const inputs = document.querySelectorAll('.chatbots__fields input');
            if (editBotButton.textContent.trim() === "Редактирвать") {
                editBotButton.textContent = "Сохранить";
                inputs.forEach((input) => {
                    input.disabled = false;
                })

                return;
            }

            const formData = new FormData(document.querySelector('.chatbots__body-wrapper form'));

            const response = await fetch(`/chat-bots/update`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': window.csrf
                },
                body: formData,
            });
            const resp = await response.json();

            if (!resp.status) {
                iziToast.error({
                    message: resp.message,
                    position: 'topRight',
                });

                return;
            }

            editBotButton.textContent = "Редактирвать"
            inputs.forEach((input) => {
                input.disabled = true;
            })

            this.updateOptionInSelect(formData)

            iziToast.success({
                message: 'Чат бот успешно отредактирован',
                position: 'topRight',
            });
        })
    }

    remove() {
        const buttonRemove = document.querySelector('.chatbots__remove button');

        buttonRemove && buttonRemove.addEventListener('click', async () => {
            const response = await fetch('/chat-bots/remove', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': window.csrf,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({id: this.inputId.value})
            });
            const resp = await response.json();

            if (!resp.status) {
                iziToast.error({
                    message: resp.message,
                    position: 'topRight',
                });

                return;
            }

            const selectedOption = this.getSelectedOptionById(this.inputId.value);
            selectedOption.remove()
            const firstOption = this.getFirstSelectOption();
            firstOption.selected = true;
            this.setDataOption(firstOption)

            iziToast.success({
                message: resp.message,
                position: 'topRight',
            });
        })
    }

    choice() {
        this.selectBots && this.selectBots.addEventListener('change', (e) => {
            const selectedOption = e.target.selectedOptions[0];
            this.setDataOption(selectedOption)
        })
    }

    setDataOption(option) {
        const {name, token, url, webhook, id} = option.dataset;

        this.inputName.value = name;
        this.inputToken.value = token;
        this.inputUrl.value = url;
        this.inputId.value = id;
        this.status.textContent = !!Number(webhook) ? 'Активный' : 'Неактивный';
    }

    updateOptionInSelect(formData) {
        const selectOption = this.getSelectedOptionById(formData.get('id'))

        selectOption.dataset.name = formData.get('name');
        selectOption.dataset.token = formData.get('token');
        selectOption.dataset.url = formData.get('url');
        selectOption.text = formData.get('name');
        selectOption.value = formData.get('name');
    }

    getSelectedOptionById(id) {
        return Array.from(this.selectBots.options).find((opt) => opt.dataset.id === id);
    }

    getFirstSelectOption() {
        return this.selectBots.querySelector('option:not([value=""])');
    }
}

new ChatBots();
