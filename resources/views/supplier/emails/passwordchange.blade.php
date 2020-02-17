<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Password Changed Email</title>
    <style>
        @media screen and (max-width:620px) {
        img{
            transform: scale(0.5,0.5);
        }
        #confirm{
            font-size: 12px !important;
            padding: 0.5rem !important;
        }
    }
    </style>
</head>

<body>
    <div style="padding: 0rem;">
        <div class="emailContent" style="margin: auto;display: block;justify-content: center;
        font-weight: bold; text-align: center; max-width: 602px; border: 2px solid #DFDFDF;
        border-top: 2px solid #F39201;">
            <div style="background-color: rgba(243,243,243,0.8);">
                <table>
                    <td><img src="{{ $data[0] }}/images/sumed.png" style="padding: 1rem 2rem;"></td>
                    <td>Sumed Supplier Registration Portal</td>
                </table>
            </div>
            <h2 style="padding-top: 1.5rem;">your password is changed</h2>
            <p style="padding-bottom: 0px;margin-bottom: 4px;">You recently changed your password for your account.</p>
            
            <hr>
            <p style="font-size: 12px;padding-top: 1rem;">If you didn’t sign up, you can safely ignore this email.</p>
            <p style="font-size: 12px;padding-bottom: 1rem;">This is an automatically generated email, please do not reply. For any inquiries <a href="{{ $data[0] }}/supplier/contactus">Contact Us</a></p>
            <div style="background-color: #DFDFDF;padding: 1rem;">
                <p style="font-size: 12px;">© 2019 Sumed Company. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>

</html>
