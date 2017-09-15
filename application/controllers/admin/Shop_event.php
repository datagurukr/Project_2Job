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

class Shop_event extends CI_Controller {    
    
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
    
    function detail ( $shop_id = 0, $post_id = 0, $post_status = 0 ) {        
        /*******************
        data
        *******************/
        $data = array();         

        /*******************
        page key
        *******************/
        $data['key'] = 'shop';        
        $data['sub_key'] = $data['key'].'_1';
        $data['shop_key'] = 'event';
        $data['shop_id'] = $shop_id;        
        $data['post_id'] = $post_id;
        
        /*******************
        response
        *******************/
        $response = array();        
        
        /*******************
        library
        *******************/        
        $this->load->library('form_validation');           
        
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
            if ( isset($data['session']['logged_in']) ) {
                $session_id = $data['session']['users_id'];
            }
        };
        $data['session_id'] = $session_id;
        
		$this->load->model('post_model');
        $result = $this->post_model->out('id',array(
            'post_id' => $post_id
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
            if ( $post_status == 1 ) {
                $data['container'] = $this->load->view('/admin/post/detail_1', $data, TRUE);
            } elseif ( $post_status == 2 ) {
                $data['container'] = $this->load->view('/admin/shop/event/detail', $data, TRUE);
            } elseif ( $post_status == 3 ) {
                $data['container'] = $this->load->view('/admin/post/detail_3', $data, TRUE);
            } elseif ( $post_status == 4 ) {
                $data['container'] = $this->load->view('/admin/post/detail_4', $data, TRUE);
            } else {
                show_404();                
            }; 
            $this->load->view('/admin/body', $data, FALSE);            
        };
    }      
    
    function edit ( $shop_id = 0, $post_id = 0, $post_status = 0, $action = '' ) {        
        
        /*******************
        data
        *******************/
        $data = array();         
        
        /*******************
        page key
        *******************/
        $data['key'] = 'shop';        
        $data['sub_key'] = $data['key'].'_1';
        $data['shop_key'] = 'event';
        $data['shop_id'] = $shop_id;        
        $data['post_id'] = $post_id;
        
        /*******************
        response
        *******************/
        $response = array();        
        
        /*******************
        library
        *******************/        
        $this->load->library('form_validation');           
        
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
            if ( isset($data['session']['logged_in']) ) {
                $session_id = $data['session']['users_id'];
            }
        };
        $data['session_id'] = $session_id;
        
