@extends('layouts.admin', [
    'page_header' => 'SUBJECTS',
    'dash' => '',
    'examinees' => '',
    'quiz' => '',
    'users' => '',
    'questions' => 'active',
    'sett' => '',
])

@section('content')
    <div class="row">

        <div style="margin-top: 50px; margin-bottom: 50px; display: flex; align-items: center;">
            <a href="javascript:void(0)" class="slim-menu" style="display: flex; align-items: center; width: 200px; gap: 10px;" data-toggle="modal" data-target="#createModal"
                title="Create Applicant">
                <img src="{{ asset('images/vectors/create-exam.png') }}" alt="Create Exam" style="width: 20px;">
                <span>
                    Create Exam
                </span>
            </a>

            <a href="{{ route('export') }}" class="slim-menu">
                <span>
                    <i class="fa fa-file-excel-o"></i> Export Questions Template
                </span>
            </a>
        </div>

        {{-- CREATE MODAL --}}
        <div id="createModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Quiz</h4>
                    </div>

                    <form method="POST" action="{{ action([App\Http\Controllers\TopicController::class, 'store']) }}">
                        @csrf

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                        <label>Quiz Title <span class="required">*</span></label>
                                        <input type="text" name="title" class="form-control"
                                            value="{{ old('title') }}" required>
                                        <small class="text-danger">{{ $errors->first('title') }}</small>
                                    </div>

                                    <div class="form-group{{ $errors->has('timer') ? ' has-error' : '' }}">
                                        <label>Quiz Time (in minutes)</label>
                                        <input type="number" name="timer" class="form-control"
                                            value="{{ old('timer') }}" min="1" required>
                                        <small class="text-danger">{{ $errors->first('timer') }}</small>
                                    </div>

                                    <div class="form-group{{ $errors->has('set') ? ' has-error' : '' }}">
                                        <label>Numbers of Set</label>
                                        <input type="number" name="set" class="form-control"
                                            value="{{ old('set', 1) }}" min="1" required>
                                        <small class="text-danger">{{ $errors->first('set') }}</small>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control" rows="8">{{ old('description') }}</textarea>
                                        <small class="text-danger">{{ $errors->first('description') }}</small>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="reset" class="btn btn-default">Reset</button>
                            <button type="submit" class="btn btn-wave">Add</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div> {{-- END ROW FOR HEADER AND MODAL --}}

    <div class="row">

        @if ($topics)
            @foreach ($topics as $topic)
                <div class="col-md-4">

                    <div class="quiz-card">

                        {{-- FIXED FLEX HEADER BUTTONS --}}
                        <div style="display:flex; gap:5px; justify-content:flex-end; margin-bottom:10px;">
                            <a data-target="#editModal{{ $topic->id }}" data-toggle="modal" class="btn btn-info btn-xs">
                                <i class="fa fa-edit"></i>
                            </a>

                            <a data-target="#deleteModal{{ $topic->id }}" data-toggle="modal"
                                class="btn btn-danger btn-xs">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>

                        <h3 class="quiz-name">{{ $topic->title }}</h3>

                        <p title="{{ $topic->description }}">
                            {{ Str::limit($topic->description, 120) }}
                        </p>

                        <div class="row">
                            <div class="col-xs-6 pad-0">
                                <ul class="topic-detail">
                                    <li>Total Questions</li>
                                    <li>Total Time</li>
                                    <li>Total Set</li>
                                </ul>
                            </div>

                            <div class="col-xs-6">
                                <ul class="topic-detail right">
                                    <li>{{ $questions->where('topic_id', $topic->id)->count() }}</li>
                                    <li>{{ $topic->timer }} minutes</li>
                                    <li>{{ $topic->set }}</li>
                                </ul>
                            </div>
                        </div>

                        <a href="{{ route('questions.show', $topic->id) }}" class="btn btn-wave">View Questions</a>
                        <a data-target="#deleteAll{{ $topic->id }}" data-toggle="modal" class="btn btn-danger">Delete
                            All Questions</a>

                    </div>

                    {{-- DELETE ALL QUESTIONS MODAL --}}
                    <div id="deleteAll{{ $topic->id }}" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button class="close" data-dismiss="modal">&times;</button>
                                    <div class="delete-icon"></div>
                                </div>

                                <div class="modal-body text-center">
                                    <h4>Are You Sure?</h4>
                                    <p>This cannot be undone.</p>
                                </div>

                                <form method="POST"
                                    action="{{ action([App\Http\Controllers\TopicController::class, 'deleteperquizsheet'], $topic->id) }}">
                                    @csrf
                                    @method('DELETE')

                                    <div class="modal-footer">
                                        <button class="btn btn-gray" data-dismiss="modal">No</button>
                                        <button class="btn btn-danger">Yes</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                    {{-- DELETE TOPIC MODAL --}}
                    <div id="deleteModal{{ $topic->id }}" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button class="close" data-dismiss="modal">&times;</button>
                                    <div class="delete-icon"></div>
                                </div>

                                <div class="modal-body text-center">
                                    <h4>Are You Sure?</h4>
                                    <p>This record cannot be undone.</p>
                                </div>

                                <form method="POST"
                                    action="{{ action([App\Http\Controllers\TopicController::class, 'deleteTopic'], $topic->id) }}">
                                    @csrf
                                    @method('DELETE')

                                    <div class="modal-footer">
                                        <button class="btn btn-gray" data-dismiss="modal">No</button>
                                        <button class="btn btn-danger">Yes</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                    {{-- EDIT MODAL --}}
                    <div id="editModal{{ $topic->id }}" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button class="close" data-dismiss="modal">&times;</button>
                                    <h4>Edit Quiz</h4>
                                </div>

                                <form method="POST"
                                    action="{{ action([App\Http\Controllers\TopicController::class, 'update'], $topic->id) }}">
                                    @csrf
                                    @method('PATCH')

                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label>Quiz Title</label>
                                            <input type="text" name="title" class="form-control"
                                                value="{{ $topic->title }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Quiz Time (minutes)</label>
                                            <input type="number" name="timer" class="form-control"
                                                value="{{ $topic->timer }}">
                                        </div>

                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description" class="form-control">{{ $topic->description }}</textarea>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-wave" type="submit">Update</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        @endif

    </div> {{-- END ROW --}}
@endsection
