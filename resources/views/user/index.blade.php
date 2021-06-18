@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="float-left">Users</h5>
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right">Create New User</a>
        </div>
        <div class="card-body">
            <table class="table w-100">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(count($users) > 0)
                    @foreach($users as $user)
                        <tr>
                            <td><img src="{{ Gravatar::src($user->email) }}" class="rounded-circle" height="40px" width="40px"></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><span class="badge {{ $user->role == "admin" ? 'badge-success' : 'badge-info' }} ">{{ $user->role }}</span></td>
                            <td>
                                @if(!$user->isAdmin())
                                    <form action="{{ route('users.make-admin',$user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm mr-1">Make Admin</button>
                                    </form>
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
        @if(count($users) > 0)
            <div class="card-footer">
                {{ $users->links() }}
            </div>
        @endif
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" method="POST" id="deleteUserForm">
                @csrf
                @method('DELETE')

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete User</h5>
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
            var form = document.getElementById('deleteUserForm');
            form.action = '{!! url('users') !!}'+'/'+id;
            $('#deleteModal').modal('show');
        }
    </script>
@endsection
