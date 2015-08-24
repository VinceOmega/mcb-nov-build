<?php defined('SYSPATH') OR die('No direct access allowed.');

class Shipping_USPS_Driver implements Shipping_Driver{
	
	public $data;
	public $country = array(
					'AF' => 'Afghanistan',
                    'AL' => 'Albania',
                    'DZ' => 'Algeria',
                    'AD' => 'Andorra',
                    'AO' => 'Angola',
                    'AI' => 'Anguilla',
                    'AG' => 'Antigua and Barbuda',
                    'AR' => 'Argentina',
                    'AM' => 'Armenia',
                    'AW' => 'Aruba',
                    'AU' => 'Australia',
                    'AT' => 'Austria',
                    'AZ' => 'Azerbaijan',
                    'BS' => 'Bahamas',
                    'BH' => 'Bahrain',
                    'BD' => 'Bangladesh',
                    'BB' => 'Barbados',
                    'BY' => 'Belarus',
                    'BE' => 'Belgium',
                    'BZ' => 'Belize',
                    'BJ' => 'Benin',
                    'BM' => 'Bermuda',
                    'BT' => 'Bhutan',
                    'BO' => 'Bolivia',
                    'BA' => 'Bosnia-Herzegovina',
                    'BW' => 'Botswana',
                    'BR' => 'Brazil',
                    'VG' => 'British Virgin Islands',
                    'BN' => 'Brunei Darussalam',
                    'BG' => 'Bulgaria',
                    'BF' => 'Burkina Faso',
                    'MM' => 'Burma',
                    'BI' => 'Burundi',
                    'KH' => 'Cambodia',
                    'CM' => 'Cameroon',
                    'CA' => 'Canada',
                    'CV' => 'Cape Verde',
                    'KY' => 'Cayman Islands',
                    'CF' => 'Central African Republic',
                    'TD' => 'Chad',
                    'CL' => 'Chile',
                    'CN' => 'China',
                    'CX' => 'Christmas Island (Australia)',
                    'CC' => 'Cocos Island (Australia)',
                    'CO' => 'Colombia',
                    'KM' => 'Comoros',
                    'CG' => 'Congo (Brazzaville),Republic of the',
                    'ZR' => 'Congo, Democratic Republic of the',
                    'CK' => 'Cook Islands (New Zealand)',
                    'CR' => 'Costa Rica',
                    'CI' => 'Cote d\'Ivoire (Ivory Coast)',
                    'HR' => 'Croatia',
                    'CU' => 'Cuba',
                    'CY' => 'Cyprus',
                    'CZ' => 'Czech Republic',
                    'DK' => 'Denmark',
                    'DJ' => 'Djibouti',
                    'DM' => 'Dominica',
                    'DO' => 'Dominican Republic',
                    'TP' => 'East Timor (Indonesia)',
                    'EC' => 'Ecuador',
                    'EG' => 'Egypt',
                    'SV' => 'El Salvador',
                    'GQ' => 'Equatorial Guinea',
                    'ER' => 'Eritrea',
                    'EE' => 'Estonia',
                    'ET' => 'Ethiopia',
                    'FK' => 'Falkland Islands',
                    'FO' => 'Faroe Islands',
                    'FJ' => 'Fiji',
                    'FI' => 'Finland',
                    'FR' => 'France',
                    'GF' => 'French Guiana',
                    'PF' => 'French Polynesia',
                    'GA' => 'Gabon',
                    'GM' => 'Gambia',
                    'GE' => 'Georgia, Republic of',
                    'DE' => 'Germany',
                    'GH' => 'Ghana',
                    'GI' => 'Gibraltar',
                    'GB' => 'Great Britain and Northern Ireland',
                    'GR' => 'Greece',
                    'GL' => 'Greenland',
                    'GD' => 'Grenada',
                    'GP' => 'Guadeloupe',
                    'GT' => 'Guatemala',
                    'GN' => 'Guinea',
                    'GW' => 'Guinea-Bissau',
                    'GY' => 'Guyana',
                    'HT' => 'Haiti',
                    'HN' => 'Honduras',
                    'HK' => 'Hong Kong',
                    'HU' => 'Hungary',
                    'IS' => 'Iceland',
                    'IN' => 'India',
                    'ID' => 'Indonesia',
                    'IR' => 'Iran',
                    'IQ' => 'Iraq',
                    'IE' => 'Ireland',
                    'IL' => 'Israel',
                    'IT' => 'Italy',
                    'JM' => 'Jamaica',
                    'JP' => 'Japan',
                    'JO' => 'Jordan',
                    'KZ' => 'Kazakhstan',
                    'KE' => 'Kenya',
                    'KI' => 'Kiribati',
                    'KW' => 'Kuwait',
                    'KG' => 'Kyrgyzstan',
                    'LA' => 'Laos',
                    'LV' => 'Latvia',
                    'LB' => 'Lebanon',
                    'LS' => 'Lesotho',
                    'LR' => 'Liberia',
                    'LY' => 'Libya',
                    'LI' => 'Liechtenstein',
                    'LT' => 'Lithuania',
                    'LU' => 'Luxembourg',
                    'MO' => 'Macao',
                    'MK' => 'Macedonia, Republic of',
                    'MG' => 'Madagascar',
                    'MW' => 'Malawi',
                    'MY' => 'Malaysia',
                    'MV' => 'Maldives',
                    'ML' => 'Mali',
                    'MT' => 'Malta',
                    'MQ' => 'Martinique',
                    'MR' => 'Mauritania',
                    'MU' => 'Mauritius',
                    'YT' => 'Mayotte (France)',
                    'MX' => 'Mexico',
                    'MD' => 'Moldova',
                    'MC' => 'Monaco (France)',
                    'MN' => 'Mongolia',
                    'MS' => 'Montserrat',
                    'MA' => 'Morocco',
                    'MZ' => 'Mozambique',
                    'NA' => 'Namibia',
                    'NR' => 'Nauru',
                    'NP' => 'Nepal',
                    'NL' => 'Netherlands',
                    'AN' => 'Netherlands Antilles',
                    'NC' => 'New Caledonia',
                    'NZ' => 'New Zealand',
                    'NI' => 'Nicaragua',
                    'NE' => 'Niger',
                    'NG' => 'Nigeria',
                    'KP' => 'North Korea (Korea, Democratic People\'s Republic of)',
                    'NO' => 'Norway',
                    'OM' => 'Oman',
                    'PK' => 'Pakistan',
                    'PA' => 'Panama',
                    'PG' => 'Papua New Guinea',
                    'PY' => 'Paraguay',
                    'PE' => 'Peru',
                    'PH' => 'Philippines',
                    'PN' => 'Pitcairn Island',
                    'PL' => 'Poland',
                    'PT' => 'Portugal',
                    'QA' => 'Qatar',
                    'RE' => 'Reunion',
                    'RO' => 'Romania',
                    'RU' => 'Russia',
                    'RW' => 'Rwanda',
                    'SH' => 'Saint Helena',
                    'KN' => 'Saint Kitts (St. Christopher and Nevis)',
                    'LC' => 'Saint Lucia',
                    'PM' => 'Saint Pierre and Miquelon',
                    'VC' => 'Saint Vincent and the Grenadines',
                    'SM' => 'San Marino',
                    'ST' => 'Sao Tome and Principe',
                    'SA' => 'Saudi Arabia',
                    'SN' => 'Senegal',
                    'YU' => 'Serbia-Montenegro',
                    'SC' => 'Seychelles',
                    'SL' => 'Sierra Leone',
                    'SG' => 'Singapore',
                    'SK' => 'Slovak Republic',
                    'SI' => 'Slovenia',
                    'SB' => 'Solomon Islands',
                    'SO' => 'Somalia',
                    'ZA' => 'South Africa',
                    'GS' => 'South Georgia (Falkland Islands)',
                    'KR' => 'South Korea (Korea, Republic of)',
                    'ES' => 'Spain',
                    'LK' => 'Sri Lanka',
                    'SD' => 'Sudan',
                    'SR' => 'Suriname',
                    'SZ' => 'Swaziland',
                    'SE' => 'Sweden',
                    'CH' => 'Switzerland',
                    'SY' => 'Syrian Arab Republic',
                    'TW' => 'Taiwan',
                    'TJ' => 'Tajikistan',
                    'TZ' => 'Tanzania',
                    'TH' => 'Thailand',
                    'TG' => 'Togo',
                    'TK' => 'Tokelau (Union) Group (Western Samoa)',
                    'TO' => 'Tonga',
                    'TT' => 'Trinidad and Tobago',
                    'TN' => 'Tunisia',
                    'TR' => 'Turkey',
                    'TM' => 'Turkmenistan',
                    'TC' => 'Turks and Caicos Islands',
                    'TV' => 'Tuvalu',
                    'UG' => 'Uganda',
                    'UA' => 'Ukraine',
                    'AE' => 'United Arab Emirates',
                    'UY' => 'Uruguay',
                    'UZ' => 'Uzbekistan',
                    'VU' => 'Vanuatu',
                    'VA' => 'Vatican City',
                    'VE' => 'Venezuela',
                    'VN' => 'Vietnam',
                    'WF' => 'Wallis and Futuna Islands',
                    'WS' => 'Western Samoa',
                    'YE' => 'Yemen',
                    'ZM' => 'Zambia',
                    'ZW' => 'Zimbabwe'
				);
				
