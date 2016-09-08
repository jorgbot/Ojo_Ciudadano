<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class articles_model extends CI_Model
{
    public function create($status, $title, $json, $content, $image)
    {
        $query = $this->db->query('INSERT INTO `webapp_articles`(`status`, `title`, `json`, `content`, `image`) VALUES ('.$this->db->escape($status).','.$this->db->escape($title).','.$this->db->escape($json).','.$this->db->escape($content).','.$this->db->escape($image).')');
        $id = $this->db->insert_id();
        if (!$query) {
            return  0;
        } else {
            return  $id;
        }
    }
    public function beforeEdit($id)
    {
        $query = $this->db->query('SELECT * FROM `webapp_articles` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function getSingleArticles($id)
    {
        $query = $this->db->query('SELECT `id`, `status`, `title`, `json`, `content`,`timestamp`,`image` FROM `webapp_articles` WHERE `status`=1 AND `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function edit($id, $status, $title, $json, $content, $timestamp, $image)
    {
        $query = $this->db->query('UPDATE `webapp_articles`
 SET `status` = '.$this->db->escape($status).', `title` = '.$this->db->escape($title).', `json` = '.$this->db->escape($json).',`content` = '.$this->db->escape($content).',`timestamp` = '.$this->db->escape($timestamp).',`image` = '.$this->db->escape($image).'
 WHERE id = ('.$this->db->escape($id).')');

        if ($id == 1) {
            $query = $this->db->query("UPDATE `webapp_articles`
 SET `status` = 1, `title` = 'Home'
 WHERE id = (".$this->db->escape($id).')');
        }

        return 1;
    }
    public function delete($id)
    {
        $query = $this->db->query('DELETE FROM `webapp_articles` WHERE `id`=('.$this->db->escape($id).')');

        return $query;
    }
    public function getImageById($id)
    {
        $query = $this->db->query('SELECT `image` FROM `webapp_articles` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function clearArticleImage($id)
    {
        $query = $this->db->query("UPDATE `webapp_articles`
             SET `image` = ''
             WHERE id = (".$this->db->escape($id).')');

        return $query;
    }
      public function multipleDelete($selected) {
        $query = $this->db->query("DELETE FROM `webapp_articles` WHERE `id` IN ($selected)");
        return $query;
    }
}
