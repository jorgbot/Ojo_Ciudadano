<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Menu_Model extends CI_Model
{
    public function create($name, $description, $keyword, $url, $linktype, $parentmenu, $menuaccess, $isactive, $order, $icon)
    {
        date_default_timezone_set('Asia/Calcutta');
        $query = $this->db->query('INSERT INTO `menu`( `name`, `description`, `keyword`,`url`, `linktype`,`parent`,`isactive`,`order`,`icon`) VALUES ('.$this->db->escape($name).','.$this->db->escape($description).','.$this->db->escape($keyword).','.$this->db->escape($url).','.$this->db->escape($linktype).','.$this->db->escape($parentmenu).','.$this->db->escape($isactive).','.$this->db->escape($order).','.$this->db->escape($icon).')');
        $menuid = $this->db->insert_id();
        if (!$query) {
            return  0;
        } else {
            return  $id;
        }
        if (!empty($menuaccess)) {
            foreach ($menuaccess as $row) {
                $query = $this->db->query('INSERT INTO `menuaccess`( `menu`, `access`) VALUES ('.$this->db->escape($menuid).','.$this->db->escape($row).')');
            }
        }
        if (!$query) {
            return  0;
        } else {
            return  1;
        }
    }
    public function viewMenu()
    {
        $query = 'SELECT `menu`.`id` as `id`,`menu`.`name` as `name`,`menu`.`description` as `description`,`menu`.`keyword` as `keyword`,`menu`.`url` as `url`,`menu2`.`name` as `parentmenu`,`menu`.`linktype` as `linktype`,`menu`.`icon`,`menu`.`order` FROM `menu`
		LEFT JOIN `menu` as `menu2` ON `menu2`.`id` = `menu`.`parent`
		ORDER BY `menu`.`order` ASC';

        $query = $this->db->query($query)->result();

        return $query;
    }
    public function beforeEdit($id)
    {
        $this->db->where('id', $id);
        $query['menu'] = $this->db->get('menu')->row();
        $query['menuaccess'] = array();
        $menu_arr = $this->db->query('SELECT `access` FROM `menuaccess` WHERE `menu`=('.$this->db->escape($id).') ')->result();
        foreach ($menu_arr as $row) {
            $query['menuaccess'][] = $row->access;
        }

        return $query;
    }

    public function edit($id, $name, $description, $keyword, $url, $linktype, $parentmenu, $menuaccess, $isactive, $order, $icon)
    {
        $query = $this->db->query('UPDATE `menu`
 SET `name` = '.$this->db->escape($name).', `description` = '.$this->db->escape($description).',`keyword` = '.$this->db->escape($keyword).',`url` = '.$this->db->escape($url).',`linktype` = '.$this->db->escape($linktype).',`parent` = '.$this->db->escape($parentmenu).',`isactive` = '.$this->db->escape($isactive).',`order` = '.$this->db->escape($order).',`icon` = '.$this->db->escape($icon).'
 WHERE id = ('.$this->db->escape($id).')');

        $this->db->query('DELETE FROM `menuaccess` WHERE `menu`=('.$this->db->escape($id).')');
        if (!empty($menuaccess)) {
            foreach ($menuaccess as  $row) {
                $query = $this->db->query('INSERT INTO `menuaccess`( `menu`, `access`) VALUES ('.$this->db->escape($id).','.$this->db->escape($row).')');
            }
        }

        return 1;
    }
    public function deleteMenu($id)
    {
        $query = $this->db->query('DELETE FROM `menu` WHERE `id`=('.$this->db->escape($id).')');
        $query = $this->db->query('DELETE FROM `menuaccess` WHERE `menu`=('.$this->db->escape($id).')');
    }
    public function getMenu()
    {
        $query = $this->db->query('SELECT * FROM `menu`  ORDER BY `id` ASC')->result();
        $return = array(
        '' => '',
        );

        foreach ($query as $row) {
            $return[$row->id] = $row->name;
        }

        return $return;
    }
    public function viewMenus()
    {
        $accesslevel = $this->session->userdata('accesslevel');
        $query = 'SELECT `menu`.`id` as `id`,`menu`.`name` as `name`,`menu`.`description` as `description`,`menu`.`keyword` as `keyword`,`menu`.`url` as `url`,`menu2`.`name` as `parentmenu`,`menu`.`linktype` as `linktype`,`menu`.`icon` FROM `menu`
		LEFT JOIN `menu` as `menu2` ON `menu2`.`id` = `menu`.`parent`
        INNER  JOIN `menuaccess` ON  `menuaccess`.`menu`=`menu`.`id`
		WHERE `menu`.`parent`=0 AND `menuaccess`.`access`=('.$this->db->escape($accesslevel).')
		ORDER BY `menu`.`order` ASC';

        $query = $this->db->query($query)->result();

        return $query;
    }
    public function getSubMenus($parent)
    {
        $query = 'SELECT `menu`.`id` as `id`,`menu`.`name` as `name`,`menu`.`description` as `description`,`menu`.`keyword` as `keyword`,`menu`.`url` as `url`,`menu`.`linktype` as `linktype`,`menu`.`icon` FROM `menu`
		WHERE `menu`.`parent` = ('.$this->db->escape($id).')
		ORDER BY `menu`.`order` ASC';

        $query = $this->db->query($query)->result();

        return $query;
    }
    public function getPages($parent)
    {
        $query = 'SELECT `menu`.`id` as `id`,`menu`.`name` as `name`,`menu`.`url` as `url` FROM `menu`
		WHERE `menu`.`parent` = ('.$this->db->escape($id).')
		ORDER BY `menu`.`order` ASC';

        $query2 = $this->db->query($query)->result();
        $url = array();
        foreach ($query2 as $row) {
            $pieces = explode('/', $row->url);

            if (empty($pieces) || !isset($pieces[1])) {
                $page2 = '';
            } else {
                $page2 = $pieces[1];
            }

            $url[] = $page2;
        }
        //print_r($url);
        return $url;
    }
}
