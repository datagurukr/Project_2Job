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
class Basket_model extends CI_Model{
	
	function __construct() {
        parent::__construct();
    }
    
    function update ($type, $data) {
        
        $sql = FALSE;

        if ( !array_key_exists('basket_state',$data) ) {
            $data['basket_state'] = 0;
        };        

        if ( !array_key_exists('basket_status',$data) ) {
            $data['basket_status'] = 0;
        };        
        
        if ( !array_key_exists('product_id',$data) ) {
            $data['product_id'] = 0;
        };
        
        if ( $type == 'create' ) {
            $sql = "
                INSERT INTO basket (                
                    basket_id,
                    user_id,
                    product_id,
                    basket_status,
                    basket_state,
                    basket_content,
                    basket_register_date,                    
                    basket_update_date
                )
                VALUES (
                    ".$data['basket_id'].",
                    ".$data['user_id'].",  
                    ".$data['product_id'].",                      
                    ".$data['basket_status'].",
                    ".$data['basket_state'].",                      
                    '".$data['basket_content']."',                                        
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
            product.product_id as product_id,
            product.product_state as product_state,
            product.user_id as shop_id,            
            product.product_name as product_name,
            product.product_pictrue as product_pictrue,
            product.product_price as product_price,
            product.product_incentive as product_incentive,                    
            product.product_life_open_date as product_life_open_date,
            product.product_life_close_date as product_life_close_date,
            product.product_option as product_option,
            product.product_register_date as product_register_date,
            product.product_update_date as product_update_date,
            
            basket.basket_id as basket_id,
            basket.user_id as user_id,
            basket.product_id as product_id,
            basket.basket_status as basket_status,
            basket.basket_state as basket_state,
            basket.basket_content as basket_content,
            basket.basket_register_date as basket_register_date,                    
            basket.basket_update_date as basket_update_date            
            ";
        };        
        
        if ( $type == 'id' ) {
            $sql = "
            select
                ".$select."
            FROM
                basket AS basket
                left outer join product as product
                on
                (basket.product_id = product.product_id)
            WHERE
                basket.basket_id = ".$data['basket_id']."
            ".$limit."
            ";  
        } elseif ( $type == 'in_basket_id' ) {                 
            $sql = "
            select
                ".$select."
            FROM
                basket AS basket
                left outer join product as product
                on
                (basket.product_id = product.product_id)
            WHERE
                basket.basket_id in (".$data['in_basket_id'].")
            ".$limit."
            ";              
        } elseif ( $type == 'user_id' ) {     
            $sql = "
            select
                ".$select."
            FROM
                basket AS basket
                left outer join product as product
                on
                (basket.product_id = product.product_id)  
            where
                basket.user_id = ".$data['user_id']."
            order by basket.basket_register_date ".$data['order']."        
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
                        
                        $basket_content = $user_data[$i]['basket_content'];
                        $basket_content = @unserialize($basket_content);   
                        $user_data[$i]['basket_content'] = $basket_content;
                        
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