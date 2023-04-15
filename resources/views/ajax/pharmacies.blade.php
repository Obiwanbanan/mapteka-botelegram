<div class="major__content-pharmacies-header" data-id-organization="{{ $organization->id ?? '' }}">
    <h1>
        {{ $organization->name ?? ''}}
    </h1>
    <div class="major__content-pharmacies-actions">
        <button class="major__content-btn edit btn">
            Edit Organization
            <input id="action" type="hidden" name="action" value="remove">
            <input id="page" type="hidden" name="page" value="organizations">
        </button>

        <button class="major__content-btn remove btn">
            Remove Organization
            <input id="action" type="hidden" name="action" value="remove">
            <input id="page" type="hidden" name="page" value="organizations">
        </button>
    </div>

</div>
<div class="major__content-pharmacies-additional">
    <div class="major__content-pharmacies-search">
        <input class="input" id='search' type="text" placeholder="Search">
        <input class="input" id="action" type="hidden" name="action" value="search">
        <button class="btn">
            Search
        </button>
    </div>
    <button class="major__content-btn add btn ">
        Add pharmacy
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
                        Name
                    </td>
                    <td>
                        Address
                    </td>
                    <td>
                        Actions
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
                    <button class="btn map">Map</button>
                    <button class="btn edit" id="{{ $pharmacy->id }}">Edit</button>
                    <button class="btn remove" id="{{ $pharmacy->id }}">Remove
                        <input id="action" type="hidden" name="action" value="remove">
                        <input id="page" type="hidden" name="page" value="organizations">
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>

<div class="major__pharmacy-edit-modal modal">
    <div class="major__content-pharmacy-edit-modal">
        <h2>
            Edit pharmacy
        </h2>
          <span class="major__pharmacy-edit-modal-close">
           <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="32" height="32" viewBox="0 0 32 32">
            <path
                d="M16 0c-8.837 0-16 7.163-16 16s7.163 16 16 16 16-7.163 16-16-7.163-16-16-16zM16 29c-7.18 0-13-5.82-13-13s5.82-13 13-13 13 5.82 13 13-5.82 13-13 13z"/>
            <path d="M21 8l-5 5-5-5-3 3 5 5-5 5 3 3 5-5 5 5 3-3-5-5 5-5z"/>
            </svg>
        </span>
        <input class="input" id="action" type="hidden" name="action" value="update">
        <input class="input" id="page" type="hidden" name="page" value="organizations">
        <input class="input" id="name" type="text" name="name" placeholder="Name">
        <input class="input" id="address" type="text" name="address" placeholder="Address">
        <input class="input" id="coordinate_X" type="text" name="coordinate_X" placeholder="coordinate_X">
        <input class="input" id="coordinate_Y" type="text" name="coordinate_Y" placeholder="coordinate_Y">

        <button id="" class="btn">
            {{ __('Update') }}
        </button>
    </div>

</div>

<div class="major__pharmacy-add-modal modal">
    <div class="major__content-pharmacy-add-modal">
        <h2>
            Add new pharmacy
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
        <input class="input" id="pharmacy-name" type="text" name="pharmacy-name" placeholder="Pharmacy Name">
        <input class="input" id="pharmacy-address" type="text" name="pharmacy-address" placeholder="Pharmacy Address">
        <input class="input" id="pharmacy-coordinate_X" type="text" name="coordinate_X" placeholder="coordinate X for map">
        <input class="input" id="pharmacy-coordinate_Y" type="text" name="coordinate_Y" placeholder="coordinate Y for map">

        <button class="btn">
            {{ __('Register') }}
        </button>
    </div>
</div>
