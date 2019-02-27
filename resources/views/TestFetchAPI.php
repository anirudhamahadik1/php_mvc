<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fetch API</title>
</head>
<body>
    <h1>Data retrieval using Fetch API</h1>
    <div id="dataDiv"></div>
    <script>
    fetch("http://localhost/php_mvc/test/read",
        {
            method : "post",
            headers: {
                "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
            },
            body : "id=1"
        }
    )
    .then(response => response.json())
    .then(jsonData => document.getElementById("dataDiv").innerHTML = JSON.stringify(jsonData));
    </script>
</body>
</html>