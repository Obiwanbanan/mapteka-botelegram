export function organizationEditModal() {
    const openBtn = document.querySelector('.major__content-pharmacies-actions .edit')
    const closeBtn = document.querySelector('.major__organization-edit-modal-close')
    const modal = document.querySelector('.major__organization-edit-modal')
    const overlay = document.querySelector('.major__content-organization-overlay')
    const registerBtn = modal.querySelector('button')

    if (openBtn) {
        openBtn.addEventListener('click', () => {
            const pharmaciesWrapper = document.querySelector('.major__content-pharmacies-wrapper')
            const name = pharmaciesWrapper.querySelector('h1').textContent
            const INN = pharmaciesWrapper.querySelector('.major__content-pharmacies-inn').textContent
            const botName = pharmaciesWrapper.querySelector('.major__content-pharmacies-botname').textContent


            const formName = modal.querySelector('#name')
            const formINN= modal.querySelector('#INN')
            const formSelect = modal.querySelector('select')

            modal.classList.add('active-modal')
            overlay.classList.add('active-modal')

            formSelect.value = botName.trim()
            formName.value = name.trim()
            formINN.value = INN.trim()

        });
    }
    closeModalOrganization(closeBtn, modal, overlay)
    closeModalOrganization(overlay, modal, overlay)
    closeModalOrganization(registerBtn, modal, overlay)
}

function closeModalOrganization(Btn, modal, overlay) {
    if (Btn) {
        Btn.addEventListener('click', () => {
            modal.classList.remove('active-modal')
            overlay.classList.remove('active-modal')
        })
    }
}
