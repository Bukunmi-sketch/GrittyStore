<?php
function fetch_data()
{
     $output = '';
     $connect = mysqli_connect("localhost", "root", "", "afrimama");

     $g = 0;
     $sql = "SELECT * FROM orders ORDER BY id ASC";
     $result = mysqli_query($connect, $sql);
     while ($row = mysqli_fetch_array($result)) {
          $output .= '<tr>  
                          <td> ' . $g++ . '</td>  
                          <td>' . $row["order_id"] . '</td>  
                          <td>' . $row["customers_firstname"] . ' ' . $row["customers_lastname"] . ' </td>  
                          <td>' . $row["email"] . '</td>  
                          <td>' . $row["customers_address"] . '</td>  
                          <td>' . $row["cart_items"] . '</td>  
                          <td>' . $row["payment_type"] . '</td>  
                          <td> '.$row['amount'].' </td>
                          <td> '.$row['state'].' </td>
                          <td> '.$row['customers_lga'].' </td>
                          <td> '.$row['payment_status'].' </td>
                     </tr>  
                          ';
     }
     return $output;
}
if (isset($_POST["create_pdf"])) {
     require_once('tcpdf/tcpdf.php');
     $obj_pdf = new TCPDF('P', PDF_UNIT, 'A2', true, 'UTF-8', false);
     $obj_pdf->SetCreator(PDF_CREATOR);
     $obj_pdf->SetTitle("Afrimama data");
     $obj_pdf->SetHeaderData('hellos', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
     $obj_pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
     $obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
     $obj_pdf->SetDefaultMonospacedFont('dejavusans');
     $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
     $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
     $obj_pdf->setPrintHeader(false);
     $obj_pdf->setPrintFooter(false);
     $obj_pdf->SetAutoPageBreak(TRUE, 10);
     $obj_pdf->SetFont('dejavusans', '', 7);
     $obj_pdf->AddPage();
     $content = '';
     $content .= '
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

             tr{
               background-color: #f2f2f2;
             }  
             
             tr:nth-child(even){
                  background-color: #f2f2f2;
          }  
       </style>
      ';
     $content .= '  
      <div class="container">  
      <h3 align="center">  Afrimama data </h3><br /><br />  
      <div class="table-responsive">  
      <table border="1" cellspacing="0" cellpadding="5" style="border:1px solid red">  
           <tr>  
                <th width="3%">S/N</th>  
                <th width="5%">ID</th>  
                <th width="7%">Name</th>  
                <th width="10%">Gender</th>  
                <th width="12%">Designation</th>  
                <th width="10%">   Cart Items</th> 
                <th width="5%">Payment Type</th>  
                <th width="4%">Amount Paid</th>
                <th width="4%">lga</th>
                <th width="4%">Customers State</th>
                <th width="4%">Payment status</th>
           </tr>  
      ';
     $content .= fetch_data();
     $content .= '</table>';
     $content .= '</div>';
     $content .= '</div>';
     $obj_pdf->writeHTML($content);
     ob_end_clean();
     $obj_pdf->Output('sample.pdf', 'I');
}
?>
<!DOCTYPE html>
<html>

<head>
     <title> Afrimama data's </title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>

<body>
     <br /><br />
     <div class="container" style="width:700px;">
          <h3 align="center"> Afrimama data</h3><br />
          <div class="table-responsive">
               <table class="table table-bordered">
                    <tr>
                         <th width="2%">S/N</th>
                         <th width="10%">ID</th>
                         <th width="10%">Name</th>
                         <th width="15%">Gender</th>
                         <th width="20%">Designation</th>
                         <th width="10%">Age</th>
                         <th width="10%">Payment Type</th>
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