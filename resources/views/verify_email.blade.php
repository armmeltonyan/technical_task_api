<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1 style="color: red">Thank you dear {{$name}}, for register in our website.
	Please click to this<a href="{{url('verify/'.$hash.'/'.$id)}}"> link</a> for verify email.
</h1>
</body>
</html>