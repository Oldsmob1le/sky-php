<?php

include ('includes/connect.php');
include ('includes/session.php');

session_start();

if (!isset($_SESSION['uid'])) {
    echo '<script>document.location.href="index.php"</script>';
    exit();
}

if (isset($_POST['ticketadd'])) {
    try {
        $sql = "INSERT INTO flights (flight_number, origin, destination, departure_time, arrival_time, flight_duration, arrival_airport_code, departure_airport_code, base_price, baggage, aircraft_model) 
                VALUES (:flight_number, :origin, :destination, :departure_time, :arrival_time, :flight_duration, :arrival_airport_code, :departure_airport_code, :base_price, :baggage, :aircraft_model)";

        // Prepare and execute the statement
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':flight_number' => $_POST['flight_number'],
            ':origin' => $_POST['origin'],
            ':destination' => $_POST['destination'],
            ':departure_time' => $_POST['departure_time'],
            ':arrival_time' => $_POST['arrival_time'],
            ':flight_duration' => $_POST['flight_duration'],
            ':arrival_airport_code' => $_POST['arrival_airport_code'],
            ':departure_airport_code' => $_POST['departure_airport_code'],
            ':base_price' => $_POST['base_price'],
            ':baggage' => $_POST['baggage'],
            ':aircraft_model' => $_POST['aircraft_model']
        ]);
        echo '<script>document.location.href="?ticket"</script>';
    } catch (PDOException $e) {
        echo "Ошибка: " . $e->getMessage();
    }
}
?>

<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SkyAdmin</title>
    <link rel="shortcut icon" href="assets/image/logo.svg" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/fonts/stylesheet.css" />
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/navbar-static/" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3" />
    <link rel="stylesheet" href="assets/style/settings.css" />
    <link rel="stylesheet" href="assets/style/admin.css" />

</head>

