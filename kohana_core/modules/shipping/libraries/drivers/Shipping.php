<?php defined('SYSPATH') OR die('No direct access allowed.');

interface Shipping_Driver {

	/**
	 * Sets driver fields and marks reqired fields as TRUE.
	 *
	 * @param  array  array of key => value pairs to set
	 */
	public function setData( $fields );

	public function getRates();
	
	public function getRate( $method );
	
	public function getTrackingUrl( $track_number );

}