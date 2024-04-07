<?php
if(isset($_FILES['image'])){
    $errors = array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    //$file_ext = strtolower(end(explode('.',$_FILES['image']['name'])));
    $tmp = explode('.', $file_name);
    $file_ext = end($tmp);
    
    $extensions = array("jpeg", "jpg", "png");
    
    if(in_array($file_ext, $extensions) === false){
        $errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
    }
    
    if($file_size > 2097152){
        $errors[] = 'File size must be exactly 2 MB';
    }
    
    if(empty($errors)){
        move_uploaded_file($file_tmp, "images/" . $file_name);
        echo "Success";
    } else {
        print_r($errors);
    }
}
?>
<html>
<body>
    <form action = "" method = "POST" enctype = "multipart/form-data">
        <input type = "file" name = "image" />
        <input type = "submit"/>
        <?php if(isset($_FILES['image'])): ?>
        <ul>
            <li>Sent file: <?php echo $_FILES['image']['name']; ?></li>
            <li>File size: <?php echo $_FILES['image']['size']; ?></li>
            <li>File type: <?php echo $_FILES['image']['type'] ?></li>
        </ul>
        <?php endif; ?>
    </form>
</body>
</html>
