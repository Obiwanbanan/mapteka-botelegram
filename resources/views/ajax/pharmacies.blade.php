<div class="major__content-pharmacies-header" data-id-organization="{{ $organization->id }}">
    <h1>
        {{ $organization->name }}
    </h1>
    <button class="major__content-btn remove btn">
        Delete Organization
        <input id="action" type="hidden" name="action" value="remove">
        <input id="page" type="hidden" name="page" value="organizations">
    </button>

    <button class="major__content-btn edit btn">
        Edit Organization
        <input id="action" type="hidden" name="action" value="remove">
        <input id="page" type="hidden" name="page" value="organizations">
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
                <td> {{ $pharmacy->name }} </td>
                <td> {{ $pharmacy->address }} </td>
                <td>
                    <button class="btn">Map</button>
                    <button class="btn">Edit</button>
                    <button class="btn">Delete</button>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>

</div>



