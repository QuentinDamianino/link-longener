<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Link longener</title>
</head>
<body>
<h1>Hello World</h1>
<form id="form">
    <label>Link:
        <input type="text" name="link" id="link" value="">
    </label>
    <input type="submit" id="submit" value="make my link longer">
</form>
<textarea name="newLink" id="newLink" cols="30" rows="10"></textarea>
<script>
    const form = document.getElementById("form");
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        const link = document.getElementById('link').value;
        const newLink = document.getElementById("newLink");

        let formData = new FormData();
        formData.append('link', link);

        fetch("https://sobig.ddev.site/longer-link", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            newLink.innerHTML = data.link;
        });
    });
</script>
</body>
</html>
