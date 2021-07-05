@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="float-left">{{ isset($post) ? 'Edit Post' : 'Create New Post' }} </h5>
            <a href="{{ route('posts.index') }}" class="btn btn-primary btn-sm float-right">Back</a>
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
            <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($post))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ isset($post) ? $post->title : null }}">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" cols="5" rows="5" id="description" style="resize: none;">{{ isset($post) ? $post->description : null }}</textarea>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <input id="content" type="hidden" name="content" value="{{ isset($post) ? $post->content : null }}">
                    <trix-editor input="content"></trix-editor>
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" name="category_id" id="category_id">
                        <option disabled selected>Choose an option</option>
                        @if($categories->count() > 0)
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ isset($post) && $post->category_id == $category->id ? 'selected' : null }}>{{ $category->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                @if($tags->count() > 0)
                <div class="form-group">
                    <label for="tag">Tags</label>
                    <select class="form-control js-example-basic-multiple" name="tags_id[]" id="tags_id" multiple="">
                            <option disabled>Choose tags</option>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}"
                                    @if(isset($post))
                                        @if($post->hasTag($tag->id))
                                            selected
                                            @endif
                                        @endif
                                >{{ $tag->name }}</option>
                            @endforeach
                    </select>
                </div>
                @endif

                <div class="form-group">
                    <label for="published_at">Published At</label>
                    <input type="text" class="form-control" name="published_at" id="published_at" value="{{ isset($post) ? $post->published_at : null }}">
                </div>

                @if(isset($post))
                    <img src="{{ url('storage/app/'.$post->image) }}" alt="Post Image" class="rounded" width="690">
                @endif
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>

                <div class="form-group d-flex justify-content-center">
                    <button type="submit" class="btn btn-success btn-sm">{{ isset($post) ? 'Update Post' : 'Create Post' }} </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#published_at", {
            enableTime:true,
            enableSeconds: true,
        });
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection
