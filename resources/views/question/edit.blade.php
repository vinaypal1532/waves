@include('layouts.app')
@include('layouts.sidebar')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Question</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Question</li>
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
                            <form action="{{ route('updateQuestion', $question->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="topic_id">Topic</label>
                                    <select id="topic_id" name="topic_id" class="form-control">
                                        <option value="">Select Domain</option>
                                        @foreach ($topics as $topic)
                                        <option value="{{ $topic->id }}" {{ $topic->id == $question->topic_id ? 'selected' : '' }}>{{ $topic->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select id="type" name="type" class="form-control">
                                        <option value="basic" {{ $question->type == 'basic' ? 'selected' : '' }}>Basic</option>
                                        <option value="standard" {{ $question->type == 'standard' ? 'selected' : '' }}>Standard</option>
                                        <option value="advance" {{ $question->type == 'advance' ? 'selected' : '' }}>Advance</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="question">Question</label>
                                    <textarea type="text" name="question" class="form-control" id="question">{{ $question->question }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="options">Options</label>
                                    @foreach ($question->options as $option)
                                    <input type="text" name="options[]" class="form-control" value="{{ $option->option }}"><br/>
                                    @endforeach
                                </div>

                                <div class="form-group">
                                    <label for="question">Right Answer</label>
                                    <input type="text" name="result" class="form-control" value="{{ $question->result }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Update Question</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('layouts.footer')
