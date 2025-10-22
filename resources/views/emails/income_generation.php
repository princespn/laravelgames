   <?php
//$logo = $message->embed(public_path() . '/images/logo.png');
$logo = 'https://energeios.com/energios_replica/images/logo.png';
$path       = Config::get('constants.settings.domainpath');
$url       = Config::get('constants.settings.domain');
$linkexpire = Config::get('constants.settings.linkexpire');
$projectname = Config::get('constants.settings.projectname');
echo $msg = '
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Income Successfully Generated Mail</title>
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
            <h2 style="color: #374151;padding-left: 1.25rem; padding-right: 1.25rem;">Subject: Congratulations! Income Successfully Generated in Your Account! </h2>
            <h4 style="color: #374151;padding-left: 1.25rem; padding-right: 1.25rem;">Dear ' .$username. ',</h4>
            <p style="line-height: 1.5; color: #4b5563;padding-left: 1.25rem; padding-right: 1.25rem;">
          We are thrilled to share the fantastic news that income has been successfully generated in your Energeios account! Your investment strategy is paying off, bringing you one step closer to achieving your financial goals.
            </p>


            <p style="line-height: 1.5; color: #4b5563;padding-left: 1.25rem; padding-right: 1.25rem;">
             Income Generation Details:
            </p>
      
            <p class="" style="padding-left: 1.25rem; padding-right: 1.25rem;">Amount Generated: '. $amount.' </p>
            <p class="" style="padding-left: 1.25rem; padding-right: 1.25rem;">Date of Income Generation: '. $date.' </p>


            <p style="margin-top: 1rem; line-height: 1.75; color: #4b5563;padding-left: 1.25rem; padding-right: 1.25rem;">
              At Energeios, we are committed to maximizing your returns and providing you with unparalleled investment opportunities in the ever-evolving cryptocurrency market.
            </p>


            <p style="margin-top: 1rem; line-height: 1.75; color: #4b5563;padding-left: 1.25rem; padding-right: 1.25rem;">Ready to capitalize on your newfound income? Explore further investment avenues and watch your wealth grow!
            </p>


            <p style="margin-top: 1rem; line-height: 1.75; color: #4b5563;padding-left: 1.25rem; padding-right: 1.25rem;">Should you have any inquiries or require assistance, please do not hesitate to contact our dedicated support team at support@energeios.io. Your satisfaction is our utmost priority, and we are here to assist you every step of the way.</p>

            <p style="margin-top: 1rem; line-height: 1.75; color: #4b5563;padding-left: 1.25rem; padding-right: 1.25rem;">For immediate assistance, feel free to reach out to our support team on WhatsApp at  <a href="https://wa.me/9293339296" target="_blank">+929 333 9296</a> .</p>

            <p style="margin-top: 1rem; line-height: 1.75; color: #4b5563;padding-left: 1.25rem; padding-right: 1.25rem;">Thank you for choosing Energeios as your trusted investment partner. Here is to continued success and prosperity!</p>

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
