<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShredTheBottle</title>
    <style>
        /* Reset styles */
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        /* Container */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 200px; /* Adjust the width as needed */
        }

        /* Content */
        .content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .content p {
            margin-bottom: 15px;
            line-height: 1.6;
            color: #555;
        }

        /* Button */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #219653;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #219653;
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #999;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{asset('assets/images/logo/logo.png')}}" alt="Your Logo">
        </div>