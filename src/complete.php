<?php
require_once "db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - Tire Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .order-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 25px 80px rgba(0,0,0,0.15);
            overflow: hidden;
            border: 3px solid #ff0000;
            animation: slideIn 0.8s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .success-header {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .success-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: pulse 3s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }

        .success-icon {
            font-size: 4em;
            margin-bottom: 20px;
            color: white;
            text-shadow: 0 4px 8px rgba(0,0,0,0.3);
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }

        .success-header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .success-header p {
            font-size: 1.2em;
            opacity: 0.9;
        }

        .order-content {
            padding: 40px 30px;
        }

        .order-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .info-card {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 25px;
            border: 2px solid #ff0000;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(255,0,0,0.1);
        }

        .info-card h3 {
            color: #ff0000;
            margin-bottom: 15px;
            font-size: 1.3em;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-card h3 i {
            font-size: 1.2em;
        }

        .info-value {
            font-size: 1.5em;
            font-weight: bold;
            color: #000;
            margin-bottom: 10px;
        }

        .info-description {
            color: #666;
            font-size: 0.9em;
            line-height: 1.4;
        }

        .order-items {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            border: 2px solid #ff0000;
        }

        .order-items h2 {
            color: #000;
            margin-bottom: 25px;
            font-size: 1.8em;
            border-bottom: 3px solid #ff0000;
            padding-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .item-list {
            margin-bottom: 25px;
        }

        .order-item {
            display: flex;
            align-items: center;
            padding: 20px 0;
            border-bottom: 1px solid #e0e0e0;
            transition: background-color 0.3s ease;
        }

        .order-item:hover {
            background-color: rgba(255,0,0,0.02);
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 80px;
            height: 80px;
            margin-right: 20px;
            border-radius: 10px;
            overflow: hidden;
            flex-shrink: 0;
            border: 2px solid #ff0000;
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-weight: bold;
            color: #000;
            margin-bottom: 5px;
            font-size: 1.1em;
        }

        .item-brand {
            color: #ff0000;
            font-weight: 600;
            margin-bottom: 3px;
        }

        .item-specs {
            color: #666;
            font-size: 0.9em;
            margin-bottom: 8px;
        }

        .item-price-qty {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .item-qty {
            background: #ff0000;
            color: white;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.9em;
            font-weight: bold;
        }

        .item-subtotal {
            font-weight: bold;
            color: #ff0000;
            font-size: 1.2em;
        }

        .order-summary {
            background: white;
            border-radius: 10px;
            padding: 25px;
            border: 2px solid #ff0000;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding: 8px 0;
            font-size: 1.1em;
        }

        .summary-row.total {
            font-size: 1.4em;
            font-weight: bold;
            color: #000;
            border-top: 2px solid #ff0000;
            padding-top: 20px;
            margin-top: 20px;
            background: linear-gradient(135deg, #fff0f0, #ffebeb);
            padding: 15px;
            border-radius: 10px;
        }

        .shipping-details {
            background: #e8f4ff;
            border: 2px solid #007bff;
            border-radius: 10px;
            padding: 15px;
            margin: 15px 0;
            font-size: 0.95em;
            color: #0056b3;
        }

        .shipping-details i {
            margin-right: 8px;
        }

        .action-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 40px;
        }

        .btn {
            padding: 18px 30px;
            border: none;
            border-radius: 12px;
            font-size: 1.2em;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
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
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            transition: all 0.3s ease;
            transform: translate(-50%, -50%);
        }

        .btn:hover::before {
            width: 100%;
            height: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, #ff0000, #cc0000);
            color: white;
            border: 2px solid #ff0000;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(255,0,0,0.4);
            background: linear-gradient(135deg, #cc0000, #990000);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #000000, #333333);
            color: white;
            border: 2px solid #000000;
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #333333, #555555);
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
        }

        .otp-section {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            border: 2px solid #ffc107;
            border-radius: 15px;
            padding: 25px;
            margin: 30px 0;
            text-align: center;
        }

        .otp-section h3 {
            color: #856404;
            margin-bottom: 15px;
            font-size: 1.3em;
        }

        .otp-code {
            font-size: 2em;
            font-weight: bold;
            color: #856404;
            background: white;
            padding: 15px 30px;
            border-radius: 10px;
            display: inline-block;
            border: 2px solid #ffc107;
            letter-spacing: 3px;
            font-family: 'Courier New', monospace;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        .otp-description {
            margin-top: 15px;
            color: #856404;
            font-size: 0.95em;
            line-height: 1.5;
        }

        .celebration-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1000;
        }

        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background: #ff0000;
            animation: confetti-fall 3s linear infinite;
        }

        @keyframes confetti-fall {
            0% {
                transform: translateY(-100vh) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(720deg);
                opacity: 0;
            }
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #28a745;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9em;
            font-weight: bold;
            margin-top: 10px;
        }

        @media (max-width: 768px) {
            .order-container {
                margin: 10px;
                border-radius: 15px;
            }

            .order-content {
                padding: 20px;
            }

            .order-info-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .action-buttons {
                grid-template-columns: 1fr;
            }

            .success-header {
                padding: 30px 20px;
            }

            .success-header h1 {
                font-size: 2em;
            }

            .success-icon {
                font-size: 3em;
            }

            .item-image {
                width: 60px;
                height: 60px;
                margin-right: 15px;
            }

            .otp-code {
                font-size: 1.5em;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="celebration-animation" id="celebrationAnimation"></div>
    
    <div class="order-container">
        <div class="success-header">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h1>Order Placed Successfully!</h1>
            <p>Thank you for your purchase. Your order has been confirmed.</p>
            <div class="status-badge">
                <i class="fas fa-shipping-fast"></i>
                Processing
            </div>
        </div>

        <div class="order-content">
            <div class="order-info-grid">
                <div class="info-card">
                    <h3><i class="fas fa-receipt"></i> Order ID</h3>
                    <div class="info-value" id="orderIdDisplay">TS-2025-0001</div>
                    <div class="info-description">Keep this ID for tracking your order</div>
                </div>

                <div class="info-card">
                    <h3><i class="fas fa-calendar-alt"></i> Order Date</h3>
                    <div class="info-value" id="orderDateDisplay">June 29, 2025</div>
                    <div class="info-description">Order placed successfully</div>
                </div>

                <div class="info-card">
                    <h3><i class="fas fa-credit-card"></i> Payment Method</h3>
                    <div class="info-value" id="paymentMethodDisplay">Credit Card</div>
                    <div class="info-description">Payment completed successfully</div>
                </div>

                <div class="info-card">
                    <h3><i class="fas fa-truck"></i> Delivery Address</h3>
                    <div class="info-value" id="deliveryAddressDisplay">Loading...</div>
                    <div class="info-description">Estimated delivery: 3-5 business days</div>
                </div>
            </div>

            <div class="otp-section">
                <h3><i class="fas fa-key"></i> Order Verification OTP</h3>
                <div class="otp-code" id="otpDisplay">1234</div>
                <div class="otp-description">
                    Please provide this OTP to our delivery partner for order verification.
                    <br><strong>Note:</strong> Keep this OTP confidential and share only with authorized delivery personnel.
                </div>
            </div>

            <div class="order-items">
                <h2><i class="fas fa-box-open"></i> Order Items</h2>
                <div class="item-list" id="orderItemsList">
                    <!-- Items will be populated here -->
                </div>

                <div class="order-summary">
                    <div class="summary-row">
                        <span>Subtotal (<span id="itemCount">0</span> items):</span>
                        <span id="subtotalAmount">₹0.00</span>
                    </div>
                    <div class="summary-row">
                        <span>Shipping Charges:</span>
                        <span id="shippingAmount">₹0.00</span>
                    </div>
                    <div id="shippingDetails" class="shipping-details" style="display: none;">
                        <i class="fas fa-info-circle"></i>
                        <span id="shippingDetailsText">Shipping details will appear here</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total Amount:</span>
                        <span id="totalAmount">₹0.00</span>
                    </div>
                </div>
            </div>

            <div class="action-buttons">
                <a href="index.php" class="btn btn-primary">
                    <i class="fas fa-home"></i>
                    Back to Home
                </a>
                <a href="myorder.php" class="btn btn-secondary" onclick="continueShopping()">
                    <i class="fas fa-shopping-bag"></i>
                    See Products
                </a>
            </div>
        </div>
    </div>
<script src="path/to/user-detector.js"></script>
    <script>
/// Enhanced Order Confirmation System - Email Integration Removed
let orderData = {};

// Utility Functions
function generateOrderId() {
    const date = new Date();
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    const random = Math.floor(Math.random() * 9999).toString().padStart(4, '0');
    return `TS-${year}${month}${day}-${random}`;
}

function generateOTP() {
    return Math.floor(1000 + Math.random() * 9000).toString();
}

function formatDate(date) {
    const options = { 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric',
        timeZone: 'Asia/Kolkata'
    };
    return date.toLocaleDateString('en-IN', options);
}

function isValidEmail(email) {
    if (!email || typeof email !== 'string') return false;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email.trim());
}

// Cart and Storage Functions
function getCartDataFromStorage() {
    const storageKeys = ['unifiedTireShopCart', 'checkoutCart', 'tireShopCart', 'cart', 'paymentCartData'];

    for (const key of storageKeys) {
        try {
            // Try sessionStorage first
            let data = sessionStorage.getItem(key);
            if (data) {
                const parsed = JSON.parse(data);
                if (Array.isArray(parsed) && parsed.length > 0) return parsed;
                if (parsed.items && Array.isArray(parsed.items)) return parsed.items;
            }
            
            // Then try localStorage
            data = localStorage.getItem(key);
            if (data) {
                const parsed = JSON.parse(data);
                if (Array.isArray(parsed) && parsed.length > 0) return parsed;
                if (parsed.items && Array.isArray(parsed.items)) return parsed.items;
            }
        } catch (e) {
            console.error(`Error loading cart from ${key}:`, e);
        }
    }
    return [];
}

function getCustomerInfoFromPayment() {
    console.log('Getting customer info from payment...');
    
    // List of possible storage keys for customer data
    const customerDataKeys = [
        'paymentCustomerData',
        'checkoutCustomerInfo', 
        'customerInfo',
        'userInfo',
        'orderCustomerInfo'
    ];
    
    // Try to get from sessionStorage first
    for (const key of customerDataKeys) {
        try {
            const data = sessionStorage.getItem(key);
            if (data) {
                const parsed = JSON.parse(data);
                console.log(`Found customer data in sessionStorage[${key}]:`, parsed);
                
                // Validate email if present
                if (parsed.email && isValidEmail(parsed.email)) {
                    return parsed;
                }
            }
        } catch (e) {
            console.error(`Error parsing ${key} from sessionStorage:`, e);
        }
    }
    
    // Try localStorage as backup
    for (const key of customerDataKeys) {
        try {
            const data = localStorage.getItem(key);
            if (data) {
                const parsed = JSON.parse(data);
                console.log(`Found customer data in localStorage[${key}]:`, parsed);
                
                // Validate email if present
                if (parsed.email && isValidEmail(parsed.email)) {
                    return parsed;
                }
            }
        } catch (e) {
            console.error(`Error parsing ${key} from localStorage:`, e);
        }
    }
    
    // Try individual form fields
    const individualKeys = [
        'customerFirstName', 'customerLastName', 'customerEmail', 
        'customerPhone', 'customerAddress', 'customerPincode'
    ];
    
    let hasIndividualData = false;
    const formData = {};
    
    for (const key of individualKeys) {
        const sessionValue = sessionStorage.getItem(key);
        const localValue = localStorage.getItem(key);
        
        if (sessionValue) {
            formData[key.replace('customer', '').toLowerCase()] = sessionValue;
            hasIndividualData = true;
        } else if (localValue) {
            formData[key.replace('customer', '').toLowerCase()] = localValue;
            hasIndividualData = true;
        }
    }
    
    if (hasIndividualData) {
        const customerInfo = {
            firstName: formData.firstname || formData.firstName || 'Guest',
            lastName: formData.lastname || formData.lastName || 'User',
            email: formData.email || '',
            phone: formData.phone || '+91 9876543210',
            address: formData.address || 'Address not provided',
            pincode: formData.pincode || '245101'
        };
        
        console.log('Constructed customer info from individual fields:', customerInfo);
        return customerInfo;
    }
    
    // Try to get from URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const customerParam = urlParams.get('customer');
    if (customerParam) {
        try {
            const parsed = JSON.parse(decodeURIComponent(customerParam));
            console.log('Found customer data in URL params:', parsed);
            if (parsed.email && isValidEmail(parsed.email)) {
                return parsed;
            }
        } catch (e) {
            console.error('Error parsing customer data from URL:', e);
        }
    }
    
    // Final fallback - return default customer info
    console.warn('Using fallback customer data');
    return {
        firstName: 'Guest',
        lastName: 'User',
        email: '',
        phone: '+91 9876543210',
        address: 'Address not provided',
        pincode: '245101'
    };
}

// Shipping Calculation
const pinCodeDistances = {
    '245101': 0, '245102': 5, '245103': 8, '201204': 15, '203001': 18, '245204': 12,
    '203002': 25, '201301': 28, '201310': 22, '201302': 35, '201311': 32, '122001': 38,
    '110001': 45, '110085': 48, '400001': 1200, '560001': 2100, '700001': 1400, '600001': 2000
};

function calculateCostPerTire(distance) {
    if (distance <= 10) return 50;
    else if (distance <= 20) return 100;
    else if (distance <= 30) return 150;
    else if (distance <= 40) return 200;
    else if (distance <= 50) return 300;
    else if (distance <= 60) return 400;
    else {
        const extraDistance = distance - 60;
        const extraTiers = Math.ceil(extraDistance / 10);
        return 400 + (extraTiers * 100);
    }
}

function checkFreeShippingEligibility(cartData) {
    if (!cartData || cartData.length === 0) return false;
    const brandCounts = {};
    cartData.forEach(item => {
        const brand = item.brand || 'Unknown';
        brandCounts[brand] = (brandCounts[brand] || 0) + item.qty;
    });
    return Object.values(brandCounts).some(count => count >= 14);
}

function calculateShippingCost(pincode, tireCount, cartData) {
    if (!pincode || pincode.length !== 6) return 0;
    
    const distance = pinCodeDistances[pincode] || 100;
    const costPerTire = calculateCostPerTire(distance);
    
    if (distance > 40 && checkFreeShippingEligibility(cartData)) {
        const brandCounts = {};
        cartData.forEach(item => {
            const brand = item.brand || 'Unknown';
            brandCounts[brand] = (brandCounts[brand] || 0) + item.qty;
        });
        
        let totalShippingCost = 0;
        Object.entries(brandCounts).forEach(([brand, count]) => {
            if (count >= 14) {
                totalShippingCost += 0;
            } else {
                totalShippingCost += count * costPerTire;
            }
        });
        
        return totalShippingCost;
    }
    
    return tireCount * costPerTire;
}

function getShippingDetails(pincode, cartData) {
    if (!pincode || pincode.length !== 6) return 'Shipping details not available';
    
    const distance = pinCodeDistances[pincode] || 100;
    const costPerTire = calculateCostPerTire(distance);
    
    let details = `Distance from Hapur: ${distance} km`;
    
    if (distance > 40 && checkFreeShippingEligibility(cartData)) {
        const brandCounts = {};
        cartData.forEach(item => {
            const brand = item.brand || 'Unknown';
            brandCounts[brand] = (brandCounts[brand] || 0) + item.qty;
        });
        
        const freeBrands = [];
        const paidBrands = [];
        
        Object.entries(brandCounts).forEach(([brand, count]) => {
            if (count >= 14) {
                freeBrands.push(`${brand} (${count} tires - FREE)`);
            } else {
                paidBrands.push(`${brand} (${count} tires - ₹${costPerTire} each)`);
            }
        });
        
        if (freeBrands.length > 0 && paidBrands.length > 0) {
            details += ' | FREE: ' + freeBrands.join(', ') + ' | PAID: ' + paidBrands.join(', ');
        } else if (freeBrands.length > 0) {
            details += ' | FREE SHIPPING: ' + freeBrands.join(', ');
        } else {
            details += ` | ₹${costPerTire} per tire`;
        }
    } else if (distance > 0) {
        details += ` | ₹${costPerTire} per tire`;
    } else {
        details += ' | Free local delivery';
    }
    
    return details;
}

// Order Data Management
function getOrderData() {
    console.log('Getting order data...');
    
    // Try to get completed order from session storage first
    const completedOrder = sessionStorage.getItem('completedOrder');
    if (completedOrder) {
        try {
            const orderInfo = JSON.parse(completedOrder);
            console.log('Order data from sessionStorage:', orderInfo);
            return orderInfo;
        } catch (e) {
            console.error('Error parsing completed order:', e);
        }
    }

    // Try URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const orderInfo = urlParams.get('order');
    if (orderInfo) {
        try {
            const parsed = JSON.parse(decodeURIComponent(orderInfo));
            console.log('Order data from URL:', parsed);
            return parsed;
        } catch (e) {
            console.error('Error parsing order from URL:', e);
        }
    }

    // Reconstruct from cart and customer data
    const cartData = getCartDataFromStorage();
    const customerInfo = getCustomerInfoFromPayment();
    
    console.log('Cart data:', cartData);
    console.log('Customer info:', customerInfo);
    
    if (cartData && cartData.length > 0) {
        console.log('Reconstructing order from cart and customer data');
        const subtotal = cartData.reduce((sum, item) => sum + (item.price * item.qty), 0);
        const itemCount = cartData.reduce((sum, item) => sum + item.qty, 0);
        const shipping = calculateShippingCost(customerInfo.pincode, itemCount, cartData);
        
        const reconstructedOrder = {
            items: cartData,
            customerInfo: customerInfo,
            paymentMethod: sessionStorage.getItem('selectedPaymentMethod') || 'Unknown',
            pincode: customerInfo.pincode,
            orderDate: new Date().toISOString(),
            orderId: generateOrderId(),
            summary: {
                subtotal: subtotal,
                itemCount: itemCount,
                shipping: shipping,
                total: subtotal + shipping
            }
        };
        
        console.log('Reconstructed order:', reconstructedOrder);
        return reconstructedOrder;
    }

    // Default fallback
    console.log('Using fallback order data');
    return {
        items: [{
            name: "Premium All-Season Tire",
            brand: "Michelin",
            specs: "225/65R17",
            price: 8500,
            qty: 4,
            image: "https://via.placeholder.com/100x100/ff0000/ffffff?text=TIRE"
        }],
        customerInfo: getCustomerInfoFromPayment(),
        paymentMethod: 'Demo',
        pincode: '245101',
        summary: { subtotal: 34000, shipping: 0, total: 34000, itemCount: 4 }
    };
}

function getCustomerInfo(order) {
    let customerInfo = {
        name: 'Customer',
        email: '',
        phone: 'N/A',
        address: 'N/A'
    };
    
    if (order.customerInfo) {
        if (order.customerInfo.firstName && order.customerInfo.lastName) {
            customerInfo.name = `${order.customerInfo.firstName} ${order.customerInfo.lastName}`.trim();
        } else if (order.customerInfo.name) {
            customerInfo.name = order.customerInfo.name;
        }
        
        customerInfo.email = order.customerInfo.email || '';
        customerInfo.phone = order.customerInfo.phone || 'N/A';
        customerInfo.address = order.customerInfo.address || 'N/A';
        
        if (customerInfo.address === 'N/A' && order.customerInfo.pincode) {
            customerInfo.address = `PIN Code: ${order.customerInfo.pincode}`;
        }
    }
    
    console.log('Final customer info:', customerInfo);
    return customerInfo;
}

// Display Functions
function displayCustomerInfo() {
    const customerInfo = getCustomerInfo(orderData);
    
    const updateElement = (id, value) => {
        const element = document.getElementById(id);
        if (element) element.textContent = value;
    };

    updateElement('customerNameDisplay', customerInfo.name);
    updateElement('customerEmailDisplay', customerInfo.email || 'Email not provided');
    updateElement('customerPhoneDisplay', customerInfo.phone);
    updateElement('customerAddressDisplay', customerInfo.address);
    updateElement('deliveryAddressDisplay', customerInfo.address);

    const customerInfoEl = document.getElementById('customerInfoDisplay');
    if (customerInfoEl) {
        customerInfoEl.innerHTML = `
            <div class="customer-detail"><strong>Name:</strong> ${customerInfo.name}</div>
            <div class="customer-detail"><strong>Email:</strong> ${customerInfo.email || 'Not provided'}</div>
            <div class="customer-detail"><strong>Phone:</strong> ${customerInfo.phone}</div>
            <div class="customer-detail"><strong>Address:</strong> ${customerInfo.address}</div>
        `;
    }
}

function displayOrderItems() {
    const container = document.getElementById('orderItemsList');
    if (!container) return;

    const items = orderData.items || [];
    if (items.length === 0) {
        container.innerHTML = '<div class="no-items-message"><p>No order items found</p></div>';
        return;
    }

    container.innerHTML = '';
    items.forEach(item => {
        const orderItem = document.createElement('div');
        orderItem.className = 'order-item';
        orderItem.innerHTML = `
            <div class="item-image">
                <img src="${item.image || 'https://via.placeholder.com/100x100/ff0000/ffffff?text=TIRE'}" 
                     alt="${item.name}" 
                     onerror="this.src='https://via.placeholder.com/100x100/ff0000/ffffff?text=TIRE'">
            </div>
            <div class="item-details">
                <div class="item-name">${item.name || 'Unknown Product'}</div>
                <div class="item-brand">${item.brand || 'Unknown Brand'}</div>
                <div class="item-specs">${item.specs || 'N/A'}</div>
                <div class="item-price-qty">
                    <span>₹${(item.price || 0).toFixed(2)} each</span>
                    <span class="item-qty">Qty: ${item.qty || 0}</span>
                </div>
                <div class="item-subtotal">₹${((item.price || 0) * (item.qty || 0)).toFixed(2)}</div>
            </div>
        `;
        container.appendChild(orderItem);
    });
}

function updateOrderSummary() {
    const summary = orderData.summary || {};
    
    const updateElement = (id, value) => {
        const element = document.getElementById(id);
        if (element) element.textContent = value;
    };

    updateElement('itemCount', summary.itemCount || 0);
    updateElement('subtotalAmount', `₹${(summary.subtotal || 0).toFixed(2)}`);
    updateElement('shippingAmount', `₹${(summary.shipping || 0).toFixed(2)}`);
    updateElement('totalAmount', `₹${(summary.total || 0).toFixed(2)}`);

    // Show shipping details
    const shippingDetailsDiv = document.getElementById('shippingDetails');
    const shippingDetailsText = document.getElementById('shippingDetailsText');
    
    if (orderData.pincode && shippingDetailsDiv && shippingDetailsText) {
        shippingDetailsDiv.style.display = 'block';
        shippingDetailsText.textContent = getShippingDetails(orderData.pincode, orderData.items || []);
    }
}

// Utility Functions
function createCelebrationAnimation() {
    const container = document.getElementById('celebrationAnimation');
    if (!container) return;
    
    const colors = ['#ff0000', '#00ff00', '#0000ff', '#ffff00', '#ff00ff', '#00ffff'];
    
    for (let i = 0; i < 50; i++) {
        const confetti = document.createElement('div');
        confetti.className = 'confetti';
        confetti.style.left = Math.random() * 100 + '%';
        confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
        confetti.style.animationDelay = Math.random() * 3 + 's';
        confetti.style.animationDuration = (Math.random() * 2 + 2) + 's';
        container.appendChild(confetti);
    }

    setTimeout(() => container.innerHTML = '', 5000);
}

function showToast(message, type = 'success') {
    const existingToast = document.getElementById('toast');
    if (existingToast) existingToast.remove();

    const toast = document.createElement('div');
    toast.id = 'toast';
    toast.textContent = message;
    toast.style.cssText = `
        position: fixed; top: 20px; right: 20px; padding: 15px 25px;
        border-radius: 5px; color: white; font-weight: bold;
        z-index: 9999; opacity: 0; transition: opacity 0.3s ease; max-width: 300px;
    `;
    
    const colors = { success: '#28a745', error: '#dc3545', info: '#17a2b8' };
    toast.style.background = colors[type] || colors.success;
    
    document.body.appendChild(toast);
    setTimeout(() => toast.style.opacity = '1', 100);
    
    setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => document.body.contains(toast) && document.body.removeChild(toast), 300);
    }, 3000);
}

function copyToClipboard(text, label = 'Text') {
    if (navigator.clipboard) {
        navigator.clipboard.writeText(text).then(() => {
            showToast(`${label} copied to clipboard!`, 'success');
        }).catch(() => fallbackCopy(text, label));
    } else {
        fallbackCopy(text, label);
    }
}

function fallbackCopy(text, label = 'Text') {
    const textArea = document.createElement('textarea');
    textArea.value = text;
    textArea.style.cssText = 'position: fixed; left: -999999px; top: -999999px;';
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    
    try {
        document.execCommand('copy');
        showToast(`${label} copied to clipboard!`, 'success');
    } catch (err) {
        showToast('Copy failed. Please select and copy manually.', 'error');
    }
    
    document.body.removeChild(textArea);
}

function clearCart() {
    const cartKeys = [
        'unifiedTireShopCart', 'tireShopCart', 'cart', 'cartItems', 
        'checkoutCart', 'paymentCartData', 'paymentCustomerData', 'checkoutCustomerInfo'
    ];
    
    cartKeys.forEach(key => {
        try {
            localStorage.removeItem(key);
            sessionStorage.removeItem(key);
        } catch (error) {
            console.error(`Error clearing ${key}:`, error);
        }
    });
    
    console.log('Cart and customer data cleared');
}

function saveOrderToHistory(orderId, otp, orderData) {
    try {
        const orderHistory = JSON.parse(localStorage.getItem('orderHistory') || '[]');
        const customerInfo = getCustomerInfo(orderData);
        
        const orderRecord = {
            orderId: orderId,
            date: new Date().toISOString(),
            items: orderData.items || [],
            total: orderData.summary?.total || 0,
            status: 'New',
            otp: otp,
            paymentMethod: orderData.paymentMethod || 'Unknown',
            pincode: orderData.pincode || 'Unknown',
            customerInfo: {
                name: customerInfo.name,
                email: customerInfo.email,
                phone: customerInfo.phone,
                address: customerInfo.address
            }
        };
        
        orderHistory.unshift(orderRecord);
        if (orderHistory.length > 20) orderHistory.splice(20);
        
        localStorage.setItem('orderHistory', JSON.stringify(orderHistory));
        console.log('Order saved to history');
    } catch (error) {
        console.error('Error saving order to history:', error);
    }
}

// Action Functions
function continueShopping() {
    window.location.href = 'index.php';
}

function printOrderConfirmation() {
    window.print();
}

function trackOrder() {
    const orderId = document.getElementById('orderIdDisplay')?.textContent || 'N/A';
    alert(`Tracking for Order ID: ${orderId}\nThis feature will be available soon!`);
}

// Event Listeners
function addEventListeners() {
    const orderIdElement = document.getElementById('orderIdDisplay');
    if (orderIdElement) {
        orderIdElement.style.cursor = 'pointer';
        orderIdElement.title = 'Click to copy Order ID';
        orderIdElement.addEventListener('click', function() {
            copyToClipboard(this.textContent, 'Order ID');
        });
    }

    const otpElement = document.getElementById('otpDisplay');
    if (otpElement) {
        otpElement.style.cursor = 'pointer';
        otpElement.title = 'Click to copy OTP';
        otpElement.addEventListener('click', function() {
            copyToClipboard(this.textContent, 'OTP');
        });
    }

    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.key === 'p') {
            e.preventDefault();
            printOrderConfirmation();
        }
        if (e.ctrlKey && e.key === 'h') {
            e.preventDefault();
            continueShopping();
        }
    });
}

