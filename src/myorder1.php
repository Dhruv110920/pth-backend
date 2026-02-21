<?php
require_once "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - Tire Shop</title>
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

/* Animated background particles */
body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle at 20% 20%, rgba(220, 53, 69, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(0, 0, 0, 0.02) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(220, 53, 69, 0.02) 0%, transparent 50%);
    animation: backgroundFloat 20s ease-in-out infinite;
    pointer-events: none;
    z-index: -1;
}

@keyframes backgroundFloat {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    33% { transform: translateY(-10px) rotate(1deg); }
    66% { transform: translateY(5px) rotate(-1deg); }
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    background: white;
    border-radius: 20px;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15), 
                0 0 0 1px rgba(220, 53, 69, 0.1);
    overflow: hidden;
    animation: containerFadeIn 0.8s ease-out;
}

@keyframes containerFadeIn {
    from { 
        opacity: 0; 
        transform: translateY(30px) scale(0.95); 
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
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    animation: headerPulse 4s ease-in-out infinite;
}

.header::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    animation: headerShine 3s ease-in-out infinite;
}

@keyframes headerPulse {
    0%, 100% { transform: scale(1) rotate(0deg); opacity: 0.3; }
    50% { transform: scale(1.1) rotate(180deg); opacity: 0.6; }
}

@keyframes headerShine {
    0% { left: -100%; }
    100% { left: 100%; }
}

.header h1 {
    font-size: 3rem;
    margin-bottom: 10px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    position: relative;
    z-index: 1;
    animation: titleGlow 2s ease-in-out infinite alternate;
}

@keyframes titleGlow {
    from { text-shadow: 2px 2px 4px rgba(0,0,0,0.5), 0 0 20px rgba(220, 53, 69, 0.3); }
    to { text-shadow: 2px 2px 4px rgba(0,0,0,0.5), 0 0 30px rgba(220, 53, 69, 0.6); }
}

.header p {
    font-size: 1.2rem;
    opacity: 0.9;
    position: relative;
    z-index: 1;
}

/* Back to Home Button */
.back-home-btn {
    position: absolute;
    top: 20px;
    left: 20px;
    background: rgba(255, 255, 255, 0.2);
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
    background: rgba(255, 255, 255, 0.3);
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
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border-left: 5px solid #dc3545;
    border: 1px solid rgba(220, 53, 69, 0.1);
    position: relative;
    overflow: hidden;
    animation: cardSlideIn 0.6s ease-out;
}

@keyframes cardSlideIn {
    from { 
        opacity: 0; 
        transform: translateY(30px) rotateX(10deg); 
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
    background: linear-gradient(90deg, transparent, rgba(220, 53, 69, 0.05), transparent);
    transition: left 0.6s ease;
}

.order-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15), 
                0 0 0 1px rgba(220, 53, 69, 0.2);
    border-left-color: #000000;
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

.otp-container {
    display: flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, #fff5f5 0%, #ffe6e6 100%);
    padding: 12px 18px;
    border-radius: 10px;
    border: 2px solid #ffcccc;
    transition: all 0.3s ease;
    animation: otpGlow 3s ease-in-out infinite;
}

@keyframes otpGlow {
    0%, 100% { box-shadow: 0 0 5px rgba(220, 53, 69, 0.2); }
    50% { box-shadow: 0 0 20px rgba(220, 53, 69, 0.4); }
}

.otp-container:hover {
    transform: scale(1.05);
    border-color: #dc3545;
}

.otp-label {
    font-weight: bold;
    color: #dc3545;
}

.otp-code {
    font-family: 'Courier New', monospace;
    font-size: 1.1rem;
    font-weight: bold;
    color: #000000;
    cursor: pointer;
    transition: all 0.3s ease;
    padding: 4px 8px;
    border-radius: 4px;
    background: rgba(220, 53, 69, 0.1);
}

.otp-code:hover {
    color: #dc3545;
    background: rgba(220, 53, 69, 0.2);
    transform: scale(1.1);
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
    transition: all 0.3s ease;
    animation: badgePulse 2s ease-in-out infinite;
}

