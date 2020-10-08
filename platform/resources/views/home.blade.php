@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($allcryptos as $crypto)
                <div class="card">
                    <div class="card-header flex justify-between"><p>{{$crypto->name}}</p><p><a href="/problems/{{ $crypto->id }}/edit">Edit</a></p></div>
                    <div class="card-body">
                        <p><strong>Ticker:</strong> {{$crypto->ticker}}</p>
                        <p><strong>Description:</strong> {{$crypto->description}}</p>
                        <p><strong>Website:</strong> {{$crypto->website}}</p>
                        <p><strong>Classification:</strong>{{$crypto->classification->classification}} </p>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