<body>

    <?php include ('includes/admin-header.php'); ?>


    <section class="container section">
        <div class="d-none d-xl-block">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="A1D2M3I4N5.php">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Билеты</li>
                </ol>
            </nav>
        </div>

        <div class="m-4 m-lg-5 d-flex flex-column align-items-center">
            <form class="d-flex d-block d-sm-none mb-3" role="search">
                <input class="form-control" type="search" placeholder="Поиск" aria-label="Поиск">
            </form>

            <table class="table table-striped table-hover">
                <thead class="text-center">
                    <tr>
                        <th scope="col" data-label="ID">ID</th>
                        <th scope="col" data-label="Откуда">Откуда</th>
                        <th scope="col" data-label="Куда">Куда</th>
                        <th scope="col" data-label="Отправление">Отправление</th>
                        <th scope="col" data-label="Прибытие">Прибытие</th>
                        <th scope="col" data-label="Время полета">Полета</th>
                        <th scope="col" data-label="Аэропорт А">Код А</th>
                        <th scope="col" data-label="Аэропорт В">Код В</th>
                        <th scope="col" data-label="Номер рейса">Рейса</th>
                        <th scope="col" data-label="Модель самолета">Самолет</th>
                        <th scope="col" data-label="Цена билета">Цена А</th>
                        <th scope="col" data-label="Цена багажа">Цена В</th>
                        <th scope="col" data-label="Управление">Управление</th>
                    </tr>
                </thead>
                <tbody class="text-center text-lg-center">
                    <?php
                    $sql = "SELECT * FROM flights";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <th scope="row" data-label="ID"><?php echo $row["id"]; ?></th>
                            <td class="edit" data-field="origin" data-id="<?php echo $row['id']; ?>" data-label="Откуда">
                                <?php echo $row["origin"]; ?>
                            </td>
                            <td class="edit" data-field="destination" data-id="<?php echo $row['id']; ?>" data-label="Куда">
                                <?php echo $row["destination"]; ?>
                            </td>
                            <td class="edit" data-field="departure_time" data-id="<?php echo $row['id']; ?>"
                                data-label="Отправление"><?php echo $row["departure_time"]; ?></td>
                            <td class="edit" data-field="arrival_time" data-id="<?php echo $row['id']; ?>"
                                data-label="Прибытие"><?php echo $row["arrival_time"]; ?></td>
                            <td class="edit" data-field="flight_duration" data-id="<?php echo $row['id']; ?>"
                                data-label="Время полета"><?php echo $row["flight_duration"]; ?></td>
                            <td class="edit" data-field="departure_airport_code" data-id="<?php echo $row['id']; ?>"
                                data-label="Аэропорт А"><?php echo $row["departure_airport_code"]; ?></td>
                            <td class="edit" data-field="arrival_airport_code" data-id="<?php echo $row['id']; ?>"
                                data-label="Аэропорт В"><?php echo $row["arrival_airport_code"]; ?></td>
                            <td class="edit" data-field="flight_number" data-id="<?php echo $row['id']; ?>"
                                data-label="Номер рейса"><?php echo $row["flight_number"]; ?></td>
                            <td class="edit" data-field="aircraft_model" data-id="<?php echo $row['id']; ?>"
                                data-label="Модель самолета"><?php echo $row["aircraft_model"]; ?></td>
                            <td class="edit" data-field="base_price" data-id="<?php echo $row['id']; ?>"
                                data-label="Цена билета"><?php echo $row["base_price"]; ?></td>
                            <td class="edit" data-field="baggage" data-id="<?php echo $row['id']; ?>"
                                data-label="Цена багажа"><?php echo $row["baggage"]; ?></td>
                            <td class="pt-4 pt-lg-2">
                                <div class="btn-group">
                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Изменить
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><?php echo '<a class="dropdown-item delete-link" href="?delete=' . $row['id'] . '">Удалить</a>'; ?>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                            <?php
                            if (isset($_GET['delete'])) {
                                $ticket_id = $_GET['delete'];
                                if (filter_var($ticketId, FILTER_VALIDATE_INT)) {
                                    $ticketId = $conn->quote($ticketId);
                                    $query = "DELETE FROM flights WHERE id = $ticketId";
                                    $result = $conn->exec($query);
                                    if ($result !== false) {
                                        echo '<script>document.location.href="?ticket"</script>';
                                    } else {
                                        echo "Ошибка при удалении билета.";
                                    }
                                }
                            }
                            ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <div class="text-center mt-5 d-flex gap-2">

                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                    data-bs-target="#addFlightModal">Добавить билет</button>
            </div>
            <div class="modal fade" id="addFlightModal" tabindex="-1" aria-labelledby="addFlightModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addFlightModalLabel">Добавить рейс</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addFlightForm" method="post">
                                <div class="mb-3">
                                    <label for="departureLocation" class="form-label">Откуда</label>
                                    <input type="text" class="form-control" id="departureLocation" name="origin"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="arrivalLocation" class="form-label">Куда</label>
                                    <input type="text" class="form-control" id="arrivalLocation" name="destination"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="departureTime" class="form-label">Отправление</label>
                                    <div class="input-group time" id="timepickerDeparture">
                                        <input type="time" class="form-control" id="departureTime" name="departure_time"
                                            required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="arrivalTime" class="form-label">Прибытие</label>
                                    <div class="input-group time" id="timepickerArrival">
                                        <input type="time" class="form-control" id="arrivalTime" name="arrival_time"
                                            required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="flightNumber" class="form-label">Номер рейса</label>
                                    <input type="text" class="form-control" id="flightNumber" name="flight_number"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="flightDuration" class="form-label">Время полета</label>
                                    <div class="input-group time" id="timepickerDuration">
                                        <input type="time" class="form-control" id="flightDuration"
                                            name="flight_duration" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="departureAirportCode" class="form-label">Код Аэропорта А</label>
                                    <input type="text" class="form-control" id="departureAirportCode"
                                        name="departure_airport_code" required>
                                </div>
                                <div class="mb-3">
                                    <label for="arrivalAirportCode" class="form-label">Код Аэропорта В</label>
                                    <input type="text" class="form-control" id="arrivalAirportCode"
                                        name="arrival_airport_code" required>
                                </div>
                                <div class="mb-3">
                                    <label for="aircraftModel" class="form-label">Модель самолета</label>
                                    <input type="text" class="form-control" id="aircraftModel" name="aircraft_model"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="basePrice" class="form-label">Цена билета</label>
                                    <input type="number" class="form-control" id="basePrice" name="base_price" required
                                        min="0" step="0.01">
                                </div>
                                <div class="mb-3">
                                    <label for="baggagePrice" class="form-label">Цена багажа</label>
                                    <input type="number" class="form-control" id="baggagePrice" name="baggage" required
                                        min="0" step="0.01">
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="submit" class="btn btn-primary px-5"
                                        name="ticketadd">Добавить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            if (isset($_POST['ticketadd'])) {
                $flightNumber = $conn->quote($_POST['flight_number']);
                $origin = $conn->quote($_POST['origin']);
                $destination = $conn->quote($_POST['destination']);
                $departureTime = $conn->quote($_POST['departure_time']);
                $arrivalTime = $conn->quote($_POST['arrival_time']);
                $flightDuration = $conn->quote($_POST['flight_duration']);
                $arrivalAirportCode = $conn->quote($_POST['arrival_airport_code']);
                $departureAirportCode = $conn->quote($_POST['departure_airport_code']);
                $basePrice = $conn->quote($_POST['base_price']);
                $baggagePrice = $conn->quote($_POST['baggage']);
                $aircraftModel = $conn->quote($_POST['aircraft_model']);

                // SQL-запрос для вставки данных
                $sql = "INSERT INTO flights (flight_number, origin, destination, departure_time, arrival_time, flight_duration, arrival_airport_code, departure_airport_code, base_price, baggage_price, aircraft_model)
            VALUES ($flightNumber, $origin, $destination, $departureTime, $arrivalTime, $flightDuration, $arrivalAirportCode, $departureAirportCode, $basePrice, $baggagePrice, $aircraftModel)";

                try {
                    $conn->exec($sql);
                    echo '<script>document.location.href="?ticket"</script>';
                } catch (PDOException $e) {
                    echo "Ошибка: " . $e->getMessage();
                }
            }
            ?>


        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('body').on('click', 'td.edit', function () {
                var $this = $(this);
                var originalText = $this.text().trim();
                $this.addClass('ajax');
                $this.html('<input id="editbox" size="' + originalText.length + '" type="text" value="' + originalText + '" />');
                $('#editbox').focus();

                $('#editbox').on('blur', function () {
                    var newValue = $(this).val().trim();
                    if (newValue !== originalText) {
                        saveChanges($this.data('id'), $this.data('field'), newValue, $this);
                    } else {
                        $this.text(originalText);
                        $this.removeClass('ajax');
                    }
                });

                $('#editbox').on('keydown', function (event) {
                    if (event.which === 13) {
                        var newValue = $(this).val().trim();
                        if (newValue !== originalText) {
                            saveChanges($this.data('id'), $this.data('field'), newValue, $this);
                        } else {
                            $this.text(originalText);
                            $this.removeClass('ajax');
                        }
                    }
                });
            });

            function saveChanges(id, field, value, $element) {
                $.post('save_flight.php', {
                    action: "update_flight",
                    id: id,
                    field: field,
                    value: value
                }, function (data) {
                    if (data.status === 'success') {
                        $element.text(value);
                    } else {
                        alert(data.message);
                        $element.text($element.data('original-text'));
                    }
                    $element.removeClass('ajax');
                }, 'json');
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var deleteLinks = document.querySelectorAll('.delete-link');
            deleteLinks.forEach(function (link) {
                link.addEventListener('click', function (event) {
                    var confirmation = confirm("Вы уверены, что хотите удалить?");
                    if (!confirmation) {
                        event.preventDefault();
                    }
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>