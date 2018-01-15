<?php
/***********************************
타임:          Class
이름:          Post
용도:          Post 템플렛 클래스 ( WEB 버전 )
작성자:        전병훈
생성일자:      2014.10.05 21:40:35
업데이트일자:   
Var 1.0


status 200 : 정상
status 400 : 서버가 요청의 구문을 인식하지 못했다. ( 파라미터가 유효하지 않은 경우 )
status 401 : 이 요청은 인증이 필요하다. 서버는 로그인이 필요한 페이지에 대해 이 요청을 제공할 수 있다.
status 500 : 서버에 오류가 발생하여 요청을 수행할 수 없다.

************************************/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {    
    
    function __construct() {
		parent::__construct();
	}
    
	public function ckupload () {
		ini_set('memory_limit','-1');        
		ini_set("post_max_size", "300M");
		ini_set("upload_max_filesize", "300M");          
        
		/*******************************************
		타입:          funciton
		이름:          ckupload
		용도:          포스트 이미지 업로드
		작성자:        전병훈
		생성일자:      2013.08.15 02:01:10
		업데이트일자:   
		
		********************************************/

		// 사용자가 업로드 한 파일을 /static/user/ 디렉토리에 저장한다.
		$config['upload_path'] = './upload';
		// git,jpg,png 파일만 업로드를 허용한다.
		$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG';
		// 허용되는 파일의 최대 사이즈
		$config['max_size'] = '20000';
		// 이미지인 경우 허용되는 최대 폭
		$config['max_width']  = '0';
		// 이미지인 경우 허용되는 최대 높이
		$config['max_height']  = '0';
		// 파일이름 암호화
		$config['encrypt_name']  = TRUE;
		
		$field_name = "upload";
		
		$this->load->library('upload', $config);
	
		if ( ! $this->upload->do_upload($field_name))
        {
            echo "<script>alert('업로드에 실패 했습니다. ".$this->upload->display_errors('','')."')</script>";
        }   
        else
        {
            $CKEditorFuncNum = $this->input->get('CKEditorFuncNum');

            $data = $this->upload->data();            
            $filename = $data['file_name'];
            
            $url = '/upload/'.$filename;

            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction('".$CKEditorFuncNum."', '".$url."', '전송에 성공 했습니다')</script>";
			         
        }
	}
    
    function shop_out ( $type = 'all' ) {
        /*******************
        data
        *******************/
        $data = array();
        
        /*******************
        session
        *******************/
        $session = $this->session->all_userdata();          
        if ( isset( $_GET['session_id'] ) ) {
            $session_id = (int)$_GET['session_id'];
        } elseif( isset( $session['logged_in'] ) ) {
            $session_id = $session['users_id'];
        } else {
            $session_id = 0;
        };
        $set_data['session_id'] = $session_id;        
        
        /*******************
        response
        *******************/
        $response = array();        
        
        /*******************
        data query
        *******************/     
		$this->load->model('user_model');        
        if ( isset($_GET['p']) ) {
            $set_data['p'] = (int)$_GET['p'];
            if ( $set_data['p'] == 0 ) {
                $set_data['p'] = 1;
            };
        } else {
            $set_data['p'] = 1;
        };
        $set_data['p'] = (($set_data['p'] * 2) * 10) - 20;
        if ( isset($_GET['order']) ) {
            if ( $_GET['order'] == 'desc' || $_GET['order'] == 'asc' ) {
                $set_data['order'] = $_GET['order'];
            } else {
                $set_data['order'] = 'desc';
            };
        } else {
            $set_data['order'] = 'desc';
        };
        
        if ( isset($_GET['lat']) && isset($_GET['lng']) ) {
            $set_data['lat'] = $_GET['lat'];            
            $set_data['lng'] = $_GET['lng'];            
        } else {
            $set_data['lat'] = 37.562296;            
            $set_data['lng'] = 126.990228;            
        }
        
        $row = $this->user_model->out($type,$set_data);        
        /*
        for ( $i = 0; $i < 20; $i++ ) {
            $row[$i]['user_id'] = $i;            
            $row[$i]['post_id'] = $i;
        }
        */
        if ( $row ) {
            $response['status'] = 200;
            $response['data'] = array(
                'out' => $row,
                'count' => count($row)
            );
        } else {
            $response['status'] = 200;
            $response['data'] = array(
                'out' => $row,
                'count' => strlen($row)
            );
        };
		$this->output
			 ->set_content_type('application/json')
			 ->set_output( json_encode($response) );               
    }
}
?>