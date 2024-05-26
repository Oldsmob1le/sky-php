<?php
include 'includes/connect.php';

try {
    $routesQuery = $conn->query("SELECT origin, destination FROM flights");
    if (!$routesQuery) {
        throw new Exception("Ошибка выполнения запроса к базе данных: " . implode(", ", $conn->errorInfo()));
    }
    $routes = $routesQuery->fetchAll(PDO::FETCH_ASSOC);

    $cityData = [
        'routes' => $routes
    ];

    $cityDataJson = json_encode($cityData);
} catch (Exception $e) {
    echo "Произошла ошибка: " . $e->getMessage();
    exit;
}
?>

<!-- SEARCH START -->
<section class="search">
    <div class="search-bg m-4">
        <div class="container">
            <form id="search-form">
                <div class="row d-flex align-items-center justify-content-center">
                    <!-- Поле выбора города отправления -->
                    <div class="row-margin col-9 col-sm-5 col-xl">
                        <select class="form-control" id="from" name="from" required>
                            <option value="" disabled selected>Откуда</option>
                            <?php

                            $uniqueOrigins = array_unique(array_column($routes, 'origin'));
                            foreach ($uniqueOrigins as $origin): ?>
                                <option value="<?php echo htmlspecialchars($origin); ?>">
                                    <?php echo htmlspecialchars($origin); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Поле выбора города прибытия -->
                    <div class="row-margin col-9 col-sm-5 col-xl">
                        <select class="form-control" id="to" name="to" required>
                            <option value="" disabled selected>Куда</option>
                        </select>
                    </div>

                    <!-- Поле для выбора даты -->
                    <div class="row-margin col-9 col-sm-5 col-xl">
                        <input type="date" class="form-control" id="date" name="date" required
                            min="<?php echo date('Y-m-d'); ?>">
                    </div>


                    <!-- Поле для выбора количества пассажиров -->
                    <div class="row-margin col-9 col-sm-5 col-xl">
                        <input type="number" class="form-control" id="passengers" name="passengers"
                            placeholder="Пассажиры" min="1" required>
                    </div>

                    <!-- Кнопка для поиска билета -->
                    <div class="row-margin col-9 col-sm-10 col-xl text-sm-center">
                        <button type="submit" class="btn-search btn w-100" id="myButton">
                            Найти билет
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- SEARCH END -->

<div id="ticket-container">
    <?php include 'includes/ticket.php'; ?>
</div>

<script>

    const cityData = <?php echo $cityDataJson; ?>;

    const fromSelect = document.getElementById('from');
    const toSelect = document.getElementById('to');

    function updateDestinations() {
        const selectedOrigin = fromSelect.value;
        toSelect.innerHTML = '<option value="" disabled selected>Куда</option>';

        cityData.routes.forEach(route => {
            if (route.origin === selectedOrigin) {
                const option = document.createElement('option');
                option.value = route.destination;
                option.textContent = route.destination;
                toSelect.appendChild(option);
            }
        });
    }

    fromSelect.addEventListener('change', updateDestinations);

    document.getElementById('myButton').addEventListener('click', function (event) {
        event.preventDefault();

        const from = document.getElementById('from').value;
        const to = document.getElementById('to').value;
        const date = document.getElementById('date').value;
        const passengers = document.getElementById('passengers').value;

        const xhr = new XMLHttpRequest();
        xhr.open('GET', `includes/ticket.php?from=${from}&to=${to}&date=${date}&passengers=${passengers}`, true);

        xhr.onload = function () {
            if (xhr.status === 200) {
                const ticketContainer = document.getElementById('ticket-container');
                ticketContainer.innerHTML = xhr.responseText;
            } else {
                console.error('Ошибка запроса:', xhr.status, xhr.statusText);
            }
        };

        xhr.onerror = function () {
            console.error('Ошибка запроса:', xhr.status, xhr.statusText);
        };

        xhr.send();
    });
</script>