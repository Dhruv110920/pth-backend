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
                    <a href="cart.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Cart
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>


    <div id="toast" class="toast"></div>
<script src="path/to/user-detector.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
let paymentCartData = [];
let selectedPaymentMethod = '';

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
    
    // Add more PIN codes as needed
};

// GST rates configuration for different brands and specific products
const gstRates = {
    'ascenso': 18, // Ascenso brand has 18% GST by default
    'default': 28  // All other brands have 28% GST
};

// Special GST rates for specific tire models (28% GST exceptions)
// FIXED: Using normalized keys for better matching
const specialGSTProducts = {
    'ascenso': {
        // Normalize the keys by removing spaces and converting to lowercase
        'bosstn20': 28,  // matches "BOSS TN 20" or "boss tn 20"
        'bosstr21': 28,  // matches "boss tn21" or "BOSS TN21"
        'bosstr20': 28,  // matches "BOSS TR 20"
        'bosspr21': 28,  // matches "boss pr21" 
        // Add more specific Ascenso models here if needed
    }
    // Add other brands with special models if needed in future
};

// FIXED: Function to normalize tire names for comparison
function normalizeTireName(tireName) {
    if (!tireName) return '';
    return tireName.toLowerCase()
                  .replace(/\s+/g, '')  // Remove all spaces
                  .replace(/[^a-z0-9]/g, ''); // Remove special characters except alphanumeric
}

// FIXED: Function to get GST rate for a brand and specific tire model
function getGSTRate(brand, tireName = '') {
    if (!brand) return gstRates.default;
    
    const brandLower = brand.toLowerCase().trim();
    const normalizedTireName = normalizeTireName(tireName);
    
    console.log('GST Calculation Debug:');
    console.log('Brand:', brand, '-> normalized:', brandLower);
    console.log('Tire Name:', tireName, '-> normalized:', normalizedTireName);
    
    // Check if there are special GST rates for specific tire models of this brand
    if (specialGSTProducts[brandLower] && normalizedTireName) {
        const specialRate = specialGSTProducts[brandLower][normalizedTireName];
        if (specialRate) {
            console.log('Special GST rate found:', specialRate + '%');
            return specialRate;
        }
    }
    
    // Otherwise, return the brand's default GST rate
    const defaultRate = gstRates[brandLower] || gstRates.default;
    console.log('Using default GST rate:', defaultRate + '%');
    return defaultRate;
}

// Function to calculate GST amount for an item (UPDATED)
function calculateItemGST(price, quantity, brand, tireName = '') {
    const gstRate = getGSTRate(brand, tireName);
    const subtotal = price * quantity;
    const gstAmount = (subtotal * gstRate) / 100;
    
    console.log(`GST calculation for ${brand} ${tireName}:`, {
        price,
        quantity,
        subtotal,
        gstRate,
        gstAmount
    });
    
    return gstAmount;
}

// Function to calculate total GST for cart (UPDATED)
function calculateTotalGST(cartData = paymentCartData) {
    return cartData.reduce((totalGST, item) => {
        return totalGST + calculateItemGST(item.price, item.qty, item.brand, item.name);
    }, 0);
}

