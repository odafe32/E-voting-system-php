<style>
  /* Enhanced Navbar Styles */
.main-header {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
    border-bottom: none !important;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
    transition: all 0.3s ease;
}

/* Logo Enhancements */
.main-header .logo {
    background: rgba(255, 255, 255, 0.1) !important;
    border-right: 1px solid rgba(255, 255, 255, 0.2) !important;
    transition: all 0.3s ease;
}

.main-header .logo:hover {
    background: rgba(255, 255, 255, 0.2) !important;
}

.main-header .logo .logo-mini,
.main-header .logo .logo-lg {
    color: #ffffff !important;
    font-weight: 700;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
}

/* Navbar Enhancements */
.main-header .navbar {
    background: transparent !important;
}

/* Sidebar Toggle Button */
.main-header .sidebar-toggle {
    color: #ffffff !important;
    background: rgba(255, 255, 255, 0.1) !important;
    border-radius: 6px;
    margin: 8px;
    padding: 8px 12px;
    transition: all 0.3s ease;
}

.main-header .sidebar-toggle:hover {
    background: rgba(255, 255, 255, 0.2) !important;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

/* User Menu Enhancements */
.navbar-custom-menu .dropdown.user.user-menu > a {
    color: #ffffff !important;
    background: rgba(255, 255, 255, 0.1) !important;
    border-radius: 25px;
    margin: 8px;
    padding: 6px 15px;
    transition: all 0.3s ease;
}

.navbar-custom-menu .dropdown.user.user-menu > a:hover {
    background: rgba(255, 255, 255, 0.2) !important;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

/* User Image Styling */
.navbar-custom-menu .user-image {
    border: 2px solid rgba(255, 255, 255, 0.8);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
}

.navbar-custom-menu .dropdown.user.user-menu > a:hover .user-image {
    border-color: #ffffff;
    transform: scale(1.05);
}

/* Dropdown Menu Enhancements */
.navbar-custom-menu .dropdown-menu {
    border: none !important;
    border-radius: 12px !important;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2) !important;
    overflow: hidden;
    margin-top: 5px;
}

/* User Header in Dropdown */
.dropdown-menu .user-header {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
    color: #ffffff !important;
    padding: 20px;
    text-align: center;
}

.dropdown-menu .user-header .img-circle {
    border: 3px solid rgba(255, 255, 255, 0.9);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    width: 80px;
    height: 80px;
    margin-bottom: 10px;
}

.dropdown-menu .user-header p {
    margin: 0;
    font-weight: 600;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
}

.dropdown-menu .user-header small {
    opacity: 0.9;
    font-weight: 400;
}

/* User Footer Buttons */
.dropdown-menu .user-footer {
    background: #f8f9fa !important;
    padding: 15px;
}

.dropdown-menu .user-footer .btn {
    border-radius: 20px !important;
    font-weight: 500;
    padding: 8px 20px;
    transition: all 0.3s ease;
    border: none !important;
}

.dropdown-menu .user-footer .btn-default {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
    color: #ffffff !important;
}

.dropdown-menu .user-footer .btn-default:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.4);
}

/* Sign out button styling */
.dropdown-menu .user-footer .pull-right .btn-default {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%) !important;
}

.dropdown-menu .user-footer .pull-right .btn-default:hover {
    box-shadow: 0 4px 15px rgba(220, 53, 69, 0.4);
}

/* Responsive Enhancements */
@media (max-width: 768px) {
    .main-header .logo .logo-lg {
        display: none;
    }
    
    .navbar-custom-menu .hidden-xs {
        display: none !important;
    }
    
    .navbar-custom-menu .dropdown.user.user-menu > a {
        padding: 6px 10px;
        margin: 5px;
    }
}

/* Animation for dropdown */
.navbar-custom-menu .dropdown-menu {
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Additional hover effects */
.main-header:hover {
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
}

/* Glassmorphism effect for modern look */
.main-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    z-index: -1;
}
</style>
<header class="main-header">
  <!-- Logo -->
  <a href="#" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>V</b>TS</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>E-Voting</b>System</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg'; ?>" class="user-image" alt="User Image">
            <span class="hidden-xs"><?php echo $user['firstname'].' '.$user['lastname']; ?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="<?php echo (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">

              <p>
                <?php echo $user['firstname'].' '.$user['lastname']; ?>
                <small>Member since <?php echo date('M. Y', strtotime($user['created_on'])); ?></small>
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <a href="#profile" data-toggle="modal" class="btn btn-default btn-flat" id="admin_profile">Update</a>
              </div>
              <div class="pull-right">
                <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
<?php include 'includes/profile_modal.php'; ?>