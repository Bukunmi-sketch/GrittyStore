<?php
require '../Includes/db.inc.php';
spl_autoload_register(function($className) {
             $file ='../Models/'.$className . '.php';
            if (file_exists($file)) {
                 // echo "$file included\n";
                  include $file;
            } else {
            throw new Exception("Unable to load $className.");
           }
        });

        
try {
    $authInstance= new Auth($conn);
    $userInstance= new User($conn);
    $loginInstance= new Login($conn);
    $registerInstance= new Register($conn);
    $productInstance = new Product($conn);
    $orderInstance = new Order($conn);
    //$customersInstance = new Customer($conn);
    $categoryInstance = new Category($conn);
    $reportInstance = new Report($conn);
    $payInstance = new Payment($conn);
    $notifyInstance = new Notification($conn);
    $agentInstance =new Agent($conn);
    
} catch (Exception $e) {
echo $e->getMessage(), "\n";
}  
?>