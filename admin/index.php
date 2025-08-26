<?php
session_start();
if(isset($_SESSION['admin'])){
    header('location:home.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/favicon.png" sizes="20x20" type="image/png"/>
    <title>Admin Panel - E-Voting System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="grad1" cx="50%" cy="50%" r="50%"><stop offset="0%" style="stop-color:rgba(255,255,255,0.1);stop-opacity:1" /><stop offset="100%" style="stop-color:rgba(255,255,255,0);stop-opacity:1" /></radialGradient></defs><circle cx="200" cy="200" r="150" fill="url(%23grad1)" /><circle cx="800" cy="300" r="100" fill="url(%23grad1)" /><circle cx="600" cy="700" r="120" fill="url(%23grad1)" /></svg>');
            z-index: 1;
        }

        .container {
            display: flex;
            max-width: 1200px;
            width: 90%;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            backdrop-filter: blur(10px);
            position: relative;
            z-index: 2;
            min-height: 600px;
        }

        .hero-section {
            flex: 1;
         background: linear-gradient(45deg, #4CAF50, #45a049);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            padding: 40px;
            text-align: center;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            clip-path: polygon(100% 0, 0 0, 100% 100%);
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 150px;
            height: 150px;
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            clip-path: polygon(0 100%, 100% 100%, 0 0);
            opacity: 0.8;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .logo {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 30px;
            line-height: 1.4;
        }

        .features {
            display: flex;
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1rem;
        }

        .feature i {
            color: #1e3c72;
            width: 20px;
        }

        .admin-badge {
            background: rgba(255, 255, 255, 0.2);
            padding: 10px 20px;
            border-radius: 25px;
            margin-bottom: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            font-weight: 600;
            letter-spacing: 1px;
        }

        .login-section {
            flex: 1;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
        }

        .login-box {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }

        .login-logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-logo b {
            font-size: 2.2rem;
            font-weight: 700;
            color: #000;
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .admin-title {
            color: #000;
            font-size: 1rem;
            font-weight: 600;
            margin-top: 5px;
            letter-spacing: 2px;
        }

        .login-box-body {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(220, 38, 38, 0.1);
        }

        .login-box-msg {
            text-align: center;
            margin-bottom: 30px;
            color: #6b7280;
            font-size: 1.1rem;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 15px 50px 15px 20px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: #dc2626;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
            transform: translateY(-1px);
        }

        .form-control-feedback {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 1.1rem;
            pointer-events: none;
        }

        .has-feedback .form-control:focus + .form-control-feedback {
            color: #dc2626;
        }

        .row {
            display: flex;
            margin-top: 20px;
        }

        .col-xs-4 {
            width: 100%;
        }

        .btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(220, 38, 38, 0.3);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-block {
            display: block;
            width: 100%;
        }

        .btn-flat {
            border-radius: 12px;
        }

        .callout {
            padding: 15px 20px;
            border-radius: 12px;
            margin-top: 20px;
            font-weight: 500;
            animation: slideIn 0.3s ease-out;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .callout-danger {
            background: linear-gradient(135deg, #fecaca 0%, #fee2e2 100%);
            color: #dc2626;
            border-left: 4px solid #dc2626;
        }

        .callout-danger::before {
            content: '\f071';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
        }

        .text-center {
            text-align: center;
        }

        .mt20 {
            margin-top: 20px;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .shape {
            position: absolute;
            background: rgba(30, 60, 114, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 60px;
            height: 60px;
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            width: 100px;
            height: 100px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                width: 95%;
                margin: 20px;
            }

            .hero-section, .login-section {
                padding: 30px 20px;
            }

            .hero-title {
                font-size: 2rem;
            }

            .logo {
                font-size: 2.5rem;
            }

            .login-box-body {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body class="hold-transition login-page">
    <div class="container">
        <div class="hero-section">
            <div class="floating-shapes">
                <div class="shape"></div>
                <div class="shape"></div>
                <div class="shape"></div>
            </div>
            
            <div class="hero-content">
                <div class="admin-badge">
                    <i class="fas fa-crown"></i> ADMIN ACCESS
                </div>
                <div class="logo">
                    <i class="fas fa-cogs"></i> CONTROL
                </div>
                <h1 class="hero-title">ELECTION MANAGEMENT</h1>
                <p class="hero-subtitle">Complete administrative control over the voting system</p>
                
                <div class="features">
                    <div class="feature">
                        <i class="fas fa-users-cog"></i>
                        <span>Manage voters and candidates</span>
                    </div>
                    <div class="feature">
                        <i class="fas fa-chart-bar"></i>
                        <span>Real-time election monitoring</span>
                    </div>
                    <div class="feature">
                        <i class="fas fa-database"></i>
                        <span>Comprehensive data management</span>
                    </div>
                    <div class="feature">
                        <i class="fas fa-shield-alt"></i>
                        <span>Advanced security controls</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="login-section">
            <div class="login-box">
                <div class="login-logo">
                    <h1 style="color: black;">Admin Panel</h1>
                    <div class="admin-title">VOTING SYSTEM</div>
                </div>

                <div class="login-box-body">
                    <p class="login-box-msg">Administrator Login Required</p>

                    <form action="login.php" method="POST">
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" name="username" placeholder="Administrator Username" required>
                            <span class="form-control-feedback"><i class="fas fa-user-shield"></i></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" class="form-control" name="password" placeholder="Administrator Password" required>
                            <span class="form-control-feedback"><i class="fas fa-lock"></i></span>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-primary btn-block btn-flat" name="login">
                                    <i class="fa fa-sign-in-alt"></i> Admin Sign In
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <?php
                if(isset($_SESSION['error'])){
                    echo "
                        <div class='callout callout-danger text-center mt20'>
                            <p>".$_SESSION['error']."</p> 
                        </div>
                    ";
                    unset($_SESSION['error']);
                }
                ?>
            </div>
        </div>
    </div>

    <script>
        // Add smooth interactions
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.form-control');
            
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.style.transform = 'translateY(-1px)';
                });

                input.addEventListener('blur', function() {
                    this.style.transform = 'translateY(0)';
                });

                input.addEventListener('input', function() {
                    if (this.value.length > 0) {
                        this.style.borderColor = '#dc2626';
                        this.nextElementSibling.style.color = '#dc2626';
                    } else {
                        this.style.borderColor = '#e5e7eb';
                        this.nextElementSibling.style.color = '#9ca3af';
                    }
                });
            });

            // Enhanced button click effect
            const submitBtn = document.querySelector('.btn-primary');
            submitBtn.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.cssText = `
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(255,255,255,0.3);
                    transform: scale(0);
                    animation: ripple 0.6s linear;
                    left: ${x}px;
                    top: ${y}px;
                    width: ${size}px;
                    height: ${size}px;
                `;
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>