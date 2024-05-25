<?php include 'includes/connect.php'; ?>
<?php include 'includes/session.php'; ?>


<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>SkyBridge</title>
  <meta name="description" content="Sky Bridge - 
  Онлайн сервис по покупке и поиску авиабилетов." />
  <meta name="robots" content="index, follow">
  <meta name="keywords" content="SkyBridge, Sky Bridge, Авиабилеты, Отпуск, Билеты, самолет">
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
  <link rel="canonical" href="URL" />

</head>

<body>
  <!-- HEADER START -->

  <?php include('includes/header.php'); ?>

  <!-- HEADER END -->

  <!-- SEARCH START -->

  <?php include('search.php'); ?>

  <!-- SEACRH END -->


  <!-- POPULAR START -->

  <section class="popular container-xxl d-flex flex-column" data-aos="fade-up" data-aos-duration="600">
    <h2 class="ms-4 ps-4">Популярные маршруты</h2>
    <div class="popular-bg m-4 d-flex flex-column flex-md-row justify-content-center ">
      <a href="#">
        <div class="popular-block position-relative col">
          <img src="assets/image/popular-1.png" alt="Popular" />
          <div class="popular-style position-absolute">
            <div class="popular-text d-flex align-items-center justify-content-center">
              <img src="assets/image/Vector.svg" alt="Vector" />
              <p>Стамбул от 8 600 ₽</p>
            </div>
          </div>
        </div>
      </a>
      <a href="#">
        <div class="popular-block position-relative col">
          <img src="assets/image/popular-2.png" alt="Popular" />
          <div class="popular-style position-absolute">
            <div class="popular-text d-flex align-items-center justify-content-center">
              <img src="assets/image/Vector.svg" alt="Vector" />
              <p>Турция от 7 800 ₽</p>
            </div>
          </div>
        </div>
      </a>
    </div>
  </section>

  <!-- POPULAR END -->


  <!-- ADVICE START -->

  <div class="advice container-xxl" data-aos="fade-up" data-aos-duration="500">
    <div class="advice-bg m-4">
      <div class="calendar">
        <img src="assets/image/advice/cal.svg" alt="">
      </div>
      <div class="advice-main row d-flex justify-content-center">
        <div class="advice-text col-md-5 d-flex flex-column align-items-center d-md-block">
          <h2 class="text-center text-md-start">Куда улететь на выходные</h2>
          <p class="text-center text-md-start">
            Билеты для тех, кто не хочет на дачу: удобный вылет и короткие
            пересадки.
          </p>
          <a href="#" class="text-decoration-none">
            <button type="button" class="btn d-none d-md-block btn-main" id="myButton">
              Выбрать город
            </button>
          </a>
        </div>

        <div class="advice-content col-md-6 d-flex align-items-center justify-content-center">
          <div class="advice-content__bg d-none d-sm-flex align-items-center justify-content-center">
            <div class="advice-content__img">
              <img src="assets/image/advice/photo.png" alt="Photo" />
            </div>
            <div class="advice-content__text d-flex flex-column">
              <h3>21 385 ₽</h3>
              <h4>Казань - Нижний Новгород</h4>
              <p>2 марта, сб - 3 марта, вс</p>
            </div>
          </div>
        </div>
        <a href="#" class="text-decoration-none d-flex justify-content-center">
          <button type="button" class="btn d-block d-md-none btn-main mt-3 mt-md-2 w-sm-50" id="myButton">
            Выбрать город
          </button>
        </a>
      </div>
    </div>
  </div>


  <!-- ADVICE END -->

  <!-- RECENT START -->


  <section class="recent container-xxl" data-aos="fade-up" data-aos-duration="500">
    <div class="recent-bg m-4">
      <h2>Ваш первый раз</h2>
      <div class="recent-items d-flex align-items-center row">
        <div class="recent-item mb-4 col d-flex flex-column align-items-center d-lg-block">
          <img src="assets/image/recent/dubai.png" class="recent-image" alt="Dubai">
          <p class="r-item text-center text-sm-start">Прыгнуть с парашютом</p>
          <p><span>Дубай</span></p>
          <p>
            <img src="assets/image/Vector-white.svg" alt="Plane">
            от 14 977 ₽
          </p>
        </div>
        <div class="recent-item mb-4 col d-flex flex-column align-items-center d-lg-block">
          <img src="assets/image/recent/osetia.png" class="recent-image" alt="Osetia">
          <p class="r-item text-center text-sm-start">Посмотреть на горы</p>
          <p><span>Северная Осетия</span></p>
          <p>
            <img src="assets/image/Vector-white.svg" alt="Plane">
            от 6 800 ₽
          </p>
        </div>
        <div class="recent-item mb-4 col d-flex flex-column align-items-center d-lg-block">
          <img src="assets/image/recent/sea.png" class="recent-image" alt="Sea">
          <p class="r-item text-center text-sm-start">Поплавать на каноэ</p>
          <p><span>Пхукет</span></p>
          <p>
            <img src="assets/image/Vector-white.svg" alt="Plane">
            от 34 799 ₽
          </p>
        </div>
        <div class="recent-item col d-flex flex-column align-items-center d-lg-block">
          <img src="assets/image/recent/cold.png" class="recent-image" alt="Cold">
          <p class="r-item text-center text-sm-start">Посмотреть на китов</p>
          <p><span>Мурманск</span></p>
          <p>
            <img src="assets/image/Vector-white.svg" alt="Plane">
            от 5 999 ₽
          </p>
        </div>
      </div>
      <div class="recent-button d-flex justify-content-center">
        <a href="#">
          <button type="button" class="btn btn-main">
            Выбрать город
          </button>
        </a>
      </div>
  </section>

  <!-- RECENT END -->

  <!-- FOOTER START -->

  <footer class="container">
    <a href="#">
      <p class="m-4">© 2024 Abdulin Nikita <br>
        Все права защищены</p>
    </a>
  </footer>

  <!-- FOOTER END -->

  <!-- JAVASCRIPT -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>

  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>