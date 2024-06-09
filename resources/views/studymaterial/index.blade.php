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
            <h1>Study Material</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Study Material</li>
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
           
              <div class="card-body">
               <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                   <th>Sr. No</th>
                 
                    <th>Title</th>             
                    <th>Domain Name</th>        
                    <th>Topic</th>     
                    <th>Description</th>   
                    <th>Link</th>                     
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>              
             
               
                   @php $i = 1;@endphp
                   @foreach ($jobs as $material)
                   <tr>
                        <td>{{ $i++ }}</td>
                      
                       
                        <td>{{ $material->title }}</td>               
                        <td>{{ $material->domain->name }}</td>
                        <td>{{ $material->topic->name }}</td>
                        <td>{{ $material->description }}</td>
                        <td>{{ $material->file_path }}</td>                    
                                           
                        <td class="text-right py-0 align-middle">
                        <div class="btn-group btn-group-sm">
                        <a class="btn btn-info btn-sm" href="{{ route('study_edit', $material->id) }}">
                            <i class="fas fa-pencil-alt"></i>
                            Edit
                        </a>

                  <a href="{{ route('study_delete', $material->id) }}" class="btn btn-danger ms-2" onclick="return confirm('Are you sure you want to delete this Job?')">
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
