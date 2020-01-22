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
        $this->load->model('spminbound_model');
    }

    public function index()
    {
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/body');
        $this->load->view('dashboard/footer');
    }

    /* *
    *
    * SPM HUB INVENTORY MONITORING
    *
     */

    
    public function spmhubinventory()
    {
        $searchItem = $this->input->post('searchItem');
        $selectEntries = $this->input->get('show_entries');
        $limit = 0;

        if ($selectEntries != null) {
            $limit = $selectEntries;
        } else {
            $limit = 10;
        }

        $hubcount = $this->spmhubinventory_model->get_spm_hub_item_count();

        $paginationConfig['base_url'] = base_url('dashboard/spmhubinventory/');
        $paginationConfig['per_page'] = $limit;
        $paginationConfig['enable_query_strings'] = true;
        $paginationConfig['uri_segment'] = 3;
        $paginationConfig['reuse_query_string'] = true;

        $paginationConfig['attributes'] =array('class'=>'page-link');

        $paginationConfig['full_tag_open'] = '<nav aria-label="SPM Hub Inventory Pagination"><ul class="pagination justify-content-end">';
        $paginationConfig['full_tag_close'] = '</ul></nav>';

        $paginationConfig['first_tag_open'] = '<li class="page-item">';
        $paginationConfig['first_tag_close'] = '</li>';

        $paginationConfig['cur_tag_open'] = ' <li class="page-item active" aria-current="page"><span class="page-link">';
        $paginationConfig['cur_tag_close'] = '</span></li>';

        if ($searchItem !== null) {
            $result = $this->spmhubinventory_model->get_searched_hub_item($searchItem);
            $paginationConfig['total_rows'] = $result['numrows'];
        } else {
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $result = $this->spmhubinventory_model->get_all_hub_item($page, $paginationConfig['per_page']);
            $paginationConfig['total_rows'] = $hubcount['ItemCount'];
        }

        

        $this->pagination->initialize($paginationConfig);
        $data = array(
            'tabledata' => $result['tabledata'],
            'stockCount' => $hubcount['StockCount'],
            'totalrows' => $hubcount['ItemCount'],
            'pagelinks' => $this->pagination->create_links(),
            'selectedEntries' => $limit
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
    /*
    *
    *   END SPM HUB INVENTORY MONITORING
    *
     */


    /*
    *
    *   SPM INBOUND INVENTORY MONITORING
    *
     */
    public function spminboundmonitoring()
    {
        $searchItem = $this->input->post('searchItem');
        $selectEntries = $this->input->get('show_entries');
        $limit = 0;

        if ($selectEntries != null) {
            $limit = $selectEntries;
        } else {
            $limit = 10;
        }

        $inboundcount = $this->spminbound_model->get_spm_inbound_count();

        $paginationConfig['base_url'] = base_url('dashboard/spmhubinventory/');
        $paginationConfig['per_page'] = $limit;
        $paginationConfig['enable_query_strings'] = true;
        $paginationConfig['uri_segment'] = 3;
        $paginationConfig['reuse_query_string'] = true;

        $paginationConfig['attributes'] =array('class'=>'page-link');

        $paginationConfig['full_tag_open'] = '<nav aria-label="SPM Hub Inventory Pagination"><ul class="pagination justify-content-end">';
        $paginationConfig['full_tag_close'] = '</ul></nav>';

        $paginationConfig['first_tag_open'] = '<li class="page-item">';
        $paginationConfig['first_tag_close'] = '</li>';

        $paginationConfig['cur_tag_open'] = ' <li class="page-item active" aria-current="page"><span class="page-link">';
        $paginationConfig['cur_tag_close'] = '</span></li>';

        if ($searchItem !== null) {
            $result = $this->spminbound_model->get_searched_inbound_inventory($searchItem);
            $paginationConfig['total_rows'] = $result['numrows'];
        } else {
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $result = $this->spminbound_model->get_all_inbound_inventory($page, $paginationConfig['per_page']);
            $paginationConfig['total_rows'] = $inboundcount['ItemCount'];
        }

        

        $this->pagination->initialize($paginationConfig);
        $data = array(
            'tabledata' => $result['tabledata'],
            'totalrows' => $inboundcount['ItemCount'],
            'pagelinks' => $this->pagination->create_links(),
            'selectedEntries' => $limit
        );

        $this->load->view('dashboard/header');
        $this->load->view('dashboard/spm/inboundbody', $data);
        $this->load->view('dashboard/footer');
    }

    public function spmaddinboundinventory()
    {
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/spm/addinboundinventory');
        $this->load->view('dashboard/footer');
    }

    public function spminboundinventoryadditem()
    {
        $arno = $this->input->post("arno");
        $datein = $this->input->post("datein");
        $itemid = $this->input->post("itemid");
        $itemqty = $this->input->post("itemqty");

        $result = $this->spminbound_model->add_spm_inbound_inventory($itemid, $itemqty, $datein, $arno);
        
        print_r($result);
        //redirect('/dashboard/spminboundinventoryaddsuccess');
        //print_r($result);
    }

    public function spminboundinventoryaddsuccess()
    {
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/spm/spminboundinvadditemsuccess');
        $this->load->view('dashboard/footer');
    }

    public function spmgetallpartno()
    {
        $postData = $this->input->post();
        $result = $this->spminbound_model->get_all_part_no($postData);
        echo json_encode($result);
    }

    public function viewspminbounddetails($id)
    {
        $data = $this->spminbound_model->get_inbound_inventory_details($id);

        //print_r($data);

        //echo $data['arno'];
        //echo $data['datein'];
       print_r($data);

       for ($i=0; $i < $data['numrows']; $i++) { 
           echo '<br>'.$data[$i]['PartNo'];
       }
        // echo json_encode($data);
        // foreach ($data['items'] as $key => $i) {
        //    print_r($data[$i]);
        // }
        //$this->load->view('dashboard/header');
        //$this->load->view('dashboard/spm/spminboundinventoryviewdetails', $data);
        //$this->load->view('dashboard/footer');
    }
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */
