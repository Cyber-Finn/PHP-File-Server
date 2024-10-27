<?php
    echo <<<_END
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <title>File Upload</title>
    </head>
    <body>
        <h1>Upload File</h1>
        <form method="post" action="index.php" enctype="multipart/form-data">
        Select File: <input type="file" name="filename" size="10">
            <input type="submit" value="Upload">
        </form>
    _END;

    if($_FILES)
    {
        $name = $_FILES["filename"]["name"];

        if (strpos($name, '/') !== false || strpos($name, '\\') !== false || strpos($name, '*') !== false) 
        {
            echo "<script>alert(\"Filename cannot have slashes!\")</script>";
            return;
        }

        move_uploaded_file($_FILES["filename"]["tmp_name"], '.\\Files\\' .$name);
        echo "uploaded file: $name ";
    }
    

    echo <<<_END
    </body>
    </html>
    _END;
?>