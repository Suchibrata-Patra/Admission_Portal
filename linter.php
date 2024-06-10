<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
    <title>Duplicate CSS Detector</title>
    <style>
        body {
            font-family: "Source Code Pro", monospace;
            font-weight: 400;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 90%;
            margin: 50px auto;
            padding: 15px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .input-container, .output-container {
            width: 48%;
            margin-bottom: 20px;
        }
        .output-container{
            padding-top:3%;
        }
        .input-container {
            display: flex;
            flex-direction: column;
            position: relative;
            width:47%;
        }
        h1 {
            text-align: center;
            color: #000000;
            font-size: 25px;
            font-weight: 400;
            font-family: Arial, Helvetica, sans-serif;
        }
        .line-numbers {
            position: absolute;
            top: 79px;
            left: 0;
            width: 30px;
            padding-top:1px;
            text-align: right;
            border-right: 1px solid #ddd;
            padding-right: 5px;
            font-size: 14px;
            color: #888;
        }
        textarea {
            width: 100%;
            height: 200px;
            margin-bottom: 20px;
            padding: 17px 15px 15px 40px;
            border: 2px solid #000000;
            border-radius: 4px;
            resize: none;
            overflow: hidden;
            font-family: "Source Code Pro", monospace;
        }
        button {
            display: block;
            margin: 0 auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top:45%;
            margin-right:40%;
        }
        button:hover {
            background-color: #0056b3;
        }
        #duplicateRules {
            margin-top: 20px;
            padding: 20px;
            border-radius: 4px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }
     #checkDuplicates {
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 1000;
            background-color: rgb(250, 250, 250);
            color: black;
            padding: 30px;
            font-size: 16px;
            border: 2px solid black;
            border-radius: 100px;
            font-weight: 500;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .input-container, .output-container {
                width: 100%;
            }
        }

        #goToTopBtn {
        display: none;
        position: fixed;
        bottom: 62px;
        right: -45px;
        z-index: 1000;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        font-size: 24px;
        cursor: pointer;
        transition: opacity 0.3s, transform 0.3s;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    #goToTopBtn:hover {
        opacity: 0.8;
        transform: scale(1.05);
    }

    /* Optional: Add a subtle animation for the button */
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
    #goToTopBtn:active {
        animation: pulse 0.5s ease;
    }
    </style>
</head>
<body>
    <button id="checkDuplicates">Check for Duplicates</button>
<center>    <h3 style="font-weight:normal;">Designed And Developed by Suchibrata</h3>
</center>    <div class="container">
        <div class="input-container">
            <h1>Duplicate CSS Detector Tool</h1>
            <div class="line-numbers" id="lineNumbers"></div>
            <textarea id="cssInput" placeholder="Paste your CSS here..."></textarea>
        </div>
        <div class="output-container">
            <div id="duplicateRules"></div>
        </div>
    </div>
    <button id="goToTopBtn" onclick="goToTop()">↑</button>

    <script>
        document.getElementById('cssInput').addEventListener('input', function() {
            updateLineNumbers();
            autoResizeTextarea(this);
        });
        document.getElementById('checkDuplicates').addEventListener('click', function() {
            var cssInput = document.getElementById('cssInput').value;
            var duplicateRules = findDuplicateCSS(cssInput);
            displayDuplicateRules(duplicateRules);
        });

        function updateLineNumbers() {
            var cssInput = document.getElementById('cssInput');
            var lineNumbers = document.getElementById('lineNumbers');
            var lines = cssInput.value.split('\n').length;
            var lineNumbersHtml = '';
            for (var i = 1; i <= lines; i++) {
                lineNumbersHtml += i + '<br>';
            }
            lineNumbers.innerHTML = lineNumbersHtml;
        }

        function autoResizeTextarea(textarea) {
            textarea.style.height = 'auto';
            textarea.style.height = textarea.scrollHeight + 'px';
        }

        function findDuplicateCSS(cssInput) {
            var lines = cssInput.split('\n');
            var currentLine = 0;
            var rules = {};
            var buffer = '';

            lines.forEach(function(line, index) {
                currentLine = index + 1;
                buffer += line;
                if (line.includes('}')) {
                    var parts = buffer.split('{');
                    if (parts.length === 2) {
                        var selector = parts[0].trim();
                        var properties = parts[1].split('}')[0].trim();
                        var ruleKey = `${selector} { ${properties} }`;
                        if (!rules[ruleKey]) {
                            rules[ruleKey] = {
                                selectors: [selector],
                                lines: [currentLine],
                                properties: properties
                            };
                        } else {
                            rules[ruleKey].selectors.push(selector);
                            rules[ruleKey].lines.push(currentLine);
                        }
                    }
                    buffer = '';
                }
            });

            return Object.values(rules).filter(rule => rule.selectors.length > 1);
        }

        function displayDuplicateRules(duplicateRules) {
            var output = document.getElementById('duplicateRules');
            if (duplicateRules.length === 0) {
                output.innerHTML = 'No duplicate rules found.';
            } else {
                output.innerHTML = '<strong>Duplicate Rules:</strong><br>';
                duplicateRules.forEach(function(rule) {
                    var color = `hsl(${Math.random() * 360}, 80%, 90%)`;
                    rule.selectors.forEach(function(selector, index) {
                        output.innerHTML += `<p style="background-color: ${color}; padding: 5px; border-radius: 4px;"><strong>${selector}</strong> (Line ${rule.lines[index]}): ${rule.properties}</p>`;
                    });
                });
            }
        }

        // Initialize line numbers
        updateLineNumbers();
    </script>
     <script>
        // Your existing JavaScript code here

        // Function to scroll to the top of the page
        function goToTop() {
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE, and Opera
        }

        // Function to toggle the visibility of the "Go to Top" button based on the scroll position
        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("goToTopBtn").style.display = "block";
            } else {
                document.getElementById("goToTopBtn").style.display = "none";
            }
        }
    </script>
</body>
</html>
