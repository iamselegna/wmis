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
        $this->load->model('spmhubinventory_model');
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
        $searchItem = $this->input->post('searchItem');
        $selectEntries = $this->input->post('selectEntries');

        $itemCount = $this->spmhubinventory_model->get_spm_hub_item_count();
        $paginationConfig['base_url'] = base_url('dashboard/spmhubinventory/');
        $paginationConfig['per_page'] = 10;
        $paginationConfig['enable_query_strings'] = TRUE;
        $paginationConfig['uri_segment'] = 3;
        $paginationConfig['use_page_numbers'] = TRUE;
        

        if ($searchItem != null) {
            $result = $this->spmhubinventory_model->get_searched_hub_item();
            $paginationConfig['total_rows'] = $result['numrows'];
        } else {
            $result = $this->spmhubinventory_model->get_all_hub_item();
            $paginationConfig['total_rows'] = $result['numrows'];
        }

        

        $this->pagination->initialize($paginationConfig);
        $data = array(
            'tabledata' => $result['tabledata'],
            'itemcount' => $itemCount,
            'totalrows' => $result['numrows'],
            'pagelinks' => $this->pagination->create_links()
        );
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/spm/hubinventorybody', $data);
        $this->load->view('dashboard/footer');
    }

    public function spmhubinventoryadditem()
    {
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/spm/addhubinventoryitem');
        $this->load->view('dashboard/footer');
    }

    public function spmhubadditem()
    {
        $this->form_validation->set_rules('partno', 'Part No', 'required');

        $result = null;

        if ($this->form_validation->run() == false) {
            $result = array(
                'error' => true,
                'message' => 'Part No is Required.');

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($result));
        } else {
            $result = $this->spmhubinventory_model->add_spm_hub_item();
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($result));
        }
    }
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */