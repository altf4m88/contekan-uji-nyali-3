<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Laporan</title>
    <link rel="icon" type="image/x-icon" href="{{asset('/icon.png')}}">
    <style>
        .header{
            display: flex;
            justify-content: center;
        }

        .report-image{
            width: 30rem;
        }

        .image-wrapper{
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .main-content {
            margin-top: 30px;
            width: 100%;
        }

        table {
            border: 0;
        }

        .description{
            min-height: 200px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Pengaduan Masyarakat</h1>
    </div>
    <hr>
    <div class="image-wrapper">
        <img class="report-image" src="uploads/images/{{$report->photo}}" alt="">
    </div>
    <div class="main-content">
        <table width="50%">
            <tr>
                <td>Pelapor</td>
                <td>:</td>
                <td>{{$report->civillian->name}}</td>
            </tr>
            <tr>
                <td>No. HP</td>
                <td>:</td>
                <td>{{$report->civillian->phone ?? '-'}}</td>
            </tr>
            <tr>
                <td>Tanggal Lapor</td>
                <td>:</td>
                <td>{{$createdAt}}</td>
            </tr>
            <tr>
                <td>Status Laporan</td>
                <td>:</td>
                <td>{{$status}}</td>
            </tr>
        </table>
    </div>
    <div class="description">
        <p>{!!$report->report!!}</p>
    </div>
    <div class="footer">
        <small>Dicetak oleh {{$user->employee_name}} pada {{$currentDate}}</small>
    </div>
</body>
</html>
