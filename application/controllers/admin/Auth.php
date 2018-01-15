<?php
/***********************************
타임:          Class
이름:          User
용도:          User 템플렛 클래스 ( WEB 버전 )
작성자:         전병훈
생성일자:       2017.05.10 21:40:35
업데이트일자:   
Var 1.0

status 200 : 정상
status 400 : 서버가 요청의 구문을 인식하지 못했다. ( 파라미터가 유효하지 않은 경우 )
status 401 : 이 요청은 인증이 필요하다. 서버는 로그인이 필요한 페이지에 대해 이 요청을 제공할 수 있다.
status 500 : 서버에 오류가 발생하여 요청을 수행할 수 없다.

************************************/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {    
    
    function __construct() {
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
    
    function loggedin ( $user_id = 0, $user_status = 0 ) {
        if ( 0 < $user_id ) {
            // 로그인 세션 처리 시작
            if ( $user_status == 9 || $user_status == 3 ) {
                // 관리자
                $session_data = array(
                    'users_id'  => $user_id,
                    'logged_in' => TRUE,
                    'user_status' => $user_status,
                    'admin'  => TRUE
                );
            } else {
                // 일반회원
                $session_data = array(
                    'users_id'  => $user_id,
                    'logged_in' => TRUE
                );                
            };
            $this->session->set_userdata($session_data);   
        } else {
            $this->session->sess_destroy();            
        }
        
        /*******************
        HTTP_REFERER
        *******************/
        $http_referer = @$_SERVER['HTTP_REFERER'];
        
        /*******************
        library load
        *******************/
		$this->load->helper('url');
        if ( strpos( $http_referer, 'logout' ) !== false ) {  
            redirect('/admin', 'refresh');
        } else {
            if ( strpos( $http_referer, 'login' ) ) {
                redirect('/admin', 'refresh');
            } else {
                redirect('/admin', 'refresh');
            }
        };  
    }
    
    function login ( ) {    
        /*******************
        data
        *******************/
        $data = array();         
        
        /*******************
        page key
        *******************/
        $data['key'] = 'auth';
        
        $data['sub_key'] = $data['key'].'_login';
        
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
        if ( isset($data['session']['logged_in']) && isset($data['session']['admin']) ) {
            if ( $data['session']['admin'] ) {
                $session_id = $data['session']['users_id'];
            } else {
                $session_id = 0;
            };
        } else {
            $session_id = 0;
        };
        $data['session_id'] = $session_id;
        if ( $session_id != 0 ) {
            $this->load->helper('url');
            if ( 8 <= $data['session']['user_status'] ) {
                redirect('/admin/user/list/1', 'refresh');                
            } else {
                redirect('/admin/shop/'.$session_id, 'refresh');                
            }
        }      

        /*******************
        library
        *******************/        
        $this->load->library('form_validation');        
        
        $this->form_validation->set_rules('user_email','user_email','trim|required|valid_email|callback_user_email_check');
        $this->form_validation->set_rules('user_pass','user_pass','trim|required|callback_user_pass_check');                
        
        /*******************
        data query
        *******************/     
        if ($this->form_validation->run() == TRUE ) {
            
            $row = $this->user_model->out('pass',array(
                'user_email' => $this->input->post('user_email',TRUE),           
                'user_pass' => $this->input->post('user_pass',TRUE)
            ));
            
            /*******************
            Log write
            *******************/
            
            if ( $row ) {
                $this->loggedin($row[0]['user_id'],$row[0]['user_status']);
                $response['status'] = 200;
                $response['data'] = array(
                    'out' => $row,
                    'count' => count($row)
                );
            } else {
                $response['status'] = 500;
                $response['error'] = array (
                    'message' => '재시도 해주세요.'
                );
            };
            
        } else {
            /*******************
            validation
            *******************/
            $validation = array();
            if ( isset($_POST['user_email']) ) {
                if ( 0 < strlen(strip_tags(form_error('user_email'))) ) {
                    $validation['user_email'] = strip_tags(form_error('user_email'));
                };
            };            
            if ( isset($_POST['user_pass']) ) {
                if ( 0 < strlen(strip_tags(form_error('user_pass'))) ) {
                    $validation['user_pass'] = strip_tags(form_error('user_pass'));
                };
            };
            
            if ( count($validation) ) {
                $response['status'] = 400;
                $response['error'] = array (
                    'validation' => $validation
                );
            } else {
                $response['status'] = 500;
                $response['error'] = array (
                    'message' => '재시도 해주세요.'
                );
            }            
        };
        
        /*******************
        meta
        *******************/
        $data['meta'] = $this->init_meta($meta);            
        
        $data['response'] = $response;        
        
        $data['container'] = $this->load->view('/admin/auth/login', $data, TRUE);        
        
        if ( $ajax ) {
        } else {
            $data['container'] = $this->load->view('/admin/auth/login', $data, TRUE);            
            $this->load->view('/admin/body', $data, FALSE);                        
        };
    }  
    
    function logout () {        
        $this->loggedin(0);                        
    }    
    
    /* Validation Functions */    
    function user_email_overlap_check ( $user_email ) {
		$this->load->model('user_model');                
        if( $row = $this->user_model->out('email',array(
            'user_email' => $user_email            
        )) ) {
            $this->form_validation->set_message('user_email_overlap_check', '이미 등록된 %s 입니다.');
            return FALSE;
        } else {
            return TRUE;
        };        
    }
    
    function user_email_check ( $user_email ) {
		$this->load->model('user_model');                
        if( $row = $this->user_model->out('email',array(
            'user_email' => $user_email            
        )) ) {
            return TRUE;
        } else {
            $this->form_validation->set_message('user_email_check', '존재하지 않는 %s 입니다.');
            return FALSE;
        };        
    }    
    
    function user_pass_check ( $user_pass ) {
		$this->load->model('user_model');                
        if( $row = $this->user_model->out('pass',array(
            'user_email' => $this->input->post('user_email',TRUE),           
            'user_pass' => $user_pass                        
        )) ) {
            if ( 3 <= $row[0]['user_status'] ) {
                if ( $row[0]['user_state'] == 9 ) {
                    $this->form_validation->set_message('user_pass_check', '탈퇴 처리된 계정입니다.');
                    return FALSE;
                } elseif ( $row[0]['user_state'] == 8 ) {                
                    $this->form_validation->set_message('user_pass_check', '일시정지된 계정입니다.');                                                        
                    return FALSE;
                } elseif ( $row[0]['user_state'] == 0 ) {                                
                    $this->form_validation->set_message('user_pass_check', '승인안된 계정입니다.');                                                        
                    return FALSE;
                } else {
                    return TRUE;                
                }                
            } else {
                $this->form_validation->set_message('user_pass_check', '접근 권한이 없는 계정입니다.');
                return FALSE;                
            }

        } else {
            $this->form_validation->set_message('user_pass_check', '비밀번호가 올바르지 않습니다.');
            return FALSE;
        };        
    }     
    
}
?>