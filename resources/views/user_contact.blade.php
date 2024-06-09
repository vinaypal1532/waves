@include('layouts.app')
@include('layouts.sidebar')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

<style>
 .badge {
    cursor: pointer;
  }
  </style>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Contact</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"> User Contact </li>
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
           
            <div class="card-body" style="overflow-x:auto;">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                   <th>Sr. No</th>
                    <th>Name</th>
                    <th>Mobile No</th>                 
                    <th>Created Date</th>
                 
                
                  </tr>
                  </thead>
                  <tbody>              
             
               
                  @php $i = 1;@endphp
                   @foreach ($usercontact as $user)
                   <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->mobile }}</td>
                                   
                        <td>{{ $user->created_at }}</td>
                        
                   
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
        // $.noConflict();
        jQuery(document).ready(function ($) {
            $('#example1').DataTable();
        });
   
    function changeStatus(userId, newStatus) {
     
        $.ajax({
            type: 'PUT',
            url: '/users/' + userId, 
            data: {
                _token: '{{ csrf_token() }}',
                status: newStatus
            },
            success: function(response) {             
              
                // $('#example1').DataTable().ajax.reload();
                location.reload();
                
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
</script>
@include('layouts.footer')
