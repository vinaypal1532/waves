@include('layouts.app')
@include('layouts.sidebar')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Batches</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Batches</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('batch_upload') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                                </div>
                                
                                <div class="form-group">
                                    <label for="domain_id">Domain</label>
                                    <select id="domain_id" name="domain_id" class="form-control">
                                        <option value="">Select Domain</option>
                                        @foreach ($domains as $domain)
                                            <option value="{{ $domain->id }}">{{ $domain->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="duration">Duration</label>
                                    <input type="text" class="form-control" name="duration" id="duration" placeholder="Duration">
                                </div>

                                <div class="form-group">
                                    <label for="rate">Rate</label>
                                    <input type="text" class="form-control" name="rate" id="rate" placeholder="Rate">
                                </div>

                                <div class="form-group">
                                    <label for="title">Start Date</label>
                                    <input type="date" class="form-control" name="start_date" id="start_date" placeholder="start_date" min="<?= date('Y-m-d'); ?>">
                                </div>
                                
                                <div class="form-group">
                                    <label for="image">Image (64x64)</label>
                                    <input type="file" class="form-control" name="image" id="image">
                                </div>

                                <div class="form-group">
                                    <label for="details">Details</label>
                                    <input type="text" class="form-control" name="details" id="details" placeholder="Details">
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select id="status" name="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Pending</option>
                                        <option value="2">Rejected</option>
                                    </select>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('layouts.footer')
