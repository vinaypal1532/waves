@include('layouts.app')
@include('layouts.sidebar')

   <div class="content-wrapper">
  
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Topic </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Topic </li>
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

            <form action="{{ route('add_topicData') }}" method="post" enctype="multipart/form-data">
                 @csrf
                <div class="card-body">
                  
                  <div class="form-group">
                    <label for="exampleInputPassword1">Name</label>
                    <input type="text" class="form-control" name="name" id="exampleInputPassword1" placeholder="Name">
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
                    <label for="exampleInputPassword1">Image (64 * 64 )</label>
                    <input type="file" class="form-control" name="image" id="exampleInputPassword1" placeholder="icons">
                  </div>
                  
                  
                  <div class="form-group">
                    <label for="exampleInputPassword1">status</label>
                    <select id="fruitSelect" name="status" class="form-control">
                      <option value="1">Active</option>
                      <option value="0">Pending</option>
                      <option value="2">Rejected</option>
                      
                  </select>                    
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
