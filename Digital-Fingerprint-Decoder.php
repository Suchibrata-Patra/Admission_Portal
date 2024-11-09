<?php include('./favicon.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Fingerprint ID</title>
    <style>
        body {
            font-family: "Roboto Mono", monospace;
            font-weight: normal;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        p{
            padding-left:2%;
            padding-right:2%;
            color:grey;
        }  
        label {
            font-size: 16px;
            display: block;
            margin-bottom: 8px;
            color: #666;
        }

        input[type="password"] {
            width: 99%;
            padding: 12px;
            border: none;
            border: 1px solid #5aabe5;
            border-radius: 10px;
            font-size: 16px;
            margin-bottom: 16px;
            box-sizing: border-box;
            transition: border-bottom-color 0.3s ease;
            outline: none;
        }
        input[type="text"] {
            width: 99%;
            padding: 10px;
            border: none;
            border: 1px solid #5aabe5;
            border-radius: 10px;
            font-size: 16px;
            margin-bottom: 16px;
            box-sizing: border-box;
            transition: border-bottom-color 0.3s ease;
            outline: none;
        }

        input[type="password"]:focus {
            border-bottom-color: #0070c9;
        }

        button {
            padding: 12px 20px;
            background-color: #f6f6f6;
            border: none;
            color:black;
            font-size: 16px;
            cursor: pointer;
            border-radius: 8px;
            display: block;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #ededed;
            border: none;
        }

        #passwordError {
            color: red;
            margin-top: 10px;
            display: none;
        }

        #timestampDecoder {
            display: none;
        }

        #decodedTimestamp {
            font-size: 16px;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <center><span class="material-symbols-outlined" style="padding-top:10px;">
            lock
            </span></center>
        <h2>Decode Fingerprint ID</h2>
        <input type="password" id="password" placeholder="Passcode" onkeydown="if(event.keyCode==13) checkPassword()">
        <button id="submitButton" onclick="checkPassword()">Authenticate</button>
        <div id="passwordError" style="margin-top: 10px;"></div>
        <div id="timestampDecoder" style="display: none;">
            <input type="text" id="encodedString" placeholder="Enter Fingerptint ID">
            <button onclick="decodeTimestamp()">Decode</button>
            <p id="decodedTimestamp"></p>
            </div>
        <p><b>Attention</b><br><p>This system is for authorized personnel only. Unauthorized access is strictly forbidden and will be met with consequences.</p></p>
    </div>
    <script>
        function checkPassword() {
            var password = document.getElementById('password').value;
            if (password === '2003') {
                document.getElementById('passwordError').style.display = 'none';
                document.getElementById('timestampDecoder').style.display = 'block';
                document.getElementById('submitButton').style.display = 'none';
            } else {
                document.getElementById('passwordError').style.display = 'block';
                document.getElementById('passwordError').innerText = 'Incorrect password. Please try again.';
                document.getElementById('timestampDecoder').style.display = 'none';
            }
        }

        function decodeTimestamp() {
            var encodedString = document.getElementById('encodedString').value;
            
            // Convert hexadecimal string to regular string
            var hexString = encodedString.replace(/(..)/g, '%$1');
            var decodedTimestamp = decodeURIComponent(hexString);
            
            document.getElementById('decodedTimestamp').innerText = "Decoded Timestamp: " + decodedTimestamp;
        }
    </script>
</body>
</html>