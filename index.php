<!DOCTYPE html>
<html lang="fi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    
    <title>Palautelomake</title>
</head>

<body>
<?php include('functions.php'); ?>
<div class="content">
    <h1>Täytä lomake</h1>
    <form action="<?= $SERVER["PHP_SELF"]; ?>" method="POST">
        <label for="name">Nimi</label>
        <br><br>
        <input type="text" name="name" value="<?= $name; ?>">
        <br><span class="error"><?= $name_err; ?></span><br>
        <label for="email">Sähköposti</label>
        <br><br>
        <input type="email" name="email" value="<?= $email; ?>">
        <br><span class="error"><?= $email_err; ?></span><br>
        <label for="message">Palaute</label>
        <br><br>
        <textarea name="message" cols="30" rows="5" value="<?= $message; ?>"></textarea>
        <br><span class="error"><?= $message_err; ?></span><br>
        <label for="like">
            <input type="radio" id="like" name="rate" value="img/thumb_up.png">
            <img src="img/thumb_up.png">
        </label>

        <label for="dislike">
            <input type="radio" id="dislike" name="rate" value="img/thumb_down.png">
            <img src="img/thumb_down.png">
        </label>
        <br><span class="error"><?= $rate_err; ?></span><br>
        <input id="submit" type="submit" name="submit">
        <div><?= $success; ?></div>
        <a href="feedback.php">Palautteet</a>
    </form>
    </div>
</body>

</html>