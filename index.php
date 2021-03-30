<!DOCTYPE html>
<html lang="fi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Palautelomake</title>
</head>

<?php

    $name = $email = $message = $rate = $success = "";
    $name_err = $email_err = $message_err = $rate_err = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validoi nimikenttä
        if (empty($_POST["name"])) {
            $name_err = "Nimi Tarvitaan!";
        }
        else {
            $name = test_inputs($_POST["name"]);
            if (!preg_match("/^[a-äA-Ä ]*$/",$name)) {
                $name_err = "Nimessä Virhe!";
            }
        }
        // Validoi sähköpostikenttä
        if (empty($_POST["email"])) {
            $email_err = "Sähköposti Tarvitaan!";
        }
        else {
            $email = test_inputs($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_err = "Sähköpostissa Virhe!";
            }
        }
        // Validoi viestikenttä
        if (empty($_POST["message"])) {
            $message_err = "Palaute Tarvitaan!";
        }
        else {
            $message = test_inputs($_POST["message"]);
            if (!preg_match("/^[a-äA-Ä ]*$/",$message)) {
                $message_err = "Palautteessa Virhe!";
            }
        }
        // Validoi arvostelu 
        if (!isset($_POST["rate"])) {
            $rate_err = "Valitse Piditkö?!";
        }
        // Virhe viestien poisto
        if ($name_err == '' && $email_err == '' && $message_err == '' && $rate_err == '') {
            $message_body = '';
            unset($_POST["submit"]);
            foreach ($_POST as $key => $value) {
                $message_body .= "$key: $value\n";
            }
            // Palautteen lähettäminen
            $to = "palautelomake.vastaanottaja@gmail.com";
            $subject = "Palautteen lähettäminen";
            if (mail($to, $subject, $message)) {
                $success = "Palaute on lähetetty onnistuneesti!"
                $name = $email = $message = $rate = "";
            }
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    // Muokataan objekti
    $xml = simplexml_load_file("data.xml");
    $form = [$_POST["name"], $_POST["email"], $_POST["message"], $_POST["rate"], date("Y-m-d")];
    $newGuest = $xml -> addChild("feedback");
    $newGuest -> addChild("name", $form[0]);
    $newGuest -> addChild("email", $form[1]);
    $newGuest -> addChild("message", $form[2]);
    $newGuest -> addChild("rate", $form[3]);
    $newGuest -> addChild("date", $form[4]);

    // Tallennetaan muokattu objekti tiedostoon
    $dom = new DOMDocument("1.0");
    $dom -> preserveWhiteSpace = false;
    $dom -> formatOutput = true;
    $dom -> loadXML($xml->asXML());
    $dom -> save("data.xml");
?>

<body>
    <h1>Täytä lomake</h1>
    <form action="<?= $SERVER["PHP_SELF"]; ?>" method="POST">
        <label for="name">Nimi</label>
        <br><br>
        <input type="text" name="name" value="<?= $name ?>">
        <br><span class="error"><?= $name_err ?></span><br>
        <label for="email">Sähköposti</label>
        <br><br>
        <input type="email" name="email" value="<?= $email ?>">
        <br><span class="error"><?= $email_err ?></span><br>
        <label for="message">Palaute</label>
        <br><br>
        <textarea name="message" cols="30" rows="5" value="<?= $message ?>"></textarea>
        <br><span class="error"><?= $message_err ?></span><br>
        <label for="like">
            <input type="radio" id="like" name="rate" value="img/thumb_up.png">
            <img src="img/thumb_up.png">
        </label>

        <label for="dislike">
            <input type="radio" id="dislike" name="rate" value="img/thumb_down.png">
            <img src="img/thumb_down.png">
        </label>
        <br><span class="error"><?= $rate_err ?></span><br>
        <input type="submit" name="submit">
        <div><?= $success; ?></div>
    </form>
</body>

</html>