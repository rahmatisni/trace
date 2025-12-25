<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model
{

    var $table = 'list_laporan';
    var $select_column = array(
        'list_laporan.laporan_id',
        'list_laporan.laporan_created_timestamp',
        'list_laporan.laporan_name',
        'list_laporan.laporan_phone_no',
        'list_laporan.laporan_vehicle_category',
        'list_laporan.laporan_problem_category',
        'list_laporan.laporan_plat_no',
        'list_laporan.laporan_ruas_id',
        'list_laporan.laporan_jalur',
        'list_laporan.laporan_description',
        'list_laporan.status_id',
        'list_laporan.cso_id',
        'list_laporan.command_center_id',
        'list_laporan.tic_id',
        'list_laporan.laporan_km',
        'list_laporan.laporan_priority_status_id',
        'management_ruas.ruas_name',
        'management_jenis_kendala.kendala',
        'status_laporan_reference.status_name',
        'a.username as normal_priority_name',
        'list_laporan.created_at as normal_priority_time',
        'b.username as medium_priority_name',
        'list_laporan.laporan_medium_priority_created_timestamp as medium_priority_time',
        'c.username as high_priority_name',
        'list_laporan.laporan_high_priority_created_timestamp as high_priority_time',
        'tbl_feedback.feedback_rate'
    );

    var $order_column = array(
        'laporan_id',
        'laporan_created_timestamp',
        'laporan_name',
        'laporan_phone_no',
        'laporan_vehicle_category',
        'laporan_problem_category',
        'laporan_plat_no',
        'laporan_ruas_id',
        'laporan_jalur',
        'laporan_description',
        'list_laporan.status_id',
        'cso_id',
        'command_center_id',
        'tic_id',
        'laporan_km',
        'laporan_priority_status_id',
        'management_ruas.ruas_name',
        'management_jenis_kendala.kendala',
        'status_laporan_reference.status_name',
        'a.username as normal_priority_name',
        'created_at as normal_priority_time',
        'b.username as medium_priority_name',
        'laporan_medium_priority_created_timestamp as medium_priority_time',
        'c.username as high_priority_name',
        'laporan_high_priority_created_timestamp as high_priority_time'
    );

    var $select_column_n = array(
        'list_laporan.laporan_created_timestamp',
        'list_laporan.laporan_name',
        'list_laporan.laporan_phone_no',
        'management_ruas.ruas_name',
        'list_laporan.laporan_km',
        'list_laporan.laporan_jalur',
        'list_laporan.laporan_description',
        'management_jenis_kendala.kendala',
        'status_laporan_reference.status_name'
    );






    public function make_query($forCount = false)
    {
        // ambil POST sekali
        $status = $this->input->post('status');
        $rating = $this->input->post('rating');
        $ruasi = $this->input->post('ruasi');
        $search = isset($_POST['search']['value']) ? trim($_POST['search']['value']) : '';

        // SELECT: untuk count cukup 1 kolom kecil
        if ($forCount) {
            $this->db->select('list_laporan.laporan_id', false);
        } else {
            $this->db->select($this->select_column);
        }

        $this->db->from($this->table);

        // JOIN (tetap dipakai karena search juga menyentuh ruas/kendala/status/feedback)
        $this->db->join('management_ruas', 'management_ruas.ruas_id = list_laporan.laporan_ruas_id', 'left');
        $this->db->join('management_jenis_kendala', 'management_jenis_kendala.kendala_id = list_laporan.laporan_problem_category', 'left');
        $this->db->join('status_laporan_reference', 'status_laporan_reference.status_id = list_laporan.status_id', 'left');
        $this->db->join('user_management a', 'a.user_id = list_laporan.created_by', 'left');
        $this->db->join('user_management b', 'b.user_id = list_laporan.medium_created_by', 'left');
        $this->db->join('user_management c', 'c.user_id = list_laporan.high_created_by', 'left');
        $this->db->join('tbl_feedback', 'tbl_feedback.blast_url = list_laporan.blast_url', 'left');

        // FILTER status
        // Catatan: status dari form bisa array. Pastikan benar.
        if (!empty($status) && $status != '0') {
            if (is_array($status))
                $status = array_map('intval', $status);
            $this->db->where_in('list_laporan.status_id', $status);
        } else {
            $this->db->where_in('list_laporan.status_id', [5, 6]); // hilangkan spasi di field
        }

        // FILTER rating
        if (!empty($rating) && $rating != '0') {
            $this->db->where('tbl_feedback.feedback_rate', (int) $rating);
        }

        // FILTER ruas
        if (!empty($ruasi) && $ruasi != '0') {
            $this->db->where('list_laporan.laporan_ruas_id', (int) $ruasi);
        }

        // GLOBAL SEARCH
        if ($search !== '') {
            $this->db->group_start();
            $i = 0;
            foreach ($this->select_column_n as $item) {
                // lebih cepat: prefix search (opsional)
                if ($i === 0)
                    $this->db->like($item, $search, 'after');
                else
                    $this->db->or_like($item, $search, 'after');
                $i++;
            }
            $this->db->group_end();
        }

        // ORDER (untuk count, order tidak perlu)
        if (!$forCount) {
            if (isset($_POST["order"])) {
                $colIdx = (int) $_POST['order']['0']['column'];
                $dir = $_POST['order']['0']['dir'] === 'asc' ? 'asc' : 'desc';

                // PENTING: pastikan order_column berisi nama kolom valid (tanpa "AS ...")
                $orderBy = $this->order_column[$colIdx] ?? 'list_laporan.laporan_id';
                $this->db->order_by($orderBy, $dir);
            } else {
                $this->db->order_by("list_laporan.laporan_id", "DESC");
            }
        }
    }

    public function make_datatables()
    {
        $this->make_query(false);
        if ((int) $_POST["length"] != -1) {
            $this->db->limit((int) $_POST['length'], (int) $_POST['start']);
        }
        return $this->db->get()->result();
    }

    public function get_filtered_data()
    {
        $this->make_query(true);
        return $this->db->count_all_results(); // jauh lebih cepat
    }

    // public function make_query()
    // {

    //     $this->db->select($this->select_column);
    //     $this->db->from($this->table);
    //     $this->db->join('management_ruas', 'management_ruas.ruas_id = list_laporan.laporan_ruas_id','left');
    //     $this->db->join('management_jenis_kendala', 'management_jenis_kendala.kendala_id = list_laporan.laporan_problem_category','left');
    //     $this->db->join('status_laporan_reference', 'status_laporan_reference.status_id = list_laporan.status_id','left');
    //     $this->db->join('user_management a', 'a.user_id = list_laporan.created_by','left');
    //     $this->db->join('user_management b', 'b.user_id = list_laporan.medium_created_by','left');
    //     $this->db->join('user_management c', 'c.user_id = list_laporan.high_created_by','left');
    //     $this->db->join('tbl_feedback', 'tbl_feedback.blast_url = list_laporan.blast_url','left');


    //     if($this->input->post('status')!='0')
    // 	{
    // 		$this->db->where_in('list_laporan.status_id', $this->input->post('status'));
    //     }else
    //     {
    //         $acc = array(5,6);
    //         $this->db->where_in('list_laporan.status_id ', $acc);
    //     }

    //     if($this->input->post('rating')!='0')
    // 	{
    // 		$this->db->where('tbl_feedback.feedback_rate', $this->input->post('rating'));
    //     }

    //     if($this->input->post('ruasi')!='0')
    // 	{
    // 		$this->db->where('list_laporan.laporan_ruas_id', $this->input->post('ruasi'));
    //     }


    //     $i = 0;

    // 	foreach ($this->select_column_n as $item) // loop column 
    // 	{
    // 		if($_POST['search']['value']) // if datatable send POST for search
    // 		{

    // 			if($i===0) // first loop
    // 			{
    // 				 $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
    // 				 $this->db->like($item, $_POST['search']['value']);
    // 			}
    // 			else
    // 			{
    // 				 $this->db->or_like($item, $_POST['search']['value']);
    // 			}

    // 			if(count($this->select_column_n) - 1 == $i) //last loop
    // 				 $this->db->group_end(); //close bracket
    // 		}

    // 		$i++;
    // 	}


    //     if(isset($_POST["order"]))
    //     {
    //          $this->db->order_by($this->order_column[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
    //     }
    //     else
    //     {
    //          $this->db->order_by("laporan_id","DESC");
    //     }

    // }

    // public function make_datatables()
    // {
    //     $this->make_query();
    //     if($_POST["length"] != -1)
    //     {
    //          $this->db->limit($_POST['length'], $_POST['start']);
    //     }
    //     $query=  $this->db->get();
    //     return $query->result();
    // }

    // public function get_filtered_data()
    // {
    //     $this->make_query();
    //     $query= $this->db->get();
    //     return $query->num_rows();
    // }

    public function get_all_data()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }






}