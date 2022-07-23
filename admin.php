<!DOCTYPE html>
<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <script src="jquery.min.js" type="text/javascript"></script>
    <script src="jquery.uploadifive.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="uploadifive.css">

    <link rel="stylesheet" type="text/css" href="admin.css" />

    <link rel="icon" type="image/png" href="geplauder.png">

    <title>
        Geplauder Admin
    </title>

</head>

<body>

    <h2>File Upload</h2>

    <h1>
        Geplauder Admins' Site
    </h1>
    <h2>
        Images:
    </h2>

    <?php
    $dir = dirname(__FILE__) . "\\uploads";

    $a = scandir($dir);

    $filearr = [];

    foreach ($a as $fl) {

        $file_parts = pathinfo($fl);

        $extensions = array("jpg", "jpeg", "png");

        if (in_array($file_parts['extension'], $extensions)) {
            $filearr[] = $fl;
        }
    }

    if(count($filearr)) {
        foreach ($filearr as $nf) {
            $element = "<div class='gallery'><a target='_blank' href='uploads\\" . $nf . "'><img class='galimg' src='uploads\\" . $nf . "' alt='Gut'></a></div>";
            echo $element;
        }
    }
    else {
        echo "No images uploaded on the server. Upload an image from below:";
    }

    ?>

    <script type="text/javascript">
        function setDesc() {
            var divgal = document.getElementsByClassName("gallery");
            var imggal = document.getElementsByClassName("galimg");

            for (var i = 0; i < imggal.length; i++) {
                const wdt = imggal[i].offsetWidth;
                const hgt = imggal[i].offsetHeight;
                divgal[i].setAttribute("style", `height: ${hgt}px`);
            }

            /*const div = document.getElementById('imgdiv1')
            const clone = div.cloneNode(true);
            clone.id = "foo2";
            document.body.appendChild(clone);*/

        }

        window.onload = setDesc;
        
    </script>

    <hr style="clear:both;">

    <h2>Upload Image:</h2>

    <p>Queue:</p>

    <form>
        <div id="queue"></div>
        <p>Max Image Size: 20MB<br>Allowed File Types: JPG, JPEG, PNG, GIF</p>
        <input id="file_upload" name="file_upload" type="file" multiple="true">
        <a style="position: relative; top: 8px;" href="javascript:$('#file_upload').uploadifive('upload')">Upload Files</a>
    </form>

    <script type="text/javascript">
        <?php $timestamp = time(); ?>
        $(function() {
            $('#file_upload').uploadifive({
                'auto': false,
                'checkScript': 'check-exists.php',
                'fileType': '.jpg,.jpeg,.gif,.png',
                'formData': {
                    'timestamp': '<?php echo $timestamp; ?>',
                    'token': '<?php echo md5('unique_salt' . $timestamp); ?>'
                },
                'queueID': 'queue',
                'uploadScript': 'uploadifive.php',
                'onUploadComplete': function(file, data) {
                    console.log(data);
                    location = location
                }
            });
        });
    </script>

    <div class="footer">

        <p>by <a href="mailto:venoa@protonmail.com" class="maillink">Venoa</a> and <a href="mailto:engelstadt@protonmail.com" class="maillink">Engelstadt</a></p>
        <br>
        <a>2022 ©</a>

    </div>

</body>

</html>