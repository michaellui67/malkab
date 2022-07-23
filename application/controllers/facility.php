<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class facility extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function check_login()
	{
		if(!UID)
			redirect("login");
	} 

	public function add()
	{
		$viewdata = array();
		if($this->input->post("facility_type") && $this->input->post("min_id") && $this->input->post("max_id"))
		{
			$new_facility_type = $this->input->post("facility_type");
			$new_min_id = intval($this->input->post("min_id"));
			$new_max_id = intval($this->input->post("max_id"));

			$facilities_avail = count($this->facility_m->getfacilityRange($new_facility_type, $new_min_id, $new_max_id));

			if($new_min_id>$new_max_id) {
				$viewdata['error'] = "Range is not valid [$new_min_id, $new_max_id]";
			} else if($facilities_avail!==0) {
				$viewdata['error'] = "Range is not available [$new_min_id, $new_max_id]";
			} else {
				$this->facility_m->addfacilityRange($new_facility_type, $new_min_id, $new_max_id);
				redirect("/facility");
			}
		}
		$data = array('title' => 'Add facilities - ', 'page' => 'facility');
		$this->load->view('header', $data);

		$facility_types = $this->facility_m->get_facility_types();
		$viewdata['facility_types'] = $facility_types;
		$this->load->view('facility/add',$viewdata);

		$this->load->view('footer');
	}

	function delete($min_id, $max_id)
	{
		$this->facility_m->deletefacilityRange($min_id, $max_id);
		redirect("/facility");
	}

	public function edit($facility_type, $min_id, $max_id)
	{
		$viewdata = array();
		if($this->input->post("facility_type") && $this->input->post("min_id") && $this->input->post("max_id"))
		{
			$new_facility_type = $this->input->post("facility_type");
			$new_min_id = intval($this->input->post("min_id"));
			$new_max_id = intval($this->input->post("max_id"));

			$facilities_avail = count($this->facility_m->isAvailRange($facility_type, $new_min_id, $new_max_id));

			if($new_min_id>$new_max_id) {
				$viewdata['error'] = "Range is not valid [$new_min_id, $new_max_id]";
			} else if($facilities_avail!==0) {
				$viewdata['error'] = "Range is not available [$new_min_id, $new_max_id]";
			} else {
				$this->facility_m->deletefacilityRange($min_id, $max_id);
				$this->facility_m->addfacilityRange($new_facility_type, $new_min_id, $new_max_id);
				redirect("/facility");
			}
		}
		$data = array('title' => 'Edit facilities - ', 'page' => 'facility');
		$this->load->view('header', $data);

		$facility_types = $this->facility_m->get_facility_types();

		$facility_range = new stdClass();
		$facility_range->facility_type = $facility_type;
		$facility_range->min_id = $min_id;
		$facility_range->max_id = $max_id;
		$viewdata['facility_range'] = $facility_range;
		$viewdata['facility_types'] = $facility_types;
		$this->load->view('facility/edit',$viewdata);

		$this->load->view('footer');
	}

	public function index()
	{
		$facilities = $this->facility_m->get_facilities();

		$viewdata = array('facilities' => $facilities);

		$data = array('title' => 'facilities - ', 'page' => 'facility');
		$this->load->view('header', $data);
		$this->load->view('facility/list',$viewdata);
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */