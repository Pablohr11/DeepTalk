<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            color: aliceblue;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        h2 {
            background-color: red;
            margin-top: 42vh;
            background-color: rgba(127, 127, 127, 0.7);
            border-radius: 6px;
            padding:5px
        }
    </style>
    <script defer>
        function reloadPage() {
            parent.location.href="login.php";
        }
        setTimeout(reloadPage, 3000);
    </script>
</head>
<body>
    <h2>Por motivos de seguridad, reinicie la página y vuelva a iniciar sesión</h2>
</body>
</html>