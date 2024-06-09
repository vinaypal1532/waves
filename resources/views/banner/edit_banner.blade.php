@include('layouts.app')
@include('layouts.sidebar')

   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Banner </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Banner  </li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
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

<form method="POST" action="{{ route('updateBanner', $banner->id) }}" enctype="multipart/form-data">
            @csrf
    @method('PUT')
                <div class="card-body">
                 
                  <div class="form-group">
                    <label for="exampleInputPassword1">Title</label>
                    <input type="text" name="title" value="{{ $banner->title }}" class="form-control" required>
                  </div>               
                          

                  <div class="form-group">
                    <label for="exampleInputPassword1">Image</label>
                    <input type="file" name="image_path" value="{{ $banner->image_path }}" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="1" @if ($banner->status == 1) selected @endif>Active</option>
                        <option value="0" @if ($banner->status == 0) selected @endif>Pending</option>
                        <option value="2" @if ($banner->status == 2) selected @endif>Rejected</option>
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
