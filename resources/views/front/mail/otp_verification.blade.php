<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FINANCIAL ADVISOR | OTP Verification</title>
</head>
@php
$base_url = URL::to('/');
@endphp

<body
    style="padding:0 !important; margin:0 !important; display:block !important; min-width:100% !important; width:100% !important; -webkit-text-size-adjust:none">
    <center style="width: 100%; table-layout: fixed;">
        <div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
            <div style="margin:50px auto;width:70%;padding:20px 0">
              <div style="border-bottom:1px solid #eee">
                <a href="{{$base_url}}" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">FINANCIAL ADVISOR</a>
              </div>
              <p style="font-size:1.1em">Hi,</p>
              <p>Thank you for choosing Your Brand. Use the following OTP to complete your Sign Up procedures.</p>
              <h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">  {{ $data['otp'] }}</h2>
              <p style="font-size:0.9em;">Regards,<br />FINANCIAL ADVISOR</p>
              <hr style="border:none;border-top:1px solid #eee" />
              <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
                <p>FINANCIAL ADVISOR</p>
              </div>
            </div>
          </div>
    </center>
</body>

</html>
