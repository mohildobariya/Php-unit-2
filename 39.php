<?php
if(isset($_FILES['image'])){
    $errors = array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_name_parts = explode('.', $file_name);
    $file_ext = strtolower(end($file_name_parts));
    
    $extensions = array("jpeg","jpg","png");
    
    if(in_array($file_ext, $extensions) === false){
        $errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
    }
    
    if($file_size > 2097152){
        $errors[] = 'File size must be exactly 2 MB';
    }
    
    if(empty($errors)){
        $upload_dir = "images/";
        if(!file_exists($upload_dir)){
            mkdir($upload_dir, 0777, true); // Create directory if it doesn't exist
        }
        $destination = $upload_dir . $file_name;
        if(move_uploaded_file($file_tmp, $destination)){
            echo "Success: File uploaded successfully!";
        } else {
            echo "Error: Failed to move file to destination.";
        }
    } else {
        echo "Errors occurred:";
        foreach($errors as $error){
            echo "<br>" . $error;
        }
    }
}
?>
<html>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="image" />
        <input type="submit"/>
    </form>
</body>
</html>
