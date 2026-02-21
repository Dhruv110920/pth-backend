<?php
require_once "db.php";
session_start();
$action = $_GET['action'] ?? '';
$data = json_decode(file_get_contents("php://input"), true);

function response($success, $extra = []) {
    echo json_encode(array_merge(['success' => $success], $extra));
    exit;
}

if ($action === 'signup') {
    $name = $data['name'];
    $email = $data['email'];
    $phone = $data['phone'];
    $password = password_hash($data['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (name,email,phone,password) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $password);
    if ($stmt->execute()) {
        response(true, [
            'user' => ['name'=>$name,'email'=>$email,'phone'=>$phone,'type'=>'user'],
            'session_token' => session_id()
        ]);
    } else {
        response(false, ['error' => 'Email already exists']);
    }
}

if ($action === 'login') {
    $email = $data['email'];
    $password = $data['password'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        response(true, [
            'user' => ['name'=>$user['name'],'email'=>$user['email'],'phone'=>$user['phone'],'type'=>'user'],
            'session_token' => session_id()
        ]);
    } else {
        response(false, ['error' => 'Invalid login']);
    }
}

if ($action === 'seller_login') {
    if ($data['code'] === 'SELL2024') {
        response(true, ['seller' => array_merge($data, ['type'=>'seller'])]);
    } else {
        response(false, ['error' => 'Invalid seller code']);
    }
}

if ($action === 'dealer_login') {
    if ($data['code'] === 'PTH2024') {
        response(true, ['dealer' => array_merge($data, ['type'=>'dealer'])]);
    } else {
        response(false, ['error' => 'Invalid dealer code']);
    }
}

if ($action === 'logout') {
    session_destroy();
    response(true);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pradhat Tyre House</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .user-welcome {
            position: absolute;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #6c5ce7, #5f3dc4);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            display: none;
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
            position: relative;
            border: 4px solid #d63031;
            animation: logoFloat 3s ease-in-out infinite;
            box-shadow: 0 0 0 0 rgba(214, 48, 49, 0.7);
            overflow: hidden;
        }

        .logo img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            border-radius: 50%;
        }

        .logo::after {
            content: '';
            position: absolute;
            top: -4px;
            left: -4px;
            right: -4px;
            bottom: -4px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
            z-index: -1;
            filter: blur(8px);
            opacity: 0.7;
            animation: redGlow 2s ease-in-out infinite alternate;
        }

        @keyframes logoFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        @keyframes redGlow {
            0% { box-shadow: 0 0 20px rgba(214, 48, 49, 0.3); }
            100% { box-shadow: 0 0 30px rgba(214, 48, 49, 0.8), 0 0 40px rgba(214, 48, 49, 0.4); }
        }

        .logo:hover { animation: logoSpin 1s ease-in-out; }

        @keyframes logoSpin {
            0% { transform: rotate(0deg) scale(1); }
            50% { transform: rotate(180deg) scale(1.1); }
            100% { transform: rotate(360deg) scale(1); }
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
            width: 80px;
            height: 80px;
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
        .feature h3 { font-size: 1.3rem; color: #2d3436; margin-bottom: 10px; font-weight: 600; }
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
            text-decoration: none;
            display: inline-block;
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
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 40px;
            border: none;
            border-radius: 15px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            animation: modalSlideIn 0.3s ease-out;
        }

        @keyframes modalSlideIn {
            from { opacity: 0; transform: translateY(-50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .close { color: #aaa; float: right; font-size: 28px; font-weight: bold; cursor: pointer; transition: color 0.3s; }
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
        .form-group input:focus { outline: none; border-color: #6c5ce7; box-shadow: 0 0 0 3px rgba(108, 92, 231, 0.1); }

        .remember-me { display: flex; align-items: center; margin-bottom: 20px; gap: 8px; }
        .remember-me input[type="checkbox"] { width: auto; margin: 0; transform: scale(1.2); accent-color: #6c5ce7; }
        .remember-me label { margin: 0; font-weight: 500; color: #636e72; cursor: pointer; font-size: 0.9rem; }
        .remember-me:hover label { color: #2d3436; }

        .clear-saved { background: none; border: none; color: #d63031; font-size: 0.8rem; cursor: pointer; margin-top: 5px; text-decoration: underline; padding: 0; }
        .clear-saved:hover { color: #b71c1c; }

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
        .modal-btn.signup { background-color: #00b894; }
        .modal-btn.signup:hover { background-color: #00a085; }
        .modal-btn.seller { background-color: #fdcb6e; color: #2d3436; }
        .modal-btn.seller:hover { background-color: #e17055; color: white; }

        .error-msg { color: #d63031; font-size: 0.9rem; margin-bottom: 15px; display: none; }
        .success-msg { color: #00b894; font-size: 0.9rem; margin-bottom: 15px; display: none; }

        @media (max-width: 768px) {
            .container { padding: 40px 20px; }
            h1 { font-size: 2rem; }
            .features { flex-direction: column; align-items: center; }
            .buttons { flex-direction: column; align-items: center; }
            .btn { width: 200px; margin-bottom: 10px; }
            .user-welcome { position: static; margin-bottom: 20px; display: inline-block; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="user-welcome" id="userWelcome">
            <i class="fas fa-user"></i> <span id="userName">Welcome!</span>
        </div>

        <div class="logo">
            <img src="logo.png" alt="Pradhat Tyre House Logo" onerror="this.style.display='none'; this.parentElement.innerHTML='<div style=\'font-size: 28px; font-weight: bold; color: white; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);\'>PTH</div>'">
        </div>

        <h1>Welcome to Pradhat Tyre House</h1>

        <p class="subtitle">
            Your one-stop destination for premium quality tyres and exceptional service.
            Find the perfect tyres for your vehicle with our expert assistance and enjoy a
            smooth, safe journey on the road.
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
            <button class="btn btn-login" onclick="openLoginModal()">Login</button>
            <button class="btn btn-signup" onclick="openSignupModal()">Sign Up</button>
            <button class="btn btn-seller" onclick="openSellerModal()">Seller Login</button>
            <button class="btn btn-dealer" onclick="openDealerModal()">Dealer Login</button>
        </div>
    </div>

    <!-- Login Modal -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('loginModal')">&times;</span>
            <h2>User Login</h2>
            <p class="error-msg" id="loginError"></p>
            <p class="success-msg" id="loginSuccess"></p>
            <div class="form-group">
                <label for="loginEmail">Email:</label>
                <input type="email" id="loginEmail" name="email" required>
            </div>
            <div class="form-group">
                <label for="loginPassword">Password:</label>
                <input type="password" id="loginPassword" name="password" required>
            </div>
            <button class="modal-btn" onclick="handleLogin()">Login</button>
        </div>
    </div>

    <!-- Sign Up Modal -->
    <div id="signupModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('signupModal')">&times;</span>
            <h2>Sign Up</h2>
            <p class="error-msg" id="signupError"></p>
            <p class="success-msg" id="signupSuccess"></p>
            <div class="form-group">
                <label for="signupName">Full Name:</label>
                <input type="text" id="signupName" name="name" required>
            </div>
            <div class="form-group">
                <label for="signupEmail">Email:</label>
                <input type="email" id="signupEmail" name="email" required>
            </div>
            <div class="form-group">
                <label for="signupPhone">Phone Number:</label>
                <input type="tel" id="signupPhone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="signupPassword">Password:</label>
                <input type="password" id="signupPassword" name="password" required minlength="6">
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required minlength="6">
            </div>
            <button class="modal-btn signup" onclick="handleSignup()">Sign Up</button>
        </div>
    </div>

    <!-- Seller Login Modal -->
    <div id="sellerModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('sellerModal')">&times;</span>
            <h2>Seller Login</h2>
            <p class="error-msg" id="sellerError"></p>
            <p class="success-msg" id="sellerSuccess"></p>
            <div class="form-group">
                <label for="sellerName">Name:</label>
                <input type="text" id="sellerName" name="name" required>
            </div>
            <div class="form-group">
                <label for="sellerEmail">Email:</label>
                <input type="email" id="sellerEmail" name="email" required>
            </div>
            <div class="form-group">
                <label for="sellerPhone">Phone Number:</label>
                <input type="tel" id="sellerPhone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="sellerCode">Seller Code:</label>
                <input type="password" id="sellerCode" name="code" required placeholder="Enter your seller code">
            </div>
            <div class="remember-me">
                <input type="checkbox" id="rememberSeller" name="rememberSeller">
                <label for="rememberSeller">Remember my details (not password)</label>
            </div>
            <button type="button" class="clear-saved" id="clearSellerData" onclick="clearSavedSellerData()" style="display: none;">
                Clear saved details
            </button>
            <button class="modal-btn seller" onclick="handleSellerLogin()">Login as Seller</button>
        </div>
    </div>

    <!-- Dealer Login Modal -->
    <div id="dealerModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('dealerModal')">&times;</span>
            <h2>Dealer Login</h2>
            <p class="error-msg" id="dealerError"></p>
            <p class="success-msg" id="dealerSuccess"></p>
            <div class="form-group">
                <label for="dealerName">Name:</label>
                <input type="text" id="dealerName" name="name" required>
            </div>
            <div class="form-group">
                <label for="dealerEmail">Email:</label>
                <input type="email" id="dealerEmail" name="email" required>
            </div>
            <div class="form-group">
                <label for="dealerPhone">Phone Number:</label>
                <input type="tel" id="dealerPhone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="dealerCode">Dealer Code:</label>
                <input type="password" id="dealerCode" name="code" required placeholder="Enter your dealer code">
            </div>
            <div class="remember-me">
                <input type="checkbox" id="rememberDealer" name="rememberDealer">
                <label for="rememberDealer">Remember my details (not password)</label>
            </div>
            <button type="button" class="clear-saved" id="clearDealerData" onclick="clearSavedDealerData()" style="display: none;">
                Clear saved details
            </button>
            <button class="modal-btn" onclick="handleDealerLogin()">Login as Dealer</button>
        </div>
    </div>

    <script>
        let userData = null;
        let sessionToken = null;

        // ================= MODALS =================
        function openLoginModal() {
            document.getElementById('loginModal').style.display = 'block';
            document.body.style.overflow = 'hidden';
        }
        function openSignupModal() {
            document.getElementById('signupModal').style.display = 'block';
            document.body.style.overflow = 'hidden';
        }
        function openSellerModal() {
            document.getElementById('sellerModal').style.display = 'block';
            document.body.style.overflow = 'hidden';
        }
        function openDealerModal() {
            document.getElementById('dealerModal').style.display = 'block';
            document.body.style.overflow = 'hidden';
        }
        function closeModal(id) {
            const modal = document.getElementById(id);
            if (modal) modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        window.onclick = function(e) {
            ['loginModal','signupModal','sellerModal','dealerModal'].forEach(id => {
                if (e.target === document.getElementById(id)) closeModal(id);
            });
        }

        // ================= MESSAGE HELPERS =================
        function showError(id, msg) {
            const el = document.getElementById(id);
            if (!el) return;
            el.textContent = msg;
            el.style.display = 'block';
        }
        function showSuccess(id, msg) {
            const el = document.getElementById(id);
            if (!el) return;
            el.textContent = msg;
            el.style.display = 'block';
        }
        function hideMsg(id) {
            const el = document.getElementById(id);
            if (el) el.style.display = 'none';
        }

        // ================= STORAGE HELPER =================
        function storeUserData(user, type) {
            localStorage.setItem('currentUser', JSON.stringify(user));
            if (type === 'user') {
                sessionStorage.setItem('userData', JSON.stringify(user));
                sessionStorage.removeItem('sellerData');
                sessionStorage.removeItem('dealerData');
            } else if (type === 'seller') {
                sessionStorage.setItem('sellerData', JSON.stringify(user));
                sessionStorage.removeItem('userData');
                sessionStorage.removeItem('dealerData');
            } else if (type === 'dealer') {
                sessionStorage.setItem('dealerData', JSON.stringify(user));
                sessionStorage.removeItem('userData');
                sessionStorage.removeItem('sellerData');
            }
        }

        // ================= LOGIN =================
        async function handleLogin() {
            hideMsg('loginError'); hideMsg('loginSuccess');
            const email = document.getElementById('loginEmail').value.trim();
            const password = document.getElementById('loginPassword').value;

            if (!email || !password) { showError('loginError', 'Please fill in all fields.'); return; }

            try {
                const res = await fetch('/welcome.php?action=login', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email, password })
                });
                const data = await res.json();
                if (data.success) {
                    userData = data.user;
                    sessionToken = data.session_token;
                    storeUserData(data.user, 'user');
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

        // ================= SIGNUP =================
        async function handleSignup() {
            hideMsg('signupError'); hideMsg('signupSuccess');
            const name = document.getElementById('signupName').value.trim();
            const email = document.getElementById('signupEmail').value.trim();
            const phone = document.getElementById('signupPhone').value.trim();
            const password = document.getElementById('signupPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (!name || !email || !phone || !password || !confirmPassword) { showError('signupError', 'Please fill all fields.'); return; }
            if (password.length < 6) { showError('signupError', 'Password must be at least 6 characters.'); return; }
            if (password !== confirmPassword) { showError('signupError', 'Passwords do not match.'); return; }

            try {
                const res = await fetch('/welcome.php?action=signup', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ name, email, phone, password })
                });
                const data = await res.json();
                if (data.success) {
                    userData = data.user;
                    sessionToken = data.session_token;
                    storeUserData(data.user, 'user');
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

        // ================= SELLER LOGIN =================
        async function handleSellerLogin() {
            hideMsg('sellerError'); hideMsg('sellerSuccess');
            const name = document.getElementById('sellerName').value.trim();
            const email = document.getElementById('sellerEmail').value.trim();
            const phone = document.getElementById('sellerPhone').value.trim();
            const code = document.getElementById('sellerCode').value.trim();

            if (!name || !email || !phone || !code) { showError('sellerError', 'Please fill all fields.'); return; }

            try {
                const res = await fetch('/welcome.php?action=seller_login', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ name, email, phone, code })
                });
                const data = await res.json();
                if (data.success) {
                    userData = data.seller;
                    storeUserData(data.seller, 'seller');
                    showSuccess('sellerSuccess', 'Login successful! Redirecting...');
                    setTimeout(() => window.location.href = 'seller.php', 1000);
                } else {
                    showError('sellerError', data.error || 'Invalid seller code.');
                }
            } catch (err) {
                showError('sellerError', 'Connection error. Please try again.');
            }
        }

        // ================= DEALER LOGIN =================
        async function handleDealerLogin() {
            hideMsg('dealerError'); hideMsg('dealerSuccess');
            const name = document.getElementById('dealerName').value.trim();
            const email = document.getElementById('dealerEmail').value.trim();
            const phone = document.getElementById('dealerPhone').value.trim();
            const code = document.getElementById('dealerCode').value.trim();

            if (!name || !email || !phone || !code) { showError('dealerError', 'Please fill all fields.'); return; }

            try {
                const res = await fetch('/welcome.php?action=dealer_login', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ name, email, phone, code })
                });
                const data = await res.json();
                if (data.success) {
                    userData = data.dealer;
                    storeUserData(data.dealer, 'dealer');
                    showSuccess('dealerSuccess', 'Login successful! Redirecting...');
                    setTimeout(() => window.location.href = 'frontage.php', 1000);
                } else {
                    showError('dealerError', data.error || 'Invalid dealer code.');
                }
            } catch (err) {
                showError('dealerError', 'Connection error. Please try again.');
            }
        }

        // ================= LOGOUT =================
        async function logout() {
            await fetch('/welcome.php?action=logout', { method: 'POST' });
            localStorage.clear();
            sessionStorage.clear();
            location.reload();
        }

        // ================= CLEAR SAVED DETAILS =================
        function clearSavedSellerData() {
            localStorage.removeItem('sellerData');
            document.getElementById('clearSellerData').style.display = 'none';
        }

        function clearSavedDealerData() {
            localStorage.removeItem('dealerData');
            document.getElementById('clearDealerData').style.display = 'none';
        }

        // ================= INIT =================
        // ✅ FIXED: No longer auto-redirects on page load.
        // The welcome/login page always shows so the user can choose their login type.
        // Session data is only restored to sessionStorage (for other pages to read),
        // but we do NOT redirect away from this page automatically.
        function initializeUserLogin() {
            const storedUser = localStorage.getItem('currentUser');
            if (storedUser) {
                try {
                    const parsed = JSON.parse(storedUser);
                    // Only restore sessionStorage so other pages work correctly,
                    // but DO NOT redirect — let the user log in fresh if they visit welcome.php
                    storeUserData(parsed, parsed.type);
                } catch (e) {
                    localStorage.clear();
                    sessionStorage.clear();
                }
            }
        }

        document.addEventListener('DOMContentLoaded', initializeUserLogin);

        // Expose functions globally
        window.openLoginModal = openLoginModal;
        window.openSignupModal = openSignupModal;
        window.openSellerModal = openSellerModal;
        window.openDealerModal = openDealerModal;
        window.closeModal = closeModal;
        window.handleLogin = handleLogin;
        window.handleSignup = handleSignup;
        window.handleSellerLogin = handleSellerLogin;
        window.handleDealerLogin = handleDealerLogin;
        window.logout = logout;
    </script>
</body>
</html>