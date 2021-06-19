<?php
session_start();

function restoreDatabaseTables($dbHost, $dbUsername, $dbPassword, $dbName, $filePath){
    // Connect & select the database
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    // Temporary variable, used to store current query
    $templine = '';

    // Read in entire file
    $lines = file($filePath);

    $error = '';

    // Loop through each line
    foreach ($lines as $line){
        // Skip it if it's a comment
        if(substr($line, 0, 2) == '--' || $line == ''){
            continue;
        }

        // Add this line to the current segment
        $templine .= $line;

        // If it has a semicolon at the end, it's the end of the query
        if (substr(trim($line), -1, 1) == ';'){
            // Perform the query
            if(!$db->query($templine)){
                $error .= 'Error performing query "<b>' . $templine . '</b>": ' . $db->error . '<br /><br />';
            }

            // Reset temp variable to empty
            $templine = '';
        }
    }
    return !empty($error)?$error:true;
}

if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] == 2) {

    }else {
        header("Location: ../main.php");
    }
}
?>

<!DOCTYPE html>
<lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="with-device-width, initial-scale = 1.0">
    <title>Восстановление бд</title>
</head>
<body >

<?php require "../../../../parts/header.php"?>
<?php
require_once '../../../../Script/app_config.php';

$mysql_host = DATABASE_HOST;
$mysql_database = "sts07-14263";
$mysql_user = DATABASE_USERNAME;
$mysql_password = DATABASE_PASSWORD;
$result = restoreDatabaseTables($mysql_host, $mysql_user, $mysql_password, $mysql_database, "db.sql");
if ($result) {
    echo "База данных восстановлена";
} else {
    echo $result;
}
?>

</body>
<?php require "../../../../parts/footer.php"?>
</html>

