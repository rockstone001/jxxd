<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Feedback_Model extends Base_Model {
	
	const TABLE_NAME = 'feedbacks';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();

	}



}