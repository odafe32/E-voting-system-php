<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $user['firstname'].' '.$user['lastname']; ?></p>
        <a><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">REPORTS</li>
      <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'home.php') ? 'active' : ''; ?>">
        <a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
      </li>
      <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'votes.php') ? 'active' : ''; ?>">
        <a href="votes.php"><span class="glyphicon glyphicon-lock"></span> <span>Votes</span></a>
      </li>
      <li class="header">MANAGE</li>
      <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'voters.php') ? 'active' : ''; ?>">
        <a href="voters.php"><i class="fa fa-users"></i> <span>Voters</span></a>
      </li>
      <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'positions.php') ? 'active' : ''; ?>">
        <a href="positions.php"><i class="fa fa-tasks"></i> <span>Positions</span></a>
      </li>
      <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'candidates.php') ? 'active' : ''; ?>">
        <a href="candidates.php"><i class="fa fa-black-tie"></i> <span>Candidates</span></a>
      </li>
      <li class="header">SETTINGS</li>
      <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'ballot.php') ? 'active' : ''; ?>">
        <a href="ballot.php"><i class="fa fa-file-text"></i> <span>Ballot Position</span></a>
      </li>
      <li class="">
        <a href="#config" data-toggle="modal"><i class="fa fa-cog"></i> <span>Election Title</span></a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>

<!-- Subtle Enhancement Styles -->
<style>
/* Subtle Sidebar Enhancements */
.main-sidebar {
    background: black;
    box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
}

/* Enhanced User Panel */
.main-sidebar .user-panel {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    padding: 20px 15px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.main-sidebar .user-panel .image img {
    border: 3px solid rgba(255, 255, 255, 0.8);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
}

.main-sidebar .user-panel .image img:hover {
    transform: scale(1.05);
    border-color: #ffffff;
}

.main-sidebar .user-panel .info p {
    color: #ffffff;
    font-weight: 600;
    font-size: 16px;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
    margin-bottom: 5px;
}

.main-sidebar .user-panel .info a {
    color: rgba(255, 255, 255, 0.9);
    font-size: 13px;
}

.main-sidebar .user-panel .info .fa-circle {
    animation: pulse 2s infinite;
}

/* Enhanced Menu Headers */
.sidebar-menu .header {
    background: rgba(255, 255, 255, 0.05);
    color: #ffffff;
    padding: 12px 15px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.5px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

/* Enhanced Menu Items */
.sidebar-menu > li {
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    transition: all 0.3s ease;
}

.sidebar-menu > li:hover {
    background: rgba(255, 255, 255, 0.05);
}

.sidebar-menu > li.active {
    background: linear-gradient(90deg, #28a745, #20c997);
    box-shadow: inset 3px 0 0 #ffffff;
}

.sidebar-menu > li > a {
    color: #ecf0f1;
    padding: 12px 15px;
    transition: all 0.3s ease;
    border-left: 3px solid transparent;
}

.sidebar-menu > li > a:hover {
    color: #ffffff;
    background: rgba(255, 255, 255, 0.05);
    border-left-color: #28a745;
    padding-left: 18px;
}

.sidebar-menu > li.active > a {
    color: #ffffff;
    background: transparent;
}

.sidebar-menu > li > a > i {
    width: 20px;
    margin-right: 10px;
    text-align: center;
    font-size: 14px;
}

.sidebar-menu > li > a > span {
    font-weight: 500;
}

/* Pulse Animation */
@keyframes pulse {
    0% { opacity: 1; }
    50% { opacity: 0.6; }
    100% { opacity: 1; }
}

/* Scrollbar Enhancement */
.sidebar::-webkit-scrollbar {
    width: 5px;
}

.sidebar::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
}

.sidebar::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.3);
    border-radius: 3px;
}

.sidebar::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.5);
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .main-sidebar {
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }
    
    .sidebar-open .main-sidebar {
        transform: translateX(0);
    }
}
</style>

<?php include 'config_modal.php'; ?>