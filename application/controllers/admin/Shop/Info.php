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

class Info extends CI_Controller {    
    
    function __construct() {
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
    
    function id ( $user_id = 0, $sub_key = 'detail' ) {

    }
    
    function index ( $user_id = 0 ) {    
        /*******************
        data
        *******************/
        $data = array();         
        
        /*******************
        page key
        *******************/
        $data['key'] = 'shop';        
        $data['sub_key'] = $data['key'].'_1';
        $data['shop_key'] = 'info';
        $data['shop_id'] = $user_id;
        
        /*******************
        response
        *******************/
        $response = array();        
        
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
        if ( isset($data['session']['logged_in']) && isset($data['session']['admin']) ) {
            if ( $data['session']['admin'] ) {
                $session_id = $data['session']['users_id'];                
            } else {
                $session_id = 0;
            };
        } else {
            $session_id = 0;
        };
        if ( $session_id == 0 ) {
            //show_404();
        };
        $data['session_id'] = $session_id;
        
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
            $set_data['user_id'] = $user_id;        
            
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
            if ( isset($_POST['user_short_introduction']) ) {
                $set_data['user_short_introduction'] = array (
                    'key' => 'user_short_introduction',
                    'type' => 'string',
                    'value' => $this->input->post('user_short_introduction',TRUE)
                );
            };
            if ( isset($_POST['user_introduction']) ) {
                $set_data['user_introduction'] = array (
                    'key' => 'user_introduction',
                    'type' => 'string',
                    'value' => $this->input->post('user_introduction',TRUE)
                );
            };
            
            
            if ( isset($_POST['user_kakaoid']) ) {
                $set_data['user_kakaoid'] = array (
                    'key' => 'user_kakaoid',
                    'type' => 'string',
                    'value' => $this->input->post('user_kakaoid',TRUE)
                );
            };
            if ( isset($_POST['user_shop_daily_open_state']) ) {
                $set_data['user_shop_daily_open_state'] = array (
                    'key' => 'user_shop_daily_open_state',
                    'type' => 'int',
                    'value' => $this->input->post('user_shop_daily_open_state',TRUE)
                );
            } else {
                if ( isset($_POST['user_shop_daily_open_time']) ) {                
                    $set_data['user_shop_daily_open_state'] = array (
                        'key' => 'user_shop_daily_open_state',
                        'type' => 'int',
                        'value' => 0
                    );
                }
            };
            if ( isset($_POST['user_shop_daily_open_time']) ) {
                $set_data['user_shop_daily_open_time'] = array (
                    'key' => 'user_shop_daily_open_time',
                    'type' => 'string',
                    'value' => $this->input->post('user_shop_daily_open_time',TRUE)
                );
            };
            if ( isset($_POST['user_shop_daily_close_time']) ) {
                $set_data['user_shop_daily_close_time'] = array (
                    'key' => 'user_shop_daily_close_time',
                    'type' => 'string',
                    'value' => $this->input->post('user_shop_daily_close_time',TRUE)
                );
            };            
            if ( isset($_POST['user_shop_holiday_open_state']) ) {
                $set_data['user_shop_holiday_open_state'] = array (
                    'key' => 'user_shop_holiday_open_state',
                    'type' => 'int',
                    'value' => $this->input->post('user_shop_holiday_open_state',TRUE)
                );
            } else {
                if ( isset($_POST['user_shop_holiday_open_time']) ) {
                    $set_data['user_shop_holiday_open_state'] = array (
                        'key' => 'user_shop_holiday_open_state',
                        'type' => 'int',
                        'value' => 0
                    );
                };                
            };
            if ( isset($_POST['user_shop_holiday_open_time']) ) {
                $set_data['user_shop_holiday_open_time'] = array (
                    'key' => 'user_shop_holiday_open_time',
                    'type' => 'string',
                    'value' => $this->input->post('user_shop_holiday_open_time',TRUE)
                );
            };
            if ( isset($_POST['user_shop_holiday_close_time']) ) {
                $set_data['user_shop_holiday_close_time'] = array (
                    'key' => 'user_shop_holiday_close_time',
                    'type' => 'string',
                    'value' => $this->input->post('user_shop_holiday_close_time',TRUE)
                );
            };              
            
            if ( isset($_POST['user_shop_pictrue']) ) {
                $set_data['user_shop_pictrue'] = array (
                    'key' => 'user_shop_pictrue',
                    'type' => 'string',
                    'value' => $this->input->post('user_shop_pictrue',TRUE)
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
            'user_id' => $user_id
        ));        
        
        if ( $result ) {
            $response['status'] = 200;                    
            $response['data'] = array(
                'out' => $result,
                'count' => count($result)
            );        
        } else {
            $response['status'] = 401;
        }; 
        
        $data['shop_nav'] = TRUE;
        
        $data['response'] = $response;         
        if ( $ajax ) {
        } else {
            $data['container'] = $this->load->view('/admin/shop/info', $data, TRUE);
            $this->load->view('/admin/body', $data, FALSE);            
        };
    }    
    
}
?>