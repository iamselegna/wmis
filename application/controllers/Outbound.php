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
    echo 'this is outbound';
  }
  
  /**
   * dashboard/spmoutbound/details
   */
  public function details()
  {

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