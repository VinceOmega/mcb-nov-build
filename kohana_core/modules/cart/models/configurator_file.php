<?

class Configurator_file_Model extends ORM {
	
	const TYPE_HEADER = 'xml_header';
	const TYPE_FOOTER = 'xml_footer';
	const TYPE_CONTENT = 'xml_content';
	const TYPE_FILE = 'file';
	
	protected $belong_to = array('product');
	
}
