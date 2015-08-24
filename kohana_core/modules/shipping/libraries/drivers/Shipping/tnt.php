<?php 
class TNTShipping  {
 
	public $package;
	
	function __construct(){
	
		$this->package = new stdClass();
		
		$this->company = 'cioshiper'; // Your license number
		$this->password = 'qwer6789'; // Username
		$this->accountID = '276048'; // Password
		
		$this->postal_code = '02145'; // Zipcode you are shipping FROM
	}
 
	public function setData($package){
		$this->package = $package;
	}
	
	public function pickupNotification(){
		
		if(date("H") >= 15)
			$shipDate = date("d/m/Y", mktime(0, 0, 0, date("m"),   date("d")+1,   date("Y"))); //next day pickup
		else
			$shipDate = date("d/m/Y"); //same day

		$Xml = '<ESHIPPER>
			<LOGIN>
				<COMPANY>'.$this->company.'</COMPANY>
				<PASSWORD>'.$this->password.'</PASSWORD>
				<APPID>IN</APPID>
				<APPVERSION>2.1</APPVERSION>
			</LOGIN>
			<CONSIGNMENTBATCH>
				<SENDER>
					<COMPANYNAME>CIO</COMPANYNAME>
					<STREETADDRESS1>492 Old Connecticut Path</STREETADDRESS1>
					<STREETADDRESS2></STREETADDRESS2>
					<STREETADDRESS3></STREETADDRESS3>
					<CITY>Framingham</CITY>
					<PROVINCE>MA</PROVINCE>
					<POSTCODE>01701</POSTCODE>
					<COUNTRY>US</COUNTRY>
					<ACCOUNT>000276048</ACCOUNT>
					<VAT>GB78687</VAT>
					<CONTACTNAME>Deb Stark</CONTACTNAME>
					<CONTACTDIALCODE>1</CONTACTDIALCODE>
					<CONTACTTELEPHONE>5089354068</CONTACTTELEPHONE>
					<CONTACTEMAIL>dstark@cio.com</CONTACTEMAIL>
					<COLLECTION>
						<SHIPDATE>'.$shipDate.'</SHIPDATE>
						<PREFCOLLECTTIME>
							<FROM>1300</FROM>
							<TO>1500</TO>
						</PREFCOLLECTTIME>
						<ALTCOLLECTTIME>
							<FROM>1500</FROM>
							<TO>1700</TO>
						</ALTCOLLECTTIME>
						<COLLINSTRUCTIONS>Enter through visitors entrance at the intersection of Speen St and 492 Old Connecticut Path. Sign states "Framingham Corporate Center" and "IDG Enterprise" .  Drive in under the canopy and go in the main door. Packages will be left outside the mailroom, first office on the left.</COLLINSTRUCTIONS>
					</COLLECTION>
				</SENDER>
				<CONSIGNMENT>
					<CONREF>ref 1</CONREF>
					<DETAILS>
						<RECEIVER>
							<COMPANYNAME>'.$this->package->shipping->company.'</COMPANYNAME>
							<STREETADDRESS1>'.$this->package->shipping->address1.'</STREETADDRESS1>
							<STREETADDRESS2></STREETADDRESS2>
							<STREETADDRESS3></STREETADDRESS3>
							<CITY>'.$this->package->shipping->city.'</CITY>
							<PROVINCE>'.$this->package->shipping->state.'</PROVINCE>
							<POSTCODE>'.$this->package->shipping->zip.'</POSTCODE>
							<COUNTRY>'.$this->package->shipping->country.'</COUNTRY>
							<VAT></VAT>
							<CONTACTNAME>'.$this->package->shipping->firstname .' '.$this->package->shipping->lastname.'</CONTACTNAME>
							<CONTACTDIALCODE>1 800</CONTACTDIALCODE>
							<CONTACTTELEPHONE>555555</CONTACTTELEPHONE>
						</RECEIVER>
						<PACKAGE>
							<ITEMS>'.$this->package->items.'</ITEMS>
							<DESCRIPTION>box</DESCRIPTION>
							<LENGTH>'.$this->package->length .'</LENGTH>
							<HEIGHT>'.$this->package->height .'</HEIGHT>
							<WIDTH>'.$this->package->width .'</WIDTH>
							<WEIGHT>'.$this->package->weight.'</WEIGHT>
						</PACKAGE>
					</DETAILS>
				<CONSIGNMENT>
			</CONSIGNMENTBATCH>
		</ESHIPPER>';
		
		$Request = rawurlencode($Xml);
		$CurlURL = 'http://iconnection.tnt.com:81/ShipperGate2.asp';
		$CurlQuery = 'xml_in=' . $Request;
		$ch = curl_init();
		   
		curl_setopt($ch, CURLOPT_URL, $CurlURL);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $CurlQuery);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
		curl_setopt($ch, CURLOPT_HEADER, 0);  // DO NOT RETURN HTTP HEADERS
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // Needs to be included if no *.crt is available to verify SSL certificates
		curl_setopt($ch, CURLOPT_SSLVERSION,3);  
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$result = curl_exec($ch);
		curl_close($ch);
            
