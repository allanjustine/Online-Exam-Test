@extends('layouts.admin', [
  'page_header' => 'Examinees',
  'dash' => '',
  'examinees' => 'active',
  'quiz' => '',
  'users' => '',
  'questions' => '',
  'sett' => ''
])

@section('content')
@include('message')

<br><br>
<div >
   <a data-toggle="modal" data-target="#createModal"  href="javascript:void(0)" class="slim-menu" >
        <span>
            <i class="fa fa-user-plus fa-lg"></i> Add Examinee
        </span>

   </a>
</div>
<br><br><br><br>
    @if ($auth->role == 'S')
    <h4>List of Examinees</h4>
    <!-- All Delete Button -->
    <div id="AllDeleteModal" class="delete-modal modal fade" role="dialog">
      <!-- All Delete Modal -->
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="delete-icon"></div>
          </div>
          <div class="modal-body text-center">
            <h4 class="modal-heading">Are You Sure ?</h4>
            <p>Do you really want to delete "All these records"? This process cannot be undone.</p>
          </div>
          <div class="modal-footer">
        <form method="POST" action="{{ action([App\Http\Controllers\DestroyAllController::class, 'AllUsersDestroy']) }}">
            @csrf
            <div class="btn-group">
                <button type="reset" class="btn btn-gray" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-danger">Yes</button>
            </div>
        </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Create Modal -->
    <div id="createModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Examinee</h4>
          </div>
          <form method="POST" action="{{ action([App\Http\Controllers\UsersController::class, 'store']) }}">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name">Examinee Name <span class="required">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required placeholder="Enter Name">
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">Email address <span class="required">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="eg: info@example.com" required>
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                        </div>

                        <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <label for="mobile">Mobile No. <span class="required">*</span></label>
                            <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control" placeholder="+639xxxxxxxxx" required>
                            <small class="text-danger">{{ $errors->first('mobile') }}</small>
                        </div>

                        <input type="hidden" name="role" value="E">
                        <input type="hidden" name="auth" value="{{ $auth->name }}">
                    </div>

                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('applied_position') ? ' has-error' : '' }}">
                            <label for="applied_position">Position Applied <span class="required">*</span></label>
                            <input type="text" name="applied_position" value="{{ old('applied_position') }}" class="form-control" required placeholder="Position Applied">
                            <small class="text-danger">{{ $errors->first('applied_position') }}</small>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address">Address</label>
                            <textarea name="address" class="form-control" rows="5" placeholder="Enter Your address">{{ old('address') }}</textarea>
                            <small class="text-danger">{{ $errors->first('address') }}</small>
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
    <div class="content-block box">
      <div class="box-body table-responsive">
        <table id="example1" class="table table-bordered text-center">
          <thead>
            <tr>
              <th>Name</th>
              <th>Position Applied</th>
              <th>Exam Started</th>
              <th>Exam End</th>
              <th>Exam Sent On</th>
              <th>Exam Sent By</th>
              <th>Exam Status</th>
              <th>Actions</th>
              <th>Added On</th>
              <th>Added By</th>
            </tr>
          </thead>
          <tbody>
            @if ($users)
              @foreach ($users as $key => $user)
                <tr>
                  <?php
                      $exam = \DB::table('exam')->where('user_id',$user->id)->first();
                  ?>
                  <td>{{strtoupper($user->name)}}</td>
                  <td>{{$user->applied_position}}</td>
                  <td>@if(!empty($exam)){{{$exam->started_at}}}@endif</td>
                  <td>@if(!empty($exam)){{{$exam->end_at}}}@endif</td>
                  <td>@if(!empty($exam)){{{$exam->created_at}}}@endif</td>
                  <td>@if(!empty($exam)){{{$exam->sent_by}}}@endif</td></td>
                  <td>
                    @if(empty($user->status))
                    <span class="label label-warning">Link not send</span>
                    @elseif ($user->status == 'sent')
                    <span class="label label-primary">Pending</span>
                    @elseif ($user->status == 'progress')
                    <span class="label label-default">In Progress</span>
                    @elseif ($user->status == 'finish')
                    <span class="label label-success">Completed</span>
                    @else <span class="label label-danger">Violated Rules</span>
                    @endif
                  </td>
                  <td>
                   <!-- Edit Button -->
                    <?php
                      $user_has_result = \DB::table('result')->where('user_id',$user->id)->first();
					            $user_has_essay = \DB::table('essay')->where('user_id',$user->id)->first();
                    ?>
                      <div style="display:flex;justify-content:center">
                        @if(empty($user_has_result) && empty($user_has_essay))
                        <a type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#{{$user->id}}chooseTopic" title="Invite Exam"><i class="fa fa-envelope"></i></a>
                        @else
                        <a title="Exam Result" href="javascript:ajaxCall('{{route('exam.result', ['id' => $user->id])}}','exam-result')" class="btn btn-info btn-xs">
                          <i class="fa fa-file-text-o" aria-hidden="true"></i>
                        </a>
                       @endif
                      <a type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#{{$user->id}}EditModal" title="Edit" style="margin-left:10px"><i class="fa fa-edit"></i></a>
                      <!-- Delete Button -->
                      <a type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#{{$user->id}}deleteModal" title="Remove" style="margin-left:10px"><i class="fa fa-trash"></i></a>
                      </div>
                    <div id="{{$user->id}}deleteModal" class="delete-modal modal fade" role="dialog">
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
                           <form method="POST" action="{{ action([App\Http\Controllers\UsersController::class, 'destroy'], $user->id) }}">
                            @csrf
                            @method('DELETE')
                            <div class="btn-group">
                                <button type="reset" class="btn btn-gray" data-dismiss="modal">No</button>
                                <button type="submit" class="btn btn-danger">Yes</button>
                            </div>
                         </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td>{{$user->created_at}}</td>
                  <td>{{$user->added_by}}</td>
                </tr>
                <!-- edit exam to be taken -->
                <div id="{{$user->id}}chooseTopic" class="delete-modal modal fade examination" role="dialog">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                      <div class="modal-header text-center">
                        <h3>Examination</h3>
                      </div>
                     <form method="POST" action="{{ route('send.invite', [$user->token, $user->name, $user->email, $user->id]) }}">
                        @csrf
                        <div class="modal-body">
                            @foreach ($topics as $subject)
                                <div class="form-check">
                                    <input type="checkbox" name="sub{{ $subject->id }}" value="{{ $subject->id }}" class="exambox" id="sub{{ $subject->id }}">
                                    <label for="sub{{ $subject->id }}">{{ $subject->title }}</label>
                                </div>
                            @endforeach

                            <input type="hidden" name="auth" value="{{ $auth->name }}">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger" id="sendinvite">Send Invite</button>
                            <button type="reset" class="btn btn-gray" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>

                    </div>
                  </div>
                </div>
                <!-- edit model -->
                <div id="{{$user->id}}EditModal" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" style="color: #000">Edit Information </h4>
                      </div>
                      <form method="POST" action="{{ action([App\Http\Controllers\UsersController::class, 'update'], $user->id) }}">
                        @csrf
                        @method('PATCH')

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" name="id" value="{{ $user->id }}">

                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name">Name <span class="required">*</span></label>
                                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required placeholder="Enter your name">
                                        <small class="text-danger">{{ $errors->first('name') }}</small>
                                    </div>

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email">Email address <span class="required">*</span></label>
                                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required placeholder="eg: info@example.com">
                                        <small class="text-danger">{{ $errors->first('email') }}</small>
                                    </div>

                                    <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                        <label for="mobile">Mobile No.</label>
                                        <input type="text" name="mobile" value="{{ old('mobile', $user->mobile) }}" class="form-control" placeholder="eg: 09190000000">
                                        <small class="text-danger">{{ $errors->first('mobile') }}</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('applied_position') ? ' has-error' : '' }}">
                                        <label for="applied_position">Position Applied <span class="required">*</span></label>
                                        <input type="text" name="applied_position" value="{{ old('applied_position', $user->applied_position) }}" class="form-control" required placeholder="Position Applied">
                                        <small class="text-danger">{{ $errors->first('applied_position') }}</small>
                                    </div>

                                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                        <label for="address">Address</label>
                                        <textarea name="address" class="form-control" rows="5" placeholder="Enter Your Address">{{ old('address', $user->address) }}</textarea>
                                        <small class="text-danger">{{ $errors->first('address') }}</small>
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
              @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>
  @endif
  <script>
    $(function () {

	var boxes = $('.exambox');
	boxes.on('change', function () {
		$('#sendinvite').prop('disabled', !boxes.filter(':checked').length);
	}).trigger('change');


      $('#example1').DataTable();

    });
  </script>
@endsection
