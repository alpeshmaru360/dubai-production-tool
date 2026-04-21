@extends('layouts.main')
@section('content')
<link href="{{ asset('css/tabs/dubai_production.css') }}" rel="stylesheet" />
<link href="{{ asset('css/Admin/dashboard.css') }}" rel="stylesheet" />
<link href="{{ asset('css/Admin/users.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<section class="p-4">
    <div class="d-flex justify-content-between">
        <div class="heading">
            Manage Users
        </div>



        <!-- Add User Button -->
        <button class="btn btn-primary mb-4 float-right" data-bs-toggle="modal" data-bs-target="#exampleModal">+ Add
            User</button>
    </div>
        <!-- Flash Message Section -->
        @if (session('success'))
        <div class="alert alert-success alert-dismissible mt-2" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {{ session('success') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

    <!-- Users Table -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center" id="users_table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Country</th> <!-- Display country name -->
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->country_name }}</td> <!-- Display country name -->
                    <td>{{ $user->role }}</td> <!-- Display role name -->
                    <td class="action">
                        <button class="btn btn-primary btn-sm"
                            onclick="openEditModal({{ $user }})">Edit</button>
                        <button class="btn btn-danger btn-sm"
                            onclick="openDeleteModal({{ $user->id }})">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!--ADD Modal -->
    <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm custom-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    <!-- Validation Errors -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- User Form -->
                    <form action="{{ route('admin.users.store') }}" method="POST" id="addUserForm">
                        @csrf
                        <div class="form-group">
                            <!-- Name and Email Fields -->
                            <div class="d-flex justify-content-between">
                                <div class="input_field">
                                    <label for="name" class="form-label">Name</label><span
                                        class="text-danger">*</span>
                                    <input type="text" name="name" class="form-control" id="name"
                                        required>
                                </div>
                                <div class="input_field">
                                    <label for="email" class="form-label">Email</label><span
                                        class="text-danger">*</span>
                                    <input type="email" name="email" class="form-control" id="email"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <!-- Phone and Role Fields -->
                            <div class="d-flex justify-content-between">
                                <div class="input_field">
                                    <label for="country" class="form-label">Country</label><span
                                        class="text-danger">*</span>
                                    <select name="country" class="form-select round" id="country" required>
                                        <option value="">Select Country</option>
                                        @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input_field">
                                    <label for="phone" class="form-label">Phone</label><span
                                        class="text-danger">*</span>
                                    <input type="text" name="phone" class="form-control" id="phone"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <div class="d-flex justify-content-between">
                                <!-- Password Field Only -->
                                <div class="input_field">
                                    <label for="password" class="form-label">Password</label><span
                                        class="text-danger">*</span>
                                    <input type="password" name="password" class="form-control" id="password"
                                        required>
                                </div>
                                <div class="input_field">
                                    <label for="role" class="form-label">Role</label><span
                                        class="text-danger">*</span>
                                    <select name="role" class="form-select round " id="role" required>
                                        <option value="">Select Role</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Sales Manager">Sales Manager</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm custom-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                </div>
                <div class="modal-body">
                    <form id="editUserForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <div class="d-flex justify-content-between">
                                <div class="input_field">
                                    <label for="edit_name" class="form-label">Name</label><span
                                        class="text-danger">*</span>
                                    <input type="text" name="name" class="form-control" id="edit_name"
                                        required>
                                </div>
                                <div class="input_field">
                                    <label for="edit_email" class="form-label">Email</label><span
                                        class="text-danger">*</span>
                                    <input type="email" name="email" class="form-control" id="edit_email"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between phone_edit">
                            <div class="input_field">
                                <label for="edit_country" class="form-label">Country</label><span
                                    class="text-danger">*</span>
                                <select name="country" class="form-select round" id="edit_country" required>
                                    <option>Select Country</option>
                                    @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input_field">
                                <label for="edit_phone" class="form-label">Phone</label><span
                                    class="text-danger">*</span>
                                <input type="text" name="phone" class="form-control" id="edit_phone"
                                    required>
                            </div>
                        </div>
                        <div class="form-group mt-3 w-100">
                            <div class="d-flex justify-content-between w-100">
                                <div class="input_field w-100">
                                    <label for="edit_role" class="form-label">Role</label><span
                                        class="text-danger">*</span>
                                    <select name="role" class="form-select round w-100" id="edit_role" required>
                                        <option value="">Select Role</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Sales Manager">Sales Manager</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Deletion</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark bg_dark" data-dismiss="modal">Cancel</button>
                    <form id="deleteUserForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('js/Admin/users.js') }}"></script>
@endsection