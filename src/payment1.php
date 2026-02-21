<?php
require_once "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Tire Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: white;
            min-height: 100vh;
            padding: 20px;
        }

        .payment-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            overflow: hidden;
            border: 2px solid #ff0000;
        }

        .payment-header {
            background: white;
            color: #000000;
            padding: 30px;
            text-align: center;
            border-bottom: 3px solid #ff0000;
        }

        .payment-header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            color: #ff0000;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .payment-content {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 30px;
            padding: 30px;
        }

        .order-summary {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 25px;
            height: fit-content;
            position: sticky;
            top: 20px;
            border: 2px solid #ff0000;
        }

        .order-summary h2 {
            color: #000000;
            margin-bottom: 20px;
            font-size: 1.5em;
            border-bottom: 2px solid #ff0000;
            padding-bottom: 10px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 60px;
            height: 60px;
            margin-right: 15px;
            border-radius: 8px;
            overflow: hidden;
            flex-shrink: 0;
            border: 1px solid #ff0000;
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
            color: #000000;
            margin-bottom: 5px;
        }

        .item-brand {
            color: #666;
            font-size: 0.9em;
            margin-bottom: 3px;
        }

        .item-specs {
            color: #888;
            font-size: 0.8em;
            margin-bottom: 5px;
        }

        .item-price-qty {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .item-qty {
            background: #ff0000;
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.8em;
        }

        .item-subtotal {
            font-weight: bold;
            color: #ff0000;
        }

        .summary-totals {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid #ff0000;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 5px 0;
        }

        .summary-row.total {
            font-size: 1.2em;
            font-weight: bold;
            color: #000000;
            border-top: 1px solid #ddd;
            padding-top: 15px;
            margin-top: 15px;
            background: #fff0f0;
            padding: 10px;
            border-radius: 5px;
        }

        .summary-row.dealer-discount {
            color: #28a745;
            font-weight: bold;
            background: #d4edda;
            padding: 5px 10px;
            border-radius: 5px;
            border: 1px solid #c3e6cb;
        }

        .shipping-info {
            background: #e8f4ff;
            border: 1px solid #007bff;
            border-radius: 5px;
            padding: 10px;
            margin: 10px 0;
            font-size: 0.9em;
            color: #0056b3;
        }

        .payment-form {
            background: white;
        }

        .form-section {
            margin-bottom: 30px;
        }

        .form-section h3 {
            color: #000000;
            margin-bottom: 15px;
            font-size: 1.3em;
            border-left: 4px solid #ff0000;
            padding-left: 15px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #000000;
            font-weight: 500;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1em;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #ff0000;
            box-shadow: 0 0 5px rgba(255, 0, 0, 0.3);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .payment-methods {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .payment-method {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
        }

        .payment-method:hover {
            border-color: #ff0000;
            background: #fff0f0;
            transform: translateY(-2px);
        }

        .payment-method.selected {
            border-color: #ff0000;
            background: #ffebeb;
            box-shadow: 0 5px 15px rgba(255, 0, 0, 0.2);
        }

        .payment-method i {
            font-size: 2em;
            margin-bottom: 10px;
            color: #ff0000;
        }

        .dealer-email-section {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            margin-top: 15px;
        }

        .dealer-discount-status {
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
            font-weight: bold;
            display: none;
        }

        .dealer-discount-status.checking {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            display: block;
        }

        .dealer-discount-status.eligible {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            display: block;
        }

        .dealer-discount-status.not-eligible {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            display: block;
        }

        .dealer-discount-status.error {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            display: block;
        }

        .discount-details {
            margin-top: 10px;
            padding: 10px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 5px;
            font-size: 0.9em;
        }

        .btn-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            flex: 1;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            font-size: 1.1em;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(135deg, #ff0000, #cc0000);
            color: white;
            border: 2px solid #ff0000;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(255, 0, 0, 0.3);
            background: linear-gradient(135deg, #cc0000, #990000);
        }

        .btn-secondary {
            background: #000000;
            color: white;
            border: 2px solid #000000;
        }

        .btn-secondary:hover {
            background: #333333;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .empty-cart {
            text-align: center;
            padding: 50px;
            color: #666;
        }

        .empty-cart i {
            font-size: 4em;
            margin-bottom: 20px;
            color: #ff0000;
        }

        .empty-cart h3 {
            margin-bottom: 10px;
            color: #000000;
        }

        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #ff0000;
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            z-index: 1000;
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.3s ease;
            border: 2px solid #000000;
        }

        .toast.show {
            opacity: 1;
            transform: translateX(0);
        }

        @media (max-width: 768px) {
            .payment-content {
                grid-template-columns: 1fr;
                gap: 20px;
                padding: 20px;
            }

            .order-summary {
                order: -1;
                position: static;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .payment-methods {
                grid-template-columns: 1fr 1fr;
            }

            .btn-group {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <div class="payment-header">
            <h1><i class="fas fa-credit-card"></i> Secure Checkout</h1>
            <p>Complete your tire purchase securely</p>
        </div>

        <div class="payment-content">
            <!-- Payment Form -->
            <div class="payment-form">
                <form id="paymentForm">
                    <!-- Customer Information -->
                    <div class="form-section">
                        <h3><i class="fas fa-user"></i> Customer Information</h3>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="firstName">First Name *</label>
                                <input type="text" id="firstName" name="firstName" required>
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name *</label>
                                <input type="text" id="lastName" name="lastName" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>
                    </div>

                    <!-- Shipping Address -->
                    <div class="form-section">
                        <h3><i class="fas fa-truck"></i> Shipping Address</h3>
                        <div class="form-group">
                            <label for="address">Street Address *</label>
                            <input type="text" id="address" name="address" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="city">City *</label>
                                <input type="text" id="city" name="city" required>
                            </div>
                            <div class="form-group">
                                <label for="state">State *</label>
                                <input type="text" id="state" name="state" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="pincode">PIN Code *</label>
                                <input type="text" id="pincode" name="pincode" required maxlength="6" pattern="[0-9]{6}">
                                <small style="color: #666;">Enter your 6-digit PIN code to calculate shipping cost</small>
                            </div>
                            <div class="form-group">
                                <label for="country">Country *</label>
                                <select id="country" name="country" required>
                                    <option value="India">India</option>
                                    <option value="USA">USA</option>
                                    <option value="UK">UK</option>
                                    <option value="Canada">Canada</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Dealer Discount Section -->
                    <div class="form-section">
                        <h3><i class="fas fa-percentage"></i> Dealer Discount</h3>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" id="dealerDiscountCheck" name="dealerDiscountCheck"> 
                                Check for Dealer Discount (Bridgestone)
                            </label>
                            <small style="color: #666; display: block; margin-top: 5px;">
                                Dealers who purchased 24+ Bridgestone tires in the last month get ₹200 discount
                            </small>
                        </div>
                        
                        <div id="dealerEmailSection" class="dealer-email-section" style="display: none;">
                            <div class="form-group">
                                <label for="dealerEmail">Dealer Email Address *</label>
                                <input type="email" id="dealerEmail" name="dealerEmail" placeholder="Enter your registered dealer email">
                                <small id="dealerEmailHelper" style="color: #666;">
                                    Enter your email to check eligibility for Bridgestone dealer discount
                                </small>
                            </div>
                            
                            <button type="button" id="checkDealerEligibility" class="btn btn-secondary" style="margin: 10px 0;">
                                <i class="fas fa-search"></i> Check Discount Eligibility
                            </button>
                            
                            <div id="dealerDiscountStatus" class="dealer-discount-status"></div>
                        </div>
                    </div>

                    <!-- Order Notes -->
                    <div class="form-section">
                        <h3><i class="fas fa-comment"></i> Order Notes (Optional)</h3>
                        <div class="form-group">
                            <label for="orderNotes">Special Instructions</label>
                            <textarea id="orderNotes" name="orderNotes" rows="3" placeholder="Any special delivery instructions or notes..."></textarea>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Order Summary -->
            <div class="order-summary">
                <h2><i class="fas fa-shopping-cart"></i> Order Summary</h2>
                
                <div id="cartItemsDisplay">
                    <!-- Cart items will be populated here -->
                </div>

                <div class="summary-totals">
                    <div class="summary-row">
                        <span>Subtotal:</span>
                        <span id="subtotalAmount">₹0.00</span>
                    </div>
                    <div class="summary-row">
                        <span>Shipping:</span>
                        <span id="shippingAmount">₹0.00</span>
                    </div>
                    <div id="dealerDiscountRow" class="summary-row dealer-discount" style="display: none;">
                        <span>Dealer Discount:</span>
                        <span id="dealerDiscountAmount">-₹0.00</span>
                    </div>
                    <div id="shippingInfo" class="shipping-info" style="display: none;">
                        <i class="fas fa-info-circle"></i> <span id="shippingDetails"></span>
                    </div>
                    <div class="summary-row total">
                        <span>Total:</span>
                        <span id="totalAmount">₹0.00</span>
                    </div>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary" onclick="processPayment()">
                        <i class="fas fa-lock"></i> Complete Payment
                    </button>
                    <a href="cart1.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Cart
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <div id="toast" class="toast"></div>
    
    <script>
// =================================================================
// SHARED CONFIGURATION AND UTILITIES
// =================================================================

// GST rates configuration for different brands and specific products
const gstRates = {
    'ascenso': 18, // Ascenso brand has 18% GST by default
    'default': 28  // All other brands have 28% GST
};

// Special GST rates for specific tire models (28% GST exceptions)
const specialGSTProducts = {
    'ascenso': {
        'bosstn20': 28,  // matches "BOSS TN 20" or "boss tn 20"
        'bosstr21': 28,  // matches "boss tn21" or "BOSS TN21"
        'bosstr20': 28,  // matches "BOSS TR 20"
        'bosspr21': 28,  // matches "boss pr21" 
    }
};

// PIN code to distance mapping (sample data - you can expand this)
const pinCodeDistances = {
    // Hapur and nearby areas (0-10 km)
    '245101': 0,  // Hapur main
    '245102': 5,  // Hapur nearby
    '245103': 8,  // Hapur outskirts
    
    // 10-20 km zone
    '201204': 15, // Dadri
    '203001': 18, // Bulandshahr nearby
    '245204': 12, // Garh
    
    // 20-30 km zone
    '203002': 25, // Bulandshahr
    '201301': 28, // Noida Extension
    '201310': 22, // Greater Noida West
    
    // 30-40 km zone
    '201302': 35, // Noida
    '201311': 32, // Greater Noida
    '122001': 38, // Gurgaon parts
    
    // 40-60 km zone
    '110001': 45, // Delhi Central
    '110085': 48, // Delhi NCR
    '201001': 55, // Ghaziabad extended
    '121001': 58, // Faridabad
    
    // 60+ km zone (eligible for free delivery with 14+ tires)
    '400001': 1200, // Mumbai (very far)
    '560001': 2100, // Bangalore (very far)
    '700001': 1400, // Kolkata (very far)
    '600001': 2000, // Chennai (very far)
    '110020': 65, // Delhi far areas
    '122002': 70, // Gurgaon extended
    '201014': 75, // Ghaziabad far
    '282001': 80, // Agra
};

// =================================================================
// PAST ORDERS MANAGEMENT
// =================================================================

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

    // Only display if we're on the past orders page
    if (document.getElementById('ordersContainer')) {
        displayPastOrders();
    }
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
    if (!container) return;
    
    const sortFilter = document.getElementById('sortFilter')?.value || 'newest';
    const dateFilter = document.getElementById('dateFilter')?.value || '';

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
            <p><strong>OTP used:</strong> ${order.otp || 'N/A'}</p>
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

// =================================================================
// DEALER DISCOUNT FUNCTIONALITY - IMPROVED
// =================================================================

// FIXED: Function to get actual dealer orders from localStorage
function getDealerOrdersFromHistory(email) {
    if (!email) return [];
    
    try {
        // Get all order history from localStorage
        const savedOrders = localStorage.getItem('orderHistory');
        if (!savedOrders) return [];
        
        const allOrders = JSON.parse(savedOrders);
        
        // Filter orders for this dealer email (case-insensitive)
        const dealerOrders = allOrders.filter(order => {
            return order.customerInfo && 
                   order.customerInfo.email && 
                   order.customerInfo.email.toLowerCase() === email.toLowerCase() &&
                   (order.status === 'Delivered' || order.status === 'Completed' || 
                    order.trackingStatus === 'Delivered' || order.trackingStatus === 'Completed');
        });
        
        console.log(`Found ${dealerOrders.length} completed orders for dealer: ${email}`);
        
        // Convert to the expected format for dealer discount calculation
        const formattedOrders = [];
        
        dealerOrders.forEach(order => {
            if (order.items && Array.isArray(order.items)) {
                order.items.forEach(item => {
                    if (item.brand && item.brand.toLowerCase() === 'bridgestone') {
                        formattedOrders.push({
                            dealerEmail: email,
                            orderDate: order.date || order.orderDate,
                            brand: item.brand,
                            quantity: item.qty || item.quantity || 1,
                            orderId: order.orderId,
                            itemName: item.name
                        });
                    }
                });
            }
        });
        
        console.log(`Found ${formattedOrders.length} Bridgestone tire entries for dealer:`, formattedOrders);
        return formattedOrders;
        
    } catch (error) {
        console.error('Error getting dealer orders from history:', error);
        return [];
    }
}

// IMPROVED: Function to check dealer discount eligibility using actual order history
function checkDealerDiscountEligibility(email) {
    return new Promise((resolve) => {
        // Simulate API call delay
        setTimeout(() => {
            const oneMonthAgo = new Date();
            oneMonthAgo.setMonth(oneMonthAgo.getMonth() - 1);
            
            // Get actual dealer orders from localStorage
            const dealerOrders = getDealerOrdersFromHistory(email);
            
            // Filter orders for the last month
            const recentOrders = dealerOrders.filter(order => {
                const orderDate = new Date(order.orderDate);
                return orderDate >= oneMonthAgo && order.brand.toLowerCase() === 'bridgestone';
            });
            
            // Calculate total Bridgestone tires purchased
            const totalBridgestoneTires = recentOrders.reduce((sum, order) => sum + order.quantity, 0);
            
            console.log(`Dealer eligibility check for ${email}:`);
            console.log(`- Total Bridgestone tires in last month: ${totalBridgestoneTires}`);
            console.log(`- Recent orders:`, recentOrders);
            
            const result = {
                isEligible: totalBridgestoneTires >= 24,
                totalTires: totalBridgestoneTires,
                orders: recentOrders,
                discountAmount: totalBridgestoneTires >= 24 ? 200 : 0,
                threshold: 24
            };
            
            resolve(result);
        }, 1500); // Simulate 1.5 second API call
    });
}

// =================================================================
// PAYMENT PAGE FUNCTIONALITY
// =================================================================

let paymentCartData = [];
let selectedPaymentMethod = '';
let dealerDiscountAmount = 0;
let isDealerEligible = false;
let dealerEmail = '';

// Function to normalize tire names for comparison
function normalizeTireName(tireName) {
    if (!tireName) return '';
    return tireName.toLowerCase()
                  .replace(/\s+/g, '')
                  .replace(/[^a-z0-9]/g, '');
}

// Function to get GST rate for a brand and specific tire model
function getGSTRate(brand, tireName = '') {
    if (!brand) return gstRates.default;
    
    const brandLower = brand.toLowerCase().trim();
    const normalizedTireName = normalizeTireName(tireName);
    
    if (specialGSTProducts[brandLower] && normalizedTireName) {
        const specialRate = specialGSTProducts[brandLower][normalizedTireName];
        if (specialRate) {
            return specialRate;
        }
    }
    
    return gstRates[brandLower] || gstRates.default;
}

// Function to calculate GST amount for an item
function calculateItemGST(price, quantity, brand, tireName = '') {
    const gstRate = getGSTRate(brand, tireName);
    const subtotal = price * quantity;
    const gstAmount = (subtotal * gstRate) / 100;
    return gstAmount;
}

// Function to calculate total GST for cart
function calculateTotalGST(cartData = paymentCartData) {
    return cartData.reduce((totalGST, item) => {
        return totalGST + calculateItemGST(item.price, item.qty, item.brand, item.name);
    }, 0);
}

// Function to get GST breakdown by brand and specific models
function getGSTBreakdown(cartData = paymentCartData) {
    const breakdown = {};
    
    cartData.forEach(item => {
        const brand = item.brand || 'Unknown';
        const tireName = item.name || '';
        const gstRate = getGSTRate(brand, tireName);
        const itemSubtotal = item.price * item.qty;
        const itemGST = calculateItemGST(item.price, item.qty, item.brand, item.name);
        
        let breakdownKey = brand;
        const brandLower = brand.toLowerCase().trim();
        const normalizedTireName = normalizeTireName(tireName);
        
        const hasSpecialRate = specialGSTProducts[brandLower] && 
                              normalizedTireName && 
                              specialGSTProducts[brandLower][normalizedTireName];
        
        if (hasSpecialRate) {
            breakdownKey = `${brand} (${tireName})`;
        }
        
        if (!breakdown[breakdownKey]) {
            breakdown[breakdownKey] = {
                gstRate: gstRate,
                subtotal: 0,
                gstAmount: 0,
                itemCount: 0,
                isSpecialRate: hasSpecialRate ? true : false
            };
        }
        
        breakdown[breakdownKey].subtotal += itemSubtotal;
        breakdown[breakdownKey].gstAmount += itemGST;
        breakdown[breakdownKey].itemCount += item.qty;
    });
    
    return breakdown;
}

// Function to calculate Bridgestone tire count in current cart
function getBridgestoneCountInCart() {
    return paymentCartData
        .filter(item => item.brand && item.brand.toLowerCase() === 'bridgestone')
        .reduce((sum, item) => sum + item.qty, 0);
}

// Function to check if dealer discount can be applied to current order
function canApplyDealerDiscount() {
    const bridgestoneCount = getBridgestoneCountInCart();
    return isDealerEligible && bridgestoneCount > 0;
}

// Function to calculate dealer discount amount
function calculateDealerDiscount() {
    if (!canApplyDealerDiscount()) {
        return 0;
    }
    return 200; // Fixed ₹200 discount for eligible dealers
}

// Function to display cart items
function displayCartItems() {
    const container = document.getElementById('cartItemsDisplay');
    
    if (!container) return;
    
    if (paymentCartData.length === 0) {
        container.innerHTML = `
            <div class="empty-cart">
                <i class="fas fa-shopping-cart"></i>
                <h3>No items in cart</h3>
                <p>Go back to shop and add some tires!</p>
                <a href="index.php" class="btn btn-primary" style="margin-top: 20px;">
                    <i class="fas fa-shopping-bag"></i> Continue Shopping
                </a>
            </div>
        `;
        return;
    }

    container.innerHTML = '';
    
    paymentCartData.forEach(item => {
        const gstRate = getGSTRate(item.brand, item.name);
        const itemSubtotal = item.price * item.qty;
        const itemGST = calculateItemGST(item.price, item.qty, item.brand, item.name);
        const itemTotal = itemSubtotal + itemGST;
        
        const brandLower = (item.brand || '').toLowerCase().trim();
        const normalizedTireName = normalizeTireName(item.name);
        const isSpecialGST = specialGSTProducts[brandLower] && 
                            normalizedTireName && 
                            specialGSTProducts[brandLower][normalizedTireName];
        
        const cartItem = document.createElement('div');
        cartItem.className = 'cart-item';
        cartItem.innerHTML = `
            <div class="item-image">
                <img src="${item.image || 'https://via.placeholder.com/100x100/333/fff?text=Tire'}" alt="${item.name}" onerror="this.src='https://via.placeholder.com/100x100/333/fff?text=Tire'">
            </div>
            <div class="item-details">
                <div class="item-name">${item.name}</div>
                <div class="item-brand">${item.brand}</div>
                <div class="item-specs">${item.specs}</div>
                <div class="item-price-qty">
                    <span>₹${item.price.toFixed(2)} each (excl. GST)</span>
                    <span class="item-qty">Qty: ${item.qty}</span>
                </div>
                <div class="item-pricing">
                    <div class="price-line">Subtotal: ₹${itemSubtotal.toFixed(2)}</div>
                    <div class="gst-line">
                        GST (${gstRate}%): ₹${itemGST.toFixed(2)}
                        ${isSpecialGST ? '<span class="special-gst-badge">Special Rate</span>' : ''}
                    </div>
                    <div class="item-subtotal"><strong>Total: ₹${itemTotal.toFixed(2)}</strong></div>
                </div>
            </div>
        `;
        container.appendChild(cartItem);
    });
}

// Function to check if PIN code is valid (6 digits)
function isValidPinCode(pincode) {
    return pincode && pincode.length === 6 && /^\d{6}$/.test(pincode);
}

// Function to validate email format
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Function to validate phone number (Indian format)
function isValidPhone(phone) {
    const phoneRegex = /^(\+91|91)?[6-9]\d{9}$/;
    return phoneRegex.test(phone.replace(/\s+/g, ''));
}

// Function to collect customer details from form
function getCustomerDetails() {
    const firstName = document.getElementById('firstName')?.value.trim() || '';
    const lastName = document.getElementById('lastName')?.value.trim() || '';
    const email = document.getElementById('email')?.value.trim() || '';
    const phone = document.getElementById('phone')?.value.trim() || '';
    const address = document.getElementById('address')?.value.trim() || '';
    const pincode = document.getElementById('pincode')?.value.trim() || '';
    
    return {
        firstName,
        lastName,
        name: `${firstName} ${lastName}`.trim(),
        email,
        phone,
        address,
        pincode
    };
}

// Function to validate customer details
function validateCustomerDetails() {
    const details = getCustomerDetails();
    const errors = [];
    
    if (!details.firstName) {
        errors.push('First name is required');
    }
    
    if (!details.lastName) {
        errors.push('Last name is required');
    }
    
    if (!details.email) {
        errors.push('Email is required');
    } else if (!isValidEmail(details.email)) {
        errors.push('Please enter a valid email address');
    }
    
    if (!details.phone) {
        errors.push('Phone number is required');
    } else if (!isValidPhone(details.phone)) {
        errors.push('Please enter a valid Indian phone number');
    }
    
    if (!details.address) {
        errors.push('Address is required');
    }
    
    if (!details.pincode) {
        errors.push('PIN code is required');
    } else if (!isValidPinCode(details.pincode)) {
        errors.push('Please enter a valid 6-digit PIN code');
    }
    
    return {
        isValid: errors.length === 0,
        errors,
        details
    };
}

// Function to check if customer qualifies for free shipping (14+ tires of same brand)
function checkFreeShippingEligibility(cartData) {
    if (!cartData || cartData.length === 0) return false;
    
    const brandCounts = {};
    cartData.forEach(item => {
        const brand = item.brand || 'Unknown';
        brandCounts[brand] = (brandCounts[brand] || 0) + item.qty;
    });
    
    return Object.values(brandCounts).some(count => count >= 14);
}

// Function to calculate cost per tire based on distance
function calculateCostPerTire(distance) {
    if (distance <= 10) {
        return 50;
    } else if (distance <= 20) {
        return 100;
    } else if (distance <= 30) {
        return 150;
    } else if (distance <= 40) {
        return 200;
    } else if (distance <= 50) {
        return 300;
    } else if (distance <= 60) {
        return 400;
    } else {
        const extraDistance = distance - 60;
        const extraTiers = Math.ceil(extraDistance / 10);
        return 400 + (extraTiers * 100);
    }
}

// Function to calculate shipping cost
function calculateShippingCost(pincode, tireCount, cartData = paymentCartData) {
    if (!isValidPinCode(pincode)) {
        return 0;
    }
    
    const distance = pinCodeDistances[pincode];
    
    if (distance === undefined) {
        const defaultDistance = 100;
        const defaultCostPerTire = calculateCostPerTire(defaultDistance);
        
        if (defaultDistance > 60 && checkFreeShippingEligibility(cartData)) {
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
                    totalShippingCost += count * defaultCostPerTire;
                }
            });
            
            return totalShippingCost;
        }
        
        return tireCount * defaultCostPerTire;
    }
    
    const costPerTire = calculateCostPerTire(distance);
    
    if (distance > 60 && checkFreeShippingEligibility(cartData)) {
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

// Function to get distance info for display
function getDistanceInfo(pincode) {
    if (!isValidPinCode(pincode)) {
        return 'Please enter your 6-digit PIN code to calculate shipping';
    }
    
    const distance = pinCodeDistances[pincode];
    
    if (distance === undefined) {
        return 'Distance calculation unavailable for this PIN code (using default 100km rate)';
    }
    
    return `Distance from Hapur: ${distance} km`;
}

// Function to get shipping details
function getShippingDetails(pincode, cartData = paymentCartData) {
    if (!isValidPinCode(pincode)) {
        return 'Enter your PIN code to see shipping details';
    }
    
    const distance = pinCodeDistances[pincode] || 100;
    const tireCount = cartData.reduce((sum, item) => sum + item.qty, 0);
    const shippingCost = calculateShippingCost(pincode, tireCount, cartData);
    const costPerTire = calculateCostPerTire(distance);
    
    let details = getDistanceInfo(pincode);
    
    if (distance > 60 && checkFreeShippingEligibility(cartData)) {
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
            details += ' | FREE (60km+): ' + freeBrands.join(', ') + ' | PAID: ' + paidBrands.join(', ');
        } else if (freeBrands.length > 0) {
            details += ' | FREE SHIPPING (60km+): ' + freeBrands.join(', ');
        } else {
            details += ` | ₹${costPerTire} per tire`;
        }
    } else if (shippingCost > 0) {
        details += ` | ₹${costPerTire} per tire`;
        
        if (distance > 60) {
            details += ' (Free shipping available with 14+ tires of same brand)';
        }
    } else {
        details += ' | Free local delivery';
    }
    
    return details;
}

// FIXED: Function to get payment page data - now properly loads from cart
function getPaymentPageData() {
    console.log('Loading payment page data...');
    
    // First, try to get cart data from URL parameters (from checkout redirect)
    const urlParams = new URLSearchParams(window.location.search);
    const cartData = urlParams.get('cart');
    
    if (cartData) {
        try {
            const parsedData = JSON.parse(decodeURIComponent(cartData));
            console.log('Loaded cart from URL:', parsedData);
            return parsedData;
        } catch (e) {
            console.error('Error parsing cart data from URL:', e);
        }
    }
    
    // Second, try sessionStorage (checkoutCart)
    const savedCheckoutCart = sessionStorage.getItem('checkoutCart');
    if (savedCheckoutCart) {
        try {
            const parsedData = JSON.parse(savedCheckoutCart);
            console.log('Loaded cart from sessionStorage (checkoutCart):', parsedData);
            return parsedData;
        } catch (e) {
            console.error('Error loading cart from sessionStorage (checkoutCart):', e);
        }
    }
    
    // Third, try the unified cart from localStorage/sessionStorage
    let savedCart = localStorage.getItem('unifiedTireShopCart');
    if (!savedCart) {
        savedCart = sessionStorage.getItem('unifiedTireShopCart');
    }
    
    if (savedCart) {
        try {
            const parsedData = JSON.parse(savedCart);
            console.log('Loaded cart from unified storage:', parsedData);
            return parsedData;
        } catch (e) {
            console.error('Error loading cart from unified storage:', e);
        }
    }
    
    // If no cart data found, return empty array
    console.warn('No cart data found, returning empty array');
    return [];
}

// Function to get checkout summary with dealer discount
function getCheckoutSummary() {
    const customerDetails = getCustomerDetails();
    const pincode = customerDetails.pincode;
    
    const subtotal = paymentCartData.reduce((sum, item) => sum + (item.price * item.qty), 0);
    const itemCount = paymentCartData.reduce((sum, item) => sum + item.qty, 0);
    
    const totalGST = calculateTotalGST(paymentCartData);
    const gstBreakdown = getGSTBreakdown(paymentCartData);
    
    const shipping = isValidPinCode(pincode) ? calculateShippingCost(pincode, itemCount, paymentCartData) : 0;
    
    // Calculate dealer discount
    const dealerDiscount = calculateDealerDiscount();
    
    const total = subtotal + totalGST + shipping - dealerDiscount;
    
    return {
        items: paymentCartData,
        subtotal: subtotal,
        gstAmount: totalGST,
        gstBreakdown: gstBreakdown,
        itemCount: itemCount,
        shipping: shipping,
        dealerDiscount: dealerDiscount,
        total: total,
        customerInfo: customerDetails
    };
}

// Function to update order summary
function updateOrderSummary() {
    const summary = getCheckoutSummary();
    const customerDetails = getCustomerDetails();
    
    const subtotalElement = document.getElementById('subtotalAmount');
    const shippingElement = document.getElementById('shippingAmount');
    const dealerDiscountElement = document.getElementById('dealerDiscountAmount');
    const dealerDiscountRow = document.getElementById('dealerDiscountRow');
    const totalElement = document.getElementById('totalAmount');
    
    if (subtotalElement) subtotalElement.textContent = `₹${summary.subtotal.toFixed(2)}`;
    if (shippingElement) shippingElement.textContent = `₹${summary.shipping.toFixed(2)}`;
    if (totalElement) totalElement.textContent = `₹${summary.total.toFixed(2)}`;
    
    // Update dealer discount display
    if (summary.dealerDiscount > 0) {
        if (dealerDiscountElement) dealerDiscountElement.textContent = `-₹${summary.dealerDiscount.toFixed(2)}`;
        if (dealerDiscountRow) dealerDiscountRow.style.display = 'flex';
    } else {
        if (dealerDiscountRow) dealerDiscountRow.style.display = 'none';
    }
    
    const shippingInfo = document.getElementById('shippingInfo');
    const shippingDetails = document.getElementById('shippingDetails');
    
    if (shippingInfo && shippingDetails) {
        shippingInfo.style.display = 'block';
        
        if (!isValidPinCode(customerDetails.pincode)) {
            shippingDetails.textContent = 'Please enter your 6-digit PIN code to calculate shipping charges';
            shippingDetails.style.color = '#ff6b35';
            shippingDetails.style.fontWeight = 'bold';
            shippingDetails.style.fontStyle = 'italic';
        } else {
            const details = getShippingDetails(customerDetails.pincode, paymentCartData);
            shippingDetails.textContent = details;
            
            const distance = pinCodeDistances[customerDetails.pincode] || 100;
            if (distance > 60 && checkFreeShippingEligibility(paymentCartData)) {
                const brandCounts = {};
                paymentCartData.forEach(item => {
                    const brand = item.brand || 'Unknown';
                    brandCounts[brand] = (brandCounts[brand] || 0) + item.qty;
                });
                
                const hasFreeBrands = Object.values(brandCounts).some(count => count >= 14);
                
                if (hasFreeBrands) {
                    shippingDetails.style.color = '#28a745';
                    shippingDetails.style.fontWeight = 'bold';
                    shippingDetails.style.fontStyle = 'normal';
                } else {
                    shippingDetails.style.color = '';
                    shippingDetails.style.fontWeight = '';
                    shippingDetails.style.fontStyle = 'normal';
                }
            } else {
                shippingDetails.style.color = '';
                shippingDetails.style.fontWeight = '';
                shippingDetails.style.fontStyle = 'normal';
            }
        }
    }
}

// IMPROVED: Setup dealer discount functionality
function setupDealerDiscount() {
    const dealerDiscountCheck = document.getElementById('dealerDiscountCheck');
    const dealerEmailSection = document.getElementById('dealerEmailSection');
    const dealerEmailInput = document.getElementById('dealerEmail');
    const checkEligibilityBtn = document.getElementById('checkDealerEligibility');
    const dealerDiscountStatus = document.getElementById('dealerDiscountStatus');
    
    if (dealerDiscountCheck) {
        dealerDiscountCheck.addEventListener('change', function() {
            if (this.checked) {
                dealerEmailSection.style.display = 'block';
            } else {
                dealerEmailSection.style.display = 'none';
                // Reset dealer discount
                isDealerEligible = false;
                dealerDiscountAmount = 0;
                dealerEmail = '';
                if (dealerDiscountStatus) dealerDiscountStatus.style.display = 'none';
                updateOrderSummary();
            }
        });
    }
    
    if (checkEligibilityBtn) {
        checkEligibilityBtn.addEventListener('click', async function() {
            const email = dealerEmailInput?.value.trim();
            
            if (!email) {
                showToast('Please enter dealer email address', 'error');
                return;
            }
            
            if (!isValidEmail(email)) {
                showToast('Please enter a valid email address', 'error');
                return;
            }
            
            // Show checking status
            if (dealerDiscountStatus) {
                dealerDiscountStatus.style.display = 'block';
                dealerDiscountStatus.className = 'dealer-discount-status checking';
                dealerDiscountStatus.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Checking dealer eligibility...';
            }
            
            try {
                const result = await checkDealerDiscountEligibility(email);
                
                if (result.isEligible) {
                    isDealerEligible = true;
                    dealerDiscountAmount = result.discountAmount;
                    dealerEmail = email;
                    
                    const bridgestoneInCart = getBridgestoneCountInCart();
                    
                    if (dealerDiscountStatus) {
                        dealerDiscountStatus.className = 'dealer-discount-status eligible';
                        dealerDiscountStatus.innerHTML = `
                            <i class="fas fa-check-circle"></i> 
                            <strong>Eligible for Dealer Discount!</strong>
                            <div class="discount-details">
                                • You purchased ${result.totalTires} Bridgestone tires in the last month
                                • ₹${result.discountAmount} discount available
                                ${bridgestoneInCart > 0 ? 
                                    `<br>• Applied to ${bridgestoneInCart} Bridgestone tire(s) in your cart` : 
                                    '<br>• Add Bridgestone tires to your cart to apply discount'
                                }
                            </div>
                        `;
                    }
                    
                    if (bridgestoneInCart > 0) {
                        showToast('Dealer discount applied successfully!', 'success');
                    } else {
                        showToast('Dealer discount available - add Bridgestone tires to apply', 'info');
                    }
                } else {
                    isDealerEligible = false;
                    dealerDiscountAmount = 0;
                    
                    if (dealerDiscountStatus) {
                        dealerDiscountStatus.className = 'dealer-discount-status not-eligible';
                        dealerDiscountStatus.innerHTML = `
                            <i class="fas fa-times-circle"></i> 
                            <strong>Not Eligible for Dealer Discount</strong>
                            <div class="discount-details">
                                • You purchased ${result.totalTires} Bridgestone tires in the last month
                                • Need ${result.threshold - result.totalTires} more tires to qualify
                                • Purchase 24+ Bridgestone tires in a month to get ₹200 discount
                            </div>
                        `;
                    }
                    
                    showToast('Not eligible for dealer discount', 'warning');
                }
                
                updateOrderSummary();
                
            } catch (error) {
                console.error('Error checking dealer eligibility:', error);
                
                if (dealerDiscountStatus) {
                    dealerDiscountStatus.className = 'dealer-discount-status error';
                    dealerDiscountStatus.innerHTML = `
                        <i class="fas fa-exclamation-triangle"></i> 
                        <strong>Error checking eligibility</strong>
                        <div class="discount-details">
                            Please try again or contact support if the issue persists.
                        </div>
                    `;
                }
                
                showToast('Error checking dealer eligibility', 'error');
            }
        });
    }
}

// Payment method selection
function setupPaymentMethods() {
    const paymentMethods = document.querySelectorAll('.payment-method');
    const cardDetails = document.getElementById('cardDetails');
    
    paymentMethods.forEach(method => {
        method.addEventListener('click', function() {
            paymentMethods.forEach(m => m.classList.remove('selected'));
            this.classList.add('selected');
            selectedPaymentMethod = this.dataset.method;
            
            if (cardDetails) {
                if (selectedPaymentMethod === 'card') {
                    cardDetails.style.display = 'block';
                } else {
                    cardDetails.style.display = 'none';
                }
            }
        });
    });
}

// Process payment function
function processPayment() {
    if (paymentCartData.length === 0) {
        showToast('No items in cart!', 'error');
        return;
    }

    const validation = validateCustomerDetails();
    if (!validation.isValid) {
        showToast(validation.errors[0], 'error');
        return;
    }

    const form = document.getElementById('paymentForm');
    if (form && !form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const customerDetails = validation.details;
    const orderSummary = getCheckoutSummary();

    const orderDetails = {
        items: paymentCartData,
        summary: orderSummary,
        paymentMethod: 'razorpay',
        pincode: customerDetails.pincode,
        orderDate: new Date().toISOString(),
        orderId: 'ORD-' + Date.now(),
        customerInfo: {
            firstName: customerDetails.firstName,
            lastName: customerDetails.lastName,
            name: customerDetails.name,
            email: customerDetails.email,
            phone: customerDetails.phone,
            address: customerDetails.address
        },
        shippingAddress: customerDetails.address,
        dealerDiscount: {
            applied: isDealerEligible && orderSummary.dealerDiscount > 0,
            amount: orderSummary.dealerDiscount,
            dealerEmail: dealerEmail
        },
        gstDetails: {
            totalGST: orderSummary.gstAmount,
            gstBreakdown: orderSummary.gstBreakdown
        }
    };

    initializeRazorpayPayment(orderDetails);
}

// Initialize Razorpay payment
function initializeRazorpayPayment(orderDetails) {
    showToast('Initializing payment...', 'info');

    const amountInPaise = Math.round(orderDetails.summary.total * 100);

    const options = {
        key: 'rzp_live_R5zGQD6WM0v8pb',
        amount: amountInPaise,
        currency: 'INR',
        name: 'Your Tire Shop',
        description: `Order #${orderDetails.orderId}`,
        order_id: '',
        image: '/path/to/your/logo.png',
        
        prefill: {
            name: orderDetails.customerInfo.name,
            email: orderDetails.customerInfo.email,
            contact: orderDetails.customerInfo.phone
        },
        
        billing_address: {
            name: orderDetails.customerInfo.name,
            line1: orderDetails.shippingAddress,
            zipcode: orderDetails.pincode,
            state: 'Your State',
            country: 'India'
        },
        
        notes: {
            order_id: orderDetails.orderId,
            gst_amount: orderDetails.gstDetails.totalGST,
            items_count: orderDetails.items.length,
            dealer_discount: orderDetails.dealerDiscount.amount
        },
        
        theme: {
            color: '#3399cc'
        },
        
        modal: {
            ondismiss: function() {
                showToast('Payment cancelled by user', 'warning');
            }
        },
        
        handler: function(response) {
            handlePaymentSuccess(response, orderDetails);
        }
    };

    const rzp = new Razorpay(options);
    
    rzp.on('payment.failed', function(response) {
        handlePaymentFailure(response);
    });
    
    rzp.open();
}

// Handle successful payment
function handlePaymentSuccess(razorpayResponse, orderDetails) {
    showToast('Payment successful! Verifying...', 'success');
    
    orderDetails.razorpayDetails = {
        paymentId: razorpayResponse.razorpay_payment_id,
        orderId: razorpayResponse.razorpay_order_id,
        signature: razorpayResponse.razorpay_signature
    };
    
    verifyPaymentSignature(razorpayResponse, orderDetails);
}

// Verify payment signature
function verifyPaymentSignature(razorpayResponse, orderDetails) {
    const verificationData = {
        razorpay_order_id: razorpayResponse.razorpay_order_id,
        razorpay_payment_id: razorpayResponse.razorpay_payment_id,
        razorpay_signature: razorpayResponse.razorpay_signature
    };
    
    setTimeout(() => {
        completeOrder(orderDetails);
    }, 1000);
}

// Complete the order after successful payment verification
function completeOrder(orderDetails) {
    // Store completed order
    sessionStorage.setItem('completedOrder', JSON.stringify(orderDetails));
    
    // IMPROVED: Also store in order history for future dealer discount calculations
    const existingOrderHistory = localStorage.getItem('orderHistory');
    let orderHistory = [];
    
    if (existingOrderHistory) {
        try {
            orderHistory = JSON.parse(existingOrderHistory);
        } catch (e) {
            console.error('Error parsing existing order history:', e);
            orderHistory = [];
        }
    }
    
    // Add current order to history with proper structure
    const historyOrder = {
        orderId: orderDetails.orderId,
        date: orderDetails.orderDate,
        status: 'Completed',
        trackingStatus: 'Delivered',
        items: orderDetails.items,
        customerInfo: orderDetails.customerInfo,
        paymentMethod: orderDetails.paymentMethod,
        total: orderDetails.summary.total,
        deliveryDate: new Date().toISOString(), // Mark as delivered immediately for demo
        otp: Math.floor(1000 + Math.random() * 9000).toString(), // Generate random OTP
    };
    
    orderHistory.push(historyOrder);
    localStorage.setItem('orderHistory', JSON.stringify(orderHistory));
    
    // Clear cart data
    sessionStorage.removeItem('unifiedTireShopCart');
    sessionStorage.removeItem('checkoutCart');
    sessionStorage.removeItem('checkoutSummary');
    localStorage.removeItem('unifiedTireShopCart');
    
    showToast('Order confirmed! Redirecting...', 'success');
    
    setTimeout(() => {
        window.location.href = 'complete1.php';
    }, 2000);
}

// Handle payment failure
function handlePaymentFailure(response) {
    console.error('Payment failed:', response.error);
    
    let errorMessage = 'Payment failed. Please try again.';
    
    switch(response.error.code) {
        case 'BAD_REQUEST_ERROR':
            errorMessage = 'Invalid payment details. Please check and try again.';
            break;
        case 'GATEWAY_ERROR':
            errorMessage = 'Payment gateway error. Please try again later.';
            break;
        case 'NETWORK_ERROR':
            errorMessage = 'Network error. Please check your connection and try again.';
            break;
        case 'SERVER_ERROR':
            errorMessage = 'Server error. Please try again later.';
            break;
        default:
            errorMessage = response.error.description || errorMessage;
    }
    
    showToast(errorMessage, 'error');
}

// Setup form validation
function setupFormValidation() {
    const firstNameInput = document.getElementById('firstName');
    if (firstNameInput) {
        firstNameInput.addEventListener('input', function() {
            const value = this.value.trim();
            if (value.length > 0) {
                this.style.borderColor = '#28a745';
            } else {
                this.style.borderColor = '';
            }
        });
    }
    
    const lastNameInput = document.getElementById('lastName');
    if (lastNameInput) {
        lastNameInput.addEventListener('input', function() {
            const value = this.value.trim();
            if (value.length > 0) {
                this.style.borderColor = '#28a745';
            } else {
                this.style.borderColor = '';
            }
        });
    }
    
    const emailInput = document.getElementById('email');
    if (emailInput) {
        emailInput.addEventListener('input', function() {
            const value = this.value.trim();
            if (isValidEmail(value)) {
                this.style.borderColor = '#28a745';
            } else if (value.length > 0) {
                this.style.borderColor = '#ffc107';
            } else {
                this.style.borderColor = '';
            }
        });
    }
    
    const phoneInput = document.getElementById('phone');
    if (phoneInput) {
        phoneInput.addEventListener('input', function() {
            const value = this.value.trim();
            if (isValidPhone(value)) {
                this.style.borderColor = '#28a745';
            } else if (value.length > 0) {
                this.style.borderColor = '#ffc107';
            } else {
                this.style.borderColor = '';
            }
        });
    }
    
    const addressInput = document.getElementById('address');
    if (addressInput) {
        addressInput.addEventListener('input', function() {
            const value = this.value.trim();
            if (value.length > 10) {
                this.style.borderColor = '#28a745';
            } else if (value.length > 0) {
                this.style.borderColor = '#ffc107';
            } else {
                this.style.borderColor = '';
            }
        });
    }
    
    const pincodeInput = document.getElementById('pincode');
    if (pincodeInput) {
        pincodeInput.addEventListener('input', function() {
            const value = this.value.trim();
            updateOrderSummary();
            
            if (isValidPinCode(value)) {
                this.style.borderColor = '#28a745';
            } else if (value.length > 0) {
                this.style.borderColor = '#ffc107';
            } else {
                this.style.borderColor = '';
            }
        });
        
        pincodeInput.placeholder = 'Enter 6-digit PIN code';
    }
}

// =================================================================
// RECEIPT AND DOWNLOAD FUNCTIONALITY
// =================================================================

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

// =================================================================
// TOAST NOTIFICATION SYSTEM
// =================================================================

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
        case 'warning':
            icon = '⚠️';
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
    
    // Add styles if not already present
    if (!document.querySelector('#toastStyles')) {
        const style = document.createElement('style');
        style.id = 'toastStyles';
        style.textContent = `
            .toast {
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 15px 20px;
                border-radius: 5px;
                color: white;
                font-weight: bold;
                z-index: 10000;
                transform: translateX(400px);
                transition: transform 0.3s ease;
                max-width: 400px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            }
            
            .toast.show {
                transform: translateX(0);
            }
            
            .toast.success {
                background-color: #28a745;
            }
            
            .toast.error {
                background-color: #dc3545;
            }
            
            .toast.info {
                background-color: #17a2b8;
            }
            
            .toast.warning {
                background-color: #ffc107;
                color: #212529;
            }
            
            .toast-content {
                display: flex;
                align-items: center;
                gap: 10px;
            }
            
            .toast-icon {
                font-size: 18px;
            }
            
            .toast-message {
                flex: 1;
            }
        `;
        document.head.appendChild(style);
    }
    
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

// =================================================================
// INITIALIZATION FUNCTIONS
// =================================================================

// FIXED: Initialize payment page with proper cart loading
function initializePaymentPage() {
    console.log('Initializing payment page...');
    
    // Load cart data from various sources
    paymentCartData = getPaymentPageData();
    console.log('Payment cart data loaded:', paymentCartData);
    
    // Validate cart data structure
    if (paymentCartData && paymentCartData.length > 0) {
        paymentCartData = paymentCartData.map(item => ({
            id: item.id || 'unknown',
            name: item.name || 'Unknown Product',
            brand: item.brand || 'Unknown Brand',
            specs: item.specs || 'Standard Specs',
            price: parseFloat(item.price) || 0,
            qty: parseInt(item.qty) || 1,
            image: item.image || 'https://via.placeholder.com/100x100/333/fff?text=Tire'
        }));
        
        console.log('Validated payment cart data:', paymentCartData);
        
        displayCartItems();
        updateOrderSummary();
    } else {
        console.warn('No cart data found or cart is empty');
        displayCartItems(); // This will show the empty cart message
    }
    
    setupPaymentMethods();
    setupFormValidation();
    setupDealerDiscount();
    
    restoreFormData();
    
    // Select first payment method by default
    const firstPaymentMethod = document.querySelector('.payment-method');
    if (firstPaymentMethod) {
        firstPaymentMethod.click();
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing...');
    
    // Initialize past orders if on past orders page
    if (document.getElementById('ordersContainer')) {
        console.log('Past orders page detected');
        initializePastOrders();
        
        // Set up filter event listeners
        const sortFilter = document.getElementById('sortFilter');
        const dateFilter = document.getElementById('dateFilter');
        
        if (sortFilter) {
            sortFilter.addEventListener('change', displayPastOrders);
        }
        
        if (dateFilter) {
            dateFilter.addEventListener('change', displayPastOrders);
        }
        
        // Keyboard shortcuts for past orders page
        document.addEventListener('keydown', function(e) {
            // Ctrl+H for home
            if (e.ctrlKey && e.key === 'h') {
                e.preventDefault();
                window.location.href = 'frontage.php';
            }
            
            // F5 to refresh orders
            if (e.key === 'F5') {
                e.preventDefault();
                initializePastOrders();
                showToast('Past orders refreshed!', 'info');
            }
        });
    }
    
    // Initialize payment page if on payment page
    if (document.getElementById('cartItemsDisplay')) {
        console.log('Payment page detected');
        initializePaymentPage();
    }
});

// Handle browser back button with customer details
window.addEventListener('beforeunload', function() {
    const customerDetails = getCustomerDetails();
    if (customerDetails && customerDetails.email) {
        sessionStorage.setItem('customerFormData', JSON.stringify(customerDetails));
    }
    
    const form = document.getElementById('paymentForm');
    if (form) {
        const formData = new FormData(form);
        const formObject = {};
        formData.forEach((value, key) => formObject[key] = value);
        sessionStorage.setItem('paymentFormData', JSON.stringify(formObject));
    }
});

// Function to restore form data on page load
function restoreFormData() {
    try {
        const savedCustomerData = sessionStorage.getItem('customerFormData');
        if (savedCustomerData) {
            const customerData = JSON.parse(savedCustomerData);
            
            const firstName = document.getElementById('firstName');
            const lastName = document.getElementById('lastName');
            const email = document.getElementById('email');
            const phone = document.getElementById('phone');
            const address = document.getElementById('address');
            const pincode = document.getElementById('pincode');
            
            if (firstName && customerData.firstName) firstName.value = customerData.firstName;
            if (lastName && customerData.lastName) lastName.value = customerData.lastName;
            if (email && customerData.email) email.value = customerData.email;
            if (phone && customerData.phone) phone.value = customerData.phone;
            if (address && customerData.address) address.value = customerData.address;
            if (pincode && customerData.pincode) pincode.value = customerData.pincode;
        }
        
        const savedFormData = sessionStorage.getItem('paymentFormData');
        if (savedFormData) {
            const formData = JSON.parse(savedFormData);
            
            Object.keys(formData).forEach(key => {
                const element = document.getElementById(key);
                if (element && element.type !== 'password') {
                    element.value = formData[key];
                }
            });
        }
    } catch (error) {
        console.error('Error restoring form data:', error);
    }
}

// =================================================================
// NAVIGATION FUNCTIONS
// =================================================================

// Navigation functions
function goHome() {
    window.location.href = 'index.php';
}

// Manual refresh function
function manualRefresh() {
    initializePastOrders();
    showToast('Checking for updated past orders...', 'info');
}

// =================================================================
// TESTING AND DEBUG FUNCTIONS
// =================================================================

// Testing function for dealer discount
function testDealerDiscount() {
    console.log('=== TESTING DEALER DISCOUNT FUNCTIONALITY ===');
    
    // Get actual emails from order history
    const orderHistory = localStorage.getItem('orderHistory');
    let testEmails = ['test@example.com', 'dealer@example.com'];
    
    if (orderHistory) {
        try {
            const orders = JSON.parse(orderHistory);
            const uniqueEmails = [...new Set(orders.map(order => 
                order.customerInfo && order.customerInfo.email ? order.customerInfo.email : null
            ).filter(email => email !== null))];
            
            testEmails = [...new Set([...testEmails, ...uniqueEmails])];
            console.log('Found emails in order history:', uniqueEmails);
        } catch (e) {
            console.error('Error parsing order history for test:', e);
        }
    }
    
    testEmails.forEach(async (email) => {
        console.log(`\nTesting email: ${email}`);
        try {
            const result = await checkDealerDiscountEligibility(email);
            console.log('Result:', result);
        } catch (error) {
            console.error('Error testing dealer discount for', email, ':', error);
        }
    });
    
    console.log('\n=== END OF DEALER DISCOUNT TEST ===');
}

// Debug function for dealer discount calculation
function debugDealerDiscount(cartData = paymentCartData) {
    console.log('=== DEALER DISCOUNT DEBUG ===');
    console.log('Current cart data:', cartData);
    
    const bridgestoneCount = getBridgestoneCountInCart();
    console.log('Bridgestone tires in cart:', bridgestoneCount);
    
    const canApply = canApplyDealerDiscount();
    console.log('Can apply dealer discount:', canApply);
    
    const discountAmount = calculateDealerDiscount();
    console.log('Discount amount:', discountAmount);
    
    console.log('Is dealer eligible:', isDealerEligible);
    console.log('Dealer email:', dealerEmail);
    
    // Check order history
    const orderHistory = localStorage.getItem('orderHistory');
    if (orderHistory) {
        try {
            const orders = JSON.parse(orderHistory);
            console.log('Total orders in history:', orders.length);
            
            const bridgestoneOrders = orders.filter(order => {
                if (order.items) {
                    return order.items.some(item => 
                        item.brand && item.brand.toLowerCase() === 'bridgestone'
                    );
                }
                return false;
            });
            
            console.log('Orders with Bridgestone tires:', bridgestoneOrders.length);
        } catch (e) {
            console.error('Error parsing order history in debug:', e);
        }
    }
    
    console.log('=============================');
    
    return {
        bridgestoneCount,
        canApply,
        discountAmount,
        isDealerEligible,
        dealerEmail
    };
}

// Function to simulate adding Bridgestone tires to cart for testing
function addTestBridgestoneTires() {
    const bridgestoneTire = {
        id: 'test-bridgestone-1',
        name: 'Bridgestone Turanza T001',
        brand: 'Bridgestone',
        specs: '205/55R16 91V',
        price: 15000,
        qty: 4,
        image: 'https://via.placeholder.com/100x100/333/fff?text=Bridgestone'
    };
    
    paymentCartData.push(bridgestoneTire);
    
    if (document.getElementById('cartItemsDisplay')) {
        displayCartItems();
        updateOrderSummary();
    }
    
    console.log('Added test Bridgestone tires to cart');
    showToast('Test Bridgestone tires added to cart!', 'info');
    return bridgestoneTire;
}

// Function to add test order history for demo purposes
function addTestOrderHistory(email = 'test@dealer.com') {
    const testOrders = [];
    
    // Add 25 Bridgestone tires across multiple orders in the last month
    const today = new Date();
    const lastMonth = new Date(today.getTime() - 30 * 24 * 60 * 60 * 1000);
    
    // Order 1: 10 Bridgestone tires
    testOrders.push({
        orderId: 'TEST-ORD-001',
        date: new Date(lastMonth.getTime() + 5 * 24 * 60 * 60 * 1000).toISOString(),
        status: 'Delivered',
        trackingStatus: 'Delivered',
        deliveryDate: new Date(lastMonth.getTime() + 7 * 24 * 60 * 60 * 1000).toISOString(),
        customerInfo: {
            email: email,
            name: 'Test Dealer',
            phone: '9876543210'
        },
        items: [
            {
                name: 'Bridgestone Turanza T001',
                brand: 'Bridgestone',
                specs: '205/55R16 91V',
                price: 15000,
                qty: 10,
                image: 'bridgestone-turanza.jpg'
            }
        ],
        paymentMethod: 'Online',
        total: 150000,
        otp: '1234'
    });
    
    // Order 2: 15 Bridgestone tires
    testOrders.push({
        orderId: 'TEST-ORD-002',
        date: new Date(lastMonth.getTime() + 15 * 24 * 60 * 60 * 1000).toISOString(),
        status: 'Delivered',
        trackingStatus: 'Delivered',
        deliveryDate: new Date(lastMonth.getTime() + 17 * 24 * 60 * 60 * 1000).toISOString(),
        customerInfo: {
            email: email,
            name: 'Test Dealer',
            phone: '9876543210'
        },
        items: [
            {
                name: 'Bridgestone Ecopia EP150',
                brand: 'Bridgestone',
                specs: '185/65R14 86H',
                price: 12000,
                qty: 15,
                image: 'bridgestone-ecopia.jpg'
            }
        ],
        paymentMethod: 'Online',
        total: 180000,
        otp: '5678'
    });
    
    // Get existing order history
    const existingOrderHistory = localStorage.getItem('orderHistory');
    let orderHistory = [];
    
    if (existingOrderHistory) {
        try {
            orderHistory = JSON.parse(existingOrderHistory);
        } catch (e) {
            console.error('Error parsing existing order history:', e);
            orderHistory = [];
        }
    }
    
    // Add test orders
    orderHistory.push(...testOrders);
    
    // Save updated order history
    localStorage.setItem('orderHistory', JSON.stringify(orderHistory));
    
    console.log(`Added test order history for ${email}:`, testOrders);
    showToast(`Test order history added for ${email}!`, 'success');
    
    // Refresh past orders display if on that page
    if (document.getElementById('ordersContainer')) {
        initializePastOrders();
    }
    
    return testOrders;
}

// Function to clear all test data
function clearTestData() {
    localStorage.removeItem('orderHistory');
    sessionStorage.removeItem('customerFormData');
    sessionStorage.removeItem('paymentFormData');
    sessionStorage.removeItem('checkoutCart');
    sessionStorage.removeItem('unifiedTireShopCart');
    localStorage.removeItem('unifiedTireShopCart');
    
    // Reset dealer discount variables
    isDealerEligible = false;
    dealerDiscountAmount = 0;
    dealerEmail = '';
    
    console.log('All test data cleared');
    showToast('All test data cleared!', 'info');
    
    // Refresh displays
    if (document.getElementById('ordersContainer')) {
        initializePastOrders();
    }
    
    if (document.getElementById('cartItemsDisplay')) {
        paymentCartData = [];
        displayCartItems();
        updateOrderSummary();
    }
}

// =================================================================
// UNIVERSAL USER DETECTION SCRIPT
// =================================================================

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
    
    // Expose UserDetector globally
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

// =================================================================
// GLOBAL FUNCTIONS FOR CONSOLE TESTING
// =================================================================

// Expose useful functions globally for debugging
window.TireShopDebug = {
    testDealerDiscount,
    debugDealerDiscount,
    addTestBridgestoneTires,
    addTestOrderHistory,
    clearTestData,
    checkDealerDiscountEligibility,
    getDealerOrdersFromHistory,
    getBridgestoneCountInCart,
    calculateDealerDiscount,
    canApplyDealerDiscount
};

console.log('🎯 Tire Shop Debug Tools Available:');
console.log('- TireShopDebug.testDealerDiscount() - Test dealer discount with existing emails');
console.log('- TireShopDebug.addTestOrderHistory("email@example.com") - Add test Bridgestone orders');
console.log('- TireShopDebug.addTestBridgestoneTires() - Add Bridgestone tires to current cart');
console.log('- TireShopDebug.debugDealerDiscount() - Debug current dealer discount state');
console.log('- TireShopDebug.clearTestData() - Clear all test data');
console.log('💡 Use these functions in the browser console to test the dealer discount functionality!');
    </script>
</body>
</html>