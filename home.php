<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<style>
/* Enhanced CSS for better UI */
.voting-container {
    min-height: 100vh;
    padding: 20px 0;
}

.election-title {
    color: white;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    margin-bottom: 30px;
    font-weight: 700;
    letter-spacing: 2px;
}

.voting-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    margin-bottom: 20px;
    overflow: hidden;
    transition: transform 0.3s ease;
}

.voting-card:hover {
    transform: translateY(-5px);
}

.position-header {
    background: linear-gradient(45deg, #4CAF50, #45a049);
    color: white;
    padding: 20px;
    margin: 0;
}

.position-title {
    margin: 0;
    font-size: 1.5em;
    font-weight: 600;
}

.position-instruction {
    margin: 10px 0 0 0;
    opacity: 0.9;
    font-size: 0.9em;
}

.candidates-container {
    padding: 20px;
}

.candidate-item {
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    margin-bottom: 15px;
    padding: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    background: #fafafa;
}

.candidate-item:hover {
    border-color: #4CAF50;
    background: #f0f8f0;
    transform: translateX(5px);
}

.candidate-item.selected {
    border-color: #4CAF50;
    background: linear-gradient(45deg, #e8f5e8, #f0f8f0);
    box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
}

.candidate-content {
    display: flex;
    align-items: center;
    gap: 20px;
}

.candidate-photo {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #ddd;
    transition: border-color 0.3s ease;
}

.candidate-item.selected .candidate-photo {
    border-color: #4CAF50;
}

.candidate-info {
    flex: 1;
}

.candidate-name {
    font-size: 1.3em;
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
}

.candidate-actions {
    display: flex;
    gap: 10px;
    align-items: center;
}

.platform-btn {
    background: #000;
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 20px;
    font-size: 0.85em;
    cursor: pointer;
    transition: background 0.3s ease;
}

.platform-btn:hover {
    background: #1976D2;
}

.selection-indicator {
    position: absolute;
    top: 15px;
    right: 15px;
    width: 25px;
    height: 25px;
    border: 2px solid #ddd;
    border-radius: 50%;
    background: white;
    transition: all 0.3s ease;
}

.candidate-item.selected .selection-indicator {
    background: #4CAF50;
    border-color: #4CAF50;
}

.candidate-item.selected .selection-indicator::after {
    content: '✓';
    color: white;
    font-weight: bold;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 14px;
}

.voting-actions {
    text-align: center;
    margin-top: 30px;
    padding: 20px;
}

.btn-enhanced {
    padding: 12px 30px;
    font-size: 1.1em;
    border-radius: 25px;
    margin: 0 10px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-preview {
    background: linear-gradient(45deg, #FF9800, #F57C00);
    color: white;
}

.btn-preview:hover {
    background: linear-gradient(45deg, #F57C00, #E65100);
    transform: translateY(-2px);
}

.btn-submit {
    background: linear-gradient(45deg, #4CAF50, #45a049);
    color: white;
}

.btn-submit:hover {
    background: linear-gradient(45deg, #45a049, #3d8b40);
    transform: translateY(-2px);
}

.reset-btn {
    background: #f44336;
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 20px;
    font-size: 0.85em;
    cursor: pointer;
    transition: background 0.3s ease;
}

.reset-btn:hover {
    background: #d32f2f;
}

.already-voted {
    text-align: center;
    padding: 40px;
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.already-voted h3 {
    color: #4CAF50;
    margin-bottom: 20px;
}

.alert-enhanced {
    border-radius: 10px;
    border: none;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

/* Hide original radio buttons and checkboxes */
input[type="radio"], input[type="checkbox"] {
    display: none;
}
</style>

<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
    <?php include 'includes/navbar.php'; ?>
    
    <div class="content-wrapper voting-container">
        <div class="container">
            <section class="content">
                <?php
                    $parse = parse_ini_file('admin/config.ini', FALSE, INI_SCANNER_RAW);
                    $title = $parse['election_title'];
                ?>
                <h1 class="page-header text-center election-title"><b><?php echo strtoupper($title); ?></b></h1>
                
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <?php
                        if(isset($_SESSION['error'])){
                            ?>
                            <div class="alert alert-danger alert-dismissible alert-enhanced">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <ul>
                                    <?php
                                        foreach($_SESSION['error'] as $error){
                                            echo "<li>".$error."</li>";
                                        }
                                    ?>
                                </ul>
                            </div>
                            <?php
                            unset($_SESSION['error']);
                        }
                        if(isset($_SESSION['success'])){
                            echo "
                                <div class='alert alert-success alert-dismissible alert-enhanced'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <h4><i class='icon fa fa-check'></i> Success!</h4>
                                    ".$_SESSION['success']."
                                </div>
                            ";
                            unset($_SESSION['success']);
                        }
                        ?>
 
                        <div class="alert alert-danger alert-dismissible alert-enhanced" id="alert" style="display:none;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <span class="message"></span>
                        </div>

                        <?php
                        $sql = "SELECT * FROM votes WHERE voters_id = '".$voter['id']."'";
                        $vquery = $conn->query($sql);
                        if($vquery->num_rows > 0){
                            ?>
                            <div class="already-voted">
                                <h3>You have already voted for this election.</h3>
                                <a href="#view" data-toggle="modal" class="btn btn-flat btn-primary btn-lg">View Ballot</a>
                            </div>
                            <?php
                        }
                        else{
                            ?>
                            <!-- Enhanced Voting Ballot - Single Selection Only -->
                            <form method="POST" id="ballotForm" action="submit_ballot.php">
                                <?php
                                include 'includes/slugify.php';

                                $sql = "SELECT * FROM positions ORDER BY priority ASC";
                                $query = $conn->query($sql);
                                while($row = $query->fetch_assoc()){
                                    $slug = slugify($row['description']);
                                    // Force single selection instruction
                                    $instruct = 'Select only one candidate';
                                    
                                    echo '
                                    <div class="voting-card">
                                        <div class="position-header">
                                            <h3 class="position-title">'.$row['description'].'</h3>
                                            <p class="position-instruction">'.$instruct.'</p>
                                            <div class="pull-right">
                                                <button type="button" class="reset-btn reset" data-desc="'.$slug.'">
                                                    <i class="fa fa-refresh"></i> Reset
                                                </button>
                                            </div>
                                        </div>
                                        <div class="candidates-container" data-position="'.$slug.'">';

                                    $sql2 = "SELECT * FROM candidates WHERE position_id='".$row['id']."'";
                                    $cquery = $conn->query($sql2);
                                    while($crow = $cquery->fetch_assoc()){
                                        $checked = '';
                                        if(isset($_SESSION['post'][$slug])){
                                            $value = $_SESSION['post'][$slug];
                                            // Handle both array and single value for backward compatibility
                                            if(is_array($value)){
                                                if(in_array($crow['id'], $value)){
                                                    $checked = 'selected';
                                                }
                                            }
                                            else{
                                                if($value == $crow['id']){
                                                    $checked = 'selected';
                                                }
                                            }
                                        }

                                        // Force radio button for all positions (single selection)
                                        $input_type = 'radio';
                                        $input_name = $slug; // No array notation for single selection
                                        $image = (!empty($crow['photo'])) ? 'images/'.$crow['photo'] : 'images/profile.jpg';

                                        echo '
                                        <div class="candidate-item '.$checked.'" data-candidate-id="'.$crow['id'].'">
                                            <input type="'.$input_type.'" name="'.$input_name.'" value="'.$crow['id'].'" '.($checked ? 'checked' : '').'>
                                            <div class="candidate-content">
                                                <img src="'.$image.'" alt="Candidate Photo" class="candidate-photo">
                                                <div class="candidate-info">
                                                    <div class="candidate-name">'.$crow['firstname'].' '.$crow['lastname'].'</div>
                                                    <div class="candidate-actions">
                                                        <button type="button" class="platform-btn platform" data-platform="'.$crow['platform'].'" data-fullname="'.$crow['firstname'].' '.$crow['lastname'].'">
                                                            <i class="fa fa-search"></i> View Platform
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="selection-indicator"></div>
                                        </div>';
                                    }

                                    echo '
                                        </div>
                                    </div>';
                                }
                                ?>
                                
                                <div class="voting-actions">
                                    <!-- <button type="button" class="btn-enhanced btn-preview" id="preview">
                                        <i class="fa fa-file-text"></i> Preview Ballot
                                    </button>  -->
                                    <button type="submit" class="btn-enhanced btn-submit" name="vote">
                                        <i class="fa fa-check-square-o"></i> Submit Vote
                                    </button>
                                </div>
                            </form>
                            <!-- End Enhanced Voting Ballot -->
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
  
    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/ballot_modal.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
    // Single candidate selection functionality only
    $(document).on('click', '.candidate-item', function(e){
        e.preventDefault();
        
        var $this = $(this);
        var $container = $this.closest('.candidates-container');
        var $input = $this.find('input');
        
        // Always use single selection logic (radio button behavior)
        $container.find('.candidate-item').removeClass('selected');
        $container.find('input').prop('checked', false);
        
        // Select the clicked candidate
        $this.addClass('selected');
        $input.prop('checked', true);
    });

    // Reset functionality
    $(document).on('click', '.reset', function(e){
        e.preventDefault();
        var desc = $(this).data('desc');
        var $container = $('.candidates-container[data-position="' + desc + '"]');
        
        $container.find('.candidate-item').removeClass('selected');
        $container.find('input').prop('checked', false);
    });

    // Platform modal
    $(document).on('click', '.platform', function(e){
        e.preventDefault();
        e.stopPropagation(); // Prevent candidate selection when clicking platform button
        
        $('#platform').modal('show');
        var platform = $(this).data('platform');
        var fullname = $(this).data('fullname');
        $('.candidate').html(fullname);
        $('#plat_view').html(platform);
    });

    // Preview functionality
    $('#preview').click(function(e){
        e.preventDefault();
        var form = $('#ballotForm').serialize();
        if(form == ''){
            $('.message').html('You must vote for at least one candidate');
            $('#alert').show();
            setTimeout(function(){
                $('#alert').hide();
            }, 5000);
        }
        else{
            $.ajax({
                type: 'POST',
                url: 'preview.php',
                data: form,
                dataType: 'json',
                success: function(response){
                    if(response.error){
                        var errmsg = '';
                        var messages = response.message;
                        for (i in messages) {
                            errmsg += messages[i]; 
                        }
                        $('.message').html(errmsg);
                        $('#alert').show();
                        setTimeout(function(){
                            $('#alert').hide();
                        }, 5000);
                    }
                    else{
                        $('#preview_modal').modal('show');
                        $('#preview_body').html(response.list);
                    }
                }
            });
        }
    });

    // Auto-hide alerts
    $('.alert').on('closed.bs.alert', function () {
        $(this).hide();
    });

    // Smooth scrolling for better UX
    $('html, body').animate({
        scrollTop: 0
    }, 'slow');
});
</script>
</body>