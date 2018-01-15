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
    
    function detail ( $user_id = 0, $user_status = 0 ) {
        
        /*******************
        data
        *******************/
        $data = array();         
        
        /*******************
        page key
        *******************/
        $data['key'] = 'user';        
        
        /*******************
        response
        *******************/
        $response = array();        
        
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
                if ( 8 <= $data['session']['user_status'] ) {
                    $session_id = $data['session']['users_id'];
                };
            } else {
                $session_id = 0;
            };
        } else {
            $session_id = 0;
        };
        if ( $session_id == 0 ) {
            show_404();
        };
        $data['session_id'] = $session_id;
        
        /*******************
        data query
        *******************/
		$this->load->model('user_model');
        

        /* 업데이트 */
        $set_data = array ();
        $set_data['user_id'] = $user_id;     
        if ( isset($_POST['user_state']) ) {
            $set_data['user_state'] = array (
                'key' => 'user_state',
                'type' => 'int',
                'value' => $this->input->post('user_state',TRUE)
            );
        };    
        if ( isset($_POST['user_approval']) ) {
            $set_data['user_approval'] = array (
                'key' => 'user_approval',
                'type' => 'int',
                'value' => $this->input->post('user_approval',TRUE)
            );
        };    
        
        if ( $this->user_model->update('update',$set_data) ) {
            $response['update'] = TRUE;
        } else {
            $response['update'] = FALSE;
        };
        
        
        $result = $this->user_model->out('id',array(
            'user_id' => $user_id,
            'p' => 0,
            'q' => "",
            'order' => 'desc'
        ));   
        
        if ( $result ) {
            $user_status = $result[0]['user_status'];
            $out = $result;
            
            /*******************
            page key
            *******************/
            $data['sub_key'] = $data['key'].'_'.$user_status;
        } else {
            show_404();                            
        }

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
        if ( isset($_GET['q']) ) {
            $q = $_GET['q'];
            $pagination_url = $pagination_url.'&q='.$q;
        } else {
            $q = '';
        };        
        $data['q'] = $q;
        
        if ( isset($_GET['target']) ) {
            $target = $_GET['target'];
            $pagination_url = $pagination_url.'&target='.$target;            
        } else {
            $target = '';
        };        
        $data['target'] = $target;
        
        if ( isset($_GET['yearmonth']) ) {
            $yearmonth = $_GET['yearmonth'];
            $pagination_url = $pagination_url.'&yearmonth='.$yearmonth;            
        } else {
            $yearmonth = '';
        };
        $data['yearmonth'] = $yearmonth;  
        
        if ( isset($_GET['order']) ) {
            if ( $_GET['order'] == 'desc' || $_GET['order'] == 'asc' ) {
                $order = $_GET['order'];
            } else {
                $order = 'desc';
            };
            $pagination_url = $pagination_url.'&order='.$order;
        } else {
            $order = 'desc';
        };
        $data['order'] = $order;
        
        if ( isset($_GET['order_target']) ) {
            $order_target = $_GET['order_target'];
            $pagination_url = $pagination_url.'&order_target='.$order_target;
        } else {
            $order_target = '';
        };        
        $data['order_target'] = $order_target;        
        
        $this->load->model('saving_model');         
        $this->load->model('booking_model');                 
        $active_result = $this->saving_model->out('user_all',array(
            'user_id' => $user_id,
            'p' => 0,
            'order' => 'desc'
        ));        
        $booking_result = $this->booking_model->out('user_id',array(
            'user_id' => $user_id,
            'p' => 0,
            'order' => 'desc'
        ));        
        $sale_result = $this->booking_model->out('user_id',array(
            'user_id' => $user_id,
            'p' => 0,
            'order' => 'desc'
        ));                
        $recommender_result = $this->saving_model->out('user_status',array(
            'user_id' => $user_id,
            'p' => 0,
            'order' => 'desc',
            'saving_status' => 2
        ));        
        
        if ( $result ) {
            $response['status'] = 200;                    
            $response['data'] = array(
                'out' => $out,
                'sale_out' => $sale_result,
                'active_out' => $active_result,
                'booking_out' => $booking_result,
                'recommender_out' => $recommender_result
            );        
        } else {
            $response['status'] = 401;
        };                 
        
        $data['response'] = $response;      
        
        if ( $ajax ) {
        } else {
            if ( $user_status == 1 ) {
                $data['container'] = $this->load->view('/admin/user/detail_1', $data, TRUE);
            } elseif ( $user_status == 2 ) {
                $data['container'] = $this->load->view('/admin/user/detail_2', $data, TRUE);
            } elseif ( $user_status == 3 ) {
                $data['container'] = $this->load->view('/admin/user/detail_3', $data, TRUE);
            } elseif ( $user_status == 8 ) {
                $data['container'] = $this->load->view('/admin/user/detail_8', $data, TRUE);                
            } elseif ( $user_status == 9 ) {
                $data['container'] = $this->load->view('/admin/user/detail_9', $data, TRUE);
            } else {
                show_404();                
            };
            $this->load->view('/admin/body', $data, FALSE);            
        };        
        
    }

    function edit ( $user_id = 0, $user_status = 0 ) {
        
        /*******************
        data
        *******************/
        $data = array();         
        
        /*******************
        page key
        *******************/
        $data['key'] = 'user';        
        
        /*******************
        response
        *******************/
        $response = array();        
        
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
                if ( 8 <= $data['session']['user_status'] ) {
                    $session_id = $data['session']['users_id'];
                };
            } else {
                $session_id = 0;
            };
        } else {
            $session_id = 0;
        };
        if ( $session_id == 0 ) {
            show_404();
        };
        $data['session_id'] = $session_id;
        
        /*******************
        data query
        *******************/
		$this->load->model('user_model');
        

        /* 업데이트 */
        $set_data = array ();
        $set_data['user_id'] = $user_id;     
        if ( isset($_POST['user_state']) ) {
            $set_data['user_state'] = array (
                'key' => 'user_state',
                'type' => 'int',
                'value' => $this->input->post('user_state',TRUE)
            );
        };    
        if ( isset($_POST['user_approval']) ) {
            $set_data['user_approval'] = array (
                'key' => 'user_approval',
                'type' => 'int',
                'value' => $this->input->post('user_approval',TRUE)
            );
        };    
        
        if ( $this->user_model->update('update',$set_data) ) {
            $response['update'] = TRUE;
        } else {
            $response['update'] = FALSE;
        };
        
        
        $result = $this->user_model->out('id',array(
            'user_id' => $user_id,
            'p' => 0,
            'q' => "",
            'order' => 'desc'
        ));   
        
        if ( $result ) {
            $user_status = $result[0]['user_status'];
            $out = $result;
            
            /*******************
            page key
            *******************/
            $data['sub_key'] = $data['key'].'_'.$user_status;
        } else {
            show_404();                            
        }

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
        if ( isset($_GET['q']) ) {
            $q = $_GET['q'];
            $pagination_url = $pagination_url.'&q='.$q;
        } else {
            $q = '';
        };        
        $data['q'] = $q;
        
        if ( isset($_GET['target']) ) {
            $target = $_GET['target'];
            $pagination_url = $pagination_url.'&target='.$target;            
        } else {
            $target = '';
        };        
        $data['target'] = $target;
        
        if ( isset($_GET['yearmonth']) ) {
            $yearmonth = $_GET['yearmonth'];
            $pagination_url = $pagination_url.'&yearmonth='.$yearmonth;            
        } else {
            $yearmonth = '';
        };
        $data['yearmonth'] = $yearmonth;  
        
        if ( isset($_GET['order']) ) {
            if ( $_GET['order'] == 'desc' || $_GET['order'] == 'asc' ) {
                $order = $_GET['order'];
            } else {
                $order = 'desc';
            };
            $pagination_url = $pagination_url.'&order='.$order;
        } else {
            $order = 'desc';
        };
        $data['order'] = $order;
        
        if ( isset($_GET['order_target']) ) {
            $order_target = $_GET['order_target'];
            $pagination_url = $pagination_url.'&order_target='.$order_target;
        } else {
            $order_target = '';
        };        
        $data['order_target'] = $order_target;        
        
        $this->load->model('saving_model');         
        $this->load->model('booking_model');                 
        $active_result = $this->saving_model->out('user_all',array(
            'user_id' => $user_id,
            'p' => 0,
            'order' => 'desc'
        ));        
        $booking_result = $this->booking_model->out('user_id',array(
            'user_id' => $user_id,
            'p' => 0,
            'order' => 'desc'
        ));        
        $sale_result = $this->booking_model->out('user_id',array(
            'user_id' => $user_id,
            'p' => 0,
            'order' => 'desc'
        ));                
        $recommender_result = $this->saving_model->out('user_status',array(
            'user_id' => $user_id,
            'p' => 0,
            'order' => 'desc',
            'saving_status' => 2
        ));        
        
        if ( $result ) {
            $response['status'] = 200;                    
            $response['data'] = array(
                'out' => $out,
                'sale_out' => $sale_result,
                'active_out' => $active_result,
                'booking_out' => $booking_result,
                'recommender_out' => $recommender_result
            );        
        } else {
            $response['status'] = 401;
        };                 
        
        $data['response'] = $response;      
        
        if ( $ajax ) {
        } else {
            if ( $user_status == 1 ) {
                $data['container'] = $this->load->view('/admin/user/edit_1', $data, TRUE);
            } elseif ( $user_status == 2 ) {
                $data['container'] = $this->load->view('/admin/user/edit_2', $data, TRUE);
            } elseif ( $user_status == 3 ) {
                $data['container'] = $this->load->view('/admin/user/edit_3', $data, TRUE);
            } elseif ( $user_status == 8 ) {
                $data['container'] = $this->load->view('/admin/user/edit_8', $data, TRUE);                
            } elseif ( $user_status == 9 ) {
                $data['container'] = $this->load->view('/admin/user/edit_9', $data, TRUE);
            } else {
                show_404();                
            };
            $this->load->view('/admin/body', $data, FALSE);            
        };        
        
    }    
    
    function index ( $user_status = 0 ) {    
        /*******************
        data
        *******************/
        $data = array();         
        
        /*******************
        page key
        *******************/
        $data['key'] = 'user';        
        $data['sub_key'] = $data['key'].'_'.$user_status;
        
        /*******************
        response
        *******************/
        $response = array();        
        
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
                if ( 8 <= $data['session']['user_status'] ) {
                    $session_id = $data['session']['users_id'];
                };
            } else {
                $session_id = 0;
            };
        } else {
            $session_id = 0;
        };
        if ( $session_id == 0 ) {
            show_404();
        };
        $data['session_id'] = $session_id;
        
        /*******************
        data query
        *******************/
		$this->load->model('user_model');
        
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
        if ( isset($_GET['q']) ) {
            $q = $_GET['q'];
            $pagination_url = $pagination_url.'&q='.$q;
        } else {
            $q = '';
        };        
        $data['q'] = $q;
        
        if ( isset($_GET['target']) ) {
            $target = $_GET['target'];
            $pagination_url = $pagination_url.'&target='.$target;            
        } else {
            $target = '';
        };        
        $data['target'] = $target;
        
        if ( isset($_GET['yearmonth']) ) {
            $yearmonth = $_GET['yearmonth'];
            $pagination_url = $pagination_url.'&yearmonth='.$yearmonth;            
        } else {
            $yearmonth = '';
        };
        $data['yearmonth'] = $yearmonth;  
        
        if ( isset($_GET['order']) ) {
            if ( $_GET['order'] == 'desc' || $_GET['order'] == 'asc' ) {
                $order = $_GET['order'];
            } else {
                $order = 'desc';
            };
            $pagination_url = $pagination_url.'&order='.$order;
        } else {
            $order = 'desc';
        };
        $data['order'] = $order;
        
        if ( isset($_GET['order_target']) ) {
            $order_target = $_GET['order_target'];
            $pagination_url = $pagination_url.'&order_target='.$order_target;
        } else {
            $order_target = '';
        };        
        $data['order_target'] = $order_target;        
        
        if ( $user_status == 4 ) {
            $result = $this->user_model->out('dropout',array(
                'user_id' => $session_id,
                'p' => $p,
                'q' => $q,
                'order' => $order,
                'user_status' => $user_status,
                'target' => $target,
                'order_target' =>$order_target
            ));
            $result_count = $this->user_model->out('dropout',array(
                'user_id' => $session_id,
                'p' => $p,
                'q' => $q,
                'order' => $order,            
                'user_status' => $user_status,            
                'target' => $target,            
                'order_target' =>$order_target,                
                'count' => TRUE
            ));    
        } else {
            $result = $this->user_model->out('status',array(
                'user_id' => $session_id,
                'p' => $p,
                'q' => $q,
                'order' => $order,
                'user_status' => $user_status,
                'target' => $target,
                'order_target' =>$order_target
            ));
            $result_count = $this->user_model->out('status',array(
                'user_id' => $session_id,
                'p' => $p,
                'q' => $q,
                'order' => $order,            
                'user_status' => $user_status,            
                'target' => $target,
                'order_target' =>$order_target,
                'count' => TRUE
            ));    
        }
        $pagination_count = 0;
        if ( $result_count ) {
            $pagination_count = $result_count[0]['cnt'];            
        };
        $this->global_pagination($pagination_count,'/admin/exam/?',$pagination_url);                        
        
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
            if ( $user_status == 1 ) {
                $data['container'] = $this->load->view('/admin/user/list_1', $data, TRUE);
            } elseif ( $user_status == 2 ) {
                $data['container'] = $this->load->view('/admin/user/list_2', $data, TRUE);
            } elseif ( $user_status == 3 ) {
                $data['container'] = $this->load->view('/admin/user/list_3', $data, TRUE);
            } elseif ( $user_status == 4 ) {
                $data['container'] = $this->load->view('/admin/user/list_4', $data, TRUE);
            } else {
                show_404();                
            };
            $this->load->view('/admin/body', $data, FALSE);            
        };
    }    
    
}
?>