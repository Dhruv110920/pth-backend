<?php
require_once "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Arial', sans-serif;
            background-color: white;
            color: #333;
            line-height: 1.6;
        }

        .header {
            background: linear-gradient(135deg, #dc3545, #a71e2a);
            color: white;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(220, 53, 69, 0.3);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }
        .header h1 { font-size: 28px; font-weight: 300; }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 10px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }
        .mobile-menu-btn:hover { background: rgba(255,255,255,0.1); }

        .user-menu { position: relative; }
        .user-dropdown {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            padding: 10px 20px;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .user-dropdown:hover { background: rgba(255,255,255,0.2); transform: translateY(-2px); }
        .user-dropdown i { font-size: 18px; }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background: white;
            min-width: 200px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            border-radius: 10px;
            z-index: 1000;
            margin-top: 10px;
            overflow: hidden;
        }
        .dropdown-content.show { display: block; animation: fadeIn 0.3s ease; }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .dropdown-item {
            padding: 15px 20px;
            cursor: pointer;
            transition: background 0.3s ease;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #333;
        }
        .dropdown-item:hover { background: #f8f9fa; }
        .dropdown-item:last-child { border-bottom: none; }
        .dropdown-item.logout { color: #dc3545; }
        .dropdown-item.logout:hover { background: #f8d7da; }

        .container {
            display: flex;
            min-height: calc(100vh - 88px);
            position: relative;
        }

        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #dc3545, #a71e2a);
            color: white;
            padding: 30px 0;
            box-shadow: 2px 0 15px rgba(220,53,69,0.2);
            transition: transform 0.3s ease;
        }
        .sidebar h2 {
            padding: 0 30px 20px;
            font-size: 22px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            margin-bottom: 20px;
        }
        .sidebar-item {
            padding: 18px 30px;
            cursor: pointer;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .sidebar-item:hover {
            background: rgba(255,255,255,0.1);
            border-left-color: white;
            transform: translateX(5px);
        }
        .sidebar-item.active {
            background: rgba(255,255,255,0.2);
            border-left-color: white;
        }
        .sidebar-item i { font-size: 18px; width: 20px; }

        .main-content { flex: 1; padding: 30px; background: white; }

        .dashboard-header { margin-bottom: 30px; }
        .dashboard-title { font-size: 32px; color: #dc3545; margin-bottom: 10px; }
        .dashboard-subtitle { color: #666; font-size: 18px; }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: linear-gradient(135deg, #dc3545, #a71e2a);
            color: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(220,53,69,0.3);
            transition: transform 0.3s ease;
        }
        .stat-card:hover { transform: translateY(-5px); }
        .stat-card h3 { font-size: 18px; margin-bottom: 10px; opacity: 0.9; }
        .stat-card .number { font-size: 36px; font-weight: bold; margin-bottom: 5px; }
        .stat-card .change { font-size: 14px; opacity: 0.8; }

        .content-section { display: none; animation: fadeIn 0.5s ease; }
        .content-section.active { display: block; }

        .section-title {
            font-size: 24px;
            color: #dc3545;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #dc3545;
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .orders-table th {
            background: #dc3545;
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }
        .orders-table td {
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: top;
        }
        .orders-table tbody tr:hover { background: #f8f9fa; }

        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .status-new        { background: #ffc107; color: #856404; }
        .status-processing { background: #17a2b8; color: white; }
        .status-completed  { background: #28a745; color: white; }
        .status-cancelled  { background: #6c757d; color: white; }

        .empty-state { text-align: center; padding: 60px 20px; color: #666; }
        .empty-state i { font-size: 64px; color: #dc3545; margin-bottom: 20px; display: block; }
        .empty-state h3 { font-size: 24px; margin-bottom: 10px; }

        .order-items-list { font-size: 12px; margin-top: 4px; }
        .order-items-list div { padding: 2px 0; color: #555; }

        .otp-display {
            background: #fff3cd;
            color: #856404;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
            font-family: monospace;
            display: inline-block;
        }

        .delivery-section { margin-top: 8px; }
        .delivery-select {
            padding: 5px 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 12px;
            margin-bottom: 5px;
            width: 100%;
        }
        .delivery-pattern {
            font-size: 11px;
            color: #666;
            background: #e9ecef;
            padding: 3px 6px;
            border-radius: 3px;
            margin-top: 3px;
        }
        .delivery-person-input {
            padding: 5px 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 12px;
            margin-bottom: 5px;
            width: 100%;
        }

        .view-details-btn {
            background: #dc3545; color: white; border: none;
            padding: 5px 10px; border-radius: 5px; cursor: pointer;
            font-size: 12px; transition: background 0.3s ease; margin: 2px;
        }
        .view-details-btn:hover { background: #c82333; }

        .set-delivery-btn {
            background: #007bff; color: white; border: none;
            padding: 5px 10px; border-radius: 5px; cursor: pointer;
            font-size: 12px; transition: background 0.3s ease; margin: 2px;
        }
        .set-delivery-btn:hover { background: #0056b3; }

        .otp-input {
            padding: 5px 8px; border: 1px solid #ddd; border-radius: 5px;
            font-size: 12px; margin-bottom: 5px; width: 80px;
        }

        .verify-otp-btn {
            background: #28a745; color: white; border: none;
            padding: 5px 10px; border-radius: 5px; cursor: pointer;
            font-size: 12px; transition: background 0.3s ease; margin: 2px;
        }
        .verify-otp-btn:hover { background: #218838; }

        .cancel-btn {
            background: #6c757d; color: white; border: none;
            padding: 5px 10px; border-radius: 5px; cursor: pointer;
            font-size: 12px; margin: 2px;
        }
        .cancel-btn:hover { background: #5a6268; }

        .mark-processing-btn {
            background: #17a2b8; color: white; border: none;
            padding: 5px 10px; border-radius: 5px; cursor: pointer;
            font-size: 12px; margin: 2px;
        }
        .mark-processing-btn:hover { background: #138496; }

        .refresh-btn {
            background: #28a745; color: white; border: none;
            padding: 10px 20px; border-radius: 5px; cursor: pointer;
            margin-bottom: 20px; display: flex; align-items: center;
            gap: 8px; transition: background 0.3s ease;
        }
        .refresh-btn:hover { background: #218838; }
        .refresh-btn i { font-size: 14px; }

        .modal-overlay {
            display: none; position: fixed; top: 0; left: 0;
            width: 100%; height: 100%; background: rgba(0,0,0,0.5);
            z-index: 2000; justify-content: center; align-items: center;
        }
        .modal-overlay.show { display: flex; }
        .modal-box {
            background: white; border-radius: 15px; padding: 30px;
            max-width: 600px; width: 90%; max-height: 80vh;
            overflow-y: auto; animation: fadeIn 0.3s ease;
        }
        .modal-box h3 { color: #dc3545; margin-bottom: 20px; font-size: 20px; }
        .modal-close {
            float: right; background: none; border: none;
            font-size: 28px; cursor: pointer; color: #aaa; line-height: 1;
        }
        .modal-close:hover { color: #dc3545; }
        .detail-row {
            display: flex; justify-content: space-between;
            padding: 8px 0; border-bottom: 1px solid #f0f0f0; font-size: 14px;
        }
        .detail-row:last-child { border-bottom: none; }
        .detail-label { font-weight: 600; color: #555; }
        .detail-value { color: #333; text-align: right; }
        .modal-items-title { font-weight: 600; color: #dc3545; margin: 15px 0 10px; }
        .modal-item {
            background: #f8f9fa; padding: 10px; border-radius: 8px;
            margin-bottom: 8px; font-size: 13px;
        }

        .mobile-overlay {
            display: none; position: fixed; top: 0; left: 0;
            width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 998;
        }
        .mobile-overlay.show { display: block; }

        @media (max-width: 768px) {
            .header h1 { font-size: 20px; }
            .mobile-menu-btn { display: block; order: -1; }
            .user-dropdown { padding: 8px 15px; }
            .user-dropdown span { display: none; }
            .sidebar {
                position: fixed; top: 0; left: 0; height: 100vh;
                z-index: 999; transform: translateX(-100%); width: 280px;
            }
            .sidebar.mobile-open { transform: translateX(0); }
            .sidebar h2 { margin-top: 80px; }
            .main-content { padding: 20px; width: 100%; }
            .stats-grid { grid-template-columns: 1fr; }
            .dashboard-title { font-size: 24px; }
            .orders-table { font-size: 14px; }
            .orders-table th, .orders-table td { padding: 10px 8px; }
            .orders-table th:nth-child(n+5),
            .orders-table td:nth-child(n+5) { display: none; }
        }

        @media (max-width: 480px) {
            .header { padding: 15px; }
            .header h1 { font-size: 18px; }
            .main-content { padding: 15px; }
            .stat-card .number { font-size: 28px; }
            .dashboard-title { font-size: 20px; }
            .section-title { font-size: 20px; }
        }
    </style>
</head>
<body>

    <div class="mobile-overlay" id="mobileOverlay" onclick="closeMobileSidebar()"></div>

    <div class="modal-overlay" id="orderModal">
        <div class="modal-box">
            <button class="modal-close" onclick="closeModal()">×</button>
            <h3>Order Details</h3>
            <div id="modalContent"></div>
        </div>
    </div>

    <div class="header">
        <button class="mobile-menu-btn" onclick="toggleMobileSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <h1>Seller Dashboard</h1>
        <div class="user-menu">
            <div class="user-dropdown" onclick="toggleDropdown()">
                <i class="fas fa-user-circle"></i>
                <span id="sellerName">Hi Seller</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="dropdown-content" id="userDropdown">
                <div class="dropdown-item" onclick="viewProfile()"><i class="fas fa-user"></i><span>Profile</span></div>
                <div class="dropdown-item" onclick="settings()"><i class="fas fa-cog"></i><span>Settings</span></div>
                <div class="dropdown-item logout" onclick="logout()"><i class="fas fa-sign-out-alt"></i><span>Logout</span></div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="sidebar" id="sidebar">
            <h2>Orders</h2>
            <div class="sidebar-item active" onclick="showSection('recent', this)"><i class="fas fa-clock"></i><span>Recent Orders</span></div>
            <div class="sidebar-item" onclick="showSection('processing', this)"><i class="fas fa-cogs"></i><span>Processing Orders</span></div>
            <div class="sidebar-item" onclick="showSection('completed', this)"><i class="fas fa-check-circle"></i><span>Completed Orders</span></div>
            <div class="sidebar-item" onclick="showSection('cancelled', this)"><i class="fas fa-times-circle"></i><span>Cancelled Orders</span></div>
            <div class="sidebar-item" onclick="window.open('stock.php', '_blank')"><i class="fas fa-boxes"></i><span>Stock Management</span></div>
        </div>

        <div class="main-content">
            <div class="dashboard-header">
                <h1 class="dashboard-title" id="welcomeTitle">Welcome back!</h1>
                <p class="dashboard-subtitle">Here's what's happening with your orders today</p>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Recent Orders</h3>
                    <div class="number" id="recentOrdersCount">0</div>
                    <div class="change" id="recentOrdersChange">No new orders</div>
                </div>
                <div class="stat-card">
                    <h3>Processing Orders</h3>
                    <div class="number" id="processingOrdersCount">0</div>
                    <div class="change" id="processingOrdersChange">Orders being processed</div>
                </div>
                <div class="stat-card">
                    <h3>Completed Orders</h3>
                    <div class="number" id="completedOrdersCount">0</div>
                    <div class="change" id="completedOrdersChange">Successfully completed</div>
                </div>
                <div class="stat-card">
                    <h3>Cancelled Orders</h3>
                    <div class="number" id="cancelledOrdersCount">0</div>
                    <div class="change" id="cancelledOrdersChange">Orders cancelled</div>
                </div>
            </div>

            <button class="refresh-btn" onclick="refreshOrders()">
                <i class="fas fa-sync-alt"></i> Refresh Orders
            </button>

            <div id="recent" class="content-section active">
                <h2 class="section-title">Recent Orders</h2>
                <div id="recentOrdersContent"></div>
            </div>
            <div id="processing" class="content-section">
                <h2 class="section-title">Processing Orders</h2>
                <div id="processingOrdersContent"></div>
            </div>
            <div id="completed" class="content-section">
                <h2 class="section-title">Completed Orders</h2>
                <div id="completedOrdersContent"></div>
            </div>
            <div id="cancelled" class="content-section">
                <h2 class="section-title">Cancelled Orders</h2>
                <div id="cancelledOrdersContent"></div>
            </div>
        </div>
    </div>

    <script>

        // =====================================================================
        // STATUS COORDINATION MAP
        // -----------------------------------------------------------------------
        // localStorage key used by ALL pages: 'orderHistory'
        //
        // order.status values (what seller writes, what myorders.php reads):
        //   'New'        → just placed, myorders shows "Processing" tracking step
        //   'Processing' → seller clicked Mark Processing, myorders shows "Out for Delivery"
        //                  (only when deliveryPerson + deliveryPattern are also set)
        //   'Completed'  → OTP verified, myorders/pastorders shows "Delivered"
        //   'Cancelled'  → seller or customer cancelled
        //
        // order.trackingStatus (set by seller so myorders.php can read it):
        //   'Processing'      → order accepted
        //   'Out for Delivery'→ delivery person assigned
        //   'Delivered'       → OTP verified
        //   'Cancelled'       → cancelled
        //
        // pastorders.php filters: status === 'Completed' OR trackingStatus === 'Delivered'
        // =====================================================================

        // ===================== DB SYNC HELPER =====================
        // Silently syncs an order action to the database
        // Does NOT block or change any existing function behaviour
        async function dbSync(action, data) {
            try {
                await fetch(`api/orders.php?action=${action}`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
            } catch (e) {
                console.warn('DB sync failed (localStorage still updated):', e);
            }
        }

        // ===================== INIT =====================
        document.addEventListener('DOMContentLoaded', function () {
            const sellerData = JSON.parse(
                sessionStorage.getItem('sellerData') ||
                localStorage.getItem('currentUser') || '{}'
            );
            const name = sellerData.name || 'Seller';
            document.getElementById('sellerName').textContent  = 'Hi, ' + name;
            document.getElementById('welcomeTitle').textContent = 'Welcome back, ' + name + '!';

            loadOrders();
            setInterval(loadOrders, 30000);
        });

        // ===================== SIDEBAR =====================
        function showSection(section, el) {
            document.querySelectorAll('.content-section').forEach(s => s.classList.remove('active'));
            document.querySelectorAll('.sidebar-item').forEach(s => s.classList.remove('active'));
            document.getElementById(section).classList.add('active');
            if (el) el.classList.add('active');
            closeMobileSidebar();
        }

        function toggleMobileSidebar() {
            document.getElementById('sidebar').classList.toggle('mobile-open');
            document.getElementById('mobileOverlay').classList.toggle('show');
        }

        function closeMobileSidebar() {
            document.getElementById('sidebar').classList.remove('mobile-open');
            document.getElementById('mobileOverlay').classList.remove('show');
        }

        // ===================== DROPDOWN =====================
        function toggleDropdown() {
            document.getElementById('userDropdown').classList.toggle('show');
        }

        window.addEventListener('click', function (e) {
            if (!e.target.closest('.user-menu')) {
                document.getElementById('userDropdown').classList.remove('show');
            }
        });

        function viewProfile() {
            const sellerData = JSON.parse(
                sessionStorage.getItem('sellerData') ||
                localStorage.getItem('currentUser') || '{}'
            );
            alert(`👤 Profile\n\nName: ${sellerData.name || 'N/A'}\nEmail: ${sellerData.email || 'N/A'}\nPhone: ${sellerData.phone || 'N/A'}`);
            document.getElementById('userDropdown').classList.remove('show');
        }

        function settings() {
            alert('⚙️ Settings feature coming soon!');
            document.getElementById('userDropdown').classList.remove('show');
        }

        // ===================== LOGOUT =====================
        function logout() {
            sessionStorage.clear();
            localStorage.removeItem('currentUser');
            window.location.href = 'welcome.php';
        }

        // ===================== ORDER STORAGE =====================
        function getAllOrders() {
            try {
                const data = localStorage.getItem('orderHistory');
                if (data) {
                    const parsed = JSON.parse(data);
                    if (Array.isArray(parsed)) return parsed;
                }
            } catch (e) { console.error('Error reading orders:', e); }
            return [];
        }

        function saveAllOrders(orders) {
            localStorage.setItem('orderHistory', JSON.stringify(orders));
            localStorage.setItem('allOrders', JSON.stringify(orders));
        }

        // ===================== LOAD & RENDER =====================
        function refreshOrders() {
            loadOrders();
            showToast('Orders refreshed!', 'success');
        }

        // On load: merge DB orders into localStorage so seller sees everything
        async function loadOrders() {
            try {
                const res  = await fetch('api/orders.php?action=get_orders');
                const data = await res.json();
                if (data.success && data.orders.length > 0) {
                    const local  = getAllOrders();
                    const merged = mergeOrders(local, data.orders);
                    saveAllOrders(merged);
                }
            } catch (e) {
                console.warn('Could not fetch DB orders, using localStorage only:', e);
            }
            renderAll();
        }

        // Merge DB orders with localStorage orders (DB wins on status fields)
        function mergeOrders(local, dbOrders) {
            const map = {};
            // Start with local
            local.forEach(o => { map[o.orderId || o.order_id] = o; });
            // DB overwrites status/tracking fields
            dbOrders.forEach(db => {
                const id = db.order_id;
                if (map[id]) {
                    map[id].status          = db.status;
                    map[id].trackingStatus  = db.tracking_status;
                    map[id].deliveryPerson  = db.delivery_person;
                    map[id].deliveryPattern = db.delivery_pattern;
                    map[id].deliveryDate    = db.delivery_date;
                } else {
                    // Order exists in DB but not localStorage — add it
                    map[id] = {
                        orderId:         db.order_id,
                        date:            db.order_date,
                        status:          db.status,
                        trackingStatus:  db.tracking_status,
                        otp:             db.otp,
                        paymentMethod:   db.payment_method,
                        deliveryPerson:  db.delivery_person,
                        deliveryPattern: db.delivery_pattern,
                        deliveryDate:    db.delivery_date,
                        customerInfo: {
                            name:    db.customer_name,
                            email:   db.customer_email,
                            phone:   db.customer_phone,
                            address: db.customer_address,
                            pincode: db.customer_pincode,
                        },
                        summary: {
                            subtotal:  parseFloat(db.subtotal),
                            shipping:  parseFloat(db.shipping),
                            total:     parseFloat(db.total),
                        },
                        items: db.items || [],
                    };
                }
            });
            return Object.values(map);
        }

        function renderAll() {
            const allOrders  = getAllOrders();
            const recent     = allOrders.filter(o => !o.status || o.status === 'New');
            const processing = allOrders.filter(o => o.status === 'Processing');
            const completed  = allOrders.filter(o => o.status === 'Completed');
            const cancelled  = allOrders.filter(o => o.status === 'Cancelled');

            document.getElementById('recentOrdersCount').textContent     = recent.length;
            document.getElementById('processingOrdersCount').textContent  = processing.length;
            document.getElementById('completedOrdersCount').textContent   = completed.length;
            document.getElementById('cancelledOrdersCount').textContent   = cancelled.length;

            document.getElementById('recentOrdersChange').textContent     = recent.length     ? recent.length + ' new order(s)'    : 'No new orders';
            document.getElementById('processingOrdersChange').textContent = processing.length ? processing.length + ' in progress' : 'Orders being processed';
            document.getElementById('completedOrdersChange').textContent  = completed.length  ? completed.length + ' completed'    : 'Successfully completed';
            document.getElementById('cancelledOrdersChange').textContent  = cancelled.length  ? cancelled.length + ' cancelled'    : 'Orders cancelled';

            renderOrders('recentOrdersContent',     recent,     'New');
            renderOrders('processingOrdersContent', processing, 'Processing');
            renderOrders('completedOrdersContent',  completed,  'Completed');
            renderOrders('cancelledOrdersContent',  cancelled,  'Cancelled');
        }

        function renderOrders(containerId, orders, type) {
            const container = document.getElementById(containerId);

            const emptyConfig = {
                'New':        { icon: 'fa-shopping-cart', label: 'Recent' },
                'Processing': { icon: 'fa-cogs',          label: 'Processing' },
                'Completed':  { icon: 'fa-check-circle',  label: 'Completed' },
                'Cancelled':  { icon: 'fa-times-circle',  label: 'Cancelled' },
            };
            const cfg = emptyConfig[type] || emptyConfig['New'];

            if (!orders || orders.length === 0) {
                container.innerHTML = `
                    <div class="empty-state">
                        <i class="fas ${cfg.icon}"></i>
                        <h3>No ${cfg.label} Orders</h3>
                        <p>You don't have any ${cfg.label.toLowerCase()} orders at the moment.</p>
                    </div>`;
                return;
            }

            const rows = orders.map(order => {
                const customer       = getCustomerName(order);
                const phone          = getCustomerPhone(order);
                const items          = order.items || [];
                const itemCount      = order.summary?.itemCount || items.reduce((s, i) => s + (i.qty || 1), 0);
                const total          = order.summary?.total || order.total || 0;
                const otp            = order.otp || 'N/A';
                const orderId        = order.orderId || order.id || 'N/A';
                const date           = order.date ? new Date(order.date).toLocaleDateString('en-IN') : 'N/A';
                const deliveryDate   = order.deliveryDate   || '';
                const deliveryPerson = order.deliveryPerson || '';
                const deliveryPattern= order.deliveryPattern|| '';

                const itemSummary = items.map(i =>
                    `<div>• ${i.name || 'Tyre'} x${i.qty || 1}</div>`
                ).join('');

                let actions = '';

                if (type === 'New') {
                    actions = `
                        <button class="view-details-btn" onclick="viewOrder('${orderId}')">
                            <i class="fas fa-eye"></i> View
                        </button><br>
                        <div class="delivery-section" style="margin-top:6px;">
                            <input class="delivery-person-input" id="dp-${orderId}"
                                   placeholder="Delivery person name" value="${deliveryPerson}" />
                            <select class="delivery-select" id="del-${orderId}">
                                <option value="">Set delivery date</option>
                                ${getDeliveryOptions(deliveryDate)}
                            </select>
                            <select class="delivery-select" id="pattern-${orderId}">
                                <option value="">Select delivery method</option>
                                <option value="Standard Delivery" ${deliveryPattern==='Standard Delivery'?'selected':''}>Standard Delivery</option>
                                <option value="Express Delivery"  ${deliveryPattern==='Express Delivery' ?'selected':''}>Express Delivery</option>
                                <option value="Same Day Delivery" ${deliveryPattern==='Same Day Delivery'?'selected':''}>Same Day Delivery</option>
                            </select>
                            <button class="set-delivery-btn" onclick="setDeliveryInfo('${orderId}')">💾 Save Delivery Info</button>
                            ${deliveryDate    ? `<div class="delivery-pattern">📅 ${deliveryDate}</div>`    : ''}
                            ${deliveryPerson  ? `<div class="delivery-pattern">👤 ${deliveryPerson}</div>`  : ''}
                            ${deliveryPattern ? `<div class="delivery-pattern">🚚 ${deliveryPattern}</div>` : ''}
                        </div>
                        <button class="mark-processing-btn" style="margin-top:4px;" onclick="markProcessing('${orderId}')">
                            ▶ Mark Processing
                        </button>
                        <button class="cancel-btn" onclick="cancelOrder('${orderId}')">✕ Cancel</button>`;

                } else if (type === 'Processing') {
                    actions = `
                        <button class="view-details-btn" onclick="viewOrder('${orderId}')">
                            <i class="fas fa-eye"></i> View
                        </button><br>
                        ${deliveryDate    ? `<div class="delivery-pattern" style="margin:4px 0;">📅 ${deliveryDate}</div>`    : ''}
                        ${deliveryPerson  ? `<div class="delivery-pattern" style="margin:4px 0;">👤 ${deliveryPerson}</div>`  : ''}
                        ${deliveryPattern ? `<div class="delivery-pattern" style="margin:4px 0;">🚚 ${deliveryPattern}</div>` : ''}
                        <input class="otp-input" id="otp-${orderId}" placeholder="Enter OTP" />
                        <button class="verify-otp-btn" onclick="verifyOTP('${orderId}', '${otp}')">✔ Verify OTP</button>`;

                } else {
                    actions = `
                        <button class="view-details-btn" onclick="viewOrder('${orderId}')">
                            <i class="fas fa-eye"></i> View
                        </button>`;
                }

                const statusClass = 'status-' + type.toLowerCase();

                return `
                    <tr>
                        <td><strong>${orderId}</strong><br><small style="color:#888;">${date}</small></td>
                        <td>${customer}<br><small style="color:#888;">${phone}</small></td>
                        <td><div>${itemCount} tyre(s)</div><div class="order-items-list">${itemSummary}</div></td>
                        <td>₹${Number(total).toLocaleString('en-IN')}</td>
                        <td><span class="otp-display">${otp}</span></td>
                        <td><span class="status-badge ${statusClass}">${type}</span></td>
                        <td>${actions}</td>
                    </tr>`;
            }).join('');

            container.innerHTML = `
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Order ID</th><th>Customer</th><th>Items</th>
                            <th>Total</th><th>OTP</th><th>Status</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>${rows}</tbody>
                </table>`;
        }

        // ===================== HELPERS =====================
        function getCustomerName(order) {
            if (order.customerInfo) {
                const ci = order.customerInfo;
                if (ci.firstName) return (ci.firstName + ' ' + (ci.lastName || '')).trim();
                if (ci.name) return ci.name;
            }
            return order.customerName || order.customer_name || 'N/A';
        }

        function getCustomerPhone(order) {
            if (order.customerInfo?.phone) return order.customerInfo.phone;
            return order.customerPhone || order.customer_phone || 'N/A';
        }

        function getDeliveryOptions(selectedValue) {
            const options = [];
            const today = new Date();
            for (let i = 1; i <= 14; i++) {
                const d = new Date(today);
                d.setDate(today.getDate() + i);
                const label = d.toLocaleDateString('en-IN', { weekday: 'short', day: 'numeric', month: 'short' });
                const value = d.toLocaleDateString('en-IN');
                const sel   = value === selectedValue ? 'selected' : '';
                options.push(`<option value="${value}" ${sel}>${label}</option>`);
            }
            return options.join('');
        }

        // ===================== ORDER ACTIONS =====================

        function setDeliveryInfo(orderId) {
            const person  = (document.getElementById('dp-'      + orderId)?.value || '').trim();
            const date    =  document.getElementById('del-'     + orderId)?.value || '';
            const pattern =  document.getElementById('pattern-' + orderId)?.value || '';

            if (!date && !person && !pattern) {
                showToast('Please fill at least one delivery field.', 'error');
                return;
            }

            // ── localStorage (unchanged) ──
            const allOrders = getAllOrders();
            const idx = allOrders.findIndex(o => (o.orderId || o.id) === orderId);
            if (idx !== -1) {
                if (person)  allOrders[idx].deliveryPerson  = person;
                if (date)    allOrders[idx].deliveryDate    = date;
                if (pattern) allOrders[idx].deliveryPattern = pattern;
                saveAllOrders(allOrders);
                showToast('Delivery info saved!', 'success');
                renderAll();
            }

            // ── DB sync (silent) ──
            dbSync('update_delivery', {
                order_id:        orderId,
                delivery_person: person,
                delivery_date:   date,
                delivery_pattern:pattern
            });
        }

        function markProcessing(orderId) {
            const allOrders = getAllOrders();
            const idx = allOrders.findIndex(o => (o.orderId || o.id) === orderId);
            if (idx !== -1) {
                allOrders[idx].status = 'Processing';
                if (allOrders[idx].deliveryPerson && allOrders[idx].deliveryPattern) {
                    allOrders[idx].trackingStatus = 'Out for Delivery';
                } else {
                    allOrders[idx].trackingStatus = 'Processing';
                }
                saveAllOrders(allOrders);
                renderAll();
                showToast('Order moved to Processing.', 'success');

                // ── DB sync (silent) ──
                dbSync('update_status', {
                    order_id:        orderId,
                    status:          allOrders[idx].status,
                    tracking_status: allOrders[idx].trackingStatus
                });
            }
        }

        function cancelOrder(orderId) {
            if (confirm('Are you sure you want to cancel this order?')) {
                const allOrders = getAllOrders();
                const idx = allOrders.findIndex(o => (o.orderId || o.id) === orderId);
                if (idx !== -1) {
                    allOrders[idx].status         = 'Cancelled';
                    allOrders[idx].trackingStatus = 'Cancelled';
                    if (allOrders[idx].items) {
                        allOrders[idx].items.forEach(item => item.status = 'cancelled');
                    }
                    saveAllOrders(allOrders);
                    renderAll();
                    showToast('Order cancelled.', 'info');

                    // ── DB sync (silent) ──
                    dbSync('update_status', {
                        order_id:        orderId,
                        status:          'Cancelled',
                        tracking_status: 'Cancelled'
                    });
                }
            }
        }

        function verifyOTP(orderId, correctOTP) {
            const input = document.getElementById('otp-' + orderId);
            if (!input) return;

            if (input.value.trim() === String(correctOTP)) {
                const allOrders = getAllOrders();
                const idx = allOrders.findIndex(o => (o.orderId || o.id) === orderId);
                if (idx !== -1) {
                    allOrders[idx].status         = 'Completed';
                    allOrders[idx].trackingStatus = 'Delivered';
                    if (!allOrders[idx].deliveryDate) {
                        allOrders[idx].deliveryDate = new Date().toISOString();
                    }
                    if (allOrders[idx].items) {
                        allOrders[idx].items.forEach(item => {
                            if (item.status !== 'cancelled') item.status = 'active';
                        });
                    }
                    saveAllOrders(allOrders);
                    renderAll();
                    showToast('✅ OTP verified! Order marked as Completed & Delivered.', 'success');

                    // ── DB sync (silent) ──
                    dbSync('update_status', {
                        order_id:        orderId,
                        status:          'Completed',
                        tracking_status: 'Delivered'
                    });
                }
            } else {
                showToast('❌ Incorrect OTP. Please try again.', 'error');
                input.style.borderColor = '#dc3545';
                setTimeout(() => input.style.borderColor = '#ddd', 2000);
            }
        }

        // ===================== VIEW ORDER MODAL =====================
        function viewOrder(orderId) {
            const allOrders = getAllOrders();
            const order = allOrders.find(o => (o.orderId || o.id) === orderId);
            if (!order) return;

            const customer  = getCustomerName(order);
            const phone     = getCustomerPhone(order);
            const email     = order.customerInfo?.email   || order.customerEmail   || 'N/A';
            const address   = order.customerInfo?.address || order.customerAddress || 'N/A';
            const pincode   = order.customerInfo?.pincode || order.pincode         || 'N/A';
            const payment   = order.paymentMethod || 'N/A';
            const date      = order.date ? new Date(order.date).toLocaleString('en-IN') : 'N/A';
            const delivery  = order.deliveryDate
                ? (typeof order.deliveryDate === 'string' && order.deliveryDate.includes('T')
                    ? new Date(order.deliveryDate).toLocaleDateString('en-IN')
                    : order.deliveryDate)
                : 'Not set';
            const total    = order.summary?.total    || order.total    || 0;
            const shipping = order.summary?.shipping || order.shipping || 0;
            const subtotal = order.summary?.subtotal || (total - shipping) || 0;

            const itemsHtml = (order.items || []).map(item => `
                <div class="modal-item">
                    <strong>${item.name || 'Tyre'}</strong>
                    ${item.brand ? '(' + item.brand + ')' : ''}
                    ${item.specs ? '- ' + item.specs : ''}<br>
                    Qty: ${item.qty || 1} × ₹${(item.price || 0).toLocaleString('en-IN')}
                    = <strong>₹${((item.price || 0) * (item.qty || 1)).toLocaleString('en-IN')}</strong>
                    ${item.status === 'cancelled' ? ' <span style="color:#dc3545;">(Cancelled)</span>' : ''}
                </div>`).join('');

            document.getElementById('modalContent').innerHTML = `
                <div class="detail-row"><span class="detail-label">Order ID</span><span class="detail-value">${order.orderId || 'N/A'}</span></div>
                <div class="detail-row"><span class="detail-label">Order Date</span><span class="detail-value">${date}</span></div>
                <div class="detail-row"><span class="detail-label">Status</span><span class="detail-value"><span class="status-badge status-${(order.status||'new').toLowerCase()}">${order.status || 'New'}</span></span></div>
                <div class="detail-row"><span class="detail-label">Tracking Status</span><span class="detail-value">${order.trackingStatus || 'Processing'}</span></div>
                <div class="detail-row"><span class="detail-label">OTP</span><span class="detail-value"><span class="otp-display">${order.otp || 'N/A'}</span></span></div>
                <div class="detail-row"><span class="detail-label">Customer</span><span class="detail-value">${customer}</span></div>
                <div class="detail-row"><span class="detail-label">Phone</span><span class="detail-value">${phone}</span></div>
                <div class="detail-row"><span class="detail-label">Email</span><span class="detail-value">${email}</span></div>
                <div class="detail-row"><span class="detail-label">Address</span><span class="detail-value">${address}</span></div>
                <div class="detail-row"><span class="detail-label">Pincode</span><span class="detail-value">${pincode}</span></div>
                <div class="detail-row"><span class="detail-label">Payment Method</span><span class="detail-value">${payment}</span></div>
                <div class="detail-row"><span class="detail-label">Delivery Date</span><span class="detail-value">${delivery}</span></div>
                <div class="detail-row"><span class="detail-label">Delivery Person</span><span class="detail-value">${order.deliveryPerson || 'Not set'}</span></div>
                <div class="detail-row"><span class="detail-label">Delivery Method</span><span class="detail-value">${order.deliveryPattern || 'Not set'}</span></div>
                <div class="detail-row"><span class="detail-label">Subtotal</span><span class="detail-value">₹${Number(subtotal).toLocaleString('en-IN')}</span></div>
                <div class="detail-row"><span class="detail-label">Shipping</span><span class="detail-value">₹${Number(shipping).toLocaleString('en-IN')}</span></div>
                <div class="detail-row"><span class="detail-label"><strong>Total</strong></span><span class="detail-value"><strong>₹${Number(total).toLocaleString('en-IN')}</strong></span></div>
                <div class="modal-items-title">🛒 Order Items</div>
                ${itemsHtml || '<p style="color:#888;font-size:13px;">No items found.</p>'}
            `;

            document.getElementById('orderModal').classList.add('show');
        }

        function closeModal() {
            document.getElementById('orderModal').classList.remove('show');
        }

        document.getElementById('orderModal').addEventListener('click', function (e) {
            if (e.target === this) closeModal();
        });

        // ===================== TOAST =====================
        function showToast(message, type = 'success') {
            const existing = document.getElementById('sellerToast');
            if (existing) existing.remove();

            const toast = document.createElement('div');
            toast.id = 'sellerToast';
            toast.textContent = message;
            const colors = { success: '#28a745', error: '#dc3545', info: '#17a2b8' };
            toast.style.cssText = `
                position: fixed; bottom: 30px; right: 20px;
                padding: 15px 25px; border-radius: 8px;
                color: white; font-weight: bold;
                background: ${colors[type] || colors.success};
                z-index: 9999; opacity: 0;
                transition: opacity 0.3s ease;
                max-width: 320px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            `;
            document.body.appendChild(toast);
            setTimeout(() => toast.style.opacity = '1', 50);
            setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

    </script>
</body>
</html>