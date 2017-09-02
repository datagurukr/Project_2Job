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
class User_model extends CI_Model{
	
	function __construct() {
        parent::__construct();
    }
    
    function update ($type, $data) {
        
        $sql = FALSE;

        if ( !array_key_exists('user_name',$data) ) {
            $data['user_name'] = '';
        };        
            
        if ( !array_key_exists('user_picture',$data) ) {
            $data['user_picture'] = '';
        };        
        
        if ( !array_key_exists('user_status',$data) ) {
            $data['user_status'] = 1;
        };
        
        if ( !array_key_exists('user_state',$data) ) {
            $data['user_state'] = 0;
        };
        
        if ( !array_key_exists('user_gender',$data) ) {
            $data['user_gender'] = 0; // 1 : 남, 2 : 여
        };
        
        if ( !array_key_exists('user_tel',$data) ) {
            $data['user_tel'] = ''; // 미인증                
        };

        if ( !array_key_exists('user_birthday',$data) ) {
            $data['user_birthday'] = '0000-00-00'; // 미인증                
        };
        
        if ( !array_key_exists('user_ip_address',$data) ) {
            $data['user_ip_address'] = $_SERVER['REMOTE_ADDR'];
        };
        
        if ( !array_key_exists('user_facebook_id',$data) ) {
            $data['user_facebook_id'] = '';
        };
        
        if ( !array_key_exists('user_ip_address',$data) ) {
            $data['user_ip_address'] = $_SERVER['REMOTE_ADDR'];
        };
                
        if ( $type == 'create' ) {
            $sql = "
                INSERT INTO  user (                
                    user_id,
                    user_status,
                    user_state,
                    user_name,
                    user_email,
                    user_pass,
                    user_picture,
                    user_gender,
                    user_tel,
                    user_birthday,
                    user_facebook_id,
                    user_ip_address,
                    user_register_date,
                    user_update_date
                )
                VALUES (
                    ".$data['user_id'].",
                    ".$data['user_status'].",                    
                    ".$data['user_state'].",                    
                    '".$this->db->escape_str($data['user_name'])."',
                    '".$data['user_email']."',
                    '".sha1($data['user_pass'])."',
                    '".$data['user_picture']."',
                    ".$data['user_gender'].",                    
                    '".$data['user_tel']."',
                    '".$data['user_birthday']."',
                    '".$data['user_facebook_id']."',
                    '".$data['user_ip_address']."',
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
                update user
                set
                    ".$add."
                    user_update_date = now()
                where
                    user_id = ".$data['user_id']."
                ";
            };
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
        if ( !array_key_exists('user_status',$data) ) {
            $data['user_status'] = 0;
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
            user.user_id as user_id,
            user.user_status as user_status,
            user.user_state as user_state,
            user.user_name as user_name,
            user.user_email as user_email,
            user.user_pass as user_pass,
            user.user_picture as user_picture,
            user.user_gender as user_gender,
            user.user_tel as user_tel,
            user.user_birthday as user_birthday,
            user.user_introduction as user_introduction,
            user.user_facebook_id as user_facebook_id,
            user.user_ip_address as user_ip_address,
            user.user_register_date as user_register_date,
            user.user_update_date as user_update_date
            ";
        };        
        
        if ( $type == 'email' ) {            
            $sql = "
            select
                ".$select."
            FROM
                user AS user
            WHERE
                user.user_email = '".$data['user_email']."'
            ".$limit."
            ";      
        } elseif ( $type == 'auth_code' ) {            
            $sql = "
            select
                ".$select."
            FROM
                user AS user
            WHERE
                user.user_auth_code = '".$data['user_auth_code']."'
            ".$limit."
            ";                              
        } elseif ( $type == 'auth' ) {
            $sql = "
            select
                ".$select."
            FROM
                user AS user
            WHERE
                user.user_email = '".$data['user_email']."'
            ".$limit."
            ";      
        } elseif ( $type == 'pass_and_id' ) {
            $sql = "
            select
                ".$select."
            FROM
                user AS user
            WHERE
                ( user.user_id = ".$data['user_id']." )
                and
                user.user_pass = '".sha1($data['user_pass'])."'
            ".$limit."
            ";        
        } elseif ( $type == 'pass' ) {
            $sql = "
            select
                ".$select."
            FROM
                user AS user
            WHERE
                user.user_email = '".$data['user_email']."'
                and
                user.user_pass = '".sha1($data['user_pass'])."'
            ".$limit."
            ";                  
        } elseif ( $type == 'id' ) {
            $sql = "
            select
                ".$select."
            FROM
                user AS user
            WHERE
                user.user_id = ".$data['user_id']."
            ".$limit."
            ";  
        } elseif ( $type == 'all' ) {   
            $where = '';
            if ( strlen(trim($data['q'])) != 0 ) {
                if ( $data['target'] == 'name' ) {
                    $where = "and user.user_name like '%".$data['q']."%'";
                } elseif ( $data['target'] == 'email' ) {
                    $where = "and user.user_email like '%".$data['q']."%'";
                } else {
                    $where = "and ( user.user_name like '%".$data['q']."%' or user.user_email like '%".$data['q']."%' )";
                }
            };
            
            $sql = "
            select
                ".$select."
            FROM
                user AS user
            where
                0 <= user.user_state
                ".$where."                
            order by user.user_register_date ".$data['order']."
            ".$limit."
            ";   
        } else {
            $sql = "
            select
                ".$select."
            FROM
                user AS user
            WHERE
                user.user_id = ".$data['user_id']."
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