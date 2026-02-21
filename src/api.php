<?php
require_once "db.php";
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$action = $_GET['action'] ?? '';

switch($action) {

    case 'login':
        $email = $input['email'] ?? '';
        $password = $input['password'] ?? '';
        
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        
        if ($result && password_verify($password, $result['password'])) {
            echo json_encode(['success' => true, 'user' => [
                'id' => $result['id'],
                'name' => $result['name'],
                'email' => $result['email'],
                'role' => $result['role']
            ], 'session_token' => bin2hex(random_bytes(32))]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Invalid email or password']);
        }
        break;

    case 'signup':
        $name = $input['name'] ?? '';
        $email = $input['email'] ?? '';
        $phone = $input['phone'] ?? '';
        $password = password_hash($input['password'] ?? '', PASSWORD_DEFAULT);
        
        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        if ($check->get_result()->num_rows > 0) {
            echo json_encode(['success' => false, 'error' => 'Email already exists']);
            break;
        }
        
        $stmt = $conn->prepare("INSERT INTO users (name, email, phone, password, role) VALUES (?, ?, ?, ?, 'customer')");
        $stmt->bind_param("ssss", $name, $email, $phone, $password);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'user' => [
                'id' => $conn->insert_id,
                'name' => $name,
                'email' => $email,
                'role' => 'customer'
            ], 'session_token' => bin2hex(random_bytes(32))]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Signup failed']);
        }
        break;

    case 'seller_login':
        $code = $input['code'] ?? '';
        if ($code === 'SELL2024') {
            echo json_encode(['success' => true, 'seller' => [
                'name' => $input['name'],
                'email' => $input['email'],
                'role' => 'seller'
            ]]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Invalid seller code']);
        }
        break;

    case 'dealer_login':
        $code = $input['code'] ?? '';
        if ($code === 'PTH2024') {
            echo json_encode(['success' => true, 'dealer' => [
                'name' => $input['name'],
                'email' => $input['email'],
                'role' => 'dealer'
            ]]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Invalid dealer code']);
        }
        break;

    case 'logout':
        echo json_encode(['success' => true]);
        break;

    default:
        echo json_encode(['success' => false, 'error' => 'Invalid action']);
}
?>