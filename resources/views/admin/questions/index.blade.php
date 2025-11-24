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

        <div style="margin-bottom:50px">
            <a href="javascript:void(0)" class="slim-menu" data-toggle="modal" data-target="#createModal"
                title="Create Applicant">
                <span>
                    <img src="{{ asset('/images/vectors/create-exam.png') }}" alt="Create Exam" style="width: 48px">
                    Create Exam
                </span>

            </a>
            <a href="{{ route('export') }}" class="slim-menu">
                <span>
                    <i class="fa fa-file-excel-o"></i> Export Questions Template
                </span>

            </a>
        </div>
        <div class="dash-menu">

        </div>
        <!-- Create Modal -->
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
                                    <!-- Quiz Title -->
                                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                        <label for="title">Quiz Title <span class="required">*</span></label>
                                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                                            class="form-control" placeholder="Please Enter Quiz Title" required>
                                        <small class="text-danger">{{ $errors->first('title') }}</small>
                                    </div>

                                    <!-- Quiz Time -->
                                    <div class="form-group{{ $errors->has('timer') ? ' has-error' : '' }}">
                                        <label for="timer">Quiz Time (in minutes)</label>
                                        <input type="number" name="timer" id="timer" value="{{ old('timer') }}"
                                            class="form-control" placeholder="Please Enter Quiz Total Time (In Minutes)"
                                            min="1" required>
                                        <small class="text-danger">{{ $errors->first('timer') }}</small>
                                    </div>

                                    <!-- Numbers of Set -->
                                    <div class="form-group{{ $errors->has('set') ? ' has-error' : '' }}">
                                        <label for="set">Numbers of Set</label>
                                        <input type="number" name="set" id="set" value="{{ old('set', 1) }}"
                                            class="form-control" placeholder="Please Enter Numbers of Set" min="1"
                                            required>
                                        <small class="text-danger">{{ $errors->first('set') }}</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <!-- Description -->
                                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" class="form-control" rows="8"
                                            placeholder="Please Enter Quiz Description">{{ old('description') }}</textarea>
                                        <small class="text-danger">{{ $errors->first('description') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <div class="btn-group pull-right">
                                <button type="reset" class="btn btn-default">Reset</button>
                                <button type="submit" class="btn btn-wave">Add</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        @if ($topics)
            @foreach ($topics as $key => $topic)
                <div class="col-md-4">
                    <div class="quiz-card">
                        <div style="display: flex-inline;flex-end:space-between;float:right">
                            <a data-target="#{{ $topic->id }}EditModal" data-toggle="modal" title="Edit Topic"
                                href="javascript:void(0)" class="btn btn-info btn-xs">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </a>
                            <a data-target="#{{ $topic->id }}deleteModal" data-toggle="modal" title="Delete Topic"
                                href="javascript:void(0)" class="btn btn-danger btn-xs">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </div>
                        <h3 class="quiz-name">{{ $topic->title }}</h3>

                        <p title="{{ $topic->description }}">
                            {{ Str::limit($topic->description, 120) }}
                        </p>
                        <div class="row">
                            <div class="col-xs-6 pad-0">
                                <ul class="topic-detail">
                                    <li>Total Questions <i class="fa fa-long-arrow-right"></i></li>
                                    <li>Total Time <i class="fa fa-long-arrow-right"></i></li>
                                    <li>Total Set <i class="fa fa-long-arrow-right"></i></li>
                                </ul>
                            </div>
                            <div class="col-xs-6">
                                <ul class="topic-detail right">
                                    @php
                                        $qu_count = 0;
                                    @endphp
                                    @foreach ($questions as $question)
                                        @if ($question->topic_id == $topic->id)
                                            @php
                                                $qu_count++;
                                            @endphp
                                        @endif
                                    @endforeach
                                    <li>
                                        {{ $qu_count }}
                                    </li>
                                    <li>
                                        {{ $topic->timer }} minutes
                                    </li>
                                    <li>
                                        {{ $topic->set }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <a href="{{ route('questions.show', $topic->id) }}" class="btn btn-wave">View Questions</a>
                        <a data-target="#deleteans{{ $topic->id }}" data-toggle="modal" class="btn btn-danger">Delete
                            All Questions</a>
                    </div>

                    <div id="deleteans{{ $topic->id }}" class="delete-modal modal fade" role="dialog">
                        <!-- Delete Modal -->
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <div class="delete-icon"></div>
                                </div>
                                <div class="modal-body text-center">
                                    <h4 class="modal-heading">Are You Sure ?</h4>
                                    <p>Do you really want to delete these Quiz Answer Sheet? This process cannot be undone.
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <form method="POST"
                                        action="{{ action([App\Http\Controllers\TopicController::class, 'deleteperquizsheet'], $topic->id) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button type="reset" class="btn btn-gray" data-dismiss="modal">No</button>
                                        <button type="submit" class="btn btn-danger">Yes</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="{{ $topic->id }}deleteModal" class="delete-modal modal fade" role="dialog">
                        <!-- Delete Modal -->
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <div class="delete-icon"></div>
                                </div>
                                <div class="modal-body text-center">
                                    <h4 class="modal-heading">Are You Sure ?</h4>
                                    <p>Do you really want to delete these records? This process cannot be undone.</p>
                                </div>
                                <div class="modal-footer">
                                    <form method="POST"
                                        action="{{ action([App\Http\Controllers\TopicController::class, 'deleteTopic'], $topic->id) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button type="reset" class="btn btn-gray" data-dismiss="modal">No</button>
                                        <button type="submit" class="btn btn-danger">Yes</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="{{ $topic->id }}EditModal" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Edit Quiz</h4>
                                </div>
                                <form method="POST"
                                    action="{{ action([App\Http\Controllers\TopicController::class, 'update'], $topic->id) }}">
                                    @csrf
                                    @method('PATCH')

                                    <div class="modal-body">
                                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                            <label for="title">Topic Title</label>
                                            <span class="required">*</span>
                                            <input type="text" name="title" id="title" class="form-control"
                                                placeholder="Please Enter Quiz Title"
                                                value="{{ old('title', $topic->title) }}" required>
                                            <small class="text-danger">{{ $errors->first('title') }}</small>
                                        </div>

                                        <div class="form-group{{ $errors->has('timer') ? ' has-error' : '' }}">
                                            <label for="timer">Quiz Time (in minutes)</label>
                                            <input type="number" name="timer" id="timer" class="form-control"
                                                placeholder="Please Enter Quiz Total Time (In Minutes)"
                                                value="{{ old('timer', $topic->timer) }}">
                                            <small class="text-danger">{{ $errors->first('timer') }}</small>
                                        </div>

                                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" class="form-control" placeholder="Please Enter Quiz Description">{{ old('description', $topic->description) }}</textarea>
                                            <small class="text-danger">{{ $errors->first('description') }}</small>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <div class="btn-group pull-right">
                                            <button type="submit" class="btn btn-wave">Update</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