@keyframes badgePulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.status-processing {
    background: linear-gradient(135deg, #fff3cd, #ffeaa7);
    color: #856404;
    border: 1px solid #f9ca24;
}

.status-shipped {
    background: linear-gradient(135deg, #d4edda, #a8e6cf);
    color: #155724;
    border: 1px solid #27ae60;
}

.status-delivered {
    background: linear-gradient(135deg, #d1ecf1, #74b9ff);
    color: #0c5460;
    border: 1px solid #0984e3;
}

.status-cancelled {
    background: linear-gradient(135deg, #f8d7da, #fab1a0);
    color: #721c24;
    border: 1px solid #e17055;
}

.order-tracking {
    margin: 20px 0;
    padding: 25px;
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    border-radius: 15px;
    border: 2px solid #f1f3f4;
    transition: all 0.3s ease;
}

.order-tracking:hover {
    border-color: rgba(220, 53, 69, 0.3);
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.1);
}

.tracking-steps {
    display: flex;
    justify-content: space-between;
    position: relative;
    margin-bottom: 20px;
}

.tracking-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    flex: 1;
    position: relative;
    animation: stepFadeIn 0.6s ease-out;
}

@keyframes stepFadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.step-circle {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    margin-bottom: 10px;
    transition: all 0.4s ease;
    border: 3px solid transparent;
}

.step-circle.completed {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    animation: completedBounce 0.6s ease-out;
}

@keyframes completedBounce {
    0% { transform: scale(0.8); }
    50% { transform: scale(1.2); }
    100% { transform: scale(1); }
}

.step-circle.active {
    background: linear-gradient(135deg, #dc3545, #ff6b7a);
    color: white;
    border-color: white;
    animation: activePulse 2s infinite;
}

@keyframes activePulse {
    0% { 
        box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7);
        transform: scale(1);
    }
    70% { 
        box-shadow: 0 0 0 15px rgba(220, 53, 69, 0);
        transform: scale(1.1);
    }
    100% { 
        box-shadow: 0 0 0 0 rgba(220, 53, 69, 0);
        transform: scale(1);
    }
}

.step-circle.pending {
    background: #f8f9fa;
    color: #6c757d;
    border-color: #e9ecef;
}

.step-label {
    font-size: 0.8rem;
    text-align: center;
    font-weight: bold;
    color: #000000;
    transition: color 0.3s ease;
}

.tracking-line {
    position: absolute;
    top: 22px;
    left: 50px;
    right: 50px;
    height: 3px;
    background: #e9ecef;
    z-index: 0;
    border-radius: 2px;
}

.tracking-progress {
    height: 100%;
    background: linear-gradient(90deg, #dc3545, #000000, #dc3545);
    transition: width 0.8s ease;
    border-radius: 2px;
    animation: progressShine 2s ease-in-out infinite;
}

@keyframes progressShine {
    0% { background-position: -200% 0; }
    100% { background-position: 200% 0; }
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
    background: linear-gradient(135deg, #ffffff 0%, #fafafa 100%);
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
    transform: translateX(10px);
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.1);
    border-color: rgba(220, 53, 69, 0.3);
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
    border-color: #dc3545;
    transform: scale(1.1);
}

.item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.item-image:hover img {
    transform: scale(1.2);
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
    color: #dc3545;
    font-size: 1.1rem;
    animation: priceGlow 3s ease-in-out infinite;
}

@keyframes priceGlow {
    0%, 100% { text-shadow: none; }
    50% { text-shadow: 0 0 10px rgba(220, 53, 69, 0.5); }
}

.order-actions {
    display: flex;
    gap: 15px;
    margin-top: 25px;
    flex-wrap: wrap;
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

.btn-secondary {
    background: linear-gradient(135deg, #6c757d 0%, #000000 100%);
    color: white;
}

.btn-secondary:hover {
    background: linear-gradient(135deg, #000000 0%, #6c757d 100%);
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 8px 20px rgba(108, 117, 125, 0.4);
}

.btn-danger {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
}

.btn-danger:hover {
    background: linear-gradient(135deg, #c82333 0%, #dc3545 100%);
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 10px 25px rgba(220, 53, 69, 0.5);
}

.btn-outline {
    background: transparent;
    border: 2px solid #dc3545;
    color: #dc3545;
    position: relative;
}

.btn-outline:hover {
    background: #dc3545;
    color: white;
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 8px 20px rgba(220, 53, 69, 0.3);
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

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.6);
    animation: modalFadeIn 0.3s ease;
    backdrop-filter: blur(5px);
}

@keyframes modalFadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.modal-content {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    margin: 5% auto;
    padding: 35px;
    border-radius: 20px;
    width: 90%;
    max-width: 500px;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
    animation: modalSlideIn 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid rgba(220, 53, 69, 0.1);
}

@keyframes modalSlideIn {
    from { 
        transform: translateY(-50px) scale(0.9); 
        opacity: 0; 
    }
    to { 
        transform: translateY(0) scale(1); 
        opacity: 1; 
    }
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 2px solid #f0f0f0;
}

.modal-title {
    font-size: 1.6rem;
    font-weight: bold;
    color: #000000;
}

.close {
    font-size: 2rem;
    font-weight: bold;
    cursor: pointer;
    color: #aaa;
    transition: all 0.3s ease;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.close:hover {
    color: #dc3545;
    background: rgba(220, 53, 69, 0.1);
    transform: rotate(90deg) scale(1.1);
}

.form-group {
    margin-bottom: 25px;
}

.form-group label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
    color: #000000;
}

.form-group select,
.form-group textarea {
    width: 100%;
    padding: 15px;
    border: 2px solid #e0e0e0;
    border-radius: 10px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: white;
}

.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #dc3545;
    box-shadow: 0 0 15px rgba(220, 53, 69, 0.2);
    transform: translateY(-2px);
}

.form-group textarea {
    resize: vertical;
    min-height: 120px;
}

.modal-actions {
    display: flex;
    gap: 15px;
    justify-content: flex-end;
    margin-top: 30px;
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

    .tracking-steps {
        flex-direction: column;
        gap: 20px;
    }

    .tracking-line {
        display: none;
    }

    .order-actions {
        flex-direction: column;
    }

    .btn {
        text-align: center;
        justify-content: center;
    }

    .modal-content {
        margin: 10% auto;
        padding: 25px;
    }

    .back-home-btn {
        position: relative;
        margin-bottom: 20px;
    }
}

/* Additional hover animations */
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
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="frontage.php" class="back-home-btn">
                <span>Back to Home</span>
            </a>
            <h1>My Orders</h1>
            <p>Track and manage your tire orders</p>
        </div>

        <div class="content">
            <div class="filters">
                <div class="filter-group">
                    <label for="statusFilter">Filter by Status:</label>
                    <select id="statusFilter">
                        <option value="">All Orders</option>
                        <option value="Processing">Processing</option>
                        <option value="Shipped">Shipped</option>
                        <option value="Out for Delivery">Out for Delivery</option>
                        <option value="Delivered">Delivered</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="sortFilter">Sort by:</label>
                    <select id="sortFilter">
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="amount-high">Amount: High to Low</option>
                        <option value="amount-low">Amount: Low to High</option>
                    </select>
                </div>
            </div>

            <div class="orders-container" id="ordersContainer">
                <!-- Orders will be dynamically loaded here -->
            </div>
        </div>
    </div>

    <!-- Cancel Order Modal -->
    <div id="cancelModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Cancel Order</h2>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to cancel this order?</p>
                <p><strong>Order ID:</strong> <span id="cancelOrderId"></span></p>
                
                <div class="form-group">
                    <label for="cancelReason">Reason for cancellation:</label>
                    <select id="cancelReason" required>
                        <option value="">Select a reason</option>
                        <option value="changed-mind">Changed my mind</option>
                        <option value="found-better-price">Found better price elsewhere</option>
                        <option value="ordered-by-mistake">Ordered by mistake</option>
                        <option value="delivery-too-long">Delivery taking too long</option>
                        <option value="wrong-product">Wrong product ordered</option>
                        <option value="financial-reasons">Financial reasons</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="cancelComments">Additional comments (optional):</label>
                    <textarea id="cancelComments" placeholder="Please provide any additional details..."></textarea>
                </div>
            </div>
            <div class="modal-actions">
                <button class="btn btn-secondary" onclick="closeCancelModal()">Keep Order</button>
                <button class="btn btn-danger" onclick="confirmCancelOrder()">Cancel Order</button>
            </div>
        </div>
    </div>

    <script>
// Order data storage
let orders = [];
let currentCancelOrderId = null;
let currentCancelItemIndex = null;

// Initialize orders
function initializeOrders() {
    // Load orders from localStorage only (no sample data)
    const savedOrders = localStorage.getItem('orderHistory');
    if (savedOrders) {
        try {
            orders = JSON.parse(savedOrders);
            // Ensure all items have status property and update tracking status
            orders.forEach(order => {
                order.items.forEach(item => {
                    if (!item.status) {
                        item.status = 'active';
                    }
                });
                
                // Update tracking status based on seller actions
                updateTrackingStatus(order);
            });
        } catch (e) {
            console.error('Error loading orders:', e);
            orders = [];
        }
    } else {
        orders = [];
    }

    displayOrders();
    
    // Set up periodic refresh to check for seller updates
    setInterval(refreshOrdersFromSeller, 5000); // Check every 5 seconds
}

// Function to refresh orders from seller updates
function refreshOrdersFromSeller() {
    const savedOrders = localStorage.getItem('orderHistory');
    if (savedOrders) {
        try {
            const updatedOrders = JSON.parse(savedOrders);
            
            // If localStorage is empty or has fewer orders than our current orders array,
            // it means seller has removed/cancelled orders, so don't update our local array
            if (!updatedOrders || updatedOrders.length === 0) {
                console.log('No orders in localStorage or localStorage cleared by seller, preserving local order history');
                return;
            }
            
            let hasChanges = false;
            
            // Only check for status updates on existing orders, don't remove any orders
            orders.forEach(existingOrder => {
                const updatedOrder = updatedOrders.find(o => o.orderId === existingOrder.orderId);
                if (updatedOrder) {
                    // Check if status changed
                    if (existingOrder.status !== updatedOrder.status) {
                        hasChanges = true;
                        showTrackingNotification(updatedOrder);
                        
                        // Update only the status and tracking related fields, preserve other data
                        existingOrder.status = updatedOrder.status;
                    }
                    
                    // Update delivery information if provided by seller
                    if (updatedOrder.deliveryPerson && !existingOrder.deliveryPerson) {
                        existingOrder.deliveryPerson = updatedOrder.deliveryPerson;
                        hasChanges = true;
                    }
                    
                    if (updatedOrder.deliveryPattern && !existingOrder.deliveryPattern) {
                        existingOrder.deliveryPattern = updatedOrder.deliveryPattern;
                        hasChanges = true;
                    }
                    
                    // Update tracking status
                    updateTrackingStatus(existingOrder);
                }
            });
            
            // Check for genuinely new orders (orders that don't exist in our local array)
            updatedOrders.forEach(updatedOrder => {
                const existsLocally = orders.find(o => o.orderId === updatedOrder.orderId);
                if (!existsLocally) {
                    // This is a genuinely new order, add it
                    orders.push(updatedOrder);
                    updateTrackingStatus(updatedOrder);
                    hasChanges = true;
                }
            });
            
            if (hasChanges) {
                displayOrders();
            }
        } catch (e) {
            console.error('Error refreshing orders:', e);
        }
    }
}

// Function to update tracking status based on seller actions
function updateTrackingStatus(order) {
    // Map seller statuses to customer tracking statuses
    if (order.status === 'Processing' && order.deliveryPerson && order.deliveryPattern) {
        // When seller assigns delivery person, show "Out for Delivery"
        order.trackingStatus = 'Out for Delivery';
    } else if (order.status === 'Completed') {
        // When seller completes order, show "Delivered"
        order.trackingStatus = 'Delivered';
    } else if (order.status === 'New') {
        // New orders are being processed
        order.trackingStatus = 'Processing';
    } else {
        // Use the original status as tracking status
        order.trackingStatus = order.status;
    }
}

// Show tracking notification when order status changes
function showTrackingNotification(order) {
    let message = '';
    let type = 'info';
    
    switch (order.status) {
        case 'Processing':
            if (order.deliveryPerson) {
                message = `Order ${order.orderId} is out for delivery with ${order.deliveryPerson}`;
                type = 'success';
            } else {
                message = `Order ${order.orderId} is being processed`;
                type = 'info';
            }
            break;
        case 'Completed':
            message = `Order ${order.orderId} has been delivered successfully!`;
            type = 'success';
            break;
        default:
            message = `Order ${order.orderId} status updated to ${order.status}`;
            type = 'info';
    }
    
    showToast(message, type);
}

// Calculate order totals excluding cancelled items
function calculateOrderTotal(order) {
    return order.items
        .filter(item => item.status === 'active')
        .reduce((total, item) => total + (item.price * item.qty), 0);
}

// Get order status based on items and seller actions
function getOrderStatus(order) {
    const activeItems = order.items.filter(item => item.status === 'active');
    const cancelledItems = order.items.filter(item => item.status === 'cancelled');
    
    if (activeItems.length === 0) {
        return 'Cancelled';
    } else if (cancelledItems.length > 0) {
        return order.trackingStatus ? order.trackingStatus + ' (Partial)' : order.status + ' (Partial)';
    } else {
        return order.trackingStatus || order.status;
    }
}

// Check if order can be cancelled
function canCancelOrder(order) {
    const trackingStatus = order.trackingStatus || order.status;
    return trackingStatus !== 'Delivered' && 
           trackingStatus !== 'Cancelled' && 
           trackingStatus !== 'Out for Delivery';
}

// Display orders
function displayOrders() {
    const container = document.getElementById('ordersContainer');
    const statusFilter = document.getElementById('statusFilter').value;
    const sortFilter = document.getElementById('sortFilter').value;

    // Filter orders
    let filteredOrders = orders;
    if (statusFilter) {
        filteredOrders = orders.filter(order => {
            const orderStatus = getOrderStatus(order);
            return orderStatus.includes(statusFilter);
        });
    }

    // Sort orders
    filteredOrders.sort((a, b) => {
        switch (sortFilter) {
            case 'oldest':
                return new Date(a.date) - new Date(b.date);
            case 'amount-high':
                return calculateOrderTotal(b) - calculateOrderTotal(a);
            case 'amount-low':
                return calculateOrderTotal(a) - calculateOrderTotal(b);
            case 'newest':
            default:
                return new Date(b.date) - new Date(a.date);
        }
    });

    if (filteredOrders.length === 0) {
        container.innerHTML = `
            <div class="no-orders">
                <h3>No Orders Found</h3>
                <p>You haven't placed any orders yet, or no orders match your current filter.</p>
                <a href="frontage.php" class="btn btn-primary">Shop Now</a>
            </div>
        `;
        return;
    }

    container.innerHTML = '';
    filteredOrders.forEach(order => {
        const orderCard = createOrderCard(order);
        container.appendChild(orderCard);
    });
}

// Create order card
function createOrderCard(order) {
    const div = document.createElement('div');
    div.className = 'order-card';
    
    const orderStatus = getOrderStatus(order);
    const statusClass = getStatusClass(orderStatus);
    const trackingData = getTrackingData(order);
    const activeItems = order.items.filter(item => item.status === 'active');
    const cancelledItems = order.items.filter(item => item.status === 'cancelled');
    const canCancel = canCancelOrder(order);
    
    // Show delivery info if available
    let deliveryInfo = '';
    if (order.deliveryPerson && order.deliveryPattern) {
        deliveryInfo = `
            <div class="delivery-info-section">
                <div class="delivery-pattern">
                    <i class="fas fa-truck"></i> ${order.deliveryPattern}
                </div>
                <div class="delivery-person">
                    <i class="fas fa-user"></i> Delivery Person: ${order.deliveryPerson}
                </div>
            </div>
        `;
    }
    
    div.innerHTML = `
        <div class="order-header">
            <div class="order-info">
                <div class="order-id" onclick="copyToClipboard('${order.orderId}', 'Order ID')" title="Click to copy">
                    ${order.orderId}
                </div>
                <div class="order-date">
                    Ordered on ${formatDate(new Date(order.date))}
                </div>
            </div>
            
            <div class="otp-container">
                <span class="otp-label">OTP:</span>
                <span class="otp-code" onclick="copyToClipboard('${order.otp}', 'OTP')" title="Click to copy">
                    ${order.otp}
                </span>
            </div>
            
            <div class="order-status">
                <span class="status-badge ${statusClass}">${orderStatus}</span>
            </div>
        </div>

        ${deliveryInfo}

        <div class="order-tracking">
            <div class="tracking-steps">
                <div class="tracking-line">
                    <div class="tracking-progress" style="width: ${trackingData.progress}%"></div>
                </div>
                ${trackingData.steps.map((step, index) => `
                    <div class="tracking-step">
                        <div class="step-circle ${step.status}">
                            ${step.icon || (index + 1)}
                        </div>
                        <div class="step-label">${step.label}</div>
                        ${step.person ? `<div class="step-person">${step.person}</div>` : ''}
                    </div>
                `).join('')}
            </div>
        </div>

        <div class="order-items">
            <div class="items-header">Order Items:</div>
            ${order.items.map((item, index) => `
                <div class="item-row ${item.status === 'cancelled' ? 'cancelled-item' : ''}">
                    <div class="item-image">
                        <img src="${item.image}" alt="${item.name}" 
                             onerror="this.src='https://via.placeholder.com/100x100/ff0000/ffffff?text=TIRE'">
                    </div>
                    <div class="item-details">
                        <div class="item-name">${item.name}</div>
                        <div class="item-specs">${item.brand} - ${item.specs}</div>
                        ${item.status === 'cancelled' ? '<div class="item-cancelled-label">CANCELLED</div>' : ''}
                    </div>
                    <div class="item-price">
                        ₹${item.price.toFixed(2)} x ${item.qty}
                    </div>
                    <div class="item-actions">
                        ${item.status === 'active' && canCancel ? 
                            `<button class="btn btn-sm btn-danger" onclick="openCancelItemModal('${order.orderId}', ${index})">
                                Cancel Item
                            </button>` : ''
                        }
                    </div>
                </div>
            `).join('')}
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px; padding-top: 15px; border-top: 1px solid #e9ecef;">
            <div>
                <strong>Active Items Total: ₹${calculateOrderTotal(order).toFixed(2)}</strong>
                ${cancelledItems.length > 0 ? `<br><small style="color: #dc3545;">Cancelled Items: ${cancelledItems.length}</small>` : ''}
                <br><small>Payment: ${order.paymentMethod}</small>
            </div>
            <div class="order-actions">
                ${activeItems.length > 0 && canCancel ? 
                    `<button class="btn btn-danger" onclick="openCancelAllModal('${order.orderId}')">
                        Cancel All Items
                    </button>` : ''
                }
            </div>
        </div>
    `;
    
    return div;
}

// Get status class
function getStatusClass(status) {
    switch (status.toLowerCase()) {
        case 'processing':
            return 'status-processing';
        case 'shipped':
        case 'out for delivery':
            return 'status-shipped';
        case 'delivered':
            return 'status-delivered';
        case 'cancelled':
            return 'status-cancelled';
        default:
            if (status.includes('Partial')) {
                return 'status-partial';
            }
            return 'status-processing';
    }
}

// Enhanced tracking data with seller integration
function getTrackingData(order) {
    const steps = [
        { label: 'Order Placed', status: 'completed', icon: '📦' },
        { label: 'Processing', status: 'completed', icon: '⚙️' },
        { label: 'Out for Delivery', status: 'pending', icon: '🚚' },
        { label: 'Delivered', status: 'pending', icon: '✅' }
    ];

    let progress = 25;
    let activeStep = 0;

    // Use trackingStatus instead of status for better tracking
    const trackingStatus = order.trackingStatus || order.status;

    switch (trackingStatus.toLowerCase()) {
        case 'processing':
            progress = 50;
            activeStep = 1;
            steps[1].status = 'active';
            break;
        case 'shipped':
        case 'out for delivery':
            progress = 75;
            activeStep = 2;
            steps[2].status = 'active';
            // Add delivery person info if available
            if (order.deliveryPerson) {
                steps[2].person = order.deliveryPerson;
                steps[2].label = `Out for Delivery`;
            }
            break;
        case 'delivered':
            progress = 100;
            activeStep = 3;
            steps[2].status = 'completed';
            steps[3].status = 'completed';
            if (order.deliveryPerson) {
                steps[3].person = `Delivered by ${order.deliveryPerson}`;
            }
            break;
        case 'cancelled':
            progress = 0;
            steps = [
                { label: 'Order Placed', status: 'completed', icon: '📦' },
                { label: 'Cancelled', status: 'completed', icon: '❌' }
            ];
            break;
        default:
            // New orders
            steps[0].status = 'active';
    }

    return { steps, progress };
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

// Open cancel item modal
function openCancelItemModal(orderId, itemIndex) {
    const order = orders.find(o => o.orderId === orderId);
    if (!order) {
        showToast('Order not found!', 'error');
        return;
    }

    const item = order.items[itemIndex];
    if (!item || item.status === 'cancelled') {
        showToast('Item not found or already cancelled!', 'error');
        return;
    }

    if (!canCancelOrder(order)) {
        showToast('This item cannot be cancelled. Order is out for delivery or already delivered.', 'error');
        return;
    }

    currentCancelOrderId = orderId;
    currentCancelItemIndex = itemIndex;
    
    // Update modal content for item cancellation
    document.getElementById('cancelOrderId').textContent = `${orderId} - ${item.name}`;
    document.getElementById('cancelReason').value = '';
    document.getElementById('cancelComments').value = '';
    document.getElementById('cancelModal').style.display = 'block';
}

// Open cancel all items modal
function openCancelAllModal(orderId) {
    const order = orders.find(o => o.orderId === orderId);
    if (!order) {
        showToast('Order not found!', 'error');
        return;
    }

    if (!canCancelOrder(order)) {
        showToast('This order cannot be cancelled. Order is out for delivery or already delivered.', 'error');
        return;
    }

    currentCancelOrderId = orderId;
    currentCancelItemIndex = null;
    
    document.getElementById('cancelOrderId').textContent = `${orderId} - All Items`;
    document.getElementById('cancelReason').value = '';
    document.getElementById('cancelComments').value = '';
    document.getElementById('cancelModal').style.display = 'block';
}

// Close cancel modal
function closeCancelModal() {
    document.getElementById('cancelModal').style.display = 'none';
    currentCancelOrderId = null;
    currentCancelItemIndex = null;
}

// Confirm cancel order/item
function confirmCancelOrder() {
    const reason = document.getElementById('cancelReason').value;
    const comments = document.getElementById('cancelComments').value;

    if (!reason) {
        showToast('Please select a reason for cancellation.', 'error');
        return;
    }

    if (!currentCancelOrderId) {
        showToast('No order selected for cancellation.', 'error');
        return;
    }

    // Find the order
    const orderIndex = orders.findIndex(o => o.orderId === currentCancelOrderId);
    if (orderIndex === -1) {
        showToast('Order not found!', 'error');
        return;
    }

    const order = orders[orderIndex];

    // Double-check if cancellation is still allowed
    if (!canCancelOrder(order)) {
        showToast('This order cannot be cancelled. Order is out for delivery or already delivered.', 'error');
        closeCancelModal();
        return;
    }

    if (currentCancelItemIndex !== null) {
        // Cancel specific item
        if (order.items[currentCancelItemIndex]) {
            order.items[currentCancelItemIndex].status = 'cancelled';
            order.items[currentCancelItemIndex].cancellationReason = reason;
            order.items[currentCancelItemIndex].cancellationComments = comments;
            order.items[currentCancelItemIndex].cancellationDate = new Date().toISOString();
            
            // Update order total
            order.total = calculateOrderTotal(order);
            
            showToast(`Item from Order ${currentCancelOrderId} has been cancelled successfully.`, 'success');
        }
    } else {
        // Cancel all items
        order.items.forEach(item => {
            if (item.status === 'active') {
                item.status = 'cancelled';
                item.cancellationReason = reason;
                item.cancellationComments = comments;
                item.cancellationDate = new Date().toISOString();
            }
        });
        
        // Update order total
        order.total = 0;
        
        showToast(`All items in Order ${currentCancelOrderId} have been cancelled successfully.`, 'success');
    }

    // Save to localStorage
    localStorage.setItem('orderHistory', JSON.stringify(orders));

    // Close modal and refresh display
    closeCancelModal();
    displayOrders();
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    initializeOrders();

    // Filter and sort event listeners
    document.getElementById('statusFilter').addEventListener('change', displayOrders);
    document.getElementById('sortFilter').addEventListener('change', displayOrders);

    // Modal event listeners
    const modal = document.getElementById('cancelModal');
    if (modal) {
        const closeBtn = modal.querySelector('.close');
        if (closeBtn) {
            closeBtn.addEventListener('click', closeCancelModal);
        }

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                closeCancelModal();
            }
        });
    }

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Escape key to close modal
        if (e.key === 'Escape' && modal && modal.style.display === 'block') {
            closeCancelModal();
        }
        
        // Ctrl+H for home
        if (e.ctrlKey && e.key === 'h') {
            e.preventDefault();
            window.location.href = 'frontage.php';
        }
        
        // F5 to refresh orders
        if (e.key === 'F5') {
            e.preventDefault();
            refreshOrdersFromSeller();
            showToast('Orders refreshed!', 'info');
        }
    });
});

// Navigation functions
function goHome() {
    window.location.href = 'frontage.php';
}

function goToCart() {
    window.location.href = 'cart1.php';
}

function goToCheckout() {
    window.location.href = 'checkout.php';
}

// Manual refresh function for testing
function manualRefresh() {
    refreshOrdersFromSeller();
    showToast('Checking for order updates...', 'info');
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
    </script>
</body>
</html>