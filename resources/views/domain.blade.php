@include('layouts.app')
@include('layouts.sidebar')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
  <div class="content-wrapper">
    <section class="content-header">
      
      <div class="container-fluid">
        @if(session('status'))
      <div class="alert alert-success">
          {{ session('status') }}
      </div>
      @endif

        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Domain</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Domain</li>
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
                 
                    <th>Name</th>             
                 
                    <th>Icons</th>
                    <th>Status</th>
                    
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>              
             
               
                   @php $i = 1;@endphp
                   @foreach ($service as $services)
                   <tr>
                        <td>{{ $i++ }}</td>
                      
                       
                        <td>{{ $services->name }}</td>               
                   
                 
                        <td>
                          @if($services->image)
                              <img src="{{ asset('images/' . $services->image) }}" alt="{{ $services->name }}" style="max-width: 50px; max-height: 50px;">
                          @else
                              No Image
                          @endif
                      </td>

                        <td class="project-state">
                                @if ($services->status == 1)
                                <span class="badge badge-success">Success</span>
                                @elseif ($services->status == 0)
                                <span class="badge badge-warning">Pending</span>
                                @endif
            
                          </td>
                      
                        <td class="text-right py-0 align-middle">
                        <div class="btn-group btn-group-sm">
                        <a class="btn btn-info btn-sm" href="{{ route('domain_edit', $services->id) }}">
                            <i class="fas fa-pencil-alt"></i>
                            Edit
                        </a>

                  <a href="{{ route('domain_delete', $services->id) }}" class="btn btn-danger ms-2" onclick="return confirm('Are you sure you want to delete this Domain?')">
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
