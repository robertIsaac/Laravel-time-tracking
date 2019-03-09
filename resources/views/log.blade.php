@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Filter</div>

                    <div class="card-body">
                        <form action="{{route('log')}}" method="get">
                            <div class="form-group row">
                                <label for="team" class="col-md-4 col-form-label text-md-right">Team</label>

                                <div class="col-md-7">
                                    <select id="team" class="form-control" name="team">
                                        <option value="">all teams</option>
                                        @foreach($teams as $team)
                                            <option
                                                value="{{$team->id}}" {{ $team_id == $team->id ? 'selected' : '' }}>{{$team->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="team" class="col-md-4 col-form-label text-md-right">User</label>

                                <div class="col-md-7">
                                    <select id="team" class="form-control" name="user">
                                        <option value="">all users</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" {{ $user_id == $user->id ? 'selected' : '' }}>
                                                {{$user->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row form-inline">
                                <span class="col-md-4 col-form-label text-md-right">Date (yy-ww-dd)</span>
                                <div class="col-md-7">
                                    <select id="year" class="form-control mr-md-2 mr-2 mb-2 mb-md-0" name="year"
                                            title="year">
                                        <option value="">any year</option>
                                        @for($i = 1900; $i <= 2100; $i++)
                                            <option{{ $year == $i ? ' selected' : '' }}>{{$i}}</option>
                                        @endfor
                                    </select>

                                    <select id="week" class="form-control mr-md-2 mr-2 mb-2 mb-md-0" name="week">
                                        <option value="">any week</option>
                                        @for($i = 1; $i <= 53; $i++)
                                            <option{{ $week == $i ? ' selected' : '' }}>{{$i}}</option>
                                        @endfor
                                    </select>

                                    <select id="day" class="form-control mr-md-2 mr-2 mb-2 mb-md-0" name="day"
                                            title="day">
                                        <option value="">any day</option>
                                        @for($i = 1; $i <= 7; $i++)
                                            <option{{ $day == $i ? ' selected' : '' }}>{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="current" class="col-md-4 col-form-label text-md-right">or filter by</label>

                                <div class="col-md-7">
                                    <select id="current" class="form-control" name="current">
                                        <option value="">none</option>
                                        <option value="week"{{ $current === 'week' ? ' selected' : '' }}>current week
                                        </option>
                                        <option value="month"{{ $current === 'month' ? ' selected' : '' }}>current
                                            month
                                        </option>
                                        <option value="3-months"{{ $current === '3-months' ? ' selected' : '' }}>
                                            trailing 3 months
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-hover table-dark table-striped table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">team</th>
                <th scope="col">action</th>
                <th scope="col">time</th>
            </tr>
            </thead>
            <tbody>
            @php($lastDay = '')
            @foreach($logs as $log)
                @if($lastDay !== date('d-m-Y', strtotime($log->created_at)))
                    @php($lastDay = date('d-m-Y', strtotime($log->created_at)))
                    <tr class="text-center bg-info">
                        <td colspan="5">{{$lastDay}}</td>
                    </tr>
                @endif
                <tr>
                    <td>{{$log->id}}</td>
                    <td>{{$log->user->name}}</td>
                    <td>{{$log->user->team->name}}</td>
                    <td>{{$log->is_login ? 'login' : 'logout'}}</td>
                    <td>{{date('H:i:s', strtotime($log->created_at))}}</td>
                </tr>
                {{--{{$log->user_name}}--}}
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
