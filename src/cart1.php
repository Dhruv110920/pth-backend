<?php
require_once "db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Tire Shop</title>
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

        .cart-container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
            overflow: hidden;
            border: 3px solid #000;
        }

        .cart-header {
            background: linear-gradient(135deg, #dc143c, #b91c3c);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }

        .cart-header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .cart-header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .back-to-shop {
            position: absolute;
            left: 30px;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255,255,255,0.2);
            border: 2px solid white;
            color: white;
            padding: 12px 20px;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .back-to-shop:hover {
            background: white;
            color: #dc143c;
            transform: translateY(-50%) scale(1.05);
        }

        .cart-content {
            padding: 40px;
            background: white;
        }

        /* Cart Items Section - Moved Up */
        .cart-items-section {
            margin-bottom: 40px;
        }

        /* Product Thumbnails Carousel - Moved Down */
        .product-showcase {
            background: linear-gradient(135deg,white 0%, white 100%);
            padding: 30px;
            margin-top: 40px;
            border-radius: 20px;
            position: relative;
            overflow: hidden;
            border: 2px solid #dc143c;
        }

        .showcase-header {
            text-align: center;
            color: white;
            margin-bottom: 30px;
        }

        .showcase-header h3 {
            font-size: 1.8rem;
            margin-bottom: 10px;
            color: #dc143c;
        }

        .showcase-header p {
            opacity: 0.9;
            font-size: 1rem;
        }

        .thumbnail-carousel {
            position: relative;
            height: 200px;
            overflow: hidden;
            border-radius: 15px;
        }

        .thumbnail-container {
            display: flex;
            transition: transform 0.5s ease-in-out;
            height: 100%;
        }

        .thumbnail-item {
            min-width: 300px;
            height: 180px;
            margin: 0 15px;
            background: white;
            border-radius: 15px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            border: 2px solid #000;
            transition: all 0.3s ease;
        }

        .thumbnail-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(220, 20, 60, 0.3);
            border-color: #dc143c;
        }

        .thumbnail-image {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            overflow: hidden;
            border: 2px solid #000;
            flex-shrink: 0;
        }

        .thumbnail-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .thumbnail-info {
            flex: 1;
        }

        .thumbnail-info h4 {
            font-size: 1.1rem;
            margin-bottom: 5px;
            color: #000;
            font-weight: 700;
        }

        .thumbnail-info .brand {
            color: #dc143c;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        .thumbnail-price {
            font-size: 1.2rem;
            font-weight: 700;
            color: #000;
            margin-bottom: 10px;
        }

        .view-product-btn {
            background: #000;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .view-product-btn:hover {
            background: #dc143c;
            transform: scale(1.05);
        }

        .carousel-controls {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255,255,255,0.9);
            border: 2px solid #000;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.2rem;
            color: #000;
            transition: all 0.3s ease;
        }

        .carousel-controls:hover {
            background: #dc143c;
            color: white;
            transform: translateY(-50%) scale(1.1);
        }

        .prev-btn {
            left: 10px;
        }

        .next-btn {
            right: 10px;
        }

        .carousel-indicators {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255,255,255,0.5);
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid #dc143c;
        }

        .indicator.active {
            background: #dc143c;
            transform: scale(1.2);
        }

        .empty-cart-message {
            text-align: center;
            padding: 60px 20px;
            color: #000;
            background: white;
            border: 2px solid #000;
            border-radius: 15px;
        }

        .empty-cart-message h3 {
            font-size: 2rem;
            margin-bottom: 15px;
            color: #dc143c;
        }

        .empty-cart-message p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            color: #000;
        }

        .continue-shopping-btn {
            background: #000;
            color: white;
            border: 2px solid #000;
            padding: 15px 30px;
            border-radius: 25px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .continue-shopping-btn:hover {
            background: #dc143c;
            border-color: #dc143c;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(220, 20, 60, 0.3);
        }

        .cart-item {
            display: grid;
            grid-template-columns: 120px 1fr auto auto auto;
            gap: 20px;
            align-items: center;
            padding: 25px;
            border: 2px solid #000;
            border-radius: 15px;
            margin-bottom: 20px;
            background: white;
            transition: all 0.3s ease;
        }

        .cart-item:hover {
            border-color: #dc143c;
            box-shadow: 0 5px 15px rgba(220, 20, 60, 0.1);
            transform: translateY(-2px);
        }

        .cart-item-image {
            width: 100px;
            height: 100px;
            border-radius: 10px;
            overflow: hidden;
            background: white;
            border: 2px solid #000;
        }

        .cart-item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .cart-item-info h4 {
            font-size: 1.3rem;
            margin-bottom: 8px;
            color: #000;
            font-weight: 700;
        }

        .cart-item-info .brand {
            color: #dc143c;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .cart-item-info .specs {
            color: #000;
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        .cart-item-info .unit-price {
            color: #000;
            font-size: 0.9rem;
        }

        .cart-item-controls {
            display: flex;
            align-items: center;
            gap: 15px;
            background: white;
            border: 2px solid #000;
            border-radius: 25px;
            padding: 8px 15px;
        }

        .qty-btn {
            background: #000;
            color: white;
            border: none;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: bold;
            transition: all 0.2s ease;
        }

        .qty-btn:hover {
            background: #dc143c;
            transform: scale(1.1);
        }

        .qty {
            font-weight: 700;
            font-size: 1.2rem;
            min-width: 30px;
            text-align: center;
            color: #000;
        }

        .cart-item-price {
            font-size: 1.4rem;
            font-weight: 700;
            color: #dc143c;
            text-align: right;
        }

        .remove-item {
            background: #000;
            color: white;
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }

        .remove-item:hover {
            background: #dc143c;
            transform: scale(1.1);
        }

        .cart-summary {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-top: 30px;
            border: 3px solid #000;
        }

        .cart-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 3px solid #dc143c;
        }

        .cart-total h3 {
            font-size: 1.8rem;
            color: #000;
        }

        .cart-total-amount {
            font-size: 2.2rem;
            font-weight: 700;
            color: #dc143c;
        }

        .cart-actions {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .action-btn {
            padding: 15px 30px;
            border: none;
            border-radius: 25px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            min-width: 180px;
        }

        .checkout-btn {
            background: #000;
            color: white;
            border: 2px solid #000;
        }

        .checkout-btn:hover {
            background: #dc143c;
            border-color: #dc143c;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(220, 20, 60, 0.3);
        }

        .clear-cart-btn {
            background: white;
            color: #000;
            border: 2px solid #000;
        }

        .clear-cart-btn:hover {
            background: #000;
            color: white;
            transform: translateY(-2px);
        }

        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #dc143c;
            color: white;
            padding: 16px 20px;
            border-radius: 25px;
            z-index: 1000;
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.3s ease;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            border: 2px solid #000;
        }

        /* IMPROVED MOBILE STYLES */
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .cart-container {
                border-radius: 15px;
                border-width: 2px;
            }

            .cart-header {
                padding: 20px 15px;
                text-align: center;
            }

            .cart-header h1 {
                font-size: 1.8rem;
                margin-bottom: 8px;
            }

            .cart-header p {
                font-size: 1rem;
            }

            .back-to-shop {
                position: static;
                transform: none;
                margin-bottom: 15px;
                padding: 10px 20px;
                font-size: 0.9rem;
                display: inline-block;
            }

            .cart-content {
                padding: 20px 15px;
            }

            /* Mobile Cart Item - Card Style Layout */
            .cart-item {
                display: block;
                padding: 20px;
                margin-bottom: 20px;
                border-radius: 20px;
                box-shadow: 0 8px 25px rgba(0,0,0,0.1);
                border: 2px solid #000;
            }

            .cart-item-header {
                display: flex;
                align-items: flex-start;
                gap: 15px;
                margin-bottom: 20px;
            }

            .cart-item-image {
                width: 80px;
                height: 80px;
                border-radius: 15px;
                flex-shrink: 0;
            }

            .cart-item-info {
                flex: 1;
            }

            .cart-item-info h4 {
                font-size: 1.1rem;
                margin-bottom: 6px;
                line-height: 1.3;
            }

            .cart-item-info .brand {
                font-size: 0.9rem;
                margin-bottom: 4px;
            }

            .cart-item-info .specs {
                font-size: 0.85rem;
                margin-bottom: 6px;
                opacity: 0.8;
            }

            .cart-item-info .unit-price {
                font-size: 0.9rem;
                color: #666;
            }

            /* Mobile Controls Section */
            .cart-item-actions {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding-top: 15px;
                border-top: 1px solid #eee;
            }

            .cart-item-controls {
                background: #f8f9fa;
                border: 2px solid #000;
                border-radius: 30px;
                padding: 8px 16px;
                gap: 12px;
            }

            .qty-btn {
                width: 32px;
                height: 32px;
                font-size: 1rem;
            }

            .qty {
                font-size: 1.1rem;
                min-width: 25px;
            }

            .cart-item-price {
                font-size: 1.3rem;
                font-weight: 700;
                color: #dc143c;
            }

            .remove-item {
                width: 40px;
                height: 40px;
                font-size: 1rem;
                margin-left: 10px;
            }

            /* Mobile Summary */
            .cart-summary {
                padding: 25px 20px;
                margin-top: 25px;
                border-radius: 20px;
            }

            .cart-total {
                margin-bottom: 20px;
                padding-bottom: 15px;
            }

            .cart-total h3 {
                font-size: 1.4rem;
            }

            .cart-total-amount {
                font-size: 1.8rem;
            }

            .cart-actions {
                flex-direction: column;
                gap: 15px;
            }

            .action-btn {
                min-width: 100%;
                padding: 18px 30px;
                font-size: 1.1rem;
                border-radius: 30px;
            }

            /* Mobile Product Showcase */
            .product-showcase {
                margin-top: 30px;
                padding: 20px 15px;
                border-radius: 15px;
            }

            .showcase-header h3 {
                font-size: 1.4rem;
                margin-bottom: 8px;
            }

            .thumbnail-carousel {
                height: 160px;
            }

            .thumbnail-item {
                min-width: 280px;
                height: 140px;
                padding: 15px;
                margin: 0 10px;
            }

            .thumbnail-image {
                width: 60px;
                height: 60px;
            }

            .thumbnail-info h4 {
                font-size: 1rem;
            }

            .thumbnail-info .brand {
                font-size: 0.85rem;
            }

            .thumbnail-price {
                font-size: 1.1rem;
            }

            .view-product-btn {
                padding: 6px 12px;
                font-size: 0.8rem;
            }

            .carousel-controls {
                width: 35px;
                height: 35px;
                font-size: 1rem;
            }

            /* Mobile Empty Cart */
            .empty-cart-message {
                padding: 40px 20px;
                border-radius: 20px;
            }

            .empty-cart-message h3 {
                font-size: 1.6rem;
            }

            .empty-cart-message p {
                font-size: 1.1rem;
            }

            .continue-shopping-btn {
                padding: 18px 30px;
                font-size: 1.1rem;
                border-radius: 30px;
            }

            /* Mobile Toast */
            .toast {
                top: 15px;
                right: 15px;
                left: 15px;
                padding: 15px 18px;
                border-radius: 20px;
                font-size: 0.95rem;
                text-align: center;
            }
        }

        /* Extra small devices */
        @media (max-width: 480px) {
            .cart-header h1 {
                font-size: 1.6rem;
            }

            .cart-item {
                padding: 15px;
                margin-bottom: 15px;
            }

            .cart-item-header {
                gap: 12px;
                margin-bottom: 15px;
            }

            .cart-item-image {
                width: 70px;
                height: 70px;
            }

            .cart-item-info h4 {
                font-size: 1rem;
            }

            .cart-item-price {
                font-size: 1.2rem;
            }

            .cart-total h3 {
                font-size: 1.3rem;
            }

            .cart-total-amount {
                font-size: 1.6rem;
            }

            .thumbnail-item {
                min-width: 240px;
                height: 130px;
                padding: 12px;
            }

            .thumbnail-image {
                width: 50px;
                height: 50px;
            }
        }
        
    </style>
