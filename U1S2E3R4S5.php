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
                    <li class="breadcrumb-item"><a href="A1D2M3I4N5.php">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Пользователи</li>
                </ol>
            </nav>
        </div>
        <div class="m-4 d-flex flex-column align-items-center">
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
                        <th scope="col" data-label="uID">uID</th>
                        <th scope="col" data-label="ФИО">ФИО</th>
                        <th scope="col" data-label="E-mail">E-mail</th>
                        <th scope="col" data-label="Дата рождения">Дата рождения</th>
                        <th scope="col" data-label="Пол">Пол</th>
                        <th scope="col" data-label="Роль">Роль</th>
                        <th scope="col" data-label="Управление">Управление</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php
                    $sql = "SELECT * FROM users";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <th data-label="Пользователь">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="selected_users[]"
                                        value="<?php echo $row['id']; ?>" id="flexCheckDefault_<?php echo $row['id']; ?>">
                                </div>
                            </th>
                            <th scope="row" data-label="uID"><?php echo $row["id"]; ?></th>
                            <td class="edit" data-field="name" data-id="<?php echo $row['id']; ?>" data-label="ФИО">
                                <?php echo $row["name"]; ?>
                            </td>
                            <td class="edit" data-field="email" data-id="<?php echo $row['id']; ?>" data-label="E-mail">
                                <?php echo $row["email"]; ?>
                            </td>
                            <td class="edit" data-field="birthday" data-id="<?php echo $row['id']; ?>"
                                data-label="Дата рождения"><?php echo date("d.m.Y", strtotime($row["birthday"])); ?></td>
                            <td class="edit" data-field="gender" data-id="<?php echo $row['id']; ?>" data-label="Пол">
                                <?php echo $row["gender"]; ?>
                            </td>
                            <td class="edit">
                                <span class="badge <?php echo getRoleClass($row['role']); ?>">
                                    <?php echo getRoleName($row['role']); ?>
                                </span>
                            </td>
                            <td class="pt-4 pt-lg-2">
                                <div class="btn-group">
                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Изменить
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="?promote=<?php echo $row['id']; ?>">Повысить</a>
                                        </li>
                                        <li><a class="dropdown-item" href="?demote=<?php echo $row['id']; ?>">Понизить</a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item delete-link"
                                                href="?delete=<?php echo $row['id']; ?>">Удалить</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <?php
            function getRoleClass($role)
            {
                switch ($role) {
                    case 1:
                        return 'text-bg-primary';
                    case 2:
                        return 'text-bg-danger';
                    case 0:
                        return 'text-bg-secondary';
                    default:
                        return '';
                }
            }

            function getRoleName($role)
            {
                switch ($role) {
                    case 1:
                        return 'Пользователь';
                    case 2:
                        return 'Администратор';
                    case 0:
                        return 'Заблокирован';
                    default:
                        return 'Неизвестная роль';
                }
            }
            ?>

            <?php
            if (isset($_GET['demote'])) {
                $demote_id = $_GET['demote'];

                $query = "SELECT role FROM users WHERE id='$demote_id'";
                $result = $conn->query($query);

                if ($result) {
                    $row = $result->fetch(PDO::FETCH_ASSOC);
                    $current_role = $row['role'];

                    if ($current_role == 2) {
                        $new_role = 1;
                    } elseif ($current_role == 1) {
                        $new_role = 0;
                    }

                    $update_query = "UPDATE users SET role='$new_role' WHERE id='$demote_id'";
                    $conn->query($update_query);
                    echo '<script>document.location.href="?user"</script>';
                }
            }

            if (isset($_GET['promote'])) {
                $promote_id = $_GET['promote'];

                $query = "SELECT role FROM users WHERE id='$promote_id'";
                $result = $conn->query($query);

                if ($result) {
                    $row = $result->fetch(PDO::FETCH_ASSOC);
                    $current_role = $row['role'];

                    if ($current_role == 0) {
                        $new_role = 1;
                    } elseif ($current_role == 1) {
                        $new_role = 2;
                    }
                    $update_query = "UPDATE users SET role='$new_role' WHERE id='$promote_id'";
                    $conn->query($update_query);

                    echo '<script>document.location.href="?user"</script>';
                }
            }

            if (isset($_GET['delete'])) {
                $user_id = $_GET['delete'];
                if (filter_var($user_id, FILTER_VALIDATE_INT)) {

                    $user_id = $conn->quote($user_id);

                    $query = "DELETE FROM users WHERE id = $user_id";

                    $result = $conn->exec($query);

                    if ($result !== false) {
                        echo '<script>document.location.href="?user"</script>';
                    } else {
                        echo "Ошибка при удалении пользователя.";
                    }
                }
            }
            ?>


            <div class="text-center mt-5 d-flex gap-4">
                <button type="submit" class="btn btn-outline-danger d-none d-lg-block" name="delete[]"
                    id="deleteUserBtn">Удалить пользователя</button>
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                    data-bs-target="#addUserModal">Добавить пользователя</button>
            </div>

            <?php
            // Удаление
            if (isset($_GET['delete'])) {
                $userIds = $_GET['delete'];
                if (!is_array($userIds)) {
                    $userIds = array($userIds);
                }
                foreach ($userIds as $userId) {
                    if (filter_var($userId, FILTER_VALIDATE_INT)) {
                        $userId = $conn->quote($userId);
                        $query = "DELETE FROM users WHERE id = $userId";
                        $result = $conn->exec($query);

                        if ($result === false) {
                            echo "Ошибка при удалении пользователя.";
                        }
                    }
                }
                echo '<script>document.location.href="?user"</script>';
            }
            ?>

            <!-- Добавление -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addUserModalLabel">Добавить пользователя</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addUserForm" method="POST">
                                <input type="hidden" id="edit_user_id" name="edit_user_id" value="">

                                <div class="mb-3">
                                    <label for="name" class="form-label">ФИО</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="birthday" class="form-label">Дата рождения</label>
                                    <input type="date" class="form-control" id="birthday" name="birthday" required>
                                </div>
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Пол</label>
                                    <select class="form-select" id="gender" name="gender" required>
                                        <option value="">Выберите пол</option>
                                        <option value="Мужчина">Мужчина</option>
                                        <option value="Женщина">Женщина</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Пароль</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="submit" class="btn btn-primary px-5" name="useradd">Добавить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <?php
        if (isset($_POST['useradd'])) {

            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $birthday = $_POST['birthday'];
            $gender = $_POST['gender'];

            $hash_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (`name`, `email`, `password`, `birthday`, `gender`)
            VALUES ('$name', '$email', '$hash_password', '$birthday', '$gender')";
            $result = $conn->query($sql);
            echo '<script>document.location.href="?user"</script>';
        }
        ?>

    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('body').on('click', 'td.edit', function () {
                $('.ajax').html($('.ajax input').val());
                $('.ajax').removeClass('ajax');
                $(this).addClass('ajax');
                var originalText = $(this).text().trim();
                $(this).html('<input id="editbox" size="' + originalText.length + '" type="text" value="' + originalText + '" />');
                $('#editbox').focus();
            });

            $('body').on('keydown', 'td.edit', function (event) {
                if (event.which == 13) {
                    var field = $(this).data('field');
                    var id = $(this).closest('tr').find('th[scope="row"]').text();
                    var value = $('#editbox').val().trim();

                    $.post('save_user.php', {
                        action: "update_user",
                        field: field,
                        id: id,
                        value: value
                    }, function (data) {
                        if (data.status === 'success') {
                            $('.ajax').html(value);
                        } else {
                            alert(data.message);
                            $('.ajax').html($('.ajax input').val());
                        }
                        $('.ajax').removeClass('ajax');
                    }, 'json');
                }
            });
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

        document.addEventListener("DOMContentLoaded", function () {
            const deleteUserBtn = document.querySelector("#deleteUserBtn");
            if (deleteUserBtn) {
                deleteUserBtn.addEventListener("click", function () {
                    const selectedUsers = document.querySelectorAll("input[name='selected_users[]']:checked");
                    const userIds = Array.from(selectedUsers).map(user => user.value);

                    if (userIds.length === 0) {
                        alert("Выберите пользователей для удаления.");
                        return;
                    }
                    const queryString = userIds.map(id => `delete[]=${id}`).join("&");

                    window.location.href = `?${queryString}`;
                });
            }
        });

    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>