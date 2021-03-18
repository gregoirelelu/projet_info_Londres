<?php
require 'database-class.php';
require 'bag-class.php';
$db = new database();
$bag = new bag($db);

if (isset($_GET['id'])){
    $product = $db->request('SELECT id FROM hightech WHERE id=:id', array('id' => $_GET['id']));
    $bag->add($product[0]->id);
    header("Location: bag.php?id=".$_SESSION['id']);
}
?>