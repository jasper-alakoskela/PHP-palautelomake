<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_feedback.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <title>Palaute</title>
</head>

<body>
    <h1>Palaute</h1>
    <?php
        // Näytetään XML objekti sivulla
        $xml = simplexml_load_file("data.xml");
        foreach ($xml->feedback as $feedback) {
        echo "<p>$feedback->name <br> $feedback->email <br> $feedback->message</p>";
        echo "<img src='$feedback->rate'>";
        echo "<p id='date'>$feedback->date</p>";
        }
?>
</body>
</html>
