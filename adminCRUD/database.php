<?php
//the script first includes a separate config file that stores the database credentials. This way, the actual credentials are not hardcoded in the script and are therefore more secure.
// Store database credentials in a separate config file
require_once 'config.php';

// Error handling
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Try to connect to the database
try {
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
} catch (mysqli_sql_exception $e) {
    echo '<p style="color:red;">Cannot connect to the database</p>';
    echo $e->getMessage();
    exit();
}

echo '<p style="color:green;" hidden>Successfully connected to the database</p>';

?>
