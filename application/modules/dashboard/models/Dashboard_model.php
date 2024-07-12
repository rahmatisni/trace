<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function getAllPendapatan()
    {
        $sql="SELECT sum(pay_tarif) total FROM tbl_transaksi";
        $query = $this->db->query($sql);

        return $query->result();
    }

    public function getAllEntrance()
    {
        $sql="SELECT count(id) total FROM tbl_transaksi where ent_waktu is not null";
        $query = $this->db->query($sql);

        return $query->result();
    }

    public function getAllExit()
    {
        $sql="SELECT count(id) total FROM tbl_transaksi where exit_waktu is not null";
        $query = $this->db->query($sql);

        return $query->result();
    }

    public function getAllPaySoF()
    {
        return 0;
    }


}