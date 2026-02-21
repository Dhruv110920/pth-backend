<?php
require_once "../db.php";
header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

// ============================================================
// GET ALL ORDERS (seller dashboard)
// ============================================================
if ($action === 'get_orders') {

    $result = $conn->query("SELECT * FROM orders ORDER BY order_date DESC");
    $orders = [];

    while ($row = $result->fetch_assoc()) {

        // Safe JSON decode (prevents PHP 8+ warnings)
        $row['items'] = !empty($row['items']) ? json_decode($row['items'], true) : [];

        $orders[] = $row;
    }

    echo json_encode([
        'success' => true,
        'orders'  => $orders
    ]);
    exit;
}

// ============================================================
// SAVE ORDER (from checkout page)
// ============================================================
if ($action === 'save_order') {

    $data = json_decode(file_get_contents("php://input"), true);

    if (!$data) {
        echo json_encode(['success'=>false,'error'=>'Invalid JSON']);
        exit;
    }

    $stmt = $conn->prepare("
        INSERT INTO orders 
        (order_id, customer_name, customer_email, customer_phone, customer_address,
         customer_pincode, items, subtotal, shipping, total, payment_method, otp,
         status, tracking_status)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,'New','Processing')
        ON DUPLICATE KEY UPDATE order_id = order_id
    ");

    $items_json = json_encode($data['items'] ?? []);

    $stmt->bind_param(
        "sssssssdddss",
        $data['order_id'],
        $data['customer_name'],
        $data['customer_email'],
        $data['customer_phone'],
        $data['customer_address'],
        $data['customer_pincode'],
        $items_json,
        $data['subtotal'],
        $data['shipping'],
        $data['total'],
        $data['payment_method'],
        $data['otp']
    );

    if (!$stmt->execute()) {
        http_response_code(500);
        echo json_encode(['success'=>false,'error'=>$stmt->error]);
        exit;
    }

    echo json_encode(['success'=>true]);
    exit;
}

// ============================================================
// UPDATE ORDER STATUS
// ============================================================
if ($action === 'update_status') {

    $data = json_decode(file_get_contents("php://input"), true);

    $stmt = $conn->prepare("
        UPDATE orders 
        SET status=?, tracking_status=? 
        WHERE order_id=?
    ");

    $stmt->bind_param(
        "sss",
        $data['status'],
        $data['tracking_status'],
        $data['order_id']
    );

    if (!$stmt->execute()) {
        http_response_code(500);
        echo json_encode(['success'=>false,'error'=>$stmt->error]);
        exit;
    }

    echo json_encode(['success'=>true]);
    exit;
}

// ============================================================
// UPDATE DELIVERY INFO
// ============================================================
if ($action === 'update_delivery') {

    $data = json_decode(file_get_contents("php://input"), true);

    $stmt = $conn->prepare("
        UPDATE orders 
        SET delivery_person=?, delivery_date=?, delivery_pattern=? 
        WHERE order_id=?
    ");

    $stmt->bind_param(
        "ssss",
        $data['delivery_person'],
        $data['delivery_date'],
        $data['delivery_pattern'],
        $data['order_id']
    );

    if (!$stmt->execute()) {
        http_response_code(500);
        echo json_encode(['success'=>false,'error'=>$stmt->error]);
        exit;
    }

    echo json_encode(['success'=>true]);
    exit;
}

// ============================================================
// GET CUSTOMER ORDERS (myorders.php)
// ============================================================
if ($action === 'get_customer_orders') {

    $email = $_GET['email'] ?? '';

    if (!$email) {
        echo json_encode(['success'=>false,'error'=>'Email required']);
        exit;
    }

    $stmt = $conn->prepare("
        SELECT * FROM orders 
        WHERE customer_email=? 
        ORDER BY order_date DESC
    ");

    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $orders = [];

    while ($row = $result->fetch_assoc()) {

        $row['items'] = !empty($row['items']) ? json_decode($row['items'], true) : [];

        $orders[] = $row;
    }

    echo json_encode([
        'success'=>true,
        'orders'=>$orders
    ]);
    exit;
}

// ============================================================
// GET PAST ORDERS (completed only)
// ============================================================
if ($action === 'get_past_orders') {

    $email = $_GET['email'] ?? '';

    if (!$email) {
        echo json_encode(['success'=>false,'error'=>'Email required']);
        exit;
    }

    $stmt = $conn->prepare("
        SELECT * FROM orders 
        WHERE customer_email=? AND status='Completed' 
        ORDER BY updated_at DESC
    ");

    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $orders = [];

    while ($row = $result->fetch_assoc()) {

        $row['items'] = !empty($row['items']) ? json_decode($row['items'], true) : [];

        $orders[] = $row;
    }

    echo json_encode([
        'success'=>true,
        'orders'=>$orders
    ]);
    exit;
}

// ============================================================
// CANCEL ORDER
// ============================================================
if ($action === 'cancel_order') {

    $data = json_decode(file_get_contents("php://input"), true);

    $stmt = $conn->prepare("
        UPDATE orders 
        SET status='Cancelled', tracking_status='Cancelled' 
        WHERE order_id=?
    ");

    $stmt->bind_param("s", $data['order_id']);

    if (!$stmt->execute()) {
        http_response_code(500);
        echo json_encode(['success'=>false,'error'=>$stmt->error]);
        exit;
    }

    echo json_encode(['success'=>true]);
    exit;
}

// ============================================================
// INVALID ACTION
// ============================================================
echo json_encode([
    'success'=>false,
    'error'=>'Invalid action'
]);
?>