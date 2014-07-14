<?php
/**
 * PHPDocx
 *
 */


/** PHPExcel root directory */
if (!defined('PHPDOCX_ROOT')) {
	define('PHPDOCX_ROOT', dirname(__FILE__) . '/');
	//require(PHPDOCX_ROOT . 'classes/Autoloader.inc');

spl_autoload_unregister(array('YiiBase','autoload'));
	//Autoloader::load();
spl_autoload_register(array('YiiBase','autoload'));
	// check mbstring.func_overload
	if (ini_get('mbstring.func_overload') & 2) {
		throw new Exception('Multibyte function overloading in PHP must be disabled for string functions (2).');
	}
}


/**
 * PHPExcel
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2010 PHPExcel (http://www.codeplex.com/PHPExcel)
 */
class Phpdocx
{
	/**
	 * Document properties
	 *
	 * @var PHPExcel_DocumentProperties
	 */
	private $_properties;

	/**
	 * Document security
	 *
	 * @var PHPExcel_DocumentSecurity
	 */
	private $_security;

	/**
	 * Collection of Worksheet objects
	 *
	 * @var PHPExcel_Worksheet[]
	 */
	private $_workSheetCollection = array();

	/**
	 * Active sheet index
	 *
	 * @var int
	 */
	private $_activeSheetIndex = 0;

	/**
	 * Named ranges
	 *
	 * @var PHPExcel_NamedRange[]
	 */
	private $_namedRanges = array();

	/**
	 * CellXf supervisor
	 *
	 * @var PHPExcel_Style
	 */
	private $_cellXfSupervisor;

	/**
	 * CellXf collection
	 *
	 * @var PHPExcel_Style[]
	 */
	private $_cellXfCollection = array();

	/**
	 * CellStyleXf collection
	 *
	 * @var PHPExcel_Style[]
	 */
	private $_cellStyleXfCollection = array();
	
	//private $_location_file = ;
	public $options = array();
	/**
	 * Create a new PHPExcel with one Worksheet
	 */
	public function init()
    {
		echo 'asdsa';
	}	
	public function __construct($options='')
	{
		//echo $options['filetemp'];
		require(PHPDOCX_ROOT . 'classes/CreateDocx.inc');
	}

}
