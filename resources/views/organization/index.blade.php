@extends('layouts.layout')
@extends('major-menu')

@section('major-content')
    <div class="major__content-organization-header">
        <h1>
            Организации
        </h1>
        <a href="{{ route('organization-add') }}" class="major__content-btn custom-btn">
            Добавить организацию
        </a>
    </div>
    <div class="major__content-organization-additional">
        <div class="major__content-organization-search">
            <input class="input" id='search' type="text" placeholder="Поиск по имени или инн">
            <input class="input" id="action" type="hidden" name="action" value="search">
        </div>
    </div>

    @include('organization.pagination')
@endsection
