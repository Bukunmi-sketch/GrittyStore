<?php
session_start();

require_once 'dompdf/autoload.inc.php';  
use Dompdf\Dompdf; 
$dompdf = new Dompdf();


// include '../Includes/inc.php';
require '../Includes/db.inc.php';
//include '../Includes/autoload.php';
//include './auth/redirect.php';

//$orderInstance = new Order($conn);

    $pagesql = "SELECT * FROM orders ";
    $statement = $conn->prepare($pagesql);
    $statement->execute();
    $orderData = $statement->fetchAll(PDO::FETCH_ASSOC);
    $g=1;
    if ($statement->rowCount() > 0){
 
$output='

            <table style="table-layout:fixed;">
              <thead>
                <tr>
                  <th>S/N</th>
                  <th> Action </th>
                  <th> Order id</th>
                
                </tr>
              </thead>
              <tbody>
';
      foreach($orderData as $orders){ 
 $output.='
        <div>
                    <tr class="trr" id="eachorder'.$orders['id'].'">
                    <td> '.$g++.' </td>
                      <form action="" class="order-modify">
                        <td>
                          <button data-identity="'.$orders['id'].'" class="deletebtn">Delete</button>
                        </td>
                      </form>                     
                      <td> '.$orders['order_id'].' </td>
                      
                    </tr>
        </div> 
                  ';
          
       }

       $output.='   </tbody>
       </table>
    ';

   }else{ 
       $output.='
    <p>There are no family in this fellowship yet</p>
  ';
   }
   
 
  
   
    // Load HTML content 
    $dompdf->loadHtml($output); 
     
    // Load html file 
  //  $html = file_get_contents("fuck.html"); 
   // $dompdf->loadHtml($html); 
     
    $dompdf->setPaper('A4', 'landscape'); 
    $dompdf->render(); 
    $dompdf->stream("niceshipest", array("Attachment" => 0));
?>



