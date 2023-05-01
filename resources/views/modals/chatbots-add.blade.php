<div class="major__content-add-bot-modal modal">
    <div class="major__content--add-bot">
        <h2>
            Добавить телеграм бота
        </h2>
        <span class="major__content-add-bot-close">
           <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="32" height="32" viewBox="0 0 32 32">
            <path
                d="M16 0c-8.837 0-16 7.163-16 16s7.163 16 16 16 16-7.163 16-16-7.163-16-16-16zM16 29c-7.18 0-13-5.82-13-13s5.82-13 13-13 13 5.82 13 13-5.82 13-13 13z"/>
            <path d="M21 8l-5 5-5-5-3 3 5 5-5 5 3 3 5-5 5 5 3-3-5-5 5-5z"/>
            </svg>
        </span>
        <input class="input" id="action" type="hidden" name="action" value="add">
        <input class="input" id="page" type="hidden" name="page" value="settings">
        <input class="input" id="name" type="text" name="name" placeholder="Имя">
        <input class="input" id="token" type="text" name="token" placeholder="Токен">
        <input class="input" id="url" type="text" name="url" placeholder="Url вебхук">

        <button class="btn">
            {{ __('Добавить') }}
        </button>
    </div>
</div>
