<?php
include ('includes/connect.php');
include ('includes/session.php');

session_start();
if (!isset($_SESSION['uid'])) {
  echo '<script>document.location.href="index.php"</script>';
  exit();
}
?>


<script src="<?php echo __DIR__ . '/lib/autoload.php'; ?>"></script>

<?php
$flight_id = $_GET['flight_id'] ?? '';
$from = $_GET['from'] ?? '';
$to = $_GET['to'] ?? '';
$date = $_GET['date'] ?? '';
$base_price = $_GET['base_price'] ?? 0;
$total_price = $_GET['total_price'] ?? $base_price;
$seats = isset($_GET['seats']) ? explode(',', $_GET['seats']) : [];
$selected_services = json_decode($_GET['selected_services'] ?? '[]', true);

require_once __DIR__ . '/lib/autoload.php';

use YooKassa\Client;

$client = new Client();
$client->setAuth('393002', 'test_GI-WWDqBQ733PTh4aiq-Hv21PWYb8TQvAz6CQu9zm7g');

$return_url = "http://sky-bootstrap-main/account.php?flight_id={$flight_id}&from={$from}&to={$to}&date={$date}&base_price={$base_price}&total_price={$total_price}&seats=" . urlencode(implode(',', $seats));

$payment = $client->createPayment(
  array(
    'amount' => array(
      'value' => $total_price,
      'currency' => 'RUB',
    ),
    'confirmation' => array(
      'type' => 'redirect',
      'return_url' => $return_url,
    ),
    'capture' => true,
    'description' => $from . ' -> ' . $to,
  ),
  uniqid('', true)
);
?>


<!doctype html>
<html lang="ru">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>SkyBridge</title>
  <link rel="shortcut icon" href="assets/image/logo.svg" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="assets/fonts/stylesheet.css" />
  <link rel="stylesheet" href="assets/style/main.css" />
  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/navbar-static/" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3" />
  <link rel="stylesheet" href="assets/style/settings.css" />
  <link rel="stylesheet" href="assets/style/purchase.css" />
</head>

<body>

  <section class="container-xxl p-5">
    <div class="m-4">
      <script>
        var confirmationUrl = "<?= $payment->getConfirmation()->getConfirmationUrl(); ?>";

        window.location.replace(confirmationUrl);
      </script>
    </div>
  </section>

  <!-- FOOTER START -->

  <footer class="container">
    <a href="#">
      <p class="m-4">© 2024 Abdulin Nikita <br>
        Все права защищены</p>
    </a>
  </footer>

  <!-- FOOTER END -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>