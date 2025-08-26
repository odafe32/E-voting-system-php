<?php
include 'includes/session.php';

if(isset($_POST['add'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $matric_number = $_POST['matric_number']; // Get matric number from form
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $filename = $_FILES['photo']['name'];
    
    // Validate matric number format
    if(!preg_match('/^0220/', $matric_number)){
        $_SESSION['error'] = 'Invalid matric number format. Must start with 0220';
        header('location: voters.php');
        exit();
    }
    
    // Check if matric number already exists
    $check_sql = "SELECT * FROM voters WHERE voters_id = '$matric_number'";
    $check_query = $conn->query($check_sql);
    if($check_query->num_rows > 0){
        $_SESSION['error'] = 'Matric number already exists in the system';
        header('location: voters.php');
        exit();
    }
    
    // Handle photo upload
    if(!empty($filename)){
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
        
        // Generate unique filename to prevent conflicts
        $unique_filename = $matric_number . '_' . time() . '.' . $imageFileType;
        $target_file = $target_dir . $unique_filename;
        
        if(!move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)){
            $_SESSION['error'] = 'Sorry, there was an error uploading your file';
            header('location: voters.php');
            exit();
        }
        $filename = $unique_filename;
    }
    
    // Use matric number as voters_id
    $sql = "INSERT INTO voters (voters_id, password, firstname, lastname, photo) VALUES ('$matric_number', '$password', '$firstname', '$lastname', '$filename')";
    if($conn->query($sql)){
        $_SESSION['success'] = 'Student added successfully with matric number: ' . $matric_number;
    }
    else{
        $_SESSION['error'] = $conn->error;
    }
}
else{
    $_SESSION['error'] = 'Fill up add form first';
}

header('location: voters.php');
?>