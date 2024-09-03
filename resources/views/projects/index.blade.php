@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Projects</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Projects</li>
                </ol>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <!-- Button trigger for Add Project modal -->
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addProjectModal">
                    Add Project
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Project Table</h4>
                        <h6 class="card-subtitle">List of all projects</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Project Name</th>
                                        <th>Customer</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projects as $project)
                                        <tr>
                                            <td>{{ $project->id }}</td>
                                            <td>{{ $project->name_project }}</td>
                                            <td>{{ $project->customer->name }}</td>
                                            <td>
                                                <!-- Button trigger for Edit Project modal -->
                                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editProjectModal" data-id="{{ $project->id }}"
                                                    data-name="{{ $project->name_project }}"
                                                    data-customer-id="{{ $project->customer->id }}">
                                                    Edit
                                                </button>

                                                <!-- Form for deleting a project -->
                                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                                                    style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        data-confirm-delete="true">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($projects->isEmpty())
                                <p class="text-center">No projects available.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Project Modal -->
    <div class="modal fade" id="addProjectModal" tabindex="-1" aria-labelledby="addProjectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProjectModalLabel">Add New Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add Project Form -->
                    <form action="{{ route('projects.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="projectName" class="form-label">Project Name</label>
                            <input type="text" class="form-control" id="projectName" name="name_project" required>
                        </div>
                        <div class="mb-3">
                            <label for="customerSelect" class="form-label">Customer</label>
                            <select id="customerSelect" class="form-select" name="customer_id" required>
                                <option value="">Select a customer</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Project</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Project Modal -->
    <div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="editProjectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProjectModalLabel">Edit Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Edit Project Form -->
                    <form id="editProjectForm" method="POST" action="{{ route('projects.update', 'project_id') }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editProjectId" name="project_id">
                        <div class="mb-3">
                            <label for="editProjectName" class="form-label">Project Name</label>
                            <input type="text" class="form-control" id="editProjectName" name="name_project" required>
                        </div>
                        <div class="mb-3">
                            <label for="editCustomerSelect" class="form-label">Customer</label>
                            <select id="editCustomerSelect" class="form-select" name="customer_id" required>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Project</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- You might need some inline script to handle the dynamic setting of values in the Edit modal -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editProjectModal = document.getElementById('editProjectModal');
        editProjectModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var projectId = button.getAttribute('data-id');
            var projectName = button.getAttribute('data-name');
            var customerId = button.getAttribute('data-customer-id');

            var modalForm = editProjectModal.querySelector('form');
            var modalProjectId = modalForm.querySelector('#editProjectId');
            var modalProjectName = modalForm.querySelector('#editProjectName');
            var modalCustomerSelect = modalForm.querySelector('#editCustomerSelect');

            modalProjectId.value = projectId;
            modalProjectName.value = projectName;
            modalCustomerSelect.value = customerId; // Set the selected customer
        });
    });
</script>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('button[data-confirm-delete="true"]').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = button.closest('form');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
