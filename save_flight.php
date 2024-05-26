<?php
header('Content-Type: application/json');
require_once("includes/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST["action"] == "update_flight") {
    $id = intval($_POST['id']);
    $field = $_POST['field'];
    $value = $_POST['value'];

    $allowedFields = ['origin', 'destination', 'departure_time', 'arrival_time', 'flight_duration', 'departure_airport_code', 'arrival_airport_code', 'flight_number', 'aircraft_model', 'base_price', 'baggage'];

    if (in_array($field, $allowedFields)) {
        $sql = "UPDATE flights SET $field = :value WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':value', $value);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Flight updated successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update flight.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid field.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}
?>