<?php
include 'includes/session.php';
include 'includes/slugify.php';

if(isset($_POST['vote'])){
    // Check if user has already voted
    $sql = "SELECT * FROM votes WHERE voters_id = '".$voter['id']."'";
    $vquery = $conn->query($sql);
    if($vquery->num_rows > 0){
        $_SESSION['error'][] = 'You have already voted for this election.';
    }
    else{
        // Check if at least one candidate was selected
        $vote_count = 0;
        foreach($_POST as $key => $value){
            if($key != 'vote' && !empty($value)){
                $vote_count++;
            }
        }
        
        if($vote_count == 0){
            $_SESSION['error'][] = 'Please vote for at least one candidate';
        }
        else{
            $_SESSION['post'] = $_POST;
            $sql = "SELECT * FROM positions";
            $query = $conn->query($sql);
            $error = false;
            $sql_array = array();
            
            while($row = $query->fetch_assoc()){
                $position = slugify($row['description']);
                $pos_id = $row['id'];
                
                if(isset($_POST[$position]) && !empty($_POST[$position])){
                    // Since we're using single selection only, $_POST[$position] is always a single value
                    $candidate = $_POST[$position];
                    
                    // Validate that the candidate exists and belongs to this position
                    $validate_sql = "SELECT * FROM candidates WHERE id = '$candidate' AND position_id = '$pos_id'";
                    $validate_query = $conn->query($validate_sql);
                    
                    if($validate_query->num_rows > 0){
                        $sql_array[] = "INSERT INTO votes (voters_id, candidate_id, position_id) VALUES ('".$voter['id']."', '$candidate', '$pos_id')";
                    }
                    else{
                        $error = true;
                        $_SESSION['error'][] = 'Invalid candidate selected for '.$row['description'];
                    }
                }
            }

            if(!$error){
                // Insert all votes
                foreach($sql_array as $sql_row){
                    $conn->query($sql_row);
                }

                unset($_SESSION['post']);
                $_SESSION['success'] = 'Ballot submitted successfully!';
            }
        }
    }
}
else{
    $_SESSION['error'][] = 'Select candidates to vote first';
}

header('location: home.php');
?>