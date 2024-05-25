<?php include ('includes/session.php'); ?>

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
    <!-- HEADER START -->

    <?php include ('includes/header.php'); ?>

    <!-- HEADER END -->

    <!-- ACCOUNT START -->

    <?php
    session_start();
    if (!isset($_SESSION['uid'])) {
        echo '<script>document.location.href="index.php"</script>';
    }

    include ('includes/connect.php');

    $user_id = $_SESSION['uid'];
    $user_query = "SELECT * FROM users WHERE id = $user_id";
    $user_stmt = $conn->prepare($user_query);
    $user_stmt->execute();
    $user = $user_stmt->fetch(PDO::FETCH_ASSOC);

    $flight_id = $_GET['flight_id'] ?? '';
    $flight_query = "SELECT * FROM flights WHERE id = $flight_id";
    $flight_stmt = $conn->prepare($flight_query);
    $flight_stmt->execute();
    $flight = $flight_stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $flight) {
        $name = $user['name'];
        $birthday = $user['birthday'];
        $gender = $user['gender'];
        $model = $flight['aircraft_model'];
        $number = $flight['flight_number'];
        $departure = $flight['departure_time'];
        $arrival = $flight['arrival_time'];
        $seats = isset($_GET['seats']) ? explode(',', $_GET['seats']) : array();
    }

    $flight_id = $_GET['flight_id'] ?? '';
    $from = $_GET['from'] ?? '';
    $to = $_GET['to'] ?? '';
    $date = $_GET['date'] ?? '';
    $seats = isset($_GET['seats']) ? explode(',', $_GET['seats']) : array();

    ?>

    <section class="account container-xxl">
        <div class="account-bg m-4 p-5">
            <div class="account-name row">
                <div class="col-12 account-exit-1 text-center">
                    <button type="button" class="btn btn-outline-header">Выйти</button>
                </div>
                <div class="col account-exit-2">
                    <h3><? echo $name; ?></h3>
                    <p><span><? echo $gender; ?></span> <? echo $birthday; ?> </p>
                </div>
                <div class="col text-end account-exit-3">
                    <button type="button" class="btn btn-outline-header">Выйти</button>
                </div>
            </div>
            <h2 class="text-center my-5">Активные билеты</h2>
            <div class="account-ticket row d-flex flex-column  flex-sm-row gap-4">
                <div class="col text-center d-none d-md-block">
                    <p>Номер рейса</p>
                    <h3><? echo $number; ?></h3>
                </div>
                <div class="col text-center d-block d-md-none">
                    <p>Номер <br> рейса</p>
                    <h3><? echo $number; ?></h3>
                </div>
                <div class="col"></div>
                <div class="col text-center">
                    <p>Модель самолета</p>
                    <h3><? echo $model; ?></h3>
                </div>
                <div class="ticket-line w-100 d-block d-md-none d-flex text-center "></div>
                <div class="col-12 d-flex flex-column flex-xl-row justify-content-center my-5">
                    <div class="ticket-info d-flex flex-column flex-md-row justify-content-center gap-5 gap-md-3">
                        <div class="info-item text-center">
                            <h3><? echo $departure; ?></h3>
                            <p><? echo $from; ?></p>
                            <span><? echo $date; ?></span>
                        </div>
                        <div class="info-item mt-3 d-none d-md-block">
                            <img src="assets/image/tickets.svg" class="info-image" alt="Ticket">
                        </div>
                        <div class="info-item text-center">
                            <h3><? echo $arrival; ?></h3>
                            <p><? echo $to; ?></p>
                            <span><? echo $date; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center mt-5">
                    <button type="button" class="btn btn-header">Сдать билет</button>
                </div>
            </div>
        </div>
    </section>

    <!-- ACCOUNT END -->

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