// FIXED: Function to get GST breakdown by brand and specific models
function getGSTBreakdown(cartData = paymentCartData) {
    const breakdown = {};
    
    cartData.forEach(item => {
        const brand = item.brand || 'Unknown';
        const tireName = item.name || '';
        const gstRate = getGSTRate(brand, tireName);
        const itemSubtotal = item.price * item.qty;
        const itemGST = calculateItemGST(item.price, item.qty, item.brand, item.name);
        
        // Create a unique key for brand + model combination if special GST applies
        let breakdownKey = brand;
        const brandLower = brand.toLowerCase().trim();
        const normalizedTireName = normalizeTireName(tireName);
        
        // Check if this tire has special GST rate
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

// UPDATED: Function to display cart items with correct GST information
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
        // Use the updated getGSTRate function with tire name
        const gstRate = getGSTRate(item.brand, item.name);
        const itemSubtotal = item.price * item.qty;
        const itemGST = calculateItemGST(item.price, item.qty, item.brand, item.name);
        const itemTotal = itemSubtotal + itemGST;
        
        // Check if this tire has special GST rate
        const brandLower = (item.brand || '').toLowerCase().trim();
        const normalizedTireName = normalizeTireName(item.name);
        const isSpecialGST = specialGSTProducts[brandLower] && 
                            normalizedTireName && 
                            specialGSTProducts[brandLower][normalizedTireName];
        
        const cartItem = document.createElement('div');
        cartItem.className = 'cart-item';
        cartItem.innerHTML = `
            <div class="item-image">
                <img src="${item.image || 'placeholder.jpg'}" alt="${item.name}" onerror="this.src='placeholder.jpg'">
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

// UPDATED: Function to update order summary with enhanced GST breakdown
function updateOrderSummary() {
    const summary = getCheckoutSummary();
    const customerDetails = getCustomerDetails();
    
    const subtotalElement = document.getElementById('subtotalAmount');
    const gstElement = document.getElementById('gstAmount');
    const shippingElement = document.getElementById('shippingAmount');
    const totalElement = document.getElementById('totalAmount');
    
    if (subtotalElement) subtotalElement.textContent = `₹${summary.subtotal.toFixed(2)}`;
    if (gstElement) gstElement.textContent = `₹${summary.gstAmount.toFixed(2)}`;
    if (shippingElement) shippingElement.textContent = `₹${summary.shipping.toFixed(2)}`;
    if (totalElement) totalElement.textContent = `₹${summary.total.toFixed(2)}`;
    
    // Show enhanced GST breakdown
    const gstBreakdownElement = document.getElementById('gstBreakdown');
    if (gstBreakdownElement) {
        let breakdownHTML = '<div class="gst-breakdown-title">GST Breakdown:</div>';
        
        Object.entries(summary.gstBreakdown).forEach(([brandKey, data]) => {
            const specialBadge = data.isSpecialRate ? '<span class="special-rate-indicator">*</span>' : '';
            breakdownHTML += `
                <div class="gst-brand-line">
                    <span>${brandKey}: ${data.itemCount} items @ ${data.gstRate}%${specialBadge}</span>
                    <span>₹${data.gstAmount.toFixed(2)}</span>
                </div>
            `;
        });
        
        // Add note for special rates
        const hasSpecialRates = Object.values(summary.gstBreakdown).some(data => data.isSpecialRate);
        if (hasSpecialRates) {
            breakdownHTML += '<div class="special-rate-note">* Special GST rate applied</div>';
        }
        
        gstBreakdownElement.innerHTML = breakdownHTML;
    }
    
    // Show shipping info
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
            // UPDATED: Changed from 40km to 60km for free shipping eligibility
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

// Debug function to test GST calculations for specific products
function debugGSTCalculation(brand, tireName, price, quantity) {
    console.log('=== GST CALCULATION DEBUG ===');
    console.log('Brand:', brand);
    console.log('Tire Name:', tireName);
    console.log('Normalized Tire Name:', normalizeTireName(tireName));
    console.log('Price per tire:', price);
    console.log('Quantity:', quantity);
    
    const gstRate = getGSTRate(brand, tireName);
    const subtotal = price * quantity;
    const gstAmount = calculateItemGST(price, quantity, brand, tireName);
    const total = subtotal + gstAmount;
    
    console.log('Applied GST Rate:', gstRate + '%');
    console.log('Subtotal (excl. GST):', subtotal);
    console.log('GST Amount:', gstAmount);
    console.log('Total (incl. GST):', total);
    
    // Check if special GST applies
    const brandLower = brand.toLowerCase().trim();
    const normalizedTireName = normalizeTireName(tireName);
    const isSpecial = specialGSTProducts[brandLower] && 
                     normalizedTireName && 
                     specialGSTProducts[brandLower][normalizedTireName];
    console.log('Special GST Rate Applied:', isSpecial ? 'Yes' : 'No');
    console.log('Available special products for', brandLower + ':', specialGSTProducts[brandLower] || 'None');
    console.log('=============================');
    
    return {
        brand,
        tireName,
        normalizedTireName,
        gstRate,
        subtotal,
        gstAmount,
        total,
        isSpecialRate: isSpecial
    };
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
    
    // Validate name
    if (!details.firstName) {
        errors.push('First name is required');
    }
    
    if (!details.lastName) {
        errors.push('Last name is required');
    }
    
    // Validate email
    if (!details.email) {
        errors.push('Email is required');
    } else if (!isValidEmail(details.email)) {
        errors.push('Please enter a valid email address');
    }
    
    // Validate phone
    if (!details.phone) {
        errors.push('Phone number is required');
    } else if (!isValidPhone(details.phone)) {
        errors.push('Please enter a valid Indian phone number');
    }
    
    // Validate address
    if (!details.address) {
        errors.push('Address is required');
    }
    
    // Validate PIN code
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
    
    // Group tires by brand
    const brandCounts = {};
    cartData.forEach(item => {
        const brand = item.brand || 'Unknown';
        brandCounts[brand] = (brandCounts[brand] || 0) + item.qty;
    });
    
    // Check if any brand has 14 or more tires
    return Object.values(brandCounts).some(count => count >= 14);
}

// NEW FUNCTION: Check if customer qualifies for free shipping specifically for 60km+ distances
function checkFreeShippingEligibilityFor60km(pincode, cartData) {
    if (!isValidPinCode(pincode) || !cartData || cartData.length === 0) return false;
    
    const distance = pinCodeDistances[pincode] || 100; // Default to 100km for unknown PIN codes
    
    // Only applicable for distances above 60km
    if (distance <= 60) return false;
    
    // Group tires by brand
    const brandCounts = {};
    cartData.forEach(item => {
        const brand = item.brand || 'Unknown';
        brandCounts[brand] = (brandCounts[brand] || 0) + item.qty;
    });
    
    // Check if any brand has 14 or more tires
    const eligibleBrands = Object.entries(brandCounts)
        .filter(([brand, count]) => count >= 14)
        .map(([brand, count]) => ({ brand, count }));
    
    return {
        isEligible: eligibleBrands.length > 0,
        eligibleBrands: eligibleBrands,
        distance: distance,
        allBrandCounts: brandCounts
    };
}

// Function to calculate cost per tire based on distance
function calculateCostPerTire(distance) {
    if (distance <= 10) {
        return 50; // ₹50 per tire for 0-10 km
    } else if (distance <= 20) {
        return 100; // ₹100 per tire for 11-20 km
    } else if (distance <= 30) {
        return 150; // ₹150 per tire for 21-30 km 
    } else if (distance <= 40) {
        return 200; // ₹200 per tire for 31-40 km
    } else if (distance <= 50) {
        return 300; // ₹300 per tire for 41-50 km
    } else if (distance <= 60) {
        return 400; // ₹400 per tire for 51-60 km
    } else {
        // For 60+ km, increase by ₹100 per tire for every 10km
        const extraDistance = distance - 60;
        const extraTiers = Math.ceil(extraDistance / 10);
        return 400 + (extraTiers * 100); // Base ₹400 + ₹100 for each 10km tier
    }
}

// UPDATED: Function to calculate shipping cost with 60km+ free delivery logic
function calculateShippingCost(pincode, tireCount, cartData = paymentCartData) {
    // Return 0 if PIN code is not valid
    if (!isValidPinCode(pincode)) {
        return 0;
    }
    
    const distance = pinCodeDistances[pincode];
    
    if (distance === undefined) {
        // Default shipping for unknown PIN codes (using progressive rate for 100km)
        const defaultDistance = 100;
        const defaultCostPerTire = calculateCostPerTire(defaultDistance);
        
        // Check for 60km+ free shipping eligibility even for unknown PIN codes
        if (defaultDistance > 60 && checkFreeShippingEligibility(cartData)) {
            const brandCounts = {};
            cartData.forEach(item => {
                const brand = item.brand || 'Unknown';
                brandCounts[brand] = (brandCounts[brand] || 0) + item.qty;
            });
            
            let totalShippingCost = 0;
            Object.entries(brandCounts).forEach(([brand, count]) => {
                if (count >= 14) {
                    // Free shipping for this brand (14+ tires)
                    totalShippingCost += 0;
                } else {
                    // Apply shipping cost for this brand (less than 14 tires)
                    totalShippingCost += count * defaultCostPerTire;
                }
            });
            
            return totalShippingCost;
        }
        
        return tireCount * defaultCostPerTire;
    }
    
    const costPerTire = calculateCostPerTire(distance);
    
    // UPDATED: For distances above 60km, check for free shipping eligibility
    if (distance > 60 && checkFreeShippingEligibility(cartData)) {
        // Group tires by brand
        const brandCounts = {};
        cartData.forEach(item => {
            const brand = item.brand || 'Unknown';
            brandCounts[brand] = (brandCounts[brand] || 0) + item.qty;
        });
        
        let totalShippingCost = 0;
        
        // Calculate shipping for each brand group
        Object.entries(brandCounts).forEach(([brand, count]) => {
            if (count >= 14) {
                // Free shipping for this brand (14+ tires for 60km+ distances)
                totalShippingCost += 0;
            } else {
                // Apply shipping cost for this brand (less than 14 tires)
                totalShippingCost += count * costPerTire;
            }
        });
        
        return totalShippingCost;
    }
    
    // Standard calculation for all other cases (distance <= 60km or no free shipping eligibility)
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

// UPDATED: Function to get shipping details with 60km+ free delivery information
function getShippingDetails(pincode, cartData = paymentCartData) {
    if (!isValidPinCode(pincode)) {
        return 'Enter your PIN code to see shipping details';
    }
    
    const distance = pinCodeDistances[pincode] || 100; // Default to 100km for unknown PIN codes
    const tireCount = cartData.reduce((sum, item) => sum + item.qty, 0);
    const shippingCost = calculateShippingCost(pincode, tireCount, cartData);
    const costPerTire = calculateCostPerTire(distance);
    
    let details = getDistanceInfo(pincode);
    
    // UPDATED: Changed from 40km to 60km for free shipping eligibility
    if (distance > 60 && checkFreeShippingEligibility(cartData)) {
        // Group tires by brand to show detailed shipping info
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
        
        // Add note about 60km+ free shipping eligibility
        if (distance > 60) {
            details += ' (Free shipping available with 14+ tires of same brand)';
        }
    } else {
        details += ' | Free local delivery';
    }
    
    return details;
}

// Function to get payment page data (from your original code)
function getPaymentPageData() {
    // Method 1: From URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const cartData = urlParams.get('cart');
    
    if (cartData) {
        try {
            return JSON.parse(decodeURIComponent(cartData));
        } catch (e) {
            console.error('Error parsing cart data from URL:', e);
        }
    }
    
    // Method 2: From sessionStorage
    const savedCart = sessionStorage.getItem('checkoutCart');
    if (savedCart) {
        try {
            return JSON.parse(savedCart);
        } catch (e) {
            console.error('Error loading cart from sessionStorage:', e);
        }
    }
    
    // Method 3: From localStorage (fallback)
    const localCart = localStorage.getItem('unifiedTireShopCart');
    if (localCart) {
        try {
            return JSON.parse(localCart);
        } catch (e) {
            console.error('Error loading cart from localStorage:', e);
        }
    }
    
    return [];
}

// UPDATED: Function to get checkout summary with GST calculations
function getCheckoutSummary() {
    const customerDetails = getCustomerDetails();
    const pincode = customerDetails.pincode;
    
    // Calculate subtotal (price before GST)
    const subtotal = paymentCartData.reduce((sum, item) => sum + (item.price * item.qty), 0);
    const itemCount = paymentCartData.reduce((sum, item) => sum + item.qty, 0);
    
    // Calculate GST
    const totalGST = calculateTotalGST(paymentCartData);
    const gstBreakdown = getGSTBreakdown(paymentCartData);
    
    // Calculate shipping (GST not applicable on shipping)
    const shipping = isValidPinCode(pincode) ? calculateShippingCost(pincode, itemCount, paymentCartData) : 0;
    
    // Total = Subtotal + GST + Shipping
    const total = subtotal + totalGST + shipping;
    
    return {
        items: paymentCartData,
        subtotal: subtotal,
        gstAmount: totalGST,
        gstBreakdown: gstBreakdown,
        itemCount: itemCount,
        shipping: shipping,
        total: total,
        customerInfo: customerDetails
    };
}

// Payment method selection
function setupPaymentMethods() {
    const paymentMethods = document.querySelectorAll('.payment-method');
    const cardDetails = document.getElementById('cardDetails');
    
    paymentMethods.forEach(method => {
        method.addEventListener('click', function() {
            // Remove selected class from all methods
            paymentMethods.forEach(m => m.classList.remove('selected'));
            
            // Add selected class to clicked method
            this.classList.add('selected');
            
            // Store selected method
            selectedPaymentMethod = this.dataset.method;
            
            // Show/hide card details
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

// UPDATED: Process payment function with Razorpay integration and GST details
function processPayment() {
    if (paymentCartData.length === 0) {
        showToast('No items in cart!', 'error');
        return;
    }

    // Validate customer details
    const validation = validateCustomerDetails();
    if (!validation.isValid) {
        showToast(validation.errors[0], 'error');
        return;
    }

    // Validate form
    const form = document.getElementById('paymentForm');
    if (form && !form.checkValidity()) {
        form.reportValidity();
        return;
    }

    // Get customer details and order summary with GST
    const customerDetails = validation.details;
    const orderSummary = getCheckoutSummary();

    // Create order details before payment
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
        gstDetails: {
            totalGST: orderSummary.gstAmount,
            gstBreakdown: orderSummary.gstBreakdown
        }
    };

    // Initialize Razorpay payment
    initializeRazorpayPayment(orderDetails);
}

// Initialize Razorpay payment
function initializeRazorpayPayment(orderDetails) {
    // Show processing message
    showToast('Initializing payment...', 'info');

    // Convert amount to paise (Razorpay accepts amount in paise) 
    const amountInPaise = Math.round(orderDetails.summary.total * 100);

    const options = {
        key: 'rzp_test_ruvJ0eNMt6y1oY', // Replace with your actual Razorpay key ID
        amount: amountInPaise, // Amount in paise
        currency: 'INR',
        name: 'Your Tire Shop', // Replace with your business name
        description: `Order #${orderDetails.orderId}`,
        order_id: '', // This should be generated from your backend
        image: '/path/to/your/logo.png', // Optional: Add your logo
        
        // Customer details
        prefill: {
            name: orderDetails.customerInfo.name,
            email: orderDetails.customerInfo.email,
            contact: orderDetails.customerInfo.phone
        },
        
        // Billing address
        billing_address: {
            name: orderDetails.customerInfo.name,
            line1: orderDetails.shippingAddress,
            zipcode: orderDetails.pincode,
            state: 'Your State', // Add appropriate state
            country: 'India'
        },
        
        notes: {
            order_id: orderDetails.orderId,
            gst_amount: orderDetails.gstDetails.totalGST,
            items_count: orderDetails.items.length
        },
        
        theme: {
            color: '#3399cc' // Customize according to your brand colors
        },
        
        modal: {
            ondismiss: function() {
                showToast('Payment cancelled by user', 'warning');
            }
        },
        
        // Payment success handler
        handler: function(response) {
            handlePaymentSuccess(response, orderDetails);
        }
    };

    // Create Razorpay instance and open checkout
    const rzp = new Razorpay(options);
    
    // Handle payment failure
    rzp.on('payment.failed', function(response) {
        handlePaymentFailure(response);
    });
    
    // Open Razorpay checkout
    rzp.open();
}

// Handle successful payment
function handlePaymentSuccess(razorpayResponse, orderDetails) {
    showToast('Payment successful! Verifying...', 'success');
    
    // Add Razorpay payment details to order
    orderDetails.razorpayDetails = {
        paymentId: razorpayResponse.razorpay_payment_id,
        orderId: razorpayResponse.razorpay_order_id,
        signature: razorpayResponse.razorpay_signature
    };
    
    // Here you should verify the payment signature on your backend
    // For now, we'll simulate verification
    verifyPaymentSignature(razorpayResponse, orderDetails);
}

// Verify payment signature (should be done on backend)
function verifyPaymentSignature(razorpayResponse, orderDetails) {
    // In production, send this data to your backend for verification
    const verificationData = {
        razorpay_order_id: razorpayResponse.razorpay_order_id,
        razorpay_payment_id: razorpayResponse.razorpay_payment_id,
        razorpay_signature: razorpayResponse.razorpay_signature
    };
    
    // Simulate backend verification (replace with actual API call)
    setTimeout(() => {
        // Assuming verification is successful
        completeOrder(orderDetails);
    }, 1000);
    
    /* 
    // Actual backend verification would look like this:
    fetch('/api/verify-payment', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            ...verificationData,
            orderDetails: orderDetails
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.verified) {
            completeOrder(orderDetails);
        } else {
            showToast('Payment verification failed!', 'error');
        }
    })
    .catch(error => {
        console.error('Verification error:', error);
        showToast('Payment verification failed!', 'error');
    });
    */
}

// Complete the order after successful payment verification
function completeOrder(orderDetails) {
    // Save comprehensive order details for the completion page
    sessionStorage.setItem('completedOrder', JSON.stringify(orderDetails));
    
    // Clear cart after successful payment
    localStorage.removeItem('unifiedTireShopCart');
    sessionStorage.removeItem('unifiedTireShopCart');
    sessionStorage.removeItem('checkoutCart');
    sessionStorage.removeItem('checkoutSummary');
    
    showToast('Order confirmed! Redirecting...', 'success');
    
    // Redirect to complete.php
    setTimeout(() => {
        window.location.href = 'complete.php';
    }, 2000);
}

// Handle payment failure
function handlePaymentFailure(response) {
    console.error('Payment failed:', response.error);
    
    let errorMessage = 'Payment failed. Please try again.';
    
    // Customize error messages based on error codes
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

// Create order on backend (call this before opening Razorpay checkout)
function createRazorpayOrder(orderDetails) {
    return fetch('/api/create-razorpay-order', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            amount: Math.round(orderDetails.summary.total * 100), // Amount in paise
            currency: 'INR',
            receipt: orderDetails.orderId,
            notes: {
                order_id: orderDetails.orderId,
                customer_name: orderDetails.customerInfo.name,
                customer_email: orderDetails.customerInfo.email
            }
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            return data.order.id; // Return Razorpay order ID
        } else {
            throw new Error('Failed to create order');
        }
    });
}

