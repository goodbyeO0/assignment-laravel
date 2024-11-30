@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Timetable Schedule</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('timetables.create') }}"> Add New Schedule</a>
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
        <th>Subject</th>
        <th>Group</th>
        <th>Hall</th>
        <th>Day</th>
        <th>Start Time</th>
        <th>End Time</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($timetables as $schedule)
    <tr>
        <td>{{ $schedule->id }}</td>
        <td>{{ $schedule->subject->name }}</td>
        <td>{{ $schedule->group->name }}</td>
        <td>{{ $schedule->hall->number }}</td>
        <td>{{ $schedule->day }}</td>
        <td>{{ $schedule->start_time }}</td>
        <td>{{ $schedule->end_time }}</td>
        <td>
            <form action="{{ route('timetables.destroy',$schedule->id) }}" method="POST">
                <a class="btn btn-info" href="{{ route('timetables.show',$schedule->id) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('timetables.edit',$schedule->id) }}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection 