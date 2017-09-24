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

class User extends CI_Controller {    
    
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
    
    function notice () {    
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
        if ( $session_id == 0 ) {
            $this->load->helper('url');
            redirect('/login', 'refresh');
        }        

		$this->load->model('user_model');
        $result = $this->user_model->out('id',array(
            'user_id' => $session_id
        ));
        if ( !$result ) {
            exit();
        }
        
        /*******************
        library
        *******************/        
        $this->load->library('form_validation');        
        
        if ( isset($_POST['user_name']) ) {
            $this->form_validation->set_rules('user_name','user_name','trim|required');
        };        
        
        /*******************
        data query
        *******************/     
        if ($this->form_validation->run() == TRUE ) {
            $set_data = array ();            
            $set_data['user_id'] = $session_id;        
            
            if ( isset($_POST['user_notice_reservation_status']) ) {
                $set_data['user_notice_reservation_status'] = array (
                    'key' => 'user_notice_reservation_status',
                    'type' => 'int',
                    'value' => 1
                );
            } else {
                $set_data['user_notice_reservation_status'] = array (
                    'key' => 'user_notice_reservation_status',
                    'type' => 'int',
                    'value' => 0
                );
            };
            
            if ( isset($_POST['user_notice_event_status']) ) {
                $set_data['user_notice_event_status'] = array (
                    'key' => 'user_notice_event_status',
                    'type' => 'int',
                    'value' => 1
                );
            } else {
                $set_data['user_notice_event_status'] = array (
                    'key' => 'user_notice_event_status',
                    'type' => 'int',
                    'value' => 0
                );
            };    
            
            if ( isset($_POST['user_notice_admin_status']) ) {
                $set_data['user_notice_admin_status'] = array (
                    'key' => 'user_notice_admin_status',
                    'type' => 'int',
                    'value' => 1
                );
            } else {
                $set_data['user_notice_admin_status'] = array (
                    'key' => 'user_notice_admin_status',
                    'type' => 'int',
                    'value' => 0
                );
            };               
            
            if ( isset($_POST['user_notice_shop_status']) ) {
                $temp = $this->input->post('user_notice_shop_status',TRUE);
                $user_notice_shop_status = '';
                $i = 0;
                foreach ( $temp as $temp_row ) {
                    if ( $i == 0 ) {
                        $user_notice_shop_status = $user_notice_shop_status.''.$temp_row;
                    } else {
                        $user_notice_shop_status = $user_notice_shop_status.'|'.$temp_row;
                    };
                    $i++;
                };
                $set_data['user_notice_shop_status'] = array (
                    'key' => 'user_notice_shop_status',
                    'type' => 'string',
                    'value' => $user_notice_shop_status
                );                                
            } else {
                $set_data['user_notice_shop_status'] = array (
                    'key' => 'user_notice_shop_status',
                    'type' => 'string',
                    'value' => 0
                );                
            };
            
            
            $this->load->model('user_model');                    
            if ( $this->user_model->update('update',$set_data) ) {
                $response['update'] = TRUE;
            } else {
                $response['update'] = FALSE;
            };
            
        } else {
            /*******************
            validation
            *******************/
            $validation = array();
            if ( isset($_POST['user_name']) ) {
                if ( 0 < strlen(strip_tags(form_error('user_name'))) ) {
                    $validation['user_name'] = strip_tags(form_error('user_name'));
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
        
		$this->load->model('user_model');
        $result = $this->user_model->out('id',array(
            'user_id' => $session_id
        ));        
        
        if ( $result ) {
            $response['status'] = 200;                    
            $response['data'] = array(
                'session_out' => $result,
                'out' => $result,
                'count' => count($result)
            );        
        } else {
            $response['status'] = 401;
        };           
        
        /*******************
        meta
        *******************/
        $data['meta'] = $this->init_meta($meta);        
        
        $data['response'] = $response;        
        
        $data['container'] = $this->load->view('/front/user/notice', $data, TRUE);
        
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
            $this->load->view('/front/auth/body', $data, FALSE);            
        };
    }    
    
    function active ( $saving_status = 0 ) {    
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
        if ( $session_id == 0 ) {
            $this->load->helper('url');
            redirect('/login', 'refresh');
        }        

		$this->load->model('user_model');
        $result = $this->user_model->out('id',array(
            'user_id' => $session_id
        ));
        if ( !$result ) {
            exit();
        }

        /*******************
        data query
        *******************/     
        
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

        if ( isset($_GET['state']) ) {
            $state = $_GET['state'];
            $pagination_url = $pagination_url.'&state='.$state;            
        } else {
            $state = 0;
        };        
        $data['state'] = $state;
        
        if ( isset($_GET['yearmonth']) ) {
            $yearmonth = $_GET['yearmonth'];
            $pagination_url = $pagination_url.'&yearmonth='.$yearmonth;            
        } else {
            $yearmonth = '';
        };
        $data['yearmonth'] = $yearmonth;        
        
        $this->load->model('user_model');    
        $session_out = $this->user_model->out('id',array(
            'user_id' => $session_id
        ));        
        $this->load->model('saving_model');       
        
        if ( $saving_status == 0 ) {
            $result = $this->saving_model->out('user_all',array(
                'user_id' => $session_id,
                'p' => $p,
                'order' => 'desc'
            ));
            $result_count = $this->saving_model->out('user_all',array(
                'user_id' => $session_id,
                'p' => $p,
                'order' => 'desc',            
                'count' => TRUE
            ));    
        } elseif ( $saving_status == 1 ) {
            $this->load->model('booking_model');         
            
            if ( $state == 0 ) {
                $result = $this->booking_model->out('user_id',array(
                    'user_id' => $session_id,
                    'p' => $p,
                    'order' => 'desc'
                ));     
                $result_count = $this->booking_model->out('user_id',array(
                    'user_id' => $session_id,
                    'p' => $p,
                    'order' => 'desc',
                    'count' => TRUE
                ));             
            } else {
                $result = $this->booking_model->out('state_user_id',array(
                    'user_id' => $session_id,
                    'p' => $p,
                    'booking_state' => $state,
                    'order' => 'desc'
                ));     
                $result_count = $this->booking_model->out('state_user_id',array(
                    'user_id' => $session_id,
                    'p' => $p,
                    'booking_state' => $state,                    
                    'order' => 'desc',
                    'count' => TRUE
                ));             
            }
            
        } else {
            $result = $this->saving_model->out('user_status',array(
                'user_id' => $session_id,
                'p' => $p,
                'order' => 'desc',
                'saving_status' => $saving_status
            ));
            $result_count = $this->saving_model->out('user_status',array(
                'user_id' => $session_id,
                'p' => $p,
                'order' => 'desc',            
                'saving_status' => $saving_status,
                'count' => TRUE
            ));    
        }
        
        $pagination_count = 0;
        if ( $result_count ) {
            $pagination_count = $result_count[0]['cnt'];            
        };      
        if ( $saving_status == 0 ) {
            $this->global_pagination($pagination_count,'/user/active/all/?',$pagination_url);            
        } elseif ( $saving_status == 1 ) {
            $this->global_pagination($pagination_count,'/user/active/booking/?',$pagination_url);                        
        } elseif ( $saving_status == 2 ) {
            $this->global_pagination($pagination_count,'/user/active/recommender/?',$pagination_url);                        
        } elseif ( $saving_status == 3 ) {            
            $this->global_pagination($pagination_count,'/user/active/salary/?',$pagination_url);                        
        }
        
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
        
        if ( $saving_status == 0 ) {
            $data['container'] = $this->load->view('/front/user/active/all', $data, TRUE);            
        } elseif ( $saving_status == 1 ) {
            $data['container'] = $this->load->view('/front/user/active/booking', $data, TRUE);                        
        } elseif ( $saving_status == 2 ) {
            $data['container'] = $this->load->view('/front/user/active/recommender', $data, TRUE);                        
        } elseif ( $saving_status == 3 ) {            
            $data['container'] = $this->load->view('/front/user/active/salary', $data, TRUE);                        
        }
        
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
            $this->load->view('/front/auth/body', $data, FALSE);            
        };
    }    
    
    function setting () {    
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
        if ( $session_id == 0 ) {
            $this->load->helper('url');
            redirect('/login', 'refresh');
        }        

		$this->load->model('user_model');
        $result = $this->user_model->out('id',array(
            'user_id' => $session_id
        ));
        if ( !$result ) {
            exit();
        }
        
        /*******************
        library
        *******************/        
        $this->load->library('form_validation');        
        
        if ( isset($_POST['user_name']) ) {
            $this->form_validation->set_rules('user_name','user_name','trim|required');
        };        
        if ( isset($_POST['user_email']) ) {
            if ( $result[0]['user_email'] != $this->input->post('user_email',TRUE) ) {
                $this->form_validation->set_rules('user_email','user_email','trim|required|valid_email|callback_user_email_overlap_check');                
            }
        };
        if ( isset($_POST['user_pass']) ) {
            if ( strlen($this->input->post('user_pass',TRUE)) != 0 ) {
                $this->form_validation->set_rules('user_pass','user_pass','trim|required');                        
            }
        };
        if ( isset($_POST['user_pass_re']) ) {
            if ( strlen($this->input->post('user_pass_re',TRUE)) != 0 || strlen($this->input->post('user_pass',TRUE)) != 0 ) {            
                $this->form_validation->set_rules('user_pass_re', 'user_pass_re', 'required|matches[user_pass]');        
            }
        };
        if ( isset($_POST['user_tel']) ) {
            $this->form_validation->set_rules('user_tel', 'user_tel', 'required');        
        };
        if ( isset($_POST['user_authentication_number']) ) {
            $this->form_validation->set_rules('user_authentication_number', 'user_authentication_number', 'required');        
        };        
        if ( isset($_POST['user_bank_name']) ) {
            $this->form_validation->set_rules('user_bank_name', 'user_bank_name', 'required');        
        };        
        if ( isset($_POST['user_bank_number']) ) {
            $this->form_validation->set_rules('user_bank_number', 'user_bank_number', 'required');        
        };        
        if ( isset($_POST['user_employment_contract']) ) {
            $this->form_validation->set_rules('user_employment_contract', 'user_employment_contract', 'required');        
        };        
        if ( isset($_POST['user_recommender_name']) ) {
            //$this->form_validation->set_rules('user_recommender_name', 'user_recommender_name', 'required');        
        };                
        if ( isset($_POST['user_business_entity_name']) ) {
            $this->form_validation->set_rules('user_business_entity_name', 'user_business_entity_name', 'required');        
        };
        if ( isset($_POST['user_business_license_number']) ) {
            $this->form_validation->set_rules('user_business_license_number', 'user_business_license_number', 'required');        
        };
        if ( isset($_POST['user_business_representative']) ) {
            $this->form_validation->set_rules('user_business_representative', 'user_business_representative', 'required');        
        };
        if ( isset($_POST['user_business_industry']) ) {
            $this->form_validation->set_rules('user_business_industry', 'user_business_industry', 'required');        
        };
        
        /*******************
        data query
        *******************/     
        if ($this->form_validation->run() == TRUE ) {
            $set_data = array ();            
            $set_data['user_id'] = $session_id;        
            
            if ( isset($_POST['user_auto_login']) ) {
                $set_data['user_auto_login'] = array (
                    'key' => 'user_auto_login',
                    'type' => 'int',
                    'value' => 1
                );
            } else {
                $set_data['user_auto_login'] = array (
                    'key' => 'user_auto_login',
                    'type' => 'int',
                    'value' => 0
                );
            };               
            
            if ( isset($_POST['user_name']) ) {
                $set_data['user_name'] = array (
                    'key' => 'user_name',
                    'type' => 'string',
                    'value' => $this->input->post('user_name',TRUE)
                );
            };
            if ( isset($_POST['user_email']) ) {
                $set_data['user_email'] = array (
                    'key' => 'user_email',
                    'type' => 'string',
                    'value' => $this->input->post('user_email',TRUE)
                );
            };
            if ( isset($_POST['user_pass']) ) {
                if ( strlen($this->input->post('user_pass',TRUE)) != 0 ) {
                    $set_data['user_pass'] = array (
                        'key' => 'user_pass',
                        'type' => 'string',
                        'value' => $this->input->post('user_pass',TRUE)
                    );
                };
            };
            if ( isset($_POST['user_tel']) ) {
                $set_data['user_tel'] = array (
                    'key' => 'user_tel',
                    'type' => 'string',
                    'value' => $this->input->post('user_tel',TRUE)
                );
            };
            if ( isset($_POST['user_authentication_number']) ) {
                $set_data['user_authentication_number'] = array (
                    'key' => 'user_authentication_number',
                    'type' => 'string',
                    'value' => $this->input->post('user_authentication_number',TRUE)
                );
            };
            if ( isset($_POST['user_bank_name']) ) {
                $set_data['user_bank_name'] = array (
                    'key' => 'user_bank_name',
                    'type' => 'string',
                    'value' => $this->input->post('user_bank_name',TRUE)
                );
            };
            if ( isset($_POST['user_bank_number']) ) {
                $set_data['user_bank_number'] = array (
                    'key' => 'user_bank_number',
                    'type' => 'string',
                    'value' => $this->input->post('user_bank_number',TRUE)
                );
            };
            if ( isset($_POST['user_employment_contract']) ) {
                $set_data['user_employment_contract'] = array (
                    'key' => 'user_employment_contract',
                    'type' => 'string',
                    'value' => $this->input->post('user_employment_contract',TRUE)
                );
            };            
            if ( isset($_POST['user_recommender_name']) ) {
                $set_data['user_recommender_name'] = array (
                    'key' => 'user_recommender_name',
                    'type' => 'string',
                    'value' => $this->input->post('user_recommender_name',TRUE)
                );
            };
            if ( isset($_POST['user_business_entity_name']) ) {
                $set_data['user_business_entity_name'] = array (
                    'key' => 'user_business_entity_name',
                    'type' => 'string',
                    'value' => $this->input->post('user_business_entity_name',TRUE)
                );
            };
            if ( isset($_POST['user_business_license_number']) ) {
                $set_data['user_business_license_number'] = array (
                    'key' => 'user_business_license_number',
                    'type' => 'string',
                    'value' => $this->input->post('user_business_license_number',TRUE)
                );
            };
            if ( isset($_POST['user_business_representative']) ) {
                $set_data['user_business_representative'] = array (
                    'key' => 'user_business_representative',
                    'type' => 'string',
                    'value' => $this->input->post('user_business_representative',TRUE)
                );
            };            
            if ( isset($_POST['user_business_industry']) ) {
                $set_data['user_business_industry'] = array (
                    'key' => 'user_business_industry',
                    'type' => 'string',
                    'value' => $this->input->post('user_business_industry',TRUE)
                );
            };
            if ( isset($_POST['user_birthday']) ) {
                $set_data['user_birthday'] = array (
                    'key' => 'user_birthday',
                    'type' => 'string',
                    'value' => $this->input->post('user_birthday',TRUE)
                );
            };

            if ( isset($_POST['user_address_0']) && isset($_POST['user_address_1']) && isset($_POST['user_address_2']) && isset($_POST['user_address_3']) ) {
                $set_data['user_address'] = array (
                    'key' => 'user_address',
                    'type' => 'string',
                    'value' => $this->input->post('user_address_0',TRUE).'|'.$this->input->post('user_address_1',TRUE).'|'.$this->input->post('user_address_2',TRUE).'|'.$this->input->post('user_address_3',TRUE)
                );
            };
            
            $this->load->model('user_model');                    
            if ( $this->user_model->update('update',$set_data) ) {
                $response['update'] = TRUE;
            } else {
                $response['update'] = FALSE;
            };
            
        } else {
            /*******************
            validation
            *******************/
            $validation = array();
            if ( isset($_POST['user_name']) ) {
                if ( 0 < strlen(strip_tags(form_error('user_name'))) ) {
                    $validation['user_name'] = strip_tags(form_error('user_name'));
                };
            };
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
            if ( isset($_POST['user_pass_re']) ) {
                if ( 0 < strlen(strip_tags(form_error('user_pass_re'))) ) {
                    $validation['user_pass_re'] = strip_tags(form_error('user_pass_re'));
                };
            };
            if ( isset($_POST['user_tel']) ) {
                if ( 0 < strlen(strip_tags(form_error('user_tel'))) ) {
                    $validation['user_tel'] = strip_tags(form_error('user_tel'));
                };
            };
            if ( isset($_POST['user_authentication_number']) ) {
                if ( 0 < strlen(strip_tags(form_error('user_authentication_number'))) ) {
                    $validation['user_authentication_number'] = strip_tags(form_error('user_authentication_number'));
                };
            };
            if ( isset($_POST['user_bank_name']) ) {
                if ( 0 < strlen(strip_tags(form_error('user_bank_name'))) ) {
                    $validation['user_bank_name'] = strip_tags(form_error('user_bank_name'));
                };
            };
            if ( isset($_POST['user_bank_number']) ) {
                if ( 0 < strlen(strip_tags(form_error('user_bank_number'))) ) {
                    $validation['user_bank_number'] = strip_tags(form_error('user_bank_number'));
                };
            };
            if ( isset($_POST['user_employment_contract']) ) {
                if ( 0 < strlen(strip_tags(form_error('user_employment_contract'))) ) {
                    $validation['user_employment_contract'] = strip_tags(form_error('user_employment_contract'));
                };
            };
            if ( isset($_POST['user_recommender_name']) ) {
                if ( 0 < strlen(strip_tags(form_error('user_recommender_name'))) ) {
                    $validation['user_recommender_name'] = strip_tags(form_error('user_recommender_name'));
                };
            };
            if ( isset($_POST['user_business_entity_name']) ) {
                if ( 0 < strlen(strip_tags(form_error('user_business_entity_name'))) ) {
                    $validation['user_business_entity_name'] = strip_tags(form_error('user_business_entity_name'));
                };
            };
            if ( isset($_POST['user_business_license_number']) ) {
                if ( 0 < strlen(strip_tags(form_error('user_business_license_number'))) ) {
                    $validation['user_business_license_number'] = strip_tags(form_error('user_business_license_number'));
                };
            };
            if ( isset($_POST['user_business_representative']) ) {
                if ( 0 < strlen(strip_tags(form_error('user_business_representative'))) ) {
                    $validation['user_business_representative'] = strip_tags(form_error('user_business_representative'));
                };
            };
            if ( isset($_POST['user_business_industry']) ) {
                if ( 0 < strlen(strip_tags(form_error('user_business_industry'))) ) {
                    $validation['user_business_industry'] = strip_tags(form_error('user_business_industry'));
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
        
		$this->load->model('user_model');
        $result = $this->user_model->out('id',array(
            'user_id' => $session_id
        ));        
        
        if ( $result ) {
            $response['status'] = 200;                    
            $response['data'] = array(
                'session_out' => $result,                
                'out' => $result,
                'count' => count($result)
            );        
        } else {
            $response['status'] = 401;
        };           
        
        /*******************
        meta
        *******************/
        $data['meta'] = $this->init_meta($meta);        
        
        $data['response'] = $response;        
        
        $data['container'] = $this->load->view('/front/user/setting', $data, TRUE);
        
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
            $this->load->view('/front/auth/body', $data, FALSE);            
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
            $this->form_validation->set_message('user_pass_check', '비밀번호가 올바르지 않습니다.');
            return FALSE;
        };        
    }     
    
}
?>