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
          <p>Here is your verification code :<b>{{$code}}</b></p>
          <p>Copy and paste this code to start your assessment. </p>
          <p>Good Luck!</p>
          <br>
        </div>
      </div>
    </div>
  </body>
</html>
