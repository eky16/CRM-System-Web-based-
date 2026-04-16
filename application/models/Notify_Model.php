<?php

class Notify_Model extends CI_Model{
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
    public function fetch_data($v)
                {  
                    if($v != '')
                    {
                     $this->db->set('status_baca', '2');
                     $this->db->where('status_baca','1');
                     $this->db->where('tbl_notif.kepada', $this->session->login['nama']);
                    $this->db->update('tbl_notif');
                    }
                        $this->db->select();
                         $this->db->from("tbl_notif");
                          $this->db->where('tbl_notif.kepada', $this->session->login['nama']);
                         $this->db->order_by("id_notif", "DESC");
                         $this->db->limit(10);
                         $result = $this->db->get();
                         $output = '';
                    if($result->num_rows() > 0)
                    { 
                         foreach($result->result() as $row)
                        {
                             //var_dump($row);
                              $output .='<divclass="text-truncate"><p><a href="' . base_url().'user/mod_kerja/detail/'. $row->id_modul . '"> <strong>' . $row->dari . ' </strong> <br /> <small><em>'.$row->noted .'&nbsp;'. $row->creat_at.'</em></small></a> </p></div>';
                        }
                     }
                     else
                     {                       
                        $output .= '<li><a href="#" class="text-bold text-italic"> No Comment Found </a></li>';
                    }
            $this->db->select();
            $this->db->from("tbl_notif");
            $this->db->where('tbl_notif.kepada', $this->session->login['nama']);
            $this->db->where("status_baca", "1");
            $result1 = $this->db->get();
            $count=$result1->num_rows();
            $data= array('notification'=>$output,'unseen_notification'=>$count);
            return json_encode($data); 
            }
    public function fetch_data_admin($v)
                {  
                    if($v != '')
                    {
                     $this->db->set('status_baca', '2');
                     $this->db->where('status_baca','1');
                     $this->db->where('tbl_notif.kepada', $this->session->login['nama']);
                    $this->db->update('tbl_notif');
                    }
                        $this->db->select();
                         $this->db->from("tbl_notif");
                          $this->db->where('tbl_notif.kepada', $this->session->login['nama']);
                         $this->db->order_by("id_notif", "DESC");
                         $this->db->limit(10);
                         $result2 = $this->db->get();
                         $output = '';
                    if($result2->num_rows() > 0)
                    { 
                         foreach($result2->result() as $row)
                        {
                             //var_dump($row);
                              $output .='<p><a href="' . base_url().'mod_kerja/detail/'. $row->id_modul . '"> <strong>' . $row->dari . ' </strong> <br /> <small><em>'.$row->noted .'&nbsp;'. $row->creat_at.'</em></small></a> </p>';
                        }
                     }
                     else
                     {                       
                        $output .= '<li><a href="#" class="text-bold text-italic"> No Comment Found </a></li>';
                    }
            $this->db->select();
            $this->db->from("tbl_notif");
            $this->db->where('tbl_notif.kepada', $this->session->login['nama']);
            $this->db->where("status_baca", "1");
            $result1 = $this->db->get();
            $count=$result1->num_rows();
            $data= array('notification'=>$output,'unseen_notification'=>$count);
            return json_encode($data);
            }    

    public function fetch_data_report($v)
                {  
                    if($v != '')
                    {
                     $this->db->set('status_baca', '2');
                     $this->db->where('status_baca','1');
                     $this->db->where('tbl_notif_img.kepada', $this->session->login['nama']);
                    $this->db->update('tbl_notif_img');
                  
                    }
                        $this->db->select();
                         $this->db->from("tbl_notif_img");
                          $this->db->where('tbl_notif_img.kepada', $this->session->login['nama']);
                         $this->db->order_by("id_notif", "DESC");
                         $this->db->limit(10);
                         $result2 = $this->db->get();
                         $output = '';
           
                    if($result2->num_rows() > 0)
                    { 
                         foreach($result2->result() as $row)

                        {
                             //var_dump($row);
                              $output .='<p><a href="' . base_url().'mod_kerja/progress_view_detail/'. $row->id_modul . '"> <strong>' . $row->dari . ' </strong> <br /> <small><em>'.$row->noted .'&nbsp;'. $row->creat_at.'</em></small></a> </p>';
                        }
                     }

                     else
                     {                       
                        $output .= '<li><a href="#" class="text-bold text-italic"> No Img Found </a></li>'; 
//                    
                    }


            $this->db->select();
            $this->db->from("tbl_notif_img");
            $this->db->where('tbl_notif_img.kepada', $this->session->login['nama']);
            $this->db->where("status_baca", "1");
            $result1 = $this->db->get();
            $count=$result1->num_rows();
            $data= array('notification'=>$output,'unseen_notification'=>$count);
            return json_encode($data);      
            }  
    
          public function fetch_data_admin_payment($v)
            {  
            if($v != '')
             $this->db->select();
             $this->db->from("tbl_payment");
             //  $this->db->where('tbl_notif.kepada', $this->session->login['nama']);
             $this->db->where("status_approval", "1");
             $result1 = $this->db->get();
            $count=$result1->num_rows();

            $data= array('unseen_notification'=>$count);
           
            return json_encode($data);    
            }  
 
}