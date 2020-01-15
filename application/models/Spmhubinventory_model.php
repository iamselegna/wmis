<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Spmhubinventory_model
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

class Spmhubinventory_model extends CI_Model
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

    /*
     *
     *
     */
    //Calls SPM Hub Inventory Table Stored Procedure *ViewAllSpmHubInventory
    //Display Data to Table
    public function get_all_hub_item($offset, $limit)
    {
        $this->db->reconnect();

        $query = $this->db->query('Call ViewAllSpmHubInventory(' . $offset . ',' . $limit . ')');

        $result = array('tabledata' => $query->result_array(), 'numrows' => $query->num_rows());

        return $result;

        $this->db->close();
    }

    public function get_searched_hub_item($searchItem)
    {
        $this->db->reconnect();

        $query = $this->db->query('CALL SearchSpmHubInventory(' . $searchItem . ')');

        $result = array('tabledata' => $query->result_array(), 'numrows' => $query->num_rows());

        return $result;

        $this->db->close();
    }

    public function add_spm_hub_item()
    {
        $partNo = $this->input->post('partno');
        $result = null;

        $query = $this->db->select('PartNo')
            ->where('PartNo', $partNo)
            ->get('spm_hub_inventory');

        if ($query->num_rows() >= 1) {
            $result = array(
                'error' => true,
                'message' => 'Duplicate Item Found .');
        } else {
            try {
                $this->db->reconnect();
                $this->db->query('Call AddSpmHubInventoryItem(?,?)', array('PartNo' => $partNo, 'LastUpdate' => mdate("%Y-%m-%d", time())));
                $this->db->close();
                $result = array(
                    'error' => false,
                    'message' => 'Add Item Success.');
            } catch (Exception $e) {
                $result = array(
                    'error' => true,
                    'message' => 'Failed to add new item.');
            }
        }

        return $result;
    }

    public function get_spm_hub_item_count()
    {
        $this->db->reconnect();

        $query = $this->db->query('Call GetSpmHubInventoryItemCount()');
        $rows = $query->row();
        if ($rows !== null) {
            $data = array('StockCount' => $rows->StockCount, 'ItemCount' => $rows->ItemCount);
            return $data;
        }
        $this->db->close();
    }

    // ------------------------------------------------------------------------
}

/* End of file Spmhubinventory_model.php */
/* Location: ./application/models/Spmhubinventory_model.php */
