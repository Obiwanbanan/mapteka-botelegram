@extends('layouts.layout')
@extends('major-menu')
@section('major-content')
    <div class="major__pharmacy-edit">
        <h2>
            Редактирвать аптеку {{ $pharmacy->name }}
        </h2>
        <form>
            <input type="hidden" name="id" id="id" value="{{ $pharmacy->id }}">
            <label for="">Организация для аптеки</label>
            <select name="selected-organization">
                @foreach($organizations as $organization)
                    <option value="{{ $organization->id }}" {{ $organization->id == $pharmacy->organization_id ? 'selected' : '' }}>
                        {{ $organization->name }}
                    </option>
                @endforeach
            </select>
            <label for="">Название аптеки</label>
            <input class="input" id="name" type="text" name="name" value="{{ $pharmacy->name }}">
            <label for="">Город аптеки</label>
            <select name="selected-city">
                @foreach($cities as $city)
                    <option value="{{ $city->id }}" {{ $city->id == $pharmacy->city_id ? 'selected' : '' }}>
                        {{ $city->name }}
                    </option>
                @endforeach
            </select>
            <label for="">Адрес аптеки</label>
            <input class="input" id="address" type="text" name="address" value="{{ $pharmacy->address }}">
            <label for="">Ссылка на яндекс карту</label>
            <input class="input" id="map" type="text" name="map" value="{{ $pharmacy->map_url }}">

            <button type="button" class="custom-btn" type="button" id="{{ $pharmacy->organization_id }}">
                {{ __('Обновить') }}
            </button>
        </form>
    </div>
@endsection
