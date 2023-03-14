<div class="footer">
        <h5 class="footer-copyright">
            © All rights reserved
        </h5>
</div>

<div class="major__content-organization-modal">
    <div class="major__content-organization-add">
        <span class="major__content-organization-modal-close">
           <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="32" height="32" viewBox="0 0 32 32">
            <path
                d="M16 0c-8.837 0-16 7.163-16 16s7.163 16 16 16 16-7.163 16-16-7.163-16-16-16zM16 29c-7.18 0-13-5.82-13-13s5.82-13 13-13 13 5.82 13 13-5.82 13-13 13z"/>
            <path d="M21 8l-5 5-5-5-3 3 5 5-5 5 3 3 5-5 5 5 3-3-5-5 5-5z"/>
            </svg>
        </span>
        <input id="action" type="hidden" name="action" value="add">
        <input id="page" type="hidden" name="page" value="organizations">
        <input id="organization-name" type="text" name="organization-name" placeholder="Organization Name">
        <input id="organization-INN" type="text" name="organization-INN" placeholder="Organization INN">

        <button class="btn">
            {{ __('Register') }}
        </button>
    </div>
</div>

<div class="major__content-organization-overlay"></div>