	function __construct(){
	
		$this->data = new stdClass();
		
		$this->UserId = '319POLAR5711'; // Username
		$this->Password = ''; // Password
		
		$this->from_postal_code = '03051'; // Zipcode you are shipping FROM
		$this->from_country = 'US';
	}
	
	public function usps() {
		
		$quote_data = array();
		//$weight = $this->weight->convert($this->cart->getWeight(), $this->config->get('config_weight_class'), $this->config->get('usps_weight_class'));
		$weight = $this->data->weight;
		$weight = ($weight < 0.1 ? 0.1 : $weight);
		
		$pounds = floor($weight);
		$ounces = round(16 * ($weight - floor($weight)));
		
		if ($this->data->to_country == 'US') { 
			$xml  = '<RateV$Request USERID="' . $this->UserId . '" PASSWORD="' . $this->Password . '">';
			$xml .= '	<Package ID="1">';
			$xml .=	'		<Service>ALL</Service>';
			$xml .=	'		<ZipOrigination>' . $this->from_postal_code . '</ZipOrigination>';
			$xml .=	'		<ZipDestination>' . $this->data->to_zip . '</ZipDestination>';
			$xml .=	'		<Pounds>' . $pounds . '</Pounds>';
			$xml .=	'		<Ounces>' . $ounces . '</Ounces>';							
			$xml .=	'	<Container></Container>';
			$xml .=	'	<Size>Regular</Size>';
			
			$xml .=	'		<Machinable>True</Machinable>';
			$xml .=	'	</Package>';
			$xml .= '</RateV3Request>';
	
			$request = 'API=RateV4&XML=' . urlencode($xml);
		} else {				
			
			$xml  = '<IntlRateRequest USERID="' . $this->UserId . '" PASSWORD="' . $this->Password . '">';
			$xml .=	'	<Package ID="0">';
			$xml .=	'		<Pounds>' . $pounds . '</Pounds>';
			$xml .=	'		<Ounces>' . $ounces . '</Ounces>';
			$xml .=	'		<MailType>Package</MailType>';
			$xml .=	'		<Country>' . $this->country[$this->data->to_country] . '</Country>';
			$xml .=	'	</Package>';
			$xml .=	'</IntlRateRequest>';

			$request = 'API=IntlRate&XML=' . urlencode($xml);
		}	
		
		
		

		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, 'production.shippingapis.com/ShippingAPI.dll?' . $request);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$result = curl_exec($ch);
		
