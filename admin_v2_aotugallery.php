<!DOCTYPE html>
<html>

<head>

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

    foreach ($filearr as $nf) {
        $element = "<div class='gallery'><a target='_blank' href='uploads\\" . $nf . "'><img class='galimg' src='uploads\\" . $nf . "' alt='Gut'></a></div>";
        echo $element;
    }

    ?>

    <div class="footer">

        <p>by <a href="mailto:venoa@protonmail.com" class="maillink">Venoa</a> and <a href="mailto:engelstadt@protonmail.com" class="maillink">Engelstadt</a></p>
        <br>
        <a>2022 ©</a>

    </div>

    <hr style="clear:both;">

    <script type="text/javascript">
        function setDesc() {
            var divgal = document.getElementsByClassName("gallery");
            var imggal = document.getElementsByClassName("galimg");

            for (var i = 0; i < imggal.length; i++) {
                const wdt = imggal[i].offsetWidth;
                const hgt = imggal[i].offsetHeight;
                divgal[i].setAttribute("style",`height: ${hgt}px`);
            }

            /*const div = document.getElementById('imgdiv1')
            const clone = div.cloneNode(true);
            clone.id = "foo2";
            document.body.appendChild(clone);*/

        }

        window.onload = setDesc;
        
    </script>

</body>

</html>