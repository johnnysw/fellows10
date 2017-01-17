<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Comment_model extends CI_Model
{

    public function save($id,$content,$user_id)
    {
       $this->db->insert('t_comment',array(
           'content' => $content,
           'article_id' => $id,
           'user_id' => $user_id
       ));
       return $this->db->affected_rows();
    }

    public function get_comment_by_articleid($id){
        $sql = "select c.*,u.username from t_comment c,t_user u where c.user_id = u.user_id and c.article_id = $id";
        return $this->db->query($sql)->result();
    }

    public function get_comment($user_id){
        $sql = "select c.*,a.title,u.username from t_article a,t_comment c,t_user u where c.user_id = u.user_id and c.article_id = a.article_id and a.user_id = $user_id";
        return $this->db->query($sql)->result();
    }

}