</head>
<body>
    <div class="cart-container">
        <div class="cart-header">
            <a href="product1.php" class="back-to-shop">
                <i class="fas fa-arrow-left"></i> Continue Shopping
            </a>
            <h1><i class="fas fa-shopping-cart"></i> Shopping Cart</h1>
            <p>Review your selected items</p>
        </div>
        
        <div class="cart-content">
            <!-- Cart Items Section - Now at the top -->
            <div class="cart-items-section">
                <div id="emptyCart" style="display: none;">
                    <!-- Empty cart message will be inserted here by JavaScript -->
                </div>
                
                <div id="cartItems">
                    <!-- Cart items will be dynamically inserted here -->
                </div>
                
                <div id="cartTotal" class="cart-summary">
                    <div class="cart-total">
                        <h3>Total Amount:</h3>
                        <span class="cart-total-amount">₹0.00</span>
                    </div>
                    
                    <div class="cart-actions">
                        <a href="payment1.php" class="action-btn checkout-btn" onclick="return validateCheckout()">
                            <i class="fas fa-credit-card"></i> Proceed to Checkout
                        </a>
                        <button class="action-btn clear-cart-btn" onclick="clearCart()">
                            <i class="fas fa-trash-alt"></i> Clear Cart
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product Showcase Carousel - Now at the bottom -->
            <div class="product-showcase">
                <div class="showcase-header">
                    <h3><i class="fas fa-star"></i> Featured Products</h3>
                    <p>Discover more premium tires for your vehicle</p>
                </div>
                
                <div class="thumbnail-carousel">
                    <button class="carousel-controls prev-btn" onclick="previousSlide()">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    
                    <div class="thumbnail-container" id="thumbnailContainer">
                        <!-- Thumbnails will be populated by JavaScript -->
                    </div>
                    
                    <button class="carousel-controls next-btn" onclick="nextSlide()">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
                
                <div class="carousel-indicators" id="carouselIndicators">
                    <!-- Indicators will be populated by JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <div id="toast" class="toast"></div>

    <script>
        
        // Sample product data for thumbnails with specific redirect pages
