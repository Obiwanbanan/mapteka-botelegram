<div class="major__content-organization-header">
    <h1>
        Организации
    </h1>
    <button class="major__content-btn custom-btn">
        Добавить организацию
    </button>
</div>
<div class="major__content-organization-additional">
    <div class="major__content-organization-search">
        <input class="input" id='search' type="text" placeholder="Введите имя или инн">
        <input class="input" id="action" type="hidden" name="action" value="search">
        <button class="custom-btn">
            Поиск
        </button>
    </div>
</div>


@include('modals.organization-add')
