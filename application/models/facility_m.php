<?php

class facility_m extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_facility_types()
    {
        $query = $this->db->get('facility_type');
        $data = array();

        if($query)
            foreach ($query->result() as $row)
            {
                $data[] = $row;
            }
        if(count($data))
            return $data;
        return false;
    } 
    function get_facilities()
    {
        $query = $this->db->order_by('facility_id')->get('facility');
        $data = array();

        $i=-1;
        foreach (@$query->result() as $row)
        {
            if($i==-1 || $data[$i]->facility_type != $row->facility_type || $data[$i]->max_id+1!=$row->facility_id) {
                $i++;
                $data[$i]= (object)['facility_type', 'min_id', 'max_id'];
                $data[$i]->facility_type = $row->facility_type;
                $data[$i]->min_id = intval($row->facility_id);
                $data[$i]->max_id = intval($row->facility_id);
            } else {
                $data[$i]->max_id ++;
            }
        }
        if(count($data))
            return $data;
        return false;
    }

    function addfacilityType($type, $price, $details)
    {
        $data = array('facility_type' => $type, 'facility_price' => $price, 'facility_details' => $details);
        $this->db->insert('facility_type', $data);
        return $this->db->affected_rows();
    }

    function deletefacilityType($facility_type)
    {
        $this->db->delete('facility_type', array('facility_type' => $facility_type));
        return $this->db->affected_rows();
    }

    function getfacilityType($facility_type)
    {
        $query = $this->db->get_where('facility_type', array('facility_type' => $facility_type));
        return $query->result();
    }

    function editfacilityType($type, $price, $details)
    {
        $data = array('facility_type' => $type, 'facility_price' => $price, 'facility_details' => $details);

        $this->db->where('facility_type', $type);
        $this->db->update('facility_type', $data); 
    }

    function getfacility($facility_type)
    {
        $query = $this->db->get_where('facility', array('facility_type' => $facility_type));
        return $query->result();
    }

    function isAvailRange($facility_type, $min_id, $max_id) {
        $query = $this->db->get_where('facility', array('facility_type !=' => $facility_type, 'facility_id >=' => $min_id, 'facility_id <=' => $max_id));
        return $query->result();
    }
    function getfacilityRange($facility_type, $min_id, $max_id) {
        $query = $this->db->get_where('facility', array('facility_id >=' => $min_id, 'facility_id <=' => $max_id));
        return $query->result();
    }
    function deletefacilityRange($min_id, $max_id) {
        $this->db->delete('facility', array('facility_id >=' => $min_id, 'facility_id <=' => $max_id));
        return $this->db->affected_rows();
    }

    function addfacilityRange($facility_type, $min_id, $max_id) {
        $data = array();
        for($i = $min_id; $i<=$max_id; ++$i) {
            $data[] = array('facility_type' => $facility_type, 'facility_id' => $i);
        }
        $this->db->insert_batch('facility', $data);
        return $this->db->affected_rows();
    }

    function add_facility_sale($data) {
        $query = $this->db->join("facility_type","facility_type.facility_type = facility.facility_type", "left")->get_where("facility", array('facility_id' => $data['facility_id']));
        if(!$query || $query->num_rows() == 0) {
            return false;
        }
        $price = $query->result();
        $data['facility_sales_price'] = $price[0]->facility_price;
        $this->db->insert('facility_sales', $data);
    }
}