const featuredProducts = [
    {
        id: '1',
        name: 'M751 HL',
        brand: 'Bridgestone',
        price: 20750,
        image: 'm751hl.jpg',
        specs: '295/90 R20',
        redirectPage: 'm751hl1.php' // Specific page for this product
    },
    {
        id: '2',
        name: 'R271',
        brand: 'Bridgestone',
        price: 19852,
        image: 'R271.png',
        specs: '295/90 R20',
        redirectPage: 'R2711.php' // Specific page for this product
    },
    {
        id: '17',
        name: 'Endu Race LD',
        brand: 'Apollo',
        price: 20312,
        image: 'LD.png',
        specs: '295/90 R20',
        redirectPage: 'LD1.php' // Specific page for this product
    },
    {
        id: '20',
        name: 'Endu Race RA',
        brand: 'Apollo',
        price: 18906,
        image: 'RA.png',
        specs: '295/90 R20',
        redirectPage: 'RA1.php' // Specific page for this product
    },
    {
        id: '34',
        name: 'Endu Race LD-D',
        brand: 'Apollo',
        price: 10691,
        image: 'LD-D.jpg',
        specs: '8.25 R16',
        redirectPage: 'LD-D1.php' // Specific page for this product
    },
    {
        id: '36',
        name: 'Endu Maxx LT HD(LV)-D',
        brand: 'Apollo',
        price: 6787,
        image: 'LTHD.png',
        specs: '7.00 R15',
        redirectPage: 'LTHD1.php' // Specific page for this product
    }
];

