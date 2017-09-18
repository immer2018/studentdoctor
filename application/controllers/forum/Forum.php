<?php
/**
 * Created by PhpStorm.
 * User: ALAM
 * Date: 09-Dec-16
 * Time: 1:18 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Forum extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('global');
        $this->load->library('upload');
        if (!check_login()) {
            redirect('home/login');
        }
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger form-error">', '</div>');
    }

    public function index(){
        $data = array();
        $data['page_title'] = 'Forum Index';
        $data['error'] = '';
        $loginId = $this->session->userdata('login_id');
        $data['user_info'] = $this->global_model->get_data('users', array('id' => $loginId));

        $data['social'] = $this->global_model->get('forum_category', array('sec_id' => '1'));
        $data['allprof'] = $this->global_model->get('forum_category', array('sec_id' => '2'));
        $user_type = $this->session->userdata('user_type');
        $data['dynamicprofession'] = $this->global_model->get('forum_category', array('sec_id' => '3', 'group_id' => $user_type, 'status' => 1));


        $this->load->view('header', $data);
        $this->load->view('forum/board', $data);
        $this->load->view('footer');
        
        
    }

    public function listcat(){
        $data = array();
        $data['page_title'] = 'Forum Post';
        $data['error'] = '';

        $loginId = $this->session->userdata('login_id');
        $data['user_info'] = $this->global_model->get_data('users', array('id' => $loginId));


        $user_type = $this->session->userdata('user_type');
        $data['getid']  = $this->uri->segment('4');

        $data['postdeatils'] = $this->global_model->get('forum_post', array('cat_id' => $data['getid']));

        if ($this->input->post()) {
            $postData = $this->input->post();
            $this->form_validation->set_rules('title', 'title', 'trim');
            $this->form_validation->set_rules('deatils', 'deatils', 'trim');



            if ($this->form_validation->run() == true) {

                $save['cat_id'] = $postData['hiddencat'];
                $save['author_id'] = $loginId;
                $save['title'] = $postData['title'];
                $save['deatils'] = $postData['title'];
                $save['status'] = '1';

                //// (image upload funtion)
                uploadforum();

                if ($this->upload->do_upload('attachment')) {
                    $fileInfo = $this->upload->data();
                    $pic1['name'] = $fileInfo['file_name'];
                    $save['attachment'] = $pic1['name'];

                }

                if ($ref_id = $this->global_model->insert('forum_post', $save))
                {

                    $this->session->set_flashdata('message', 'New Forum Post Create Successfully');
                    $redirect_link = base_url() . 'Forum/forum/listcat/'. $postData['hiddencat'];
                    redirect($redirect_link);

                }
            }
        }

        $this->load->view('header', $data);
        $this->load->view('forum/listcatname', $data);
        $this->load->view('footer');


    }

    public function discuss(){
        $data = array();
        $data['page_title'] = 'Add Product';
        $data['error'] = '';
        $loginId = $this->session->userdata('login_id');
        $data['user_info'] = $this->global_model->get_data('users', array('id' => $loginId));

        $data['getid']  = $this->uri->segment('4');
        $data['postdeatils'] = $this->global_model->get_data('forum_post', array('post_id' => $data['getid']));
        /// Author
        $data['user_post_info'] = $this->global_model->get_data('users', array('id' => $data['postdeatils']['author_id']));
        /// Comments retrive
        $data['comments'] = $this->global_model->get('forum_comments', array('post_id' => $data['getid']));

        /// comments author
        $data['getcommentsid'] = $this->global_model->get_data('forum_comments', array('post_id' => $data['getid']));
        $data['user_comments_info'] = $this->global_model->get_data('users', array('id' => $data['getcommentsid']['user_id']));



        if ($this->input->post()) {
            $postData = $this->input->post();
            $this->form_validation->set_rules('comments_title', 'comments_title', 'trim');
            $this->form_validation->set_rules('comments_details', 'comments_details', 'trim');



            if ($this->form_validation->run() == true) {

                $save['post_id'] = $postData['postid'];
                $save['user_id'] = $loginId;
                $save['comments_title'] = $postData['comments_title'];
                $save['comments_details'] = $postData['comments_details'];
                $save['status'] = '1';

                //// (image upload funtion)
                uploadforum();

                if ($this->upload->do_upload('attachment')) {
                    $fileInfo = $this->upload->data();
                    $pic1['name'] = $fileInfo['file_name'];
                    $save['attachment'] = $pic1['name'];

                }


                if ($ref_id = $this->global_model->insert('forum_comments', $save)) {

                    $this->session->set_flashdata('message', 'New Forum Post Create Successfully');
                    $redirect_link = base_url() . 'Forum/forum/discuss/'. $postData['postid'];
                    redirect($redirect_link);

                }
            }
        }


        $this->load->view('header', $data);
        $this->load->view('forum/discusstopic', $data);
        $this->load->view('footer');


    }


    public function addcat()
    {
        $data = array();
        $data['page_title'] = 'Add New Category';
        $data['tabActive'] = 'Forum Category';
        $data['error'] = '';
        $loginId = $this->session->userdata('login_id');
        $user_type = $this->session->userdata('user_type');

        if ($this->input->post()) {
            $postData = $this->input->post();
            $this->form_validation->set_rules('cat_title', 'cat_title', 'trim');


            if ($this->form_validation->run() == true) {

                $save['sec_id'] = '3';
                $save['cat_title'] = $postData['cat_title'];
                $save['added_by'] = $loginId;
                $save['group_id'] = $user_type;
                $save['total_post'] = '0';
                $save['status'] = '0';

               if ($ref_id = $this->global_model->insert('forum_category', $save)) {

                    $this->session->set_flashdata('message', 'New Forum category Create Successfully, Admin Will Approve');

                }
            }
        }
        $data['user_info'] = $this->global_model->get_data('users', array('id' => $loginId));
        $data['login_id'] = $loginId;
        $this->load->view('header', $data);
        $this->load->view('forum/catadd', $data);
        $this->load->view('footer');
    }


//// SHW ALL PRODUCT
    public function allmypostlist()
    {

        $data = array();
        $data['page_title'] = 'Forum Index';
        $data['error'] = '';
        $loginId = $this->session->userdata('login_id');
        $data['user_info'] = $this->global_model->get_data('users', array('id' => $loginId));

        $data['allmypostlist'] = $this->global_model->get('forum_post', array('author_id' => $loginId));

        $this->load->view('header', $data);
        $this->load->view('forum/postlist', $data);
        $this->load->view('footer');

    }

    //// SHW ALL PRODUCT
    public function allmycomments()
    {

        $data = array();
        $data['page_title'] = 'Forum Index';
        $data['error'] = '';
        $loginId = $this->session->userdata('login_id');
        $data['user_info'] = $this->global_model->get_data('users', array('id' => $loginId));

        $data['allmycomments'] = $this->global_model->get('forum_comments', array('user_id' => $loginId));

        $this->load->view('header', $data);
        $this->load->view('forum/allmycomments', $data);
        $this->load->view('footer');

    }


    //// Detisls View
    public function layoutfull()
    {

        $data = array();

        $data['page_title'] = 'Private Web';
        $data['tabActive'] = 'private';
        $data['error'] = '';
        $id = $this->uri->segment('4');

        $loginId = $this->session->userdata('login_id');
        $data['user_info'] = $user_info = $this->global_model->get_data('users', array('id' => $loginId));



        $data['layoutfull'] = $this->global_model->get_data('product', array('id' => $id));
        $data['countries'] = $this->global_model->get('countries');
        $data['main_cat'] = $this->global_model->get('classified_main_cat');

        $this->load->view('header', $data);
        $this->load->view('products/layoutfull', $data);
        $this->load->view('footer');


    }

    public function editPost($id){
        $data = array();

        $data['page_title'] = 'Edit Post';
        $data['tabActive'] = 'Edit Post';
        $data['error'] = '';

        $loginId = $this->session->userdata('login_id');
        $data['user_info'] = $user_info = $this->global_model->get_data('users', array('id' => $loginId));

        if ($this->input->post()) {
            $postData = $this->input->post();
            $save['author_id'] = $loginId;
            $save['title'] = $postData['title'];
            $save['deatils'] = $postData['deatils'];

            if ($this->global_model->update('forum_post', $save, array('post_id' => $id))){
                $this->session->set_flashdata('message', 'Post update successfully.');
                //redirect('profile/profile');
            }
        }

        $data['editMyPost'] = $this->global_model->get_data('forum_post', array('post_id' => $id));
        $data['login_id'] = $loginId;

        $this->load->view('header', $data);
        $this->load->view('forum/editPost', $data);
        $this->load->view('footer');
    }

    public function deletePost($id){
        if ($this->global_model->delete('forum_post', array('post_id' => $id))) {
            $this->session->set_flashdata('success', 'Post delete successfully!');
            redirect('forum/Forum/allmycomments');
        }
    }

    public function editComment($id){
        $data = array();

        $data['page_title'] = 'Edit Post';
        $data['tabActive'] = 'Edit Post';
        $data['error'] = '';

        $loginId = $this->session->userdata('login_id');
        $data['user_info'] = $user_info = $this->global_model->get_data('users', array('id' => $loginId));

        if ($this->input->post()) {
            $postData = $this->input->post();
            $save['user_id'] = $loginId;
            $save['comments_title'] = $postData['comments_title'];
            $save['comments_details'] = $postData['comments_details'];

            if ($this->global_model->update('forum_comments', $save, array('comment_id' => $id))){
                $this->session->set_flashdata('message', 'Comment update successfully.');
                //redirect('profile/profile');
            }
        }

        $data['editMyComment'] = $this->global_model->get_data('forum_comments', array('comment_id' => $id));
        $data['login_id'] = $loginId;

        $this->load->view('header', $data);
        $this->load->view('forum/editComment', $data);
        $this->load->view('footer');
    }

    public function deleteComment($id){
        if ($this->global_model->delete('forum_comments', array('comment_id' => $id))) {
            $this->session->set_flashdata('success', 'Comment delete successfully!');
            redirect('forum/Forum/allmycomments');
        }
    }






}

?>