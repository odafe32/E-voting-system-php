<?php include 'includes/session.php'; ?>
<?php include 'includes/slugify.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper enhanced-dashboard">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="header-container">
        <div class="header-content">
          <h1 class="dashboard-title">
            <i class="fa fa-dashboard"></i>
            Dashboard
            <small>Election Management Overview</small>
          </h1>
          <div class="header-actions">
            <button class="btn btn-primary btn-sm" onclick="refreshDashboard()">
              <i class="fa fa-refresh"></i> Refresh
            </button>
            <button class="btn btn-success btn-sm" onclick="exportData()">
              <i class="fa fa-download"></i> Export
            </button>
          </div>
        </div>
        <ol class="breadcrumb enhanced-breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible enhanced-alert'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <div class='alert-content'>
                <i class='icon fa fa-exclamation-triangle'></i>
                <div>
                  <h4>Error!</h4>
                  <p>".$_SESSION['error']."</p>
                </div>
              </div>
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible enhanced-alert'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <div class='alert-content'>
                <i class='icon fa fa-check-circle'></i>
                <div>
                  <h4>Success!</h4>
                  <p>".$_SESSION['success']."</p>
                </div>
              </div>
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>

      <!-- Enhanced Statistics Cards -->
      <div class="row stats-row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
          <div class="stats-card positions-card">
            <div class="card-header">
              <div class="card-icon">
                <i class="fa fa-tasks"></i>
              </div>
              <div class="card-info">
                <?php
                  $sql = "SELECT * FROM positions";
                  $query = $conn->query($sql);
                  $positions_count = $query->num_rows;
                  echo "<h3 class='counter' data-count='".$positions_count."'>0</h3>";
                ?>
                <p>Total Positions</p>
              </div>
            </div>
            <div class="card-footer">
              <a href="positions.php" class="card-link">
                View Details <i class="fa fa-arrow-right"></i>
              </a>
            </div>
            <div class="card-overlay"></div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
          <div class="stats-card candidates-card">
            <div class="card-header">
              <div class="card-icon">
                <i class="fa fa-black-tie"></i>
              </div>
              <div class="card-info">
                <?php
                  $sql = "SELECT * FROM candidates";
                  $query = $conn->query($sql);
                  $candidates_count = $query->num_rows;
                  echo "<h3 class='counter' data-count='".$candidates_count."'>0</h3>";
                ?>
                <p>Total Candidates</p>
              </div>
            </div>
            <div class="card-footer">
              <a href="candidates.php" class="card-link">
                View Details <i class="fa fa-arrow-right"></i>
              </a>
            </div>
            <div class="card-overlay"></div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
          <div class="stats-card voters-card">
            <div class="card-header">
              <div class="card-icon">
                <i class="fa fa-users"></i>
              </div>
              <div class="card-info">
                <?php
                  $sql = "SELECT * FROM voters";
                  $query = $conn->query($sql);
                  $voters_count = $query->num_rows;
                  echo "<h3 class='counter' data-count='".$voters_count."'>0</h3>";
                ?>
                <p>Registered Voters</p>
              </div>
            </div>
            <div class="card-footer">
              <a href="voters.php" class="card-link">
                View Details <i class="fa fa-arrow-right"></i>
              </a>
            </div>
            <div class="card-overlay"></div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
          <div class="stats-card votes-card">
            <div class="card-header">
              <div class="card-icon">
                <i class="fa fa-check-square"></i>
              </div>
              <div class="card-info">
                <?php
                  $sql = "SELECT * FROM votes GROUP BY voters_id";
                  $query = $conn->query($sql);
                  $voted_count = $query->num_rows;
                  echo "<h3 class='counter' data-count='".$voted_count."'>0</h3>";
                ?>
                <p>Voters Participated</p>
              </div>
            </div>
            <div class="card-footer">
              <a href="votes.php" class="card-link">
                View Details <i class="fa fa-arrow-right"></i>
              </a>
            </div>
            <div class="card-overlay"></div>
          </div>
        </div>
      </div>

      <!-- Voting Progress Section -->
      <div class="row">
        <div class="col-xs-12">
          <div class="progress-section">
            <h3>Election Progress</h3>
            <div class="progress-container">
              <?php
                $participation_rate = ($voters_count > 0) ? ($voted_count / $voters_count) * 100 : 0;
              ?>
              <div class="progress-info">
                <span>Voter Participation</span>
                <span class="progress-percentage"><?php echo number_format($participation_rate, 1); ?>%</span>
              </div>
              <div class="progress enhanced-progress">
                <div class="progress-bar progress-bar-success" style="width: <?php echo $participation_rate; ?>%">
                  <span class="sr-only"><?php echo number_format($participation_rate, 1); ?>% Complete</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Charts Section -->
      <div class="row">
        <div class="col-xs-12">
          <div class="charts-header">
            <h3>
              <i class="fa fa-chart-bar"></i>
              Votes Tally & Current Leaders
            
              
            </h3>
          </div>
        </div>
      </div>

      <!-- Enhanced Charts Container with Leaders -->
      <div class="charts-container">
        <?php
          // Enhanced chart generation logic with leader detection
          $sql = "SELECT * FROM positions ORDER BY priority ASC";
          $query = $conn->query($sql);
          $positions = array();
          
          // First, collect all positions
          while($row = $query->fetch_assoc()){
            $positions[] = $row;
          }
          
          // Now generate charts in proper grid layout
          $total_positions = count($positions);
          $current_position = 0;
          
          while($current_position < $total_positions) {
            echo "<div class='row'>";
            
            // Generate up to 2 charts per row
            for($i = 0; $i < 2 && $current_position < $total_positions; $i++) {
              $row = $positions[$current_position];
              $chart_id = 'chart_' . $row['id'];
              
              // Get candidates and their votes for this position
              $sql = "SELECT c.*, 
                             (SELECT COUNT(*) FROM votes v WHERE v.candidate_id = c.id) as vote_count
                      FROM candidates c 
                      WHERE c.position_id = '" . $row['id'] . "'
                      ORDER BY vote_count DESC";
              $cquery = $conn->query($sql);
              
              $candidates_data = array();
              $total_votes = 0;
              $leader = null;
              
              while($crow = $cquery->fetch_assoc()){
                $candidates_data[] = $crow;
                $total_votes += $crow['vote_count'];
                if($leader === null || $crow['vote_count'] > $leader['vote_count']) {
                  $leader = $crow;
                }
              }
              
              // Determine leader status
              $leader_info = "";
              $leader_class = "";
              if($leader && $total_votes > 0) {
                $leader_percentage = ($leader['vote_count'] / $total_votes) * 100;
                $leader_info = $leader['firstname'] . ' ' . $leader['lastname'];
                $leader_class = "has-leader";
              } else {
                $leader_info = "No votes yet";
                $leader_class = "no-votes";
              }
              
              echo "
                <div class='col-sm-6'>
                  <div class='chart-card $leader_class'>
                    <div class='chart-header'>
                      <div class='chart-title-section'>
                        <h4 class='chart-title'>" . htmlspecialchars($row['description']) . "</h4>
                        <div class='leader-info'>
                          <span class='leader-label'>Current Leader:</span>
                          <span class='leader-name'>" . htmlspecialchars($leader_info) . "</span>";
              
              if($leader && $total_votes > 0) {
                echo "
                          <div class='leader-stats'>
                            <span class='vote-count'>" . $leader['vote_count'] . " votes</span>
                            <span class='vote-percentage'>(" . number_format($leader_percentage, 1) . "%)</span>
                          </div>";
              }
              
              echo "
                        </div>
                      </div>
                      <div class='chart-actions'>
                        <button class='btn btn-xs btn-default' onclick='refreshChart(\"" . $chart_id . "\")'>
                          <i class='fa fa-refresh'></i>
                        </button>
                      </div>
                    </div>
                    <div class='chart-body'>
                      <div class='chart-wrapper'>
                        <canvas id='" . $chart_id . "' class='chart-canvas'></canvas>
                      </div>";
              
              // Add candidate summary below chart
              if(count($candidates_data) > 0) {
                echo "<div class='candidates-summary'>";
                foreach($candidates_data as $index => $candidate) {
                  $percentage = $total_votes > 0 ? ($candidate['vote_count'] / $total_votes) * 100 : 0;
                  $is_leader = ($candidate['id'] == $leader['id']);
                  echo "
                    <div class='candidate-item " . ($is_leader ? 'leader' : '') . "'>
                      <div class='candidate-info'>
                        <span class='candidate-name'>" . htmlspecialchars($candidate['firstname'] . ' ' . $candidate['lastname']) . "</span>
                        " . ($is_leader ? "<i class='fa fa-crown leader-crown'></i>" : "") . "
                      </div>
                      <div class='candidate-stats'>
                        <span class='votes'>" . $candidate['vote_count'] . " votes</span>
                        <span class='percentage'>(" . number_format($percentage, 1) . "%)</span>
                      </div>
                    </div>";
                }
                echo "</div>";
              }
              
              echo "
                    </div>
                  </div>
                </div>
              ";
              $current_position++;
            }
            
            echo "</div>";
          }
        ?>
      </div>

    </section>
  </div>
  <?php include 'includes/footer.php'; ?>

