<?php

require_once('customer.php');

class Customers
{

	private $db = null;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function getCustomers()
	{
		$dbrs = $this->db->query("SELECT * FROM customers ORDER BY name");
		$response = array();
		while ($dbrsi = $dbrs->fetch_object()) {
			$response[] = $dbrsi;
		}
		return $response;
	}

	public function getCustomer($id)
	{
		if ($id) {
			$customer = new customer($this->db, $id);
			return $customer->getValues();
		}
		return null;
	}

	public function addCustomer($datas)
	{
		$customer = new customer($this->db);
		$customer->setValues($datas);
		$customer->save();
		return $customer->getId();
	}

	public function updateCustomer($id, $datas)
	{
		$customer = new customer($this->db, $id);
		$customer->setValues($datas);
		$customer->save();
		return $customer->getValues();
	}

}

?>