// Enhanced version with backend order creation
function processPaymentWithBackend() {
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
        gstDetails: {
            totalGST: orderSummary.gstAmount,
            gstBreakdown: orderSummary.gstBreakdown
        }
    };

    // Create order on backend first
    showToast('Creating order...', 'info');
    
    createRazorpayOrder(orderDetails)
        .then(razorpayOrderId => {
            // Update options with the order ID from backend
            const amountInPaise = Math.round(orderDetails.summary.total * 100);
            
            const options = {
                key: 'rzp_test_ruvJ0eNMt6y1oY',
                amount: amountInPaise,
                currency: 'INR',
                name: 'Your Tire Shop',
                description: `Order #${orderDetails.orderId}`,
                order_id: razorpayOrderId, // Use the order ID from backend
                prefill: {
                    name: orderDetails.customerInfo.name,
                    email: orderDetails.customerInfo.email,
                    contact: orderDetails.customerInfo.phone
                },
                theme: {
                    color: '#3399cc'
                },
                handler: function(response) {
                    handlePaymentSuccess(response, orderDetails);
                }
            };

            const rzp = new Razorpay(options);
            rzp.on('payment.failed', handlePaymentFailure);
            rzp.open();
        })
        .catch(error => {
            console.error('Order creation failed:', error);
            showToast('Failed to create order. Please try again.', 'error');
        });
}

// UPDATED: Add real-time validation for form fields
function setupFormValidation() {
    // First name validation
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
    
    // Last name validation
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
    
    // Email validation
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
    
    // Phone validation
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
    
    // Address validation
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
    
    // PIN code validation
    const pincodeInput = document.getElementById('pincode');
    if (pincodeInput) {
        pincodeInput.addEventListener('input', function() {
            const value = this.value.trim();
            // Update summary on every input change
            updateOrderSummary();
            
            // Add visual feedback for PIN code validation
            if (isValidPinCode(value)) {
                this.style.borderColor = '#28a745'; // Green border for valid PIN
            } else if (value.length > 0) {
                this.style.borderColor = '#ffc107'; // Yellow border for incomplete PIN
            } else {
                this.style.borderColor = ''; // Default border
            }
        });
        
        // Add placeholder text to PIN code input
        pincodeInput.placeholder = 'Enter 6-digit PIN code';
    }
}

// Toast notification function
function showToast(message, type = 'success') {
    const toast = document.getElementById('toast');
    if (!toast) return;
    
    toast.textContent = message;
    toast.className = `toast ${type} show`;
    
    // Set background color based on type
    switch(type) {
        case 'success':
            toast.style.background = '#28a745';
            break;
        case 'error':
            toast.style.background = '#dc3545';
            break;
        case 'info':
            toast.style.background = '#17a2b8';
            break;
        case 'warning':
            toast.style.background = '#ffc107';
            break;
    }
    
    setTimeout(() => {
        toast.classList.remove('show');
    }, 3000);
}

// UPDATED: Initialize payment page with form validation
function initializePaymentPage() {
    // Load cart data
    paymentCartData = getPaymentPageData();
    console.log('Payment cart data loaded:', paymentCartData);
    
    // Display cart items and summary
    displayCartItems();
    updateOrderSummary();
    
    // Setup payment methods
    setupPaymentMethods();
    
    // Setup form validation
    setupFormValidation();
    
    // Restore form data if available
    restoreFormData();
    
    // Auto-select first payment method
    const firstPaymentMethod = document.querySelector('.payment-method');
    if (firstPaymentMethod) {
        firstPaymentMethod.click();
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    initializePaymentPage();
});

// Handle browser back button with customer details
window.addEventListener('beforeunload', function() {
    // Save form data including customer details
    const customerDetails = getCustomerDetails();
    sessionStorage.setItem('customerFormData', JSON.stringify(customerDetails));
    
    // Save payment form data if needed
    const form = document.getElementById('paymentForm');
    if (form) {
        const formData = new FormData(form);
        const formObject = {};
        formData.forEach((value, key) => formObject[key] = value);
        sessionStorage.setItem('paymentFormData', JSON.stringify(formObject));
    }
});

// UPDATED: Function to restore form data on page load
function restoreFormData() {
    try {
        const savedCustomerData = sessionStorage.getItem('customerFormData');
        if (savedCustomerData) {
            const customerData = JSON.parse(savedCustomerData);
            
            // Restore customer details
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
            
            // Restore other form fields
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

// UPDATED: Debug function to test shipping calculations with 60km+ free delivery
function debugShippingCalculation(pincode, cartData) {
    console.log('=== SHIPPING CALCULATION DEBUG (60km+ Free Delivery) ===');
    console.log('PIN Code:', pincode);
    console.log('Distance:', pinCodeDistances[pincode] || 'Unknown (default 100km)');
    console.log('Cart Data:', cartData);
    
    const distance = pinCodeDistances[pincode] || 100;
    const costPerTire = calculateCostPerTire(distance);
    const tireCount = cartData.reduce((sum, item) => sum + item.qty, 0);
    const totalCost = calculateShippingCost(pincode, tireCount, cartData);
    
    // Test the new 60km+ free shipping function
    const freeShipping60km = checkFreeShippingEligibilityFor60km(pincode, cartData);
    
    console.log('Cost per tire:', costPerTire);
    console.log('Total tires:', tireCount);
    console.log('Distance > 60km:', distance > 60);
    console.log('Free shipping eligible (general):', checkFreeShippingEligibility(cartData));
    console.log('Free shipping eligible (60km+):', freeShipping60km);
    console.log('Total shipping cost:', totalCost);
    console.log('=========================================================');
    
    return {
        pincode,
        distance,
        costPerTire,
        tireCount,
        freeShippingEligible: checkFreeShippingEligibility(cartData),
        freeShippingEligible60km: freeShipping60km,
        totalCost
    };
}

// Universal New User Detection Script
// Add this script to every page to handle new vs returning users
(function() {
    'use strict';
    
    // Get current user data from session storage
    function getCurrentUser() {
        const userData = sessionStorage.getItem('userData');
        const sellerData = sessionStorage.getItem('sellerData');
        const dealerData = sessionStorage.getItem('dealerData');
        
        if (userData) return JSON.parse(userData);
        if (sellerData) return JSON.parse(sellerData);
        if (dealerData) return JSON.parse(dealerData);
        
        return null;
    }
    
    // Check if this email has visited before
    function isReturningUser(email) {
        if (!email) return false;
        const userVisits = JSON.parse(localStorage.getItem('userVisits') || '{}');
        return userVisits.hasOwnProperty(email);
    }
    
    // Mark user as visited and update visit count
    function markUserAsVisited(email) {
        if (!email) return;
        
        const userVisits = JSON.parse(localStorage.getItem('userVisits') || '{}');
        const now = new Date().toISOString();
        
        if (userVisits[email]) {
            // Returning user
            userVisits[email].lastVisit = now;
            userVisits[email].visitCount = (userVisits[email].visitCount || 1) + 1;
        } else {
            // New user
            userVisits[email] = {
                firstVisit: now,
                lastVisit: now,
                visitCount: 1,
                isNew: true
            };
        }
        
        localStorage.setItem('userVisits', JSON.stringify(userVisits));
    }
    
    // Check if user session has changed
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
    
    // Get user status information
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
    
    // Update page elements based on user status
    function updatePageForUser() {
        const status = getUserStatus();
        
        if (status.isLoggedIn) {
            // Mark user as visited
            markUserAsVisited(status.email);
            
            // Update welcome message if element exists
            const userNameElement = document.getElementById('userName');
            if (userNameElement && status.userData.name) {
                const firstName = status.userData.name.split(' ')[0];
                let welcomeText = `Hi ${firstName}!`;
                
                if (status.isReturningUser) {
                    welcomeText = `Welcome back, ${firstName}!`;
                }
                
                // Add user type if seller or dealer
                if (status.userData.type === 'seller') {
                    welcomeText += ' (Seller)';
                } else if (status.userData.type === 'dealer') {
                    welcomeText += ' (Dealer)';
                }
                
                userNameElement.textContent = welcomeText;
            }
            
            // Show user welcome div if it exists
            const userWelcomeDiv = document.getElementById('userWelcome');
            if (userWelcomeDiv) {
                userWelcomeDiv.style.display = 'block';
            }
            
            // Add custom class to body for styling
            document.body.classList.add('user-logged-in');
            
            if (status.isNewUser) {
                document.body.classList.add('new-user');
                document.body.classList.remove('returning-user');
            } else {
                document.body.classList.add('returning-user');
                document.body.classList.remove('new-user');
            }
            
            // Trigger custom events
            if (status.sessionChanged) {
                const eventData = {
                    detail: {
                        isNewUser: status.isNewUser,
                        isReturningUser: status.isReturningUser,
                        userData: status.userData
                    }
                };
                
                // Dispatch custom event for new user
                if (status.isNewUser) {
                    window.dispatchEvent(new CustomEvent('newUserDetected', eventData));
                } else {
                    window.dispatchEvent(new CustomEvent('returningUserDetected', eventData));
                }
                
                // General user session change event
                window.dispatchEvent(new CustomEvent('userSessionChanged', eventData));
            }
        } else {
            // User not logged in
            document.body.classList.remove('user-logged-in', 'new-user', 'returning-user');
            
            const userWelcomeDiv = document.getElementById('userWelcome');
            if (userWelcomeDiv) {
                userWelcomeDiv.style.display = 'none';
            }
        }
    }
    
    // Public API - attach to window object for global access
    window.UserDetector = {
        getCurrentUser: getCurrentUser,
        getUserStatus: getUserStatus,
        isReturningUser: isReturningUser,
        markUserAsVisited: markUserAsVisited,
        updatePageForUser: updatePageForUser
    };
    
    // Initialize when DOM is ready
    function initialize() {
        updatePageForUser();
        
        // Set up storage event listener for cross-tab updates
        window.addEventListener('storage', function(e) {
            if (e.key === 'userVisits') {
                updatePageForUser();
            }
        });
    }
    
    // Initialize immediately if DOM is already loaded
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initialize);
    } else {
        initialize();
    }
    
})();

// Usage Examples (you can customize these event listeners on each page):

// Listen for new user detection
window.addEventListener('newUserDetected', function(e) {
    console.log('New user detected:', e.detail.userData);
    // Add your custom logic for new users here
    // Example: Show onboarding tutorial, special offers, etc.
});

// Listen for returning user detection
window.addEventListener('returningUserDetected', function(e) {
    console.log('Returning user detected:', e.detail.userData);
    // Add your custom logic for returning users here
    // Example: Show "Welcome back" message, recent activity, etc.
});

// Listen for any user session change
window.addEventListener('userSessionChanged', function(e) {
    console.log('User session changed:', e.detail);
    // Add your custom logic for user session changes here
});

// TESTING FUNCTION - Call this to test the GST calculation with sample data
function testGSTCalculation() {
    console.log('=== TESTING GST CALCULATION ===');
    
    // Test cases for your specific tires
    const testCases = [
        { brand: 'Ascenso', name: 'BOSS TN 20', price: 1000, qty: 2 },
        { brand: 'ascenso', name: 'boss tn21', price: 1500, qty: 1 },
        { brand: 'Ascenso', name: 'BOSS TR 20', price: 2000, qty: 1 },
        { brand: 'Ascenso', name: 'boss pr21', price: 1800, qty: 1 },
        { brand: 'Ascenso', name: 'Regular Model', price: 1200, qty: 2 }, // Should get 18%
        { brand: 'MRF', name: 'Some Model', price: 2000, qty: 1 } // Should get 28%
    ];
    
    testCases.forEach(testCase => {
        debugGSTCalculation(testCase.brand, testCase.name, testCase.price, testCase.qty);
        console.log('---');
    });
}

// NEW TESTING FUNCTION - Call this to test the 60km+ free delivery feature
function test60kmFreeDelivery() {
    console.log('=== TESTING 60KM+ FREE DELIVERY FEATURE ===');
    
    // Test cart data with different brand quantities
    const testCartData = [
        { brand: 'MRF', name: 'Test Tire 1', price: 2000, qty: 10 }, // 10 MRF tires
        { brand: 'Ascenso', name: 'Test Tire 2', price: 1500, qty: 15 }, // 15 Ascenso tires (eligible for free)
        { brand: 'Bridgestone', name: 'Test Tire 3', price: 3000, qty: 5 } // 5 Bridgestone tires
    ];
    
    // Test PIN codes with different distances
    const testPincodes = [
        '245101', // 0 km - Hapur main
        '110001', // 45 km - Delhi Central
        '110020', // 65 km - Delhi far areas (60+ km)
        '282001', // 80 km - Agra (60+ km)
        '400001', // 1200 km - Mumbai (very far, 60+ km)
        '999999'  // Unknown PIN (default 100km)
    ];
    
    testPincodes.forEach(pincode => {
        console.log(`\n--- Testing PIN Code: ${pincode} ---`);
        debugShippingCalculation(pincode, testCartData);
        
        // Test the specific 60km+ function
        const result60km = checkFreeShippingEligibilityFor60km(pincode, testCartData);
        console.log('60km+ Free Shipping Details:', result60km);
        
        // Test shipping details display
        const shippingDetails = getShippingDetails(pincode, testCartData);
        console.log('Shipping Details Display:', shippingDetails);
    });
    
    console.log('\n=== END OF 60KM+ FREE DELIVERY TEST ===');
}
    </script>
</body>
</html>