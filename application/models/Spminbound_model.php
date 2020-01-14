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

    public function add_spm_inbound_inventory($itemid, $itemqty, $datein, $arno)
    {
        $this->db->reconnect();

        $inboundinventoryid = null;

        $inbounditem = array();

        $updatehubitem = array();

        $returnmessage = array();

        $inboundinvdata = array('ArNo' => $arno, 'DateIn' => $datein);

        //INSERT INBOUND INVENTORY DATA
        if ($this->db->insert('spm_inbound_inventory', $inboundinvdata)) {

            //GET INSERT ID OF INBOUND DATA
            $inboundinventoryid = $this->db->insert_id();
            $returnmessage['insertid'] = $inboundinventoryid;
        }

        //READY ARRAY DATA FOR BATCH INSERT
        /* *
         *
         * $inbounditem = array(
         *    array("ItemID" => ?,
         *          "Qty" => ?,
         *          "InboundId" => ?)
         *   );
         *
         * */

        foreach ($itemid as $key => $i) {
            // Add item array
            $inbounditem[] = array("ItemID" => $i, "Qty" => $itemqty[$key], "InboundId" => $inboundinventoryid);

            // Select Hub Item Qty
            $query = $this->db->select('StockOnHand')->from('spm_hub_inventory')
                ->where('ItemId', $i)
                ->get();
            $row = $query->row();
            $dbqty = $row->StockOnHand;
            $newqty = ($dbqty + $itemqty[$key]);

            $updatehubitem[] = array("ItemId" => $i, "StockOnHand" => $newqty);
        }

        $returnmessage['inbounditem'] = $inbounditem;

        //INSERT INTO TABLE
        $this->db->insert_batch('spm_inbound_inventory_item', $inbounditem);

        $returnmessage['insertbatchquery'] = $this->db->last_query();

        $this->db->update_batch('spm_hub_inventory', $updatehubitem, 'ItemId');

        $returnmessage['updatebatchquery'] = $this->db->last_query();

        $this->db->close();

        return $returnmessage;
    }

    // ------------------------------------------------------------------------
}

/* End of file Spminbound_model.php */
/* Location: ./application/models/Spminbound_model.php */
