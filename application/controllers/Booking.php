<?
/***********************************
타임:          Class
이름:          User
용도:          User 템플렛 클래스 ( WEB 버전 )
작성자:        전병훈
생성일자:      2017.05.16 15:11:13
업데이트일자:   
Var 1.0
************************************/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends CI_Controller {
    
    function __construct()
	{
		parent::__construct();
	}
    
    public function init_meta ($meta_data) {
        $meta['description'] = '투잡다모아';
        $meta['keyword'] = '투잡다모아';
        $meta['title'] = '투잡다모아';
        $meta['generator'] = '투잡다모아';
        $meta['image'] = '/assets/images/default.png';
        $meta['robots'] = 'index,follow';  
        if ( @$meta_data['description'] ) {
            $meta['description'] = $meta_data['description'];
        };
        if ( @$meta_data['keyword'] ) {
            $meta['keyword'] = $meta_data['keyword'];
        };
        if ( @$meta_data['title'] ) {
            $meta['title'] = $meta_data['title'];
        };
        if ( @$meta_data['generator'] ) {
            $meta['generator'] = $meta_data['generator'];
        };
        if ( @$meta_data['image'] ) {
            $meta['image'] = $meta_data['image'];
        };
        if ( @$meta_data['robots'] ) {
            $meta['robots'] = $meta_data['robots'];
        };
        return $meta;
    }     
    
    function global_pagination ($count,$url,$query_url = false, $details = false) {
        /*******************
        library load
        *******************/
        $this->load->library('pagination');
        $config['base_url'] = $url.$query_url;
        $config['total_rows'] = $count;
        if ( $details ) {
            $config['uri_segment'] = 5;
        } elseif ( $query_url ) {
            $config['uri_segment'] = 6;
        } else {
            $config['uri_segment'] = 4;
        };
        $config['per_page'] = 20;
        $config['num_links'] = 5;
        $config['use_page_numbers'] = TRUE; /*페이지개수 x 인덱스로 지정*/ 
        $config['page_query_string'] = TRUE; /*페이지개수 x 인덱스로 지정*/         
        $config['query_string_segment'] = 'p';
        /*pagination Customizing*/
        /*pagination ul tag*/
        $config['full_tag_open'] = '<ul class="pagination center">';
        $config['full_tag_close'] = '</ul>';
        /*처음으로
        $config['first_tag_open'] = '<li class="disabled">';
        $config['first_tag_close'] = '</li>';
        */
        /*끝으로
        $config['last_tag_open'] = '<li class="nation-list last">';
        $config['last_tag_close'] = '</li>';
        */
        /*다음*/
        $config['next_link'] = '<i class="material-icons">chevron_right</i>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        /*이전*/
        
        $config['prev_link'] = '<i class="material-icons">chevron_left</i>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';		
        /*현제페이지*/
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';		
        /*다음링크번호*/
        $config['num_tag_open'] = '<li class="waves-effect">';
        $config['num_tag_close'] = '</li>';    
        $this->pagination->initialize($config);
    }     
    
    function id ( $booking_id ) {        
        /*******************
        data
        *******************/
        $data = array();         
        
        /*******************
        response
        *******************/
        $response = array();        
        
        /*******************
        meta
        *******************/
        $meta = array();           
        
        /*******************
        callback
        *******************/
        $callback = '';
        
        /*******************
        redirect url
        *******************/
        $redirect_url = '';           
        
        /*******************
        page key
        *******************/
        $data['key'] = 'home';
        
        /*******************
        ajax 통신 체크
        *******************/
        $ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH'])
                || 
                (isset($_SERVER['HTTP_ORIGIN']) && $_SERVER['REQUEST_METHOD'] == 'GET');
        
        /*******************
        session
        *******************/
        $data['session'] = $this->session->all_userdata();  
        $data['session_id'] = 0;
        if ( isset($data['session']['logged_in']) ) {
            $session_id = $data['session']['users_id'];
        } else {
            $session_id = 0;
        };
        $data['session_id'] = $session_id;
        
        /*******************
        data query
        *******************/     
		$this->load->model('booking_model');                        
        // 예약
        if ( 
            isset($_POST['basket_id']) &&
            isset($_POST['shop_id']) &&            
            isset($_POST['booking_price']) &&            
            isset($_POST['booking_discount']) &&
            isset($_POST['booking_incentive'])       
        ) {
            $basket_id = $this->input->post('basket_id',TRUE);
            $shop_id = $this->input->post('shop_id',TRUE);
            $booking_price = $this->input->post('booking_price',TRUE);
            $booking_discount = $this->input->post('booking_discount',TRUE);
            $booking_incentive = $this->input->post('booking_incentive',TRUE);
            
            
            $this->load->model('basket_model');         
            $i = 0;
            $temp = '';
            foreach ( $basket_id as $basket_id_row ) {
                if ( $i == 0 ) {
                    $temp = $temp.''.$basket_id_row;
                } else {
                    $temp = $temp.','.$basket_id_row;                    
                };
                $i++;
            };            
            $basket_out = $this->basket_model->out('in_basket_id',array(
                'in_basket_id' => $temp,
                'p' => 1,
                'order' => 'desc'
            ));            
            
            $booking_id = mt_rand();    
            $result = $this->booking_model->update('create',array(
                'user_id' => $session_id,   
                'shop_id' => $shop_id,                
                'booking_id' => $booking_id,
                'booking_price' => $booking_price,
                'booking_discount' => $booking_discount,
                'booking_incentive' => $booking_incentive,                
                'booking_status' => 1,
                'booking_state' => 1,
                'booking_content' => serialize($basket_out),
                'basket_id' => $basket_id         
            ));
            if ( $result ) {
                $response['update'] = TRUE;
                $this->load->helper('url');
                redirect('/booking/'.$booking_id, 'refresh');                        
            } else {
                $response['update'] = FALSE;
            } 
            
        };
        
        if ( isset($_GET['p']) ) {
            $p = (int)$_GET['p'];
            if ( $p <= 0 ) {
                $p = 1;
            };
        } else {
            $p = 1;
        };
        $data['p'] = $p;        
        $p = (($p * 2) * 10) - 20;  

        $this->load->model('user_model'); 
        $session_out = $this->user_model->out('id',array(
            'user_id' => $session_id
        ));        
        $result = $this->booking_model->out('id',array(
            'booking_id' => $booking_id,
            'p' => $p,
            'order' => 'desc'
        ));
        $basket_out = FALSE;
        if ( $result ) {
            $this->load->model('basket_model');         
            $i = 0;
            $temp = '';
            foreach ( $result[0]['booking_content'] as $basket_id_row ) {
                if ( $i == 0 ) {
                    $temp = $temp.''.$basket_id_row['basket_id'];
                } else {
                    $temp = $temp.','.$basket_id_row['basket_id'];        
                };
                $i++;
            };            
            $basket_out = $this->basket_model->out('in_basket_id',array(
                'in_basket_id' => $temp,
                'p' => $p,
                'order' => 'desc'
            ));
        }

        if ( $result ) {
            $response['status'] = 200;                    
            $response['data'] = array(
                'session_out' => $session_out,
                'basket_out' => $basket_out,
                'out' => $result,               
                'count' => count($result)
            );        
        } else {
            $response['status'] = 401;
            $response['data'] = array(
                'session_out' => $session_out                
            );        
            
        };                
        
        /*******************
        meta
        *******************/
        $data['meta'] = $this->init_meta($meta);                    
        
        $data['response'] = $response;        
        
        $data['container'] = $this->load->view('/front/booking/complete', $data, TRUE);        
        
        if ( $ajax ) {
            $article = $data['container'];
            $ajax_data['module'] = array (
                'html' => $article,
                'tree' => array (
                    'router_attributes' => array('class' => ''),
                    'inner_attributes' => array ('class' => '','id' => 'screen'),
                    'header_attributes' => array ('class' => '','id' => ''),
                    'article_attributes' => array ('class' => '','id' => ''),
                    'footer_attributes' => array ('class' => '','id' => '')
                ),
                'page_info' => array (
                    'meta' => $data['meta'],
                    'title' => $data['meta']['title']
                ),
                'resource_response' => array (
                    'session' => $data['session'],
                    'data' => $data
                ),
                'callback' => $callback,
                'redirect_url' => $redirect_url,
                'complete' => 1,
                'overlay' => FALSE,
                'url_change' => TRUE
            );
            $this->output
                 ->set_content_type('application/json')
                 ->set_output( json_encode($ajax_data) );             
        } else {
            $this->load->view('/front/body', $data, FALSE);            
        };
    }    
}
?>