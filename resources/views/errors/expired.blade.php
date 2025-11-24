<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <title>Link Invalid</title>
    <style>
        body,html {
        height: 100%;
        }
        .box {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        background-color:#164c92;
        background:linear-gradient(45deg, #8e36e0 0%, #164b92 100%);
        }
        .row{
            margin: auto !important;
            color: white;
        }
        .flexybox{
        display: flex;
        justify-content: center;
        align-items: center;
        }

    </style>
</head>
<body>
    <div class="box">
            <div class="row" >
                <div class="col-md-6 flexybox">
                    <div style="margin: auto">
                        <h2>Link is not valid anymore</h2>
                        <p>Oops! The invite url is not valid anymore.</p>
                        <a href="/" class="btn btn-primary"> Go to Homepage</a>
                    </div>

                </div>
                <div class="col-md-6">
                    <img src="{{asset('/images/vectors/time.png')}}" class="img-responsive" width="80%" alt="expired link">
                </div>
            </div>
    </div>
</body>
</html>