		if ($result) {
			return ' - TNT Notification ID: '. $result; //$id = explode(":", $result);
		} else {
			echo ' - TNT Notification ID: Error in response from TNT.';
		}
	}
	
	

    private function tnt(){
			 
		$Xml = '<?xml version="1.0" standalone="no"?>
		<PRICEREQUEST>
			<LOGIN>
				<COMPANY>'.$this->company.'</COMPANY>
				<PASSWORD>'.$this->password.'</PASSWORD>
				<APPID>PC</APPID>
			</LOGIN>
			<packageSETS>
				<COUNTRY>1.0</COUNTRY>
				<CURRENCY>1.0</CURRENCY>
				<POSTCODEMASK>1.0</POSTCODEMASK>
				<TOWNGROUP>1.0</TOWNGROUP>
				<SERVICE>1.0</SERVICE>
				<OPTION>1.0</OPTION>
			</packageSETS>
			<PRICECHECK>
				<RATEID>RATE1</RATEID>
				<ORIGINCOUNTRY>US</ORIGINCOUNTRY>
				<ORIGINTOWNNAME></ORIGINTOWNNAME>
				<ORIGINPOSTCODE>'.$this->postal_code.'</ORIGINPOSTCODE>
				<ORIGINTOWNGROUP></ORIGINTOWNGROUP>
				
				<DESTCOUNTRY>'.$this->package->to_country.'</DESTCOUNTRY>
				<DESTTOWNNAME></DESTTOWNNAME>
				<DESTPOSTCODE>'.$this->package->to_zip.'</DESTPOSTCODE>
				<DESTTOWNGROUP></DESTTOWNGROUP>
				
				<CONTYPE>N</CONTYPE>
				<CURRENCY>USD</CURRENCY>
				<WEIGHT>'.$this->package->weight.'</WEIGHT>
				<VOLUME>'.$this->package->volume.'</VOLUME>
				<ACCOUNT>'.$this->accountID.'</ACCOUNT>
				<ITEMS>'.$this->package->items.'</ITEMS>
			</PRICECHECK>
		</PRICEREQUEST>';
		
		
		$Request = rawurlencode($Xml);
		$CurlURL = 'http://iConnection.tnt.com:81/Pricegate.asp';
		$CurlQuery = 'xml_in=' . $Request;
		$ch = curl_init();
		   
		curl_setopt($ch, CURLOPT_URL, $CurlURL);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $CurlQuery);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
		curl_setopt($ch, CURLOPT_HEADER, 0);  // DO NOT RETURN HTTP HEADERS
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // Needs to be included if no *.crt is available to verify SSL certificates
		curl_setopt($ch, CURLOPT_SSLVERSION,3);  
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$result = curl_exec($ch);
		curl_close($ch);
            
		if ($result) {

			## catch libxml errors
			libxml_use_internal_errors(true);
			$this->package->quote_xml = @simplexml_load_string($result);	

			if ($this->package->quote_xml) {
					return true;					  				
			}else {
				echo 'Error: '. $quote_xml->ERROR->DESCRIPTION;
				return false;
			}
		} else {
			echo 'Error in response from TNT.';
			return false;
		}
    }
	
	public function getRates(){

		$this->package->to_country = (!empty($this->package->to_country))? $this->package->to_country : 'US';
		
		if($this->package->weight <= 0)
			return 0;
			
		if(empty($this->package->length) OR empty($this->package->width) OR empty($this->package->height)
		OR empty($this->package->to_zip) OR empty($this->package->to_country))
			exit('tnt: shipping data missing');
			
		
		$this->package->length = $this->convertInchToMeter($this->package->length);
		$this->package->width  = $this->convertInchToMeter($this->package->width);
		$this->package->height = $this->convertInchToMeter($this->package->height);
		$this->package->weight = $this->convertPoundToKg($this->package->weight);
			
			
		$this->package->volume = $this->package->length * $this->package->width * $this->package->height;


		if($this->tnt()){
			if($this->package->quote_xml->PRICE){
				foreach($this->package->quote_xml->PRICE as $rate){		
						if($rate->RATE > 0){
							if( !$this->isTNTExepction($rate) ){
							
								$id = (string)'tnt '. $rate->SERVICE .' '. $rate->SERVICEDESC.' '.$rate->OPTIONDESC;
								$id = strtolower(str_replace(" ","_", $id));
								$r[$id]['name'] = (string)'TNT '. ucfirst(strtolower($rate->SERVICEDESC.' - '.$rate->OPTIONDESC)); 
								$r[$id]['amount'] = (float)$rate->RATE;
							}
						}
					}
				return $r;
			}else{
				//print_r($this->package->quote_xml);
			
			}
		}	
	}
	
	function isTNTExepction($rate){
	
		$dimensionalWeight = $this->package->volume / 167;
		
		//5 pounds = 2.26796185 kilograms
		if(($dimensionalWeight >= 2.2) || ($this->package->weight >= 2.2)){
			if( (($rate->SERVICEDESC == 'EXPRESS') OR ($rate->SERVICEDESC == 'ECONOMY EXPRESS')) AND $rate->OPTIONDESC == 'NONE'){
				return false;
			}else{
				return true;
			}
		}elseif($rate->SERVICEDESC == 'EXPRESS' AND $rate->OPTIONDESC == 'NONE'){
			return false;
		}else{
			return true;
		}
	}
	
	function getRate($method){
		
		
		/*
		$this->package->to_country = (!empty($this->package->country))? $this->package->country : 'US';
		$this->package->method_id = $method;
			
		if(empty($this->package->length) OR empty($this->package->width) OR empty($this->package->height) OR empty($this->package->weight) 
		OR empty($this->package->to_zip) OR empty($this->package->to_country) OR empty($this->package->method_id))
			exit('tnt: shipping package missing');
			
		$service = ''; //get all rates that apply
		if(isset($method))
			$service = '<SERVICE>'.$this->package->method_id.'</SERVICE>'; //get onyl the rate for this service
			
		if($this->tnt()){
			if($rate->RATE > 0){
				return $rate->RATE;
			}else{
				return -1;
			}
		}
		*/
		
		//return 42;
	}
	
	public function getTrackingUrl($track_number){
	
	}
	
	private function convertInchToMeter($i){
		//1 inch = 0.0254 meters
		return $i * 0.025;
	}
	
	private function convertPoundToKg($i){
		//1 pound = 0.45359237 kilograms
		return $i * 0.453;
	}
	
	
}

?>