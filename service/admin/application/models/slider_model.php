<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class slider_model extends CI_Model
{
    public function create($alt, $status, $order, $image)
    {
        $query = $this->db->query('INSERT INTO `slider`(`alt`, `status`, `order`, `image`) VALUES ('.$this->db->escape($alt).','.$this->db->escape($status).','.$this->db->escape($order).','.$this->db->escape($image).')');
        $id = $this->db->insert_id();
        if (!$query) {
            return  0;
        } else {
            return  $id;
        }
    }

    public function beforeEdit($id)
    {
        $query = $this->db->query('SELECT * FROM `slider` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function beforeEditHome($id)
    {
        $query = $this->db->query('SELECT * FROM `home` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function getSingleBlogImages($id)
    {
        $query = $this->db->query('SELECT * FROM `slider` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function edit($id, $alt, $status, $order, $image)
    {
        $query = $this->db->query('UPDATE `slider`
 SET `alt` = '.$this->db->escape($alt).', `status` = '.$this->db->escape($status).',`order` = '.$this->db->escape($order).',`image` = '.$this->db->escape($image).'
 WHERE id = ('.$this->db->escape($id).')');

        return 1;
    }
    public function editHome($id, $content)
    {
        $query = $this->db->query('UPDATE `home`
 SET `content` = '.$this->db->escape($content).', `status` = 1
 WHERE id = ('.$this->db->escape($id).')');

        return 1;
    }
    public function delete($id)
    {
        $query = $this->db->query('DELETE FROM `slider` WHERE `id`=('.$this->db->escape($id).')');

        return $query;
    }
    public function getImageById($id)
    {
        $query = $this->db->query('SELECT `image` FROM `slider` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }

    public function clearSliderImage($id)
    {
        $query = $this->db->query("UPDATE `slider` SET `image` = '' WHERE id = (".$this->db->escape($id).')');

        return $query;
    }
     public function multipleDelete($selected) {
        $query = $this->db->query("DELETE FROM `slider` WHERE `id` IN ($selected)");
        return $query;
    }
}
