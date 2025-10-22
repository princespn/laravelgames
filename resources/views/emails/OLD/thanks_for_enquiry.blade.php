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
   <title>Energeios | Enquiry Mail</title>
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
                  Enquiry Mail
                  </span>
               </h1>
            </td>
         </tr>
         <tr>
            <td>
               <h4 style="letter-spacing: 0px;color: #FFFFFF;opacity: 1;margin: 0px;font-size: 20px;">
                  Dear '.$fullname.' 
               </h4>
               <p style="text-align: center; font-size: 15px;letter-spacing: 0px;color: #F8F8F8;margin:0px 20px;"> We are happy to tell you that your call back on <b>Energeios</b> is successfully done. </p>
               <h5 style="text-align: center;letter-spacing: 0px;font-size: 15px;color: #fff;margin:5px 0px;">
               We will get back to you soon on Energeios platform.
               </h5>
            </td>
         </tr>
         <tr>
            <td>
               <div>
                  <ul style="background: #dc9f17;color: white;padding: 10px 60px;width: 80%;margin: auto;" >
                     <li style="list-style-type: none;background: #1a1919;border-radius: 5px;padding: 5px 10px;margin: 2px auto;"> Name : ' .$fullname. '</li>
                     <li style="list-style-type: none;background: #1a1919;border-radius: 5px;padding: 5px 10px;margin: 2px auto;"> Mobile : '.$mobile.'</li>
                     <li style="list-style-type: none;background: #1a1919;border-radius: 5px;padding: 5px 10px;margin: 2px auto;"> Email : '.$email.' </li>
                     <li style="list-style-type: none;background: #1a1919;border-radius: 5px;padding: 5px 10px;margin: 2px auto;"> Message : '.$msg.'</li>
                  </ul>
               </div>
            </td>
         </tr>
         <tr>
            <td>
               <h2 style="color:#ffbc26;">Please Note</h2>
               <p style="color: #ffbc26;">Do not share your account details with anyone, because of security purposes.</p>
               <p style="color:#fff;font-size: 13px;"> <strong>Important : </strong> If there’s any error in your login credentials or you’d like to change your login details. Please get in touch with our support team at: admin@energeios.com </p>
               <h5 style="color:#FFFFFF">
                  Start your investment journey with Energeios and enjoy huge rewards and incomes.
               </h5>
            </td>
         </tr>
         <tr>
            <td>
               <div style="background: transparent linear-gradient(90deg, #ff00ff96 0%, #883ab7 100%) 0% 0% no-repeat padding-box;
                  border: 1px solid #00000000;
                  border-radius: 122px;
                  opacity: 1;margin: 10px 20px;">
                  <div style="font-size:14px;color: #fff;padding: 10px 20px;">
                     <h3 style="margin: 0px;color: #fff;">
                        Happy investing!
                     </h3>
                     <p style="color:#fff;    margin: 2px;"> Energeios is an investment company that aims to enhance its user’s financial stability and offer them easy and reliable solutions to depend on, for their economic growth. </p>
                     <a href="https://www.highocean.io/" target="_blank" style="color: #fff;text-align: center;">'.$url.'</a>
                  </div>
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