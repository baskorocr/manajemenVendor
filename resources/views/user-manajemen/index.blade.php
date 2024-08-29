@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <!-- Page Title and Breadcrumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Pemilik</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Table Pemilik</li>
                </ol>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <!-- Button to Trigger Modal -->
                <button type="button" class="btn waves-effect waves-light btn-info text-white mb-2" data-bs-toggle="modal"
                    data-bs-target="#registerPemilikModal">
                    Tambah Pemilik
                </button>
            </div>
        </div>

        <!-- Table to Display Users -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Table Pemilik</h4>
                        <h6 class="card-subtitle">Daftar semua pemilik</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>NPK</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->NPK }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->is_admin ? 'Admin' : 'User' }}</td>
                                            <td>
                                                <!-- Edit Button to Trigger Edit Modal -->
                                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editPemilikModal{{ $user->NPK }}">
                                                    Edit
                                                </button>

                                                <!-- Delete Form -->
                                                <form action="{{ route('user-manajemen.destroy', $user->NPK) }}"
                                                    method="POST" style="display:inline-block;" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        data-confirm-delete="true">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Edit Pemilik Modal -->
                                        <div class="modal fade" id="editPemilikModal{{ $user->NPK }}" tabindex="-1"
                                            aria-labelledby="editPemilikModalLabel{{ $user->NPK }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="editPemilikModalLabel{{ $user->NPK }}">Edit Pemilik</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('user-manajemen.update', $user->NPK) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="namePemilik{{ $user->NPK }}"
                                                                    class="form-label">Nama Pemilik</label>
                                                                <input type="text" class="form-control"
                                                                    id="namePemilik{{ $user->NPK }}" name="name"
                                                                    value="{{ $user->name }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="emailPemilik{{ $user->NPK }}"
                                                                    class="form-label">Email</label>
                                                                <input type="email" class="form-control"
                                                                    id="emailPemilik{{ $user->NPK }}" name="email"
                                                                    value="{{ $user->email }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="rolePemilik{{ $user->NPK }}"
                                                                    class="form-label">Role</label>
                                                                <select class="form-select"
                                                                    id="rolePemilik{{ $user->NPK }}" name="is_admin"
                                                                    required>
                                                                    <option value="1"
                                                                        {{ $user->is_admin ? 'selected' : '' }}>Admin
                                                                    </option>
                                                                    <option value="0"
                                                                        {{ !$user->is_admin ? 'selected' : '' }}>User
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Tutup</button>
                                                                <button type="submit" class="btn btn-success">Perbarui
                                                                    User</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($users->isEmpty())
                                <p class="text-center">Tidak ada pemilik yang tersedia.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Pemilik Modal -->
    <div class="modal fade" id="registerPemilikModal" tabindex="-1" aria-labelledby="registerPemilikModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerPemilikModalLabel">Register Pemilik</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Register Form -->
                    <form action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="form-group first">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required
                                autocomplete="name" autofocus>
                        </div>
                        <div class="form-group first">
                            <label for="NPK">NPK</label>
                            <input type="text" class="form-control @error('NPK') is-invalid @enderror" id="NPK"
                                name="NPK" required autocomplete="NPK" autofocus>
                            @error('NPK')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group first">
                            <label for="role">Role</label>
                            <select class="form-control @error('role') is-invalid @enderror" id="role"
                                name="role" required>
                                <option value="0">User</option>
                                <option value="1">Admin</option>
                            </select>
                            @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group first">
                            <label for="email">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group last">
                            <label for="password">Password</label>
                            <input type="password" id="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group last mb-4">
                            <label for="password-confirm">Password Confirmation</label>
                            <input type="password" id="password-confirm" class="form-control"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript to Handle Modal and Form Submission -->
    <script>
        // Confirmation for Delete Actions
        document.querySelectorAll('[data-confirm-delete]').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                if (confirm('Are you sure you want to delete this user?')) {
                    button.closest('form').submit();
                }
            });
        });
    </script>
@endsection
