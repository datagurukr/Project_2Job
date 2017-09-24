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
class Booking_model extends CI_Model{
	
	function __construct() {
        parent::__construct();
    }
    
    function update ($type, $data) {
        
        $sql = FALSE;

        if ( !array_key_exists('booking_state',$data) ) {
            $data['booking_state'] = 0;
        };        

        if ( !array_key_exists('booking_status',$data) ) {
            $data['booking_status'] = 0;
        };        
        
        if ( !array_key_exists('booking_id',$data) ) {
            $data['booking_id'] = 0;
        };

        if ( !array_key_exists('shop_id',$data) ) {
            $data['shop_id'] = 0;
        };
        
        if ( $type == 'create' ) {
            $sql = "
                INSERT INTO booking (                
                    booking_id,
                    user_id,
                    shop_id,
                    booking_status,
                    booking_state,
                    booking_content,
                    booking_discount,
                    booking_incentive,                    
                    booking_price,
                    booking_register_date,
                    booking_update_date
                )
                VALUES (
                    ".$data['booking_id'].",
                    ".$data['user_id'].",  
                    ".$data['shop_id'].",                      
                    ".$data['booking_status'].",                      
                    ".$data['booking_state'].",
                    '".$data['booking_content']."',                                        
                    ".$data['booking_discount'].",                      
                    ".$data['booking_incentive'].",                      
                    ".$data['booking_price'].",                      
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
                update order
                set
                    ".$add."
                    booking_update_date = now()                    
                where
                    booking_id = ".$data['booking_id']."
                ";
            };
        } elseif ( $type == 'delete' ) {            
            $sql = "
            delete from booking where booking_id = ".$data['booking_id']."
            ";            
        };
        
        if ( $sql ) {
            $this->db->trans_begin();
            $this->db->query($sql);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE;
            } else {
                
                $i = 0;
                $temp = '';
                foreach ( $data['basket_id'] as $basket_id_row ) {
                    if ( $i == 0 ) {
                        $temp = $temp.''.$basket_id_row;
                    } else {
                        $temp = $temp.','.$basket_id_row;                    
                    };
                    $i++;
                };

                /* 장바구니 사용처리 */
                $basket_update_sql = "
                update basket
                set
                    basket_status = 2,
                    basket_update_date = now()                    
                where
                    basket_id in (".$temp.")                
                ";
                $this->db->query($basket_update_sql);                
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    return FALSE;
                } else {
                    $this->db->trans_commit();
                    return TRUE;
                }
            };
        } else {
            return FALSE;
        };
    }
    
    function out ($type, $data) {
        
        $sql = FALSE;
        
        if ( !array_key_exists('booking_id',$data) ) {
            $data['booking_id'] = 0;
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
            booking.booking_id as booking_id,
            booking.user_id as user_id,
            booking.shop_id as shop_id,
            shop.user_business_entity_name as user_business_entity_name,
            shop.user_tel as user_tel,
            booking.booking_status as booking_status,
            booking.booking_state as booking_state,
            booking.booking_content as booking_content,
            booking.booking_discount as booking_discount,
            booking.booking_incentive as booking_incentive,                    
            booking.booking_price as booking_price,
            date_add(booking_register_date, interval +10 day) as booking_expiration_date,
            booking.booking_register_date as booking_register_date,
            booking.booking_update_date as booking_update_date
            ";
        };        
        
        if ( $type == 'id' ) {
            $sql = "
            select
                ".$select."
            FROM
                booking AS booking
                left outer join user as shop
                on
                (booking.shop_id = shop.user_id)
            WHERE
                booking.booking_id = ".$data['booking_id']."
            ".$limit."
            ";  
        } elseif ( $type == 'state_user_id' ) {                 
            $sql = "
            select
                ".$select."
            FROM
                booking AS booking
                left outer join user as shop
                on
                (booking.shop_id = shop.user_id)                
            where
                booking.user_id = ".$data['user_id']."
                and
                booking.booking_state = ".$data['booking_state']."
            order by booking.booking_register_date ".$data['order']."        
            ".$limit."
            ";            
        } elseif ( $type == 'user_id' ) {     
            $sql = "
            select
                ".$select."
            FROM
                booking AS booking
                left outer join user as shop
                on
                (booking.shop_id = shop.user_id)                
            where
                booking.user_id = ".$data['user_id']."
            order by booking.booking_register_date ".$data['order']."        
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
                        
                        $order_content = $user_data[$i]['booking_content'];
                        $order_content = @unserialize($order_content);   
                        $user_data[$i]['booking_content'] = $order_content;
                        
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