<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// class Laporan_model extends CI_Model {
    
//     var $table              = 'list_laporan';
//     var $select_column      = array('list_laporan.laporan_id','list_laporan.laporan_created_timestamp','list_laporan.laporan_name','list_laporan.laporan_phone_no','list_laporan.laporan_vehicle_category','list_laporan.laporan_problem_category','list_laporan.laporan_plat_no','list_laporan.laporan_ruas_id','list_laporan.laporan_jalur','list_laporan.laporan_description',
//                                     'list_laporan.status_id','list_laporan.cso_id','list_laporan.command_center_id','list_laporan.tic_id','list_laporan.laporan_km','list_laporan.laporan_priority_status_id','management_ruas.ruas_name','management_jenis_kendala.kendala','status_laporan_reference.status_name',
//                                     'a.username as normal_priority_name','list_laporan.created_at as normal_priority_time','b.username as medium_priority_name','list_laporan.laporan_medium_priority_created_timestamp as medium_priority_time',
//                                     'c.username as high_priority_name','list_laporan.laporan_high_priority_created_timestamp as high_priority_time','tbl_feedback.feedback_rate');

//     var $order_column       = array('laporan_id','laporan_created_timestamp','laporan_name','laporan_phone_no','laporan_vehicle_category','laporan_problem_category','laporan_plat_no','laporan_ruas_id','laporan_jalur','laporan_description',
//                                     'list_laporan.status_id','cso_id','command_center_id','tic_id','laporan_km','laporan_priority_status_id','management_ruas.ruas_name','management_jenis_kendala.kendala','status_laporan_reference.status_name',
//                                     'a.username as normal_priority_name','created_at as normal_priority_time','b.username as medium_priority_name','laporan_medium_priority_created_timestamp as medium_priority_time',
//                                     'c.username as high_priority_name','laporan_high_priority_created_timestamp as high_priority_time');

//     var $select_column_n      = array('list_laporan.laporan_created_timestamp','list_laporan.laporan_name','list_laporan.laporan_phone_no','management_ruas.ruas_name','list_laporan.laporan_km',
//                                       'list_laporan.laporan_jalur','list_laporan.laporan_description','management_jenis_kendala.kendala','status_laporan_reference.status_name');

//     public function make_query()
//     {
      
//         $this->db->select($this->select_column);
//         $this->db->from($this->table);
//         $this->db->join('management_ruas', 'management_ruas.ruas_id = list_laporan.laporan_ruas_id','left');
//         $this->db->join('management_jenis_kendala', 'management_jenis_kendala.kendala_id = list_laporan.laporan_problem_category','left');
//         $this->db->join('status_laporan_reference', 'status_laporan_reference.status_id = list_laporan.status_id','left');
//         $this->db->join('user_management a', 'a.user_id = list_laporan.created_by','left');
//         $this->db->join('user_management b', 'b.user_id = list_laporan.medium_created_by','left');
//         $this->db->join('user_management c', 'c.user_id = list_laporan.high_created_by','left');
//         $this->db->join('tbl_feedback', 'tbl_feedback.blast_url = list_laporan.blast_url','left');
      

//         if($this->input->post('status')!='0')
// 		{
// 			$this->db->where_in('list_laporan.status_id', $this->input->post('status'));
//         }else
//         {
//             $acc = array(5,6);
//             $this->db->where_in('list_laporan.status_id ', $acc);
//         }

//         if($this->input->post('rating')!='0')
// 		{
// 			$this->db->where('tbl_feedback.feedback_rate', $this->input->post('rating'));
//         }

//         if($this->input->post('ruasi')!='0')
// 		{
// 			$this->db->where('list_laporan.laporan_ruas_id', $this->input->post('ruasi'));
//         }


//         $i = 0;
	
// 		foreach ($this->select_column_n as $item) // loop column 
// 		{
// 			if($_POST['search']['value']) // if datatable send POST for search
// 			{
				
