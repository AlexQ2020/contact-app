<?php
require_once "base.php";
require_once "function.php";

$id=$_GET['id'];

if(contactDelete($id)){
    linkTo('contact_list.php');
}
