<html lang = "en">

<head>
    <?php
    require_once("../config.php");
    require_once ("../lib/userControl.php");

    ?>
    <title>New category</title>


</head>
<body>
<div class="container">
    <?php

    $db = DBConnect::setConnection();
    if (isset($_POST['createCategory']) && isset($_POST['categoryName'])) {

            insertDataToDB::createCategory($_POST['categoryName']);

    }
    echo $twig->render('admin/category-edit.html.twig',['phpSelf'=>htmlspecialchars($_SERVER['PHP_SELF'])]);


    ?>
</div>
</body>

</html>