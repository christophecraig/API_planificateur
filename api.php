<?php
    
	/* 
		This is an example class script proceeding secured API
		To use this class you should keep same as query string and function name
		Ex: If the query string value rquest=delete_user Access modifiers doesn't matter but function should be
		     function delete_user(){
				 You code goes here
			 }
		Class will execute the function dynamically;
		
		usage :
		
		    $object->response(output_data, status_code);
			$object->_request	- to get santinized input 	
			
			output_data : JSON (I am using)
			status_code : Send status message for headers
			
		Add This extension for localhost checking :
			Chrome Extension : Advanced REST client Application
			URL : https://chrome.google.com/webstore/detail/hgmloofddffdnphfgcellkdfbfbjeloo
		
		I used the below table for demo purpose.
		
		CREATE TABLE IF NOT EXISTS `users` (
		  `user_id` int(11) NOT NULL AUTO_INCREMENT,
		  `user_fullname` varchar(25) NOT NULL,
		  `user_email` varchar(50) NOT NULL,
		  `user_password` varchar(50) NOT NULL,
		  `user_status` tinyint(1) NOT NULL DEFAULT '0',
		  PRIMARY KEY (`user_id`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
 */

require_once ("Rest.inc.php");

class API extends REST
{

	public $data = "";

	const DB_SERVER = "localhost";
	const DB_USER = "root";
	const DB_PASSWORD = "";
	const DB = "planificateur";

	private $func = NULL;
	private $db = NULL;

	public function __construct()
	{
		parent::__construct();				// Init parent contructor
		$this->dbConnect();					// Initiate Database connection
	}
		
		/*
	 *  Database connection 
	 */
	private function dbConnect()
	{
		$this->db = new mysqli(self::DB_SERVER, self::DB_USER, self::DB_PASSWORD, self::DB);
	}
		
		/*
	 * Public method for access api.
	 * This method dynmically call the method based on the query string
	 *
	 */
	public function processApi()
	{
		var_dump($_REQUEST);
		$func = strtolower(trim(str_replace("/", "", $_REQUEST['rquest'])));
		$req = explode("/", strtolower($_REQUEST["rquest"]));
		$entity = $req[0];
		if (count($req) > 1) {
			$function = $req[1];
		}
		if (count($req) > 2) {
			$parameters = $req[2];
		}
		var_dump($req);
		if ((int)method_exists($this, $func) > 0)
			$this->$func();
		else
			$this->response('', 404);				// If the method not exist with in this class, response would be "Page not found".
	}

	private function restskillstest()
	{
		echo 'excellent';
	}
		
		/* 
	 *	Simple login API
	 *  Login must be POST method
	 *  email : <USER EMAIL>
	 *  pwd : <USER PASSWORD>
	 */

	private function login()
	{
			// Cross validation if the request method is POST else it will return "Not Acceptable" status
		if ($this->get_request_method() != "POST") {
			$this->response('', 406);
		}

		$email = $this->_request['email'];
		$password = $this->_request['pwd'];
			
			// Input validations
		if (!empty($email) and !empty($password)) {
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$sql = $this->db->query("SELECT user_id, user_fullname, user_email FROM users WHERE user_email = '$email' AND user_password = '" . md5($password) . "' LIMIT 1");
				if ($this->db->affected_rows() > 0) {
					$result = $sql->fetch_array();
						
						// If success everythig is good send header as "OK" and user details
					$this->response($this->json($result), 200);
				}
				$this->response('', 204);	// If no records "No Content" status
			}
		}
			
			// If invalid inputs "Bad Request" status message and reason
		$error = array('status' => "Failed", "msg" => "Invalid Email address or Password");
		$this->response($this->json($error), 400);
	}

	private function users()
	{	
			// Cross validation if the request method is GET else it will return "Not Acceptable" status
		if ($this->get_request_method() != "GET") {
			$this->response('', 406);
		}
		$sql = $this->db->query("SELECT user_id, user_fullname, user_email FROM users WHERE user_status = 1", $this->db);
		if ($this->db->affected_rows() > 0) {
			$result = array();
			while ($sql->fetch_array($sql)) {
				$result[] = $rlt;
			}
				// If success everythig is good send header as "OK" and return list of users in JSON format
			$this->response($this->json($result), 200);
		}
		$this->response('', 204);	// If no records "No Content" status
	}

	private function deleteUser()
	{
			// Cross validation if the request method is DELETE else it will return "Not Acceptable" status
		if ($this->get_request_method() != "DELETE") {
			$this->response('', 406);
		}
		$id = (int)$this->_request['id'];
		if ($id > 0) {
			$this->db->query("DELETE FROM users WHERE user_id = $id");
			$success = array('status' => "Success", "msg" => "Successfully one record deleted.");
			$this->response($this->json($success), 200);
		} else
			$this->response('', 204);	// If no records "No Content" status
	}
		
		/*
	 *	Encode array into JSON
	 */
	private function json($data)
	{
		if (is_array($data)) {
			return json_encode($data);
		}
	}
}
	
	// Initiate Library

$api = new API;
$api->processApi();
?>