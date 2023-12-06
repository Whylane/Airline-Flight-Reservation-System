<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /* Add your custom CSS styles here */
        body { 
            font-family: 'Lato', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            align-content: justify;
        }
        .container {
            background-color: #ffffff;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 2px solid #007BFF;
            border-radius: 5px;
        }
        .navbar {
            text-align: center;
            background-color: #007BFF;
            padding: 10px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }
        .brand-letter {
            font-size: 1.6em;
            font-weight: bold;
        }
        .brand-letter-a {
            color: #FAFF00;
        }
        .brand-letter-f {
            color: #FFFFFF;
        }
        .brand-letter-r {
            color: #FAFF00;
        }
        .brand-letter-s {
            color: #FFFFFF;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="navbar">
            <span class="brand-letter brand-letter-a">A</span>
            <span class="brand-letter brand-letter-f">F</span>
            <span class="brand-letter brand-letter-r">R</span>
            <span class="brand-letter brand-letter-s">S</span>
        </div>
        @yield('content')
    </div>
</body>
</html>
