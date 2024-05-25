<?php
include ('includes/connect.php');
include ('includes/session.php');

session_start();
if (!isset($_SESSION['uid'])) {
    echo '<script>document.location.href="index.php"</script>';
    exit();
}

$services_query = "SELECT name, description, price FROM services";
$services_stmt = $conn->prepare($services_query);
$services_stmt->execute();
$services = $services_stmt->fetchAll(PDO::FETCH_ASSOC);

$flight_id = $_GET['flight_id'] ?? '';
$flight_query = "SELECT * FROM flights WHERE id = :flight_id";
$flight_stmt = $conn->prepare($flight_query);
$flight_stmt->execute(['flight_id' => $flight_id]);
$flight = $flight_stmt->fetch(PDO::FETCH_ASSOC);

if ($flight) {
  $model = $flight['aircraft_model'];
  $number = $flight['flight_number'];
  $departure = $flight['departure_time'];
  $arrival = $flight['arrival_time'];
  $departure_airport = $flight['departure_airport_code'];
  $arrival_airport = $flight['arrival_airport_code'];
  $duration = $flight['flight_duration'];
  $seats = isset($_GET['seats']) ? explode(',', $_GET['seats']) : array();
}

$from = $_GET['from'] ?? '';
$to = $_GET['to'] ?? '';
$date = $_GET['date'] ?? '';
$base_price = $_GET['base_price'] ?? 0;
$total_price = $_GET['total_price'] ?? $base_price;
$seats = $_GET['seats'] ?? '';
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
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="assets/style/settings.css" />
  <link rel="stylesheet" href="assets/style/purchase.css" />

</head>

<body>

  <!-- HEADER START -->

  <?php include 'includes/header.php'; ?>

  <!-- HEADER END -->

  <section class="payment container-xxl">
    <div class="payment-bg m-4 row d-flex flex-column flex-lg-row mt-5">
      <h2 class="text-center text-lg-start mb-4 mt-sm-5 mb-sm-5">Выберете дополнительные услуги</h2>
      <div class="payment-service col d-flex flex-column gap-4">
        <?php foreach ($services as $index => $service): ?>
          <a class="text-decoration-none"
            onclick="toggleService(this.firstElementChild, <?php echo htmlspecialchars($base_price); ?>)">
            <div class="payment-item" data-price="<?php echo htmlspecialchars($service['price']); ?>"
              data-aos="fade-right" data-aos-anchor="#example-anchor"
              data-aos-offset="<?php echo 400 + ($index * 100); ?>"
              data-aos-duration="<?php echo 400 + ($index * 100); ?>">
              <h3><?php echo htmlspecialchars($service['name']); ?></h3>
              <p><?php echo htmlspecialchars($service['description']); ?></p>
            </div>
          </a>
        <?php endforeach; ?>
      </div>
      <div class="place-info payment-place text-center col d-flex flex-column align-items-center">
        <div class="place-name d-flex gap-5">
          <div>
            <h3><?php echo htmlspecialchars($departure_airport); ?></h3>
            <p><?php echo htmlspecialchars($from); ?></p>
          </div>
          <div>
            <h3><?php echo htmlspecialchars($arrival_airport); ?></h3>
            <p><?php echo htmlspecialchars($to); ?></p>
          </div>
        </div>
        <div class="place-other d-flex flex-column align-items-center">
          <div>
            <h3><?php echo htmlspecialchars($duration); ?></h3>
            <p>Длительность</p>
          </div>
          <div>
            <h3><?php echo htmlspecialchars($seats); ?></h3>
            <p>Места</p>
          </div>
          <div>
            <h3 id="total-price"><?php echo htmlspecialchars($total_price); ?>₽</h3>
            <p>Цена</p>
          </div>
          <a href="purchase.html">
            <button type="button" class="btn btn-main">Оплатить</button>
          </a>
        </div>
      </div>
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

  <script src="assets/script/payment.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      AOS.init();
    });

    function updateTotalPrice(basePrice) {
      basePrice = parseFloat(basePrice) || 0;
      const selectedServices = document.querySelectorAll('.payment-item.active');
      let totalPrice = basePrice;
      selectedServices.forEach(service => {
        totalPrice += parseFloat(service.dataset.price) || 0;
      });
      document.getElementById('total-price').innerText = totalPrice.toFixed(2) + '₽';
    }

    function toggleService(serviceElement, basePrice) {
      serviceElement.classList.toggle('active');
      updateTotalPrice(basePrice);
    }
  </script>

</body>

</html>
