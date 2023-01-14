<?php
session_start();

require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf(array('tempDir'=>'/srv/www/xyz/tmp'));

function fetch_data()
{
    $output = '';
    include '../Includes/db.inc.php';
    

    $g = 0;
    $sql = "SELECT * FROM orders ORDER BY id ASC";
  
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data as $row) {

        $output .= '<tr>  
                        <td> ' . $g++ . '</td>  
                        <td>' . $row["order_id"] . '</td>  
                        <td>' . $row["customers_firstname"] . ' ' . $row["customers_lastname"] . ' </td>  
                        <td>' . $row["email"] . '</td>  
                        <td>' . $row["customers_address"] . '</td>  
                        <td>' . $row["cart_items"] . '</td>  
                        <td>' . $row["payment_type"] . '</td>  
                        <td> #' . $row['amount'] . ' </td>
                        <td> ' . $row['customers_lga'] . ' </td>
                        <td> ' . $row['state'] . ' </td>
                        <td> ' . $row['payment_status'] . ' </td>
                        <td> ' . $row['additional_info'] . ' </td>
                        <td> ' . $row['phone_no'] . ' </td>
                        <td> ' . $row['order_status'] . ' </td>
                   </tr>  
                        ';
    }
    return $output;
}

if (isset($_POST["create_pdf"])) {


    $content = '';
    $content .= '
    
<head>
<title> Afrimama data"s </title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  
<link href="https://fonts.googleapis.com/css2?family=Open +Sans:wght@300;400;600;700;800&family=Poppins:wght@100;200;300; 400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700; 900&display=swap" rel="stylesheet">
    <style>
    @import url("https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;700;800;900&family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&family=Josefin+Sans:ital,wght@0,200;0,500;0,600;0,700;1,500&family=Lato:ital,wght@0,100;0,300;0,400;0,900;1,700;1,900&family=Montserrat:wght@100;200;400;600;700;900&family=Mukta:wght@200;300;500;700;800&family=Nunito+Sans:ital,wght@0,200;0,400;0,600;0,800;1,400;1,800&family=Poppins:ital,wght@0,100;0,400;0,600;0,900;1,500&family=Prompt:wght@100;300;500;600;700;800&display=swap");


    @font-face {
        font-family: "Elegance";
        font-weight: normal;
        font-style: normal;
        font-variant: normal;
        src: url("http://eclecticgeek.com/dompdf/fonts/Elegance.ttf") format("truetype");
      }
      body {
        font-family: Elegance, sans-serif;
      }

    .container{
         overflow-x:auto ;
         font-family:"Montserat", sans-serif;
    }

    th{
         color:red;
         font-weight:bold;
         font-size:1.3em;
    }

    h3{
        font-family:"poppins", sans-serif;
        font-weight: bold;
      }
      table {
        font-family:"poppins", sans-serif;
      }

    table {
         border-collapse: collapse;
         border-spacing: 0;
         width: 100%;
         border: 1px solid #ddd;
         background-color: white;
         margin-top: 20px;
         overflow-x:auto;
         font-family:poppins!important;
       }

     
       tr:nth-child(even){
            background-color: #f2f2f2;
    }  
 </style>
 </head>
<div class="container">  
<h3 align="center">  Afrimama data </h3><br /><br />  
<div class="table-responsive">  
<table border="1" cellspacing="0" cellpadding="5">  
    <tr>  
         <th width="3%">S/N</th>  
         <th width="5%">ID</th>  
         <th width="7%">Name</th>  
         <th width="10%"> Email </th>  
         <th width="12%"> Address</th>  
         <th width="10%">   Cart Items</th> 
         <th width="5%">Payment Type</th>  
         <th width="4%">Amount Paid</th>
         <th width="4%">lga</th>
         <th width="4%">Customers State</th>
         <th width="4%">Payment status</th>
         <th width="10%">Additional Info</th>
         <th width="5%"> Phone</th>
         <th width="5%">Order Status</th>
    </tr>  
     ';
    $content .= fetch_data();
    $content .= '</table>';
    $content .= '</div>';
    $content .= '</div>';



    // Load HTML content 
    $dompdf->loadHtml($content);

    // Load html file 
    //  $html = file_get_contents("fuck.html"); 
    // $dompdf->loadHtml($html); 

    $dompdf->setPaper('A2', 'landscape');
    $dompdf->render();
    $dompdf->stream("afrimama", array("Attachment" => 1));
}

?>

<!DOCTYPE html>
<html>

<head>
    <title> Afrimama data's </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
      
    <link href="https://fonts.googleapis.com/css2?family=Open +Sans:wght@300;400;600;700;800&family=Poppins:wght@100;200;300; 400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700; 900&display=swap" rel="stylesheet">
    <style>
          @import url("https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;700;800;900&family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&family=Josefin+Sans:ital,wght@0,200;0,500;0,600;0,700;1,500&family=Lato:ital,wght@0,100;0,300;0,400;0,900;1,700;1,900&family=Montserrat:wght@100;200;400;600;700;900&family=Mukta:wght@200;300;500;700;800&family=Nunito+Sans:ital,wght@0,200;0,400;0,600;0,800;1,400;1,800&family=Poppins:ital,wght@0,100;0,400;0,600;0,900;1,500&family=Prompt:wght@100;300;500;600;700;800&display=swap");

          
          h3{
            font-family:"poppins", sans-serif;
            font-weight: bold;
          }
          table {
            font-family:"poppins", sans-serif;
          }
    </style>
</head>

<body>
    <br /><br />
    <div class="container" style="width:700px;">
        <h3 align="center"> Orders data</h3><br />
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th width="3%">S/N</th>
                    <th width="5%">ID</th>
                    <th width="7%">Name</th>
                    <th width="10%"> Email </th>
                    <th width="12%"> Address</th>
                    <th width="10%"> Cart Items</th>
                    <th width="5%">Payment Type</th>
                    <th width="4%">Amount Paid</th>
                    <th width="4%">lga</th>
                    <th width="4%">Customers State</th>
                    <th width="4%">Payment status</th>
                    <th width="10%">Additional Info</th>
                    <th width="5%"> Phone</th>
                    <th width="5%">Order Status</th>
                </tr>
                <?php
                echo fetch_data();
                ?>
            </table>
            <br />
            <form method="post">
                <input type="submit" name="create_pdf" class="btn btn-danger" value="Create PDF" />
            </form>
        </div>
    </div>
</body>

</html>