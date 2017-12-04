<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Jxxd_Model extends Base_Model {
	
	const TABLE_NAME = 'jxxds';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();

	}



}