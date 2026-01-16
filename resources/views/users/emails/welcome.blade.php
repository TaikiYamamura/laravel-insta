<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        p{
            color: rgb(72, 70, 70);
        }

        h1{
            text-align: center;
        }

        .bold{
            font-weight: bolder;
        }

        .italic{
            font-style: italic;
        }

        .footer{
            text-align: center;
            color: darkgray;
        }

        button{
            color: white;
            background-color: rgb(0, 106, 255);
            border: 0;
            padding: 0.75rem;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Welcome to Insta app!</h1>
    <hr>
    <p class="bold">Hi {{ $name }},</p>
    <p>Thank yo for signing up to Insta App. We're excited to have you on board!</p>
    <p>To get started, please confirm your email address by clicking the button bellow:</p>
    <br>
    <form action="{{ $app_url }}" method="post">
        <button>Confirm Email Address</button>
    </form>
    <br>
    <p>Best regards,</p>
    <p>Kredo Team</p>
    <br>
    <p class="italic">If yo did not sign up for this account, you can ignore this email.</p>
    <hr>
    <p class="footer">&copy; 2025 Kredo Insta App. All rights reserved.</p>
</body>
</html>