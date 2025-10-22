   <?php
//$logo = $message->embed(public_path() . '/images/logo.png');
$logo = 'https://energeios.com/energios_replica/images/logo.png';
//$path       = Config::get('constants.settings.domainpath');
$url       = Config::get('constants.settings.domain');
$linkexpire = Config::get('constants.settings.linkexpire');
$projectname = Config::get('constants.settings.projectname');
$date = date('d-m-Y', time());
echo $msg = '
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Password Reset Request Mail</title>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
      <style>
         a {
         color: #365cce;
         text-decoration: none;
         }
         .border {
         border-style: solid;
         border-width: 1px;
         border-color: #365cce;
         border-radius: 0.25rem;
         }
         .otpbox
         {
         display: flex;
         align-items: center;
         justify-content: center;
         width: 2rem;
         height: 2rem;
         font-size: 12px;
         font-weight: bold;
         color: #365cce
         }
         .footertext
         {
         font-size : 12px;
         }
         @media (min-width: 640px) {
         .footertext
         {
         font-size :16px;
         }
         }
      </style>
   </head>
   <body>
      <div style="display: flex; align-items: center; justify-content: center; flex-direction: column; margin-top: 1.25rem; font-family: Nunito, sans-serif">
         <section style="max-width: 42rem; background-color: #fff;border: 1px solid #2e2e2e;">
            <header  style="padding-top: 1rem; padding-bottom: 1rem;width: 100%;">
               <center>
                  <a href="#">
                  <img src="' . $logo . '" alt="Energeios Logo" / width="260">
                  </a>
               </center>
            </header>
            <h2 style="color: #374151;padding-left: 1.25rem; padding-right: 1.25rem;">Subject: Password Reset Request Successful  </h2>
            <h4 style="color: #374151;padding-left: 1.25rem; padding-right: 1.25rem;">Dear ' .$username. ',</h4>
            <p style="line-height: 1.5; color: #4b5563;padding-left: 1.25rem; padding-right: 1.25rem;">
               We have received your request to reset your password, and it has been successfully processed. You can now securely access your Energeios account using your new password.
            </p>
            <p style="line-height: 1.5; color: #4b5563;padding-left: 1.25rem; padding-right: 1.25rem;">
               To reset your password, please click on the following link and follow the instructions: <a href="'.$path.'" style="background: #365cce;text-align: center;text-decoration: none;color: #fff;padding: 1px 10px;display: inline-block;border-radius: 6px;">Click Here</a>
            </p>
            <p style="line-height: 1.5; color: #4b5563;padding-left: 1.25rem; padding-right: 1.25rem;">
               Password Reset Details:
            </p>
            <p class="" style="padding-left: 1.25rem; padding-right: 1.25rem;">Date Of Reset: '. $date.' </p>
            <p style="margin-top: 1rem; line-height: 1.75; color: #4b5563;padding-left: 1.25rem; padding-right: 1.25rem;">
               For your security, please keep your new password confidential and avoid sharing it with anyone.
            </p>
            <p style="margin-top: 1rem; line-height: 1.75; color: #4b5563;padding-left: 1.25rem; padding-right: 1.25rem;">If you did not request a password reset or if you encounter any issues, please contact our support team immediately at  <a
               href="mailto:support@energeios.io" target="_blank">support@energeios.io</a>. Your account security is our top priority.</p>
            <p style="margin-top: 1rem; line-height: 1.75; color: #4b5563;padding-left: 1.25rem; padding-right: 1.25rem;">For instant assistance, you can also reach out to our support team on WhatsApp at  <a href="https://wa.me/9293339296" target="_blank">+929 333 9296</a> .</p>
            <p style="margin-top: 1rem; line-height: 1.75; color: #4b5563;padding-left: 1.25rem; padding-right: 1.25rem;">Thank you for choosing Energeios. We are committed to ensuring your investment experience is secure and seamless.</p>
            <p style="margin-top: 1rem; color: #4b5563; padding-left: 1.25rem; padding-right: 1.25rem;">
               Warm regards, <br />
               Energeios Team
            </p>
            <p style="color: #7b8794; padding-left: 1.25rem; padding-right: 1.25rem;">
               <a
                  href="mailto:support@energeios.io"
                  style="color: #365cce; text-decoration : none;"
                  alt="support@energeios.io"
                  target="_blank"
                  >
               support@energeios.io
               </a>
            </p>
            <footer style="margin-top: 1rem;">
               <div style="background-color: #2e2e2e; padding-top :2px; padding-bottom : 2px; color: #fff; text-align: center;">
                  <p class="footertext">© 2025 Energeios. All Rights Reserved.</p>
               </div>
            </footer>
         </section>
      </div>
   </body>
</html>
';
