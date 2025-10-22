   <?php
//$bg = $message->embed(public_path() . '/user_files/email-img/bg.png');
$logo = $message->embed(public_path() . '/user_files/email-img/logo.png');
$thanks = $message->embed(public_path() . '/user_files/email-img/mail.png');
$path       = Config::get('constants.settings.domainpath');
$url       = Config::get('constants.settings.domain');
$linkexpire = Config::get('constants.settings.linkexpire');
$projectname = Config::get('constants.settings.projectname');
echo $msg = '<!DOCTYPE HTML>
<head>
   <title>Energeios | OTP Generation Confirmation Mail</title>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Josefin+Slab:wght@500&display=swap" rel="stylesheet">
   <style type="text/css">
      table tr {
      display: block;
      }
      table tr th {
      display: block;
      }
      table tr td {
      display: block;
      }
      table tr td table {
      display: block;
      }
      table tr td table tbody {
      display: block;
      }
      table tr td table tr td {
      display: block;
      }
   </style>
</head>
<body style="padding: 10px;background: #efefef;font-family: Poppins, sans-serif;">
   <table cellpadding="0" cellspacing="0" border="0" cellpadding="0" cellspacing="0" align="center" width="600" height="100%" style="background:#1a1919;padding: 0px;color: #000;text-align: center;position: relative;border: 8px double #dc9f17;">
      <tbody style="min-height: 568px;background-size: contain;
         background-repeat: no-repeat;">
         <tr>
            <td style="padding:5px 10px 0">
               <img src="' . $logo . '" alt="Logo Energeios" width="200" style="margin-top:0px">              
            </td>
         </tr>
         <tr>
            <td>
               <h1 style="color:#ED2129;text-align: center;justify-content: center;align-items: center;margin: 0px">
                  <span style="display:inline-block;color: #fff;;">
                  OTP Generation
                  </span>
               </h1>
            </td>
         </tr>
         <tr>
            <td>
               <h4 style="letter-spacing: 0px;color: #FFFFFF;opacity: 1;margin: 0px;font-size: 20px;">
                  Dear '.$username.' 
               </h4>
               <h5 style="text-align: center;letter-spacing: 0px;font-size: 15px;color: #fff;">
                  Here is your One-Time Password (OTP) for secure access:
               </h5>
            </td>
         </tr>
         <tr>
            <td>
               <div>
                  <ul style="background: #dc9f17;color: white;padding: 10px 60px;width: 80%;margin: auto;" >
                     <li style="list-style-type: none;background: #1a1919;border-radius: 5px;padding: 5px 10px;margin: 2px auto;"> <b>OTP:</b> ' .$otp. ' </li>
                  </ul>
               </div>
            </td>
         </tr>
         <tr>
            <td>
               <h2 style="color:#ffbc26;">Important Note</h2>
               <p style="color:#fff;font-size: 13px;"> <strong> </strong>Please use this OTP within 5 mins for the intended purpose. If you did not request this OTP or have any concerns about your account security, please contact our support team immediately at admin@energeios.com.</p>
               <h5 style="color:#FFFFFF">
                  Start your investment journey with Energeios and enjoy huge rewards and incomes.
               </h5>
            </td>
         </tr>
         <tr>
            <td>
               <div>
                  <ul style="background: #dc9f17;color: white;padding: 10px 60px;width: 80%;margin: auto;" >
                     <li style="list-style-type: none;background: #1a1919;border-radius: 5px;padding: 5px 10px;margin: 0px auto;">Happy investing!</li>
                     <li style="list-style-type: none;background: #1a1919;border-radius: 5px;padding: 5px 10px;margin: 0px auto;">Thank you for choosing Energeios for your investment needs. </li>
                     <li style="list-style-type: none;background: #1a1919;border-radius: 5px;padding: 5px 10px;margin: 0px auto;"><a href="https://www.energeios.com" target="_blank" style="color: #fff;text-align: center;">'.$url.'</a></li>
                  </ul>
               </div>
            </td>
         </tr>
         <tr>
            <td>
               <p><img src="' .$thanks. '" style="width: 20px;"> <span><a href="mailto:admin@energeios.com" style="color: #fff;text-align: center;font-size: 14px;text-decoration: none;top:-6px;position: relative;">admin@energeios.com</a></span></p>
            </td>
         </tr>
      </tbody>
   </table>
</body>
</html>
';