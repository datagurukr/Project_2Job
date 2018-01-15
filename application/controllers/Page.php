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

class Page extends CI_Controller {
    
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

    function terms () {        
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
        $ajax = FALSE;
        if ((!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            ||
            (isset($_SERVER['HTTP_ORIGIN']) && $_SERVER['REQUEST_METHOD'] == 'GET')) {
            $ajax = TRUE;
        };
        
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
        meta
        *******************/
        $data['meta'] = $this->init_meta($meta);                    
        
        $data['response'] = $response;        

        $data['container'] = $this->load->view('/front/page/terms', $data, TRUE);            
        
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
    
    function privacy () {        
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
        $ajax = FALSE;
        if ((!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            ||
            (isset($_SERVER['HTTP_ORIGIN']) && $_SERVER['REQUEST_METHOD'] == 'GET')) {
            $ajax = TRUE;
        };
        
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
        meta
        *******************/
        $data['meta'] = $this->init_meta($meta);                    
        
        $data['response'] = $response;        

        $data['container'] = $this->load->view('/front/page/privacy', $data, TRUE);            
        
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