<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class notificationuser_model extends CI_Model
{
    public function create($notification, $user, $timestamp, $timestamp_receive)
    {
        $query = $this->db->query('INSERT INTO `webapp_notificationuser`( `notification`, `user`) VALUES ('.$this->db->escape($notification).','.$this->db->escape($user).')');
        $id = $this->db->insert_id();
        if (!$query) {
            return  0;
        } else {
            return  $id;
        }
    }
    public function beforeEdit($id)
    {
        $query = $this->db->query('SELECT * FROM `webapp_notificationuser` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function getSingleNotificationUser($id)
    {
        $query = $this->db->query('SELECT * FROM `webapp_notificationuser` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function edit($id, $notification, $user, $timestamp, $timestamp_receive)
    {
        $query = $this->db->query('UPDATE `webapp_notificationuser`
 SET `notification` = '.$this->db->escape($notification).', `user` = '.$this->db->escape($user).', `timestamp` = '.$this->db->escape($timestamp).',`timestamp_receive` = '.$this->db->escape($timestamp_receive).'
 WHERE id = ('.$this->db->escape($id).')');

        return 1;
    }
    public function delete($id)
    {
        $query = $this->db->query('DELETE FROM `webapp_notificationuser` WHERE `id`=('.$this->db->escape($id).')');

        return $query;
    }
}
