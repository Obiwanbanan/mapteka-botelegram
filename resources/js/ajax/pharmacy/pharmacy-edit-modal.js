export function EditPharmacyModal() {
    const openBtns = document.querySelectorAll('.major__content-pharmacies .edit')
    const closeBtn = document.querySelector('.major__pharmacy-edit-modal-close')
    const modal = document.querySelector('.major__pharmacy-edit-modal')
    const overlay = document.querySelector('.major__content-organization-overlay')
    const registerBtn = modal.querySelector('button')

    openBtns.forEach((openBtn) => {
        if (openBtn) {
            openBtn.addEventListener('click', (e) => {
                const id = openBtn.getAttribute('id');
                const tr = e.target.parentElement.parentElement;
                const name = tr.querySelector('.name').textContent;
                const address = tr.querySelector('.address').textContent;

                const formName = modal.querySelector('#name')
                const formAddress= modal.querySelector('#address')

                modal.classList.add('active-modal')
                overlay.classList.add('active-modal')
                registerBtn.setAttribute('id', id)
                formName.value = name
                formAddress.value = address
            });
        }
        closeModalOrganization(closeBtn, modal, overlay)
        closeModalOrganization(overlay, modal, overlay)
        closeModalOrganization(registerBtn, modal, overlay)
    })
}
function closeModalOrganization(Btn, modal, overlay) {
    if (Btn) {
        Btn.addEventListener('click', () => {
            modal.classList.remove('active-modal')
            overlay.classList.remove('active-modal')
        })
    }
}
