<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@php($photoUrlIterator = 0)
@php($tagIterator = 0)
@include('components.navigation')

@if ($errors->any())
    <div class="alert alert-danger">
        <h4>Errors:</h4>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



{{--<div>--}}
{{--    <div>--}}
{{--        <h1>DELETE</h1>--}}
{{--        <form action="{{ route('pets.destroy') }}" method="POST">--}}
{{--            @csrf--}}
{{--            @method('DELETE')--}}
{{--            <label>--}}
{{--                <input id="delete_id" name="id" placeholder="petId" type="number" value="">--}}
{{--            </label>--}}
{{--            <button type="submit">Delete</button>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--</div>--}}


@if( $pet == null)
    <div>
        <div>
            <h1>Find pet</h1>
{{--            <form action="{{ route('pets.show'), ['id' => 5] }}" method="POST">--}}
{{--                @csrf--}}
{{--                @method('GET')--}}
{{--                <label>--}}
{{--                    <input name="id" placeholder="petId" type="number" value="">--}}
{{--                </label>--}}
{{--                <button type="submit">Find</button>--}}
{{--            </form>--}}
            <label>
                <input id="find_id" class="restricted-numbers-only" name="id" placeholder="petId" type="number" min="1" maxlength="50" value="">
            </label>
            <button type="button" onclick="window.location = '/pets/' + document.getElementById('find_id').value">Find</button>
        </div>
    </div>


    <div>
        <div>
            <h3>Add pet</h3>
            <form action="{{ route('pets.create') }}" method="POST">
                @csrf
                @method('POST')

                <x-formTable :pet="$pet" :photoUrlIterator="$photoUrlIterator" :tagIterator="$tagIterator" />

                <button type="submit">Add</button>
            </form>
        </div>
    </div>
@endif



@if( $pet && $pet['id'] != null)
    {{ json_encode($pet) }}
    <div>
        <div>
            <h3>Update pet</h3>
            <form action="{{ route('pets.update', $pet['id']) }}" method="POST">
                @csrf
                @method('PUT')


                <x-formTable :pet="$pet" :photoUrlIterator="$photoUrlIterator" :tagIterator="$tagIterator" />

                <button type="submit">Update</button>
            </form>


        </div>
    </div>


    <div>
        <div>
            <h3>Upload pet photo</h3>
            <form action="{{ route('pets.uploadImage', $pet['id']) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <label>
                    <input name="petPhotoFile" type="file">
                </label>
                <label>
                    <input name="additionalMetadata" placeholder="Additional metadata" type="text" value="">
                </label>
                <button type="submit">Upload</button>
            </form>
        </div>
    </div>

    <div>
        <div>
            <h3>Delete pet</h3>
            <form action="{{ route('pets.destroy', $pet['id']) }}" method="POST">
                @csrf
                @method('DELETE')
                <label>
                    <input hidden="hidden" name="petId" value="{{$pet['id'] ?? ""}}">
                </label>
                <button type="submit">Delete</button>
            </form>
        </div>
    </div>

@endif


</body>
</html>

<script type="text/javascript">
    {{--let petPhotoUrlCounter = {{ $photoUrlIterator }};--}}
    {{--let petTagCounter = {{ $tagIterator }};--}}

    function petIdURL(){
        // window.location = "/pet/" + document.getElementById('delete_id').value;
        return "/pet/" + document.getElementById('delete_id').value;
    }

    const restricted = document.querySelector('.restricted-numbers-only')
    restricted.addEventListener('keyup', event => {
        const value = event.target.value;
        if (!/^[1-9]+?[0-9]?$/.test(value) && value !== '') {
            event.target.value =  event.target.getAttribute('data-value');
        } else {
            event.target.setAttribute('data-value', value);
        }
    });

    // function addPetPhotoUrl(){
    //     var petPhotoUrlInput = document.createElement("input");
    //     petPhotoUrlInput.setAttribute("name", "petPhotoUrl" + petPhotoUrlCounter);
    //     petPhotoUrlInput.setAttribute("value", "");
    //
    //     var tdUrlCounter = document.createElement("td");
    //     tdUrlCounter.innerHTML = "Photo URL " + petPhotoUrlCounter;
    //
    //
    //     var tdUrlInput = document.createElement("td");
    //     tdUrlInput.appendChild(petPhotoUrlInput);
    //
    //     var tr = document.createElement("tr");
    //     tr.appendChild(tdUrlCounter);
    //     tr.appendChild(tdUrlInput);
    //     document.getElementById('petPhotoUrls').before(tr);
    //
    //
    //     petPhotoUrlCounter++;
    // }
    //
    // function addPetTag(){
    //     var petTagIdInput = document.createElement("input");
    //     petTagIdInput.setAttribute("name", "petTagId" + petTagCounter);
    //     petTagIdInput.setAttribute("value", "");
    //
    //     var tdTagIdCounter = document.createElement("td");
    //     tdTagIdCounter.innerHTML = "Tag " + petTagCounter + " ID";
    //
    //     var tdTagIdInput = document.createElement("td");
    //     tdTagIdInput.appendChild(petTagIdInput);
    //
    //     var trTagId = document.createElement("tr");
    //     trTagId.appendChild(tdTagIdCounter);
    //     trTagId.appendChild(tdTagIdInput);
    //     document.getElementById('petTags').before(trTagId);
    //
    //
    //     var petTagNameInput = document.createElement("input");
    //     petTagNameInput.setAttribute("name", "petTagName" + petTagCounter);
    //     petTagNameInput.setAttribute("value", "");
    //
    //     var tdTagNameCounter = document.createElement("td");
    //     tdTagNameCounter.innerHTML = "Tag " + petTagCounter + " Name";
    //
    //     var tdTagNameInput = document.createElement("td");
    //     tdTagNameInput.appendChild(petTagNameInput);
    //
    //     var trTagName = document.createElement("tr");
    //     trTagName.appendChild(tdTagNameCounter);
    //     trTagName.appendChild(tdTagNameInput);
    //     document.getElementById('petTags').before(trTagName);
    //
    //     petTagCounter++;
    // }
</script>
