<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Don't forget include/define REST_Controller path

/**
 *
 * Controller Outbound
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

class Outbound extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('spmoutbound_model');
  }

  /**
   * dashboard/spmoutbound/monitor
   * 
   */
  public function index()
  {

    $searchItem = $this->input->post('searchItem');
        $selectEntries = $this->input->get('show_entries');
        $limit = 0;

        if ($selectEntries != null) {
            $limit = $selectEntries;
        } else {
            $limit = 10;
        }

        $inboundcount = $this->spmoutbound_model->get_spm_outbound_count();

        $paginationConfig['base_url'] = base_url('dashboard/spmoutbound/monitor');
        $paginationConfig['per_page'] = $limit;
        $paginationConfig['enable_query_strings'] = true;
        $paginationConfig['uri_segment'] = 4;
        $paginationConfig['reuse_query_string'] = true;

        $paginationConfig['attributes'] =array('class'=>'page-link');

        $paginationConfig['full_tag_open'] = '<nav aria-label="SPM Hub Inventory Pagination"><ul class="pagination justify-content-end">';
        $paginationConfig['full_tag_close'] = '</ul></nav>';

        $paginationConfig['first_tag_open'] = '<li class="page-item">';
        $paginationConfig['first_tag_close'] = '</li>';

        $paginationConfig['cur_tag_open'] = ' <li class="page-item active" aria-current="page"><span class="page-link">';
        $paginationConfig['cur_tag_close'] = '</span></li>';

        if ($searchItem !== null) {
            $result = $this->spmoutbound_model->get_searched_outbound_inventory($searchItem);
            $paginationConfig['total_rows'] = $result['numrows'];
        } else {
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            $result = $this->spmoutbound_model->get_all_outbound_inventory($page, $paginationConfig['per_page']);
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
    $this->load->view('dashboard/spm/outboundbody',$data);
    $this->load->view('dashboard/footer');
  }
  
  /**
   * dashboard/spmoutbound/viewdetails
   */
  public function view($id)
  {
    $data['result'] = $this->spmoutbound_model->get_outbound_inventory_details($id);

    //    print_r($data);

    //    for ($i=0; $i < $data['numrows']; $i++) { 
    //        echo '<br>'.$data[$i]['PartNo'];
    //    }
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/spm/spmoutboundinventoryviewdetails', $data);
        $this->load->view('dashboard/footer');
  }

  /**
   *  dashboard/spmoutbound/create
   */
  public function create()
  {

  }


  /**
   *  dashboard/spmoutboundinventory/createOutbound
   */
  public function store()
  {
    return $this->spmoutbound_model->insert_outbound();
  }

  /**
   * dashboard/o
   */
  public function update()
  {

  }



}


/* End of file Outbound.php */
/* Location: ./application/controllers/Outbound.php */