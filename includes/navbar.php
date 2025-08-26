<header class="main-header">
  <nav class="navbar navbar-static-top enhanced-navbar">
    <div class="container">
      <div class="navbar-header">
        <a href="#" class="navbar-brand enhanced-brand">
          <i class="fa fa-vote-yea brand-icon"></i>
          <span class="brand-text">
            <b>Voting</b><span class="brand-system">System</span>
          </span>
        </a>
        <button type="button" class="navbar-toggle collapsed enhanced-toggle" data-toggle="collapse" data-target="#navbar-collapse">
          <span class="toggle-icon">
            <i class="fa fa-bars"></i>
          </span>
        </button>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
        <ul class="nav navbar-nav enhanced-nav">
          <?php
            if(isset($_SESSION['student'])){
              echo "
                <li class='nav-item'><a href='index.php' class='nav-link'><i class='fa fa-home nav-icon'></i><span>HOME</span></a></li>
                <li class='nav-item'><a href='transaction.php' class='nav-link'><i class='fa fa-history nav-icon'></i><span>TRANSACTION</span></a></li>
              ";
            } 
          ?>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav enhanced-right-nav">
          <li class="user user-menu enhanced-user-menu">
            <a href="#" class="user-link" data-toggle="dropdown">
              <div class="user-avatar-container">
                <img src="<?php echo (!empty($voter['photo'])) ? 'images/'.$voter['photo'] : 'images/profile.jpg' ?>" class="user-image enhanced-avatar" alt="User Image">
                <div class="status-indicator online"></div>
              </div>
              <span class="user-name hidden-xs" style="font-size:15px;"><?php echo $voter['firstname'].' '.$voter['lastname']; ?></span>
              <i class="fa fa-chevron-down dropdown-arrow hidden-xs"></i>
            </a>
         
          </li>
          <li class="logout-item">
            <a href="logout.php" class="logout-link">
              <i class="fa fa-sign-out logout-icon"></i> 
              <span class="hidden-xs">LOGOUT</span>
            </a>
          </li>  
        </ul>
      </div>
      <!-- /.navbar-custom-menu -->
    </div>
    <!-- /.container-fluid -->
  </nav>
</header>

<style>
/* Enhanced Navbar Styling */
.enhanced-navbar {
     background: linear-gradient(45deg, #4CAF50, #45a049);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    border: none;
    min-height: 70px;
    backdrop-filter: blur(10px);
    position: relative;
    overflow: hidden;
}

.enhanced-navbar::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.05) 50%, transparent 70%);
    pointer-events: none;
}

.enhanced-brand {
    display: flex !important;
    align-items: center;
    gap: 12px;
    font-size: 1.8rem !important;
    font-weight: 700;
    color: white !important;
    text-decoration: none !important;
    padding: 15px 20px !important;
    transition: all 0.3s ease;
    position: relative;
    z-index: 2;
}

.enhanced-brand:hover {
    color: #fbbf24 !important;
    transform: scale(1.05);
    text-shadow: 0 0 20px rgba(251, 191, 36, 0.5);
}

