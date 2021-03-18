<?php
class bag{
    private $db;

    public function __construct($db){
        if (!isset($_SESSION)){
            session_start();
        }
        if (!isset($_SESSION['bag'])){
            $_SESSION['bag'] = array();
        }
        if (isset($_POST['bag']['quantity'])){
            $this->reload();
        }
        $this->db = $db;
        if (isset($_GET['delBag'])){
            $this->delete($_GET['delBag']);
        }
    }
    public function add($id_product){
        if(!isset($_SESSION['bag'][$id_product])){
            $_SESSION['bag'][$id_product] = 1;
        }
        else{
            $_SESSION['bag'][$id_product]++;
        }
    }
    public function delete($id_product){
        unset($_SESSION['bag'][$id_product]);
    }
    public function total(){
        $total = 0;
        $ids = array_keys($_SESSION['bag']);

        if (!empty($ids)) {
            $products = $this->db->request('SELECT id, PRICE FROM product WHERE id IN (' . implode(',', $ids) . ')');
        } else {
            $products = array();
        }

        foreach ($products as $product){
            $total += $product->PRICE * $_SESSION['bag'][$product->id];
        }
        return $total;
    }
    public function countProducts(){
        return array_sum($_SESSION['bag']);
    }
    public function reload(){
        foreach ($_SESSION['bag'] as $id_product => $quantity){
            if (isset($_POST['bag']['quantity'][$id_product])){
                $_SESSION['bag'][$id_product] = $_POST['bag']['quantity'][$id_product];
            }
        }
    }
}
