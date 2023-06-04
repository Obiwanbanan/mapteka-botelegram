@extends('layouts.layout')
@extends('major-menu')

@section('major-content')
    <div class="major__organization-edit-modal ">
        <div class="major__content-organization-edit-modal">
            <h2>
                Редактирвать организацию {{ $organization->name }}
            </h2>
            <span class="major__organization-edit-modal-close">
               <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="32" height="32" viewBox="0 0 32 32">
                    <path
                        d="M16 0c-8.837 0-16 7.163-16 16s7.163 16 16 16 16-7.163 16-16-7.163-16-16-16zM16 29c-7.18 0-13-5.82-13-13s5.82-13 13-13 13 5.82 13 13-5.82 13-13 13z"/>
                    <path d="M21 8l-5 5-5-5-3 3 5 5-5 5 3 3 5-5 5 5 3-3-5-5 5-5z"/>
                </svg>
            </span>
            <div class="major__organization-edit-section">
                <form class="major__organization-edit-form" method="POST"
                      action="{{ route('organization-update', ['id' => $organization['id']]) }}">
                    <input type="hidden" id="organization-id" name="id" value="{{ $organization->id }}">
                    <label>Имя организации</label>
                    <input class="input" id="name" type="text" name="name" placeholder="Имя"
                           value="{{$organization['name']}}">
                    <label>ИНН организации</label>
                    <input class="input" id="INN" type="text" name="INN" placeholder="INN"
                           value="{{$organization['INN']}}">
                    <label>Бот организации</label>
                    <select name="botId">
                        @foreach($chatBots as $chatBot)
                            <option value="{{ $chatBot->id }}"
                                    @if($chatBot->id === $organization['bot_id'])
                                        selected
                                @endif
                            >
                                {{ $chatBot->name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="button" class="custom-btn">
                        Обновить организацию
                    </button>
                </form>

                <button id="major__organization-remove" type="button" class="custom-btn">
                    Удалить организацию
                </button>
            </div>
        </div>
    </div>
    <h2 class="major__pharmacies-title">
        Аптеки {{ $organization->name }}
    </h2>
    <div class="major__content-pharmacies-additional">
        <div class="major__content-pharmacies-search">
            <input class="input" id='search' type="text" placeholder="Search">
            <input class="input" id="action" type="hidden" name="action" value="search">
            <button class="custom-btn">
                Поиск
            </button>
        </div>
        <button class="major__content-btn add custom-btn ">
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
                        <button class="custom-btn map">Карта</button>
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

    {{--    @include('modals.pharmacy-edit')--}}
    {{--    @include('modals.pharmacy-add')--}}
    {{--        @include('modals.edit')--}}
    {{--    @include('modals.edit')--}}

@endsection
