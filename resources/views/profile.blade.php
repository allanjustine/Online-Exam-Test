@extends('layouts.app')

@section('content')
    <br><br><br>
<div class="container profile-form">
    <h3>Applicant's Profile</h3><br><br>
       <!-- SmartWizard html -->
<div id="smartwizard">
    <ul class="nav">
        <li class="nav-item">
          <a class="nav-link" href="#step-1">
            <div class="num">1</div>
            Personal Information
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#step-2">
            <span class="num">2</span>
            Contact Details
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#step-3">
            <span class="num">3</span>
            Education
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="#step-4">
            <span class="num">4</span>
            Family Details
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="#step-5">
            <span class="num">5</span>
            Medical Information
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="#step-6">
            <span class="num">6</span>
            Additional Information
          </a>
        </li>
    </ul><br><br>
    <form action="">
        <div class="tab-content">
            <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                <h5 class="form-title"><strong>PERSONAL INFORMATION</strong></h5>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="lastname">Lastname</label>
                        <input type="text" name="lastname" class="form-control" placeholder="lastname">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="firstname">Firstname</label>
                        <input type="text" name="firstname" class="form-control" placeholder="firstname">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="middlename">Middlename</label>
                        <input type="text" name="middlename" class="form-control" placeholder="middlename">
                    </div>
                    <div class="form-group col-md-1">
                        <label for="suffix">Suffix</label>
                        <input type="text" name="suffix" class="form-control" placeholder="Jr,Sr,III">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="nickname">Nickname</label>
                        <input type="text" name="nickname" class="form-control" placeholder="nickname">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-8">
                        <div class="form-group row"><br>
                            <p class= "col-sm-2"><strong>Civil Status:</strong></p>
                            <div class="col-sm-2">
                                <input type="radio" id="single" name="cstatus">
                                <label for="single" style="font-size: 1.2rem;">Single</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="radio" id="married" name="cstatus">
                                <label for="married" style="font-size: 1.2rem;">Married</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="radio" id="separated" name="cstatus">
                                <label for="separated" style="font-size: 1.2rem;">Separated</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="radio" id="widowed" name="cstatus">
                                <label for="widowed" style="font-size: 1.2rem;">Widowed</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="radio" id="singleLI" name="cstatus">
                                <label for="singleLI" style="font-size: 1.2rem;">Live-in</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row"><br>
                            <div class="col-sm-3">
                                <p><strong>Religion: </strong> </p>
                            </div>
                            <div class="col-sm-9">
                            <input type="text" class="form-control " id="religion" placeholder="religion">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                <h5 class="form-title"><strong>CONTACT DETAILS</strong></h5>
                <div class="form-row">
                    <div class="form-group col-md-2" >
                        <label for="dob">Birthday</label>
                        <input type="text" class="form-control" id="datepicker">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="age">Age</label>
                        <input type="text" name="age" class="form-control age" disabled value="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="cpnum">Cellphone #</label>
                        <input type="text" name="cpnum" class="form-control" placeholder="11-digit number">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="juan@email.com">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-10">
                        <div class="form-group" >
                            <label for="pAddress">Present Address</label>
                            <input type="text" name="pAddress" class="form-control" placeholder="Present Address" >
                        </div>
                    </div>
                    <div class="col-md-2"><br>
                        <div class="col-md-12" style="margin-bottom: 2rem ;">
                            <input type="checkbox" id="sAddress" name="sAddress">
                            <label for="sAddress" style="font-size: 1rem;">Same as Residential</label>
                        </div> 
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="rAddress">Residential Address</label>
                        <input type="text" name="rAddress" class="form-control" placeholder="Residential Address">
                    </div>
                </div>
            </div>
            <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                <h5 class="form-title"><strong>EDUCATIONAL ATTAINMENT</strong></h5>
                <div class="form-row">
                    <div class= "col-md-12"> 
                        <div class="form-group row">
                            
                            <div class="col-sm-2">
                                <input type="radio" id="single" name="cstatus">
                                <label for="single" style="font-size: 1.2rem;">High School</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="radio" id="married" name="cstatus">
                                <label for="married" style="font-size: 1.2rem;">Vocational Degree</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="radio" id="separated" name="cstatus">
                                <label for="separated" style="font-size: 1.2rem;">Master's Degree</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="radio" id="widowed" name="cstatus">
                                <label for="widowed" style="font-size: 1.2rem;">Doctoral Degree</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="radio" id="singleLI" name="cstatus">
                                <label for="singleLI" style="font-size: 1.2rem;">College Level</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="radio" id="singleLI" name="cstatus">
                                <label for="singleLI" style="font-size: 1.2rem;">College Graduate</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                    <label for="rAddress">School:</label>
                    <input type="text" name="rAddress" class="form-control" placeholder="School Graduated ">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                    <label for="rAddress">Course:</label>
                    <input type="text" name="rAddress" class="form-control" placeholder="Course ">
                    </div>
                </div>
            </div>
            <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                <h5 class="form-title"><strong>PARENTS DETAILS</strong></h5>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="father">Father's Name</label>
                        <input type="text" name="father" class="form-control" placeholder="Fullname">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="fOccupation ">Occupation</label>
                        <input type="text" name="fOccupation" class="form-control" placeholder="Occupation">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="fAge">Age</label>
                        <input type="number" min=0 max=100 name="fAge" class="form-control age">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="mother">Mother's Name</label>
                        <input type="text" name="mother" class="form-control" placeholder="Fullname">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="mOccupation">Occupation</label>
                        <input type="text" name="mOccupation" class="form-control" placeholder="Occupation">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="mAge">Age</label>
                        <input type="number" min=0 max=100 name="mAge" class="form-control age">
                    </div>
                </div>
                <h5 class="form-title"><strong>SIBLINGS DETAILS</strong></h5>
                <div class="form-row">
                    <div id="sibling">
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="sibling_name[]">Name</label>
                                <input type="text" name="sibling_name[]" class="form-control" placeholder="Fullname">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="sibling_job[]">Occupation</label>
                                <input type="text" name="sibling_job[]" class="form-control" placeholder="Occupation">
                            </div>
                            <div class="form-group col-md-2 " style="padding-top: 4rem;">
                                <button class="btn btn-primary add_btn">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <h5 class="form-title"><strong>MARRIED OR LIVE-IN</strong></h5>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="wife">Spouse Name</label>
                        <input type="text" name="wife" class="form-control" placeholder="Fullname">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="wOccupation ">Spouse Occupation</label>
                        <input type="text" name="wOccupation" class="form-control" placeholder="Occupation">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="wAge">Age</label>
                        <input type="number" min=0 max=100 name="wAge" class="form-control age">
                    </div>
                </div>
                <h5 class="form-title"><strong>CHILDREN (IF APPLICABLE)</strong></h5>
                <div class="form-row">
                    <div id="child">
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="child_name[]">Name</label>
                                <input type="text" name="child_name[]" class="form-control" placeholder="Fullname">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="child_name[]">Name</label>
                                <input type="text" name="child_name[]" class="form-control" placeholder="Fullname">
                            </div>
                            <div class="form-group col-md-2 " style="padding-top: 4rem;">
                                <button class="btn btn-primary add_child_btn">+</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="step-5" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
            <h5 class="form-title"><strong>MEDICAL INFORMATION</strong></h5><br><br>
                <h5><strong>For Women</strong></h5>
                <div class="form-row">
                     <div class="form-group col-md-3">
                        <p>Are your pregnant or expecting?</p>
                    </div>
                    <div class="form-group col-md-1">
                    <input type="radio" id="pregy" name="pregy">
                    <label for="pregy" style="font-size: 1.2rem;">YES</label>
                    </div>
                    <div class="form-group col-md-1">
                        <input type="radio" id="pregy" name="pregy">
                        <label for="pregy" style="font-size: 1.2rem;">NO</label>
                    </div>
                    <div class="form-group col-md-3">
                    <p>if no, when is your last menstruation</p>
                    </div>
                    <div class="form-group col-md-4">
                    <input type="text" name="mensDate" class="form-control input-line" placeholder="Last menstruation date">
                    </div>
                </div><hr class="hr-style"><br>
                <div class="form-row">
                    <div class="col-md-4">
                        <label for="heathCon" style="font-size: 1.2rem;">Health Condition</label>
                        <input type="text" name="heathCon" class="form-control input-line" placeholder="Health Condition">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="allergies" style="font-size: 1.2rem;">Allergies</label>
                        <input type="text" name="allergies" class="form-control input-line" placeholder="Allergies">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="medHistory" style="font-size: 1.2rem;">Any Medical History</label>
                        <input type="text" name="medHistory" class="form-control input-line" placeholder="Any Medical History">
                    </div>
                </div>
                <div class="form-row">
                     <div class="form-group col-md-4">
                        <p>Do you have any maintenance for Medication?</p>
                    </div>
                    <div class="form-group col-md-1">
                        <input type="radio" id="mainMedi" name="mainMedi">
                        <label for="mainMedi" style="font-size: 1.2rem;">YES</label>
                    </div>
                    <div class="form-group col-md-1">
                        <input type="radio" id="mainMedi" name="mainMedi">
                        <label for="mainMedi" style="font-size: 1.2rem;">No</label>
                    </div>
                    <div class="form-group col-md-3">
                    <p>if YES, please include details</p>
                    </div>
                    <div class="form-group col-md-3">
                        <input type="text" name="mainMediInfo" class="form-control input-line" placeholder="Maintenance Details">
                    </div>
                </div><br>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <p>Are you fully vaccinated from COVID-19??</p>
                    </div>
                    <div class="form-group col-md-1">
                        <input type="radio" id="vacinated" name="vacinated">
                        <label for="vacinated" style="font-size: 1.2rem;">YES</label>
                    </div>
                    <div class="form-group col-md-1">
                        <input type="radio" id="vacinated" name="vacinated">
                        <label for="vacinated" style="font-size: 1.2rem;">No</label>
                    </div>
                    <div class="form-group col-md-3">
                        <p>if YES, Vaccine Received</p>
                    </div>
                    <div class="form-group col-md-3">
                        <input type="text" name="mainMediInfo" class="form-control input-line" placeholder="Date Vaccine Recieved ">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <p>Booster Shot</p>
                    </div>
                    <div class="form-group col-md-1">
                        <input type="radio" id="booster" name="booster">
                        <label for="booster" style="font-size: 1.2rem;">YES</label>
                    </div>
                    <div class="form-group col-md-1">
                        <input type="radio" id="booster" name="booster">
                        <label for="booster" style="font-size: 1.2rem;">No</label>
                    </div>
                </div>
            </div>
            <div id="step-6" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
            <h5 class="form-title"><strong>ADDITIONAL INFORMATION</strong></h5><br><br>
                <div class="form-row">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <p><b>Are you a Civil Service passer?</b></p>
                        </div>
                        <div class="form-group col-md-1">
                        <input type="radio" id="cspasser" name="cspasser">
                        <label for="cspasser" style="font-size: 1.2rem;">YES</label>
                        </div>
                        <div class="form-group col-md-1">
                            <input type="radio" id="cspasser" name="cspasser">
                            <label for="cspasser" style="font-size: 1.2rem;">NO</label>
                        </div>
                        <div class="form-group col-md-3">
                        <p>if yes, please include details</p>
                        </div>
                        <div class="form-group col-md-4">
                        <input type="text" name="cspasserDetails" class="form-control input-line" placeholder=" Details">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <p><b>Do you have a Family Business?</b></p>
                        </div>
                        <div class="form-group col-md-1">
                            <input type="radio" id="fbusiness" name="fbusiness">
                            <label for="fbusiness" style="font-size: 1.2rem;">YES</label>
                        </div>
                        <div class="form-group col-md-1">
                            <input type="radio" id="fbusiness" name="fbusiness">
                            <label for="fbusiness" style="font-size: 1.2rem;">NO</label>
                        </div>
                        <div class="form-group col-md-3">
                            <p><b>Other source of income</b></p>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" name="otherIncome" class="form-control input-line" placeholder="Source of income">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <p><b>Are you a Barangay Official?</b></p>
                        </div>
                        <div class="form-group col-md-1">
                            <input type="radio" id="brgyOfficial" name="brgyOfficial">
                            <label for="brgyOfficial" style="font-size: 1.2rem;">YES</label>
                        </div>
                        <div class="form-group col-md-1">
                            <input type="radio" id="brgyOfficial" name="brgyOfficial">
                            <label for="brgyOfficial" style="font-size: 1.2rem;">NO</label>
                        </div>
                        <div class="form-group col-md-3">
                            <p><b>Fraternity / Organization</b></p>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" name="fratOrgDetails" class="form-control input-line" placeholder="Organization Name">
                        </div>
                    </div><hr class="hr-style">
                </div>
            </div>
        </div>
    </form>
 
    <!-- Include optional progressbar HTML -->
    <div class="progress">
      <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
