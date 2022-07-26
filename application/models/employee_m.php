<?php

class Employee_m extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_employees()
    {
        $query = $this->db->from('employee')->get();
        $data = array();

        foreach (@$query->result() as $row)
        {
            $data[] = $row;
            // $row->customer_id
            // $row->customer_username
            // $data[0]->customer_id
        }
        if(count($data))
            return $data;
        return false;
    } 

    function addEmployee($username, $password, $firstname, $lastname, $telephone, $email)
    {
        $data = array('employee_username' => $username, 'employee_password' => $password, 'employee_firstname' => $firstname, 'employee_lastname' => $lastname, 'employee_telephone' => $telephone, 'employee_email' => $email);
        $this->db->insert('employee', $data);
        return $this->db->affected_rows();
    } 

    function deleteEmployee($employee_id)
    {
        $this->db->delete('employee', array('employee_id' => $employee_id));
        return $this->db->affected_rows();
    }

    function editEmployee($employee_id, $username, $password, $firstname, $lastname, $telephone, $email)
    {
        $data = array('employee_username' => $username, 'employee_password' => $password, 'employee_firstname' => $firstname, 'employee_lastname' => $lastname, 'employee_telephone' => $telephone, 'employee_email' => $email);

        $this->db->where('employee_id', $employee_id);
        $this->db->update('employee', $data); 
    }

    function getEmployee($employee_id)
    {
        $query = $this->db->get_where('employee', array('employee_id' => $employee_id));
        return $query->result();
    }
}
