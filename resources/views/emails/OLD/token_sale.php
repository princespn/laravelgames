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
   <title>Energeios | Token Sale Confirmation Mail</title>
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
                  Token Sale Confirmation
                  </span>
               </h1>
            </td>
         </tr>
         <tr>
            <td>
               <h4 style="letter-spacing: 0px;color: #FFFFFF;opacity: 1;margin: 0px;font-size: 20px;">
                  Dear  '.$fullname.' 
               </h4>
            </td>
         </tr>
         <tr>
            <td>
               <div>
                  <ul style="background: #dc9f17;color: white;padding: 10px 60px;width: 80%;margin: auto;" >
                     <li style="list-style-type: none;background: #1a1919;border-radius: 5px;padding: 5px 10px;margin: 2px auto;">  Congratulations! You have successfully sold your tokens at a price of '.$amount.'.</li>
                  </ul>
               </div>
            </td>
         </tr>
         <tr>
            <td>
               <h2 style="color:#ffbc26;">Please Note</h2>
               <p style="color: #ffbc26;">We are pleased to inform you that your withdrawal will be processed, and you can expect to receive your funds within a maximum of 30 minutes.</p>
               <p style="color:#fff;font-size: 13px;"> <strong>Important : </strong> Your financial goals are within reach, and we are here to support your journey every step of the way. Keep up the great work! </p>
               <h5 style="color:#FFFFFF">
                 Should you have any questions or require assistance, please feel free to contact our support team at admin@energeios.com.
               </h5>
            </td>
         </tr>
         <tr>
            <td>
               <div>
                  <ul style="background: #dc9f17;color: white;padding: 10px 60px;width: 80%;margin: auto;" >
                     <li style="list-style-type: none;background: #1a1919;border-radius: 5px;padding: 5px 10px;margin: 0px auto;">Happy investing!</li>
                     <li style="list-style-type: none;background: #1a1919;border-radius: 5px;padding: 5px 10px;margin: 0px auto;"> Thank you for choosing Energeios for your investment needs.</li>
                     <li style="list-style-type: none;background: #1a1919;border-radius: 5px;padding: 5px 10px;margin: 0px auto;"><a href="https://www.energeios.com" target="_blank" style="color: #fff;text-align: center;">'.$url.'</a></li>
                  </ul>
               </div>
            </td>
         </tr>
         <tr>
            <td>
               <p><span><a href="mailto:admin@energeios.com" style="color: #fff;text-align: center;font-size: 14px;text-decoration: none;top:-6px;position: relative;">admin@energeios.com</a></span></p>
            </td>
         </tr>
      </tbody>
   </table>
</body>
</html>
';