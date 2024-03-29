<?php 

            //import users class file
    include '../Models/Auth.php';  
    include '../Models/User.php';  
    include '../Models/Login.php';  
    include '../Models/Register.php';  
    include '../Models/Product.php';  
    include '../Models/Order.php';  
    include '../Models/Customer.php';
    include '../Models/Category.php';
    include '../Models/Report.php';
    include '../Models/Notification.php';
    include '../Models/Payment.php';
    include '../Models/Dashboard.php';
    include '../Models/Brand.php';
    include '../Models/Agent.php';
    include '../Models/Currency.php';
      // create of object of the user class
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
    $dashboardInstance =new Dashboard($conn);
    $brandInstance = new Brand($conn);
    $agentInstance =new Agent($conn);
    $currencyInstance =new Currency($conn);
    
    $dirfile="../Images/product-img/";
    $categorydirfile="../Images/category-img/";

     $agentsignupdirfile='http://localhost/websites/agent/Images/signup-img/';
    // $agentsignupdirfile='http://api.afrimamafarms.com/agent/Images/signup-img/';
   //  $agentsignupdirfile='https://afrimamafarms.com/agent/Images/signup-img/';

    $agentidentitydirfile='http://localhost/websites/agent/Images/signup-img/';
    // $agentidentitydirfile='http://api.afrimamafarms.com/agent/Images/signup-img/';
   //  $agentidentitydirfile='https://afrimamafarms.com/agent/Images/signup-img/';
     
/*
   $postdirfile="../Images/post_img/post-image--";
   $coverdirfile="../Images/cover_img/";
   $dirfile='..../Images/signup_img/'

*/

     ?>