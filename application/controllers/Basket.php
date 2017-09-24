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

class Basket extends CI_Controller {
    
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
    
    function index () {        
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
		$this->load->model('basket_model');                        
        // 상품구매
        if ( 
            isset($_POST['product_id']) &&
            isset($_POST['product_price']) &&            
            isset($_POST['purchase_price']) &&
            isset($_POST['purchase_count']) &&
            isset($_POST['option_name']) &&
            isset($_POST['option_price']) &&
            isset($_POST['option_count'])            
        ) {
            
            $order['product_id'] = $this->input->post('product_id',TRUE);
            $order['product_name'] = $this->input->post('product_name',TRUE);            
            $order['product_price'] = $this->input->post('product_price',TRUE);
            $order['purchase_price'] = $this->input->post('purchase_price',TRUE);
            $order['purchase_count'] = $this->input->post('purchase_count',TRUE);
            $order['option_name'] = $this->input->post('option_name',TRUE);
            $order['option_price'] = $this->input->post('option_price',TRUE);
            $order['option_count'] = $this->input->post('option_count',TRUE);
            
            $basket_id = mt_rand();    
            $result = $this->basket_model->update('create',array(
                'user_id' => $session_id,                            
                'basket_id' => $basket_id,
                'product_id' => $order['product_id'],
                'basket_status' => 1,
                'basket_state' => 1,
                'basket_content' => serialize($order)
            ));
            if ( $result ) {
                $response['update'] = TRUE;
                $this->load->helper('url');
                redirect('/basket', 'refresh');                        
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
        $pagination_url = '';
        
        $this->load->model('user_model');    
        $session_out = $this->user_model->out('id',array(
            'user_id' => $session_id
        ));        
        $result = $this->basket_model->out('user_id',array(
            'user_id' => $session_id,
            'p' => $p,
            'order' => 'desc'
        ));
        $result_count = $this->basket_model->out('user_id',array(
            'user_id' => $session_id,
            'p' => $p,
            'order' => 'desc',
            'count' => TRUE
        ));    
        $pagination_count = 0;
        if ( $result_count ) {
            $pagination_count = $result_count[0]['cnt'];            
        };
        $this->global_pagination($pagination_count,'/notice/?',$pagination_url);
        
        if ( $result ) {
            $response['status'] = 200;                    
            $response['data'] = array(
                'session_out' => $session_out,                
                'out' => $result,
                'out_cnt' => $pagination_count,               
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
        
        $data['container'] = $this->load->view('/front/basket/list', $data, TRUE);
        
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
    
    function id ( $product_id ) {        
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
        // 상품구매
        if ( 
            isset($_POST['product_id']) &&
            isset($_POST['product_price']) &&            
            isset($_POST['purchase_price']) &&
            isset($_POST['purchase_count']) &&
            isset($_POST['option_name']) &&
            isset($_POST['option_price']) &&
            isset($_POST['option_count'])            
        ) {
            
            $order['product_id'] = $this->input->post('product_id',TRUE);
            $order['product_price'] = $this->input->post('product_price',TRUE);
            $order['purchase_price'] = $this->input->post('purchase_price',TRUE);
            $order['purchase_count'] = $this->input->post('purchase_count',TRUE);
            $order['option_name'] = $this->input->post('option_name',TRUE);
            $order['option_price'] = $this->input->post('option_price',TRUE);
            $order['option_count'] = $this->input->post('option_count',TRUE);
            
        };
        
        
		$this->load->model('product_model');                
        
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
        $result = $this->product_model->out('id',array(
            'product_id' => $product_id,
            'p' => $p,
            'order' => 'desc'
        ));
        
        if ( $result ) {
            $response['status'] = 200;                    
            $response['data'] = array(
                'session_out' => $session_out,
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
        
        $data['container'] = $this->load->view('/front/product/detail', $data, TRUE);        
        
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