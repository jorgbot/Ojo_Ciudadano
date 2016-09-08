<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class blog_model extends CI_Model
{
    public function create($title, $json, $content, $url, $image)
    {
        $query = $this->db->query('INSERT INTO `webapp_blog`( `title`, `json`, `content`, `image`) VALUES ('.$this->db->escape($title).','.$this->db->escape($json).','.$this->db->escape($content).','.$this->db->escape($image).')');
        $id = $this->db->insert_id();
        if (!$query) {
            return  0;
        } else {
            return  $id;
        }
    }
    public function beforeEdit($id)
    {
        $query = $this->db->query('SELECT * FROM `webapp_blog` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function getSingleBlog($id)
    {
        $query = $this->db->query('SELECT `id`, `title`, `json`, `content`,`timestamp`,`image` FROM `webapp_blog` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function edit($id, $title, $json, $content, $timestamp, $url, $image)
    {
        $query = $this->db->query('UPDATE `webapp_blog`
 SET `title` = '.$this->db->escape($title).', `json` = '.$this->db->escape($json).',`content` = '.$this->db->escape($content).',`timestamp` = '.$this->db->escape($timestamp).',`image` = '.$this->db->escape($image).'
 WHERE id = ('.$this->db->escape($id).')');

        return 1;
    }
    public function delete($id)
    {
        $query = $this->db->query('DELETE FROM `webapp_blog` WHERE `id`=('.$this->db->escape($id).')');

        return $query;
    }
    public function getImageById($id)
    {
        $query = $this->db->query('SELECT `image` FROM `webapp_blog` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function clearBlogImage($id)
    {
        $query = $this->db->query("UPDATE `webapp_blog`
             SET `image` = ''
             WHERE id = (".$this->db->escape($id).')');

        return $query;
    }
         public function multipleDelete($selected) {
        $query = $this->db->query("DELETE FROM `webapp_blog` WHERE `id` IN ($selected)");
        return $query;
    }
}
