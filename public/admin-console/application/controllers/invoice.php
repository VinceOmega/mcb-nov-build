<?php

require(DOCROOT. 'application/helpers/PDF_generation/fpdf.php');

$mch_header = array(
	'logo'	=> 'media/images/logo.gif',
	'email'	=> 'info@mychocolatehearts.com',
	'url'	=> 'www.mychocolatehearts.com'
);
$mcc_header = array(
	'logo'	=> 'media/images/logo_mcc.png',
	'email'	=> 'info@mychocolatecoins.com',
	'url'	=> 'www.mychocolatecoins.com'
);

$id = $_GET['id'];
$_order = ORM::factory('order',$id);

if ($_order->site_id == 1)
{
	define('_conf_logo', 'media/images/logo.gif');
	define('_conf_email', 'info@mychocolatehearts.com');
	define('_conf_url', 'www.mychocolatehearts.com');
}
else
{
	define('_conf_logo', 'media/images/logo_mcc.png');
	define('_conf_email', 'info@mychocolatecoins.com');
	define('_conf_url', 'www.mychocolatecoins.com');
}

class PDF extends FPDF
{
//Page header
function Header()
{
	$this->SetDisplayMode('real');
    //Logo
    $this->Image(DOCROOT. _conf_logo,10,8,60);
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
    $this->Cell(90,10,$this->Write(15,'E-mail: '._conf_email,'mailto:'._conf_email),0,0,'R');
	$this->Ln(7);
	
	$this->Cell(106);
    $this->Cell(90,10,$this->Write(15,'Web: http://'._conf_url,'http://'._conf_url),0,0,'R');
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
function FancyTable($table_header, $data, $order_subtotal, $shipping, $total)
{
    //Colors, line width and bold font
    $this->SetFillColor(162,192,193);
    $this->SetTextColor(0);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.2);
    $this->SetFont('','B');
    //Header
    $w = array(110, 20, 30, 30);
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
        $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
        $this->Cell($w[1],6,$row[1],'LR',0,'C',$fill);
        $this->Cell($w[2],6, '$'. number_format($row[2],2),'LR',0,'R',$fill);
        $this->Cell($w[3],6, '$'. number_format($row[3],2),'LR',0,'R',$fill);
        $this->Ln();
        $fill=!$fill;
    }
	$fw = array(160, 30);
	$this->Cell($fw[0],6, 'Order subtotal' ,1,0,'R');
	$this->Cell($fw[1],6, '$'. number_format($order_subtotal, 2) ,1,1,'R');
	$this->Cell($fw[0],6, 'Shipping' ,1,0,'R');
	$this->Cell($fw[1],6, '$'. number_format($shipping, 2) ,1,1,'R');
	if (($discount = $order_subtotal + $shipping - $total) > 0){
		$this->Cell($fw[0],6, 'Discount' ,1,0,'R');
		$this->Cell($fw[1],6, '$'. number_format($discount, 2) ,1,1,'R');
	}
	$this->Cell($fw[0],6, 'Total' ,1,0,'R');
	$this->Cell($fw[1],6, '$'. number_format($total, 2) ,1,1,'R');
	
	//$this->Cell(array_sum($w),6, $order_subtotal ,1,1,'R',$fill);
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

$order = Order::getOrderByID($id);


$order_id = Order::getOrderID($id);
//$order = Order::getOrderByID($id);
$user = ORM::factory('user')->where('id', $order->user_id)->find();
$shipping = ORM::factory('user_shipping_info')->where('user_id', $user->id)->find();
$billing = ORM::factory('user_billing_info')->where('user_id', $user->id)->find();
$order_products = Basket::getBasketContentForOrder($id);
$order_statuses = Order::getOrderStatusByID($id);



				
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);


$pdf->Cell(80,8, 'SOLD TO:' ,0,0);
$pdf->Cell(80,8, 'DELIVER TO:' ,0,1);

$pdf->Cell(80,8, $billing->firstname .' '.$billing->lastname ,0,0);
$pdf->Cell(80,8, $shipping->firstname .' '.$shipping->lastname ,0,1);

$pdf->Cell(80,8, $billing->address1 ,0,0);
$pdf->Cell(80,8, $shipping->address1 ,0,1);

$pdf->Cell(80,8, $billing->address2 ,0,0);
$pdf->Cell(80,8, $shipping->address2 ,0,1);

$pdf->Cell(80,8, $billing->city .' '. $billing->state .' '. $billing->zip ,0,0);
$pdf->Cell(80,8, $shipping->city .' '. $shipping->state .' '. $shipping->zip ,0,1);

$pdf->Cell(80,8, $billing->country,0,0);
$pdf->Cell(80,8, $shipping->country,0,1);

$pdf->Cell(80,8, $billing->company,0,0);
$pdf->Cell(80,8, $shipping->company,0,1);

$pdf->Ln(20);
if($order_id != '' && $order_id != false): 
$pdf->Cell(60,8, 'Order: '. $_order->getOrderId() ,0,0);
else:
$pdf->Cell(60,8, 'Order Number Not Available' ,0,0);
endif;
$pdf->Cell(60,8, 'Date of order: '. format::format_date($order->date_created) ,0,1);
$pdf->Cell(60,8, 'Requested Delivery Date: '. format::format_date($order->order_delivery_date) ,0,2);

switch ( $order->payment_method ){
	case 'Credit Card': $order->payment_method = 'Credit Card';
				break;
	case 'Paypal': $order->payment_method = 'Paypal';
				break;						
}

switch ( $order->shipping_method_id ){
	case 1: $order->shipping_method = 'USPS Ground (3-6 Business Days)';
				break;
	case 2: $order->shipping_method = 'USPS 2 day shipping';
				break;	
	case 3: $order->shipping_method = 'USPS Overnight';
				break;	
}
				
						
$pdf->Cell(60,8, 'Payment Method: '. $order->payment_method ,0,1);
$pdf->Cell(60,8, 'Shipping Method: '. $order->shipping_method ,0,1);
//$pdf->Cell(60,8, 'Discounts: '. $order->discounts ,0,1);
//$pdf->MultiCell(180,8, 'Discounts: '. $order->discounts ,0,'L',false);

if ( $order->comment ) {
	//$pdf->Cell(60,8, 'Comment: '. $order->comment ,0,0);
	$comment = str_replace(',', ",\n", $order->comment);
	$pdf->MultiCell(180,8, 'Comment: '. $comment ,0,'L',false);
}

$pdf->Ln(15);

$order_products = Basket::getBasketContentForOrder($id);
$order_subtotal = 0;
$shipping = $order->shipping_total;
$total = $order->order_total;
$string='';
foreach ($order_products as $product){
	$pr = Product::getProductById($product->product_id);
	$order_subtotal += $product->subtotal;
	$basket = ORM::factory('orders_basket',$product->id);
	
	$string .= $pr->name.';'. $product->qty .';'. ($basket->rate?$basket->rate:$basket->packaging_rate) .';'. $product->subtotal ."\r\n";
}

$myFile = '/tmp/file.txt';
$fh = fopen($myFile, 'w');
fwrite($fh, $string);
fclose($fh);

$data = $pdf->LoadData($myFile);
unlink($myFile);

$table_header = array('Product','Quantity','Unit Price','Total');
$pdf->FancyTable($table_header, $data, $order_subtotal, $shipping, $total);

$pdf->Output();
