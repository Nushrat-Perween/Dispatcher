<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

/**
 * Job model
 *
 * <p>
 * We are using this model to add, update, delete and get chats.
 * </p>
 *
 * @package Chat
 * @author Nushrat
 * @copyright Copyright &copy; 2015, Dispatcher
 * @category CI_Model API
 */

class Chat_model extends CI_Model {

	function __construct() {
		parent::__construct ();
	}
	
	public function getChat ($param) {
		$this->db->select('c.*,concat(a1.first_name," ",a1.last_name) as sender_name,
				concat(a2.first_name," ",a2.last_name) as receiver_name ');
		$this->db->from ( TABLES::$CHAT.' AS c' );
		$this->db->join ( TABLES::$ADMIN . ' AS a1', 'a1.id=c.sender_id', 'inner' );
		$this->db->join ( TABLES::$ADMIN . ' AS a2', 'a2.id=c.receiver_id', 'inner' );
		$this->db->where ( " (c.sender_id ='".$param['sender_id']."' AND c.receiver_id = '".$param['receiver_id']."' ) OR (c.sender_id ='".$param['receiver_id']."' AND c.receiver_id = '".$param['sender_id']."' )",'',FALSE );
		$this->db->order_by('c.id','ASC');
		//echo $this->db->last_query();
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	
	public function saveChat ($data) {

		$this->db->insert(TABLES::$CHAT,$data);
		return $this->db->insert_id();
	}
}