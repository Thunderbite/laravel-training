<!DOCTYPE html>
<html>

    <head>
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="mobile-web-app-capable" content="yes" />
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, user-scalable=no">
        <base href="/" />
        <meta charset="utf-8">
        <title>{{ config('app.name') }}</title>
        <link rel="stylesheet" href="/css/app.css" />

        <script>
            var config = <?php echo json_encode($config); ?>
        </script>

        <script>
            if ( console ) {
                console.log( 'Configuration received', config )
            }
        </script>
    </head>

    <body>
            <h1>Hello World!</h1>
    </body>
</html>
