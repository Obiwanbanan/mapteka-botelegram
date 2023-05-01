<div class="major__content-pharmacies-header"
     data-id-organization="{{ $organization->id ?? '' }}"
     data-id-bot="{{ $organization->bot->id ?? ''}}"
>

    <div class="major__content-pharmacies-wrapper">
        <h1>
            {{ $organization->name ?? ''}}
        </h1>
        <div class="major__content-pharmacies-info">
            @if(!empty($organization->INN))
                <div class="major__content-pharmacies-inn">
                    {{ $organization->INN }}
                </div>
            @endif
            @if(!empty($organization->bot->name))
                <div class="major__content-pharmacies-botname">
                    {{ $organization->bot->name }}
                </div>
            @endif
        </div>

    </div>
    <div class="major__content-pharmacies-actions">
        <button class="major__content-btn edit btn">
            Редактирвать организацию
            <input id="action" type="hidden" name="action">
            <input id="page" type="hidden" name="page" value="organizations">
        </button>

        <button class="major__content-btn remove btn">
            Удалить организацию
            <input id="action" type="hidden" name="action">
            <input id="page" type="hidden" name="page" value="organizations">
        </button>
    </div>

</div>
<div class="major__content-pharmacies-additional">
    <div class="major__content-pharmacies-search">
        <input class="input" id='search' type="text" placeholder="Search">
        <input class="input" id="action" type="hidden" name="action" value="search">
        <button class="btn">
            Поиск
        </button>
    </div>
    <button class="major__content-btn add btn ">
        Добавить аптеку
    </button>
</div>
<div class="major__content-pharmacies">
    <table>
        <thead>
        <tr>
            <td>
                №
            </td>
            <td>
                Имя
            </td>
            <td>
                Адрес
            </td>
            <td>
                Действия
            </td>

        </tr>
        </thead>
        <tbody>
        @foreach($pharmacies as $key => $pharmacy)
            <tr>
                <td> {{ $key + 1 }} </td>
                <td class="name"> {{ $pharmacy->name }} </td>
                <td class="address"> {{ $pharmacy->address }} </td>
                <td>
                    <button class="btn map">Карта</button>
                    <button class="btn edit" id="{{ $pharmacy->id }}">Редактирвать</button>
                    <button class="btn remove" id="{{ $pharmacy->id }}">Удалить
                        <input id="action" type="hidden" name="action" value="remove">
                        <input id="page" type="hidden" name="page" value="organizations">
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>

@include('modals.pharmacy-edit')
@include('modals.pharmacy-add')
@include('modals.organization-edit')
