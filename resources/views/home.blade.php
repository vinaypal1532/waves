@include('layouts.app')
@include('layouts.sidebar')

<div class="content-wrapper">
    
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
   
    <section class="content">
        <div class="container-fluid">
     
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                           <h3>{{ $domain }}</h3>
                            <p>Domain</p>
                        </div>
                    </div>
                </div>
          
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                        <h3>{{ $domain }}</h3>
                            <p>Topic</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                        <h3>{{ $user }}</h3>
                            <p>User</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                        <h3>{{ $contact }}</h3>
                            <p>Contact </p>
                        </div>
                    </div>
                </div>

                 <div class="col-lg-3 col-6">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>{{ $smscount }}</h3>
                            <p>SMS Available </p>
                        </div>
                    </div>
                </div> 

               <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $jobs }}</h3>
                            <p>Jobs</p>
                        </div>
                    </div>
                </div> 
                 <div class="col-lg-3 col-6">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                        <h3>{{ $ques }}</h3>
                            <p>Question</p>
                        </div>
                    </div>
                </div> 

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-dark">
                        <div class="inner">
                        <h3>{{ $report }}</h3>
                        <p>Test Completed </p>
                        </div>
                    </div>
                </div> 
            </div>
          
            <div class="row">
         
            </div>
        </div>
    </section>
</div>

@include('layouts.footer')