        if ( $action == 'delete' ) {
            $this->load->model('post_model');                                    
            $result = $this->post_model->update('delete',array(
                'post_id' => $post_id
            ));
            if ( $result ) {
                $response['delete'] = TRUE;                
            } else {
                $response['delete'] = false;
            }
            $this->load->helper('url');
            $referer = @$_SERVER['HTTP_REFERER'];
            if ( isset($_GET['referer']) ) {
                $referer = $_GET['referer'];
            };            
            redirect($referer, 'refresh');
        } else {
            
            if ( isset($_POST['post_content_title']) ) {
                $this->form_validation->set_rules('post_content_title','post_content_title','trim|required');
            };
            if ( isset($_POST['post_content_article']) ) {
                $this->form_validation->set_rules('post_content_article','post_content_article','trim|required');
            };
            if ( isset($_POST['post_content_reply_title']) ) {
                $this->form_validation->set_rules('post_content_reply_title','post_content_reply_title','trim|required');
            }; 
            if ( isset($_POST['post_content_reply_article']) ) {
                $this->form_validation->set_rules('post_content_reply_article','post_content_reply_article','trim|required');
            };             
            
            /*******************
            data query
            *******************/     
            if ($this->form_validation->run() == TRUE ) {
                $this->load->model('post_model');                        
                
                $post_content_title = '';
                $post_content_article = '';
                $post_content_open_date = '';
                $post_content_close_date = '';
                $post_content_reply_title = '';
                $post_content_reply_article = '';
                $post_type = 0;
                
                if ( isset($_POST['post_content_title']) ) {
                    $post_content_title= $this->input->post('post_content_title',TRUE);
                };
                if ( isset($_POST['post_content_article']) ) {
                    $post_content_article = $this->input->post('post_content_article',TRUE);
                };                
                if ( isset($_POST['post_content_open_date']) ) {
                    $post_content_open_date = $this->input->post('post_content_open_date',TRUE);
                };                         
                if ( isset($_POST['post_content_close_date']) ) {
                    $post_content_close_date = $this->input->post('post_content_close_date',TRUE);
                };                                         
                if ( isset($_POST['post_content_reply_title']) ) {
                    $post_content_reply_title = $this->input->post('post_content_reply_title',TRUE);
                };                         
                if ( isset($_POST['post_content_reply_article']) ) {
                    $post_content_reply_article = $this->input->post('post_content_reply_article',TRUE);
                };                         
                if ( isset($_POST['post_type']) ) {
                    $post_type = $this->input->post('post_type',TRUE);
                };                                         
                
                if ( $post_id == 0 ) {
                    $post_id = mt_rand();                    
                    $result = $this->post_model->update('create',array(
                        'user_id' => $shop_id,                            
                        'post_id' => $post_id,
                        'post_content_title' => $post_content_title,
                        'post_content_article' => $post_content_article,
                        'post_content_open_date' => $post_content_open_date,
                        'post_content_close_date' => $post_content_close_date,                        
                        'post_content_reply_title' => $post_content_reply_title,
                        'post_content_reply_article' => $post_content_reply_article,                        
                        'post_state' => 1,
                        'post_status' => $post_status,
                        'post_type' => $post_type
                    ));
                    if ( $result ) {
                        $response['update'] = TRUE;
                        $this->load->helper('url');
                        redirect('/admin/shop/'.$shop_id.'/event/post/'.$post_id.'/'.$post_status, 'refresh');                        
                    } else {
                        $response['update'] = FALSE;
                    }
                } else {
                    $set_data = array ();
                    $set_data['post_id'] = $post_id;        
                    if ( isset($_POST['post_content_reply']) ) {
                        $set_data['post_content_reply'] = array (
                            'key' => 'post_content_reply',
                            'type' => 'string',
                            'value' => $this->input->post('post_content_reply',TRUE)
                        );
                    };                
                    if ( $this->post_model->update('update',$set_data) ) {
                        $response['update'] = TRUE;
                    } else {
                        $response['update'] = FALSE;
                    };
                };
                
            } else {
                /*******************
                validation
                *******************/
                $validation = array();
                
                if ( isset($_POST['post_content_title']) ) {
                    if ( 0 < strlen(strip_tags(form_error('post_content_title'))) ) {
                        $validation['post_content_title'] = strip_tags(form_error('post_content_title'));
                    };
                };
                
                if ( isset($_POST['post_content_article']) ) {
                    if ( 0 < strlen(strip_tags(form_error('post_content_article'))) ) {
                        $validation['post_content_article'] = strip_tags(form_error('post_content_article'));
                    };
                };
                
                if ( isset($_POST['post_content_open_date']) ) {
                    if ( 0 < strlen(strip_tags(form_error('post_content_open_date'))) ) {
                        $validation['post_content_open_date'] = strip_tags(form_error('post_content_open_date'));
                    };
                };
                
                if ( isset($_POST['post_content_close_date']) ) {
                    if ( 0 < strlen(strip_tags(form_error('post_content_close_date'))) ) {
                        $validation['post_content_close_date'] = strip_tags(form_error('post_content_close_date'));
                    };
                };                
                
                if ( isset($_POST['post_content_reply_title']) ) {
                    if ( 0 < strlen(strip_tags(form_error('post_content_reply_title'))) ) {
                        $validation['post_content_reply_title'] = strip_tags(form_error('post_content_reply_title'));
                    };
                };
                
                if ( isset($_POST['post_content_reply_article']) ) {
                    if ( 0 < strlen(strip_tags(form_error('post_content_reply_article'))) ) {
                        $validation['post_content_reply_article'] = strip_tags(form_error('post_content_reply_article'));
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
        }
        
		$this->load->model('post_model');
        $result = $this->post_model->out('id',array(
            'post_id' => $post_id
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
            if ( $post_status == 1 ) {
                $data['container'] = $this->load->view('/admin/post/edit_1', $data, TRUE);
            } elseif ( $post_status == 2 ) {
                $data['container'] = $this->load->view('/admin/shop/event/edit', $data, TRUE);
            } elseif ( $post_status == 3 ) {
                $data['container'] = $this->load->view('/admin/post/edit_3', $data, TRUE);
            } elseif ( $post_status == 4 ) {
                $data['container'] = $this->load->view('/admin/post/edit_4', $data, TRUE);
            } else {
                show_404();                
            };            
            $this->load->view('/admin/body', $data, FALSE);            
        };
    }    
    
    function index ( $shop_id = 0, $post_status = 0 ) {    
        /*******************
        data
        *******************/
        $data = array();         
        
        /*******************
        page key
        *******************/
        $data['key'] = 'shop';        
        $data['sub_key'] = $data['key'].'_1';
        $data['shop_key'] = 'event';
        $data['shop_id'] = $shop_id;        
        
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

        if ( $post_status == 3 ) {
            $json = FALSE;
            $filename = 'search_json.json';
            if ( isset($_POST['keyword']) && isset($_POST['url']) ) {
                $keyword = $this->input->post('keyword',TRUE);
                $url = $this->input->post('url',TRUE);                
                $search_json = array();
                $i = 0;
                foreach ( $keyword as $keyword_row ) {
                    $temp = array(
                        'keyword' => $keyword_row,
                        'url' => $url[$i]
                    );
                    array_push($search_json,$temp);
                    $i++;
                }
                
                $json = json_encode($search_json);    
                $json_file = fopen('./assets/json/'.$filename,'w');
                fwrite($json_file,$json);
                fclose($json_file);            
            }
            if( file_exists('./assets/json/'.$filename) ) {
                $json = file_get_contents('./assets/json/'.$filename);
                $json = json_decode($json,true);
            };
            
            $result = $json;
            if ( $result ) {
                $response['status'] = 200;                    
                $response['data'] = array(
                    'out' => $result,
                    'out_cnt' => count($result),               
                    'count' => count($result)
                );        
            } else {
                $response['status'] = 401;
            };                             
            
        } else {
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

            if ( isset($_GET['open']) ) {
                $open = $_GET['open'];
                $pagination_url = $pagination_url.'&open='.$open;            
            } else {
                $open = '';
            };
            $data['open'] = $open;   

            if ( isset($_GET['reply']) ) {
                $reply = $_GET['reply'];
                $pagination_url = $pagination_url.'&reply='.reply;            
            } else {
                $reply = '';
            };
            $data['reply'] = $reply;          

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

            $result = $this->post_model->out('user_status',array(
                'user_id' => $shop_id,
                'p' => $p,
                'q' => $q,
                'order' => $order,
                'post_status' => $post_status,
                'target' => $target,
                'order_target' =>$order_target
            ));
            $result_count = $this->post_model->out('user_status',array(
                'user_id' => $shop_id,
                'p' => $p,
                'q' => $q,
                'order' => $order,            
                'post_status' => $post_status,            
                'target' => $target,
                'order_target' =>$order_target,
                'count' => TRUE
            ));    

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

        }
        
        $data['shop_nav'] = TRUE;        
        
        $data['response'] = $response;                
        
        if ( $ajax ) {
        } else {
            if ( $post_status == 1 ) {
                $data['container'] = $this->load->view('/admin/post/list_1', $data, TRUE);
            } elseif ( $post_status == 2 ) {
                $data['container'] = $this->load->view('/admin/shop/event/list', $data, TRUE);
            } elseif ( $post_status == 3 ) {
                $data['container'] = $this->load->view('/admin/post/list_3', $data, TRUE);
            } elseif ( $post_status == 4 ) {
                $data['container'] = $this->load->view('/admin/post/list_4', $data, TRUE);
            } else {
                show_404();                
            };
            $this->load->view('/admin/body', $data, FALSE);            
        };
    }    
    
}
?>