</div>
<!-- ./wrapper -->

<!-- Enhanced Styles -->
<style>
/* Enhanced Dashboard Styles */
.enhanced-dashboard {
  background: #f8f9fa;
  min-height: 100vh;
}

/* Header Enhancements */
.header-container {
  background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
  padding: 20px;
  border-radius: 8px;
  margin-bottom: 20px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.header-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}

.dashboard-title {
  color: #2c3e50;
  margin: 0;
  font-weight: 600;
}

.dashboard-title small {
  color: #7f8c8d;
  font-weight: 400;
}

.header-actions {
  display: flex;
  gap: 10px;
}

.enhanced-breadcrumb {
  background: transparent;
  margin: 0;
  padding: 0;
}

/* Enhanced Alerts */
.enhanced-alert {
  border: none;
  border-radius: 8px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
  margin-bottom: 20px;
}

.alert-content {
  display: flex;
  align-items: center;
  gap: 15px;
}

.alert-content .icon {
  font-size: 24px;
  margin: 0;
}

.alert-content h4 {
  margin: 0 0 5px 0;
  font-weight: 600;
}

.alert-content p {
  margin: 0;
}

/* Enhanced Statistics Cards */
.stats-row {
  margin-bottom: 30px;
}

.stats-card {
  background: #ffffff;
  border-radius: 12px;
  padding: 0;
  margin-bottom: 20px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
  cursor: pointer;
}

