<?php
function con(){
    return mysqli_connect("localhost","root","","contact-app");

}
$info=array(
    "name"=> "Contact App",
    "short"=>"CA",
    "description"=>"sample project"
);

$url="http://{$_SERVER['HTTP_HOST']}/contact_app";


?>
