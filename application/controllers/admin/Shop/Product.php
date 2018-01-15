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

class Product extends CI_Controller {    
    
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
        if ( $session_id == 0 ) {
            show_404();
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
                $data['container'] = $this->load->view('/admin/post/detail_2', $data, TRUE);
            } elseif ( $post_status == 3 ) {
                $data['container'] = $this->load->view('/admin/post/detail_3', $data, TRUE);
            } elseif ( $post_status == 4 ) {
                $data['container'] = $this->load->view('/admin/post/detail_4', $data, TRUE);
            } elseif ( $post_status == 5 ) {                
                $data['container'] = $this->load->view('/admin/shop/event/detail', $data, TRUE);                
            } else {
                show_404();                
            }; 
            $this->load->view('/admin/body', $data, FALSE);            
        };
    }      
    
    function edit ( $shop_id = 0, $product_id = 0, $action = '' ) {        
        
        /*******************
        data
        *******************/
        $data = array();         
        
        /*******************
        page key
        *******************/
        $data['key'] = 'shop';        
        $data['sub_key'] = $data['key'].'_1';
        $data['shop_key'] = 'product';
        $data['shop_id'] = $shop_id;        
        $data['product_id'] = $product_id;
        
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
        if ( $session_id == 0 ) {
            show_404();
            if ( isset($data['session']['logged_in']) ) {
                $session_id = $data['session']['users_id'];
            }
        };
        $data['session_id'] = $session_id;
        
        if ( $action == 'delete' ) {
            $this->load->model('product_model');                                    
            $result = $this->product_model->update('delete',array(
                'product_id' => $product_id
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
            
            if ( isset($_POST['product_name']) ) {
                $this->form_validation->set_rules('product_name','product_name','trim|required');
            };
            if ( isset($_POST['product_price']) ) {
                $this->form_validation->set_rules('product_price','product_price','trim|required');
            };
            if ( isset($_POST['product_incentive']) ) {
                $this->form_validation->set_rules('product_incentive','product_incentive','trim|required');
            }; 
            if ( isset($_POST['product_life_open_date']) ) {
                $this->form_validation->set_rules('product_life_open_date','product_life_open_date','trim|required');
            };             
            if ( isset($_POST['product_life_close_date']) ) {
                $this->form_validation->set_rules('product_life_close_date','product_life_close_date','trim|required');
            };                         
            
            $product_pictrue = '';
            if(isset($_FILES['product_pictrue'])) {

                /*                
                ini_set('memory_limit','-1');        
                ini_set("post_max_size", "300M");
                ini_set("upload_max_filesize", "300M");          

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

                $field_name = "product_pictrue";

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload($field_name))
                {
                    echo "<script>alert('업로드에 실패 했습니다. ".$this->upload->display_errors('','')."')</script>";
                }   
                else
                {
                    $data = $this->upload->data();  
                    $product_pictrue = $data['file_name'];
                }            
                */

            }              
            
            /*******************
            data query
            *******************/     
            if ($this->form_validation->run() == TRUE ) {
                $this->load->model('product_model');                        
                
                $product_name = '';
                $product_price = '';
                $product_incentive = '';
                $product_life_open_date = '';
                $product_life_close_date = '';
                $product_state = 0;
                $product_pictrue = '';
                $product_option = '';
                
                if ( isset($_POST['product_name']) ) {
                    $product_name= $this->input->post('product_name',TRUE);
                };
                if ( isset($_POST['product_price']) ) {
                    $product_price = (int)$this->input->post('product_price',TRUE);
                };                
                if ( isset($_POST['product_incentive']) ) {
                    $product_incentive = (int)$this->input->post('product_incentive',TRUE);
                };                         
                if ( isset($_POST['product_life_open_date']) ) {
                    $product_life_open_date = $this->input->post('product_life_open_date',TRUE);
                };                                         
                if ( isset($_POST['product_life_close_date']) ) {
                    $product_life_close_date = $this->input->post('product_life_close_date',TRUE);
                };                         
                if ( isset($_POST['product_state']) ) {
                    $product_state = (int)$this->input->post('product_state',TRUE);
                };
                if ( isset($_POST['product_pictrue_remove']) ) {
                    $product_pictrue = '';
                };
                
                if ( isset($_POST['product_option_name']) && isset($_POST['product_option_price']) ) {
                    $product_option_name = $this->input->post('product_option_name',TRUE);
                    $product_option_price = $this->input->post('product_option_price',TRUE);                
                    $product_option_json = array();
                    $i = 0;
                    foreach ( $product_option_name as $product_option_name_row ) {
                        if ( strlen($product_option_name_row) != 0 ) {
                            $temp = array(
                                'name' => $product_option_name_row,
                                'price' => (int)$product_option_price[$i]
                            );
                        } else {
                            $temp = array(
                                'name' => '',
                                'price' => ''
                            );
                        }
                        array_push($product_option_json,$temp);
                        $i++;
                    }

                    $product_option = serialize($product_option_json);    
                };                
                
                
                if ( $product_id == 0 ) {
                    $product_id = mt_rand();                    
                    $result = $this->product_model->update('create',array(
                        'user_id' => $shop_id,                            
                        'product_id' => $product_id,
                        'product_state' => $product_state,                        
                        'product_name' => $product_name,
                        'product_pictrue' => $product_pictrue,
                        'product_price' => $product_price,
                        'product_incentive' => $product_incentive,
                        'product_life_open_date' => $product_life_open_date,                        
                        'product_life_close_date' => $product_life_close_date,
                        'product_option' => $product_option
                    ));
                    if ( $result ) {
                        $response['update'] = TRUE;
                        $this->load->helper('url');
                        redirect('/admin/shop/'.$shop_id.'/product/'.$product_id, 'refresh');                        
                    } else {
                        $response['update'] = FALSE;
                    }
                } else {
                    $set_data = array ();
                    $set_data['product_id'] = $product_id;      
                    
                    if ( 0 < strlen($product_pictrue) ) {
                        $set_data['product_pictrue'] = array (
                            'key' => 'product_pictrue',
                            'type' => 'string',
                            'value' => $product_pictrue
                        );
                    };                            
                        
                    if ( isset($_POST['product_name']) ) {
                        $set_data['product_name'] = array (
                            'key' => 'product_name',
                            'type' => 'string',
                            'value' => $product_name
                        );
                    };                
                    if ( isset($_POST['product_price']) ) {
                        $set_data['product_price'] = array (
                            'key' => 'product_price',
                            'type' => 'int',
                            'value' => $product_price
                        );
                    };                
                    if ( isset($_POST['product_incentive']) ) {
                        $set_data['product_incentive'] = array (
                            'key' => 'product_incentive',
                            'type' => 'int',
                            'value' => $product_incentive
                        );
                    };                
                    if ( isset($_POST['product_life_open_date']) ) {
                        $set_data['product_life_open_date'] = array (
                            'key' => 'product_life_open_date',
                            'type' => 'string',
                            'value' => $product_life_open_date
                        );
                    };                
                    if ( isset($_POST['product_life_close_date']) ) {
                        $set_data['product_life_close_date'] = array (
                            'key' => 'product_life_close_date',
                            'type' => 'string',
                            'value' => $product_life_close_date
                        );
                    };     
                    if ( isset($_POST['product_state']) ) {
                        $set_data['product_state'] = array (
                            'key' => 'product_state',
                            'type' => 'int',
                            'value' => $product_state
                        );
                    };                     
                    if ( isset($_POST['product_pictrue_remove']) ) {
                        $set_data['product_pictrue'] = array (
                            'key' => 'product_pictrue',
                            'type' => 'string',
                            'value' => $product_pictrue
                        );
                    };
                    if ( isset($_POST['product_option_name']) && isset($_POST['product_option_price']) ) {
                        $set_data['product_option'] = array (
                            'key' => 'product_option',
                            'type' => 'string',
                            'value' => $product_option
                        );
                    };
                    
                    if ( $this->product_model->update('update',$set_data) ) {
                        $response['update'] = TRUE;
                    } else {
                        $response['update'] = FALSE;
                    };
                    
                    if ( 0 < strlen($product_pictrue) ) {
                        $this->load->helper('url');
                        redirect('/admin/shop/516077195/product/'.$user_id, 'refresh');
                    }                    
                    
                };
                
            } else {
                /*******************
                validation
                *******************/
                $validation = array();
                if ( isset($_POST['product_name']) ) {
                    if ( 0 < strlen(strip_tags(form_error('product_name'))) ) {
                        $validation['product_name'] = strip_tags(form_error('product_name'));
                    };
                };
                
                if ( isset($_POST['product_price']) ) {
                    if ( 0 < strlen(strip_tags(form_error('product_price'))) ) {
                        $validation['product_price'] = strip_tags(form_error('product_price'));
                    };
                };
                
                if ( isset($_POST['product_incentive']) ) {
                    if ( 0 < strlen(strip_tags(form_error('product_incentive'))) ) {
                        $validation['product_incentive'] = strip_tags(form_error('product_incentive'));
                    };
                };
                
                if ( isset($_POST['product_life_open_date']) ) {
                    if ( 0 < strlen(strip_tags(form_error('product_life_open_date'))) ) {
                        $validation['product_life_open_date'] = strip_tags(form_error('product_life_open_date'));
                    };
                };                
                
                if ( isset($_POST['product_life_close_date']) ) {
                    if ( 0 < strlen(strip_tags(form_error('product_life_close_date'))) ) {
                        $validation['product_life_close_date'] = strip_tags(form_error('product_life_close_date'));
                    };
                };
                
                if ( isset($_POST['product_state']) ) {
                    if ( 0 < strlen(strip_tags(form_error('product_state'))) ) {
                        $validation['product_state'] = strip_tags(form_error('product_state'));
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
        
		$this->load->model('product_model');
        $result = $this->product_model->out('id',array(
            'product_id' => $product_id
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
            $data['container'] = $this->load->view('/admin/shop/product/edit', $data, TRUE);
            $this->load->view('/admin/body', $data, FALSE);            
        };
    }    
    
    function index ( $shop_id = 0 ) {    
        /*******************
        data
        *******************/
        $data = array();         
        
        /*******************
        page key
        *******************/
        $data['key'] = 'shop';        
        $data['sub_key'] = $data['key'].'_1';
        $data['shop_key'] = 'product';
        $data['shop_id'] = $shop_id;        
        
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
                $session_id = $data['session']['users_id'];                
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

        $result = $this->product_model->out('user_id',array(
            'user_id' => $shop_id,
            'p' => $p,
            'q' => $q,
            'order' => $order,
            'target' => $target,
            'order_target' =>$order_target
        ));
        $result_count = $this->product_model->out('user_id',array(
            'user_id' => $shop_id,
            'p' => $p,
            'q' => $q,
            'order' => $order,            
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

        
        $data['shop_nav'] = TRUE;        
        
        $data['response'] = $response;                
        
        if ( $ajax ) {
        } else {
            $data['container'] = $this->load->view('/admin/shop/product/list', $data, TRUE);            
            $this->load->view('/admin/body', $data, FALSE);            
        };
    }    
    
}
?>