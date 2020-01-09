<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Spminbound_model
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

class Spminbound_model extends CI_Model
{

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

    public function get_all_part_no($postData)
    {
        //$query = $this->db->query("CALL GetAllPartNo()");
        $response = array();

        if (isset($postData['search'])) {
            $this->db->select('*')
                    ->where("PartNo like '%".$postData['search']."%'");

            $records = $this->db->get('spm_hub_inventory')->result();

            foreach ($records as $rows) {
                $response[] = array("label"=>$rows->PartNo,"value"=>$rows->ItemId);
            }
        }

        
        return $response;
    }

    // ------------------------------------------------------------------------
}

/* End of file Spminbound_model.php */
/* Location: ./application/models/Spminbound_model.php */
