<div class="major__pharmacy-add-modal modal">
    <div class="major__content-pharmacy-add-modal">
        <h2>
            Добавить аптеку
        </h2>
        <span class="major__pharmacy-add-modal-close">
           <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="32" height="32" viewBox="0 0 32 32">
            <path
                d="M16 0c-8.837 0-16 7.163-16 16s7.163 16 16 16 16-7.163 16-16-7.163-16-16-16zM16 29c-7.18 0-13-5.82-13-13s5.82-13 13-13 13 5.82 13 13-5.82 13-13 13z"/>
            <path d="M21 8l-5 5-5-5-3 3 5 5-5 5 3 3 5-5 5 5 3-3-5-5 5-5z"/>
            </svg>
        </span>
        <input class="input" id="action" type="hidden" name="action" value="add">
        <input class="input" id="page" type="hidden" name="page" value="pharmacy">
        <input class="input" id="pharmacy-name" type="text" name="pharmacy-name" placeholder="Имя">
        <input class="input" id="pharmacy-address" type="text" name="pharmacy-address" placeholder="Адрес">
        <input class="input" id="pharmacy-coordinate_X" type="text" name="coordinate_X"
               placeholder="Долгота">
        <input class="input" id="pharmacy-coordinate_Y" type="text" name="coordinate_Y"
               placeholder="Широта">

        <button class="custom-btn">
            {{ __('Добавить') }}
        </button>
    </div>
</div>
