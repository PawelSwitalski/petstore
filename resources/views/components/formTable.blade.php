<table>
    <tr>
        <th>Property</th>
        <th>Value</th>
    </tr>
    <tr>
        <td>ID</td>
        <td>
            <input name="petId" value="{{$pet['id'] ?? ""}}">
        </td>
    </tr>
    <tr>
        <td>Category ID</td>
        <td>
            <input name="petCategoryId" value="{{$pet['category']['id'] ?? ""}}">
        </td>
    </tr>
    <tr>
        <td>Category Name</td>
        <td>
            <input name="petCategoryName" value="{{$pet['category']['name'] ?? ""}}">
        </td>
    </tr>
    <tr>
        <td>Name</td>
        <td>
            <input name="petName" value="{{$pet['name'] ?? ""}}">
        </td>
    </tr>
    <tr>
        <td>Photo URLs</td>
        {{--                        <td>{{$pet['photoUrls'] ?? ""}}</td>--}}

    </tr>


    <tr></tr>
{{--    @if(empty($pet['photoUrls']))--}}
{{--        @php--}}
{{--            $pet['photoUrls'] = [];--}}
{{--        @endphp--}}
{{--    @endif--}}
    @if(!empty($pet['photoUrls']))
    @for(; $photoUrlIterator < sizeof($pet['photoUrls']); $photoUrlIterator++)
        <tr>
            <td>Photo URL {{ $photoUrlIterator }}</td>
            <td>
                <input name="{{ 'petPhotoUrl' . $photoUrlIterator }}" value="{{$pet['photoUrls'][$photoUrlIterator] ?? ""}}">
            </td>
        </tr>
    @endfor
    @endif


    <tr id="petPhotoUrls">
        <td>

            {{--                            <button type="button" onclick="{{ array_push($pet['photoUrls'], "") }}">Add Photo URL</button>--}}
            <button type="button" onclick="addPetPhotoUrl()">Add Photo URL</button>

        </td>
    </tr>


    <tr>
        <td>Tags</td>
        <td></td>
    </tr>
{{--    @if(empty($pet['tags']))--}}
{{--        @php--}}
{{--            $pet['tags'] = [''];--}}
{{--        @endphp--}}
{{--    @endif--}}
    @if(!empty($pet['tags']))
    @for(; $tagIterator < sizeof($pet['tags']); $tagIterator++)
        <tr>
            <td>Tag {{ $tagIterator }} ID</td>
            <td>
                <input name="{{ 'petTagId' . $tagIterator }}" value="{{$pet['tags'][$tagIterator]['id'] ?? ""}}">
            </td>
        </tr>
        <tr>
            <td>Tag {{ $tagIterator }} Name</td>
            <td>
                <input name="{{ 'petTagName' . $tagIterator }}" value="{{$pet['tags'][$tagIterator]['name'] ?? ""}}">
            </td>
        </tr>
    @endfor
    @endif

    <tr id="petTags">
        <td>
            <button type="button" onclick="addPetTag()">Add Tag</button>
        </td>
    </tr>


    <tr>
        <td>Status</td>
        <td>
{{--            <select name="petStatus">--}}
{{--                @if($pet['status'] == 'available')--}}
{{--                    <option value="available" selected>available</option>--}}
{{--                @else--}}
{{--                    <option value="available">available</option>--}}
{{--                @endif--}}

{{--                @if($pet['status'] == 'pending')--}}
{{--                    <option value="pending" selected>pending</option>--}}
{{--                @else--}}
{{--                    <option value="pending">pending</option>--}}
{{--                @endif--}}

{{--                @if($pet['status'] == 'sold')--}}
{{--                    <option value="sold" selected>sold</option>--}}
{{--                @else--}}
{{--                    <option value="sold">sold</option>--}}
{{--                @endif--}}
{{--                    --}}
{{--                <option value="{{$pet['status'] ?? ""}}" selected>{{$pet['status'] ?? ""}}</option>--}}
{{--            </select>--}}

            <input name="petStatus" value="{{$pet['status'] ?? ""}}">
            {{--                            {{$pet['status'] ?? ""}}--}}
        </td>
    </tr>
</table>

<script>
    let petPhotoUrlCounter = {{ $photoUrlIterator }};
    let petTagCounter = {{ $tagIterator }};

    function addPetPhotoUrl(){
        var petPhotoUrlInput = document.createElement("input");
        petPhotoUrlInput.setAttribute("name", "petPhotoUrl" + petPhotoUrlCounter);
        petPhotoUrlInput.setAttribute("value", "");

        var tdUrlCounter = document.createElement("td");
        tdUrlCounter.innerHTML = "Photo URL " + petPhotoUrlCounter;


        var tdUrlInput = document.createElement("td");
        tdUrlInput.appendChild(petPhotoUrlInput);

        var tr = document.createElement("tr");
        tr.appendChild(tdUrlCounter);
        tr.appendChild(tdUrlInput);
        document.getElementById('petPhotoUrls').before(tr);


        petPhotoUrlCounter++;
    }

    function addPetTag(){
        var petTagIdInput = document.createElement("input");
        petTagIdInput.setAttribute("name", "petTagId" + petTagCounter);
        petTagIdInput.setAttribute("value", "");

        var tdTagIdCounter = document.createElement("td");
        tdTagIdCounter.innerHTML = "Tag " + petTagCounter + " ID";

        var tdTagIdInput = document.createElement("td");
        tdTagIdInput.appendChild(petTagIdInput);

        var trTagId = document.createElement("tr");
        trTagId.appendChild(tdTagIdCounter);
        trTagId.appendChild(tdTagIdInput);
        document.getElementById('petTags').before(trTagId);


        var petTagNameInput = document.createElement("input");
        petTagNameInput.setAttribute("name", "petTagName" + petTagCounter);
        petTagNameInput.setAttribute("value", "");

        var tdTagNameCounter = document.createElement("td");
        tdTagNameCounter.innerHTML = "Tag " + petTagCounter + " Name";

        var tdTagNameInput = document.createElement("td");
        tdTagNameInput.appendChild(petTagNameInput);

        var trTagName = document.createElement("tr");
        trTagName.appendChild(tdTagNameCounter);
        trTagName.appendChild(tdTagNameInput);
        document.getElementById('petTags').before(trTagName);

        petTagCounter++;
    }
</script>
