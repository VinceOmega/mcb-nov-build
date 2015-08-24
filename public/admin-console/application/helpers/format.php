<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Format helper class.
 *
 * $Id: format.php 4070 2009-03-11 20:37:38Z Geert $
 *
 * @package    Core
 * @author     Kohana Team
 * @copyright  (c) 2007-2008 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
class format_Core {

	/**
	 * Formats a phone number according to the specified format.
	 *
	 * @param   string  phone number
	 * @param   string  format string
	 * @return  string
	 */

 
function utf8_substr($str,$start)
{
   preg_match_all("/./su", $str, $ar);

   if(func_num_args() >= 3) {
       $end = func_get_arg(2);
       return join("",array_slice($ar[0],$start,$end));
   } else {
       return join("",array_slice($ar[0],$start));
   }
}	 

	
public static function makeUrlFriendly($title)
{
	//$output = utf8_substr($title, 0, 240);
	$output = strtolower($title);		
	$output = preg_replace("/\s/" , "_", $output); 	//'/\s/e' Replace spaces with underscores
	$output = str_replace('_', '-', $output); 	
	$output = str_replace("&amp;", '', $output); 	 
	//$output = str_replace("__", "_", $output); 	 
	$output = str_replace("---", "-", $output); 	 
	$output = str_replace("/", "", $output);
	$output = str_replace("\\", "", $output);
	$output = str_replace("'", "", $output); 	 
	$output = str_replace(",", "", $output); 	 
	$output = str_replace(";", "", $output); 	 
	$output = str_replace(":", "", $output); 	 
	$output = str_replace(".", "-", $output); 	 
	$output = str_replace("?", "", $output); 	 
	$output = str_replace("=", "-", $output); 	 
	$output = str_replace("+", "", $output); 	 
	$output = str_replace("$", "", $output); 	 
	$output = str_replace("&", "", $output); 	 
	$output = str_replace("!", "", $output); 	 
	$output = str_replace(">>", "-", $output); 	 
	$output = str_replace(">", "-", $output); 	 
	$output = str_replace("<<", "-", $output); 	 
	$output = str_replace("<", "-", $output); 	 
	$output = str_replace("*", "", $output); 	 
	$output = str_replace(")", "", $output); 	 
	$output = str_replace("(", "", $output);
	$output = str_replace("[", "", $output);
	$output = str_replace("]", "", $output);
	$output = str_replace("^", "", $output);
	$output = str_replace("%", "", $output);
	$output = str_replace("#", "", $output);
	$output = str_replace("@", "", $output);
	$output = str_replace("`", "", $output);
	$output = str_replace("\"", "", $output);
	$output = str_replace("--", "-", $output);
	return $output;
}	
	
	public static function first_words($string, $num, $tail='&nbsp;'){
		$words = str_word_count($string, 2, "<>:/.");
		
		/*** get the first $num words ***/
		$firstwords = array_slice( $words, 0, $num);
		
		/** return words in a string **/
		return  implode(' ', $firstwords).$tail;
	}

	public static function phone($number, $format = '3-3-4')
	{
		// Get rid of all non-digit characters in number string
		$number_clean = preg_replace('/\D+/', '', (string) $number);

		// Array of digits we need for a valid format
		$format_parts = preg_split('/[^1-9][^0-9]*/', $format, -1, PREG_SPLIT_NO_EMPTY);

		// Number must match digit count of a valid format
		if (strlen($number_clean) !== array_sum($format_parts))
			return $number;

		// Build regex
		$regex = '(\d{'.implode('})(\d{', $format_parts).'})';

		// Build replace string
		for ($i = 1, $c = count($format_parts); $i <= $c; $i++)
		{
			$format = preg_replace('/(?<!\$)[1-9][0-9]*/', '\$'.$i, $format, 1);
		}

		// Hocus pocus!
		return preg_replace('/^'.$regex.'$/', $format, $number_clean);
	}

	/**
	 * Formats a URL to contain a protocol at the beginning.
	 *
	 * @param   string  possibly incomplete URL
	 * @return  string
	 */
	public static function url($str = '')
	{
		// Clear protocol-only strings like "http://"
		if ($str === '' OR substr($str, -3) === '://')
			return '';

		// If no protocol given, prepend "http://" by default
		if (strpos($str, '://') === FALSE)
			return 'http://'.$str;

		// Return the original URL
		return $str;
	}
	
	public static function dollar($amount)
	{
		return '$' . number_format($amount, 2);
	}
	
	public static function format_date($date)
	{
		if (!is_numeric($date))
			$date = strtotime($date);
		return date("m/d/Y", $date);
	}
	
			
	public static function dollar_amount($dollar){
		return '$'. number_format($dollar, 2);
	}	


} // End format