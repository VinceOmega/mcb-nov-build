<?php defined('SYSPATH') or die('No direct script access.');

define('PAGE_LIMIT', 10);

class Reports_Controller extends Controller {
	public $header = array();
	
	public $groups = array(
		'z'    => 'days',
		'W'   => 'weeks',
		'm'  => 'months',
		'Q' => 'quarters',
		'Y'   => 'years',
		'I'  => 'individual orders'
	);
	
	public function renderView($contentView, $heading){
		$view = new View('admin');
		 
		$view->header  = new View('header');
		$view->content = new View($contentView);
		$view->footer  = new View('footer');
		 
		$view->header->title     = 'Reports >> '.$heading;
		$view->content->heading  = $heading;
		$view->footer->copyright = 'Copyright';
		 
		$view->render(TRUE);
	}
	
	public function csv(){
		$out = join(';', array_values($this->header))."\n";
		foreach ($this->rows as $row){
			$line = array();
			foreach (array_keys($this->header) as $key){
				$line[] = $row[$key];
			}
			$out .= join(';', $line)."\n";
		}
		header("Content-Type:application/csv");
		header("Content-Disposition: attachment; filename=report_".date('Y-m-d').'.csv');
		header("Pragma: no-cache");
		header("Expires: 0");
		die($out);
	}
	
	public function xml(){
		$excelExport = new Excelexport();
		$out = array();
		foreach ($this->header as $field){
			$out[] = $field;
		}
		$excelExport->addRow($out);
		foreach ($this->rows as $row){
			$line = array();
			foreach (array_keys($this->header) as $key){
				$line[] = $row[$key];
			}
			$excelExport->addRow($line);
		}		
		$excelExport->download('report_'.date('Y-m-d').'.xls');
	}
	
	// returns group number (day of year, week of year, ..)
	private function getGroupNumber($format, $timestamp){
		if ($format=='Q'){
			return (int)floor(date('m', $timestamp) / 3.1) + 1;
		}else{
			return date($format, $timestamp);
		}
	}

	private function groupedOrders($res){
		$this->header = array('start' => 'Start Date', 'end' => 'End Date', 'orders' => 'No. Orders', 'shipping_total' => 'Shipping Total', 'order_total' => 'Total');
		$rows = array();
		foreach ($res as $row){
			$rows[$row->date][] = $row;
		}

		// start from either the submitted date or the first record's date
		reset($rows);
		$start = ($_POST['date_from']!='')  ? date_create($_POST['date_from']) : date_create(key($rows));
		// end with either submitted till date or the last record
		end($rows);
		$end = ($_POST['date_till']!='')  ? date_create($_POST['date_till']) : date_create(key($rows));
		
		$i = $start;
		$group = $this->getGroupNumber($_POST['group'], date_format($start, 'U'));

		$curRow = array(
			'start'    => date_format($i, 'Y-m-d'),
			'orders'   => 0,
			'shipping_total' => 0,
			'order_total'    => 0
		);
		while ($i <= $end ){
			$curDate = date_format($i, 'Y-m-d');
			if (isset($rows[$curDate])){
				foreach ($rows[$curDate] as $order){
					$curRow['orders']++;
					$curRow['shipping_total'] += $order->shipping_total;
					$curRow['order_total'] += $order->order_total;
				}
			}
			$j = $i;
			date_add($j, date_interval_create_from_date_string('1 day'));				
			if ($j <= $end && $this->getGroupNumber($_POST['group'], date_format($j, 'U')) != $group){
				$curRow['end'] = $curDate;
				$curRow['shipping_total'] = sprintf ("%6.2f", $curRow['shipping_total']);
				$curRow['order_total'] = sprintf ("%6.2f", $curRow['order_total']);
			
				$this->rows[] = $curRow;
				$group = $this->getGroupNumber($_POST['group'], date_format($j, 'U'));
				$curRow = array(
					'start'    => date_format($j, 'Y-m-d'),
					'orders'   => 0,
					'shipping_total' => 0,
					'order_total'    => 0
				);
			}
			$i = $j;
			
			// I know, it's stupids
			$curRow['shipping_total'] = sprintf ("%6.2f", $curRow['shipping_total']);
			$curRow['order_total'] = sprintf ("%6.2f", $curRow['order_total']);
		}
		$curRow['end'] = date_format($end, 'Y-m-d');
		$this->rows[] = $curRow;	
	}
	
	private function individualOrders($res){
		$this->header = array('date' => 'Date', 'first_name' => 'First Name', 'last_name' => 'Last Name', 'tax' => 'Tax Total', 'shipping_total' => 'Shipping Total', 'product_total' => 'Product Total', 'order_total' => 'Total');
		foreach ($res as $row){
			$this->rows[] = (array)$row;
		}
	}
	
	public function sales(){
		$this->db = new Database;
		$this->rows = array();
		if ($_POST){
			$this->values = array(
				'date_from' => $_POST['date_from'],
				'date_till' => $_POST['date_till'],
				'group'     => $_POST['group'],
				'status'    => $_POST['status'],
				'site'	    => $_POST['site'],
				'page'      => (isset($_POST['page'])) ? $_POST['page'] : 1
			);
			$where = array();

			if ($_POST['date_from']!='') $where[] = 'date_created >= "'.date_format( date_create($_POST['date_from']), 'U').'"';
			if ($_POST['date_till']!='') $where[] = 'date_created <= "'.date_format( date_create($_POST['date_till'].' 23:59:59'), 'U').'"';
			if ($_POST['status']!='0') $where[] = 'statusID = '.$_POST['status'];
			if ($_POST['site']!='0') $where[] = 'site_id = '.$_POST['site'];
			
			$where = (count($where)>0) ? 'WHERE '.join(' AND ', $where) : '';
			
			//$count = $this->db->query('SELECT count(*) as count FROM orders '.$where)->result();
			//$this->count = $count[0]->count;
	
			$query = 'SELECT *, FROM_UNIXTIME(date_created, "%Y-%m-%d") as date, (order_total - shipping_total) as product_total  FROM orders '.$where.' ORDER BY date_created';

			
			if (count($res = $this->db->query($query)) > 0){
				if ($_POST['group']=='I'){
					$this->individualOrders($res);
				}else{
					$this->groupedOrders($res);
				}
				
				if (isset($_POST['export'])){
					switch($_POST['export']){
						case 'csv':
							$this->csv();
						break;
						case 'xml':
							$this->xml();
						break;
					}
				}
			}
		}else{
			$this->values = array(
				'date_from' => date('Y-m-01'),
				'date_till' => date('Y-m-d'),
				'group'     => '',
				'status'    => 'z',
				'site'      => '',
			);
		}
		$this->renderView('sales_report', 'Sales Report');
	}
	
}