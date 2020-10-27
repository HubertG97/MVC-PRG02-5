@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
{{--            <form action="/crypto-filter?classification_id=" method="get" class="pb-5">--}}
{{--                <select class="form-control" name="classification">--}}
{{--                    @foreach($classifications as $classification)--}}
{{--                        <option value="{{$classification->id}}">{{$classification->classification}}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}

{{--                <br>--}}
{{--                <button class="btn-light px-3 rounded" type="submit">Search</button>--}}
{{--                @csrf--}}
{{--            </form>--}}
            <div class="col-md-8">
                @foreach($all_cryptos as $crypto)
                    <div class="card">
                        <div class="card-header flex justify-between"><p>{{$crypto->name}}</p><p><a href="/cryptos/{{ $crypto->id }}/edit">Edit</a></p>
                            <form method="post">
                                @method('PATCH')
                                <input class="form-control mb-4 d-none" type="text" name="crypto_id" value="{{$crypto->id}}">

                                <button class="btn-light px-3 rounded" type="submit">@if($crypto->visible)Make invisible @else Make visible @endif</button>

                                @csrf
                            </form>
                        </div>
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
