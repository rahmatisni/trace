<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tic_model extends CI_Model
{


    public function getRuasOption()
    {
        $this->db->select('*');
        $this->db->from('management_ruas');
        $this->db->order_by("ruas_id", "asc");
        return $this->db->get()->result();
    }

    public function getRuasOptionByGroup($ruas)
    {
        $this->db->select('*');
        $this->db->from('management_ruas');

        if ($ruas > 0) {
            $this->db->where('ruas_group', $ruas);
        } else {
            $this->db->where('ruas_id', $this->session->ruas);
        }

        $this->db->order_by("ruas_id", "asc");
        return $this->db->get()->result();
    }

    public function getKendaraanOption($ruas, $id)
    {
        $this->db->select('*');
        $this->db->from('kendaraan');
        $this->db->where('ruas_id', $ruas);

        if ($id > 0) {
            $this->db->where('kendaraan_jenis', $id);
        }

        //$this->db->where('onduty',0);
        return $this->db->get()->result();
    }

    public function petugasArrivedModel($data)
    {
        $this->db->set('laporan_petugas_arrived_timestamp', date('Y-m-d H:i:s'));
        $this->db->set('status_id', 4);
        $this->db->where('laporan_id', $data['laporan_id']);
        $update = $this->db->update('list_laporan');
        return $update;
    }

    public function petugasDoneModel($data)
    {

        $sql = "select * from list_laporan where laporan_id=" . $data['laporan_id'];
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $datax = $query->row();

            if ($datax->status_id == 4) {
                $this->db->set('laporan_closed_timestamp', date('Y-m-d H:i:s'));
                $this->db->set('status_id', 5);
                $this->db->where('laporan_id', $data['laporan_id']);
                $update = $this->db->update('list_laporan');
                $data_petugas_arr = json_decode($datax->data_petugas_id);
                foreach ($data_petugas_arr as $row) {
                    $this->db->set('waktu_selesai', date('Y-m-d H:i:s'));
                    $this->db->set('tic_done_id', $data['user_id']);
                    $this->db->where('laporan_id', $data['laporan_id']);
                    $this->db->where('petugas_id', $row);
                    $this->db->where('ruas_id', $data['ruas_id']);
                    $update = $this->db->update('tbl_operasional_petugas');
                }
                            // DUMMY V1.2

                if ($datax->kendaraan_assigned != '[]') {
                    $kend = json_decode($datax->kendaraan_assigned);
                    foreach ($kend as $row) {
                        $this->db->set('status', 0);
                        $this->db->where('kendaraan_id', $row);
                        $update = $this->db->update('kendaraan');
                    }
                }


            } else if ($datax->status_id == 3) {
                $this->db->set('laporan_closed_timestamp', date('Y-m-d H:i:s'));
                $this->db->set('status_id', 6);
                $this->db->where('laporan_id', $data['laporan_id']);
                $update = $this->db->update('list_laporan');
                // DUMMY V1.2
                if ($datax->kendaraan_assigned != '[]') {
                    $kend = json_decode($datax->kendaraan_assigned);
                    foreach ($kend as $row) {
                        $this->db->set('status', 0);
                        $this->db->where('kendaraan_id', $row);
                        $update = $this->db->update('kendaraan');
                    }
                }
            }
            // DUMMY V1.2
            else {
                $update = false;
            }


            // if ($datax->kendaraan_assigned != '[]') {
            //     $kend = json_decode($datax->kendaraan_assigned);
            //     foreach ($kend as $row) {
            //         $this->db->set('status', 0);
            //         $this->db->where('kendaraan_id', $row);
            //         $update = $this->db->update('kendaraan');
            //     }
            // }

        } else {
            $update = false;
        }

        return $update;
    }

    public function getFormasiKendaraanOption($ruas, $id)
    {
        $this->db->select('data_petugas.kendaraan_id,kendaraan.kendaraan_nomor');
        $this->db->from('data_petugas');
        $this->db->join('kendaraan', 'kendaraan.kendaraan_id=data_petugas.kendaraan_id', 'left');
        $this->db->where('data_petugas.ruas_id', $ruas);
        $this->db->where('kendaraan.status', 0);

        if ($id > 0) {
            $this->db->where('kendaraan.kendaraan_jenis', $id);
        }

        //$this->db->where('onduty',0);
        return $this->db->get()->result();
    }

    public function getJenisKendaraan()
    {
        $this->db->select('*');
        $this->db->from('management_jenis_kendaraan');
        //$this->db->order_by('jenis_kendaraan_id','desc');

        //$this->db->where('onduty',0);
        return $this->db->get()->result();
    }

    public function getPetugasOption($ruas, $jenis)
    {
        $this->db->select('*');
        $this->db->from('management_petugas');
        $this->db->where('ruas_id', $ruas);
        $this->db->where('jenis_petugas', $jenis);
        //$this->db->where('onduty',0);
        return $this->db->get()->result();
    }

    public function getPetugasKeduaOption($ruas, $id, $jenis)
    {
        $this->db->select('*');
        $this->db->from('management_petugas');
        $this->db->where('ruas_id', $ruas);
        $this->db->where('jenis_petugas', $jenis);
        $this->db->where('id_petugas !=', $id);
        //$this->db->where('onduty',0);
        return $this->db->get()->result();
    }

    public function getDetailKendaraanModel($data)
    {
        if ($data == null) {
            $result = array();
            $temp = array(
                'jenis_kendaraan' => '-',
                'kendaraan_nomor' => '-',
                'nama_petugas1' => '-',
                'npp_petugas1' => '-',
                'nama_petugas2' => '-',
                'npp_petugas2' => '-'
            );
            array_push($result, $temp);
            return $result;
        } else {

            $data = json_decode($data);
            $result = array();

            foreach ($data as $row) {
                $sql = "select a.kendaraan_id,f.jenis_kendaraan,b.kendaraan_jenis,b.kendaraan_nomor,c.nama_petugas nama_petugas1,c.npp_petugas npp_petugas1,d.nama_petugas nama_petugas2,d.npp_petugas npp_petugas2 
                from data_petugas a 
                left join kendaraan b on b.kendaraan_id=a.kendaraan_id
                left join management_petugas c on c.id_petugas=a.npp_petugas_1
                left join management_petugas d on d.id_petugas=a.npp_petugas_2
                left join management_jenis_kendaraan f on f.jenis_kendaraan_id=b.kendaraan_jenis
                where a.isdeleted=0 and a.kendaraan_id=" . $row;

                $query = $this->db->query($sql);
                $res = $query->row();

                if ($query->num_rows() >= 1) {
                    array_push($result, $res);
                } else {
                    $temp = array(
                        'jenis_kendaraan' => 'Data Missmatch',
                        'kendaraan_nomor' => 'Data Missmatch',
                        'nama_petugas1' => 'Data Missmatch',
                        'npp_petugas1' => 'Data Missmatch',
                        'nama_petugas2' => 'Data Missmatch',
                        'npp_petugas2' => 'Data Missmatch'
                    );

                    array_push($result, $temp);
                }

            }

            return $result;

        }


    }


    public function assignFormasiModel($data)
    {
        if ($data['id'] != '0') {

            $kendaraan1 = array_merge((array) $data['cs'], (array) $data['ambulance'], (array) $data['rescue'], (array) $data['derek']);
            $kendaraan = json_encode($kendaraan1);


            if ($kendaraan == '[]') {
                $result = array('status' => false, 'keterangan' => 'Data Petugas Tidak Boleh Kosong');
            } else {

                //DELETE OLD DATA
                $query = $this->db->query("select kendaraan_assigned from list_laporan where laporan_id=" . $data['id']);
                $old_kend = $query->row();
                $old_kendaraan = json_decode($old_kend->kendaraan_assigned);

                foreach ($old_kendaraan as $ta) {
                    $query = $this->db->simple_query("update kendaraan set status=0 where kendaraan_id=" . $ta);
                }



                // DELETE all old data in operasional tugas
                $this->db->where('laporan_id', $data['id']);
                $this->db->where('ruas_id', $data['ruas_id']);
                $this->db->delete('tbl_operasional_petugas');


                //INSERT NEW DATA            
                $data_petugas_id = array();
                foreach ($kendaraan1 as $row) {

                    //update ONDUTY KENDARAAN
                    $this->db->set('status', 1);
                    $this->db->where('kendaraan_id', $row);
                    $update = $this->db->update('kendaraan');

                    //select petugas  id in data petugas
                    $query = $this->db->query("select * from data_petugas where isdeleted=0 and ruas_id='" . $data['ruas_id'] . "' and kendaraan_id=" . $row);
                    $res = $query->row();

                    if (!empty($res->npp_petugas_1)) {

                        //insert operasional tugas npp1
                        $ojek = array(
                            'ruas_id' => $res->ruas_id,
                            'tic_assign_id' => $data['user_id'],
                            'petugas_id' => $res->npp_petugas_1,
                            'laporan_id' => $data['id'],
                            'waktu_mulai' => date('Y-m-d H:i:s')
                        );

                        $this->db->insert('tbl_operasional_petugas', $ojek);


                        array_push($data_petugas_id, $res->npp_petugas_1);
                    }

                    if (!empty($res->npp_petugas_2)) {

                        //insert operasional tugas npp2
                        $ojek = array(
                            'ruas_id' => $res->ruas_id,
                            'tic_assign_id' => $data['user_id'],
                            'petugas_id' => $res->npp_petugas_2,
                            'laporan_id' => $data['id'],
                            'waktu_mulai' => date('Y-m-d H:i:s')
                        );

                        $this->db->insert('tbl_operasional_petugas', $ojek);

                        array_push($data_petugas_id, $res->npp_petugas_2);
                    }

                    $this->db->set('laporan_forward_to_petugas_timestamp', date('Y-m-d H:i:s'));
                    $this->db->set('status_id', 3);
                    $this->db->set('kendaraan_assigned', $kendaraan);
                    $this->db->set('data_petugas_id', json_encode($data_petugas_id));
                    $this->db->set('tic_id', $this->session->npp);
                    $this->db->where('laporan_id=', $data['id']);
                    $this->db->update('list_laporan');
                }








                $result = array('status' => true, 'keterangan' => 'Data Berhasil di Assigned', 'data' => $kendaraan1);

            }

            return $result;

        } else {
            return false;
        }


    }

    public function getKendalaOption()
    {
        $this->db->select('*');
        $this->db->from('management_jenis_kendala');
        return $this->db->get()->result();
    }

    public function getKendaraanDetailModel($data)
    {
        $this->db->select('*');
        $this->db->from('kendaraan');
        $this->db->where('ruas_id', $data['ruas']);
        $this->db->where('kendaraan_id', $data['id']);
        $select = $this->db->get()->row();

        return $select;
    }

    public function getPetugasDetailModel($data)
    {
        $this->db->select('*');
        $this->db->from('management_petugas');
        $this->db->where('ruas_id', $data['ruas']);
        $this->db->where('npp_petugas', $data['npp']);
        $select = $this->db->get()->row();

        return $select;
    }

    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getDetailLaporanModel($data)
    {
        $this->db->select('*');
        $this->db->from('list_laporan');
        $this->db->where('laporan_created_timestamp', $data['waktu']);
        $this->db->where('laporan_phone_no', $data['hp']);
        $this->db->where('laporan_plat_no', $data['nopol']);
        return $this->db->get()->row();
    }

    public function EditFormasiModel($data)
    {
        $sql = "select * from data_petugas where isdeleted=0 and ( npp_petugas_1='" . $data['petugas1'] . "' or npp_petugas_1=" . $data['petugas2'] . " or
        npp_petugas_2='" . $data['petugas1'] . "' or npp_petugas_2=" . $data['petugas2'] . "
        and ruas_id=" . $data['ruas'] . ")";
        $cek_duplicate = $this->db->query($sql);
        if ($cek_duplicate->num_rows() > 0) {
            //$result=array('event'=>'duplicate','status'=>false,'keterangan'=>'Petugas Telah Bertugas');
            return false;
        }

        $this->db->set('npp_petugas_1', $data['petugas1']);
        $this->db->set('npp_petugas_2', $data['petugas2']);
        $this->db->where('data_petugas_id', $data['id']);
        $update = $this->db->update('data_petugas');

        return $update;
    }

    public function AddOrEditFormasiModel($data)
    {

        if ($data['petugas2'] == '') {
            $sql = "select * from data_petugas where isdeleted=0 and ruas_id=" . $data['ruas'] . " and ( npp_petugas_1='" . $data['petugas1'] . "' )";
        } else {
            $sql = "select * from data_petugas where isdeleted=0 and ruas_id=" . $data['ruas'] . " and ( npp_petugas_1='" . $data['petugas1'] . "' or npp_petugas_1='" . $data['petugas2'] . "' or
            npp_petugas_2='" . $data['petugas1'] . "' or npp_petugas_2='" . $data['petugas2'] . "')";
        }

        $cek_duplicate = $this->db->query($sql);
        if ($cek_duplicate->num_rows() > 0) {
            $result = array('event' => 'duplicate', 'status' => false, 'keterangan' => 'Petugas Telah Bertugas');
            return $result;
        }


        if ($data['id'] == '0') {
            //insert data

            //check before
            $sql = "select * from data_petugas left join kendaraan on kendaraan.kendaraan_id=data_petugas.kendaraan_id
            where data_petugas.kendaraan_id=" . $data['kendaraan_id'] . " and
            data_petugas.ruas_id=" . $data['ruas'] . " and
            kendaraan.kendaraan_nomor='" . $data['kendaraan_nomor'] . "' and isdeleted=0 ";

            $query = $this->db->query($sql)->num_rows();

            //fresh insert
            if ($query > 0) {
                $result = array('event' => 'tambah', 'status' => false, 'keterangan' => 'Data Sudah Ada Dalam Formasi');
                return $result;
            }

            // $sql="insert into data_petugas (kendaraan_id,ruas_id,group_ruas,npp_petugas_1,npp_petugas_2,created_by)
            //         values (".$data['kendaraan_id'].",".$data['ruas'].",".$data['group_ruas'].",'".$data['petugas1']."',
            //         '".$data['petugas2']."',".$this->session->user_id.")";

            if ($data['petugas2'] == '') {
                $pt = "npp_petugas_2=NULL";
            } else {
                $pt = "npp_petugas_2='" . $data['petugas2'] . "'";
            }
            $sql = "insert into data_petugas set kendaraan_id=" . $data['kendaraan_id'] . ",
                                                ruas_id=" . $data['ruas'] . ",
                                                group_ruas=" . $data['group_ruas'] . ",
                                                npp_petugas_1='" . $data['petugas1'] . "',                                           
                                                created_by=" . $this->session->user_id . ",$pt";

            $query = $this->db->query($sql);
            $result = array('event' => 'tambah', 'status' => $query, 'keterangan' => 'Berhasil menambahkan Petugas');
            return $result;


        } else {
            //update data
            return '1';

        }

    }

    public function AddOrEditPetugasModel($data)
    {


        if ($data['id'] == '0') {

            $sql = "select * from management_petugas where npp_petugas='" . $data['nik'] . "' and ruas_id=" . $data['ruas'];
            $cek_duplicate = $this->db->query($sql);
            if ($cek_duplicate->num_rows() > 0) {
                $result = array('event' => 'duplicate', 'status' => false);
                return $result;
            }

            $datas = array(
                'nama_petugas' => $data['nama'],
                'jenis_petugas' => $data['jenis'],
                'ruas_id' => $data['ruas'],
                'ruas_group_id' => $data['group_ruas'],
                'nik_petugas' => $data['nik'],
                'npp_petugas' => $data['nik'],
                'no_hp' => $data['hp']
            );

            $insert = $this->db->insert('management_petugas', $datas);

            $result = array('event' => 'insert', 'status' => $insert);
            return $result;
        } else {
            $datas = array(
                'id_petugas' => $data['id'],
                'nama_petugas' => $data['nama'],
                'jenis_petugas' => $data['jenis'],
                'ruas_id' => $data['ruas'],
                'ruas_group_id' => $data['group_ruas'],
                'nik_petugas' => $data['nik'],
                'npp_petugas' => $data['nik'],
                'no_hp' => $data['hp']
            );

            $replace = $this->db->replace('management_petugas', $datas);
            $result = array('event' => 'update', 'status' => $replace);
            return $result;

        }

    }

    public function AddOrEditKendaraanModel($data)
    {

        $sql = "select * from kendaraan where kendaraan_nomor='" . $data['kode'] . "' and kendaraan_jenis=" . $data['jenis'] . " and ruas_id=" . $data['ruas'];
        $cek_duplicate = $this->db->query($sql);
        if ($cek_duplicate->num_rows() > 0) {
            return false;
        }


        if ($data['id'] == '0') {
            $datas = array(
                'kendaraan_jenis' => $data['jenis'],
                'kendaraan_nomor' => $data['kode'],
                'ruas_id' => $data['ruas'],
                'group_ruas' => $data['group_ruas']
            );

            $insert = $this->db->insert('kendaraan', $datas);

            return $insert;
        } else {

            $this->db->set('kendaraan_jenis', $data['jenis']);
            $this->db->set('kendaraan_nomor', $data['kode']);
            $this->db->where('ruas_id', $data['ruas']);
            $this->db->where('kendaraan_id', $data['id']);
            $update = $this->db->update('kendaraan');

            return $update;
        }

    }

    public function getKendaraanExistingModel($data)
    {
        $this->db->select('kendaraan_assigned');
        $this->db->from('list_laporan');
        $this->db->where('laporan_id', $data['id']);
        $item = $this->db->get()->row();

        return $item->kendaraan_assigned;
    }

    public function getKendaraanAvailableModel($ruas, $jenis)
    {
        $sql = 'select a.kendaraan_id,b.kendaraan_nomor from data_petugas a 
                left join kendaraan b on a.kendaraan_id=b.kendaraan_id 
                WHERE b.`status`= 0 and a.isdeleted=0 and b.kendaraan_jenis=' . $jenis . ' and a.ruas_id=' . $ruas . '';

        $query = $this->db->query($sql);

        return $query->result();
    }

    public function getKendaraanNumberModel($id)
    {
        $this->db->select('*');
        $this->db->from('kendaraan');
        $this->db->where('kendaraan_id', $id);
        return $this->db->get()->row();
    }

    public function deleteKendaraanModel($data)
    {
        $this->db->where('kendaraan_id', $data['id']);
        $this->db->where('ruas_id', $data['ruas_id']);
        $del = $this->db->delete('kendaraan');

        return $del;
    }

    public function deletePetugasModel($data)
    {
        $this->db->where('npp_petugas', $data['npp']);
        $this->db->where('ruas_id', $data['ruas']);
        $del = $this->db->delete('management_petugas');

        return $del;
    }

    public function getFormasiDetailModel($data)
    {
        $sql = 'select a.*,b.status,b.kendaraan_jenis,b.kendaraan_id as knd_id from data_petugas a 
        left join kendaraan b on a.kendaraan_id=b.kendaraan_id 
        WHERE a.data_petugas_id=' . $data['id'];

        $query = $this->db->query($sql);

        return $query->row();
    }

    public function deleteFormasiModel($data)
    {
        $this->db->set('isdeleted', 1);
        $this->db->where('data_petugas_id', $data['id']);
        $del = $this->db->update('data_petugas');

        return $del;
    }

    public function resetFormasiModel($data)
    {

        $sql = 'select a.*,b.status,b.kendaraan_jenis,b.kendaraan_id as knd_id from data_petugas a 
        left join kendaraan b on a.kendaraan_id=b.kendaraan_id 
        WHERE a.group_ruas=' . $data['ruas_group'] . ' and a.ruas_id=' . $data['ruas'] . ' and b.status = 1 ';

        $find = $this->db->query($sql);
        $cek = $find->num_rows();


        if ($cek > 0) {
            return false;
        } else {
            $this->db->set('isdeleted', 1);
            $this->db->where('ruas_id', $data['ruas']);
            $this->db->where('group_ruas', $data['ruas_group']);
            $del = $this->db->update('data_petugas');

            return $del;
        }


    }

    public function getPetugasExistingOption($data)
    {
        $this->db->select('*');
        $this->db->from('management_petugas');
        //$this->db->where('ruas_id',$data['ruas']);
        $this->db->where('jenis_petugas', $data['jenis']);
        return $this->db->get()->result();
    }

    public function getSummaryTICModel($data)
    {

        if ($data['ruas_group'] > 0) {

            $sql = "select " .
                "(select count(laporan_id)laporan from list_laporan a where status_id >= 3 and status_id <= 4 and laporan_ruas_group_id='" . $data['ruas_group'] . "') laporan," .
                "COUNT(IF(group_ruas='" . $data['ruas_group'] . "',kendaraan_id,NULL)) formasi," .
                "COUNT(IF(group_ruas='" . $data['ruas_group'] . "' and `status`=0,kendaraan_id,NULL)) standby," .
                "COUNT(IF(group_ruas='" . $data['ruas_group'] . "' and `status`=1,kendaraan_id,NULL)) onduty" .
                " from formasi_petugas";



        } else {

            $sql = "select " .
                "(select count(laporan_id)laporan from list_laporan a where status_id >= 3 and status_id <= 4 and ruas_id='" . $data['ruas'] . "') laporan," .
                "COUNT(IF(ruas_id='" . $data['ruas'] . "',kendaraan_id,NULL)) formasi," .
                "COUNT(IF(ruas_id='" . $data['ruas'] . "' and `status`=0,kendaraan_id,NULL)) standby," .
                "COUNT(IF(ruas_id='" . $data['ruas'] . "' and `status`=1,kendaraan_id,NULL)) onduty" .
                " from formasi_petugas";
        }

        //return $sql;
        $rs = $this->db->query($sql);
        return $rs->row();
    }

}