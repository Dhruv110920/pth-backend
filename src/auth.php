<?php
require_once "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pradhat Tyre House</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4e6e1;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            padding: 60px 40px;
            text-align: center;
            max-width: 900px;
            width: 100%;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            position: relative;
        }
        .logo {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
            border-radius: 50%;
            margin: 0 auto 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 4px solid #d63031;
            animation: logoFloat 3s ease-in-out infinite;
            overflow: hidden;
        }
        .logo img { width: 80px; height: 80px; object-fit: contain; border-radius: 50%; }
        @keyframes logoFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        h1 { font-size: 2.5rem; color: #2d3436; margin-bottom: 20px; font-weight: 600; }
        .subtitle {
            font-size: 1.1rem;
            color: #636e72;
            margin-bottom: 50px;
            line-height: 1.6;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        .features {
            display: flex;
            justify-content: space-around;
            margin-bottom: 60px;
            flex-wrap: wrap;
            gap: 40px;
        }
        .feature { text-align: center; flex: 1; min-width: 200px; max-width: 250px; }
        .feature-icon {
            width: 80px; height: 80px;
            margin: 0 auto 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
        }
        .feature:nth-child(1) .feature-icon { background: linear-gradient(135deg, #ff6b6b, #ee5a24); }
        .feature:nth-child(2) .feature-icon { background: linear-gradient(135deg, #fdcb6e, #e17055); }
        .feature:nth-child(3) .feature-icon { background: linear-gradient(135deg, #00b894, #00a085); }
        .feature h3 { font-size: 1.3rem; color: #2d3436; margin-bottom: 10px; }
        .feature p { color: #636e72; line-height: 1.4; font-size: 0.95rem; }
        .buttons { display: flex; justify-content: center; gap: 15px; flex-wrap: wrap; }
        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 25px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 120px;
        }
        .btn-login { background-color: #d63031; color: white; }
        .btn-login:hover { background-color: #b71c1c; transform: translateY(-2px); }
        .btn-signup { background-color: #00b894; color: white; }
        .btn-signup:hover { background-color: #00a085; transform: translateY(-2px); }
        .btn-seller { background-color: #fdcb6e; color: #2d3436; }
        .btn-seller:hover { background-color: #e17055; color: white; transform: translateY(-2px); }
        .btn-dealer { background-color: #6c5ce7; color: white; }
        .btn-dealer:hover { background-color: #5f3dc4; transform: translateY(-2px); }
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0; top: 0;
            width: 100%; height: 100%;
            background-color: rgba(0,0,0,0.5);
            backdrop-filter: blur(5px);
        }
        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 40px;
            border-radius: 15px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            animation: modalSlideIn 0.3s ease-out;
        }
        @keyframes modalSlideIn {
            from { opacity: 0; transform: translateY(-50px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .close { color: #aaa; float: right; font-size: 28px; font-weight: bold; cursor: pointer; }
        .close:hover { color: #d63031; }
        .modal h2 { color: #2d3436; margin-bottom: 30px; text-align: center; font-size: 1.8rem; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; color: #2d3436; font-weight: 600; }
        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        .form-group input:focus {
            outline: none;
            border-color: #6c5ce7;
            box-shadow: 0 0 0 3px rgba(108,92,231,0.1);
        }
        .modal-btn {
            width: 100%;
            padding: 12px;
            background-color: #6c5ce7;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .modal-btn:hover { background-color: #5f3dc4; }
        .modal-btn.green { background-color: #00b894; }
        .modal-btn.green:hover { background-color: #00a085; }
        .modal-btn.yellow { background-color: #fdcb6e; color: #2d3436; }
        .modal-btn.yellow:hover { background-color: #e17055; color: white; }
        .error-msg { color: #d63031; font-size: 0.9rem; margin-bottom: 15px; display: none; }
        .success-msg { color: #00b894; font-size: 0.9rem; margin-bottom: 15px; display: none; }
        @media (max-width: 768px) {
            .container { padding: 40px 20px; }
            h1 { font-size: 2rem; }
            .features { flex-direction: column; align-items: center; }
            .buttons { flex-direction: column; align-items: center; }
            .btn { width: 200px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="logo.png" alt="PTH Logo" onerror="this.style.display='none'; this.parentElement.innerHTML='<div style=\'font-size:28px;font-weight:bold;color:white;\'>PTH</div>'">
        </div>

        <h1>Welcome to Pradhat Tyre House</h1>
        <p class="subtitle">
            Your one-stop destination for premium quality tyres and exceptional service.
            Find the perfect tyres for your vehicle with our expert assistance.
        </p>

        <div class="features">
            <div class="feature">
                <div class="feature-icon"><i class="fas fa-car"></i></div>
                <h3>Premium Tyres</h3>
                <p>Wide range of high-quality tyres from top brands</p>
            </div>
            <div class="feature">
                <div class="feature-icon"><i class="fas fa-dollar-sign"></i></div>
                <h3>Best Prices</h3>
                <p>Competitive pricing and special offers</p>
            </div>
            <div class="feature">
                <div class="feature-icon"><i class="fas fa-clock"></i></div>
                <h3>Quick Delivery</h3>
                <p>Fast and reliable delivery options</p>
            </div>
        </div>

        <div class="buttons">
            <button class="btn btn-login" onclick="openModal('loginModal')">Login</button>
            <button class="btn btn-signup" onclick="openModal('signupModal')">Sign Up</button>
            <button class="btn btn-seller" onclick="openModal('sellerModal')">Seller Login</button>
            <button class="btn btn-dealer" onclick="openModal('dealerModal')">Dealer Login</button>
        </div>
    </div>

    <!-- Login Modal -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('loginModal')">&times;</span>
            <h2>Customer Login</h2>
            <p class="error-msg" id="loginError"></p>
            <p class="success-msg" id="loginSuccess"></p>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" id="loginEmail" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" id="loginPassword" placeholder="Enter your password" required>
            </div>
            <button class="modal-btn" onclick="handleLogin()">Login</button>
        </div>
    </div>

    <!-- Signup Modal -->
    <div id="signupModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('signupModal')">&times;</span>
            <h2>Create Account</h2>
            <p class="error-msg" id="signupError"></p>
            <p class="success-msg" id="signupSuccess"></p>
            <div class="form-group">
                <label>Full Name:</label>
                <input type="text" id="signupName" placeholder="Enter your full name" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" id="signupEmail" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label>Phone Number:</label>
                <input type="tel" id="signupPhone" placeholder="Enter your phone number" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" id="signupPassword" placeholder="Min 6 characters" required>
            </div>
            <div class="form-group">
                <label>Confirm Password:</label>
                <input type="password" id="confirmPassword" placeholder="Repeat your password" required>
            </div>
            <button class="modal-btn green" onclick="handleSignup()">Sign Up</button>
        </div>
    </div>

    <!-- Seller Modal -->
    <div id="sellerModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('sellerModal')">&times;</span>
            <h2>Seller Login</h2>
            <p class="error-msg" id="sellerError"></p>
            <div class="form-group">
                <label>Name:</label>
                <input type="text" id="sellerName" placeholder="Enter your name" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" id="sellerEmail" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label>Phone:</label>
                <input type="tel" id="sellerPhone" placeholder="Enter your phone" required>
            </div>
            <div class="form-group">
                <label>Seller Code:</label>
                <input type="password" id="sellerCode" placeholder="Enter seller code" required>
            </div>
            <button class="modal-btn yellow" onclick="handleSellerLogin()">Login as Seller</button>
        </div>
    </div>

    <!-- Dealer Modal -->
    <div id="dealerModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('dealerModal')">&times;</span>
            <h2>Dealer Login</h2>
            <p class="error-msg" id="dealerError"></p>
            <div class="form-group">
                <label>Name:</label>
                <input type="text" id="dealerName" placeholder="Enter your name" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" id="dealerEmail" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label>Phone:</label>
                <input type="tel" id="dealerPhone" placeholder="Enter your phone" required>
            </div>
            <div class="form-group">
                <label>Dealer Code:</label>
                <input type="password" id="dealerCode" placeholder="Enter dealer code" required>
            </div>
            <button class="modal-btn" onclick="handleDealerLogin()">Login as Dealer</button>
        </div>
    </div>

    <script>
        // Open/close modals
        function openModal(id) {
            document.getElementById(id).style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeModal(id) {
            document.getElementById(id).style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        window.onclick = function(e) {
            ['loginModal','signupModal','sellerModal','dealerModal'].forEach(id => {
                const modal = document.getElementById(id);
                if (e.target === modal) closeModal(id);
            });
        }

        function showError(id, msg) {
            const el = document.getElementById(id);
            el.textContent = msg;
            el.style.display = 'block';
        }

        function hideError(id) {
            document.getElementById(id).style.display = 'none';
        }

        function showSuccess(id, msg) {
            const el = document.getElementById(id);
            el.textContent = msg;
            el.style.display = 'block';
        }

        // ===== CUSTOMER LOGIN =====
        async function handleLogin() {
            hideError('loginError');
            const email = document.getElementById('loginEmail').value.trim();
            const password = document.getElementById('loginPassword').value;

            if (!email || !password) {
                showError('loginError', 'Please fill in all fields.');
                return;
            }

            try {
                const res = await fetch('/auth.php?action=login', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email, password })
                });
                const data = await res.json();

                if (data.success) {
                    localStorage.setItem('currentUser', JSON.stringify(data.user));
                    localStorage.setItem('sessionToken', data.session_token);
                    showSuccess('loginSuccess', 'Login successful! Redirecting...');
                    setTimeout(() => window.location.href = 'index.php', 1000);
                } else {
                    showError('loginError', data.error || 'Invalid email or password');
                }
            } catch (err) {
                showError('loginError', 'Connection error. Please try again.');
            }
        }

        // ===== CUSTOMER SIGNUP =====
        async function handleSignup() {
            hideError('signupError');
            const name = document.getElementById('signupName').value.trim();
            const email = document.getElementById('signupEmail').value.trim();
            const phone = document.getElementById('signupPhone').value.trim();
            const password = document.getElementById('signupPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (!name || !email || !phone || !password || !confirmPassword) {
                showError('signupError', 'Please fill in all fields.');
                return;
            }

            if (password.length < 6) {
                showError('signupError', 'Password must be at least 6 characters.');
                return;
            }

            if (password !== confirmPassword) {
                showError('signupError', 'Passwords do not match.');
                return;
            }

            try {
                const res = await fetch('/auth.php?action=signup', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ name, email, phone, password })
                });
                const data = await res.json();

                if (data.success) {
                    localStorage.setItem('currentUser', JSON.stringify(data.user));
                    localStorage.setItem('sessionToken', data.session_token);
                    showSuccess('signupSuccess', 'Account created! Redirecting...');
                    setTimeout(() => window.location.href = 'index.php', 1000);
                } else {
                    showError('signupError', data.error || 'Signup failed. Try again.');
                }
            } catch (err) {
                showError('signupError', 'Connection error. Please try again.');
            }
        }

        // ===== SELLER LOGIN =====
        async function handleSellerLogin() {
            hideError('sellerError');
            const name = document.getElementById('sellerName').value.trim();
            const email = document.getElementById('sellerEmail').value.trim();
            const phone = document.getElementById('sellerPhone').value.trim();
            const code = document.getElementById('sellerCode').value.trim();

            if (!name || !email || !phone || !code) {
                showError('sellerError', 'Please fill in all fields.');
                return;
            }

            try {
                const res = await fetch('/auth.php?action=seller_login', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ name, email, phone, code })
                });
                const data = await res.json();

                if (data.success) {
                    localStorage.setItem('currentUser', JSON.stringify(data.seller));
                    showSuccess('sellerError', 'Login successful! Redirecting...');
                    setTimeout(() => window.location.href = 'seller.php', 1000);
                } else {
                    showError('sellerError', data.error || 'Invalid seller code.');
                }
            } catch (err) {
                showError('sellerError', 'Connection error. Please try again.');
            }
        }

        // ===== DEALER LOGIN =====
        async function handleDealerLogin() {
            hideError('dealerError');
            const name = document.getElementById('dealerName').value.trim();
            const email = document.getElementById('dealerEmail').value.trim();
            const phone = document.getElementById('dealerPhone').value.trim();
            const code = document.getElementById('dealerCode').value.trim();

            if (!name || !email || !phone || !code) {
                showError('dealerError', 'Please fill in all fields.');
                return;
            }

            try {
                const res = await fetch('/auth.php?action=dealer_login', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ name, email, phone, code })
                });
                const data = await res.json();

                if (data.success) {
                    localStorage.setItem('currentUser', JSON.stringify(data.dealer));
                    showSuccess('dealerError', 'Login successful! Redirecting...');
                    setTimeout(() => window.location.href = 'frontage.php', 1000);
                } else {
                    showError('dealerError', data.error || 'Invalid dealer code.');
                }
            } catch (err) {
                showError('dealerError', 'Connection error. Please try again.');
            }
        }

        // Check if already logged in
        document.addEventListener('DOMContentLoaded', function() {
            const user = localStorage.getItem('currentUser');
            if (user) {
                const parsed = JSON.parse(user);
                if (parsed.role === 'seller') {
                    window.location.href = 'seller.php';
                } else if (parsed.role === 'dealer') {
                    window.location.href = 'frontage.php';
                } else {
                    window.location.href = 'index.php';
                }
            }
        });
    </script>
</body>
</html>