<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - PTH Auto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(220, 38, 38, 0.2);
            overflow: hidden;
            border: 2px solid #dc2626;
        }

        .profile-header {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white;
            padding: 40px;
            text-align: center;
            position: relative;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(45deg, #ffffff, #f3f4f6);
            color: #dc2626;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 48px;
            border: 5px solid rgba(255, 255, 255, 0.9);
            position: relative;
            z-index: 1;
        }

        .profile-name {
            font-size: 28px;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .profile-type {
            font-size: 16px;
            opacity: 0.9;
            background: rgba(255, 255, 255, 0.2);
            padding: 5px 15px;
            border-radius: 20px;
            display: inline-block;
            position: relative;
            z-index: 1;
        }

        .profile-content {
            padding: 40px;
            background: #ffffff;
        }

        .profile-section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 20px;
            color: #dc2626;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: bold;
        }

        .section-title i {
            color: #dc2626;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .info-card {
            background: #ffffff;
            border-radius: 15px;
            padding: 20px;
            border: 2px solid #dc2626;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(220, 38, 38, 0.1);
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(220, 38, 38, 0.2);
            border-color: #b91c1c;
        }

        .info-label {
            font-weight: 600;
            color: #dc2626;
            font-size: 14px;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 16px;
            color: #1a1a1a;
            word-break: break-word;
        }

        .buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
        }

        .btn-primary {
            background: linear-gradient(45deg, #dc2626, #b91c1c);
            color: white;
            border: 2px solid #dc2626;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 38, 38, 0.4);
            background: linear-gradient(45deg, #b91c1c, #991b1b);
        }

        .btn-secondary {
            background: #ffffff;
            color: #dc2626;
            border: 2px solid #dc2626;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 38, 38, 0.3);
            background: #f8f9fa;
        }

        .btn-danger {
            background: linear-gradient(45deg, #b91c1c, #dc2626);
            color: white;
            border: 2px solid #b91c1c;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(185, 28, 28, 0.4);
            background: linear-gradient(45deg, #991b1b, #b91c1c);
        }

        .btn-home {
            background: #ffffff;
            color: #dc2626;
            border: 2px solid #dc2626;
        }

        .btn-home:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 38, 38, 0.3);
            background: #f8f9fa;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .stat-card {
            background: linear-gradient(45deg, #dc2626, #b91c1c);
            color: white;
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid #dc2626;
        }

        .stat-card:hover {
            transform: scale(1.05);
            background: linear-gradient(45deg, #b91c1c, #991b1b);
        }

        .stat-number {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 14px;
            opacity: 0.9;
        }

        .no-data {
            text-align: center;
            color: #dc2626;
            font-style: italic;
            padding: 40px;
        }

        .no-data i {
            color: #dc2626;
        }

        .no-data h3 {
            color: #dc2626;
            margin-bottom: 10px;
        }

        @media (max-width: 768px) {
            .container {
                margin: 10px;
                border-radius: 15px;
            }

            .profile-header {
                padding: 30px 20px;
            }

            .profile-content {
                padding: 20px;
            }

            .buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                max-width: 300px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-header">
            <div class="profile-avatar">
                <i class="fas fa-user"></i>
            </div>
            <h1 class="profile-name" id="profileName">Loading...</h1>
            <span class="profile-type" id="profileType">User</span>
        </div>

        <div class="profile-content">
            <div class="profile-section">
                <h2 class="section-title">
                    <i class="fas fa-info-circle"></i>
                    Personal Information
                </h2>
                <div class="info-grid">
                    <div class="info-card">
                        <div class="info-label">Full Name</div>
                        <div class="info-value" id="fullName">-</div>
                    </div>
                    <div class="info-card">
                        <div class="info-label">Email Address</div>
                        <div class="info-value" id="email">-</div>
                    </div>
                    <div class="info-card">
                        <div class="info-label">Phone Number</div>
                        <div class="info-value" id="phone">-</div>
                    </div>
                    <div class="info-card">
                        <div class="info-label">User Type</div>
                        <div class="info-value" id="userType">-</div>
                    </div>
                </div>
            </div>

            <div class="profile-section">
                <h2 class="section-title">
                    <i class="fas fa-clock"></i>
                    Account Activity
                </h2>
                <div class="info-grid">
                    <div class="info-card">
                        <div class="info-label">Registration Date</div>
                        <div class="info-value" id="registrationDate">-</div>
                    </div>
                    <div class="info-card">
                        <div class="info-label">Last Login</div>
                        <div class="info-value" id="lastLogin">-</div>
                    </div>
                    <div class="info-card">
                        <div class="info-label">Account Status</div>
                        <div class="info-value" style="color: #dc2626; font-weight: bold;">Active</div>
                    </div>
                    <div class="info-card">
                        <div class="info-label">Member Since</div>
                        <div class="info-value" id="memberSince">-</div>
                    </div>
                </div>
            </div>

            <div class="profile-section">
                <h2 class="section-title">
                    <i class="fas fa-chart-bar"></i>
                    Account Statistics
                </h2>
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-number" id="totalLogins">0</div>
                        <div class="stat-label">Total Logins</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number" id="daysSinceRegistration">0</div>
                        <div class="stat-label">Days Since Registration</div>
                    </div>
                </div>
            </div>

            <div class="buttons">
                <button class="btn btn-home" onclick="goHome()">
                    <i class="fas fa-home"></i>
                    Home
                </button>
                <button class="btn btn-primary" onclick="editProfile()">
                    <i class="fas fa-edit"></i>
                    Edit Profile
                </button>
                <button class="btn btn-secondary" onclick="goToDashboard()">
                    <i class="fas fa-tachometer-alt"></i>
                    Dashboard
                </button>
                <button class="btn btn-danger" onclick="logout()">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </button>
            </div>
        </div>
    </div>
<script src="path/to/user-detector.js"></script>
    <script>
        // Function to get user data from multiple sources
        function getUserData() {
            // First, try to get from URL parameters (as used in your original code)
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('name')) {
                return {
                    name: urlParams.get('name'),
                    email: urlParams.get('email'),
                    phone: urlParams.get('phone'),
                    registrationTime: urlParams.get('registrationTime'),
                    type: 'user'
                };
            }

            // Then try sessionStorage for different user types
            const userData = sessionStorage.getItem('userData');
            if (userData) {
                const user = JSON.parse(userData);
                return { ...user, type: 'user' };
            }

            const sellerData = sessionStorage.getItem('sellerData');
            if (sellerData) {
                const seller = JSON.parse(sellerData);
                return { ...seller, type: 'seller' };
            }

            const dealerData = sessionStorage.getItem('dealerData');
            if (dealerData) {
                const dealer = JSON.parse(dealerData);
                return { ...dealer, type: 'dealer' };
            }

            return null;
        }

        // Function to format date
        function formatDate(dateString) {
            if (!dateString) return '-';
            
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        // Function to calculate days since registration
        function calculateDaysSince(dateString) {
            if (!dateString) return 0;
            
            const registrationDate = new Date(dateString);
            const today = new Date();
            const timeDiff = today - registrationDate;
            return Math.floor(timeDiff / (1000 * 60 * 60 * 24));
        }

        // Function to get user type display name
        function getUserTypeDisplay(type) {
            switch(type) {
                case 'seller': return 'Seller';
                case 'dealer': return 'Dealer';
                case 'user': return 'Customer';
                default: return 'User';
            }
        }

        // Function to get user type color
        function getUserTypeColor(type) {
            switch(type) {
                case 'seller': return '#dc2626';
                case 'dealer': return '#b91c1c';
                case 'user': return '#991b1b';
                default: return '#dc2626';
            }
        }

        // Function to load and display user profile
        function loadUserProfile() {
            const user = getUserData();
            
            if (!user) {
                document.querySelector('.profile-content').innerHTML = `
                    <div class="no-data">
                        <i class="fas fa-user-times" style="font-size: 48px; margin-bottom: 20px;"></i>
                        <h3>No User Data Found</h3>
                        <p>Please login first to view your profile.</p>
                        <div style="margin-top: 20px;">
                            <a href="welcome.php" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt"></i>
                                Go to Login
                            </a>
                        </div>
                    </div>
                `;
                return;
            }

            // Update profile header
            document.getElementById('profileName').textContent = user.name || 'Unknown User';
            document.getElementById('profileType').textContent = getUserTypeDisplay(user.type);
            
            // Update profile type color
            const profileTypeElement = document.getElementById('profileType');
            profileTypeElement.style.background = getUserTypeColor(user.type);

            // Update personal information
            document.getElementById('fullName').textContent = user.name || '-';
            document.getElementById('email').textContent = user.email || '-';
            document.getElementById('phone').textContent = user.phone || '-';
            document.getElementById('userType').textContent = getUserTypeDisplay(user.type);

            // Update account activity
            const registrationDate = user.registrationTime || user.loginTime || new Date().toISOString();
            document.getElementById('registrationDate').textContent = formatDate(registrationDate);
            document.getElementById('lastLogin').textContent = formatDate(user.loginTime || registrationDate);
            
            // Calculate member since
            const memberSince = calculateDaysSince(registrationDate);
            document.getElementById('memberSince').textContent = memberSince === 0 ? 'Today' : `${memberSince} days ago`;

            // Update statistics
            document.getElementById('totalLogins').textContent = user.totalLogins || '1';
            document.getElementById('daysSinceRegistration').textContent = memberSince;
        }

        // Function to go home
        function goHome() {
            window.location.href = 'index.php';
        }

        // Function to edit profile
        function editProfile() {
            alert('Edit profile functionality would be implemented here. This would open a modal or redirect to an edit page.');
        }

        // Function to go to dashboard
        function goToDashboard() {
            window.location.href = 'index.php';
        }

        // Function to logout
        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                // Clear all session data
                sessionStorage.removeItem('userData');
                sessionStorage.removeItem('sellerData');
                sessionStorage.removeItem('dealerData');
                
                alert('You have been logged out successfully!');
                window.location.href = 'welcome.php';
            }
        }

        // Initialize profile on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadUserProfile();
        });


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