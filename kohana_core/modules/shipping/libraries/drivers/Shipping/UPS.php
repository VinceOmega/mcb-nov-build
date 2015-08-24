<?php defined('SYSPATH') OR die('No direct access allowed.');

class Shipping_UPS_Driver implements Shipping_Driver{
	
	public $package;
	
	function __construct(){
	
		$this->package = new stdClass();
		/*
		$this->AccessLicenseNumber = '5C04E073EE1F35F8'; // Your license number
		$this->UserId = 'polardesignups'; // Username
		$this->Password = 'Gimweb951'; // Password
		*/
		$this->AccessLicenseNumber = '9C700AF4C43389F8'; // Your license number
		$this->UserId = 'paulbrandies'; // Username
		$this->Password = 'Brookline'; // Password
		
		$this->from_postal_code = '02892'; // Zipcode you are shipping FROM
		$this->from_country = 'US';
	}
		
	
	//This script was written by Mark Sanborn at http://code.google.com/p/ups-php/
	private function ups($service) {
	
		$this->config['unit_dimension'] = 'IN';
		$this->config['unit_weight'] = 'LBS';
			
		$data = '<?xml version="1.0"?>
		<AccessRequest xml:lang="en-US">
			<AccessLicenseNumber>'.$this->AccessLicenseNumber.'</AccessLicenseNumber>
			<UserId>'.$this->UserId.'</UserId>
			<Password>'.$this->Password.'</Password>
		</AccessRequest>
		<?xml version="1.0"?>
		<RatingServiceSelectionRequest xml:lang="en-US">
			<Request>
				<TransactionReference>
					<CustomerContext>Bare Bones Rate Request</CustomerContext>
					<XpciVersion>1.0001</XpciVersion>
				</TransactionReference>
				<RequestAction>Rate</RequestAction>
				<RequestOption>Rate</RequestOption>
			</Request>
		<PickupType>
			<Code>01</Code>
		</PickupType>
		<Shipment>
			<Shipper>
				<Address>
					<PostalCode>'.$this->from_postal_code.'</PostalCode>
					<CountryCode>'.$this->from_country.'</CountryCode>
				</Address>
			</Shipper>
			<ShipTo>
				<Address>
					<PostalCode>'.$this->package->to_zip.'</PostalCode>
					<CountryCode>'.$this->package->to_country.'</CountryCode>
				<ResidentialAddressIndicator/>
				</Address>
			</ShipTo>
			<ShipFrom>
				<Address>
					<PostalCode>'.$this->from_postal_code.'</PostalCode>
					<CountryCode>'.$this->from_country.'</CountryCode>
				</Address>
			</ShipFrom>
			<Service>
				<Code>'.$service.'</Code>
			</Service>
			<Package>
				<PackagingType>
					<Code>02</Code>
				</PackagingType>
				<PackageWeight>
					<UnitOfMeasurement>
						<Code>'.$this->config['unit_weight'].'</Code>
					</UnitOfMeasurement>
					<Weight>'.$this->package->weight.'</Weight>
				</PackageWeight>
			</Package>
		</Shipment>
		</RatingServiceSelectionRequest>';	
			
		//$ch = curl_init("https://www.ups.com/ups.app/xml/Rate");
		$ch = curl_init("https://onlinetools.ups.com/ups.app/xml/Rate");
		
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_TIMEOUT, 30);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
		
		$result=curl_exec ($ch);
		$result = strstr($result, '<?');
		curl_close($ch);
		
		//echo "<!--\n"; echo $data."\n\n"; var_dump($result); echo '-->';
		
		//opencart UPS Code
		if ($result) {
			$dom = new DOMDocument('1.0', 'UTF-8');
			$dom->loadXml($result);	
			
			$error_msg = '';
			$rating_service_selection_response = $dom->getElementsByTagName('RatingServiceSelectionResponse')->item(0);
			$response = $rating_service_selection_response->getElementsByTagName('Response')->item(0);
			$response_status_code = $response->getElementsByTagName('ResponseStatusCode');
			
			if ($response_status_code->item(0)->nodeValue != '1') { //if the request was not successful
				$error = $response->getElementsByTagName('Error')->item(0);
				$error_msg .= $error->getElementsByTagName('ErrorCode')->item(0)->nodeValue;
				$error_msg .= ': ' . $error->getElementsByTagName('ErrorDescription')->item(0)->nodeValue;
				return $error_msg;
			
			}else{
				$rated_shipments = $rating_service_selection_response->getElementsByTagName('RatedShipment');
				foreach ($rated_shipments as $rated_shipment) {
					$service = $rated_shipment->getElementsByTagName('Service')->item(0);
					$code = $service->getElementsByTagName('Code')->item(0)->nodeValue;
					
					$total_charges = $rated_shipment->getElementsByTagName('TotalCharges')->item(0);
					$cost = $total_charges->getElementsByTagName('MonetaryValue')->item(0)->nodeValue;	
					
					if (!($code && $cost)) {
						continue;
					}
	
					return $cost;
				}
			}
		}
    }
	
	public function setData($package){
		$this->package = $package;
	}
	
	public function getRates(){

		$this->package->to_country = (!empty($this->package->to_country))? $this->package->to_country : 'US';

		if($this->package->to_country == 'US'){
			$services = array( '01'=>'Next Day Air', '12'=>'Three-Day Select', '03'=>'Ground');
		}else{
			$services = array( '07'=>'Worldwide Express', '08'=>'Worldwide Expedited');
		}
		
		if($this->package->weight <= 0)
			return 0;
		
		if(empty($this->package->to_zip) OR empty($this->package->to_country))
			throw new Kohana_Exception('ups: shipping package missing', '', get_class($this));

		foreach ($services as $service=>$name) {
		  $rate = $this->ups($service);
		  
		  if($rate != '') {		
			$id = strtolower(str_replace(" ","_", 'ups '.$service .' '. $name));
			$r[$id]['name'] = 'UPS ' . $name;
			$r[$id]['amount'] = $rate;			
		  }
		}	
		return $r;
	}
	
	function getRate($method){
	
		$service = explode("_", $method); //sample input: tnt_15D_express_priority or ups_01_Next_Day_Air
		$this->package->method_id = $service[1];
		
		$this->package->to_country = (!empty($this->package->to_country))? $this->package->to_country : 'US';
		 
		if($this->package->weight <= 0)
			return 0;
			
		if(empty($this->package->to_zip) OR empty($this->package->to_country) OR empty($this->package->method_id))
			throw new Kohana_Exception('ups: shipping data missing', '', get_class($this));

		$rate = $this->ups($this->package->method_id);

		if($rate != '') {		
			return $rate;			
		}else{
			return -1;
		}
	}
	
	public function getTrackingUrl($track_number){
		$url = 'http://wwwapps.ups.com/WebTracking/processInputRequest?sort_by=status&tracknums_displayed=1&TypeOfInquiryNumber=T&loc=en_US&InquiryNumber1='.$track_number.'&track.x=0&track.y=0';
        return $url;
	}
}
	
?>
