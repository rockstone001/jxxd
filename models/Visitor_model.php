<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Visitor_Model extends Base_Model {
	
	const TABLE_NAME = 'visitors';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();

	}

	public function get_visitor_num($from_uid, $source = 'jxxd')
	{
        $query =  $this->db
            ->select("count(*) as total")
            ->from(self::TABLE_NAME)
            ->where([
                'from_uid' => $from_uid,
                'source' => $source,
                'state' => 1
            ])->get();

        return current($query->row_array());
	}

}