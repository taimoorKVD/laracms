@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="float-left">Posts</h5>
            <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm float-right">Create New Post</a>
        </div>
        <div class="card-body">
            <table class="table w-100">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(count($posts) > 0)
                    @foreach($posts as $post)
                        <tr>
                            <td><img src="{{ url('storage/app/'.$post->image) }}" alt="Post Image" class="rounded" width="100"></td>
                            <td>{{ $post->title }}</td>
                            <td>
                                <button class="btn btn-danger btn-sm mr-2 float-right" onclick="handleDelete( {{ $post->id }} )">
                                    {{ $post->trashed() ? 'Delete' : 'Trash' }}
                                </button>
                                @if($post->trashed())
                                    <form action="{{ route('restore-post', $post->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-warning btn-sm mr-2 float-right" style="color: #f8fafc;">Restore</button>
                                    </form>
                                @else
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm mr-2 float-right" style="color: #f8fafc;">Edit</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" align="center">No record found!</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        @if(count($posts) > 0)
            <div class="card-footer">
                {{ $posts->links() }}
            </div>
        @endif
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" method="POST" id="deletePostForm">
                @csrf
                @method('DELETE')

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go Back</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function handleDelete(id) {
            var form = document.getElementById('deletePostForm');
            form.action = '{!! url('posts') !!}'+'/'+id;
            $('#deleteModal').modal('show');
        }
    </script>

@endsection
