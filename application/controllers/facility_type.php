<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class facility_type extends CI_Controller {

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

		if($this->input->post("type") && $this->input->post("price"))
		{

			$type = $this->input->post("type");
			$price = $this->input->post("price");
			$details = $this->input->post("details");

			if(count($this->facility_m->getfacilityType($type))==0) {
				$this->facility_m->addfacilityType($type, $price, $details);
				redirect("/facility-type");
			}
			else {
				$viewdata['error'] = "facility type alread exists";
			}
		}

		$data = array('title' => 'Add facility Type - ', 'page' => 'facility_type');
		$this->load->view('header', $data);
		$this->load->view('facility-type/add', $viewdata);
		$this->load->view('footer');
	}

	function delete($facility_type)
	{
		$this->facility_m->deletefacilityType($facility_type);
		redirect("/facility-type");
	}

	public function edit($facility_type)
	{
		if($this->input->post("type") && $this->input->post("price"))
		{

			$type = $this->input->post("type");
			$price = $this->input->post("price");
			$details = $this->input->post("details");

			$this->facility_m->editfacilityType($type, $price, $details);
			redirect("/facility-type");
		}
		
		$data = array('title' => 'Edit facility Type - ', 'page' => 'facility_type');
		$this->load->view('header', $data);

		$facility_type = $this->facility_m->getfacilityType($facility_type);
		
		$viewdata = array('facility_type'  => $facility_type[0]);
		$this->load->view('facility-type/edit',$viewdata);

		$this->load->view('footer');
	}

	public function index()
	{
		$facility_types = $this->facility_m->get_facility_types();

		$viewdata = array('facility_types' => $facility_types);

		$data = array('title' => 'facilities - ', 'page' => 'facility_type');
		$this->load->view('header', $data);
		$this->load->view('facility-type/list',$viewdata);
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */