
<ul>
    <li><a href="{{ route('pets.index') }}">pets</a></li>
    <li><a href="{{ route('pets.findByStatus', ['status' => 'available']) }}">pets/findByStatus?status=available</a></li>
    <li><a href="{{ route('pets.findByStatus', ['status' => 'pending']) }}">pets/findByStatus?status=pending</a></li>
    <li><a href="{{ route('pets.findByStatus', ['status' => 'sold']) }}">pets/findByStatus?status=sold</a></li>
</ul>