// 				if($i===0) // first loop
// 				{
// 					 $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
// 					 $this->db->like($item, $_POST['search']['value']);
// 				}
// 				else
// 				{
// 					 $this->db->or_like($item, $_POST['search']['value']);
// 				}

// 				if(count($this->select_column_n) - 1 == $i) //last loop
// 					 $this->db->group_end(); //close bracket
// 			}

// 			$i++;
// 		}
       
        
//         if(isset($_POST["order"]))
//         {
//              $this->db->order_by($this->order_column[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
//         }
//         else
//         {
//              $this->db->order_by("laporan_id","DESC");
//         }
        
//     }

//     public function make_datatables()
//     {
//         $this->make_query();
//         if($_POST["length"] != -1)
//         {
//              $this->db->limit($_POST['length'], $_POST['start']);
//         }
//         $query=  $this->db->get();
//         return $query->result();
//     }

//     public function get_filtered_data()
//     {
//         $this->make_query();
//         $query= $this->db->get();
//         return $query->num_rows();
//     }

//     public function get_all_data()
//     {
//          $this->db->select('*');
//          $this->db->from($this->table);
//         return  $this->db->count_all_results();
//     }

    




// }

// <?php
// defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
    /** @var string */
    protected $table = 'list_laporan';

    /**
     * Datatables: columns selected from DB
     * NOTE: keep aliases consistent with frontend needs.
     * @var array
     */
    protected $selectColumns = [
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

        'a.username AS normal_priority_name',
        'list_laporan.created_at AS normal_priority_time',

        'b.username AS medium_priority_name',
        'list_laporan.laporan_medium_priority_created_timestamp AS medium_priority_time',

        'c.username AS high_priority_name',
        'list_laporan.laporan_high_priority_created_timestamp AS high_priority_time',

        'tbl_feedback.feedback_rate',
    ];

    /**
     * Datatables: columns that can be ordered
     * IMPORTANT: these must be valid DB expressions (no "AS alias" here).
     * The index must match the DataTables "column index" from the frontend.
     * @var array
     */
    protected $orderableColumns = [
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
        'a.username',
        'list_laporan.created_at',
        'b.username',
        'list_laporan.laporan_medium_priority_created_timestamp',
        'c.username',
        'list_laporan.laporan_high_priority_created_timestamp',
        'tbl_feedback.feedback_rate',
    ];

    /**
     * Datatables: columns included in global search
     * @var array
     */
    protected $searchableColumns = [
        'list_laporan.laporan_created_timestamp',
        'list_laporan.laporan_name',
        'list_laporan.laporan_phone_no',
        'management_ruas.ruas_name',
        'list_laporan.laporan_km',
        'list_laporan.laporan_jalur',
        'list_laporan.laporan_description',
        'management_jenis_kendala.kendala',
        'status_laporan_reference.status_name',
    ];

    /** @var int[] default accepted status when status == 0 */
    protected $defaultStatusIds = [5, 6];

    /**
     * Build base query + joins
     */
    protected function baseQuery(): void
    {
        $this->db->select($this->selectColumns, false);
        $this->db->from($this->table);

        $this->db->join('management_ruas', 'management_ruas.ruas_id = list_laporan.laporan_ruas_id', 'left');
        $this->db->join('management_jenis_kendala', 'management_jenis_kendala.kendala_id = list_laporan.laporan_problem_category', 'left');
        $this->db->join('status_laporan_reference', 'status_laporan_reference.status_id = list_laporan.status_id', 'left');

        $this->db->join('user_management a', 'a.user_id = list_laporan.created_by', 'left');
        $this->db->join('user_management b', 'b.user_id = list_laporan.medium_created_by', 'left');
        $this->db->join('user_management c', 'c.user_id = list_laporan.high_created_by', 'left');

        $this->db->join('tbl_feedback', 'tbl_feedback.blast_url = list_laporan.blast_url', 'left');
    }

    /**
     * Apply filters coming from POST (status, rating, ruasi)
     */
    protected function applyFilters(array $post): void
    {
        // status can be: "0" or array of ids or single id
        $status = $post['status'] ?? '0';

        if (is_array($status)) {
            // if array contains only '0' or is empty -> default
            $status = array_values(array_filter($status, static function ($v) {
                return $v !== null && $v !== '' && $v !== '0' && $v !== 0;
            }));

            if (!empty($status)) {
                $this->db->where_in('list_laporan.status_id', $status);
            } else {
                $this->db->where_in('list_laporan.status_id', $this->defaultStatusIds);
            }
        } else {
            if ((string)$status !== '0' && $status !== null && $status !== '') {
                $this->db->where_in('list_laporan.status_id', [(int)$status]);
            } else {
                $this->db->where_in('list_laporan.status_id', $this->defaultStatusIds);
            }
        }

        $rating = $post['rating'] ?? '0';
        if ((string)$rating !== '0' && $rating !== null && $rating !== '') {
            $this->db->where('tbl_feedback.feedback_rate', $rating);
        }

        $ruasId = $post['ruasi'] ?? '0';
        if ((string)$ruasId !== '0' && $ruasId !== null && $ruasId !== '') {
            $this->db->where('list_laporan.laporan_ruas_id', $ruasId);
        }
    }

    /**
     * Apply DataTables global search
     */
    protected function applySearch(array $post): void
    {
        $searchValue = $post['search']['value'] ?? '';
        $searchValue = is_string($searchValue) ? trim($searchValue) : '';

        if ($searchValue === '') {
            return;
        }

        $this->db->group_start();
        foreach ($this->searchableColumns as $idx => $col) {
            if ($idx === 0) {
                $this->db->like($col, $searchValue);
            } else {
                $this->db->or_like($col, $searchValue);
            }
        }
        $this->db->group_end();
    }

    /**
     * Apply DataTables ordering safely
     */
    protected function applyOrder(array $post): void
    {
        $order = $post['order'][0] ?? null;

        if (is_array($order)) {
            $colIndex = isset($order['column']) ? (int)$order['column'] : null;
            $dir      = isset($order['dir']) ? strtolower((string)$order['dir']) : 'desc';
            $dir      = in_array($dir, ['asc', 'desc'], true) ? $dir : 'desc';

            if ($colIndex !== null && isset($this->orderableColumns[$colIndex])) {
                $this->db->order_by($this->orderableColumns[$colIndex], $dir);
                return;
            }
        }

        // default order
        $this->db->order_by('list_laporan.laporan_id', 'DESC');
    }

    /**
     * Unified builder for datatables query
     */
    protected function buildDatatablesQuery(array $post): void
    {
        $this->baseQuery();
        $this->applyFilters($post);
        $this->applySearch($post);
        $this->applyOrder($post);
    }

    /**
     * DataTables: result set
     */
    public function make_datatables(): array
    {
        // CI input with XSS filtering enabled (2nd param true) for scalars.
        // For arrays (datatable payload), we read raw POST and sanitize where needed.
        $post = $this->input->post(NULL, true);
        if (!is_array($post)) {
            $post = $_POST ?? [];
        }

        $this->buildDatatablesQuery($post);

        $length = isset($post['length']) ? (int)$post['length'] : 10;
        $start  = isset($post['start']) ? (int)$post['start'] : 0;

        if ($length !== -1) {
            $length = ($length > 0) ? $length : 10;
            $start  = ($start >= 0) ? $start : 0;
            $this->db->limit($length, $start);
        } else {
            $this->db->limit(10);
        }

        return $this->db->get()->result();
    }

    /**
     * DataTables: recordsFiltered
     */
    public function get_filtered_data(): int
    {
        $post = $this->input->post(NULL, true);
        if (!is_array($post)) {
            $post = $_POST ?? [];
        }

        $this->buildDatatablesQuery($post);

        return $this->db->get()->num_rows();
    }

    /**
     * DataTables: recordsTotal (kept same behavior as your original: count all rows in table)
     */
    public function get_all_data(): int
    {
        return (int)$this->db->count_all($this->table);
    }
}
