@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <form action="/crypto-filter?classification_id=" method="get" class="pb-5">
                <select class="form-control" name="classification">
                    @foreach($classifications as $classification)
                        <option value="{{$classification->id}}">{{$classification->classification}}</option>
                    @endforeach
                </select>

                <br>
                <button class="btn-light px-3 rounded" type="submit">Search</button>
                @csrf
            </form>
            <div class="col-md-8">
                @foreach($filteredcryptos as $filteredcrypto)
                    <div class="card">
                        <div class="card-header flex justify-between"><p>{{$filteredcrypto->name}}</p><p><a href="/cryptos/{{ $filteredcrypto->id }}/edit">Edit</a></p></div>
                        <div class="card-body">
                            <p><strong>Ticker:</strong> {{$filteredcrypto->ticker}}</p>
                            <p><strong>Description:</strong> {{$filteredcrypto->description}}</p>
                            <p><strong>Website:</strong> {{$filteredcrypto->website}}</p>
                            <p><strong>Classification:</strong>{{$filteredcrypto->classification->classification}} </p>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
