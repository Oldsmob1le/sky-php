<?php
include ('includes/connect.php');
include ('includes/session.php');

session_start();
if (!isset($_SESSION['uid'])) {
    echo '<script>document.location.href="index.php"</script>';
    exit();
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
                    <li class="breadcrumb-item"><a href="admin_sky_25.05.php">Главная</a></li>
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
                        <th scope="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            </div>
                        </th>
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
                            <th data-label="Билет">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"
                                        name="selected_tickets[]" value="<?php echo $row['id']; ?>"
                                        id="flexCheckDefault_<?php echo $row['id']; ?>">
                                </div>
                            </th>
                            <th scope="row" data-label="ID"><?php echo $row["id"]; ?></th>
                            <td data-label="Откуда"><?php echo $row["origin"]; ?></th>
                            <td data-label="Куда"><?php echo $row["destination"]; ?></td>
                            <td data-label="Отправление"><?php echo $row["departure_time"]; ?></td>
                            <td data-label="Прибытие"><?php echo $row["arrival_time"]; ?></td>
                            <td data-label="Время полета"><?php echo $row["flight_duration"]; ?></td>
                            <td data-label="Аэропорт А"><?php echo $row["departure_airport_code"]; ?></td>
                            <td data-label="Аэропорт B"><?php echo $row["arrival_airport_code"]; ?></td>
                            <td data-label="Номер рейса"><?php echo $row["flight_number"]; ?></td>
                            <td data-label="Модель самолета"><?php echo $row["aircraft_model"]; ?></td>
                            <td data-label="Цена билета"><?php echo $row["base_price"]; ?></td>
                            <td data-label="Цена багажа"><?php echo $row["baggage"]; ?></td>
                            <td class="pt-4 pt-lg-2">
                                <div class="btn-group">
                                    <button class="btn btn-primary btn-sm dropdown-toggle " type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Изменить
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Редактировать</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="#">Удалить</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <? } ?>

                </tbody>
            </table>
            <div class="text-center mt-5 d-flex gap-2">
                <button type="button" class="btn btn-outline-danger d-none d-lg-block">Удалить</button>
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                    data-bs-target="#addFlightModal">Добавить</button>
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
                            <form id="addFlightForm">
                                <div class="mb-3">
                                    <label for="departureLocation" class="form-label">Откуда</label>
                                    <input type="text" class="form-control" id="departureLocation"
                                        name="departureLocation" required>
                                </div>
                                <div class="mb-3">
                                    <label for="arrivalLocation" class="form-label">Куда</label>
                                    <input type="text" class="form-control" id="arrivalLocation" name="arrivalLocation"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="departureTime" class="form-label">Отправление</label>
                                    <div class="input-group date" id="datetimepickerDeparture">
                                        <input type="datetime-local" placeholder="Выберите время" class="form-control"
                                            name="dateTime" />

                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="arrivalTime" class="form-label">Прибытие</label>
                                    <div class="input-group date" id="datetimepickerArrival">
                                        <input type="datetime-local" placeholder="Выберите время" class="form-control"
                                            name="dateTime" />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="flightNumber" class="form-label">Номер рейса</label>
                                    <input type="text" class="form-control" id="flightNumber" name="flightNumber"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="flightDuration" class="form-label">Время полета</label>
                                    <input type="text" class="form-control" id="flightDuration" name="flightDuration"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="departureAirportCode" class="form-label">Код Аэропорта А</label>
                                    <input type="text" class="form-control" id="departureAirportCode"
                                        name="departureAirportCode" required>
                                </div>
                                <div class="mb-3">
                                    <label for="arrivalAirportCode" class="form-label">Код Аэропорта В</label>
                                    <input type="text" class="form-control" id="arrivalAirportCode"
                                        name="arrivalAirportCode" required>
                                </div>
                                <div class="mb-3">
                                    <label for="aircraftModel" class="form-label">Модель самолета</label>
                                    <input type="text" class="form-control" id="aircraftModel" name="aircraftModel"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="basePrice" class="form-label">Цена билета</label>
                                    <input type="number" class="form-control" id="basePrice" name="basePrice" required>
                                </div>
                                <div class="mb-3">
                                    <label for="baggagePrice" class="form-label">Цена багажа</label>
                                    <input type="number" class="form-control" id="baggagePrice" name="baggagePrice"
                                        required>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-primary px-5" form="addFlightForm">Добавить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>