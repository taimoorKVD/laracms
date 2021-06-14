@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="float-left">Categories</h5>
            <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm float-right">Create New Category</a>
        </div>
        <div class="card-body">
            <table class="table w-100">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($categories))
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm mr-2">Edit</a>
                                    <button class="btn btn-danger btn-sm mr-2" onclick="handleDelete( {{ $category->id }} )">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="2">No record found!</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        @if(!empty($categories))
            <div class="card-footer">
                {{ $categories->links() }}
            </div>
        @endif
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" method="POST" id="deleteCategoryForm">
                @csrf
                @method('DELETE')

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Category</h5>
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
        var form = document.getElementById('deleteCategoryForm');
        form.action = "/categories/"+id;
        $('#deleteModal').modal('show');
    }
</script>
@endsection
