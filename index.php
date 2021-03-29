<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Palautelomake</title>
</head>

<body>
    <h1>Täytä lomake</h1>
    <form action="feedback.php" method="POST">
        <label for="name">Nimi</label>
        <br><br>
        <input type="text" name="name">
        <br><br>
        <label for="email">Sähköposti</label>
        <br><br>
        <input type="email" name="email">
        <br><br>
        <label for="message">Palaute</label>
        <br><br>
        <textarea name="message" cols="30" rows="5" placeholder="pakollinen"></textarea>
        <br>
        <?php
            if (empty($_POST["message"])) {
                echo "<p style='color:maroon;'>Kirjoita palaute!</p>";
            }?>
        
        <label for="like">
            <input type="radio" id="like" name="rate" value="img/thumb_up.png">
            <img src="img/thumb_up.png">
        </label>

        <label for="dislike">
            <input type="radio" id="dislike" name="rate" value="img/thumb_down.png">
            <img src="img/thumb_down.png">
        </label>
        <br><br>
        <input type="submit" name="submit">
    </form>
</body>

</html>