<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Link longener</title>
</head>
<body>
<h1>Hello World</h1>
<form method="post" id="form">
    <label>Link:
        <input type="text" name="link" id="link" value="1234">
    </label>
    <button type="button" id="submit">Make my link longer</button>
</form>
<textarea name="newLink" id="newLink" cols="30" rows="10"></textarea>
<script>
    const submitButton = document.getElementById("submit");
    submitButton.addEventListener("click", function () {
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