let currentSlide = 0;
let autoSlideInterval;
let cart = [];

// FIXED: Cart functionality with proper ID handling
function loadCart() {
    try {
        // Try localStorage first, then sessionStorage
        let savedCart = localStorage.getItem('unifiedTireShopCart');
        if (!savedCart) {
            savedCart = sessionStorage.getItem('unifiedTireShopCart');
        }
        
        if (savedCart) {
            cart = JSON.parse(savedCart);
            console.log('Cart loaded:', cart);
            
            // Validate cart items and ensure proper data types
            cart = cart.filter(item => item && item.id).map(item => ({
                id: String(item.id), // FIXED: Ensure ID is string for consistency
                name: item.name || 'Unknown Product',
                brand: item.brand || 'Unknown Brand',
                specs: item.specs || 'Standard Specs',
                price: parseFloat(item.price) || 0,
                qty: parseInt(item.qty) || 1,
                image: item.image || 'https://via.placeholder.com/100x100/333/fff?text=Tire'
            }));
        }
    } catch (e) {
        console.error('Error loading cart:', e);
        cart = [];
    }
}

function saveCart() {
    try {
        const cartData = JSON.stringify(cart);
        localStorage.setItem('unifiedTireShopCart', cartData);
        sessionStorage.setItem('unifiedTireShopCart', cartData);
        console.log('Cart saved:', cart);
        
        // Dispatch storage event for cross-tab sync
        window.dispatchEvent(new StorageEvent('storage', {
            key: 'unifiedTireShopCart',
            newValue: cartData,
            storageArea: localStorage
        }));
    } catch (e) {
        console.error('Error saving cart:', e);
    }
}