// Main Initialization
async function initializeOrderConfirmation() {
    try {
        console.log('Initializing order confirmation...');
        
        // Get order data
        orderData = getOrderData();
        console.log('Order data loaded:', orderData);
        
        // Generate order ID and OTP
        const orderId = orderData.orderId || generateOrderId();
        const otp = orderData.otp || generateOTP();
        
        orderData.orderId = orderId;
        orderData.otp = otp;
        
        // Update order information in DOM
        const updateElement = (id, value) => {
            const element = document.getElementById(id);
            if (element) element.textContent = value;
        };

        updateElement('orderIdDisplay', orderId);
        updateElement('otpDisplay', otp);
        updateElement('paymentMethodDisplay', orderData.paymentMethod || 'Unknown');
        
        const orderDateEl = document.getElementById('orderDateDisplay');
        if (orderDateEl) {
            const orderDate = orderData.orderDate ? new Date(orderData.orderDate) : new Date();
            orderDateEl.textContent = formatDate(orderDate);
        }
        
        // Display order information
        displayCustomerInfo();
        displayOrderItems();
        updateOrderSummary();
        
        // Add interactivity
        addEventListeners();
        createCelebrationAnimation();
        
        // Show order confirmation message
        showToast('Order confirmed successfully!', 'success');
        
        // Save order and cleanup
        saveOrderToHistory(orderId, otp, orderData);
        // ✅ Save order to MySQL database (backend sync)
fetch('api/orders.php?action=save_order', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
        order_id: orderId,
        customer_name:
            orderData.customerInfo?.name ||
            `${orderData.customerInfo?.firstName || ''} ${orderData.customerInfo?.lastName || ''}`.trim(),
        customer_email: orderData.customerInfo?.email || '',
        customer_phone: orderData.customerInfo?.phone || '',
        customer_address: orderData.customerInfo?.address || '',
        customer_pincode: orderData.customerInfo?.pincode || '',
        items: orderData.items || [],
        subtotal: orderData.summary?.subtotal || 0,
        shipping: orderData.summary?.shipping || 0,
        total: orderData.summary?.total || 0,
        payment_method: orderData.paymentMethod || '',
        otp: otp
    })
}).catch(err => console.error('DB save failed:', err));
        setTimeout(() => clearCart(), 1000);
        
        // Clean up session storage
        sessionStorage.removeItem('completedOrder');
        
        console.log('Order confirmation initialized successfully');
        
    } catch (error) {
        console.error('Error initializing order confirmation:', error);
        showToast('There was an error loading your order confirmation. Please contact support.', 'error');
    }
}

