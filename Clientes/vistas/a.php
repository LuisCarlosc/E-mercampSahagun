<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script
        src="https://www.paypal.com/sdk/js?
        client-id=AclcZrtSWlUSgh4ggt4ZkTtFpYAlcjcY4Q29ctJA21Xmhlsq1qN5qb4Y6dkUmJjn6wp-S2lxFOrPEF-d&
        currency=USD"></script>
</head>
<body>
    <div id="paypal-button-container"></div>

    <script>
        paypal.Buttons().render('#paypal-button-container');
    </script>
</body>
</html>