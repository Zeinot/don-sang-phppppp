<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
</head>
<body style="background-color: grey;">
<table align="center" border="0" cellpadding="0" cellspacing="0" width="550" bgcolor="white"
       style="border: 2px solid black;">
    <tbody>
    <tr>
        <td align="center">
            <table align="center" border="0" cellpadding="0" cellspacing="0" class="col-550" width="550">
                <tbody>
                <tr>
                    <td align="center" style="background-color: red; height: 50px;">
                        <div style="text-decoration: none;">
                            <p style="color:white; font-weight:bold;">New Booking</p>
                        </div>
                    </td>
                </tr>
                <tr style="height: 300px;">
                    <td align="center"
                        style="border: none; border-bottom: 2px solid red; padding-right: 20px; padding-left: 20px;">
                        <p style="font-weight: bolder; font-size: 42px; letter-spacing: 0.025em; color:black;">
                            <b>Email :</b> {{$booking->email}}<br>
                            <b>Phone :</b> {{$booking->phone}}<br>
                            <b>Id :</b> {{$booking->id}}<br>
                        </p>
                    </td>
                </tr>

                <tr style="border: none; background-color: red; height: 40px; color:white; padding-bottom: 20px; text-align: center;">
                    <td height="40px" align="center">

                    </td>
                </tr>


                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
