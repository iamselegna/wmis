<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Spmoutbound_model
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

class Spmoutbound_model extends CI_Model
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

    public function insert_outbound()
    {
        $this->db->reconnect();

        /**
         * Get current UNIX Timestamp base on time_reference Asia/Manila
         */
        $logdate = now();

        /**
         * Select wmdrno series on wmdrcontrol table
         * and increment current value
         */
        $query = $this->get_queries("SELECT Value FROM wmdrcontrol WHERE Type = 'spmwmdr';");
        $wmdrrow = $query->row();
        $wmdrno = ($wmdrrow->Value + 1);

        /**
         * Generate Universal Uniquer Identifier "UUID"
         * This will be the value of OutboundId
         * for current outbound inventory and items
         */
        $uid_query = $this->get_queries("SELECT UUID() as id;");
        $uuidrow = $uid_query->row();
        $uuid = $uuidrow->id;

        /**
         * Ready insert data for outbound inventory
         */
        $data = array('OutboundId' => $uuid,
            'ApcDrNo' => $this->input->post('apcdrno'),
            'WmDrNo' => $wmdrno,
            'DateOut' => $this->input->post('dateout'),
            'FacilityID' => $this->input->post('facilityid'),
            'VehicleId' => $this->input->post('vehicleid'),
            'LogDate' => mdate('%Y-%m-%d %H:%i:%s', $logdate),
            'ControlSeries' => mdate('%Y-%m', $logdate)
        );

        /**
         * Insert data to table spm_outbound_inventory
         */
        $result = $this->db->insert('spm_outbound_inventory', $data);

        /**
         * Update wmdrcontrol table
         * Where Type = spmwmdr
         * Set new incremented value
         */
        $this->db->set('Value', $wmdrno)
        ->where('Type', 'spmwmdr')
        ->update('wmdrcontrol');

        /**
         * Ready outbound items for batch insert
         *
         */
        $outbounditems = array();
        $updatehubitems = array();

        $itemid = $this->input->post('itemid');
        $itemqty = $this->input->post('itemqty');

        foreach ($itemid as $key => $value) {

          //Add item(s) to $outbounditems array
            $outbounditems[] = array('ItemID' => $value, 'Qty' => $itemqty[$key], 'OutboundId' => $uuid);

            // Select Hub Item Qty
            $query2 = $this->db->select('StockOnHand')->from('spm_hub_inventory')
                ->where('ItemId', $value)
                ->get();
            $row2 = $query2->row();
            $dbqty = $row2->StockOnHand;
            $newqty = ($dbqty - $itemqty[$key]);

            $updatehubitems[] = array("ItemId" => $value, "StockOnHand" => $newqty, "LastUpdate" => mdate("%Y-%m-%d", time()));
        }

        $this->db->insert_batch('spm_outbound_inventory_item', $outbounditems);

        $this->db->update_batch('spm_hub_inventory', $updatehubitems, 'ItemId');



        $this->db->close();

        return $result;
    }

    public function insert_batch_item($data)
    {
        $query = $this->db->insert_batch('spm_outbound_inventory_item', $data);
    }

    public function get_queries($queries)
    {
        /**
         * Run queries and return result
         */
        $query = $this->db->query($queries);
        return $query;
    }

    // ------------------------------------------------------------------------
}

/* End of file Spmoutbound_model.php */
/* Location: ./application/models/Spmoutbound_model.php */
