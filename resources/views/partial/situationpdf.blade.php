<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <pre>   Applicant Name: <b>{{ucwords($user->name)}}</b></pre>
    <center><h4 class="modal-title">Reading Comprehension</h4></center><br>
    <ol>
        @foreach ( $essay as $es )
            <li>
              <p>{{$es->situation}}</p>
              <p><b>Answer:</b></p>
              <div> <pre style="white-space:pre-wrap">{{$es->answer}}</pre></div>
            </li>
        @endforeach
    </ol>
</body>
</html>