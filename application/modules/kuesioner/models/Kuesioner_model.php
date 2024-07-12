<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kuesioner_model extends CI_Model {

    public function cekActiveToken($token)
    {
        $this->db->select('laporan_id,laporan_name');
        $this->db->from('list_laporan');
        $this->db->where('blast_url', $token);
        $this->db->where('blast_state',0);

        return $this->db->get()->row(); 
    }

    


}