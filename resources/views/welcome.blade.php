@extends('layout.app')

@section('content')
    <div class="container">
        <h1>Hey, ya</h1>
        <h3>Events Coming Up</h3>
        <ul>
            @foreach ($events as $item)
                <li><b>[{{$item->id}}]{{$item->title}}</b> | [{{$item->dateFrom}} ~ {{$item->dateTo}}] | [{{$item->timeFrom}} ~ {{$item->timeTo}}]</li>
            @endforeach
        </ul>
    </div>
@endsection