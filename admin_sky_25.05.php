<?php
session_start();
if (!isset($_SESSION['uid'])) {
  echo '<script>document.location.href="index.php"</script>';
  exit();
}

include ('includes/connect.php'); 
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


  <?php include('includes/admin-header.php'); ?>


    <section class="container section">

        <h2 class="text-center my-5">График продаж по месяцам</h2>

    <div class="d-flex justify-content-center ">
        <canvas id="myChart"></canvas>
      </div>
      
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      
      <script>
        const ctx = document.getElementById('myChart');
      
        new Chart(ctx, {
          type: 'bar',
          data: {
            labels: ['Декабрь', 'Январь', 'Февраль', 'Март', 'Апрель', 'Май'],
            datasets: [{
              label: 'Продажи билетов',
              data: [33, 52, 81, 107, 191, 32],
              borderWidth: 1,
              borderColor: '#65C9CE',
              backgroundColor: '#65C1CE'
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
      </script>

    </section>

    <section class="container section">
        <div class="row mx-3 mb-3">
            <div class="col-sm mb-3 mb-sm-0">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Билеты</h5>
                  <p class="card-text">Редактирование и добавление билетов для различных событий. Управляйте ценами, категориями и доступностью билетов.</p>
                  <a href="ticket.php" class="btn btn-primary">Перейти</a>
                </div>
              </div>
            </div>
            <div class="col-sm">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Пользователи</h5>
                  <p class="card-text">Администрирование над пользователями. Создавайте, редактируйте и удаляйте учетные записи пользователей, а также управляйте правами доступа.</p>
                  <a href="user.php" class="btn btn-primary">Перейти</a>
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