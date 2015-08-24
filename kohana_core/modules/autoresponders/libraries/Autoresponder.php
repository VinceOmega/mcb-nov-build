<?php defined('SYSPATH') or die('No direct script access.');
define('MAIL_FROM', My_Template_Controller::getCurrentSite()->email);

class Autoresponder{

	public function log( $eventId, $result ){
		$db=new Database;
		$db->query("INSERT INTO events_log(event_id, result) VALUES('$eventId','$result')");
	}
	
	public function processEvent($event, $data, $to = false, $additional = false){
		if (empty($event->email_body)) return;
		if (!$to) $to = $data->email;		
		// check the condition
		if ($event->condition && $event->condition!=''){
			//$condition = str_replace('=', '==', $event->condition);
			$condition = preg_replace('|%(.*?)%|', '$data->$1', $event->condition);
			$res = false;
			@eval('$res = ('.$condition.');');
			if (!$res) return;
		}
		$message = $event->email_body;
		if (preg_match_all('|%(\w*?)%|', $message, $matches) && $data){
			foreach ($matches[1] as $match){
				$replacement = (isset($data->$match)) ? $data->$match : '';
				if (isset($additional[$match])) $replacement = $additional[$match];
				$message = str_replace('%'.$match.'%', $replacement, $message);
			}
		}
		try{ 
			//mail(to,subject,message,headers,parameters)
			$title = My_Template_Controller::getCurrentSite()->name;
			$email = My_Template_Controller::getCurrentSite()->email;
			
			$headers  = "From: $title <$email> \r\n"; 
			$headers .= "Reply-To: $email \r\n"; 
			$headers .= "Return-Path: $email \r\n"; 
			$headers .= "X-Mailer: Kohana \r\n"; 
			$headers .= 'MIME-Version: 1.0' . " \r\n"; 
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . " \r\n"; 
		
			mail($to, $event->email_title, utf8_decode($message), $headers); 
			$result = serialize($data);
		}catch(Exception $e){
			$result = 'SENDING TO ' . $to . 'FAILED';
			self::log($event->id, $result);
		}
		//self::log($event->id, $result);	
	}
	
	public function sendEmail( $eventName, $to, $data, $additional = false){
		$events = ORM::factory('event')
				->where('site_id',My_Template_Controller::getCurrentSite()->id)
				->where('name', $eventName)
				->find_all();
		foreach ($events as $event){
			self::processEvent($event, $data, $to, $additional);
		}
	}
	
	public function getDesignerEmail($user_id){
		$db=new Database;
		$query = $db->query('SELECT u.email FROM users u JOIN `users_clients` uc ON uc.client_id = ? WHERE u.id=uc.user_id', array( $user_id ));
		if ($query->count()){
			$res = $query->result_array();
			return $res[0]->email;
		}
		return false;
	}
}
