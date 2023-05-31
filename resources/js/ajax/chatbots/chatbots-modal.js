class BotModal {
    constructor() {
        this.openBtn = document.querySelector('.chatbots__add button');
        this.closeBtn = document.querySelector('.major__content-add-bot-close');
        this.modal = document.querySelector('.major__content-add-bot-modal');
        this.overlay = document.querySelector('.major__content-organization-overlay');
        this.registerBtn = this.modal.querySelector('button');

        this.init();
    }

    init() {
        if (this.openBtn) {
            this.openBtn.addEventListener('click', () => {
                this.showModal();
            });
        }

        this.closeModal(this.closeBtn);
        this.closeModal(this.overlay);
        this.closeModal(this.registerBtn);
    }

    showModal() {
        this.modal.classList.add('active-modal');
        this.overlay.classList.add('active-modal');
    }

    closeModal(btn) {
        if (btn) {
            btn.addEventListener('click', () => {
                this.modal.classList.remove('active-modal');
                this.overlay.classList.remove('active-modal');
            });
        }
    }
}

new BotModal();
