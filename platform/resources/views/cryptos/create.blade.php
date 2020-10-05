@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add a cryptocurrency</div>

                    <div class="card-body">
                        <form action="" method="post" class="pb-5">
                            <input class="form-control mb-4" type="text" name="name" placeholder="Name">
                            {{ $errors->first('name') }}
                            <input class="form-control mb-4" type="text" name="ticker" placeholder="Ticker">
                            {{ $errors->first('ticker') }}
                            <input class="form-control mb-4" type="text" name="price" placeholder="Price (0.26)">
                            {{ $errors->first('price') }}

                            <textarea class="form-control mb-4" rows="3" name="description" placeholder="Description"></textarea>
                            {{ $errors->first('description') }}
                            <input class="form-control mb-4" type="text" name="website" placeholder="Website">
                            {{ $errors->first('website') }}
                            <input class="form-control mb-4" type="text" name="category" placeholder="Category">
                            {{ $errors->first('category') }}

                            <br>
                            <button class="btn-light px-3 rounded" type="submit">Submit</button>
                            @csrf
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