// Debug function to help troubleshoot
function debugStorageData() {
    console.log('=== DEBUGGING STORAGE DATA ===');
    
    const allSessionKeys = Object.keys(sessionStorage);
    const allLocalKeys = Object.keys(localStorage);
    
    console.log('SessionStorage keys:', allSessionKeys);
    console.log('LocalStorage keys:', allLocalKeys);
    
    // Check for customer data
    const customerKeys = ['paymentCustomerData', 'checkoutCustomerInfo', 'customerInfo', 'customerEmail'];
    customerKeys.forEach(key => {
        const sessionData = sessionStorage.getItem(key);
        const localData = localStorage.getItem(key);
        
        if (sessionData) {
            console.log(`SessionStorage[${key}]:`, sessionData);
        }
        if (localData) {
            console.log(`LocalStorage[${key}]:`, localData);
        }
    });
    
    // Check for cart data
    const cartKeys = ['unifiedTireShopCart', 'checkoutCart', 'tireShopCart', 'cart'];
    cartKeys.forEach(key => {
        const sessionData = sessionStorage.getItem(key);
        const localData = localStorage.getItem(key);
        
        if (sessionData) {
            console.log(`SessionStorage[${key}]:`, sessionData);
        }
        if (localData) {
            console.log(`LocalStorage[${key}]:`, localData);
        }
    });
    
    console.log('=== END DEBUG ===');
}

// Call debug function in development
if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
    debugStorageData();
}

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeOrderConfirmation);
} else {
    initializeOrderConfirmation();
}
</script>
</body>
</html>