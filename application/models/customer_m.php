<?php

class Customer_m extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    function get_customer($id)
    {
        $query = $this->db->get_where('customer', array('customer_id' => $id));
        if($query) {
            return $query->result();
        } else {
            return $query;
        }
    } 
    function add_customer($data)
    {
        $this->db->insert('customer', $data);
//        return $this->db->affected_rows();
    }

    function get_active_customers()
    {
        $date = date('d-m-Y');
        $q = $this->db->query("CALL get_customers('$date')");

        $data = array();
        foreach ($q->result() as $customer) {
            $data[] = $customer;
        }
        return $data;
    }

}
