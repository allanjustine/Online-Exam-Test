<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen" type="text/css">

        body{
          margin-left: 15%;
          margin-right: 15%;
          background-color:#FAFAFA;
          padding:2%;
          font-family:sans-serif;
        }
        h3{
          text-align: center;
        }
		li{
          line-height: 2;
        }
        h2{
          text-align: center;
          font-weight: bold;
          color: #FFFF;
        }
        .cardContainer{
          background-color:#FFFF;
          padding:5%;
          width:95%;
          margin-left: auto;
          margin-right: auto;
        }

    </style>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
  </head>
  <body  style="background-color:#164c92;background:linear-gradient(45deg, #8e36e0 0%, #164b92 100%);">
    <div class="container">
      <div class="cardContainer">
        <div style="background-color:#2F3180;padding:1%">
          <center><img src="{{asset('images/logo/logo.png')}}" width="30%"></center>
        </div>
        <div style="padding:0 5% 0 5%">
          <br>
          @php
             $names= \App\Helper\Helper::splitname($name);
              $fname=$names[0];
          @endphp
          <p>Hi <b>{{ucwords($fname)}}</b></b>,</p>
          <p>As part of the recruitment process you have been asked to complete an online assessment.</p>
          <p>You must complete this assessment within the day upon receipt of this email. As this is a critical step, any delays may impact the overall processing time of your application.</p><br>
          <p><b>Guidelines before taking the exam.</b></p>
             <ol>
              <li>This system is designed for desktop computers, so we recommend using desktop or laptop when taken the exam.</li>
              <li>We recommend using chrome or firefox browser.</li>
              <li>Time can't be paused
                <ul>
                  <li>Make sure you have stable internet connection.</li>
                  <li>Answer the exam without any interruption.</li>
                </ul>
              </li>
              <li>Don't resize (minimize) the browser during the exam.</li>
              <li>Avoid clicking refresh and back button of the browser or else you will lose all your answers while your time continues running.</li>
              <li>Avoid opening new tab or other browser, the system can detect it  and you will be out of the exam.</li>
             </ol><br><br>
          <center><a href="{{route('examinee', ['id' => $token])}}">Click here to start your Assessment</a></center>
          <br>
        </div>
      </div>
    </div>
  </body>
</html>