</div>  
    </div>

@endsection

@section('scripts')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $(document).ready(function() {
        $( "#datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-55:-18",
            dateFormat: 'mm/dd/yy',
            onSelect: function (date) {
                var dob = new Date(date);
                var today = new Date();
                var agemiliseconds = today - dob;
                var age = Math.floor(agemiliseconds / 1000 / 60 / 60 / 24 / 365.25);
                $('.age').val(age);
            }
        });

        $('#smartwizard').smartWizard({
                    selected: 0,
                    theme: 'arrows',
                    autoAdjustHeight:true,
                    transitionEffect:'fade',
                    showStepURLhash: false,
                 
        });

        $('.add_btn').click(function(e){
            e.preventDefault();
            $('#sibling').prepend(`
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="sibling_name[]">Name</label>
                            <input type="text" name="sibling_name[]" class="form-control" placeholder="Fullname">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="sibling_job[]">Occupation</label>
                            <input type="text" name="sibling_job[]" class="form-control" placeholder="Occupation">
                        </div>
                        <div class="form-group col-md-2 " style="padding-top: 4rem;">
                            <button class="btn btn-primary remove_btn">-</button>
                        </div>
                    </div>`);
        });
        $('.add_child_btn').click(function(e){
            e.preventDefault();
            $('#child').prepend(`
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="child_name[]">Name</label>
                            <input type="text" name="child_name[]" class="form-control" placeholder="Fullname">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="child_name[]">Name</label>
                            <input type="text" name="child_name[]" class="form-control" placeholder="Fullname">
                        </div>
                        <div class="form-group col-md-2 " style="padding-top: 4rem;">
                            <button class="btn btn-danger remove_btn">-</button>
                        </div>
                    </div>`);
        });

        $(document).on('click','.remove_btn', function(e){
            e.preventDefault();
            let row_sibling = $(this).parent().parent();
            row_sibling.remove();
        });
    });
</script>
@endsection