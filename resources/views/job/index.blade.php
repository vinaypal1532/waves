@include('layouts.app')
@include('layouts.sidebar')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Jobs Data</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Jobs Data</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body" style="overflow-x:auto;">
                            <div>
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No</th>
                                            <th>Job Id</th>
                                            <th>Domain</th>
                                            <th>Title</th>
                                            <th>Company Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Contact Person</th>
                                            <th>Location</th>
                                            <th>Experience</th>
                                            <th>No of Position</th>
                                            <th>End Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1; @endphp
                                        @foreach ($jobs as $question)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $question->job_id }}</td>
                                                <td>{{ $question->domain }}</td>
                                                <td>{{ $question->title }}</td>
                                                <td>{{ $question->c_name }}</td>
                                                <td>{{ $question->email }}</td>
                                                <td>{{ $question->mobile_no }}</td>
                                                <td>{{ $question->contact_person }}</td>
                                                <td>{{ $question->location }}</td>
                                                <td>{{ $question->exp }}</td>
                                                <td>{{ $question->no_position }}</td>
                                                <td>{{ $question->end_data }}</td>
                                                <td class="project-state">
                                                    @if ($question->status == 1)
                                                        <span class="badge badge-success">Success</span>
                                                    @elseif ($question->status == 0)
                                                        <span class="badge badge-warning">Pending</span>
                                                    @elseif ($question->status == 2)
                                                        <span class="badge badge-danger">Block</span>
                                                    @endif
                                                </td>
                                                <td class="text-right py-0 align-middle">
                                                    <div class="btn-group btn-group-sm">
                                                        <a class="btn btn-info btn-sm"
                                                            href="{{ route('job_edit', $question->id) }}">
                                                            <i class="fas fa-pencil-alt"></i>
                                                            Edit
                                                        </a>
                                                        <a href="{{ route('job_delete', $question->id) }}"
                                                            class="btn btn-danger ms-2"
                                                            onclick="return confirm('Are you sure you want to delete this Job?')">
                                                            <i class="fas fa-trash"></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script>
    $.noConflict();
    jQuery(document).ready(function ($) {
        $('#example1').DataTable();
    });
</script>
@include('layouts.footer')
