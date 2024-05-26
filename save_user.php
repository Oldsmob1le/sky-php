<?php
header('Content-Type: application/json');
require_once("includes/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST["action"] == "update_user") {
    $id = intval($_POST['id']);
    $field = $_POST['field'];
    $value = $_POST['value'];

    $fields = [
        'name' => 'name',
        'email' => 'email',
        'birthday' => 'birthday',
        'gender' => 'gender'
    ];

    if (array_key_exists($field, $fields)) {
        $field = $fields[$field];
        $sql = "UPDATE users SET $field = :value WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':value', $value);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Успешно.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Ошибка.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Невозможно.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Невозможно.']);
}
?>

