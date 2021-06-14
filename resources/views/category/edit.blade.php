@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="float-left">Edit Category</h5>
            <a href="{{ route('categories.index') }}" class="btn btn-primary btn-sm float-right">Back</a>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-group">
                        @foreach($errors->all() as $error)
                            <li class="list-group-item">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('categories.update', ['category' => $category->id]) }}" method="PUT">

                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Name" value="{{ $category->name }}">
                </div>

                <div class="form-group d-flex justify-content-center">
                    <button type="submit" class="btn btn-warning btn-sm">Update</button>
                </div>
            </form>
        </div>
    </div>

@endsection
