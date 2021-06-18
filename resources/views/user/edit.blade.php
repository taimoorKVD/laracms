@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="float-left">Edit Profile</h5>
            <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm float-right">Back</a>
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

            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                </div>

                <div class="form-group">
                    <label for="about">About</label>
                    <textarea class="form-control" name="about" cols="5" rows="5" style="resize: none;" >{{ $user->about }}</textarea>
                </div>

                <div class="form-group d-flex justify-content-center">
                    <button type="submit" class="btn btn-success btn-sm">Update</button>
                </div>
            </form>
        </div>
    </div>

@endsection
