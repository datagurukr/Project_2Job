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
class Product_model extends CI_Model{
	
	function __construct() {
        parent::__construct();
    }
    
    function update ($type, $data) {
        
        $sql = FALSE;

        if ( !array_key_exists('product_state',$data) ) {
            $data['product_state'] = 0;
        };        

        if ( !array_key_exists('product_pictrue',$data) ) {
            $data['product_pictrue'] = '';
        };        

        if ( $type == 'create' ) {
            $sql = "
                INSERT INTO product (                
                    product_id,
                    user_id,
                    product_state,
                    product_name,
                    product_pictrue,
                    product_price,
                    product_incentive,                    
                    product_life_open_date,
                    product_life_close_date,
                    product_option,
                    product_register_date,
                    product_update_date
                )
                VALUES (
                    ".$data['product_id'].",
                    ".$data['user_id'].",  
                    ".$data['product_state'].",                      
                    '".$this->db->escape_str($data['product_name'])."',
                    '".$this->db->escape_str($data['product_pictrue'])."',
                    ".$data['product_price'].",
                    ".$data['product_incentive'].",                      
                    '".$this->db->escape_str($data['product_life_open_date'])."',                                        
                    '".$this->db->escape_str($data['product_life_close_date'])."',                    
                    '".$data['product_option']."',                                        
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
                update product
                set
                    ".$add."
                    product_update_date = now()                    
                where
                    product_id = ".$data['product_id']."
                ";
            };
        } elseif ( $type == 'delete' ) {            
            $sql = "
            delete from product where product_id = ".$data['product_id']."
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
        
        if ( !array_key_exists('post_id',$data) ) {
            $data['post_id'] = 0;
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
            
            user.user_id as user_id,
            user.user_status as user_status,
            user.user_state as user_state,
            user.user_name as user_name,
            user.user_email as user_email,
            user.user_pass as user_pass,
            user.user_tel as user_tel,
            user.user_bank_name as user_bank_name,
            user.user_bank_number as user_bank_number,
            user.user_recommender_name as user_recommender_name,
            user.user_employment_contract as user_employment_contract,
            user.user_business_entity_name as user_business_entity_name,
            user.user_business_license_number as user_business_license_number,
            user.user_business_representative as user_business_representative,
            user.user_business_industry as user_business_industry,
            user.user_authentication_number as user_authentication_number,
            user.user_birthday as user_birthday,
            user.user_ip_address as user_ip_address,
            user.user_address as user_address,
            user.user_kakaoid as user_kakaoid,
            user.user_short_introduction as user_short_introduction,
            user.user_introduction as user_introduction,
            user.user_incentive as user_incentive,
            ( select sum(saving_exp) from saving where user_id = user.user_id ) as user_exp,
            /*user.user_exp as user_exp,*/
            user.user_shop_daily_open_state as user_shop_daily_open_state,
            user.user_shop_daily_open_time as user_shop_daily_open_time,
            user.user_shop_daily_close_time as user_shop_daily_close_time,
            user.user_shop_holiday_open_state as user_shop_holiday_open_state,
            user.user_shop_holiday_open_time as user_shop_holiday_open_time,
            user.user_shop_holiday_close_time as user_shop_holiday_close_time,                                
            user.user_shop_pictrue as user_shop_pictrue,                        
            user.user_notice_reservation_status as user_notice_reservation_status,
            user.user_auto_login as user_auto_login,
            user.user_notice_event_status as user_notice_event_status,
            user.user_notice_admin_status as user_notice_admin_status,
            user.user_notice_shop_status as user_notice_shop_status,
            user.user_lat as user_lat,
            user.user_lng as user_lng,
            user.user_register_date as user_register_date,
            user.user_update_date as user_update_date,              
            
            
            product.product_id as product_id,
            product.product_state as product_state,
            product.product_name as product_name,
            product.product_pictrue as product_pictrue,
            product.product_price as product_price,
            product.product_incentive as product_incentive,                    
            product.product_life_open_date as product_life_open_date,
            product.product_life_close_date as product_life_close_date,
            product.product_option as product_option,
            product.product_register_date as product_register_date,
            product.product_update_date as product_update_date
            ";
        };        
        
        if ( $type == 'id' ) {
            $sql = "
            select
                ".$select."
            FROM
                product AS product
                left outer join user as user
                on
                (product.user_id = user.user_id)
            WHERE
                product.product_id = ".$data['product_id']."
            ".$limit."
            ";  
        } elseif ( $type == 'user_id' ) {     
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
                product AS product
                left outer join user as user
                on
                (product.user_id = user.user_id)  
            where
                product.user_id = ".$data['user_id']."
                ".$where."                
            order by product.product_register_date ".$data['order']."        
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
                product AS product
                left outer join user as user
                on
                (product.user_id = user.user_id)  
            where
                product.user_id != 0
                ".$where."                
            order by product.product_register_date ".$data['order']."        
            ".$limit."
            ";              
        } else {
            $sql = "
            select
                ".$select."
            FROM
                product AS product
                left outer join user as user
                on
                (product.user_id = product.user_id)                
            order by product.product_register_date ".$data['order']."        
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
                        
                        $product_option = $user_data[$i]['product_option'];
                        $product_option = @unserialize($product_option);   
                        $user_data[$i]['product_option'] = $product_option;
                        
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