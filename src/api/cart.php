<?php
header("Content-Type: application/json");
include "../config/db.php"; // your DB connection file

$action = $_GET['action'] ?? '';

if (!$action) {
    echo json_encode(["error" => "No action provided"]);
    exit;
}

switch ($action) {

    case "add":
        $user_id = $_POST['user_id'];
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        // Check if already in cart
        $check = $conn->prepare("SELECT id FROM cart WHERE user_id=? AND product_id=?");
        $check->bind_param("ii", $user_id, $product_id);
        $check->execute();
        $res = $check->get_result();

        if ($res->num_rows > 0) {
            $conn->query("UPDATE cart SET quantity = quantity + $quantity WHERE user_id=$user_id AND product_id=$product_id");
        } else {
            $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?,?,?)");
            $stmt->bind_param("iii", $user_id, $product_id, $quantity);
            $stmt->execute();
        }

        echo json_encode(["success" => true]);
        break;

    case "get":
        $user_id = $_GET['user_id'];

        $sql = "SELECT c.id, p.name, p.price, c.quantity 
                FROM cart c 
                JOIN products p ON c.product_id = p.id
                WHERE c.user_id = $user_id";

        $result = $conn->query($sql);
        $cart = [];

        while ($row = $result->fetch_assoc()) {
            $cart[] = $row;
        }

        echo json_encode($cart);
        break;

    case "remove":
        $id = $_POST['id'];
        $conn->query("DELETE FROM cart WHERE id=$id");
        echo json_encode(["deleted" => true]);
        break;

    case "update":
        $id = $_POST['id'];
        $qty = $_POST['quantity'];
        $conn->query("UPDATE cart SET quantity=$qty WHERE id=$id");
        echo json_encode(["updated" => true]);
        break;

    default:
        echo json_encode(["error" => "Invalid action"]);
}
?>

