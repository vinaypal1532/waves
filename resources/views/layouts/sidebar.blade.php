@include('layouts.menu')

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      <img src="{{ asset('asset/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">   
    
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         
          <li class="nav-item menu-open">
            <a href="{{ route('home') }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard               
              </p>
            </a>
          
          </li>
        
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-sitemap"></i>
              <p>
              Users 
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
            <li class="nav-item">
                <a href="{{ route('user-list') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User </p>
                </a>
              </li>
             
              <li class="nav-item">
                <a href="{{ route('test-report') }} " class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User Test Reports</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('user-contact') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User Contact Data</p>
                </a>
              </li>

            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('contact-list') }}" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>   Inquiry  </p>
            </a>
          </li>
         
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-sitemap"></i>
              <p>
              Question
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
            <li class="nav-item">
                <a href="{{ route('question') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Question</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('add_question') }} " class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Question </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-sitemap"></i>
              <p>
              Domain
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
            <li class="nav-item">
                <a href="{{ route('domain') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Domain</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('add_domain') }} " class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Domain </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-sitemap"></i>
              <p>
              Topic
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
            <li class="nav-item">
                <a href="{{ route('topic') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Topic</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('add_topic') }} " class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Topic </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-sitemap"></i>
              <p>
              Jobs 
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
            <li class="nav-item">
                <a href="{{ route('job') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Jobs</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('add_job') }} " class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Jobs </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('job-applied-list') }} " class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Job Applied list </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-sitemap"></i>
              <p>
              Study Material 
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
            <li class="nav-item">
                <a href="{{ route('studymaterial') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Study Material </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('add_studymaterial') }} " class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Study Material  </p>
                </a>
              </li>
             
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-sitemap"></i>
              <p>
              Video Material 
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
            <li class="nav-item">
                <a href="{{ route('video') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Video</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('add_video') }} " class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Video  </p>
                </a>
              </li>
             
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-sitemap"></i>
              <p>
          Event Images
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
            <li class="nav-item">
                <a href="{{ route('event') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Event Image </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('add_event') }} " class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Event Image  </p>
                </a>
              </li>
             
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-sitemap"></i>
              <p>
            Batches
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
            <li class="nav-item">
                <a href="{{ route('batches') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Batch </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('add_batch') }} " class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Batch  </p>
                </a>
              </li>
             
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-image"></i>
              <p>
              Banner
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('banner') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Banner List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('add_banner') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Banner </p>
                </a>
              </li>
             
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
              Logout
              </p>
            </a>
          </li>
         
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>