@include('layouts.app')
@include('layouts.sidebar')

<div class="content-wrapper">
  
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Jobs</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Jobs</li>
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
                            <form action="{{ route('job_upload') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="domain">Domain</label>
                                    <select id="domain" name="domain" class="form-control">
                                        <option value="">Select Domain</option>
                                        @foreach ($domains as $domain)
                                            <option value="{{ $domain->id }}">{{ $domain->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                                </div>

                                <div class="form-group">
                                    <label for="c_name">Company Name</label>
                                    <input type="text" name="c_name" class="form-control" id="c_name" placeholder="Company Name">
                                </div>

                                <div class="form-group">
                                    <label for="mobile_no">Mobile No</label>
                                    <input type="text" name="mobile_no" class="form-control" id="mobile_no" placeholder="Mobile No">
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                                </div>

                                <div class="form-group">
                                    <label for="contact_person">Contact Person Name</label>
                                    <input type="text" name="contact_person" class="form-control" id="contact_person" placeholder="Contact Person Name">
                                </div>
                                
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input type="text" name="location" class="form-control" id="location" placeholder="Location">
                                </div>

                                <div class="form-group">
                                    <label for="exp">Experience</label>
                                    <select name="exp" class="form-control" id="exp">
                                        <option value="0-2">0-2 years</option>
                                        <option value="2-4">2-4 years</option>
                                        <option value="4-6">4-6 years</option>
                                        <option value="6-8">6-8 years</option>
                                        <option value="8+">8+ years</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="no_position">No of Position</label>
                                    <input type="text" name="no_position" class="form-control" id="no_position" placeholder="No of Position">
                                </div>

                                 <div class="form-group">
                                 <label for="end_data">End Date</label>
                                 <input type="date" name="end_data" class="form-control" id="end_data" placeholder="End Date" min="<?= date('Y-m-d'); ?>">
                                 </div>


                                <div class="form-group">
                                    <label for="details">Details</label>
                                    <textarea name="details" class="form-control" id="details"></textarea>
                                </div>
                                <div class="form-group">
                                <label for="details">Hide</label>
                                <div class="form-group form-check">
                                    <input type="checkbox" name="is_c_name" class="form-check-input" id="is_c_name">
                                    <label class="form-check-label" for="is_c_name">Company Name</label>
                                </div>

                                <div class="form-group form-check">
                                    <input type="checkbox" name="is_email" class="form-check-input" id="is_email">
                                    <label class="form-check-label" for="is_email">Email</label>
                                </div>

                                <div class="form-group form-check">
                                    <input type="checkbox" name="is_mobile" class="form-check-input" id="is_mobile">
                                    <label class="form-check-label" for="is_mobile">Mobile</label>
                                </div>

                                <div class="form-group form-check">
                                    <input type="checkbox" name="is_contact_person" class="form-check-input" id="is_contact_person">
                                    <label class="form-check-label" for="is_contact_person">Contact Person Name</label>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control" id="status">
                                        <option value="1">Active</option>
                                        <option value="0">Pending</option>
                                        <option value="2">Block</option>                                       
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('layouts.footer')
