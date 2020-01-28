<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model Spmoutbound_model
 *
 * This Model for ...
 * 
 * @package		CodeIgniter
 * @category	Model
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Spmoutbound_model extends CI_Model {

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function index()
  {
    // 
  }

  public function insert_outbound()
  {
    $this->db->reconnect();

    $data = array('apcdrno' => $this->input->post('apcdrno'),
    'wmdrno'=> $this->input->post('wmdrno'));

    $this->db->close();
  }

  // ------------------------------------------------------------------------

}

/* End of file Spmoutbound_model.php */
/* Location: ./application/models/Spmoutbound_model.php */