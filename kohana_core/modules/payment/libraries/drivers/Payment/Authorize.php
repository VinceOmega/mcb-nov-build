<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Authorize.net Payment Driver
 *
 * $Id: Authorize.php 4160 2009-04-07 21:03:16Z ixmatus $
 *
 * @package    Payment
 * @author     Kohana Team
 * @copyright  (c) 2007-2008 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
class Payment_Authorize_Driver implements Payment_Driver
{
	// Array containing any response codes set from the gateway
	private $response        = Null;
	
	//transaction result
	private $transaction     = False;

	// Fields required to do a transaction
	private $required_fields = array
	(
		'x_login'           => FALSE,
		'x_version'         => TRUE,
		'x_delim_char'      => TRUE,
		'x_url'             => TRUE,
		'x_type'            => TRUE,
		'x_method'          => TRUE,
		'x_tran_key'        => FALSE,
		'x_relay_response'  => TRUE,
		'x_card_num'        => FALSE,
		'x_exp_date'        => FALSE,
		'x_card_code'        => FALSE,
		'x_amount'          => FALSE,
	);

	// Default required values
	private $authnet_values = array
	(
		'x_version'         => '3.1',
		'x_delim_char'      => '|',
		'x_delim_data'      => 'TRUE',
		'x_url'             => 'FALSE',
		'x_type'            => 'AUTH_CAPTURE',
		'x_method'          => 'CC',
		'x_relay_response'  => 'FALSE',
	);

	private $test_mode = TRUE;
	private $curl_config;
	
	private $lastResult = '';

	/**
	 * Sets the config for the class.
	 *
	 * @param  array  config passed from the library
	 */
	public function __construct($config)
	{
		$this->authnet_values['x_login']    = $config['auth_net_login_id'];
		$this->authnet_values['x_tran_key'] = $config['auth_net_tran_key'];
		
		$this->required_fields['x_login']   = !empty($config['auth_net_login_id']);
		$this->required_fields['x_tran_key']= !empty($config['auth_net_tran_key']);
		
		$this->authnet_values['x_md5_hash']    = $config['md5_hash'];
		$this->required_fields['x_md5_hash']   = !empty($config['md5_hash']);


		$this->curl_config  = $config['curl_config'];
		$this->test_mode    = $config['test_mode'];

		Kohana::log('debug', 'Authorize.net Payment Driver Initialized');
	}

	public function set_fields($fields)
	{
		foreach ((array) $fields as $key => $value)
		{
			$this->authnet_values['x_'.$key] = $value;
			if (array_key_exists('x_'.$key, $this->required_fields) and !empty($value)) $this->required_fields['x_'.$key] = TRUE;
		}
	}
	
	private function getResultResponseFull(){
        $response = array("", "Approved", "Declined", "Error");
        return $response[$this->response[0]];
    }
	
    public function get_response(){
        return $this->response[3]; //ResponseText
    }

    public function get_transaction_id(){
        return $this->response[6];
    }

	/**
	 * Process a given transaction.
	 *
	 * @return boolean
	 */
	public function process()
	{
		// Check for required fields
		if (in_array(FALSE, $this->required_fields))
		{
			$fields = array();
			foreach ($this->required_fields as $key => $field)
			{
				if (!$field) $fields[] = $key;
			}
			throw new Kohana_Exception('payment.required', implode(', ', $fields));
		}

		$fields = '';
		foreach ( $this->authnet_values as $key => $value )
		{
			$fields .= $key.'='.urlencode($value).'&';
		}
		$post_url = ($this->test_mode) ?
					'https://test.authorize.net/gateway/transact.dll' :
					'https://secure.authorize.net/gateway/transact.dll'; // Live URL


		//'https://certification.authorize.net/gateway/transact.dll' : // Test mode URL

		Kohana::log('error', '--------------------');
		Kohana::log('error', 'payment to:'.$post_url);
		Kohana::log('error', '->      parameters:'.$fields);
		Kohana::log('error', '--------------------');
		$ch = curl_init($post_url);
		curl_setopt_array($ch, $this->curl_config); // Set custom curl options
		curl_setopt($ch, CURLOPT_POSTFIELDS, rtrim($fields, '& ')); // Set the curl POST fields
		$response = curl_exec($ch); //execute post and get results
		curl_close($ch);
		
		if (!$response)
			throw new Kohana_Exception('payment.gateway_connection_error');
			
		/*
		if(empty(trim($response)))
			throw new Kohana_Exception('payment.gateway_connection_error');
			*/
			
		$this->response = explode("|", $response);
	
		if ($this->getResultResponseFull() == "Approved"){
			return TRUE;
		}elseif ($this->getResultResponseFull() == "Declined"){
			return FALSE;
		}
	}
	
	public function getLastError(){
		return $this->get_response();
		//return $this->getResultResponseFull();
	}
} // End Payment_Authorize_Driver Class