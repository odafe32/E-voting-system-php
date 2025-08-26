<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<style>
/* Enhanced styling for voters management */
.content-wrapper {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
}

.content-header {
    background: white;
    border-radius: 10px;
    margin-bottom: 20px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.content-header h1 {
    color: #2c3e50;
    font-weight: 600;
    margin: 0;
}

.box {
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    border: none;
    overflow: hidden;
}

.box-header {
    background: black;
    color: white;
    padding: 20px;
    border-bottom: none;
}

.box-header .btn {
    background: rgba(255,255,255,0.2);
    border: 1px solid rgba(255,255,255,0.3);
    color: white;
    transition: all 0.3s ease;
}

.box-header .btn:hover {
    background: rgba(255,255,255,0.3);
    transform: translateY(-2px);
}

.table {
    margin: 0;
}

.table thead th {
    background: #f8f9fa;
    border: none;
    font-weight: 600;
    color: #2c3e50;
    padding: 15px;
}

.table tbody td {
    padding: 15px;
    vertical-align: middle;
    border-top: 1px solid #e9ecef;
}

.table tbody tr:hover {
    background: #f8f9fa;
}

.voter-photo {
    border-radius: 50%;
    border: 2px solid #dee2e6;
    transition: all 0.3s ease;
}

.voter-photo:hover {
    transform: scale(1.1);
    border-color: #667eea;
}

.matric-number {
    font-family: 'Courier New', monospace;
    font-weight: bold;
    color: #2c3e50;
    background: #e9ecef;
    padding: 5px 10px;
    border-radius: 5px;
    display: inline-block;
}

.btn-edit {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    border: none;
    color: white;
    transition: all 0.3s ease;
}

.btn-edit:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
}

.btn-delete {
    background: linear-gradient(135deg, #dc3545 0%, #e83e8c 100%);
    border: none;
    color: white;
    transition: all 0.3s ease;
}

.btn-delete:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
}

.photo-edit-btn {
    background: #17a2b8;
    color: white;
    border: none;
    padding: 5px 8px;
    border-radius: 3px;
    font-size: 12px;
    transition: all 0.3s ease;
}

.photo-edit-btn:hover {
    background: #138496;
    transform: scale(1.1);
}

.alert {
    border-radius: 10px;
    border: none;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}

.breadcrumb {
    background: transparent;
    padding: 0;
    margin: 10px 0 0 0;
}

.breadcrumb > li + li:before {
    content: "›";
    color: #6c757d;
}
</style>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> NSUK Students Voters Management
        <small>Matric Number Based Authentication</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Voters</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-list"></i> Registered NSUK Students</h3>
              <div class="box-tools pull-right">
                <a href="#addnew" data-toggle="modal" class="btn btn-sm btn-primary " style="   background: linear-gradient(135deg, #28a745 0%, #20c997 100%); border: none;">
                  <i class="fa fa-plus"></i> Add New Student
                </a>
              </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th><i class="fa fa-user"></i> Last Name</th>
                    <th><i class="fa fa-user"></i> First Name</th>
                    <th><i class="fa fa-camera"></i> Photo</th>
                    <th><i class="fa fa-id-card"></i> Matric Number</th>
                    <th><i class="fa fa-cogs"></i> Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT * FROM voters ORDER BY lastname, firstname";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $image = (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg';
                      echo "
                        <tr>
                          <td><strong>".$row['lastname']."</strong></td>
                          <td><strong>".$row['firstname']."</strong></td>
                          <td style='text-align: center;'>
                            <img src='".$image."' width='40px' height='40px' class='voter-photo'>
                            <br>
                            <button class='photo-edit-btn photo' data-id='".$row['id']."' data-toggle='modal' data-target='#edit_photo'>
                              <i class='fa fa-edit'></i> Edit
                            </button>
                          </td>
                          <td>
                            <span class='matric-number'>".$row['voters_id']."</span>
                          </td>
                          <td>
                            <button class='btn btn-sm btn-edit edit btn-flat' data-id='".$row['id']."'>
                              <i class='fa fa-edit'></i> Edit
                            </button>
                            <button class='btn btn-sm btn-delete delete btn-flat' data-id='".$row['id']."'>
                              <i class='fa fa-trash'></i> Delete
                            </button>
                          </td>
                        </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/voters_modal.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  // Safe DataTable initialization
  function initializeDataTable() {
    if ($.fn.DataTable.isDataTable('#example1')) {
      $('#example1').DataTable().destroy();
    }
    
    $('#example1').DataTable({
      'paging': true,
      'lengthChange': true,
      'searching': true,
      'ordering': true,
      'info': true,
      'autoWidth': false,
      'pageLength': 25,
      'order': [[ 0, 'asc' ]],
      'columnDefs': [
        { 'orderable': false, 'targets': [2, 4] }
      ]
    });
  }

  // Initialize on page load
  initializeDataTable();

  // Your existing event handlers...
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.photo', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

  // Matric number validation
  $('#add_matric, #edit_matric').on('input', function(){
    var matric = $(this).val();
    var isValid = matric.startsWith('0220') && matric.length >= 15;
    
    if(matric.length > 0 && !isValid){
      $(this).css('border-color', '#dc3545');
      $(this).next('.help-block').remove();
      $(this).after('<span class="help-block" style="color: #dc3545;">Matric number must start with 0220</span>');
    } else {
      $(this).css('border-color', '#28a745');
      $(this).next('.help-block').remove();
    }
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'voters_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.id').val(response.id);
      $('#edit_firstname').val(response.firstname);
      $('#edit_lastname').val(response.lastname);
      $('#edit_matric').val(response.voters_id);
      $('#edit_password').val(response.password);
      $('.fullname').html(response.firstname+' '+response.lastname);
      $('.matric_display').html(response.voters_id);
    }
  });
}
</script>
</body>
</html>
</qodoArtifact>