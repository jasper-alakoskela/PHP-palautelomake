<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Palaute</title>
</head>

<body>
    <h1>Palaute</h1>
    <br><hr>
    <?php
        // Näytetään XML objekti sivulla
        $xml = simplexml_load_file("data.xml");
        foreach ($xml->feedback as $feedback) {
        echo "<p>$feedback->name</p>";
        echo "<p>$feedback->email<p>";
        echo "<p>$feedback->message<p>";
        echo "<img src='$feedback->rate'>";
        echo "<p style='font-size:small; color:darkgrey;'>$feedback->date</p>";
        echo "<hr>";
        }
?>
</body>
</html>
