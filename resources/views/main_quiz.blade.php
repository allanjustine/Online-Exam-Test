@extends('layouts.app')
@section('top_bar')
  @include('/includes/app_nav')

@endsection
@section('content')
<?php
       $auth=Session::get('utoken');
       $user = App\Models\User::where('token',$auth)->select('id')->get();
       $user =$user[0];
       $users = \DB::table('result')->where('user_id',$user->id)->first();
       $que = App\Models\Question::where('topic_id',$topic->id)->first();
       $que2 = App\Models\Question::where('topic_id',$topic->id)->get();
       $tID = App\Models\Exam::where('user_id',$user->id)->select('exam')->get();
       $tID = explode(',',$tID[0]['exam']);
       $topics= App\Models\Topic::all();
       $topic_ids = array();
       $topic_slugs = array();
       $indx = 0;
       $progessWidth = 100/count($tID);
?>

<div class="container-fluid">
  @php
  for($x=0;$x<count($tID);$x++){
    foreach ($topics as $item){
      if($tID[$x] == $item->id){
        $topic_ids[$indx] =$item->id;
        $topic_slugs[$indx] =$item->slug;
        $indx++;
      }
    }
  }
  @endphp

    <div class="home-main-block">

       @if(!empty($users))
          <div class="alert alert-danger">
              You have already Given the test ! Try to give other Quizes
          </div>
       @else

      <div id="question_block" class="question-block">
        <question ref="foo" :topic_id="{{$topic->id}}" ></question>
      </div>
      @endif
      @if(empty($que))
      <div class="alert alert-danger">
            No Questions in this quiz
      </div>
      @endif
    </div>
</div>
<br/><br/>
@endsection
@section('scripts')
  <!-- jQuery 3 -->

  <!-- Bootstrap 3.3.7 -->
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <script src="{{asset('js/jquery.cookie.js')}}"></script>
  <script src="{{asset('js/jquery.countdown.js')}}"></script>
  <script>
    $(document).on('click','.review-btn',function(event) {
      $(".sidepanel").slideToggle("fast");
    });
  </script>

  @if(empty($users) && !empty($que))
   <script>
    var topic_id = {{$topic->id}};
    var questions = {{sizeof($que2)}};
    let topics = <?php echo json_encode($topic_ids) ?>;
    let slugs = <?php echo json_encode($topic_slugs) ?>;
    var timer = {{$topic->timer}};
     $(document).ready(function() {
      function e(e) {
          (116 == (e.which || e.keyCode) || 82 == (e.which || e.keyCode)) && e.preventDefault()
      }
      setTimeout(function() {
          $(".myQuestion:first-child").addClass("active");
          //$(".prebtn").attr("disabled", true);
          $(document).on('click','.nextbtn',function() {
              let queIndex =0;
              queIndex = $( ".myQuestion.active input:hidden[name=queIndex]" ).val();
              console.log(queIndex);
              var e = $(".myQuestion.active");
              queIndex > questions  ? (console.log('end')): ($(e).removeClass("active"),$(e).next().addClass("active"), $(".myForm")[0].reset()),
              setTimeout(function() {
                App.$refs.foo.nxtClick();
              }, 100)
          }),
          $(".prebtn").click(function() {
              var i = $(this).val()-1;
              var indx ='#que'+i;
              console.log(indx);
              var e = $(".myQuestion.active");
              $(e).removeClass("active"),
              i==questions-1 ?($('div').next(indx).addClass("active")):($('div').prev(indx).addClass("active")),
              $(".myForm")[0].reset(),
              setTimeout(function() {
                App.$refs.foo.prvClick(i);
              }, 100);
          }),
		   $(document).on('click','.submitBtn',function() {
              check();
          })
      }, 1000), history.pushState(null, null, document.URL), window.addEventListener("popstate", function() {
          history.pushState(null, null, document.URL)
      });

      function check(){
        console.log(topics[topics.length-1]);
        setTimeout(function() {
          if(topic_id != topics[topics.length-1]){
            for(let i = 0; i < topics.length;i++){
              if(topics[i] > topic_id){
                var url = "{{route('category_title', ['slug' => 'slug'])}}";
                url = url.replace('slug', slugs[i]);
              location.href = url;
              break;
              }
            }
          }else{
          Cookies.remove("time");
          //Cookies.set("done", "Your Quiz is Over...!", {expires: 1});
          $.ajax({
            type:'GET',
            beforeSend: function(){
                $('.ajax-loader').css("visibility", "visible");
            },
            url:'/calculate',
            success:function(data){
              $('.ajax-loader').css("visibility", "hidden");
              location.href = "{{route('exam.completed')}}";
            }
          });
          }
        },1000);
        }
      var i, o = (new Date).getTime() + 6e4 * timer;
      if (Cookies.get("time") && Cookies.get("topic_id") == topic_id) {
          i = Cookies.get("time");
          var t = o - i,
              n = o - t;
          $("#clock").countdown(n, {
              elapse: !0
          }).on("update.countdown", function(e) {
              var i = $(this);
              e.elapsed ? (check()) : i.html(e.strftime("<span>%H:%M:%S</span>"))
          })
      } else Cookies.set("time", o, {
          expires: 1
      }), Cookies.set("topic_id", topic_id, {
          expires: 1
      }), $("#clock").countdown(o, {
          elapse: !0
      }).on("update.countdown", function(e) {
          var i = $(this);
          e.elapsed ? (check()) : i.html(e.strftime("<span>%H:%M:%S</span>"))
      })
  });
  </script>
  <!-- <script>
   var count =0;
  $(document).ready(function(){
		  var body = document.querySelector('body');
		  function checkPageFocus() {
        count++;
        if(count<=5){
           alert("Warning: Please avoid opening new tab or new browser! Violation:" +count+"/5");
        }
         else{
          $.ajax({
            type:'GET',
            beforeSend: function(){
                 $('.ajax-loader').css("visibility", "visible");
            },
            url:'/violation',
           success:function(data){
               $('.ajax-loader').css("visibility", "hidden");
              location.href ="{{route('violation')}}";
             }
          });
       }
       }
      body.onblur=checkPageFocus;
  });
 </script> -->
  @else
  {{ "" }}
  @endif
 @if($setting->right_setting == 1)
  <script type="text/javascript" language="javascript">
   // Right click disable
    $(function() {
    $(this).bind("contextmenu", function(inspect) {
    inspect.preventDefault();
    });
    });
      // End Right click disable
  </script>
@endif

@if($setting->element_setting == 1)
<script type="text/javascript" language="javascript">
//all controller is disable
      $(function() {
      var isCtrl = false;
      document.onkeyup=function(e){
      if(e.which == 17) isCtrl=false;
}
      document.onkeydown=function(e){
       if(e.which == 17) isCtrl=true;
      if(e.which == 85 && isCtrl == true) {
     return false;
    }
 };
      $(document).keydown(function (event) {
       if (event.keyCode == 123) { // Prevent F12
       return false;
  }
      else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I
     return false;
   }
 });
});
     // end all controller is disable
 </script>



@endif
@endsection
