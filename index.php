<html lang="en">

<head>
    <?php
    require_once("config.php");

    ?>
    <title>Home</title>

</head>
<body>

<?php

if (isset($_SESSION['accessLevel'])) {
    if ($_SESSION['accessLevel'] == 2) {
        require_once("lib/headerFooter/adminMenu.php");
    }
}
//set color option from siteItems
Session::setSiteColors();
//manage paggination
$pager ='';
if (isset($_GET['p'])){
    $pager=((int)htmlspecialchars($_GET['p']))*3;
    $result = getDataFromDB::getArticles($pager);
}else{
    $pager=0;
    $result = getDataFromDB::getArticles();
}
$promotedRes = getDataFromDB::getPromotedArticles();
//print_r($promotedRes);exit;
//call the header template
//if the session variables are not set, pass null with the ternary operator

require_once("lib/headerFooter/header.php");
echo("<div class='container'>");
echo $twig->render('promoted.html.twig', ['promoted' => $promotedRes]);
//get every article from the DB

//display it in the template
echo $twig->render('index.html.twig', ['articles' => $result]);
//ternary operator: if get is set then convert it to safe string and then int, else pass 0
echo $twig->render('pagination.html.twig', ['accentColor'=>$_SESSION['accent_color'], 'currentPage'=>isset($_GET['p'])?(int)htmlspecialchars($_GET['p']):0]);

?>
</div>
</body>
<?php
require_once("lib/headerFooter/footer.php");
?>
</html>

<?php
if (isset($_POST['logOut'])) {
    session_destroy();
    header("location:../index.php");
}
?>