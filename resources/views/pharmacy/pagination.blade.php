<div class="pharmacy-cards-wrapper">
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
            @foreach($pharmaciess as $key => $pharmacy)
                <tr>
                    <td> {{ $key + 1 }} </td>
                    <td class="name"> {{ $pharmacy->name }} </td>
                    <td class="address"> {{ $pharmacy->address }} </td>
                    <td>
                        <a href="{{ $pharmacy->map_url }}" class="custom-btn map">Карта</a>
                        <button class="custom-btn edit" id="{{ $pharmacy->id }}">Редактирвать</button>
                        <button class="custom-btn remove" id="{{ $pharmacy->id }}">Удалить
                            <input id="action" type="hidden" name="action" value="remove">
                            <input id="page" type="hidden" name="page" value="organizations">
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
    @include('pagination.custom')
</div>
