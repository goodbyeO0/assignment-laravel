@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>List of Halls</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('halls.create') }}"> Add New Hall</a>
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
        <th>Hall Number</th>
        <th>Building</th>
        <th>Capacity</th>
        <th>Type</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($halls as $hall)
    <tr>
        <td>{{ $hall->id }}</td>
        <td>{{ $hall->number }}</td>
        <td>{{ $hall->building }}</td>
        <td>{{ $hall->capacity }}</td>
        <td>{{ $hall->type }}</td>
        <td>
            <form action="{{ route('halls.destroy',$hall->id) }}" method="POST">
                <a class="btn btn-info" href="{{ route('halls.show',$hall->id) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('halls.edit',$hall->id) }}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection 