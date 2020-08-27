<?php

require_once("Database.php");

define("MAXIMUM_LENGTH", 4000);

// Check if the required parameters are passed
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["vname"], $_POST["nname"], $_POST["email"], $_POST["age"], $_POST["phone"], $_POST["studiengang"], $_POST["bama"], $_POST["international"], $_POST["teilnahme"])) {

    $db = new Database();
    $pdo = $db->connect();

    if (is_null($pdo)) {
        // Quit the script, if no database connection could be established
        header("Location: ../" . getEnglishPrefix() . "error.php");
        error_log("Database connect failed");
        exit();
    }

    // Define variables and set to empty values
    $freitagabend = $altfreitagabend = $problem = $altproblem = $produktiv = $gapyear = $altgapyear = $engagement = "";
    $altengagement = $warumphysik = $wuensche = $age = $vname = $nname = $email = $studiengang = $bachelor = "";
    $international = $teilnahme = $comment = $success = $phone = "";

    $fr = $pr = $prod = $gap = $eng = "";

    // Read the values and process them
    $freitagabend = $_POST["freitagabend"];
    $altfreitagabend = $_POST["altfreitagabend"];
    foreach ((array)$freitagabend as $item) {
        $fr .= $item . ",";
    }
    $fr .= $altfreitagabend;

    $problem = $_POST["problem"];
    $altproblem = $_POST["altproblem"];
    foreach ((array)$problem as $item) {
        $pr .= $item . ",";
    }
    $pr .= $altproblem;

    $produktiv = $_POST["produktiv"];
    foreach ((array)$produktiv as $item) {
        $prod .= $item . ",";
    }

    $gapyear = $_POST["gapyear"];
    $altgapyear = $_POST["altgapyear"];
    foreach ((array)$gapyear as $item) {
        $gap .= $item . ",";
    }
    $gap .= $altgapyear;

    $engagement = $_POST["engagement"];
    $altengagement = $_POST["altengagement"];
    foreach ((array)$engagement as $item) {
        $eng .= $item . ",";
    }
    $eng .= $altengagement;

    // Check the values of the generated functions
    checkInput($fr);
    checkInput($pr);
    checkInput($prod);
    checkInput($gap);
    checkInput($eng);

    $warumphysik = checkInput($_POST["warumphysik"]);
    $wuensche = checkInput($_POST["wuensche"]);
    $vname = checkInput($_POST["vname"]);
    $nname = checkInput($_POST["nname"]);
    $email = checkInput($_POST["email"]);
    $age = checkAge(checkInput($_POST["age"]));
    $phone = checkInput($_POST["phone"]);
    $studiengang = checkInput($_POST["studiengang"]);
    $bama = checkInput($_POST["bama"]);
    $international = checkInput($_POST["international"]);
    $teilnahme = checkInput($_POST["teilnahme"]);

    if (isset($_POST["message"])) {
        $message = checkInput($_POST["message"]);
    } else {
        $message = "";
    }

    // Create query and bind the parameters
    $query = $pdo->prepare("INSERT INTO anmeldung (Freitagabend, Problem, Produktiv, Gapyear, Engagement, Warumphysik, Wuensche, Age, Vname, Nname, Email, Telefon, Studiengang, Bama, International, Teilnahme, Message) VALUES (:abend, :problem, :produktiv, :gapyear, :engagement, :warumphysik, :wuensche, :age, :vname, :nname, :email, :phone, :studiengang, :bama, :international, :teilnahme, :message);");
    $query->bindParam(":abend", $fr);
    $query->bindParam(":problem", $pr);
    $query->bindParam(":produktiv", $prod);
    $query->bindParam(":gapyear", $gap);
    $query->bindParam(":engagement", $eng);
    $query->bindParam(":warumphysik", $warumphysik);
    $query->bindParam(":wuensche", $wuensche);
    $query->bindParam(":age", $age);
    $query->bindParam(":vname", $vname);
    $query->bindParam(":nname", $nname);
    $query->bindParam(":email", $email);
    $query->bindParam(":phone", $phone);
    $query->bindParam(":studiengang", $studiengang);
    $query->bindParam(":bama", $bama);
    $query->bindParam(":international", $international);
    $query->bindParam(":teilnahme", $teilnahme);
    $query->bindParam(":message", $message);

    // Execute the query
    $query->execute();

    // Close the query
    $query->closeCursor();

    // If the query was executed successfully, then refer to the next page and quit the script with exit()
    header("Location: ../" . getEnglishPrefix() . "success.php");
    exit();

} else {
    // If the required parameters are missing, the redirect the user to the error page
    header("Location: ../" . getEnglishPrefix() . "error.php");
    error_log("Parameters missing");
    exit();
}

function checkInput($data)
{
    if (strlen((string)$data) > MAXIMUM_LENGTH) {
        header("Location: ../" . getEnglishPrefix() . "error.php?error=1 ");
        error_log("Passed parameter is longer than the maximum text size.");
        exit();
    }
    return $data;
}

function checkAge($age)
{
    if (is_numeric($age)) {
        $age = (int)$age;

        if ($age < 0) {
            header("Location: ../" . getEnglishPrefix() . "error.php?error=2 ");
            error_log("Passed age is negative.");
            exit();
        }

        return $age;

    } else {
        header("Location: ../" . getEnglishPrefix() . "error.php?error=2 ");
        error_log("Passed age is not a number.");
        exit();
    }
}

function isEnglish()
{
    return isset($_POST["english_version"]);
}

function getEnglishPrefix()
{
    if (isEnglish()) {
        return "english/";
    } else {
        return "";
    }
}

?>
