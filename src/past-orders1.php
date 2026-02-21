<?php
require_once "db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Past Orders - Tire Shop</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Arial', sans-serif;
        background: #ffffff;
        min-height: 100vh;
        padding: 20px;
        position: relative;
        overflow-x: hidden;
    }

    /* Subtle animated background */
    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at 20% 20%, rgba(220, 53, 69, 0.02) 0%, transparent 50%),
                    radial-gradient(circle at 80% 80%, rgba(0, 0, 0, 0.01) 0%, transparent 50%);
        animation: backgroundFloat 20s ease-in-out infinite;
        pointer-events: none;
        z-index: -1;
    }

    @keyframes backgroundFloat {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-5px); }
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1), 
                    0 0 0 1px rgba(220, 53, 69, 0.05);
        overflow: hidden;
        animation: containerFadeIn 0.8s ease-out;
    }

    @keyframes containerFadeIn {
        from { 
            opacity: 0; 
            transform: translateY(30px) scale(0.98); 
        }
        to { 
            opacity: 1; 
            transform: translateY(0) scale(1); 
        }
    }

    .header {
        background: linear-gradient(135deg, #dc3545 0%, #000000 50%, #dc3545 100%);
        color: white;
        padding: 40px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);
        animation: headerPulse 6s ease-in-out infinite;
    }

    @keyframes headerPulse {
        0%, 100% { transform: scale(1) rotate(0deg); opacity: 0.3; }
        50% { transform: scale(1.1) rotate(180deg); opacity: 0.6; }
    }

    .header h1 {
        font-size: 2.8rem;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        position: relative;
        z-index: 1;
        animation: titleGlow 3s ease-in-out infinite alternate;
    }

    @keyframes titleGlow {
        from { text-shadow: 2px 2px 4px rgba(0,0,0,0.5), 0 0 20px rgba(220, 53, 69, 0.3); }
        to { text-shadow: 2px 2px 4px rgba(0,0,0,0.5), 0 0 30px rgba(220, 53, 69, 0.6); }
    }

    .header p {
        font-size: 1.1rem;
        opacity: 0.9;
        position: relative;
        z-index: 1;
    }

    /* Back to Home Button */
    .back-home-btn {
        position: absolute;
        top: 20px;
        left: 20px;
        background: rgba(255, 255, 255, 0.15);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.3);
        padding: 12px 20px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: bold;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        z-index: 2;
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .back-home-btn:hover {
        background: rgba(255, 255, 255, 0.25);
        border-color: rgba(255, 255, 255, 0.5);
        transform: translateX(-5px) scale(1.05);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .back-home-btn::before {
        content: '←';
        font-size: 1.2rem;
        transition: transform 0.3s ease;
    }

    .back-home-btn:hover::before {
        transform: translateX(-3px);
    }

    .content {
        padding: 40px;
        animation: contentSlideUp 0.6s ease-out 0.2s both;
    }

    @keyframes contentSlideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .filters {
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
        flex-wrap: wrap;
        align-items: center;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
        animation: filterFadeIn 0.5s ease-out;
    }

    @keyframes filterFadeIn {
        from { opacity: 0; transform: translateX(-10px); }
        to { opacity: 1; transform: translateX(0); }
    }

    .filter-group label {
        font-weight: bold;
        color: #000000;
        font-size: 0.9rem;
    }

    .filter-group select {
        padding: 10px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 1rem;
        background: white;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .filter-group select:hover {
        border-color: #dc3545;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.1);
    }

    .filter-group select:focus {
        outline: none;
        border-color: #dc3545;
        box-shadow: 0 0 15px rgba(220, 53, 69, 0.3);
    }

    .orders-container {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }

    .order-card {
        background: #ffffff;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border-left: 5px solid #28a745;
        border: 1px solid rgba(40, 167, 69, 0.1);
        position: relative;
        overflow: hidden;
        animation: cardSlideIn 0.6s ease-out;
    }

    @keyframes cardSlideIn {
        from { 
            opacity: 0; 
            transform: translateY(30px) rotateX(5deg); 
        }
        to { 
            opacity: 1; 
            transform: translateY(0) rotateX(0deg); 
        }
    }

    .order-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(40, 167, 69, 0.03), transparent);
        transition: left 0.6s ease;
    }

    .order-card:hover {
        transform: translateY(-5px) scale(1.01);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        border-left-color: #dc3545;
    }

    .order-card:hover::before {
        left: 100%;
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .order-info {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .order-id {
        font-size: 1.3rem;
        font-weight: bold;
        color: #000000;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
    }

    .order-id::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: #dc3545;
        transition: width 0.3s ease;
    }

    .order-id:hover {
        color: #dc3545;
        transform: translateX(5px);
    }

    .order-id:hover::after {
        width: 100%;
    }

    .order-date {
        color: #666;
        font-size: 0.9rem;
    }

    .delivery-date {
        color: #28a745;
        font-size: 0.9rem;
        font-weight: bold;
    }

    .order-status {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .status-badge {
        padding: 10px 18px;
        border-radius: 25px;
        font-weight: bold;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        border: 1px solid #28a745;
        animation: deliveredPulse 3s ease-in-out infinite;
        position: relative;
        overflow: hidden;
    }

    .status-badge::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        animation: badgeShine 4s ease-in-out infinite;
    }

    @keyframes deliveredPulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.02); }
    }

    @keyframes badgeShine {
        0% { left: -100%; }
        100% { left: 100%; }
    }

    .order-items {
        margin: 20px 0;
    }

    .items-header {
        font-weight: bold;
        margin-bottom: 15px;
        color: #000000;
        font-size: 1.1rem;
    }

    .item-row {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px;
        background: linear-gradient(135deg, #ffffff 0%, #f9f9f9 100%);
        margin-bottom: 10px;
        border-radius: 12px;
        border: 1px solid #f0f0f0;
        transition: all 0.3s ease;
        animation: itemSlideIn 0.4s ease-out;
    }

    @keyframes itemSlideIn {
        from { opacity: 0; transform: translateX(-20px); }
        to { opacity: 1; transform: translateX(0); }
    }

    .item-row:hover {
        transform: translateX(5px);
        box-shadow: 0 5px 15px rgba(40, 167, 69, 0.1);
        border-color: rgba(40, 167, 69, 0.3);
    }

    .item-image {
        width: 70px;
        height: 70px;
        border-radius: 10px;
        overflow: hidden;
        border: 2px solid #f0f0f0;
        transition: all 0.3s ease;
    }

    .item-image:hover {
        border-color: #28a745;
        transform: scale(1.05);
    }

    .item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .item-image:hover img {
        transform: scale(1.1);
    }

    .item-details {
        flex: 1;
    }

    .item-name {
        font-weight: bold;
        color: #000000;
        margin-bottom: 5px;
        transition: color 0.3s ease;
    }

    .item-name:hover {
        color: #dc3545;
    }

    .item-specs {
        color: #666;
        font-size: 0.9rem;
    }

    .item-price {
        font-weight: bold;
        color: #28a745;
        font-size: 1.1rem;
        animation: priceGlow 4s ease-in-out infinite;
    }

    @keyframes priceGlow {
        0%, 100% { text-shadow: none; }
        50% { text-shadow: 0 0 8px rgba(40, 167, 69, 0.4); }
    }

    .order-actions {
        display: flex;
        gap: 15px;
        margin-top: 25px;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    .btn {
        padding: 12px 24px;
        border: none;
        border-radius: 10px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
        position: relative;
        overflow: hidden;
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        transition: all 0.4s ease;
        transform: translate(-50%, -50%);
    }

    .btn:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #dc3545 0%, #000000 100%);
        color: white;
        border: 2px solid transparent;
    }

    .btn-primary:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 10px 25px rgba(220, 53, 69, 0.4);
        background: linear-gradient(135deg, #000000 0%, #dc3545 100%);
    }

    .btn-outline {
        background: transparent;
        border: 2px solid #28a745;
        color: #28a745;
        position: relative;
    }

    .btn-outline:hover {
        background: #28a745;
        color: white;
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 20px rgba(40, 167, 69, 0.3);
    }

    .no-orders {
        text-align: center;
        padding: 80px 20px;
        color: #666;
        animation: noOrdersFadeIn 1s ease-out;
    }

    @keyframes noOrdersFadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .no-orders h3 {
        font-size: 1.8rem;
        margin-bottom: 15px;
        color: #000000;
    }

    .no-orders p {
        margin-bottom: 25px;
    }

    .order-summary {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        padding-top: 15px;
        border-top: 2px solid #f0f0f0;
        flex-wrap: wrap;
        gap: 15px;
    }

    .summary-info {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .total-amount {
        font-size: 1.3rem;
        font-weight: bold;
        color: #000000;
        animation: totalGlow 3s ease-in-out infinite;
    }

    @keyframes totalGlow {
        0%, 100% { color: #000000; }
        50% { color: #dc3545; }
    }

    .payment-method {
        color: #666;
        font-size: 0.9rem;
    }

    .delivery-info {
        background: linear-gradient(135deg, #e8f5e8 0%, #d4edda 100%);
        padding: 15px;
        border-radius: 10px;
        margin: 15px 0;
        border-left: 4px solid #28a745;
    }

    .delivery-info h4 {
        color: #155724;
        margin-bottom: 8px;
        font-size: 1rem;
    }

    .delivery-info p {
        color: #155724;
        margin-bottom: 5px;
        font-size: 0.9rem;
    }

    /* Toast Notifications */
    .toast {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 18px 28px;
        border-radius: 12px;
        color: white;
        font-weight: bold;
        z-index: 9999;
        opacity: 0;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        max-width: 350px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .toast.success {
        background: linear-gradient(135deg, #28a745, #20c997);
    }

    .toast.error {
        background: linear-gradient(135deg, #dc3545, #e74c3c);
    }

    .toast.info {
        background: linear-gradient(135deg, #17a2b8, #3498db);
    }

    .toast.show {
        opacity: 1;
        transform: translateX(0);
        animation: toastSlideIn 0.4s ease-out;
    }

    @keyframes toastSlideIn {
        from { 
            opacity: 0; 
            transform: translateX(100px); 
        }
        to { 
            opacity: 1; 
            transform: translateX(0); 
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .header h1 {
            font-size: 2.2rem;
        }

        .content {
            padding: 25px;
        }

        .order-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .order-actions {
            flex-direction: column;
        }

        .btn {
            text-align: center;
            justify-content: center;
        }

        .back-home-btn {
            position: relative;
            margin-bottom: 20px;
        }

        .order-summary {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    /* Additional animations */
    @media (hover: hover) {
        .order-card {
            transform-style: preserve-3d;
        }
        
        .item-row:hover .item-name {
            animation: textPulse 0.6s ease-in-out;
        }
    }

    @keyframes textPulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.02); }
    }

    .receipt-icon {
        font-size: 1.1rem;
        margin-right: 5px;
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="frontage.php" class="back-home-btn">
                <span>Back to Home</span>
            </a>
            <h1>Past Orders</h1>
            <p>Your completed and delivered orders</p>
        </div>

        <div class="content">
            <div class="filters">
                <div class="filter-group">
                    <label for="sortFilter">Sort by:</label>
                    <select id="sortFilter">
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="amount-high">Amount: High to Low</option>
                        <option value="amount-low">Amount: Low to High</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="dateFilter">Delivery Period:</label>
                    <select id="dateFilter">
                        <option value="">All Time</option>
                        <option value="7">Last 7 days</option>
                        <option value="30">Last 30 days</option>
                        <option value="90">Last 3 months</option>
                        <option value="365">Last year</option>
                    </select>
                </div>
            </div>

            <div class="orders-container" id="ordersContainer">
                <!-- Past orders will be dynamically loaded here -->
            </div>
        </div>
    </div>

    <script>
// Past orders data storage
let pastOrders = [];

// Initialize past orders
function initializePastOrders() {
    // Load orders from localStorage and filter for completed/delivered orders
    const savedOrders = localStorage.getItem('orderHistory');
    if (savedOrders) {
        try {
            const allOrders = JSON.parse(savedOrders);
            // Filter for delivered/completed orders only
            pastOrders = allOrders.filter(order => {
                const trackingStatus = order.trackingStatus || order.status;
                return trackingStatus === 'Delivered' || trackingStatus === 'Completed' || order.status === 'Completed';
            });
            
            // Add delivery date if not present (simulate delivery completion)
            pastOrders.forEach(order => {
                if (!order.deliveryDate) {
                    // Add random delivery date between order date and now
                    const orderDate = new Date(order.date);
                    const now = new Date();
                    const daysDiff = Math.floor((now - orderDate) / (1000 * 60 * 60 * 24));
                    const deliveryDays = Math.min(daysDiff, Math.floor(Math.random() * 7) + 1); // 1-7 days after order
                    
                    order.deliveryDate = new Date(orderDate.getTime() + deliveryDays * 24 * 60 * 60 * 1000).toISOString();
                }
            });
        } catch (e) {
            console.error('Error loading past orders:', e);
            pastOrders = [];
        }
    } else {
        pastOrders = [];
    }

    displayPastOrders();
}

// Calculate order total (excluding cancelled items)
function calculateOrderTotal(order) {
    return order.items
        .filter(item => item.status !== 'cancelled')
        .reduce((total, item) => total + (item.price * item.qty), 0);
}

// Display past orders
function displayPastOrders() {
    const container = document.getElementById('ordersContainer');
    const sortFilter = document.getElementById('sortFilter').value;
    const dateFilter = document.getElementById('dateFilter').value;

    // Filter orders by date
    let filteredOrders = pastOrders;
    if (dateFilter) {
        const days = parseInt(dateFilter);
        const cutoffDate = new Date();
        cutoffDate.setDate(cutoffDate.getDate() - days);
        
        filteredOrders = pastOrders.filter(order => {
            const deliveryDate = new Date(order.deliveryDate);
            return deliveryDate >= cutoffDate;
        });
    }

    // Sort orders
    filteredOrders.sort((a, b) => {
        switch (sortFilter) {
            case 'oldest':
                return new Date(a.deliveryDate) - new Date(b.deliveryDate);
            case 'amount-high':
                return calculateOrderTotal(b) - calculateOrderTotal(a);
            case 'amount-low':
                return calculateOrderTotal(a) - calculateOrderTotal(b);
            case 'newest':
            default:
                return new Date(b.deliveryDate) - new Date(a.deliveryDate);
        }
    });

    if (filteredOrders.length === 0) {
        container.innerHTML = `
            <div class="no-orders">
                <h3>No Past Orders Found</h3>
                <p>You don't have any completed orders yet, or no orders match your current filter.</p>
                <a href="index.php" class="btn btn-primary">Shop Now</a>
            </div>
        `;
        return;
    }

    container.innerHTML = '';
    filteredOrders.forEach(order => {
        const orderCard = createPastOrderCard(order);
        container.appendChild(orderCard);
    });
}

// Create past order card
function createPastOrderCard(order) {
    const div = document.createElement('div');
    div.className = 'order-card';
    
    const deliveredItems = order.items.filter(item => item.status !== 'cancelled');
    const orderTotal = calculateOrderTotal(order);
    
    // Generate delivery info
    const deliveryPerson = order.deliveryPerson || 'Delivery Partner';
    const deliveryPattern = order.deliveryPattern || 'Standard Delivery';
    
    div.innerHTML = `
        <div class="order-header">
            <div class="order-info">
                <div class="order-id" onclick="copyToClipboard('${order.orderId}', 'Order ID')" title="Click to copy">
                    ${order.orderId}
                </div>
                <div class="order-date">
                    Ordered on ${formatDate(new Date(order.date))}
                </div>
                <div class="delivery-date">
                    Delivered on ${formatDate(new Date(order.deliveryDate))}
                </div>
            </div>
            
            <div class="order-status">
                <span class="status-badge">
                    ✅ Delivered
                </span>
            </div>
        </div>

        <div class="delivery-info">
            <h4>📦 Delivery Information</h4>
            <p><strong>Delivered by:</strong> ${deliveryPerson}</p>
            <p><strong>Delivery method:</strong> ${deliveryPattern}</p>
            <p><strong>OTP used:</strong> ${order.otp}</p>
        </div>

        <div class="order-items">
            <div class="items-header">Delivered Items:</div>
            ${deliveredItems.map(item => `
                <div class="item-row">
                    <div class="item-image">
                        <img src="${item.image}" alt="${item.name}" 
                             onerror="this.src='https://via.placeholder.com/100x100/ff0000/ffffff?text=TIRE'">
                    </div>
                    <div class="item-details">
                        <div class="item-name">${item.name}</div>
                        <div class="item-specs">${item.brand} - ${item.specs}</div>
                    </div>
                    <div class="item-price">
                        ₹${item.price.toFixed(2)} x ${item.qty}
                    </div>
                </div>
            `).join('')}
        </div>

        <div class="order-summary">
            <div class="summary-info">
                <div class="total-amount">Total Paid: ₹${orderTotal.toFixed(2)}</div>
                <div class="payment-method">Payment: ${order.paymentMethod}</div>
            </div>
            <div class="order-actions">
                <button class="btn btn-outline" onclick="downloadReceipt('${order.orderId}')">
                    <span class="receipt-icon">📄</span>
                    Download Receipt
                </button>
            </div>
        </div>
    `;
    
    return div;
}

// Format date
function formatDate(date) {
    const options = { 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric',
        timeZone: 'Asia/Kolkata'
    };
    return date.toLocaleDateString('en-IN', options);
}

// Copy to clipboard
function copyToClipboard(text, label) {
    if (navigator.clipboard) {
        navigator.clipboard.writeText(text).then(() => {
            showToast(`${label} copied to clipboard!`, 'success');
        }).catch(err => {
            console.error('Failed to copy: ', err);
            fallbackCopy(text, label);
        });
    } else {
        fallbackCopy(text, label);
    }
}

// Fallback copy function
function fallbackCopy(text, label) {
    const textArea = document.createElement('textarea');
    textArea.value = text;
    textArea.style.position = 'fixed';
    textArea.style.left = '-999999px';
    textArea.style.top = '-999999px';
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    
    try {
        document.execCommand('copy');
        showToast(`${label} copied to clipboard!`, 'success');
    } catch (err) {
        console.error('Fallback copy failed: ', err);
        showToast(`Copy failed. Please select and copy manually.`, 'error');
    }
    
    document.body.removeChild(textArea);
}

// Download receipt function
function downloadReceipt(orderId) {
    const order = pastOrders.find(o => o.orderId === orderId);
    if (!order) {
        showToast('Order not found!', 'error');
        return;
    }

    try {
        // Generate receipt content
        const receiptContent = generateReceiptContent(order);
        
        // Create and download the file
        const blob = new Blob([receiptContent], { type: 'text/plain' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `Receipt_${orderId}.txt`;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        window.URL.revokeObjectURL(url);
        
        showToast('Receipt downloaded successfully!', 'success');
    } catch (error) {
        console.error('Error downloading receipt:', error);
        showToast('Failed to download receipt. Please try again.', 'error');
    }
}

// Generate receipt content
function generateReceiptContent(order) {
    const deliveredItems = order.items.filter(item => item.status !== 'cancelled');
    const orderTotal = calculateOrderTotal(order);
    const deliveryPerson = order.deliveryPerson || 'Delivery Partner';
    
    let content = `
═══════════════════════════════════════════════════════════
                    TIRE SHOP RECEIPT
═══════════════════════════════════════════════════════════

Order ID: ${order.orderId}
Order Date: ${formatDate(new Date(order.date))}
Delivery Date: ${formatDate(new Date(order.deliveryDate))}
Status: DELIVERED ✅

───────────────────────────────────────────────────────────
                    DELIVERY INFORMATION
───────────────────────────────────────────────────────────

Delivered by: ${deliveryPerson}
Delivery Method: ${order.deliveryPattern || 'Standard Delivery'}
OTP Used: ${order.otp}

───────────────────────────────────────────────────────────
                      ORDER DETAILS
───────────────────────────────────────────────────────────

`;

    // Add items
    deliveredItems.forEach((item, index) => {
        content += `${index + 1}. ${item.name}
   Brand: ${item.brand}
   Specifications: ${item.specs}
   Quantity: ${item.qty}
   Unit Price: ₹${item.price.toFixed(2)}
   Total: ₹${(item.price * item.qty).toFixed(2)}

`;
    });

    content += `───────────────────────────────────────────────────────────
                      PAYMENT SUMMARY
───────────────────────────────────────────────────────────

Items Total: ₹${orderTotal.toFixed(2)}
Payment Method: ${order.paymentMethod}
Payment Status: COMPLETED

───────────────────────────────────────────────────────────

Thank you for choosing Tire Shop!
For support, contact us at support@tireshop.com

This is an unofficial receipt for your records.
Generated on: ${formatDate(new Date())}

═══════════════════════════════════════════════════════════
`;

    return content;
}

// Enhanced toast notification system
function showToast(message, type = 'success') {
    // Remove existing toast
    const existingToast = document.querySelector('.toast');
    if (existingToast) {
        existingToast.remove();
    }

    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    
    // Add icon based on type
    let icon = '';
    switch (type) {
        case 'success':
            icon = '✅';
            break;
        case 'error':
            icon = '❌';
            break;
        case 'info':
            icon = 'ℹ️';
            break;
        default:
            icon = '📢';
    }
    
    toast.innerHTML = `
        <div class="toast-content">
            <span class="toast-icon">${icon}</span>
            <span class="toast-message">${message}</span>
        </div>
    `;
    
    document.body.appendChild(toast);
    
    // Trigger animation
    setTimeout(() => {
        toast.classList.add('show');
    }, 100);
    
    // Remove toast after 4 seconds
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => {
            if (document.body.contains(toast)) {
                document.body.removeChild(toast);
            }
        }, 300);
    }, 4000);
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    initializePastOrders();

    // Filter and sort event listeners
    document.getElementById('sortFilter').addEventListener('change', displayPastOrders);
    document.getElementById('dateFilter').addEventListener('change', displayPastOrders);

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl+H for home
        if (e.ctrlKey && e.key === 'h') {
            e.preventDefault();
            window.location.href = 'index.php';
        }
        
        // F5 to refresh orders
        if (e.key === 'F5') {
            e.preventDefault();
            initializePastOrders();
            showToast('Past orders refreshed!', 'info');
        }
    });
});

// Navigation functions
function goHome() {
    window.location.href = 'index.php';
}

// Manual refresh function
function manualRefresh() {
    initializePastOrders();
    showToast('Checking for updated past orders...', 'info');
}

// Universal New User Detection Script
(function() {
    'use strict';
    
    function getCurrentUser() {
        const userData = sessionStorage.getItem('userData');
        const sellerData = sessionStorage.getItem('sellerData');
        const dealerData = sessionStorage.getItem('dealerData');
        
        if (userData) return JSON.parse(userData);
        if (sellerData) return JSON.parse(sellerData);
        if (dealerData) return JSON.parse(dealerData);
        
        return null;
    }
    
    function isReturningUser(email) {
        if (!email) return false;
        const userVisits = JSON.parse(localStorage.getItem('userVisits') || '{}');
        return userVisits.hasOwnProperty(email);
    }
    
    function markUserAsVisited(email) {
        if (!email) return;
        
        const userVisits = JSON.parse(localStorage.getItem('userVisits') || '{}');
        const now = new Date().toISOString();
        
        if (userVisits[email]) {
            userVisits[email].lastVisit = now;
            userVisits[email].visitCount = (userVisits[email].visitCount || 1) + 1;
        } else {
            userVisits[email] = {
                firstVisit: now,
                lastVisit: now,
                visitCount: 1,
                isNew: true
            };
        }
        
        localStorage.setItem('userVisits', JSON.stringify(userVisits));
    }
    
    function hasUserSessionChanged() {
        const currentUser = getCurrentUser();
        if (!currentUser || !currentUser.email) return false;
        
        const lastSessionEmail = sessionStorage.getItem('lastSessionEmail');
        
        if (lastSessionEmail !== currentUser.email) {
            sessionStorage.setItem('lastSessionEmail', currentUser.email);
            return true;
        }
        
        return false;
    }
    
    function getUserStatus() {
        const currentUser = getCurrentUser();
        if (!currentUser || !currentUser.email) {
            return {
                isLoggedIn: false,
                isNewUser: false,
                isReturningUser: false,
                userData: null
            };
        }
        
        const isReturning = isReturningUser(currentUser.email);
        const sessionChanged = hasUserSessionChanged();
        
        return {
            isLoggedIn: true,
            isNewUser: !isReturning,
            isReturningUser: isReturning,
            sessionChanged: sessionChanged,
            userData: currentUser,
            email: currentUser.email
        };
    }
    
    function updatePageForUser() {
        const status = getUserStatus();
        
        if (status.isLoggedIn) {
            markUserAsVisited(status.email);
            
            const userNameElement = document.getElementById('userName');
            if (userNameElement && status.userData.name) {
                const firstName = status.userData.name.split(' ')[0];
                let welcomeText = `Hi ${firstName}!`;
                
                if (status.isReturningUser) {
                    welcomeText = `Welcome back, ${firstName}!`;
                }
                
                if (status.userData.type === 'seller') {
                    welcomeText += ' (Seller)';
                } else if (status.userData.type === 'dealer') {
                    welcomeText += ' (Dealer)';
                }
                
                userNameElement.textContent = welcomeText;
            }
            
            const userWelcomeDiv = document.getElementById('userWelcome');
            if (userWelcomeDiv) {
                userWelcomeDiv.style.display = 'block';
            }
            
            document.body.classList.add('user-logged-in');
            
            if (status.isNewUser) {
                document.body.classList.add('new-user');
                document.body.classList.remove('returning-user');
            } else {
                document.body.classList.add('returning-user');
                document.body.classList.remove('new-user');
            }
            
            if (status.sessionChanged) {
                const eventData = {
                    detail: {
                        isNewUser: status.isNewUser,
                        isReturningUser: status.isReturningUser,
                        userData: status.userData
                    }
                };
                
                if (status.isNewUser) {
                    window.dispatchEvent(new CustomEvent('newUserDetected', eventData));
                } else {
                    window.dispatchEvent(new CustomEvent('returningUserDetected', eventData));
                }
                
                window.dispatchEvent(new CustomEvent('userSessionChanged', eventData));
            }
        } else {
            document.body.classList.remove('user-logged-in', 'new-user', 'returning-user');
            
            const userWelcomeDiv = document.getElementById('userWelcome');
            if (userWelcomeDiv) {
                userWelcomeDiv.style.display = 'none';
            }
        }
    }
    
    window.UserDetector = {
        getCurrentUser: getCurrentUser,
        getUserStatus: getUserStatus,
        isReturningUser: isReturningUser,
        markUserAsVisited: markUserAsVisited,
        updatePageForUser: updatePageForUser
    };
    
    function initialize() {
        updatePageForUser();
        
        window.addEventListener('storage', function(e) {
            if (e.key === 'userVisits') {
                updatePageForUser();
            }
        });
    }
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initialize);
    } else {
        initialize();
    }
    
})();

// Event listeners for user detection
window.addEventListener('newUserDetected', function(e) {
    console.log('New user detected:', e.detail.userData);
});

window.addEventListener('returningUserDetected', function(e) {
    console.log('Returning user detected:', e.detail.userData);
});

window.addEventListener('userSessionChanged', function(e) {
    console.log('User session changed:', e.detail);
});
    </script>
</body>
</html>