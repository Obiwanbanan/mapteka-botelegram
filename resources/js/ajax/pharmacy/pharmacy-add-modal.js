export function pharmacyAddModal() {
    const openBtn = document.querySelector('.major__content-pharmacies-additional .add')
    const closeBtn = document.querySelector('.major__pharmacy-add-modal-close')
    const modal = document.querySelector('.major__pharmacy-add-modal')
    const overlay = document.querySelector('.major__content-organization-overlay')
    const registerBtn = modal.querySelector('button')

    if (openBtn) {
        openBtn.addEventListener('click', () => {
            modal.classList.add('active-modal')
            overlay.classList.add('active-modal')

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