// FIXED: Use string comparison for IDs and proper error handling
function increaseQty(productId) {
    console.log('Increasing qty for product:', productId, typeof productId);
    
    // Convert to string for consistent comparison
    const stringId = String(productId);
    const item = cart.find(item => String(item.id) === stringId);
    
    if (item) {
        item.qty = parseInt(item.qty) + 1;
        console.log('Increased qty for', item.name, 'to', item.qty);
        updateCartDisplay();
        saveCart();
        showToast('Quantity increased!');
    } else {
        console.error('Item not found in cart:', productId);
        console.log('Current cart:', cart);
    }
}

function decreaseQty(productId) {
    console.log('Decreasing qty for product:', productId, typeof productId);
    
    // Convert to string for consistent comparison
    const stringId = String(productId);
    const item = cart.find(item => String(item.id) === stringId);
    
    if (item) {
        if (parseInt(item.qty) > 1) {
            item.qty = parseInt(item.qty) - 1;
            console.log('Decreased qty for', item.name, 'to', item.qty);
            updateCartDisplay();
            saveCart();
            showToast('Quantity decreased!');
        } else {
            // If quantity is 1, ask if user wants to remove item
            if (confirm(`Remove ${item.name} from cart?`)) {
                removeFromCart(productId);
            }
        }
    } else {
        console.error('Item not found in cart:', productId);
        console.log('Current cart:', cart);
    }
}

function removeFromCart(productId) {
    console.log('Removing product:', productId, typeof productId);
    
    // Convert to string for consistent comparison
    const stringId = String(productId);
    const item = cart.find(item => String(item.id) === stringId);
    
    if (item) {
        if (confirm(`Remove ${item.name} from cart?`)) {
            cart = cart.filter(item => String(item.id) !== stringId);
            console.log('Removed item from cart. New cart:', cart);
            updateCartDisplay();
            saveCart();
            showToast('Item removed from cart!');
        }
    } else {
        console.error('Item not found in cart for removal:', productId);
        console.log('Current cart:', cart);
    }
}

// FIXED: Improved cart display with proper event handling
function updateCartDisplay() {
    const container = document.getElementById('cartItems');
    const totalEl = document.querySelector('.cart-total-amount');
    const cartTotal = document.getElementById('cartTotal');
    const emptyCart = document.getElementById('emptyCart');

    if (!container) {
        console.warn('Cart container not found');
        return;
    }

    container.innerHTML = '';
    let total = 0;

    if (cart.length === 0) {
        if (emptyCart) emptyCart.style.display = 'block';
        if (cartTotal) cartTotal.style.display = 'none';
        
        container.innerHTML = `
            <div class="empty-cart-message">
                <h3>Your cart is empty</h3>
                <p>Add some tires to get started!</p>
                <button onclick="goBackToShop()" class="continue-shopping-btn">
                    Continue Shopping
                </button>
            </div>
        `;
    } else {
        if (emptyCart) emptyCart.style.display = 'none';
        if (cartTotal) cartTotal.style.display = 'block';

        cart.forEach(item => {
            const cartItem = document.createElement('div');
            cartItem.className = 'cart-item';
            
            // FIXED: Use data attributes and better event handling
            cartItem.innerHTML = `
                <div class="cart-item-image">
                    <img src="${item.image}" alt="${item.name}" 
                         onerror="this.src='https://via.placeholder.com/100x100/333/fff?text=Tire'">
                </div>
                <div class="cart-item-info">
                    <h4>${item.name}</h4>
                    <p class="brand">${item.brand}</p>
                    <p class="specs">${item.specs}</p>
                    <p class="unit-price">₹${parseFloat(item.price).toFixed(2)} each</p>
                </div>
                <div class="cart-item-controls">
                    <button class="qty-btn decrease-btn" data-product-id="${item.id}">-</button>
                    <span class="qty">${item.qty}</span>
                    <button class="qty-btn increase-btn" data-product-id="${item.id}">+</button>
                </div>
                <div class="cart-item-price">
                    <strong>₹${(parseFloat(item.price) * parseInt(item.qty)).toFixed(2)}</strong>
                </div>
                <button class="remove-item" data-product-id="${item.id}" title="Remove item">
                    <i class="fas fa-trash"></i>
                </button>
            `;
            
            container.appendChild(cartItem);
            total += parseFloat(item.price) * parseInt(item.qty);
        });

        // FIXED: Add event listeners after elements are created
        addCartEventListeners();
    }

    if (totalEl) totalEl.textContent = `₹${total.toFixed(2)}`;
    updateCartCount();
}