.brand-icon {
    font-size: 2rem;
    background: linear-gradient(45deg, #fbbf24, #f59e0b);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    filter: drop-shadow(0 2px 4px rgba(251, 191, 36, 0.3));
    animation: pulse 2s infinite;
}

.brand-text {
    display: flex;
    align-items: center;
}

.brand-system {
    color: #e5e7eb;
    font-weight: 400;
    margin-left: 2px;
}

.enhanced-toggle {
    background: rgba(255, 255, 255, 0.1) !important;
    border: 2px solid rgba(255, 255, 255, 0.2) !important;
    border-radius: 8px !important;
    padding: 8px 12px !important;
    margin: 15px !important;
    transition: all 0.3s ease;
}

.enhanced-toggle:hover {
    background: rgba(255, 255, 255, 0.2) !important;
    border-color: rgba(255, 255, 255, 0.4) !important;
    transform: scale(1.05);
}

.toggle-icon {
    color: white;
    font-size: 1.2rem;
}

.enhanced-nav {
    margin-left: 20px;
}

.enhanced-nav .nav-item {
    margin: 0 5px;
}

.enhanced-nav .nav-link {
    color: rgba(255, 255, 255, 0.9) !important;
    font-weight: 500 !important;
    padding: 15px 20px !important;
    border-radius: 8px !important;
    transition: all 0.3s ease;
    display: flex !important;
    align-items: center;
    gap: 8px;
    position: relative;
    overflow: hidden;
}

.enhanced-nav .nav-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.enhanced-nav .nav-link:hover::before {
    left: 100%;
}

.enhanced-nav .nav-link:hover {
    background: rgba(255, 255, 255, 0.15) !important;
    color: white !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

.nav-icon {
    font-size: 1.1rem;
    width: 20px;
    text-align: center;
}

.enhanced-right-nav {
    display: flex;
    align-items: center;
    gap: 15px;
}

.enhanced-user-menu .user-link {
    display: flex !important;
    align-items: center;
    gap: 12px;
    color: white !important;
    padding: 10px 20px !important;
    border-radius: 25px !important;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
    text-decoration: none !important;
}

.enhanced-user-menu .user-link:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}

.user-avatar-container {
    position: relative;
}

.enhanced-avatar {
    width: 45px !important;
    height: 45px !important;
    border-radius: 50% !important;
    border: 3px solid rgba(255, 255, 255, 0.3) !important;
    object-fit: cover;
    transition: all 0.3s ease;
}

.enhanced-user-menu:hover .enhanced-avatar {
    border-color: #fbbf24 !important;
    box-shadow: 0 0 20px rgba(251, 191, 36, 0.4);
}

.status-indicator {
    position: absolute;
    bottom: 2px;
    right: 2px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid white;
}

.status-indicator.online {
    background: #22c55e;
    animation: pulse-green 2s infinite;
}

.user-name {
    font-weight: 600;
    font-size: 0.95rem;
    max-width: 150px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.dropdown-arrow {
    font-size: 0.8rem;
    transition: transform 0.3s ease;
}

.enhanced-user-menu.open .dropdown-arrow {
    transform: rotate(180deg);
}

.user-dropdown {
    background: white !important;
    border: none !important;
    border-radius: 12px !important;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2) !important;
    margin-top: 10px !important;
    overflow: hidden;
    min-width: 280px;
}

.user-dropdown .user-header {
    background: linear-gradient(135deg, #1e3a8a 0%, #3730a3 100%) !important;
    padding: 20px !important;
    text-align: center;
    color: white;
}

.user-dropdown .user-header img {
    width: 80px !important;
    height: 80px !important;
    margin-bottom: 15px;
    border: 4px solid rgba(255, 255, 255, 0.3);
}

.user-dropdown .user-header p {
    font-weight: 600;
    margin: 0;
    font-size: 1.1rem;
}

.user-dropdown .user-header small {
    opacity: 0.8;
    font-size: 0.9rem;
}

.user-dropdown .user-body {
    padding: 15px;
    background: #f8fafc;
    text-align: center;
    color: #64748b;
    font-weight: 500;
}

.user-dropdown .user-footer {
    padding: 15px;
    background: white;
}

.logout-item .logout-link {
    color: rgba(255, 255, 255, 0.9) !important;
    padding: 12px 20px !important;
    border-radius: 8px !important;
    transition: all 0.3s ease;
    display: flex !important;
    align-items: center;
    gap: 8px;
    text-decoration: none !important;
    font-weight: 500;
    background: rgba(239, 68, 68, 0.1);
    border: 1px solid rgba(239, 68, 68, 0.2);
}

.logout-item .logout-link:hover {
    background: #ef4444 !important;
    color: white !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
}

.logout-icon {
    font-size: 1.1rem;
    transition: transform 0.3s ease;
}

.logout-item .logout-link:hover .logout-icon {
    transform: rotate(-10deg);
}

/* Responsive Design */
@media (max-width: 768px) {
    .enhanced-navbar {
        min-height: 60px;
    }
    
    .enhanced-brand {
        font-size: 1.5rem !important;
        padding: 10px 15px !important;
    }
    
    .brand-icon {
        font-size: 1.5rem;
    }
    
    .enhanced-nav .nav-link {
        padding: 12px 15px !important;
    }
    
    .user-name {
        display: none !important;
    }
    
    .enhanced-avatar {
        width: 35px !important;
        height: 35px !important;
    }
    
    .enhanced-user-menu .user-link {
        padding: 8px 12px !important;
    }
}

/* Animations */
@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

@keyframes pulse-green {
    0%, 100% { 
        box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(34, 197, 94, 0);
    }
}

/* Navbar active states */
.enhanced-nav .nav-item.active .nav-link,
.enhanced-nav .nav-item .nav-link.active {
    background: rgba(255, 255, 255, 0.2) !important;
    color: #fbbf24 !important;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

/* Loading state for navigation */
.nav-loading {
    position: relative;
    overflow: hidden;
}

.nav-loading::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, transparent, #fbbf24, transparent);
    animation: loading-slide 1.5s infinite;
}

@keyframes loading-slide {
    0% { left: -100%; }
    100% { left: 100%; }
}
</style>