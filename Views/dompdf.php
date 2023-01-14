<?php
session_start();

require_once 'dompdf/autoload.inc.php';  
use Dompdf\Dompdf; 
$dompdf = new Dompdf();

include '../Includes/db.inc.php';
//$connect = mysqli_connect("localhost", "root", "", "afrimama");

$g = 0;
$sql = "SELECT * FROM orders ORDER BY id ASC";
//$result = mysqli_query($connect, $sql);
$stmt = $conn->prepare($sql);
$stmt->execute();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);

if ($stmt->rowCount() > 0){

$output = '
  <style>
     .container{
          overflow-x:auto ;
       
     }

     th{
          color:red;
          font-weight:bold;
          font-size:1.3em;
     }

     table {
          border-collapse: collapse;
          border-spacing: 0;
          width: 100%;
          border: 1px solid #ddd;
          background-color: white;
          margin-top: 20px;
          overflow-x:auto;
          font-family:"DM sans",sans-serif; 
        }

      
        tr:nth-child(even){
             background-color: #f2f2f2;
     }  
  </style>
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

//while ($row = mysqli_fetch_array($result)) {
     foreach($data as $row){
 

     $output .= '<tr>  
                     <td> ' . $g++ . '</td>  
                     <td>' . $row["order_id"] . '</td>  
                     <td>' . $row["customers_firstname"] . ' ' . $row["customers_lastname"] . ' </td>  
                     <td>' . $row["email"] . '</td>  
                     <td>' . $row["customers_address"] . '</td>  
                     <td>' . $row["cart_items"] . '</td>  
                     <td>' . $row["payment_type"] . '</td>  
                     <td> #'.$row['amount'].' </td>
                     <td> '.$row['customers_lga'].' </td>
                     <td> '.$row['state'].' </td>
                     <td> '.$row['payment_status'].' </td>
                     <td> '.$row['additional_info'].' </td>
                     <td> '.$row['phone_no'].' </td>
                     <td> '.$row['order_status'].' </td>
                </tr>  
                     ';
}
$output .= '</table>';
$output .= '</div>';
$output .= '</div>';

}else{
     $output .= 'no result was returned';
}
  
   
    // Load HTML content 
    $dompdf->loadHtml($output); 
     
    // Load html file 
  //  $html = file_get_contents("fuck.html"); 
   // $dompdf->loadHtml($html); 
     
    $dompdf->setPaper('A2', 'landscape'); 
    $dompdf->render(); 
    $dompdf->stream("afrimama", array("Attachment" => 0));
?>



