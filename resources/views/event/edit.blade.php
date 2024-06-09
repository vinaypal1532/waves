@include('layouts.app')
@include('layouts.sidebar')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Event Image</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Event Image</li>
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
                        <div class="card-body">                        
                        <form action="{{ route('event_update', $event->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')

                                <div class="form-group">
                                    <label for="domain_id">Domain</label>
                                    <select id="domain_id" name="domain_id" class="form-control">
                                        <option value="">Select Domain</option>
                                        @foreach ($domains as $domain)
                                        <option value="{{ $domain->id }}" {{ $domain->id == $event->domain_id ? 'selected' : '' }}>{{ $domain->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="topic_id">Topic</label>
                                    <select id="topic_id" name="topic_id" class="form-control">
                                        <option value="">Select Topic</option>
                                        @foreach ($topics as $topic)
                                        <option value="{{ $topic->id }}" {{ $topic->id == $event->topic_id ? 'selected' : '' }}>{{ $topic->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control" id="title" value="{{ $event->title }}" placeholder="Title">
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" name="description" class="form-control" id="description" value="{{ $event->description }}" placeholder="Description">
                                </div>
                                <input type="hidden" name="type" value="{{ $event->type }}">
                                <div class="form-group">
                                    <label for="file_path">File</label>
                                    <input type="file" name="file_path" class="form-control" id="file_path" placeholder="File">
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select id="status" name="status" class="form-control">
                                        <option value="1" {{ $event->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $event->status == 0 ? 'selected' : '' }}>Pending</option>
                                        <option value="2" {{ $event->status == 2 ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('layouts.footer')