// FIXED: Separate function to add event listeners
function addCartEventListeners() {
    // Add event listeners for increase buttons
    document.querySelectorAll('.increase-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const productId = this.getAttribute('data-product-id');
            console.log('Increase button clicked for:', productId);
            increaseQty(productId);
        });
    });

    // Add event listeners for decrease buttons
    document.querySelectorAll('.decrease-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const productId = this.getAttribute('data-product-id');
            console.log('Decrease button clicked for:', productId);
            decreaseQty(productId);
        });
    });

    // Add event listeners for remove buttons
    document.querySelectorAll('.remove-item').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const productId = this.getAttribute('data-product-id');
            console.log('Remove button clicked for:', productId);
            removeFromCart(productId);
        });
    });
}

function updateCartCount() {
    const count = cart.reduce((sum, item) => sum + parseInt(item.qty), 0);
    const countEl = document.getElementById('cartCount');
    if (countEl) countEl.textContent = count;
}

// FIXED: Improved addToCart function
function addToCart(product) {
    // Ensure product has required properties
    if (!product || !product.id) {
        console.error('Invalid product data:', product);
        showToast('Error adding product to cart');
        return;
    }

    const stringId = String(product.id);
    const existingItem = cart.find(item => String(item.id) === stringId);
    
    if (existingItem) {
        existingItem.qty = parseInt(existingItem.qty) + 1;
        showToast(`Updated ${product.name} quantity!`);
    } else {
        const newItem = {
            id: stringId,
            name: product.name || 'Unknown Product',
            brand: product.brand || 'Unknown Brand',
            specs: product.specs || 'Standard Specs',
            price: parseFloat(product.price) || 0,
            qty: 1,
            image: product.image || 'https://via.placeholder.com/100x100/333/fff?text=Tire'
        };
        
        cart.push(newItem);
        showToast(`${product.name} added to cart!`);
    }
    
    console.log('Cart after adding:', cart);
    saveCart();
    updateCartDisplay();
}

// IMPROVED: Enhanced carousel functionality with proper product redirects
function initializeCarousel() {
    const container = document.getElementById('thumbnailContainer');
    const indicators = document.getElementById('carouselIndicators');
    
    if (!container || !indicators) return;

    container.innerHTML = '';
    indicators.innerHTML = '';

    featuredProducts.forEach((product, index) => {
        // Create thumbnail item
        const thumbnailItem = document.createElement('div');
        thumbnailItem.className = 'thumbnail-item';
        thumbnailItem.innerHTML = `
            <div class="thumbnail-image">
                <img src="${product.image}" alt="${product.name}" onerror="this.src='https://via.placeholder.com/80x80/333/fff?text=Tire'">
            </div>
            <div class="thumbnail-info">
                <h4>${product.name}</h4>
                <p class="brand">${product.brand}</p>
                <div class="thumbnail-price">₹${product.price.toFixed(2)}</div>
                <button class="view-product-btn" onclick="viewProduct('${product.id}')">
                    View Product
                </button>
            </div>
        `;
        container.appendChild(thumbnailItem);

        // Create indicator
        const indicator = document.createElement('div');
        indicator.className = `indicator ${index === 0 ? 'active' : ''}`;
        indicator.onclick = () => goToSlide(index);
        indicators.appendChild(indicator);
    });

    startAutoSlide();
}

