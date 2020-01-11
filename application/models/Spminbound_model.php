<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Spminbound_model
 *
 * This Model for ...
 *
 * @package        CodeIgniter
 * @category    Model
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
                ->where("PartNo like '%" . $postData['search'] . "%'");

            $records = $this->db->get('spm_hub_inventory')->result();

            foreach ($records as $rows) {
                $response[] = array("label" => $rows->PartNo, "value" => $rows->ItemId);
            }
        }

        return $response;
    }

    public function get_next_id_spm_inbound_inventory()
    {
        $this->db->reconnect();

        $query = $this->db->query("CALL GetNextIdSpmInboundInventory()");
        $row = $query->row();
        $lastid = $row->AUTO_INCREMENT;
        $this->db->close();
        return $lastid;
    }

    public function add_spm_inbound_inventory($lastid, $itemid, $itemqty, $datein, $arno)
    {
        $this->db->reconnect();

        $inboundinvdata = array('ArNo' => $arno, 'DateIn' => $datein);

        $insert_inbound_inventory = $this->db->set($inboundinvdata)->get_compiled_insert('spm_inbound_inventory');

        //$this->db->query($insert_inbound_inventory);

        $inbounditem[] = null;

        foreach ($this->input->post() as $items) {
            $inbounditem += array("ItemID" => $items->itemid, "Qty" => $items->itemqty);
        }

        $this->db->close();

        return $error;
    }

    // ------------------------------------------------------------------------
}

/* End of file Spminbound_model.php */
/* Location: ./application/models/Spminbound_model.php */
