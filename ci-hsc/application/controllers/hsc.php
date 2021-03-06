<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hsc extends CI_Controller {
    //great for initializing default variables
    protected  $data = array();
    function __construct()
    {
        parent::__construct();
        $this->load->model('usuals');


        /*
         * Set the Defaults
         */

        if(!$this->session->userdata("full_name")){
                $this->session->set_userdata("full_name","Fahad K");
        }

        elseif (!$this->session->userdata("branch_id")){
                $this->session->set_userdata("branch_id",1);
        }

        /*
         * We only need to change the name, but always check the id
         */

        $name=$this->usuals->get_branch_name($this->session->userdata('branch_id'));
        $this->session->set_userdata("branch_name",$name);





    }



	public function index()
	{


        $data['manual_invoice']=$this->usuals->getTotalManualInvoices(0);
		$data['today_sales']=$this->usuals->get_today_sales();
		$data['today_expenses']=$this->usuals->get_today_expenses();
		$data['today_binding']=$this->usuals->get_today_binding();
		$data['logs']=$this->usuals->get_recent_activities();
		$data['branches']=$this->usuals->get_branches();

        $this->load->view('includes/header',$data);
        $this->load->view('includes/top_nav');
        $this->load->view('includes/side_bar');

		$this->load->view('default_content');
		$this->load->view('includes/footer');
	}
    function change_branch($id){
        $this->session->set_userdata("branch_id",$id);
        redirect(base_url());

    }
}