function updateCarousel() {
    const container = document.getElementById('thumbnailContainer');
    const indicators = document.querySelectorAll('.indicator');
    
    if (!container) return;

    const itemWidth = 330; // 300px + 30px margin
    container.style.transform = `translateX(-${currentSlide * itemWidth}px)`;

    indicators.forEach((indicator, index) => {
        indicator.classList.toggle('active', index === currentSlide);
    });
}

function nextSlide() {
    currentSlide = (currentSlide + 1) % featuredProducts.length;
    updateCarousel();
    resetAutoSlide();
}

function previousSlide() {
    currentSlide = currentSlide === 0 ? featuredProducts.length - 1 : currentSlide - 1;
    updateCarousel();
    resetAutoSlide();
}

function goToSlide(index) {
    currentSlide = index;
    updateCarousel();
    resetAutoSlide();
}

function startAutoSlide() {
    autoSlideInterval = setInterval(nextSlide, 4000);
}

function resetAutoSlide() {
    clearInterval(autoSlideInterval);
    startAutoSlide();
}

// IMPROVED: Enhanced viewProduct function with specific page redirects
function viewProduct(productId) {
    console.log('Viewing product:', productId);
    
    // Find the product in our featured products array
    const product = featuredProducts.find(p => String(p.id) === String(productId));
    
    if (product && product.redirectPage) {
        // Redirect to the specific page defined for this product
        showToast(`Redirecting to ${product.name} details...`);
        setTimeout(() => {
            window.location.href = product.redirectPage;
        }, 500);
    } else {
        // Fallback to generic product detail page with ID parameter
        showToast('Redirecting to product details...');
        setTimeout(() => {
            window.location.href = `product-detail.php?id=${productId}`;
        }, 500);
    }
}

// Additional utility functions
function clearCart() {
    if (cart.length === 0) {
        alert('Cart is already empty!');
        return;
    }
    
    if (confirm('Are you sure you want to clear your entire cart?')) {
        cart = [];
        updateCartDisplay();
        saveCart();
        showToast('Cart cleared!');
    }
}

function goBackToShop() {
    window.location.href = 'frontage.php';
}

function showToast(msg) {
    let toast = document.getElementById('toast');
    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'toast';
        toast.className = 'toast';
        toast.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: #4CAF50;
            color: white;
            padding: 16px;
            border-radius: 4px;
            z-index: 1000;
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.3s ease;
        `;
        document.body.appendChild(toast);
    }
    
    toast.textContent = msg;
    toast.style.opacity = '1';
    toast.style.transform = 'translateX(0)';
    
    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(100%)';
    }, 2000);
}

function checkout() {
    if (cart.length === 0) {
        alert('Your cart is empty!');
        return;
    }
    
    const validatedCart = cart.map(item => ({
        id: String(item.id),
        name: item.name || 'Tire Product',
        brand: item.brand || 'Unknown Brand',
        specs: item.specs || 'Standard Specifications',
        price: parseFloat(item.price) || 0,
        qty: parseInt(item.qty) || 1,
        image: item.image || 'placeholder.jpg'
    }));
    
    try {
        sessionStorage.setItem('checkoutCart', JSON.stringify(validatedCart));
        window.location.href = 'payment1.php';
    } catch (e) {
        console.error('Error preparing checkout data:', e);
        alert('Error preparing checkout. Please try again.');
    }
}

// Event listeners
window.addEventListener('storage', function(e) {
    if (e.key === 'unifiedTireShopCart') {
        loadCart();
        updateCartDisplay();
    }
});

// Initialize everything on page load
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing...');
    loadCart();
    updateCartDisplay();
    initializeCarousel();
    
    // Pause auto-slide when user hovers over carousel
    const carousel = document.querySelector('.thumbnail-carousel');
    if (carousel) {
        carousel.addEventListener('mouseenter', () => {
            clearInterval(autoSlideInterval);
        });
        
        carousel.addEventListener('mouseleave', () => {
            startAutoSlide();
        });
    }
});
    </script>
</body>
</html>