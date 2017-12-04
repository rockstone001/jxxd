<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order_Model extends Base_Model {
	
	const TABLE_NAME = 'orders';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();

	}

	public function get_teacher_by_lesson_id($lesson_id)
	{
		$this->db->select('teachers.*');
		$this->db->from('teachers');
		$this->db->join('lessons', 'teachers.id = lessons.teacher_id');
		$this->db->where([
			'lessons.id' => $lesson_id
		]);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_order_list($uid)
	{
		$this->db->order_by('orders.id', 'desc');
		$this->db->select("orders.id, orders.state, lessons.title, FROM_UNIXTIME(UNIX_TIMESTAMP(lessons.start_time), '%Y-%m-%d %H:%i') as start_time, orders.name, orders.mobile");
		$this->db->from('orders');
		$this->db->join('lessons', 'orders.lesson_id = lessons.id');
		$this->db->where([
			'orders.uid' => $uid,
			'orders.state !=' => 2
		]);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_my_lesson($uid)
	{
		$this->db->order_by('lessons.id', 'desc');
		$this->db->select("lessons.id, lessons.title, count(orders.id) as total");
		$this->db->from('orders');
		$this->db->join('lessons', 'orders.lesson_id = lessons.id');
		$this->db->where([
			'orders.uid' => $uid,
			'orders.state !=' => 2
		]);
		$this->db->group_by('lessons.id');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_all_order($id)
	{
		$this->db->order_by('orders.id', 'desc');
		$this->db->select("orders.id, orders.state, lessons.title, FROM_UNIXTIME(UNIX_TIMESTAMP(lessons.start_time), '%Y-%m-%d %H:%i') as start_time, orders.name, orders.mobile");
		$this->db->from('orders');
		$this->db->join('lessons', 'orders.lesson_id = lessons.id');
		$this->db->where([
			'orders.lesson_id' => $id,
			'orders.state !=' => 2
		]);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_order_list2($where = [], $limit = 10, $offset = 0, $nickname = '')
	{
//		$ci = get_instance();
//		$ci->load->model('Order_user_Model', 'order_user');
//		$users = $ci->order_user->get_users_by_nickname($nickname);

		$query =  $this->db->order_by('orders.id', 'desc')
			->limit($limit, $offset)
			->select('orders.id, lessons.title, users.nickname, orders.order_id, orders.created_at, orders.time_end, orders.name, orders.mobile, orders.msg, orders.amount, orders.state, orders.transaction_id, orders.bank_type')
			->from('orders')->join('users', 'orders.uid = users.id')
			->join('lessons', 'lessons.id = orders.lesson_id')
			->where($where)
			->like('users.nickname', $nickname)->get();

		$rows = $query->result_array();
		empty($rows) && $rows = [];

		$query =  $this->db->order_by('orders.id', 'desc')
			->select("count(*) as total")
			->from('orders')->join('users', 'orders.uid = users.id')
			->join('lessons', 'lessons.id = orders.lesson_id')
			->where($where)
			->like('users.nickname', $nickname)->get();

		$total = current($query->row_array());

		return [
			'total' => $total,
			'rows' => $rows
		];
	}

	public function get_my_order_by_lesson_id($uid, $lessonid, $limit = 1000, $offset = 0)
	{
		$query =  $this->db->order_by('orders.id', 'desc')
			->limit($limit, $offset)
			->select('orders.id, orders.name, orders.mobile')
			->from('orders')->where([
				'uid' => $uid,
				'lesson_id' => $lessonid,
				'state !=' => 2
			])->get();

		$rows = $query->result_array();
		empty($rows) && $rows = [];


		return [
			'total' => count($rows),
			'rows' => $rows
		];
	}

	public function get_detail($id)
	{
		$this->db->select('orders.*, lessons.title as lesson_title, lessons.start_time,
		lessons.end_time, lessons.intro');
		$this->db->from('orders');
		$this->db->join('lessons', 'orders.lesson_id = lessons.id');
		$this->db->where([
			'orders.id' => $id
		]);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function update_order($data, $where)
	{
		$result = true;
		$this->db->trans_begin();
		try {
			$order = $this->get_one($where);
			if (!isset($order['lesson_id'])) {
				throw new Exception('no order');
			}

			//更新订单
			$rtn = $this->update($data, $where);
			if (!$rtn) {
				throw new Exception('update order failed');
			}


			$this->db->trans_commit();
		} catch (Exception $e) {
			$result = false;
			$this->db->trans_rollback();
		}
		return $result;
	}

	public function add_order($data)
	{
		$result = true;
		$this->db->trans_begin();
		try {
			if(!$this->add($data)) {
				throw new Exception('add order failed');
			}
			$this->db->trans_commit();
		} catch (Exception $e) {
			$result = false;
			$this->db->trans_rollback();
		}
		return $result;
	}

	public function feidan($order_id, $lesson_id)
	{
		$ci = get_instance();
		$ci->load->model('Lesson_model', 'lesson');
		$result = true;
		try {
			if(!$this->update([
				'state' => 2
			], [
				'id' => $order_id
			])) {
				throw new Exception('update order failed');
			}
			if(!$ci->lesson->return_back_limit_num($lesson_id)) {
				throw new Exception('update lesson failed');
			}
			if(!$ci->lesson->return_back_join_num($lesson_id)) {
				throw new Exception('update lesson failed');
			}
			$this->db->trans_commit();
		} catch (Exception $e) {
			$result = false;
			$this->db->trans_rollback();
		}
		return $result;
	}

}