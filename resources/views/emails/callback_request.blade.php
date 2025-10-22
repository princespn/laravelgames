<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome to {{ config('app.name') }}</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; margin: 0; padding: 20px;">
    <table style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 5px; box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);">
        <tr>
            <td style="padding: 20px;">
                <p>Dear Energeios Team,</p>
                <p>A new contact request has been submitted through the website form. Below are the details of the submission:</p>
                <p><strong>Name:</strong> {{ $name }}</p>
                <p><strong>Phone no.:</strong> {{ $phone_number }}</p>
                <p><strong>Message:</strong> {{ $subject }}</p>
                <p>Please review this inquiry and respond promptly to address the user's concerns or questions. If further assistance is needed, do not hesitate to reach out to the user at {{ $email }}.</p>
                <p>Thank you for your attention to this matter and for ensuring our users receive the support they need.</p>


            </td>
        </tr>
    </table>
</body>
</html>
