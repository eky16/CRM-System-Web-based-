<?php

class Notify_Model2 extends CI_Model{
    public function __construct() {
        parent::__construct();
    } 
    
//   creating table given below:
//    
//      create table comments
//    (
//  comment_id INT not null primary key,
//  comment_subject VARCHAR(250) not null,
//  comment_text TEXT not null,
//  comment_status INT not null
//     )
    
    public function data_insert($subject,$comment) {
        
        $this->db->set('comment_subject', $subject);
        $this->db->set('comment_text',$comment);
        $qry=$this->db->insert('comments');
        if($qry)
        {
           return 1; 
        }
    }

          public function fetch_data_admin_payment($v)
            {  
            if($v != '')
                {
                $this->db->set('status_baca', '2');
                $this->db->where('status_baca','1');
                $this->db->update('tbl_notif_payment');
                }
             $this->db->select();
             $this->db->from("tbl_notif_payment");
             //  $this->db->where('tbl_notif.kepada', $this->session->login['nama']);
             $this->db->where("status_baca", "1");
             $result1 = $this->db->get();
            $count=$result1->num_rows();

            $data= array('unseen_notification'=>$count);
           
            return json_encode($data);    
            }  
            public function fetch_data_schedul($v)
            {  
            if($v != '')

             $this->db->select();
             $this->db->from("jadwal_pengiriman");
             //  $this->db->where('tbl_notif.kepada', $this->session->login['nama']);
             $this->db->where("status_pengiriman", "1");
             $result1 = $this->db->get();
            $count=$result1->num_rows();

            $data= array('unseen_notification'=>$count);
           
            return json_encode($data);    
            }           
           public function fetch_data_pr_pm($v)
            {  
            if($v != '')

             $this->db->select();
             $this->db->from("purchase_order_hd");
             //  $this->db->where('tbl_notif.kepada', $this->session->login['nama']);
             $this->db->where("status_po", "1");
             $result1 = $this->db->get();
            $count=$result1->num_rows();

            $data= array('unseen_notification'=>$count);
           
            return json_encode($data);    
            } 
           public function fetch_data_pr_pm3($v)
            {  
            if($v != '')

             $this->db->select();
             $this->db->from("tbl_po_hd");
             //  $this->db->where('tbl_notif.kepada', $this->session->login['nama']);
             $this->db->where("status_po", "11");
             $result1 = $this->db->get();
            $count=$result1->num_rows();

            $data= array('unseen_notification'=>$count);
           
            return json_encode($data);    
            } 
        public function fetch_data_pr_estimator($v)
            {  
            if($v != '')

             $this->db->select();
             $this->db->from("purchase_order_hd");
             //  $this->db->where('tbl_notif.kepada', $this->session->login['nama']);
            // $this->db->where("status_po", "2");
            $kondisi = "( (  (purchase_order_hd.status_po='" . 2 . "' ) ) )";
            $this->db->where($kondisi);
             $result1 = $this->db->get();
            $count=$result1->num_rows();


            $this->db->select();
            $this->db->from("tbl_po_hd");
             //  $this->db->where('tbl_notif.kepada', $this->session->login['nama']);
            // $this->db->where("status_po", "2");
            $kondisi2 = "( (  (tbl_po_hd.status_po='" . 4 . "' )) )";
            $this->db->where($kondisi2);
             $result2 = $this->db->get();
            $count2=$result2->num_rows();

            $hitung = $count2 + $count;

            $data= array('unseen_notification'=>$hitung);
           
            return json_encode($data);    
            }  

            public function fetch_data_pr_purchase($v)
            {  
            if($v != '')

             $this->db->select();
             $this->db->from("purchase_order_hd"); 
             //  $this->db->where('tbl_notif.kepada', $this->session->login['nama']);
            $kondisi = "( (  (purchase_order_hd.status_po='" . 3 . "' ) ) )";
            $this->db->where($kondisi);
             $result1 = $this->db->get();
            $count1=$result1->num_rows();

            $this->db->select();
             $this->db->from("tbl_po_hd"); 
             //  $this->db->where('tbl_notif.kepada', $this->session->login['nama']);
            $kondisi2 = "( (  (tbl_po_hd.status_po='" . 9 . "' ) ) )";
            $this->db->where($kondisi2);
             $result2 = $this->db->get();
            $count2=$result2->num_rows();

            $count = $count1 + $count2 ;
            $data= array('unseen_notification'=>$count);
           
            return json_encode($data);    
            } 
            public function fetch_data_pr_direksi($v)
            {  
            if($v != '')

             $this->db->select();
             $this->db->from("tbl_po_hd");
             //  $this->db->where('tbl_notif.kepada', $this->session->login['nama']);
             $this->db->where("status_po", "5");
             $result1 = $this->db->get();
            $count=$result1->num_rows();

            $data= array('unseen_notification'=>$count);
           
            return json_encode($data);    
            }  
}