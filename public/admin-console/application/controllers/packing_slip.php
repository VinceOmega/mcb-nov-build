<?php

require(DOCROOT. 'application/helpers/PDF_generation/fpdf.php');

class PDF extends FPDF
{
//Page header
function Header()
{
	$this->SetDisplayMode('real');
    //Logo
    $this->Image(DOCROOT. 'media/images/logo.gif',10,8,60);
    //Arial bold 15
    $this->SetFont('Arial','B',10);
    //Move to the right
    $this->Cell(126);
    //Title
    $this->Cell(90,10,'24139 Haywards Crossing Ln',0,0,'L');
	$this->Ln(4);
	
	$this->Cell(150);
    $this->Cell(90,10,'Katy, TX 77494',0,0,'L');
	$this->Ln(4);
	
	$this->Cell(150);
    $this->Cell(90,10,'(866)-230-7730',0,0,'L');
	$this->Ln(10);
	
	//$this->Cell(150);
    //$this->Cell(90,10,'(401)-782-0777',0,0,'L');
	//$this->Ln(10);
	
	$this->Cell(112);
    $this->Cell(90,10,$this->Write(15,'E-mail: info@mychocolatehearts.com','mailto:info@mychocolatehearts.com'),0,0,'R');
	$this->Ln(7);
	
	$this->Cell(106);
    $this->Cell(90,10,$this->Write(15,'Web: http://www.mychocolatehearts.com','http://www.mychocolatehearts.com'),0,0,'R');
    //Line break
    $this->Ln(20);
	
	$this->SetFont('Arial','I',12);
	$this->Line(10,65,40,65);
    $this->Cell(90,10,'Invoice',0,0,'C');
	$this->Line(70,65,200,65);
	$this->Ln(20);
}

//Page footer
function Footer()
{
    //Position at 1.5 cm from bottom
    $this->SetY(-20);
    //Arial italic 8
    $this->SetFont('Arial','',8);
    //Page number
	$this->Cell(0,8, 'Thank you for your valued business.', 0,1,'C');
    $this->Cell(0,8,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}

//Colored table
function FancyTable($table_header, $data)
{
    //Colors, line width and bold font
    $this->SetFillColor(162,192,193);
    $this->SetTextColor(0);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.2);
    $this->SetFont('','B');
    //Header
    $w = array(20, 160);
    for($i=0;$i<count($table_header);$i++)
        $this->Cell($w[$i],7,$table_header[$i],1,0,'C',true);
    $this->Ln();
    //Color and font restoration
    $this->SetFillColor(236,255,234);
    $this->SetTextColor(0);
    $this->SetFont('');
    //Data
    $fill=false;
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[1],'LR',0,'C',$fill);
        $this->Cell($w[1],6,$row[0],'LR',0,'L',$fill);
        $this->Ln();
        $fill=!$fill;
    }
	
    $this->Cell(array_sum($w),0,'','T');
}

function LoadData($file)
{
    //Read file lines
    $lines=file($file);
    $data=array();
    foreach($lines as $line)
        $data[]=explode(';',chop($line));
    return $data;
}

}

$id = $_GET['id'];
$order = Order::getOrderByID($id);
$order_id = Order::getOrderID($id);
$user = ORM::factory('user')->where('id', $order->user_id)->find();
$shipping = ORM::factory('user_shipping_info')->where('user_id', $user->id)->find();
$billing = ORM::factory('user_billing_info')->where('user_id', $user->id)->find();
$order_products = Basket::getBasketContentForOrder($id);
$order_statuses = Order::getOrderStatusByID($id);

				
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

//$userid = $order->user_id;
//$shipping = ORM::factory('user_shipping_info')->where('user_id', $userid)->find();
//$billing = ORM::factory('user_billing_info')->where('user_id', $userid)->find();



$pdf->Cell(80,8, 'DELIVER TO:' ,0,1);
$pdf->Cell(80,8, $shipping->firstname .' '.$shipping->lastname ,0,1);
$pdf->Cell(80,8, $shipping->address1 ,0,1);
if ($shipping->address2) $pdf->Cell(80,8, $shipping->address2 ,0,1);
$pdf->Cell(80,8, $shipping->city .' '. $shipping->state .' '. $shipping->zip ,0,1);


$pdf->Ln(20);
if($order_id != '' && $order_id != false): 
$pdf->Cell(60,8, 'Order: MCH'. $order_id ,0,0);
else:
$pdf->Cell(60,8, 'Order Number Not Available' ,0,0);
endif;
$pdf->Cell(60,8, 'Date of order: '. format::format_date($order->date_created) ,0,1);
$pdf->Cell(60,8, 'Requested Delivery Date: '. format::format_date($order->order_delivery_date) ,0,2);

$pdf->Ln(15);

$order_products = Basket::getBasketContentForOrder($id);
$order_subtotal = 0;
$shipping = $order->shipping_total;
//$tax = $order->tax;
$string='';
foreach ($order_products as $product){
	$pr = Product::getProductById($product->product_id);
	$order_subtotal += $product->subtotal;	
	$string .= $pr->name.';'. $product->qty .';'. $pr->price .';'. $product->subtotal ."\r\n";
}

$myFile = '/tmp/file.txt';
$fh = fopen($myFile, 'w');
fwrite($fh, $string);
fclose($fh);
$data = $pdf->LoadData($myFile);
unlink($myFile);

$table_header = array('Quantity', 'Product');
$pdf->FancyTable($table_header, $data);

$pdf->Output();
