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
              <div class="card-body">         
              <form action="{{ route('upload') }}" method="POST">
                @csrf

                <div class="form-group">
                  <label for="topic_id">Topic</label>
                  <select id="topic_id" name="topic_id" class="form-control">
                      <option value="">Select Domain</option>
                      @foreach ($topics as $topic)
                          <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                      @endforeach
                  </select>
                   </div>

                  <div class="form-group">
                    <label for="type">Type</label>
                      <select id="type" name="type" class="form-control">                                  
                            <option value="basic">Basic</option>
                            <option value="standard">Standard</option>
                            <option value="advance">Advance</option>                    
                      </select>
                  </div>

                <div class="form-group">
                    <label for="question">Question</label>
                    <textarea type="text" name="question" class="form-control" id="question"></textarea>
                </div>

                
                <div class="form-group">
                    <label for="options">Options</label>
                    <input type="text" name="options[]" class="form-control" id="option1" placeholder="option1"> <br/>
                    <input type="text" name="options[]" class="form-control" id="option2" placeholder="option2"><br/>
                    <input type="text" name="options[]" class="form-control" id="option3" placeholder="option3"><br/>
                    <input type="text" name="options[]" class="form-control" id="option4" placeholder="option4">
                </div>

                <div class="form-group">
                    <label for="question">Right Answer</label>
                    <input type="text" name="result" class="form-control" id="result" placeholder="Enter A,B,C,D option">
                </div>

                <button type="submit" class="btn btn-primary">Upload Question</button>
              </form>
            </div>
            </div>
          </div>
         
        </div>
     
      </div>
    </section>
   
  </div> 

@include('layouts.footer')
