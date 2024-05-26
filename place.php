<?php include ('includes/connect.php'); ?>
<?php include ('includes/session.php'); ?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta property="og:title" content="SkyBridge">
  <meta property="og:description" content="Поиск и покупка авиабилетов">
  <meta property="og:url" content="	https://abdulin.vercel.app">
  <meta property="og:image" content="https://abdulin.vercel.app/assets/image/logo.svg">
  <meta property="og:type" content="website">
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

  <?php include ('includes/header.php'); ?>

  <!-- HEADER END -->

  <!-- PLACE START -->

  <?php
  $from = $_GET['from'] ?? '';
  $to = $_GET['to'] ?? '';
  $date = $_GET['date'] ?? '';
  $passengers = $_GET['passengers'] ?? '';

  if (empty($from) || empty($to)) {
    echo "Не указаны необходимые параметры.";
    exit;
  }

  try {
    $query = "SELECT f.id, f.departure_airport_code, f.arrival_airport_code, f.flight_duration, MIN(s.price) AS base_price 
              FROM flights f
              JOIN seat_map s ON f.id = s.flight_id 
              WHERE f.origin = :from AND f.destination = :to
              GROUP BY f.id
              LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->execute(['from' => $from, 'to' => $to]);
    $flight_info = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$flight_info) {
      echo "Информация о рейсе не найдена.";
      exit;
    }

    $flight_id = $flight_info['id'];
    $departure_airport = $flight_info['departure_airport_code'];
    $arrival_airport = $flight_info['arrival_airport_code'];
    $duration = $flight_info['flight_duration'];
    $base_price = $flight_info['base_price'];
  } catch (PDOException $e) {
    echo "Ошибка при получении информации о рейсе: " . $e->getMessage();
    exit;
  }
  ?>

  <section class="place container-xxl">
    <div class="place-bg row m-4">
      <h2 class="text-center text-lg-start">Выберите места</h2>
      <div class="plane col-12 col-sm d-flex flex-column align-items-center" data-aos="fade-right"
        data-aos-anchor="#example-anchor" data-aos-offset="800" data-aos-duration="800">
        <div class="plane-biz mb-sm-5 d-flex flex-column">
          <div class="union-item text-center mb-5 d-block d-lg-none">
            <h3>Бизнес</h3>
            <span>Класс</span>
            <p>Посадка первым</p>
            <p>Багаж 1x20кг до 210см</p>
            <p>Приём пищи</p>
            <p>Алкогольные напитки</p>
            <p>Ручная кладь 1x10кг</p>
          </div>

          <div class="seat-container">
            <?php
            $query = "SELECT seat_number, is_available, price FROM seat_map WHERE flight_id = :flight_id AND seat_category = 'Business'";
            $stmt = $conn->prepare($query);
            $stmt->execute(['flight_id' => $flight_id]);
            $businessSeats = $stmt->fetchAll(PDO::FETCH_ASSOC);

            for ($i = 0; $i < 16; $i++) {
              if (isset($businessSeats[$i])) {
                $seat_number = $businessSeats[$i]['seat_number'];
                $is_available = $businessSeats[$i]['is_available'] ? 'free-input' : 'dis-input';
                $seat_price = $businessSeats[$i]['price'];
              } else {
                $seat_number = 'N/A';
                $is_available = 'dis-input';
                $seat_price = 0;
              }

              echo '<div>
                    <input class="form-check-input seat-checkbox ' . $is_available . '" type="checkbox" value="' . $seat_number . '" id="bizCheck' . $i . '" data-price="' . $seat_price . '" onclick="updatePrice(' . $base_price . ')">
                  </div>';
            }
            ?>
          </div>
        </div>

        <div class="union-item text-center d-block d-lg-none mt-5 mt-sm-0">
          <h3>Эконом</h3>
          <span>Класс</span>
          <p>Приём пищи</p>
          <p>Ручная кладь 1x10кг</p>
        </div>
        <div class="plane-eco my-3">
          <div class="seat-container">
            <?php
            $query = "SELECT seat_number, is_available, price FROM seat_map WHERE flight_id = :flight_id AND seat_category = 'Economy'";
            $stmt = $conn->prepare($query);
            $stmt->execute(['flight_id' => $flight_id]);
            $economySeats = $stmt->fetchAll(PDO::FETCH_ASSOC);

            for ($i = 0; $i < 32; $i++) {
              if (isset($economySeats[$i])) {
                $seat_number = $economySeats[$i]['seat_number'];
                $is_available = $economySeats[$i]['is_available'] ? 'free-input' : 'dis-input';
                $seat_price = $economySeats[$i]['price'];
              } else {
                $seat_number = 'N/A';
                $is_available = 'dis-input';
                $seat_price = 0;
              }

              echo '<div>
                    <input class="form-check-input seat-checkbox ' . $is_available . '" type="checkbox" value="' . $seat_number . '" id="ecoCheck' . $i . '" data-price="' . $seat_price . '" onclick="updatePrice(' . $base_price . ')">
                  </div>';
            }
            ?>
          </div>
        </div>

        <div class="union-item text-center d-block d-lg-none">
          <h3>Лоукостер</h3>
          <span>Класс</span>
          <p>Ручная кладь 1x10кг</p>
        </div>
        <div class="plane-low mt-5 mb-5">
          <div class="seat-container">
            <?php
            $query = "SELECT seat_number, is_available, price FROM seat_map WHERE flight_id = :flight_id AND seat_category = 'Lowcost'";
            $stmt = $conn->prepare($query);
            $stmt->execute(['flight_id' => $flight_id]);
            $lowcostSeats = $stmt->fetchAll(PDO::FETCH_ASSOC);

            for ($i = 0; $i < 12; $i++) {
              if (isset($lowcostSeats[$i])) {
                $seat_number = $lowcostSeats[$i]['seat_number'];
                $is_available = $lowcostSeats[$i]['is_available'] ? 'free-input' : 'dis-input';
                $seat_price = $lowcostSeats[$i]['price'];
              } else {
                $seat_number = 'N/A';
                $is_available = 'dis-input';
                $seat_price = 0;
              }

              echo '<div>
                    <input class="form-check-input seat-checkbox ' . $is_available . '" type="checkbox" value="' . $seat_number . '" id="lowCheck' . $i . '" data-price="' . $seat_price . '" onclick="updatePrice(' . $base_price . ')">
                  </div>';
            }
            ?>
          </div>
        </div>
      </div>

      <div class="union-info col ms-4 d-none d-lg-block">
        <div class="union-item biz">
          <h3>Бизнес</h3>
          <span>Класс</span>
          <p>Посадка первым</p>
          <p>Багаж 1x20кг до 210см</p>
          <p>Приём пищи</p>
          <p>Алкогольные напитки</p>
          <p>Ручная кладь 1x10кг</p>
        </div>
        <div class="union-item eco">
          <h3>Эконом</h3>
          <span>Класс</span>
          <p>Приём пищи</p>
          <p>Ручная кладь 1x10кг</p>
        </div>
        <div class="union-item low">
          <h3>Лоукостер</h3>
          <span>Класс</span>
          <p>Ручная кладь 1x10кг</p>
        </div>
      </div>

      <div class="place-info col">
        <div class="place-name">
          <div class="d-flex gap-5 justify-content-center text-center">
            <div>
              <h3><?php echo $departure_airport; ?></h3>
              <p><?php echo $from; ?></p>
            </div>
            <div>
              <h3><?php echo $arrival_airport; ?></h3>
              <p><?php echo $to; ?></p>
            </div>
          </div>
          <div class="place-other text-center">
            <div>
              <h3><?php echo $duration; ?></h3>
              <p>Длительность</p>
            </div>
            <div>
              <h3 id="totalPrice"><?php echo $base_price; ?>₽</h3>
              <p>Цена</p>
            </div>
            <a id="nextButton" href="#">
              <button type="button" class="btn btn-main">Далее</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- PLACE END -->

  <!-- FOOTER START -->

  <footer class="container-xxl">
    <a href="#">
      <p class="m-4 mt-5 pt-5">© 2024 Abdulin Nikita <br>
        Все права защищены</p>
    </a>
  </footer>

  <!-- FOOTER END -->

  <!-- JAVASCRIPT -->

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      function setDefaultMessage() {
        const totalPriceElement = document.getElementById('totalPrice');
        const nextButton = document.getElementById('nextButton');
        totalPriceElement.innerText = 'Выберите место';
        nextButton.setAttribute('href', '#');
      }

      setDefaultMessage();
    });
  </script>

  <script>
    function updatePrice(basePrice) {
      let totalPrice = basePrice;
      const checkboxes = document.querySelectorAll('.seat-checkbox:checked');
      const selectedSeats = [];

      checkboxes.forEach(checkbox => {
        totalPrice += parseFloat(checkbox.dataset.price);
        selectedSeats.push(checkbox.value);
      });

      const totalPriceElement = document.getElementById('totalPrice');
      const nextButton = document.getElementById('nextButton');
      if (checkboxes.length > 0) {
        totalPriceElement.innerText = totalPrice.toFixed(2) + '₽';
        const url = `payment.php?flight_id=<?php echo $flight_id; ?>&from=<?php echo $from; ?>&to=<?php echo $to; ?>&date=<?php echo $date; ?>&total_price=${totalPrice.toFixed(2)}&seats=${selectedSeats.join(',')}`;
        nextButton.setAttribute('href', url);
      } else {
        totalPriceElement.innerText = 'Выберите место';
        nextButton.setAttribute('href', '#');
      }
    }
  </script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>

  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({
      disable: function () {
        return window.innerWidth < 992;
      }
    });
  </script>

</body>

</html>