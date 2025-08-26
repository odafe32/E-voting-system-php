<?php
include 'includes/session.php';

if(isset($_POST['edit'])){
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $matric_number = $_POST['matric_number'];
    $password = $_POST['password'];
    
    // Validate required fields
    if(empty($firstname) || empty($lastname) || empty($matric_number)){
        $_SESSION['error'] = 'Please fill in all required fields';
        header('location: voters.php');
        exit();
    }
    
    // Validate matric number format
    if(!preg_match('/^0220/', $matric_number)){
        $_SESSION['error'] = 'Invalid matric number format. Must start with 0220';
        header('location: voters.php');
        exit();
    }
    
    // Get current voter data
    $sql = "SELECT * FROM voters WHERE id = $id";
    $query = $conn->query($sql);
    
    if($query->num_rows == 0){
        $_SESSION['error'] = 'Student not found';
        header('location: voters.php');
        exit();
    }
    
    $row = $query->fetch_assoc();
    
    // Check if matric number is being changed and if new one already exists
    if($matric_number != $row['voters_id']){
        $check_sql = "SELECT * FROM voters WHERE voters_id = '$matric_number' AND id != $id";
        $check_query = $conn->query($check_sql);
        if($check_query->num_rows > 0){
            $_SESSION['error'] = 'Matric number already exists in the system';
            header('location: voters.php');
            exit();
        }
    }
    
    // Handle password - only hash if it's being changed
    $password_update = "";
    if(!empty($password)){
        // Check if password is different from current (assuming current is hashed)
        if(!password_verify($password, $row['password'])){
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $password_update = ", password = '$hashed_password'";
        }
    }
    
    // Handle photo upload if new photo is provided
    $photo_update = "";
    if(isset($_FILES['photo']) && !empty($_FILES['photo']['name'])){
        $filename = $_FILES['photo']['name'];
        $target_dir = '../images/';
        $target_file = $target_dir . basename($filename);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Check if image file is actual image
        $check = getimagesize($_FILES['photo']['tmp_name']);
        if($check === false) {
            $_SESSION['error'] = 'File is not an image';
            header('location: voters.php');
            exit();
        }
        
        // Check file size (limit to 5MB)
        if ($_FILES['photo']['size'] > 5000000) {
            $_SESSION['error'] = 'Sorry, your file is too large. Maximum size is 5MB';
            header('location: voters.php');
            exit();
        }
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            $_SESSION['error'] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';
            header('location: voters.php');
            exit();
        }
        
        // Generate unique filename
        $unique_filename = $matric_number . '_' . time() . '.' . $imageFileType;
        $target_file = $target_dir . $unique_filename;
        
        if(move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)){
            // Delete old photo if it exists and is not the default
            if(!empty($row['photo']) && $row['photo'] != 'profile.jpg' && file_exists($target_dir . $row['photo'])){
                unlink($target_dir . $row['photo']);
            }
            $photo_update = ", photo = '$unique_filename'";
        }
        else{
            $_SESSION['error'] = 'Sorry, there was an error uploading your file';
            header('location: voters.php');
            exit();
        }
    }
    
    // Update voter information using matric number as voters_id
    $sql = "UPDATE voters SET 
            voters_id = '$matric_number', 
            firstname = '$firstname', 
            lastname = '$lastname'
            $password_update
            $photo_update
            WHERE id = '$id'";
            
    if($conn->query($sql)){
        $_SESSION['success'] = 'Student information updated successfully';
    }
    else{
        $_SESSION['error'] = $conn->error;
    }
}
else{
    $_SESSION['error'] = 'Fill up edit form first';
}

header('location: voters.php');
?>