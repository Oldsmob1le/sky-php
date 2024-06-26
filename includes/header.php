<?php
include 'connect.php';
session_start();

$error = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['signin'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = $conn->query("SELECT * FROM users WHERE email='$email'");
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['uid'] = $user['id'];
        } else {
            $error = 'Неверный email или пароль';
        }
    }

    if (isset($_POST['signup'])) {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $birthday = $_POST['birthday'];
        $gender = $_POST['gender'];

        if ($name === '') {
            $error .= "Введите имя! <br>";
        } else if (strlen($name) < 4) {
            $error .= "Введите корректное имя, минимум 4 символа! <br>";
        }

        if ($email === '') {
            $error .= "Введите почту! <br>";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error .= "Введите верный формат почты! <br>";
        }

        if ($password === '') {
            $error .= "Введите пароль! <br>";
        } else if (strlen($password) < 6) {
            $error .= "Пароль слишком короткий, минимум 6 символов! <br>";
        }

        if ($password !== $confirm_password) {
            $error .= "Пароли не совпадают! <br>";
        }

        if ($birthday === '') {
            $error .= "Введите дату рождения! <br>";
        } else {
            $date_regex = "/^\d{4}-\d{2}-\d{2}$/";
            if (!preg_match($date_regex, $birthday)) {
                $error .= "Введите верный формат даты рождения (YYYY-MM-DD)! <br>";
            } else if (new DateTime($birthday) > new DateTime()) {
                $error .= "Дата рождения не может быть в будущем! <br>";
            }
        }

        if ($gender !== 'Мужчина' && $gender !== 'Женщина') {
            $error .= "Выберите правильный пол! <br>";
        }

        // Уникальность
        $sql = "SELECT count(*) FROM users WHERE email = '$email'";
        $user_count = $conn->query($sql)->fetchColumn();
        if ($user_count == 1) {
            $error .= 'Данный аккаунт уже зарегистрирован!';
        }

        if (empty($error)) {
            $hash_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (`name`, `email`, `password`, `birthday`, `gender`)
                    VALUES ('$name', '$email', '$hash_password', '$birthday', '$gender')";
            $conn->query($sql);
            $user_id = $conn->lastInsertId();
            $_SESSION['uid'] = $user_id;
            header('Location: index.php');
            exit();
        }

    }
}
?>
<img src="assets/image/banner.png" class="background" alt="Background" />
<nav class="navbar navbar-expand-lg navbar-dark" aria-label="Offcanvas navbar large">
    <div class="container-xxl">
        <div class="navbar-logo">
            <a href="index.php" class="logo d-flex">
                <img src="assets/image/logo.svg" alt="Logo" />
                <p>SkyBridge</p>
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2"
            aria-controls="offcanvasNavbar2" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar2"
            aria-labelledby="offcanvasNavbar2Label">
            <div class="offcanvas-header">
                <div class="navbar-logo">
                    <a href="index.php" class="logo d-flex">
                        <img src="assets/image/logo.svg" alt="Logo" />
                        <p>SkyBridge</p>
                    </a>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-lg-5 text-center mt-3 mt-lg-0 mb-5 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Билеты</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="service.php">Услуги</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">О нас</a>
                    </li>
                    <?php if (isset($_SESSION['uid'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="account.php">Личный кабинет</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <div class="navbar-btn d-flex flex-column flex-lg-row px-5 px-lg-0">
                    <?php if (isset($_SESSION['uid'])): ?>
                        <a href="?do=exit"><button type="button" class="btn btn-outline-header">Выйти</button></a>
                    <?php else: ?>
                        <button type="button" class="btn btn-header" data-bs-toggle="modal"
                            data-bs-target="#loginModal">Войти</button>
                        <button type="button" class="btn btn-outline-header" data-bs-toggle="modal"
                            data-bs-target="#registerModal">Регистрация</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- AUTH -->
<?php if ($error): ?>
    <div id="error-container">
        <div id="error-alert" class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
    </div>
<?php endif; ?>


<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Войти в аккаунт</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="loginForm" method="POST" onsubmit="return validateLoginForm();">
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
                <div id="loginError" class="text-danger"></div>
            </div>
        </div>
    </div>
</div>

<!-- REG -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Зарегистрироваться</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registerForm" method="POST" onsubmit="return validateRegisterForm();">
                    <div class="mb-3">
                        <label for="registerName" class="form-label">ФИО:</label>
                        <input type="text" class="form-control" id="registerName" name="name" placeholder="Введите ФИО"
                            required>
                        <div id="registerNameError" class="text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="registerEmail" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="registerEmail" name="email"
                            placeholder="Введите email" required>
                        <div id="registerEmailError" class="text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="registerBirthdate" class="form-label">Дата рождения:</label>
                        <input type="date" class="form-control" id="registerBirthdate" name="birthday"
                            placeholder="Выберите дату рождения" required>
                        <div id="registerBirthdateError" class="text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="registerGender" class="form-label">Пол:</label>
                        <select class="form-select" id="registerGender" name="gender" required>
                            <option value="">Выберите пол</option>
                            <option value="Мужчина">Мужчина</option>
                            <option value="Женщина">Женщина</option>
                        </select>
                        <div id="registerGenderError" class="text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="registerPassword" class="form-label">Пароль:</label>
                        <input type="password" class="form-control" id="registerPassword" name="password"
                            placeholder="Введите пароль" required>
                        <div id="registerPasswordError" class="text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="registerConfirmPassword" class="form-label">Подтвердите пароль:</label>
                        <input type="password" class="form-control" id="registerConfirmPassword" name="confirm_password"
                            placeholder="Подтвердите пароль" required>
                        <div id="registerConfirmPasswordError" class="text-danger"></div>
                    </div>
                    <button type="submit" class="btn btn-modal" name="signup">Зарегистрироваться</button>
                </form>
                <p class="mt-3">
                    Уже есть аккаунт? <a href="#" id="switchToLoginFromRegister">Войти</a>
                </p>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $("#switchToRegisterFromLogin").click(function (event) {
            event.preventDefault();

            $('#loginModal').modal('hide');
            $('#registerModal').modal('show');
        });

        $("#switchToLoginFromRegister").click(function (event) {
            event.preventDefault();

            $('#registerModal').modal('hide');
            $('#loginModal').modal('show');
        });
    });
    function validateLoginForm() {
        var email = document.getElementById("loginEmail").value;
        var password = document.getElementById("loginPassword").value;
        var error = "";

        if (email === '') {
            error += "Введите email! <br>";
        } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
            error += "Введите верный формат email! <br>";
        }

        if (password === '') {
            error += "Введите пароль! <br>";
        }

        if (error !== "") {
            document.getElementById("loginError").innerHTML = error;
            return false;
        } else {
            document.getElementById("loginError").innerHTML = "";
            return true;
        }

    }

    function validateRegisterForm() {
        var name = document.getElementById("registerName").value;
        var email = document.getElementById("registerEmail").value;
        var birthday = document.getElementById("registerBirthdate").value;
        var gender = document.getElementById("registerGender").value;
        var password = document.getElementById("registerPassword").value;
        var confirmPassword = document.getElementById("registerConfirmPassword").value;
        var error = false;

        document.getElementById("registerNameError").innerHTML = "";
        document.getElementById("registerEmailError").innerHTML = "";
        document.getElementById("registerBirthdateError").innerHTML = "";
        document.getElementById("registerGenderError").innerHTML = "";
        document.getElementById("registerPasswordError").innerHTML = "";
        document.getElementById("registerConfirmPasswordError").innerHTML = "";

        if (name === '') {
            document.getElementById("registerNameError").innerHTML = "Введите ФИО!";
            error = true;
        } else if (name.length < 4) {
            document.getElementById("registerNameError").innerHTML = "Введите корректное ФИО, минимум 4 символа!";
            error = true;
        }

        if (email === '') {
            document.getElementById("registerEmailError").innerHTML = "Введите email!";
            error = true;
        } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
            document.getElementById("registerEmailError").innerHTML = "Введите верный формат email!";
            error = true;
        }

        if (birthday === '') {
            document.getElementById("registerBirthdateError").innerHTML = "Введите дату рождения!";
            error = true;
        } else {
            var date_regex = /^\d{4}-\d{2}-\d{2}$/;
            var today = new Date().toISOString().split('T')[0];
            if (!date_regex.test(birthday)) {
                document.getElementById("registerBirthdateError").innerHTML = "Введите верный формат даты рождения (YYYY-MM-DD)!";
                error = true;
            } else if (birthday > today) {
                document.getElementById("registerBirthdateError").innerHTML = "Дата рождения не может быть в будущем!";
                error = true;
            }
        }

        if (gender === '') {
            document.getElementById("registerGenderError").innerHTML = "Выберите пол!";
            error = true;
        }

        if (password === '') {
            document.getElementById("registerPasswordError").innerHTML = "Введите пароль!";
            error = true;
        } else if (password.length < 6) {
            document.getElementById("registerPasswordError").innerHTML = "Пароль слишком короткий, минимум 6 символов!";
            error = true;
        }

        if (confirmPassword === '') {
            document.getElementById("registerConfirmPasswordError").innerHTML = "Подтвердите пароль!";
            error = true;
        } else if (password !== confirmPassword) {
            document.getElementById("registerConfirmPasswordError").innerHTML = "Пароли не совпадают!";
            error = true;
        }

        return !error;
    }

    // Установить максимальную дату для даты рождения
    document.addEventListener('DOMContentLoaded', function () {
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('registerBirthdate').setAttribute('max', today);
    });
</script>


<script>
    setTimeout(function () {
        var errorAlert = document.querySelector('.alert');
        if (errorAlert) {
            errorAlert.classList.add('fade-out');
            setTimeout(function () {
                errorAlert.remove();
            }, 500);
        }
    }, 1800);
</script>