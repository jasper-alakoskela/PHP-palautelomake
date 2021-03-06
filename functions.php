<?php
    // Anna muuttujille tyhjät arvot 
    $name_err = $email_err = $message_err = $rate_err = "";
    $name = $email = $message = $success = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Validoi nimikenttä
        if (empty($_POST["name"])) {
            $name_err = "Nimi Tarvitaan!";
            return false;
        }
        else {
            $name = test_inputs($_POST["name"]);
            if (!preg_match("/^[a-äA-Ä ]*$/",$name)) {
                $name_err = "Käytä vain aakkosia a-ä, A-Ä!";
                return false;
            }
        }
        // Validoi sähköpostikenttä
        if (empty($_POST["email"])) {
            $email_err = "Sähköposti Tarvitaan!";
            return false;
        }
        else {
            $email = test_inputs($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_err = "Sähköpostissa Virhe!";
                return false;
            }
        }
        // Validoi viestikenttä
        if (empty($_POST["message"])) {
            $message_err = "Palaute Tarvitaan!";
            return false;
        }
        else {
            $message = test_inputs($_POST["message"]);
            if (!preg_match("/^[a-äA-Ä ]*$/",$message)) {
                $message_err = "Käytä vain aakkosia a-ä, A-Ä";
                return false;
            }
        }
        // Validoi arvostelu 
        if (!isset($_POST["rate"])) {
            $rate_err = "Valitse Piditkö?!";
            return false;
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

        // Virhe viestien poisto
        if ($name_err == '' && $email_err == '' && $message_err == '' && $rate_err == '') {
            $message_body = '';
            unset($_POST["submit"]);
            foreach ($_POST as $key => $value) {
                $message_body .= "$key: $value\n";
            }
            
            // Palautteen lähettäminen
            $to = "palautelomake@localhost.com";
            $subject = "Asiakkaalta palautetta";
            $headers = "From: Palaute";
            if (mail($to, $subject, $message_body, $headers)) {
                $success = "Palaute on lähetetty onnistuneesti!";
                $name = $email = $message = "";
            }
        }
         
    }

    function test_inputs($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>