.stats-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
}

.card-header {
  padding: 25px;
  display: flex;
  align-items: center;
  gap: 20px;
}

.card-icon {
  width: 60px;
  height: 60px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  color: #ffffff;
  position: relative;
  z-index: 2;
}

.positions-card .card-icon {
  background: linear-gradient(135deg, #3498db, #2980b9);
}

.candidates-card .card-icon {
  background: linear-gradient(135deg, #27ae60, #229954);
}

.voters-card .card-icon {
  background: linear-gradient(135deg, #f39c12, #e67e22);
}

.votes-card .card-icon {
  background: linear-gradient(135deg, #e74c3c, #c0392b);
}

.card-info h3 {
  font-size: 32px;
  font-weight: 700;
  margin: 0 0 5px 0;
  color: #2c3e50;
}

.card-info p {
  margin: 0;
  color: #7f8c8d;
  font-weight: 500;
}

.card-footer {
  padding: 15px 25px;
  background: rgba(0, 0, 0, 0.02);
  border-top: 1px solid rgba(0, 0, 0, 0.05);
}

.card-link {
  color: #3498db;
  text-decoration: none;
  font-weight: 500;
  transition: all 0.3s ease;
}

.card-link:hover {
  color: #2980b9;
  text-decoration: none;
}

.card-overlay {
  position: absolute;
  top: 0;
  right: -100px;
  width: 100px;
  height: 100%;
  background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1));
  transition: all 0.3s ease;
}

.stats-card:hover .card-overlay {
  right: 0;
}

/* Progress Section */
.progress-section {
  background: #ffffff;
  padding: 25px;
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  margin-bottom: 30px;
}

.progress-section h3 {
  color: #2c3e50;
  margin-bottom: 20px;
  font-weight: 600;
}

.progress-container {
  max-width: 600px;
}

.progress-info {
  display: flex;
  justify-content: space-between;
  margin-bottom: 10px;
  font-weight: 500;
  color: #2c3e50;
}

.progress-percentage {
  color: #27ae60;
  font-weight: 700;
}

.enhanced-progress {
  height: 12px;
  border-radius: 6px;
  background: #ecf0f1;
  overflow: hidden;
}

.enhanced-progress .progress-bar {
  border-radius: 6px;
  background: linear-gradient(90deg, #27ae60, #2ecc71);
  transition: width 2s ease;
}

/* Charts Section */
.charts-header {
  background: #ffffff;
  padding: 20px 25px;
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  margin-bottom: 20px;
}

.charts-header h3 {
  color: #2c3e50;
  margin: 0;
  font-weight: 600;
}

.charts-container {
  margin-bottom: 30px;
}

.chart-card {
  background: #ffffff;
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  margin-bottom: 20px;
  overflow: hidden;
  transition: all 0.3s ease;
  border-left: 4px solid #ecf0f1;
}

.chart-card.has-leader {
  border-left-color: #27ae60;
}

.chart-card.no-votes {
  border-left-color: #95a5a6;
}

.chart-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
}

.chart-header {
  padding: 20px 25px;
  background: linear-gradient(135deg, #f8f9fa, #ffffff);
  border-bottom: 1px solid #ecf0f1;
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
}

.chart-title-section {
  flex: 1;
}

.chart-title {
  color: #2c3e50;
  margin: 0 0 10px 0;
  font-weight: 600;
  font-size: 16px;
}

.leader-info {
  display: flex;
  flex-direction: column;
  gap: 5px;
}

.leader-label {
  font-size: 12px;
  color: #7f8c8d;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.leader-name {
  font-size: 14px;
  font-weight: 600;
  color: #27ae60;
}

.chart-card.no-votes .leader-name {
  color: #95a5a6;
}

.leader-stats {
  display: flex;
  gap: 10px;
  align-items: center;
  margin-top: 2px;
}

.vote-count {
  font-size: 13px;
  font-weight: 600;
  color: #2c3e50;
}

.vote-percentage {
  font-size: 12px;
  color: #7f8c8d;
}

.chart-actions {
  display: flex;
  gap: 5px;
}

.chart-body {
  padding: 25px;
}

.chart-wrapper {
  position: relative;
  height: 200px;
  margin-bottom: 20px;
}

.chart-canvas {
  width: 100% !important;
  height: 100% !important;
}

/* Candidates Summary */
.candidates-summary {
  border-top: 1px solid #ecf0f1;
  padding-top: 15px;
}

.candidate-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 8px 0;
  border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.candidate-item:last-child {
  border-bottom: none;
}

.candidate-item.leader {
  background: linear-gradient(90deg, rgba(39, 174, 96, 0.1), transparent);
  padding: 8px 10px;
  border-radius: 6px;
  border-bottom: 1px solid rgba(39, 174, 96, 0.2);
}

.candidate-info {
  display: flex;
  align-items: center;
  gap: 8px;
}

.candidate-name {
  font-weight: 500;
  color: #2c3e50;
}

.candidate-item.leader .candidate-name {
  font-weight: 600;
  color: #27ae60;
}

.leader-crown {
  color: #f39c12;
  font-size: 14px;
  animation: pulse 2s infinite;
}

.candidate-stats {
  display: flex;
  gap: 8px;
  align-items: center;
}

.votes {
  font-weight: 600;
  color: #2c3e50;
  font-size: 13px;
}

.percentage {
  font-size: 12px;
  color: #7f8c8d;
}

.candidate-item.leader .votes {
  color: #27ae60;
}

/* Counter Animation */
@keyframes countUp {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}

.counter {
  animation: countUp 0.6s ease;
}

/* Pulse Animation */
@keyframes pulse {
  0% { opacity: 1; transform: scale(1); }
  50% { opacity: 0.8; transform: scale(1.1); }
  100% { opacity: 1; transform: scale(1); }
}

/* Responsive Design */
@media (max-width: 768px) {
  .header-content {
    flex-direction: column;
    align-items: flex-start;
    gap: 15px;
  }
  
  .header-actions {
    width: 100%;
    justify-content: flex-end;
  }
  
  .card-header {
    padding: 20px;
    gap: 15px;
  }
  
  .card-icon {
    width: 50px;
    height: 50px;
    font-size: 20px;
  }
  
  .card-info h3 {
    font-size: 28px;
  }
  
  .charts-header {
    padding: 15px 20px;
  }
  
  .chart-header {
    padding: 15px 20px;
    flex-direction: column;
    align-items: flex-start;
    gap: 15px;
  }
  
  .chart-body {
    padding: 20px;
  }
  
  .leader-stats {
    flex-direction: column;
    align-items: flex-start;
    gap: 2px;
  }
  
  .candidate-item {
    flex-direction: column;
    align-items: flex-start;
    gap: 5px;
  }
  
  .candidate-stats {
    align-self: flex-end;
  }
}

/* Loading Animation */
.loading {
  opacity: 0.6;
  pointer-events: none;
}

.loading::after {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  width: 20px;
  height: 20px;
  margin: -10px 0 0 -10px;
  border: 2px solid #3498db;
  border-top-color: transparent;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}
</style>

<?php include 'includes/scripts.php'; ?>

<!-- Enhanced JavaScript -->
<script>
// Counter Animation
function animateCounters() {
  $('.counter').each(function() {
    const $this = $(this);
    const countTo = $this.attr('data-count');
    
    $({ countNum: 0 }).animate({
      countNum: countTo
    }, {
      duration: 2000,
      easing: 'swing',
      step: function() {
        $this.text(Math.floor(this.countNum));
      },
      complete: function() {
        $this.text(this.countNum);
      }
    });
  });
}

// Progress Bar Animation
function animateProgressBar() {
  $('.enhanced-progress .progress-bar').each(function() {
    const $this = $(this);
    const width = $this.css('width');
    $this.css('width', '0%');
    setTimeout(() => {
      $this.css('width', width);
    }, 500);
  });
}

// Refresh Dashboard
function refreshDashboard() {
  const btn = event.target.closest('button');
  const icon = btn.querySelector('i');
  
  icon.classList.add('fa-spin');
  btn.disabled = true;
  
  setTimeout(() => {
    location.reload();
  }, 1000);
}

// Export Data
function exportData() {
  const btn = event.target.closest('button');
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Exporting...';
  btn.disabled = true;
  
  // Simulate export process
  setTimeout(() => {
    btn.innerHTML = '<i class="fa fa-check"></i> Exported!';
    setTimeout(() => {
      btn.innerHTML = '<i class="fa fa-download"></i> Export';
      btn.disabled = false;
    }, 2000);
  }, 2000);
}

// Toggle Chart View
function toggleChartView() {
  $('.chart-card').toggleClass('compact-view');
}

// Refresh Individual Chart
function refreshChart(chartId) {
  const btn = event.target.closest('button');
  const icon = btn.querySelector('i');
  const card = btn.closest('.chart-card');
  
  icon.classList.add('fa-spin');
  card.classList.add('loading');
  
  setTimeout(() => {
    icon.classList.remove('fa-spin');
    card.classList.remove('loading');
  }, 1500);
}

// Initialize on page load
$(document).ready(function() {
  // Animate counters when page loads
  setTimeout(animateCounters, 300);
  
  // Animate progress bars
  setTimeout(animateProgressBar, 800);
  
  // Add hover effects to cards
  $('.stats-card').hover(
    function() {
      $(this).find('.card-icon').addClass('pulse');
    },
    function() {
      $(this).find('.card-icon').removeClass('pulse');
    }
  );
});
</script>

<?php
  // Enhanced Chart Generation with leader information
  foreach($positions as $row) {
    $chart_id = 'chart_' . $row['id'];
    
    // Get candidates and their votes for this position (ordered by vote count)
    $sql = "SELECT c.*, 
                   (SELECT COUNT(*) FROM votes v WHERE v.candidate_id = c.id) as vote_count
            FROM candidates c 
            WHERE c.position_id = '" . $row['id'] . "'
            ORDER BY vote_count DESC";
    $cquery = $conn->query($sql);
    
    if(!$cquery) {
      echo "<script>console.error('Database error for position " . $row['id'] . ": " . $conn->error . "');</script>";
      continue;
    }
    
    $carray = array();
    $varray = array();
    $colors = array();
    $borderColors = array();
    
    $colorPalette = array(
      'rgba(39, 174, 96, 0.8)',   // Green for leader
      'rgba(52, 152, 219, 0.8)',  // Blue
      'rgba(243, 156, 18, 0.8)',  // Orange
      'rgba(231, 76, 60, 0.8)',   // Red
      'rgba(155, 89, 182, 0.8)',  // Purple
      'rgba(26, 188, 156, 0.8)',  // Teal
      'rgba(52, 73, 94, 0.8)',    // Dark blue
      'rgba(149, 165, 166, 0.8)'  // Gray
    );
    
    $borderColorPalette = array(
      'rgba(39, 174, 96, 1)',
      'rgba(52, 152, 219, 1)',
      'rgba(243, 156, 18, 1)',
      'rgba(231, 76, 60, 1)',
      'rgba(155, 89, 182, 1)',
      'rgba(26, 188, 156, 1)',
      'rgba(52, 73, 94, 1)',
      'rgba(149, 165, 166, 1)'
    );
    
    $index = 0;
    while($crow = $cquery->fetch_assoc()){
      array_push($carray, $crow['firstname'] . ' ' . $crow['lastname']);
      array_push($varray, (int)$crow['vote_count']);
      array_push($colors, $colorPalette[$index % count($colorPalette)]);
      array_push($borderColors, $borderColorPalette[$index % count($borderColorPalette)]);
      $index++;
    }
    
    // Only create chart if we have candidates
    if(count($carray) > 0) {
      $carray_json = json_encode($carray);
      $varray_json = json_encode($varray);
      $colors_json = json_encode($colors);
      $borderColors_json = json_encode($borderColors);
      ?>
      <script>
      $(function(){
        try {
          var chartId = '<?php echo $chart_id; ?>';
          var positionName = '<?php echo addslashes($row['description']); ?>';
          var canvas = document.getElementById(chartId);
          
          if(!canvas) {
            console.error('Canvas not found for chart: ' + chartId);
            return;
          }
          
          var ctx = canvas.getContext('2d');
          
          // Chart data with enhanced styling
          var chartData = {
            labels: <?php echo $carray_json; ?>,
            datasets: [{
              label: 'Votes',
              data: <?php echo $varray_json; ?>,
              backgroundColor: <?php echo $colors_json; ?>,
              borderColor: <?php echo $borderColors_json; ?>,
              borderWidth: 2,
              borderRadius: 4,
              borderSkipped: false,
            }]
          };

          var chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                display: false
              },
              tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                titleColor: '#ffffff',
                bodyColor: '#ffffff',
                borderColor: 'rgba(255, 255, 255, 0.2)',
                borderWidth: 1,
                cornerRadius: 6,
                displayColors: true,
                callbacks: {
                  label: function(context) {
                    var total = context.dataset.data.reduce((a, b) => a + b, 0);
                    var percentage = total > 0 ? ((context.parsed.y / total) * 100).toFixed(1) : 0;
                    return context.label + ': ' + context.parsed.y + ' votes (' + percentage + '%)';
                  }
                }
              }
            },
            scales: {
              y: {
                beginAtZero: true,
                grid: {
                  color: 'rgba(0, 0, 0, 0.1)',
                  drawBorder: false
                },
                ticks: {
                  stepSize: 1,
                  color: '#7f8c8d',
                  font: {
                    size: 11
                  }
                }
              },
              x: {
                grid: {
                  display: false
                },
                ticks: {
                  color: '#7f8c8d',
                  font: {
                    size: 11
                  },
                  maxRotation: 45
                }
              }
            },
            animation: {
              duration: 1500,
              easing: 'easeInOutQuart'
            }
          };

          // Create chart
          new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: chartOptions
          });
          
          console.log('Chart created successfully for: ' + positionName);
          
        } catch(error) {
          console.error('Error creating chart for <?php echo $chart_id; ?>:', error);
        }
      });
      </script>
      <?php
    } else {
      // No candidates for this position
      ?>
      <script>
      $(function(){
        var chartId = '<?php echo $chart_id; ?>';
        var canvas = document.getElementById(chartId);
        if(canvas) {
          var ctx = canvas.getContext('2d');
          ctx.font = '16px Arial';
          ctx.fillStyle = '#7f8c8d';
          ctx.textAlign = 'center';
          ctx.fillText('No candidates found for this position', canvas.width/2, canvas.height/2);
        }
      });
      </script>
      <?php
    }
  }
?>
</body>
</html>