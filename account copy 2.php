<?php
session_start();
if (!isset($_SESSION['uid'])) {
    echo '<script>document.location.href="index.php"</script>';
    exit;
}

include ('includes/connect.php');

$user_id = $_SESSION['uid'];
$flight_id = $_GET['flight_id'] ?? '';
$from = $_GET['from'] ?? '';
$to = $_GET['to'] ?? '';
$date = $_GET['date'] ?? '';
$seats = isset($_GET['seats']) ? explode(',', $_GET['seats']) : array();
$seats_str = implode(',', $seats);

// Получение информации о пользователе
$user_query = "SELECT * FROM users WHERE id = '$user_id'";
$user_result = $conn->query($user_query);
$user = $user_result->fetch(PDO::FETCH_ASSOC);

// Получение роли пользователя
$role = $user['role'];

// Определение текста для активных билетов в зависимости от роли
$active_tickets_text = '';
if ($role == 1 || $role == 2) {
    $active_tickets_text = 'Активные билеты';
} elseif ($role == 0) {
    $active_tickets_text = 'Вы заблокированы';
}

// Получение информации о билетах пользователя
$tickets_query = "SELECT * FROM tickets WHERE user_id = '$user_id'";
$tickets_result = $conn->query($tickets_query);
$tickets = $tickets_result->fetchAll(PDO::FETCH_ASSOC);

// Получение информации о рейсах, для которых куплены билеты
$flights_info = array();
foreach ($tickets as $ticket) {
    $flight_query = "SELECT * FROM flights WHERE id = '{$ticket['flight_id']}'";
    $flight_result = $conn->query($flight_query);
    $flight_info = $flight_result->fetch(PDO::FETCH_ASSOC);
    if ($flight_info) {
        $flights_info[] = array(
            'number' => $flight_info['flight_number'],
            'model' => $flight_info['aircraft_model'],
            'departure' => $flight_info['departure_time'],
            'arrival' => $flight_info['arrival_time'],
            'from' => $flight_info['origin'],
            'to' => $flight_info['destination'],
            'date' => $ticket['purchase_date'],
            'seats' => explode(',', $ticket['seat_numbers'])
        );
    }
}
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
    <!-- HEADER START -->

    <?php include ('includes/header.php'); ?>

    <!-- HEADER END -->

    <!-- ACCOUNT START -->

    <section class="account container-xxl">
        <div class="account-bg m-4 p-5">
            <div class="account-name row">
                <div class="col-12 account-exit-1 text-center">
                    <?php if ($role == 2): ?>
                        <button type="button" class="btn btn-outline-header">Админ</button>
                    <?php endif; ?>
                </div>
                <div class="col account-exit-2">
                    <h3><?php echo htmlspecialchars($user['name']); ?></h3>
                    <p><span><?php echo htmlspecialchars($user['gender']); ?></span>
                        <?php echo htmlspecialchars($user['birthday']); ?> </p>
                </div>
                <div class="col text-end account-exit-3 b-block">
                    <?php if ($role == 2): ?>
                        <button type="button" class="btn btn-outline-header">Админ</button>
                    <?php endif; ?>
                </div>
            </div>
            <h2 class="text-center my-5"><?php echo htmlspecialchars($active_tickets_text); ?></h2>
            <?php if ($active_tickets_text == 'Активные билеты'): ?>
                <?php foreach ($flights_info as $flight_info): ?>
                    <div class="account-ticket row d-flex flex-column  flex-sm-row gap-4">
                        <div class="col text-center d-none d-md-block">
                            <p>Номер рейса</p>
                            <h3><?php echo htmlspecialchars($flight_info['number']); ?></h3>
                        </div>
                        <div class="col text-center d-block d-md-none">
                            <p>Номер <br> рейса</p>
                            <h3><?php echo htmlspecialchars($flight_info['number']); ?></h3>
                        </div>
                        <div class="col"></div>
                        <div class="col text-center">
                            <p>Модель самолета</p>
                            <h3><?php echo htmlspecialchars($flight_info['model']); ?></h3>
                        </div>
                        <div class="ticket-line w-100 d-block d-md-none d-flex text-center "></div>
                        <div class="col-12 d-flex flex-column flex-xl-row justify-content-center my-5">
                            <div class="ticket-info d-flex flex-column flex-md-row justify-content-center gap-5 gap-md-3">
                                <div class="info-item text-center">
                                    <h3><?php echo htmlspecialchars($flight_info['departure']); ?></h3>
                                    <p><?php echo htmlspecialchars($flight_info['from']); ?></p>
                                    <span><?php echo htmlspecialchars($flight_info['date']); ?></span>
                                </div>
                                <div class="info-item mt-3 d-none d-md-block">
                                    <img src="assets/image/tickets.svg" class="info-image" alt="Ticket">
                                </div>
                                <div class="info-item text-center">
                                    <h3><?php echo htmlspecialchars($flight_info['arrival']); ?></h3>
                                    <p><?php echo htmlspecialchars($flight_info['to']); ?></p>
                                    <span><?php echo htmlspecialchars($flight_info['date']); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-center mt-5">
                            <button type="button" class="btn btn-header">Сдать билет</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
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