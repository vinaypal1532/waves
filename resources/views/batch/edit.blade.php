@include('layouts.app')
@include('layouts.sidebar')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Batch</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Batch</li>
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

                        <form action="{{ route('update_batch', $batch->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" name="title" id="title" value="{{ $batch->title }}" placeholder="Title">
                                </div>

                                <div class="form-group">
                                    <label for="domain_id">Domain</label>
                                    <select id="domain_id" name="domain_id" class="form-control">
                                        <option value="">Select Domain</option>
                                        @foreach ($domains as $domain)
                                            <option value="{{ $domain->id }}" {{ $domain->id == $batch->domain_id ? 'selected' : '' }}>{{ $domain->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="duration">Duration</label>
                                    <input type="text" class="form-control" name="duration" id="duration" value="{{ $batch->duration }}" placeholder="Duration">
                                </div>

                                <div class="form-group">
                                    <label for="rate">Rate</label>
                                    <input type="text" class="form-control" name="rate" id="rate" value="{{ $batch->rate }}" placeholder="Rate">
                                </div>
                                <div class="form-group">
                                    <label for="title">Start Date</label>
                                    <input type="date" class="form-control" name="start_date" id="start_date" value="{{ $batch->start_date }}" min="<?= date('Y-m-d'); ?>">
                                </div>
                                
                                <div class="form-group">
                                    <label for="image">Image (64x64)</label>
                                    <input type="file" class="form-control" name="image" id="image">
                                    @if ($batch->image)
                                        <img src="{{ asset($batch->image) }}" alt="Batch Image" width="64" height="64">
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="details">Details</label>
                                    <input type="text" class="form-control" name="details" id="details" value="{{ $batch->details }}" placeholder="Details">
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select id="status" name="status" class="form-control">
                                        <option value="1" {{ $batch->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $batch->status == 0 ? 'selected' : '' }}>Pending</option>
                                        <option value="2" {{ $batch->status == 2 ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('layouts.footer')
