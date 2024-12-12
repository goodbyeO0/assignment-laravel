@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>List of Groups</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success mb-2" href="{{ route('groups.create') }}"> Add New Group</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Group Name</th>
        <th>Capacity</th>
        <th>Department</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($groups as $group)
    <tr>
        <td>{{ $group->id }}</td>
        <td>{{ $group->name }}</td>
        <td>{{ $group->capacity }}</td>
        <td>{{ $group->department }}</td>
        <td>
            <form action="{{ route('groups.destroy',$group->id) }}" method="POST">
                <a class="btn btn-info" href="{{ route('groups.show',$group->id) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('groups.edit',$group->id) }}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection 