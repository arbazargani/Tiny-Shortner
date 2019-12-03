<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>xx Not Found xx</title>
    <link rel="icon" href="<?php echo ABS_PATH; ?>assets/style/image/danger.png">
    <style>
        #err {
            margin-left: 35%;
            margin-right: 35%;
        }

        .base {
            background: #D4D0C8;
            border-top: 1px solid whitesmoke;
            border-left: 1px solid whitesmoke;
            border-right: 1px solid gray;
            border-bottom: 1px solid gray;
            box-shadow: 2px 2px 10px #9c9c9c;
        }

        .header {
            height: 20px;
            padding: 0.2em;
            background-image: linear-gradient(to right, #153074, #48669F, #A4C7EE);
        }

        .header-text {
            width: 70%;
            float: left;
        }

        .header-button {
            float: right;
            width: 30%;
            direction: rtl;
        }

        .title {
            color: #ffff;
            font-family: monospace;
            font-weight: bold;
        }

        .info {
            padding: 10px;
        }

        .message {
            padding: 10px;
            font-family: Tahoma;
            font-size: 13px;
            color: #353535;
            width: 600px;
        }

        .icon {
            /*padding: 10px 0 0 10px;*/
            vertical-align: middle;
        }

        .buttons {
            text-align: center;
            margin: 3px;
        }

        .close-button {
            display: inline-block;
            text-decoration: none;
            background: #D4D0C8;
            cursor: pointer;
            padding: 0 4px 3px 3px;
            color: #1b1e21;
            font-family: Tahoma;
            font-size: 13px;
            border-top: 1px solid whitesmoke;
            border-left: 1px solid whitesmoke;
            border-right: 1px solid gray;
            border-bottom: 1px solid gray;
            text-align: right !important;
        }

        .button {
            display: inline-block;
            width: 75px;
            text-decoration: none;
            cursor: pointer;
            padding: 5px;
            margin: 3px;
            color: #1b1e21;
            font-family: Tahoma;
            font-size: 13px;
            border-top: 1px solid whitesmoke;
            border-left: 1px solid whitesmoke;
            border-right: 1px solid gray;
            border-bottom: 1px solid gray;
            box-shadow: 1px 1px 2px #9c9c9c;
        }
    </style>
</head>
<body>
<div id="err">
    <div class="base">
        <div class="header">
            <div class="header-text">
                <span class="title">Notfound.html - 404 Error</span>
            </div>
            <div class="header-button">
                <button class="close-button" onclick="close()">x</button>
            </div>
        </div>
        <div class="info">
            <img src="<?php echo ABS_PATH; ?>assets/style/image/danger.png" class="icon">
            <span class="message">
               404 - It seems page you're searching for not exists.
            </span>
        </div>
        <div class="buttons">
            <a href="<?php echo ABS_PATH; ?>" class="button">Home</a>
        </div>
    </div>
</div>
<script>
    function close() {
        document.getElementById('err').display = 'hidden';
    }
</script>
</body>
</html>