@extends('layouts.template')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Timetable</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('timetables.index') }}"> Back</a>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('timetables.update', $timetable->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Subject:</strong>
                <select name="subject_id" class="form-control" required>
                    <option value="">Select Subject</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ $timetable->subject_id == $subject->id ? 'selected' : '' }}>
                            {{ $subject->subject_code }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Day:</strong>
                <select name="day_id" class="form-control" required>
                    <option value="">Select Day</option>
                    @foreach ($days as $day)
                        <option value="{{ $day->id }}" {{ $timetable->day_id == $day->id ? 'selected' : '' }}>
                            {{ $day->day_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Hall:</strong>
                <select name="hall_id" class="form-control" required>
                    <option value="">Select Hall</option>
                    @foreach ($halls as $hall)
                        <option value="{{ $hall->id }}" {{ $timetable->hall_id == $hall->id ? 'selected' : '' }}>
                            {{ $hall->lecture_hall_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Group:</strong>
                <select name="group_id" class="form-control" required>
                    <option value="">Select Group</option>
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}" {{ $timetable->group_id == $group->id ? 'selected' : '' }}>
                            {{ $group->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Time From:</strong>
                <input type="time" name="time_from" class="form-control" value="{{ $timetable->time_from }}" required>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Time To:</strong>
                <input type="time" name="time_to" class="form-control" value="{{ $timetable->time_to }}" required>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </div>
</form>
@endsection
