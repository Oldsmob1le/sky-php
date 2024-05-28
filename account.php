<?php
include ('includes/session.php');

session_start();
include ('includes/connect.php');

if (!isset($_SESSION['uid'])) {
    echo '<script>document.location.href="index.php"</script>';
    exit;
}

$user_id = $_SESSION['uid'];
$flight_id = $_GET['flight_id'] ?? '';
$from = $_GET['from'] ?? '';
$to = $_GET['to'] ?? '';
$date = $_GET['date'] ?? '';
$seats = isset($_GET['seats']) ? explode(',', $_GET['seats']) : [];
$seats_str = implode(',', $seats);

$user_query = "SELECT * FROM users WHERE id = '$user_id'";
$user_result = $conn->query($user_query);
$user = $user_result->fetch(PDO::FETCH_ASSOC);

$role = $user['role'];

$active_tickets_text = '';
if ($role == 1 || $role == 2) {
    $active_tickets_text = 'Активные билеты';
} elseif ($role == 0) {
    $active_tickets_text = 'Вы заблокированы';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ticket_id'])) {
    $ticket_id = $_POST['ticket_id'];

    $delete_ticket_query = "DELETE FROM tickets WHERE id = '$ticket_id' AND user_id = '$user_id'";
    $conn->exec($delete_ticket_query);

    echo '<script>document.location.href="account.php"</script>';
    exit;
}

if ($flight_id && $from && $to && $date && !empty($seats)) {
    $check_ticket_query = "SELECT * FROM tickets WHERE user_id = '$user_id' AND flight_id = '$flight_id' AND seat_numbers = '$seats_str'";
    $check_ticket_result = $conn->query($check_ticket_query);
    $ticket_exists = $check_ticket_result->fetch(PDO::FETCH_ASSOC);

    if (!$ticket_exists) {
        $flight_date = $_GET['date'];

        $insert_ticket_query = "INSERT INTO tickets (user_id, flight_id, seat_numbers, purchase_date, flight_date) VALUES ('$user_id', '$flight_id', '$seats_str', NOW(), '$flight_date')";
        $conn->exec($insert_ticket_query);
    }
}

$tickets_query = "SELECT * FROM tickets WHERE user_id = '$user_id'";
$tickets_result = $conn->query($tickets_query);
$tickets = $tickets_result->fetchAll(PDO::FETCH_ASSOC);

$flights_info = array();
foreach ($tickets as $ticket) {
    $flight_query = "SELECT * FROM flights WHERE id = '{$ticket['flight_id']}'";
    $flight_result = $conn->query($flight_query);
    $flight_info = $flight_result->fetch(PDO::FETCH_ASSOC);
    if ($flight_info) {
        $departure_time = (new DateTime($flight_info['departure_time']))->format('H:i');
        $arrival_time = (new DateTime($flight_info['arrival_time']))->format('H:i');
        $flight_date = new DateTime($ticket['flight_date']);
        $purchase_date = new DateTime($ticket['purchase_date']);

        $months = [
            1 => 'Января',
            2 => 'Февраля',
            3 => 'Марта',
            4 => 'Апреля',
            5 => 'Мая',
            6 => 'Июня',
            7 => 'Июля',
            8 => 'Августа',
            9 => 'Сентября',
            10 => 'Октября',
            11 => 'Ноября',
            12 => 'Декабря',
        ];

        $flight_month = $months[$flight_date->format('n')];
        $purchase_month = $months[$purchase_date->format('n')];

        $formatted_flight_date = $flight_date->format('d ') . $flight_month . $flight_date->format(' Y');
        $formatted_purchase_date = $purchase_date->format('d ') . $purchase_month . $purchase_date->format(' Y');

        $flights_info[] = array(
            'number' => $flight_info['flight_number'],
            'model' => $flight_info['aircraft_model'],
            'departure' => $departure_time,
            'arrival' => $arrival_time,
            'from' => $flight_info['origin'],
            'to' => $flight_info['destination'],
            'date' => $formatted_flight_date,
            'purchase' => $formatted_purchase_date,
            'seats' => explode(',', $ticket['seat_numbers']),
            'ticket_id' => $ticket['id']
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
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
                        <a href="A1D2M3I4N5.php"> <button type="button" class="btn btn-outline-header">Админ</button></a>
                    <?php endif; ?>
                </div>
                <div class="col account-exit-2">
                    <h3><?php echo htmlspecialchars($user['name']); ?></h3>
                    <p><span><?php echo htmlspecialchars($user['gender']); ?></span>
                        <?php echo htmlspecialchars($user['birthday']); ?> </p>
                </div>
                <div class="col text-end account-exit-3 b-block">
                    <?php if ($role == 2): ?>
                        <a href="A1D2M3I4N5.php"> <button type="button" class="btn btn-outline-header">Админ</button></a>
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
                        <div class="col-12 d-flex flex-column flex-xl-row
                        justify-content-center my-5">
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
                        <div class="text-center date-purchase">
                            <span>Дата покупки: <?php echo htmlspecialchars($flight_info['purchase']); ?></span> <br>
                            <span>Места: <?php echo htmlspecialchars(implode(', ', $flight_info['seats'])); ?></span>
                        </div>
                        <div class="col-12 text-center mt-5">
                            <form action="account.php" method="POST"
                                onsubmit="return confirm('Вы уверены, что хотите сдать билет?');">
                                <input type="hidden" name="ticket_id"
                                    value="<?php echo htmlspecialchars($flight_info['ticket_id']); ?>">
                                <button type="submit" class="btn btn-header">Сдать билет</button>
                            </form>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
