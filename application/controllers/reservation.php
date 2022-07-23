<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reservation extends CI_Controller {

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

	public function check($ref="") {
		$post = $this->input->post();

		$customer = $this->customer_m->get_customer($post['customer_id']);
		$viewdata = array();

		$data = array('title' => 'Add Customer - ', 'page' => 'reservation');
		$this->load->view('header', $data);

		if(!$customer) {
			$viewdata['error'] = "Customer does not exist";
		} else {
			$facility = $this->reservation_m->get_available_facilities($post['facility_type'], $post['checkin_date'], $post['checkout_date']);
			if(!$facility) {
				$viewdata['error'] = "No available facility";
			}
		}
		if(isset($viewdata['error'])){
			$facility_types = $this->facility_m->get_facility_types();
			$viewdata['facility_types'] = $facility_types;
			$this->load->view('reservation/add',$viewdata);
		} else {
			$viewdata['facility'] = $facility;
			$viewdata['customer_id'] = $post['customer_id'];
			$viewdata['checkin_date'] = $post['checkin_date'];
			$viewdata['checkout_date'] = $post['checkout_date'];
			$viewdata['facility_type'] = $post['facility_type'];
//			echo "<pre>";
//			var_dump($viewdata);return;echo "</pre>";
			$this->load->view('reservation/list',$viewdata);
		}

		$this->load->view('footer');

	}
	public function index()
	{
		$this->check_login();

		$facility_types = $this->facility_m->get_facility_types();
		$viewdata = array('facility_types' => $facility_types);
		$data = array('title' => 'Reservation - ', 'page' => 'reservation');
		$this->load->view('header', $data);
		$this->load->view('reservation/add', $viewdata);
		$this->load->view('footer');
	}
	public function make()
	{
		$post = $this->input->post();

		$customer = $this->customer_m->get_customer($post['customer_id']);
		$customer = $customer[0];
		$viewdata = array();
		$data = array();
		$data['customer_id'] = $customer->customer_id;
		$data['facility_id'] = $post['facility_id'];
		$data['checkin_date'] = $post['checkin_date'];
		$data['checkout_date'] = $post['checkout_date'];
		$data['employee_id'] = UID;

		$date = new DateTime();
		$date_s = $date->format('d-m-Y');
		if($date_s>$data['checkin_date']) {
			$viewdata['error'] = "Checkin can't be before then today";
		} else {
			$this->reservation_m->add_reservation($data);
			$this->facility_m->add_facility_sale($data, $date_s);
			$viewdata['success'] = 'Reservation successfully made';
		}

		$facility_types = $this->facility_m->get_facility_types();
		$viewdata['facility_types'] = $facility_types;

		$data = array('title' => 'Reservation - ', 'page' => 'reservation');
		$this->load->view('header', $data);
		$this->load->view('reservation/add', $viewdata);
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */