<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class enquiry_model extends CI_Model
{
    public function create($user, $name, $email, $title, $timestamp, $content)
    {
        $query = $this->db->query('INSERT INTO `webapp_enquiry`( `user`, `name`, `email`,`title`, `content`) VALUES ('.$this->db->escape($title).','.$this->db->escape($user).','.$this->db->escape($content).','.$this->db->escape($name).','.$this->db->escape($email).')');
        $id = $this->db->insert_id();
        if (!$query) {
            return  0;
        } else {
            return  $id;
        }
    }
    public function beforeEdit($id)
    {
        $query = $this->db->query('SELECT * FROM `webapp_enquiry` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function getSingleEnquiry($id)
    {
        $query = $this->db->query('SELECT * FROM `webapp_enquiry` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function edit($id, $user, $name, $email, $title, $timestamp, $content)
    {
        $query = $this->db->query('UPDATE `webapp_enquiry`
 SET `title` = '.$this->db->escape($title).', `user` = '.$this->db->escape($user).',`content` = '.$this->db->escape($content).',`timestamp` = '.$this->db->escape($timestamp).',`email` = '.$this->db->escape($email).',`name` = '.$this->db->escape($name).'
 WHERE id = ('.$this->db->escape($id).')');

        return 1;
    }
    public function delete($id)
    {
        $query = $this->db->query('DELETE FROM `webapp_enquiry` WHERE `id`=('.$this->db->escape($id).')');

        return $query;
    }

    public function total()
    {
        $query = $this->db->query('SELECT count(*) as `count` FROM `webapp_enquiry`')->row();

        return $query->count;
    }
}
