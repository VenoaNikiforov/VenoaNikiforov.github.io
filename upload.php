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

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="file" id="myFile" name="filename">
        <br>
        <br>
        <input type="text" id="desc" name="description">
        <br>
        <br>
        <input type="submit">
    </form>

    <?php

    $filename = $description = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $filename = test_input($_POST["filename"]);
        $description = test_input($_POST["description"]);
        if ($filename !== '' and $description !== '') {

            $csvname = 'data.csv';

            $csvdata = [[$filename, $description]];

            $f = fopen($csvname, 'w') or die('Error opening the file ' . $csvname);;

            foreach ($csvdata as $row) {
                fputcsv($f, $row);
            }

            fclose($f);

            $filedata = [];

            $f = fopen($csvname, 'r') or die('Error opening the file ' . $csvname);;

            while (($row = fgetcsv($f)) !== false) {
                $filedata[] = $row;
            }

            fclose($f);

            $element = "<div id='imgdiv1' class='gallery'><a target='_blank' href=".$filename."><img class='galimg' src=".$filename." alt='Gut'></a><p class='desc'>".$description."</p></div>";
            $count = count($filedata);
            foreach (range(1, $count) as $item) {
                echo $element;
            }
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }





    ?>

    <h1>
        Geplauder Admins' Site
    </h1>
    <h2>
        Images:
    </h2>

    <div id="imgdiv1" class="gallery">
        <a target="_blank" href="c4.png">
            <img class="galimg" src="c4.png" alt="Gut">
        </a>
        <p class="desc">Very good</p>
    </div>

    <div class="gallery">
        <a target="_blank" href="denizbembayazen.png">
            <img class="galimg" src="denizbembayazen.png" alt="Gut">
        </a>
        <p class="desc">Very good</p>
    </div>

    <div class="gallery">
        <a target="_blank" href="d4.png">
            <img class="galimg" src="d4.png" alt="404">
        </a>
        <p class="desc">Very good</p>
    </div>

    <div class="footer">

        <p>by <a href="mailto:venoa@protonmail.com" class="maillink">Venoa</a> and <a href="mailto:engelstadt@protonmail.com" class="maillink">Engelstadt</a></p>
        <br>
        <a>2022 ©</a>

    </div>

    <hr style="clear:both;">

    <?php
    echo "<h2>Your Input:</h2>";
    echo $filename;
    echo "<br>";
    echo $description;
    echo "<br>";

    ?>

    <script type="text/javascript">
        function setDesc() {
            var pdesc = document.getElementsByClassName("desc");
            var imggal = document.getElementsByClassName("galimg");
            var wdt = imggal[0].offsetWidth;
            var hgt = imggal[0].offsetHeight;
            for (var i = 0; i < pdesc.length; i++) {
                pdesc[i].style.right = (wdt - pdesc[i].clientWidth) / 2 + "px";
                pdesc[i].style.top = (hgt - 12) + "px";
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