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

class Post extends CI_Controller {
    
    function __construct()
	{
		parent::__construct();
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
    
    function index ( $post_status = 0, $open = 'open' ) {        
        /*******************
        data
        *******************/
        $data = array();         
        
        /*******************
        response
        *******************/
        $response = array();        
        
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
		$this->load->model('post_model');                
        
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
        
        $result = $this->post_model->out('status',array(
            'user_id' => $session_id,
            'p' => $p,
            'order' => 'desc',
            'post_status' => $post_status
        ));
        $result_count = $this->post_model->out('status',array(
            'user_id' => $session_id,
            'p' => $p,
            'order' => 'desc',            
            'post_status' => $post_status,
            'count' => TRUE
        ));    
        $pagination_count = 0;
        if ( $result_count ) {
            $pagination_count = $result_count[0]['cnt'];            
        };
        if ( $post_status == 1 ) {
            $this->global_pagination($pagination_count,'/notice/?',$pagination_url);
        } elseif ( $post_status == 2 ) {
            if ( $open == 'open' ) {
                $this->global_pagination($pagination_count,'/event/open/?',$pagination_url);
            } else {
                $this->global_pagination($pagination_count,'/event/close/?',$pagination_url);
            };
        } elseif ( $post_status == 3 ) {
            $this->global_pagination($pagination_count,'/qna/?',$pagination_url);            
        };
        
        if ( $result ) {
            $response['status'] = 200;                    
            $response['data'] = array(
                'out' => $result,
                'out_cnt' => $pagination_count,               
                'count' => count($result)
            );        
        } else {
            $response['status'] = 401;
        };                
        
        $data['response'] = $response;        
        if ( $ajax ) {
        } else {
            if ( $post_status == 1 ) {
                $data['container'] = $this->load->view('/front/notice/list', $data, TRUE);
            } elseif ( $post_status == 2 ) {
                if ( $open == 'open' ) {
                    $data['container'] = $this->load->view('/front/event/list', $data, TRUE);
                } else {
                    $data['container'] = $this->load->view('/front/event/list', $data, TRUE);
                };
            } elseif ( $post_status == 3 ) {
                $data['container'] = $this->load->view('/front/qna/list', $data, TRUE);
            };
            $this->load->view('/front/body', $data, FALSE);            
        };
    }
    
}
?>