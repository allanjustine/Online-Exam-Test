<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style media="screen" type="text/css">
	
        table,th,td{
            border: 1px solid black;
			border-collapse: collapse;
        }
		td,p,h2{
		text-align:center;
		}
		th, td {
		  padding: 8px;
		}
		#t01 {
		  width: 80%;    
		  background-color: #EEEEEE;
		  margin:auto;
		}
        th {
            background-color:#212121;
            color: white;
        }
    </style>
</head>
<body>
    @php
    $semi_result = json_decode($result,true);
    $semi_result =$semi_result[0];
    $semi_result =json_decode($semi_result['score'],true);
    $overallScore=0;$perfectScore=0;
    @endphp
    <table id="t01">
        <thead>
            <tr>
                <td colspan="5" >Applicant Name: <b>{{ucwords($user->name)}}</b></td>
            </tr>
            <tr>
                <td colspan="5">Examinee No: {{hash('crc32b',$user->id)}}<br></td>
            </tr>
          <tr>
            <th>Subject</th>
            <th>Score</th>
            <th>Over</th>
            <th>Percentage</th>
            <th>Status</th>
          </tr>
        <tbody>
          @foreach($semi_result as $subject=>$exam)
          @php
            
            $overallScore+= $exam['score'];
            $perfectScore+=$exam['max'];
            $average = round($overallScore/$perfectScore*100,2);
            $finalStats = ($average>=75)?'Passed':'Failed';
            $percentage = round($exam['score']/$exam['max']*100,2);
            $status =($percentage>=75)?'Passed':'Failed';
          @endphp
          <tr>
            <td>{{$subject}}</td>
            <td>{{$exam['score']}}</td>
            <td>{{$exam['max']}}</td>
            <td>{{$percentage.' %'}}</td>
            <td>{{$status}}</td>
          </tr>
          @endforeach
          <tr>
            <td colspan="3">Average</td>
            <td><b>{{$average.' %'}}</b></td>
            <td><b>{{$finalStats}}</b></td>
          </tr>
        </tbody>
      </table>
</body>
</html>