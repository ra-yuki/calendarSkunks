@extends('layout.app')

@section('content')
    <div class="container">
        <h1>Hey, ya</h1>
        <h3>Events Coming Up</h3>
        <ul>
            @foreach ($events as $item)
                <li>{{$item->title}}</li>
            @endforeach
        </ul>
    </div>
@endsection