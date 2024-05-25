<?php

include 'connect.php';
include 'session.php';

setlocale(LC_TIME, 'ru_RU.UTF-8');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['base_price']) && isset($_POST['baggage'])) {
    $base_price = floatval($_POST['base_price']);
    $baggage = floatval($_POST['baggage']);
    $with_baggage = isset($_POST['with_baggage']) && $_POST['with_baggage'] === 'true';

    $end_price = $base_price;
    if ($with_baggage) {
        $end_price += $baggage;
    }

    echo number_format($end_price, 0, ',', ' ') . ' ₽';
    exit;
}

$from = $_GET['from'] ?? '';
$to = $_GET['to'] ?? '';
$date = $_GET['date'] ?? '';
$passengers = (int) ($_GET['passengers'] ?? 1);

if ($from && $to && $date) {

    $dateObj = new DateTime($date);

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

    $monthNumber = $dateObj->format('n');

    $monthName = $months[$monthNumber];

    $formattedDate = $dateObj->format('d ') . $monthName; 

    $sql = "SELECT * FROM flights WHERE origin = '$from' AND destination = '$to'";

    $result = $conn->query($sql);
    if (!$result) {
        echo "Ошибка выполнения запроса: " . $conn->errorInfo()[2];
    } else {
        $row = $result->fetch(PDO::FETCH_ASSOC);

        $departure_time = substr($row['departure_time'], 0, 5);
        $arrival_time = substr($row['arrival_time'], 0, 5);
        $base_price = $row['base_price'];
        $baggage = $row['baggage'];

        $ticketInfo = [
            'origin' => $from,
            'destination' => $to,
            'departure_time' => $departure_time,
            'arrival_time' => $arrival_time,
            'date' => $formattedDate,
            'passengers' => $passengers,
            'base_price' => $base_price,
            'baggage' => $baggage
        ];
    }
    ?>

    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Ticket</title>
    </head>
    <body>
        <section class='ticket container-xxl'>
            <div class='ticket-bg row m-5 p-5 d-flex flex-column flex-xl-row'>
                <div class='py-4 ticket-info d-flex flex-column flex-md-row col justify-content-center gap-5 gap-md-3'>
                    <div class='info-item text-center'>
                        <h3><?php echo htmlspecialchars($ticketInfo['departure_time']); ?></h3>
                        <p><?php echo htmlspecialchars($ticketInfo['origin']); ?></p>
                        <span><?php echo htmlspecialchars($ticketInfo['date']); ?></span>
                    </div>
                    <div class='info-item mt-3 d-none d-md-block'>
                        <img src='assets/image/tickets.svg' class='info-image' alt='Ticket'>
                    </div>
                    <div class='info-item text-center'>
                        <h3><?php echo htmlspecialchars($ticketInfo['arrival_time']); ?></h3>
                        <p><?php echo htmlspecialchars($ticketInfo['destination']); ?></p>
                        <span><?php echo htmlspecialchars($ticketInfo['date']); ?></span>
                    </div>
                </div>

                <div class='ticket-line col-1 d-none d-xl-block ms-5'></div>

                <div class='py-4 ticket-price col d-flex flex-column align-items-center mt-lg-auto'>
                    <div class='ticket-line w-50 m-4 d-block d-md-none'></div>
                    <h2 id="endPrice"><?php echo number_format($ticketInfo['base_price'], 0, ',', ' '); ?> ₽</h2>
                    <div class='price-item price-bg d-flex gap-2 align-items-center'>
                        <p>Багаж <span>+ <?php echo number_format($ticketInfo['baggage'], 0, ',', ' '); ?> ₽</span></p>
                        <div class='form-check form-switch price-switch'>
                            <input class='form-check-input switch-input' type='checkbox' id='flexSwitchCheckDefault'
                                onchange="updatePrice(<?php echo $ticketInfo['base_price']; ?>, <?php echo $ticketInfo['baggage']; ?>)" />
                        </div>
                    </div>
                    <div class='price-item mt-2'>
                        <?php
                        if (isset($_SESSION['uid'])) {
                            ?>
                            <a href='place.php?from=<?php echo urlencode($ticketInfo['origin']); ?>&to=<?php echo urlencode($ticketInfo['destination']); ?>&date=<?php echo urlencode($date); ?>&base_price=<?php echo $base_price; ?>'>
                                <button type='button' class='btn btn-main'>Выбрать билет</button>
                            </a>
                            <?php
                        } else {
                            ?>
                            <button type="button" class="btn btn-main" data-bs-toggle="modal" data-bs-target="#loginModal">
                                Выбрать билет
                            </button>
                            <?php
                        }
                        ?>
                    </div>

                    <!-- Модальное окно для входа в аккаунт -->
                    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="loginModalLabel">Войти в аккаунт</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="loginForm" method="POST">
                                        <div class="mb-3">
                                            <label for="loginEmail" class="form-label">Email:</label>
                                            <input type="email" class="form-control" id="loginEmail" name="email"
                                                placeholder="Введите email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="loginPassword" class="form-label">Пароль:</label>
                                            <input type="password" class="form-control" id="loginPassword" name="password"
                                                placeholder="Введите пароль" required>
                                        </div>
                                        <button type="submit" class="btn btn-modal" name="signin">Войти</button>
                                    </form>
                                    <p class="mt-3">
                                        Нет аккаунта? <a href="#" id="switchToRegisterFromLogin">Зарегистрироваться</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script src="assets/script/modal.js"></script>
                </div>
            </div>
        </section>

        <script>
            function updatePrice(basePrice, baggagePrice) {
                const isChecked = document.getElementById('flexSwitchCheckDefault').checked;
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        document.getElementById('endPrice').innerText = xhr.responseText;
                    }
                };

                xhr.send(`base_price=${basePrice}&baggage=${baggagePrice}&with_baggage=${isChecked}`);
            }
        </script>

    </body>
    </html>
    <?php
}
?>