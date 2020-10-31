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
                    <div class="flex flex-row bg-white rounded shadow p-3 mb-3">
                        <div style="background-image: url({{ asset('image/logo/' . $crypto->logo_url) }}); background-position:center; background-repeat: no-repeat; background-size: contain;" class="w-3/12 h-48"></div>
                        <div class="w-7/12 text-center p-3">
                            <h3>{{$crypto->name}} ({{$crypto->ticker}})</h3>
                            <p>{{$crypto->description}}</p>
                        </div>
                        <div class="w-2/12 flex items-center flex-column">
                            <form method="post">
                                @method('PATCH')
                                <input class="form-control mb-4 d-none" type="text" name="crypto_id" value="{{$crypto->id}}">
                                <button @if($crypto->visible)class="w-24 h-8 bg-green-500 text-white px-3 rounded" @else class="w-24 h-8 bg-red-500 text-white px-3 rounded" @endif class="w-24 h-8 bg-green-500 text-white px-3 rounded" type="submit">@if($crypto->visible)Visible @else Invisible @endif</button>
                                @csrf
                            </form>
                            <p><a href="/cryptos/{{ $crypto->id }}/edit">Edit</a></p>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
@endsection


