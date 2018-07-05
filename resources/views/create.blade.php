@extends('layout.app')

@section('content')
    <div class="container">
        <div class="col-xs-12">
            {{Form::open(['route' => 'event.generate'])}}
                {{Form::label('title')}}
                {{Form::text('title')}}
                {{Form::label('date from')}}
                {{Form::date('dateFrom')}}
                {{Form::label('date to')}}
                {{Form::date('dateTo')}}
                {{Form::label('time from')}}
                {{Form::time('timeFrom')}}
                {{Form::label('time to')}}
                {{Form::time('timeTo')}}
    
                {{Form::submit('generate')}}
            {{Form::close()}}
        </div>

        <div class="col-xs-12">
                {{Form::open(['route' => 'event.schedule'])}}
                    {{Form::label('title')}}
                    {{Form::text('title')}}
                    {{Form::label('date from')}}
                    {{Form::date('dateFrom')}}
                    {{Form::label('date to')}}
                    {{Form::date('dateTo')}}
                    {{Form::label('time from')}}
                    {{Form::time('timeFrom')}}
                    {{Form::label('time to')}}
                    {{Form::time('timeTo')}}
        
                    {{Form::submit('schedule')}}
                {{Form::close()}}
            </div>
    </div>
@endsection