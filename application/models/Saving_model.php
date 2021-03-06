<?php
/***********************************
타임:          Class
이름:          All_model
용도:          메인 데이터베이스 클래스
작성자:        전병훈
생성일자:      2014.10.13 23:36:13
업데이트일자:   

함수명명규칙
-> 앞에 클래스 명을 붙이지 않는다. (함수명)
************************************/
class Saving_model extends CI_Model{
	
	function __construct() {
        parent::__construct();
    }
    
    function update ($type, $data) {
        
        $sql = FALSE;

        if ( !array_key_exists('post_state',$data) ) {
            $data['post_state'] = 0;
        };        
            
        if ( !array_key_exists('post_status',$data) ) {
            $data['post_status'] = 1;
        };        

        if ( $type == 'create' ) {
            $sql = "
                INSERT INTO  saving (                
                    saving_id,
                    user_id,
                    saving_status,
                    saving_exp,
                    saving_content,                    
                    saving_register_date,
                    saving_update_date
                )
                VALUES (
                    ".$data['post_id'].",
                    ".$data['user_id'].",                    
                    ".$data['saving_status'].",
                    '".$data['saving_content']."',                                        
                    now(),                    
                    now()
                );            
            ";
        } elseif ( $type == 'update' ) {
            $add = FALSE;
            foreach ( $data as $row ) {
                if ( is_array($row) ) {
                    if ( $row['type'] == 'int' ) {
                        $query_string = $row['key']."=".$row['value'];
                    } elseif ( $row['type'] == 'string' ) {
                        if ( $row['key'] == 'user_pass' ) {
                            $query_string = $row['key']."='".sha1($row['value'])."'";
                        } else {
                            $query_string = $row['key']."='".$this->db->escape_str($row['value'])."'";
                        };
                    };
                    $add = $add.$query_string.',';
                };
            };
            if ( $add ) {
                $sql = "
                update saving
                set
                    ".$add."
                    saving_update_date = now()                    
                where
                    post_id = ".$data['post_id']."
                ";
            };
        } elseif ( $type == 'delete' ) {            
            $sql = "
            delete from saving where saving_id = ".$data['saving_id']."
            ";            
        };
        
        if ( $sql ) {
            $this->db->trans_begin();
            $this->db->query($sql);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE;
            } else {
                $this->db->trans_commit();
                return TRUE;
            };
        } else {
            return FALSE;
        };
    }
    
    function out ($type, $data) {
        
        $sql = FALSE;
        
        if ( !array_key_exists('saving_id',$data) ) {
            $data['saving_id'] = 0;
        };            
        if ( !array_key_exists('user_id',$data) ) {
            $data['user_id'] = 0;
        };
        if ( !array_key_exists('session_id',$data) ) {
            $data['session_id'] = 0;
        };
        if ( !array_key_exists('limit',$data) ) {
            $data['limit'] = 20;
        };
        if ( !array_key_exists('p',$data) ) {
            $data['p'] = 0;
        };
        if ( !array_key_exists('count',$data) ) {
            $data['count'] = FALSE;
        };
        if ( !array_key_exists('order',$data) ) {
            $data['order'] = 'desc';
        };
        if ( !array_key_exists('q',$data) ) {
            $data['q'] = '';
        };        
        if ( !array_key_exists('target',$data) ) {
            $data['target'] = '';
        };                
        if ( !$data['count'] ) {
            $limit = "limit ".$data['p']." , ".$data['limit']."";
        } else {
            $limit = "";
        };        
        
        if ( $data['count'] ) {
            $select = "
            count(*) as cnt
            ";
        } else {
            $select = "          
            saving.saving_id as saving_id,
            saving.user_id as user_id,
            user.user_name as user_name,                                
            saving.saving_status as saving_status,
            saving.saving_exp as saving_exp,
            saving.saving_content as saving_content,                    
            saving.saving_register_date as saving_register_date,
            saving.saving_update_date as saving_update_date            
            ";
        };        
        
        if ( $type == 'id' ) {
            $sql = "
            select
                ".$select."
            FROM
                saving AS saving
                left outer join user as user
                on
                (saving.user_id = user.user_id)
            WHERE
                saving.saving_id = ".$data['saving_id']."
            ".$limit."
            ";  
        } elseif ( $type == 'user_all' ) {
            $sql = "
            select
                ".$select."
            FROM
                saving AS saving
                left outer join user as user
                on
                (saving.user_id = user.user_id)
            WHERE
                saving.user_id = ".$data['user_id']."
            ".$limit."
            ";  
        } elseif ( $type == 'user_status' ) { 
            $sql = "
            select
                ".$select."
            FROM
                saving AS saving
                left outer join user as user
                on
                (saving.user_id = user.user_id)
            WHERE
                saving.user_id = ".$data['user_id']."
                and
                saving.saving_status = ".$data['saving_status']."                
            ".$limit."
            ";
        } elseif ( $type == 'status' ) {
            $sql = "
            select
                ".$select."
            FROM
                saving AS saving
                left outer join user as user
                on
                (saving.user_id = user.user_id)                
            where
                saving.saving_status = ".$data['saving_status']."
            order by saving.saving_register_date ".$data['order']."        
            ".$limit."
            ";  
        } else {
            $sql = "
            select
                ".$select."
            FROM
                saving AS saving
                left outer join user as user
                on
                (saving.user_id = user.user_id)                
            order by saving.saving_register_date ".$data['order']."        
            ".$limit."
            ";              
        }
        
        if ( $sql ) {
            $query = $this->db->query($sql);
            if( 0 < $query->num_rows() ){
                if ( $data['count'] ) {
                    $post_data = $query->result_array();
                    $temp_data = $post_data;
                } else {                                
                    $i = 0;
                    $user_data = $query->result_array();
                    $temp_data = array();                    
                    foreach ( $user_data as $row ) {
                        
                        if ( array_key_exists('user_picture',$row) ) {
                            $filename = $row['user_picture'];
                            $ext = substr(strrchr($filename,"."),1);
                            $ext = strtolower($ext);
                            $allowed_images =  array('jpg','png','jpeg','JPG','JPEG');
                            $allowed_video =  array('mp4');
                            if ( in_array($ext,$allowed_images) ) {
                                $folder_name = 'photo';
                            } elseif ( in_array($ext,$allowed_video) ) {
                                $folder_name = 'video';
                            } else {
                                $folder_name = FALSE;
                            };
                            if ( $folder_name ) {
                                //$user_data[$i]['user_picture'] = '/upload/'.$folder_name.'/720/'.$filename;
                                $user_data[$i]['user_picture'] = '/api/load/file?file_name='.$filename;
                            } else {
                                $user_data[$i]['user_picture'] = '/api/load/file?file_name=user.jpg';
                            };
                        };
                        
                        array_push($temp_data,$user_data[$i]);
                        $i++;                        
                    };
                };
                return $temp_data;
            } else {
                return FALSE;
            };
        } else {
			return FALSE;
        };                            
    }
};
?>