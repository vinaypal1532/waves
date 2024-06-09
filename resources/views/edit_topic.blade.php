@include('layouts.app')
@include('layouts.sidebar')

   <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Topic </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Topic  </li>
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

<form method="POST" action="{{ route('updateTopic', $topic->id) }}" enctype="multipart/form-data">
            @csrf
    @method('PUT')
                <div class="card-body">
                 
                  <div class="form-group">
                    <label for="exampleInputPassword1">Name</label>
                    <input type="text" name="name" value="{{ $topic->name }}" class="form-control" required>
                  </div>    

                  <div class="form-group">
            <label for="domain_id">Domain</label>
            <select id="domain_id" name="domain_id" class="form-control">
                <option value="">Select Domain</option>
                @foreach ($domain as $domain)
                    <option value="{{ $domain->id }}" @if($topic->domain_id == $domain->id) selected @endif>{{ $domain->name }}</option>
                @endforeach
            </select>
        </div>


                  <div class="form-group">
                    <label for="exampleInputPassword1">Image</label>
                    <input type="file" name="image" value="{{ $topic->image }}" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="1" @if ($topic->status == 1) selected @endif>Active</option>
                        <option value="0" @if ($topic->status == 0) selected @endif>Pending</option>
                        <option value="2" @if ($topic->status == 2) selected @endif>Rejected</option>
                    </select>
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
