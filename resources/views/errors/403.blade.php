<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            text-align: center;
            background-color: #f4f4f4;
            margin: 0;
            padding: 50px;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 2em;
            color: #333;
        }
        p {
            font-size: 0.8em;
            color: #666;
        }
        a {
            color: #007BFF;
            text-decoration: none;
        }
        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 1em;
            color: white;
            background-color: #219653;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }
        .button:hover {
            background-color: #2BCA70;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>403 - Access Denied</h1>
        <p>Sorry, but you don't have permission to access this page.</p>
        <p>If you believe this is an error, please contact the site administrator.</p>
        <p><a href="#" class="button" onclick="goBack()" >Go Back</a></p>
    </div>

    <script>
    function goBack() {
        window.history.back();
    }
</script>
</body>
</html>