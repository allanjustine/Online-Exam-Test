@extends('layouts.admin', [
    'page_header' => "{$topic->title}/Questions",
    'dash' => '',
    'examinees' => '',
    'quiz' => '',
    'users' => '',
    'questions' => 'active',
    'sett' => '',
])

@section('content')
    <div class="margin-bottom">
        <button type="button" class="btn btn-wave" data-toggle="modal" data-target="#createModal">Add Question</button>
        <button type="button" class="btn btn-wave" data-toggle="modal" data-target="#importQuestions">Import Questions</button>
        @if (!$questions->isEmpty())
            <button type="button" class="btn btn-wave" data-toggle="modal" data-target="#uploadImgs">Upload Images</button>
        @endif
    </div>
    <!-- Create Modal -->
    <div id="createModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div id="m-content" class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Question</h4>
                </div>
                <form method="POST" action="{{ action([App\Http\Controllers\QuestionsController::class, 'store']) }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="hidden" name="topic_id" value="{{ $topic->id }}">

                                <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
                                    <label for="question">Question</label>
                                    <span class="required">*</span>
                                    <textarea name="question" id="question" class="form-control" placeholder="Please Enter Question" rows="8"
                                        required>{{ old('question') }}</textarea>
                                    <small class="text-danger">{{ $errors->first('question') }}</small>
                                </div>

                                <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                                    <label for="answer">Correct Answer</label>
                                    <input type="text" name="answer" id="answer" class="form-control"
                                        placeholder="Please Enter Correct Answer" value="{{ old('answer') }}">
                                    <small class="text-danger">{{ $errors->first('answer') }}</small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group{{ $errors->has('choices') ? ' has-error' : '' }}">
                                    <label for="choices">Choices</label>
                                    <p>Note: Please separate choices with comma.</p>
                                    <textarea name="choices" id="choices" class="form-control" placeholder="Please Enter Choices" rows="8">{{ old('choices') }}</textarea>
                                    <small class="text-danger">{{ $errors->first('choices') }}</small>
                                </div>

                                <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                    <label for="type">Question Type</label>
                                    <span class="required">*</span>
                                    <select name="type" id="type" class="form-control select2" required>
                                        <option value="multiple" {{ old('type') == 'multiple' ? 'selected' : '' }}>Multiple
                                            Choice</option>
                                        <option value="essay" {{ old('type') == 'essay' ? 'selected' : '' }}>Essay
                                        </option>
                                    </select>
                                    <small class="text-danger">{{ $errors->first('type') }}</small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group{{ $errors->has('underline') ? ' has-error' : '' }}">
                                    <label for="underline">Underline Words</label>
                                    <p>Note: If you want to underline some words in question, separate with comma.</p>
                                    <textarea name="underline" id="underline" class="form-control" placeholder="Separate with comma" rows="4">{{ old('underline') }}</textarea>
                                    <small class="text-danger">{{ $errors->first('underline') }}</small>
                                </div>

                                <div class="form-group{{ $errors->has('question_img') ? ' has-error' : '' }}">
                                    <label for="question_img">Add Image To Question</label>
                                    <input type="file" name="question_img" id="question_img">
                                    <small class="text-danger">{{ $errors->first('question_img') }}</small>
                                    <p class="help">Please Choose Only .JPG, .JPEG and .PNG</p>
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
    <!-- Import Questions Modal -->
    <div id="importQuestions" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Import Questions (Excel File With Exact Header of DataBase Field)</h4>
                </div>
                <form method="POST"
                    action="{{ action([App\Http\Controllers\QuestionsController::class, 'importExcelToDB']) }}"
                    enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="topic_id" value="{{ $topic->id }}">

                    <div class="modal-body">
                        <div class="form-group{{ $errors->has('question_file') ? ' has-error' : '' }}">
                            <label for="question_file" class="col-sm-3 control-label">Import Question Via Excel
                                File</label>
                            <span class="required">*</span>
                            <div class="col-sm-9">
                                <input type="file" name="question_file" id="question_file" required>
                                <p class="help-block">Only Excel File (.CSV and .XLS)</p>
                                <small class="text-danger">{{ $errors->first('question_file') }}</small>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="btn-group pull-right">
                            <button type="reset" class="btn btn-default">Reset</button>
                            <button type="submit" class="btn btn-wave">Import</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div id="uploadImgs" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Upload Multiple Images to Question Files</h4>
                </div>
                <form method="POST" action="{{ action([App\Http\Controllers\AdminController::class, 'uploadImages']) }}"
                    enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="topic_id" value="{{ $topic->id }}">

                    <div class="modal-body">
                        <div class="form-group{{ $errors->has('img') ? ' has-error' : '' }}">
                            <label for="img" class="col-sm-3 control-label">Import Multiple Picture</label>
                            <span class="required">*</span>
                            <div class="col-sm-9">
                                <input type="file" name="img[]" id="img" required multiple
                                    accept="image/x-png,image/gif,image/jpeg,image/svg+xml">
                                <p class="help-block">Only PNG, JPEG, and SVG are allowed.</p>
                                <small class="text-danger">{{ $errors->first('img') }}</small>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="btn-group pull-right">
                            <button type="reset" class="btn btn-default">Reset</button>
                            <button type="submit" class="btn btn-wave">Import</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="box">
        <div class="box-body table-responsive">
            <table id="questions_table" class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Questions</th>
                        <th>Choices</th>
                        <th>Correct Answer</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($questions)
                        @foreach ($questions as $key => $question)
                            @php
                                $answer = strtolower($question->answer);
                            @endphp
                            <tr>
                                <td>
                                    {{ $key + 1 }}
                                </td>
                                <td>{{ $question->question }}</td>
                                <td>{{ $question->choices }}</td>
                                <td>{{ $question->answer }}</td>
                                <td>
                                    @if (!empty($question->question_img))
                                        <img src="{{ asset('storage/question_img/' . $question->question_img) }}"
                                            class="img-responsive" alt="image" style="width:100px">
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    <!-- Edit Button -->
                                    <a type="button" class="btn btn-info btn-xs" data-toggle="modal"
                                        data-target="#{{ $question->id }}EditModal" title="Edit"><i
                                            class="fa fa-edit"></i></a>
                                    <!-- Delete Button -->
                                    <a type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                                        data-target="#{{ $question->id }}deleteModal" title="Delete"><i
                                            class="fa fa-trash"></i></a>
                                    <div id="{{ $question->id }}deleteModal" class="delete-modal modal fade"
                                        role="dialog">
                                        <!-- Delete Modal -->
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                    <div class="delete-icon"></div>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <h4 class="modal-heading">Are You Sure ?</h4>
                                                    <p>Do you really want to delete these records? This process cannot be
                                                        undone.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form method="POST"
                                                        action="{{ action([App\Http\Controllers\QuestionsController::class, 'destroy'], $question->id) }}">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="reset" class="btn btn-gray"
                                                            data-dismiss="modal">No</button>
                                                        <button type="submit" class="btn btn-danger">Yes</button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- edit model -->
                                    <div id="{{ $question->id }}EditModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Edit Question</h4>
                                                </div>
                                                <form method="POST"
                                                    action="{{ action([App\Http\Controllers\QuestionsController::class, 'update'], $question->id) }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <input type="hidden" name="topic_id"
                                                                    value="{{ $topic->id }}">

                                                                <div
                                                                    class="form-group {{ $errors->has('question') ? 'has-error' : '' }}">
                                                                    <label for="question">Question <span
                                                                            class="required">*</span></label>
                                                                    <textarea name="question" class="form-control" placeholder="Please Enter Question" rows="8" cols="42"
                                                                        required>{{ old('question', $question->question) }}</textarea>
                                                                    <small
                                                                        class="text-danger">{{ $errors->first('question') }}</small>
                                                                </div>

                                                                <div
                                                                    class="form-group {{ $errors->has('answer') ? 'has-error' : '' }}">
                                                                    <label for="answer">Correct Answer</label>
                                                                    <select name="answer" class="form-control select2">
                                                                        @foreach (json_decode($question->choices) as $choice)
                                                                            <option value="{{ $choice }}"
                                                                                {{ $choice == old('answer', $question->answer) ? 'selected' : '' }}>
                                                                                {{ $choice }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <small
                                                                        class="text-danger">{{ $errors->first('answer') }}</small>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                @php
                                                                    $choices = implode(
                                                                        ',',
                                                                        json_decode($question->choices),
                                                                    );
                                                                @endphp
                                                                <div
                                                                    class="form-group {{ $errors->has('choices') ? 'has-error' : '' }}">
                                                                    <label for="choices">Choices</label>
                                                                    <p>Note: Please separate choices with comma.</p>
                                                                    <textarea name="choices" class="form-control" placeholder="Please Enter Choices" rows="8" cols="40">{{ old('choices', $choices) }}</textarea>
                                                                    <small
                                                                        class="text-danger">{{ $errors->first('choices') }}</small>
                                                                </div>

                                                                <div
                                                                    class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                                                    <label for="type">Question Type <span
                                                                            class="required">*</span></label>
                                                                    <select name="type" class="form-control select2"
                                                                        required>
                                                                        <option value="multiple"
                                                                            {{ old('type', $question->type) == 'multiple' ? 'selected' : '' }}>
                                                                            Multiple Choice</option>
                                                                        <option value="essay"
                                                                            {{ old('type', $question->type) == 'essay' ? 'selected' : '' }}>
                                                                            Essay</option>
                                                                    </select>
                                                                    <small
                                                                        class="text-danger">{{ $errors->first('type') }}</small>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div
                                                                    class="form-group {{ $errors->has('underline') ? 'has-error' : '' }}">
                                                                    <label for="underline">Underline Words</label>
                                                                    <p>Note: If you want to underline some words in
                                                                        question, separate with comma.</p>
                                                                    <textarea name="underline" class="form-control" placeholder="Separate with comma" rows="4">{{ old('underline', $question->underline) }}</textarea>
                                                                    <small
                                                                        class="text-danger">{{ $errors->first('underline') }}</small>
                                                                </div>

                                                                <div
                                                                    class="form-group {{ $errors->has('question_img') ? 'has-error' : '' }}">
                                                                    <label for="question_img">Add Image In Question</label>
                                                                    <input type="file" name="question_img">
                                                                    <small
                                                                        class="text-danger">{{ $errors->first('question_img') }}</small>
                                                                    <p class="help">Please Choose Only .JPG, .JPEG and
                                                                        .PNG</p>
                                                                </div>
                                                            </div>
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
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
