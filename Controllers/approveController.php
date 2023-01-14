<?php
include '../Models/Agent.php';  

$agentid=$_POST["agentid"];
$agentInstance= new Agent($conn);      



if($_SERVER['REQUEST_METHOD']=="POST"){

    if($agentInstance->approveThisAgent($agentid)){
      echo "success";
    }else{
        echo "unable to approve this agent ";
            }



}


?>