		curl_close($ch);  
		
		

		if ($result) {
			$dom = new DOMDocument('1.0', 'UTF-8');
			$dom->loadXml($result);	
			
			$rate_v3_response = $dom->getElementsByTagName('RateV3Response')->item(0);
			$intl_rate_response = $dom->getElementsByTagName('IntlRateResponse')->item(0);
			$error = $dom->getElementsByTagName('Error')->item(0);
			
			if ($rate_v3_response || $intl_rate_response) {
				if ($this->data->to_country == 'US') { 
					$allowed = array(0, 1, 2, 3, 4, 5, 6, 7, 12, 13, 16, 17, 18, 19, 22, 23, 25, 27, 28);
					
					$package = $rate_v3_response->getElementsByTagName('Package')->item(0);
					
					$postages = $package->getElementsByTagName('Postage');
					
					foreach ($postages as $postage) {
						$classid = $postage->getAttribute('CLASSID');
						
						if (in_array($classid, $allowed)) {
							$title = $postage->getElementsByTagName('MailService')->item(0)->nodeValue;
															
							
							$cost = $postage->getElementsByTagName('Rate')->item(0)->nodeValue;
							
							$quote_data[$classid] = array(
								'id'           => 'usps.' . $classid,
								'title'        => $title,
								'cost'         => $cost

								
							);							
						}
					} 
				} else {
					$allowed = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 21);
					
					$package = $intl_rate_response->getElementsByTagName('Package')->item(0);
					
					$services = $package->getElementsByTagName('Service');
					
					foreach ($services as $service) {
						$id = $service->getAttribute('ID');
						
						if (in_array($id, $allowed)) {
							$title = $service->getElementsByTagName('SvcDescription')->item(0)->nodeValue;
							
							/*
							if (usps_display_time) {	  
								$title .= ' (' . $service->getElementsByTagName('SvcCommitments')->item(0)->nodeValue . ')';
							}
							*/
							
							$cost = $service->getElementsByTagName('Postage')->item(0)->nodeValue;
							
							$quote_data[$id] = array(
								'id'           => 'usps.' . $id,
								'title'        => $title,
								'cost'         => $cost
							
							);							
						}
					}
				}
			} elseif ($error) {
				exit('error');				
			}
			
			print_r($quote_data);
		}
	}
	
	public function getTrackingUrl($track_number){
	
	}


	public function setData($data){
		$this->data = $data;
	}
	
	public function getRates(){

	}
	
	function getRate($method){
	
	}

	
}
?>