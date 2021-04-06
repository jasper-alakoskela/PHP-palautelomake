<link rel="stylesheet" href="style.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
<title>Palautelomake</title>
<?php include('functions.php'); ?>
<div class="content">
    <h1>Täytä lomake</h1>
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
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
        <br><br>
        <a href="feedback.php" id="feedback_link" target="blank_">Palautteet</a>
        <br>
        <div class="succes"><?= $success; ?></div>
    </form>
    </div>