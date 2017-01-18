<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('article_model');
        $this->load->model('comment_model');
    }

    public function index(){
        $this->load->view('admin_index');
    }
    public function new_blog(){
        $loginedUser = $this->session->userdata('loginedUser');
        $types = $this->article_model->get_types_by_user($loginedUser->user_id);
        $this->load->view('new_blog', array(
            'types' => $types
        ));
    }

    public function post_blog(){
        $title = htmlspecialchars($this->input->post('title'));
        $content = htmlspecialchars($this->input->post('content'));
        $type_id = $this->input->post('type_id');

        $loginedUser = $this->session->userdata('loginedUser');

        $rows = $this->article_model->save_article($title, $content, $type_id, $loginedUser->user_id);
        if($rows > 0){
            redirect('admin/list_blogs');
        }else{
            echo 'fail';
        }
    }

    public function list_blogs(){
        $loginedUser = $this->session->userdata('loginedUser');
        $articles = $this->article_model->get_ariticles_by_user($loginedUser->user_id);
        $this->load->view('list_blogs', array(
            'articles' => $articles
        ));
    }
    public function delete_articles(){
        $ids = $this->input->get('ids');

        $rows = $this->article_model->delete_articles($ids);
        if($rows > 0){
            echo 'success';
        }else{
            echo 'fail';
        }
    }
    public function get_blog_by_id(){

        //接数据
        $id = $this->input->get('id');//文章ID
        $user_id = $this->session->userdata("loginedUser")->user_id;//用户ID
        //调用model 查数据库
        $results = $this->article_model->get_ariticles_by_user($user_id);
        $comment_results = $this->comment_model->get_comment_by_articleid($id);
        $prevArticle = null;
        $nextArticle = null;
        foreach ($results as $index=>$result){
            if($id == $result->article_id){
                $row = $result;
                if($index>0){
                    $prevArticle = $results[$index-1];
                }

                if($index<count($results)-1){
                    $nextArticle = $results[$index+1];
                }

                break;
            }
        }
        //到页面
            if($results){
                $this->load->view('viewPost',array(
                    'row' => $row,
                    'prevArticle' => $prevArticle,
                    'nextArticle' => $nextArticle,
                    'comment_results' => $comment_results
                ));
            }else{
                echo 'fail';
            }
    }

    public function save_comment(){

        $id = $this->input->post('id');
        $content = $this->input->post('content');
        $user_id = $this->session->userdata('loginedUser')->user_id;
        $rows = $this->comment_model->save($id,$content,$user_id);
        if($rows > 0){
            redirect("admin/get_blog_by_id?id=$id");
        }else{
            echo 'fail';
        }
    }

    public function get_comment_to_me(){
        $user_id = $this->session->userdata('loginedUser') -> user_id;
        $results = $this->comment_model->get_comment($user_id);
        if($results){
            $this->load->view("blogComments",array(
                'results'=>$results
            ));
        }

    }

    public function delete_comment(){

        $comment_id = $this->input->get('comment_id');
        $row = $this->comment_model->delete_comment($comment_id);
        if($row > 0){
            redirect('admin/get_comment_to_me');
        }else{
            echo 'fail';
        }
    }

    public function delete_comment_by_commUser(){

        $commUser = $this->input->get('commUser');
        $user_id = $this->session->userdata('loginedUser')->user_id;
        $row = $this->comment_model->delete_comment_by_commUser($commUser,$user_id);
        if($row>0){
            redirect('admin/get_comment_to_me');
        }else{
            echo 'fail';
        }
    }

    public function get_blog_type(){
        $user_id = $this->session->userdata('loginedUser')->user_id;
        $results = $this->article_model->get_types_by_user($user_id);
        if($results){
            $this->load->view("blogCatalogs",array(
                'results'=>$results
            ));
        }
    }
}