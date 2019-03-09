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

                                <div class="col-md-6">
                                    <select id="team" class="form-control" name="team">
                                        <option value="">select team</option>
                                        @foreach($teams as $team)
                                            <option
                                                value="{{$team->id}}" {{ $team_id == $team->id ? 'selected' : '' }}>{{$team->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="team" class="col-md-4 col-form-label text-md-right">User</label>

                                <div class="col-md-6">
                                    <select id="team" class="form-control" name="user">
                                        <option value="">select User</option>
                                        @foreach($users as $user)
                                            <option
                                                value="{{$user->id}}" {{ $user_id == $user->id ? 'selected' : '' }}>{{$user->name}}</option>
                                        @endforeach
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
