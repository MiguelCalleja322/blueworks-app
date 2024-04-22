<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Blueworks</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            body {
                background: #00091B;
                color: #fff;
            }


            @keyframes fadeIn {
                from {top: 20%; opacity: 0;}
                to {top: 100; opacity: 1;}
                
            }

            @-webkit-keyframes fadeIn {
                from {top: 20%; opacity: 0;}
                to {top: 100; opacity: 1;}
                
            }

            .wrapper {
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                -webkit-transform: translate(-50%, -50%);
                animation: fadeIn 1000ms ease;
                -webkit-animation: fadeIn 1000ms ease;
            
            }

            h1 {
                font-size: 70px;
                font-family: 'Poppins', sans-serif;
                margin-bottom: 0;
                line-height: 1;
                font-weight: 700;
            }

            .dot {
                color: #4FEBFE;
            }

            p {
                text-align: center;
                margin: 24px;
                font-size: 24px;
                font-family: 'Muli', sans-serif;
                font-weight: normal;
            }

        </style>
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <div class="wrapper">
            <h1>Blueworks App<span class="dot">.</span></h1>
            <p>Coming Soon</p>
        </div>
    </body>
</html>
