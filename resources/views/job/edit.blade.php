@include('layouts.app')
@include('layouts.sidebar')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Job</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Job</li>
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
                                <form action="{{ route('updateJob', $job->id) }}" method="POST">
                                @csrf
                                @method('POST')

                                <div class="form-group">
                                    <label for="domain">Domain</label>
                                    <select id="domain" name="domain" class="form-control">
                                        <option value="">Select Domain</option>
                                        @foreach ($domains as $domain)
                                        <option value="{{ $domain->id }}" {{ $domain->id == $job->domain ? 'selected' : '' }}>{{ $domain->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control" id="title" value="{{ $job->title }}" placeholder="Title">
                                </div>

                                <div class="form-group">
                                    <label for="c_name">Company Name</label>
                                    <input type="text" name="c_name" class="form-control" id="c_name" value="{{ $job->c_name }}" placeholder="Company Name">
                                </div>

                                <div class="form-group">
                                    <label for="mobile_no">Mobile No</label>
                                    <input type="text" name="mobile_no" class="form-control" id="mobile_no" value="{{ $job->mobile_no }}" placeholder="Mobile No">
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" value="{{ $job->email }}" placeholder="Email">
                                </div>

                                <div class="form-group">
                                    <label for="contact_person">Contact Person Name</label>
                                    <input type="text" name="contact_person" class="form-control" id="contact_person" value="{{ $job->contact_person }}" placeholder="Contact Person Name">
                                </div>
                                
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input type="text" name="location" class="form-control" id="location" value="{{ $job->location }}" placeholder="Location">
                                </div>
                                

                                <div class="form-group">
                                    <label for="exp">Experience</label>
                                    <select name="exp" class="form-control" id="exp">
                                        <option value="0-2" {{ $job->exp == '0-2' ? 'selected' : '' }}>0-2 years</option>
                                        <option value="2-4" {{ $job->exp == '2-4' ? 'selected' : '' }}>2-4 years</option>
                                        <option value="4-6" {{ $job->exp == '4-6' ? 'selected' : '' }}>4-6 years</option>
                                        <option value="6-8" {{ $job->exp == '6-8' ? 'selected' : '' }}>6-8 years</option>
                                        <option value="8+" {{ $job->exp == '8+' ? 'selected' : '' }}>8+ years</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="no_position">No of Position</label>
                                    <input type="text" name="no_position" class="form-control" id="no_position" value="{{ $job->no_position }}" placeholder="No of Position">
                                </div>
                                <div class="form-group">
                                    <label for="end_data">End Date</label>
                                    <input type="date" name="end_data" class="form-control" id="end_data" placeholder="No of Position" placeholder="End Date" min="<?= date('Y-m-d'); ?>" value="{{ $job->end_data }}">
                                </div>

                                <div class="form-group">
                                    <label for="details">Details</label>
                                    <textarea name="details" class="form-control" id="details">{{ $job->details }}</textarea>
                                </div>
                                <div class="form-group">
                                <label for="details">Hide</label>

                                <div class="form-group form-check">
                                    <input type="checkbox" name="is_c_name" class="form-check-input" id="is_c_name" {{ $job->is_c_name ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_c_name">Company Name</label>
                                </div>

                                <div class="form-group form-check">
                                    <input type="checkbox" name="is_email" class="form-check-input" id="is_email" {{ $job->is_email ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_email">Email</label>
                                </div>

                                <div class="form-group form-check">
                                    <input type="checkbox" name="is_mobile" class="form-check-input" id="is_mobile" {{ $job->is_mobile ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_mobile">Mobile</label>
                                </div>

                                <div class="form-group form-check">
                                    <input type="checkbox" name="is_contact_person" class="form-check-input" id="is_contact_person" {{ $job->is_contact_person ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_contact_person">Contact Person Name</label>
                                </div>
                             </div>

                               <input type="hidden" name="job_id"  value="{{ $job->job_id }}">

                               <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="1" {{ $job->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $job->status == 0 ? 'selected' : '' }}>Pending</option>
                                    <option value="2" {{ $job->status == 2 ? 'selected' : '' }}>Block</option>
                                </select>
                            </div>


                                <button type="submit" class="btn btn-primary">Update Job</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('layouts.footer')
