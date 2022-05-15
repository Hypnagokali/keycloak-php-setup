<!Doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Muh</title>
</head>

<body>
<h1>Geheime Webseite</h1>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';
use Jumbojett\OpenIDConnectClient;

session_start();

if (array_key_exists('code', $_SESSION) && $_SESSION['code'] && $_SESSION['code'] === $_REQUEST['code']) {
    unset($_REQUEST['code']);
} else {
    if ($_REQUEST['code']) {
        $_SESSION['code'] = $_REQUEST['code'];
    }
}

$oidc = new OpenIDConnectClient('http://localhost:8080/realms/php-test',
                                'php-test-client',
                                'mi4POfdw5HRMd0haD0H8zraxuoTMKwEa');

$oidc->setHttpUpgradeInsecureRequests(false);
$oidc->authenticate();
$name = $oidc->requestUserInfo('email');

echo "<h3>Benutzer ist eingeloggt</h3>";
echo "<h3>E-Mail: $name</h3>";

?>

</body>


</html>