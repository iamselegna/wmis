<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Don't forget include/define REST_Controller path

/**
 *
 * Controller Dashboard
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @author    Raul Guerrero <r.g.c@me.com>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/body');
        $this->load->view('dashboard/footer');
    }

    public function spminboundmonitoring()
    {
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/spm/inboundbody');
        $this->load->view('dashboard/footer');
    }
    public function spmhubinventory()
    {

        $this->load->view('dashboard/header');
        $this->load->view('dashboard/spm/hubinventorybody');
        $this->load->view('dashboard/footer');
    }

    public function spmhubadditem()
    {

        $this->form_validation->set_rules('partno', 'Part No', 'required');

        if ($this->form_validation->run() == false) {

            $result = array(
                'error' => true,
                'message' => 'Part No is Required.');

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($result));

        } else {
            $partno = $this->input->post('partno');

            $result = array(
                'error' => false,
                'message' => 'Add Item Success');

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($result));
        }

    }

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */
