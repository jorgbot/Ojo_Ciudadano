<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class RestApi_model extends CI_Model
{
    public function setNotificationToken($os, $token)
    {
        if ($os == '' || $os == 'undefined' || $token == '' || $token == 'undefined') {
            return false;
        } else {
            $query4 = $this->db->query('SELECT * FROM `notificationtoken` WHERE `os`=('.$this->db->escape($os).') AND `token`=('.$this->db->escape($token).')');
            if ($query4->num_rows == 0) {
                $query = $this->db->query('INSERT INTO `notificationtoken`( `os`, `token`) VALUES ('.$this->db->escape($os).','.$this->db->escape($token).')');
                $id = $this->db->insert_id();
            } else {
            }
            if (!$query) {
                return  false;
            } else {
                return  $id;
            }
        }
    }
    public function createEnquiry($name, $email, $user, $content, $title)
    {
        $query = $this->db->query('INSERT INTO `webapp_enquiry`( `name`, `email`, `user`,`content`, `title`) VALUES ('.$this->db->escape($name).','.$this->db->escape($email).','.$this->db->escape($user).','.$this->db->escape($content).','.$this->db->escape($title).')');
        $id = $this->db->insert_id();
        if (!$query) {
            return  0;
        } else {
            return  1;
        }
    }
    public function blogIds()
    {
        $query = $this->db->query('SELECT `id` FROM `webapp_blog`')->result();

        return $query;
    }
    public function signUp($username, $email, $password, $dob, $os, $token)
    {
        $password = md5($password);
         $query1=$this->db->query("SELECT `id` FROM `user` WHERE `email`='$email'");
				$num=$query1->num_rows();
        if($num == 0)
        {
            $query = $this->db->query('INSERT INTO `user`( `name`, `email`, `password`,`eventnotification`,`photonotification`,`videonotification`,`blognotification`,`dob`,`logintype`,`accesslevel`) VALUES ('.$this->db->escape($username).','.$this->db->escape($email).','.$this->db->escape($password).",'false','false','false','false',".$this->db->escape($dob).",'Email','3')");
            $id = $this->db->insert_id();

            $query4 = $this->db->query('SELECT * FROM `notificationtoken` WHERE `os`=('.$this->db->escape($os).') AND `token`=('.$this->db->escape($token).')');
            if ($query4->num_rows == 0) {
                $query3 = $this->db->query('INSERT INTO `notificationtoken`(`os`,`token`,`user`) VALUES ('.$this->db->escape($os).','.$this->db->escape($token).','.$this->db->escape($id).')');
                $tokenid = $this->db->insert_id();
            } else {
            }

            $newdata = $this->db->query('SELECT `id`, `name`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json`, `dob`, `street`, `address`, `city`, `state`, `pincode`, `facebook`, `twitter`, `google`, `country`, `instagram`, `contact`, `eventnotification`, `photonotification`, `videonotification`, `blognotification`, `coverimage` FROM `user` WHERE `id`=('.$this->db->escape($id).')')->row();
            if (!$query) {
                return false;
            } else {
                return $newdata;
            }
        }
          else
        {
              $newdata=false;
              return $newdata;

        }
    }
    public function signIn($username, $password)
    {
        $password = md5($password);
        $query = $this->db->query('SELECT `id` FROM `user` WHERE `email`=('.$this->db->escape($username).') AND `password`= ('.$this->db->escape($password).')');
        if ($query->num_rows > 0) {
            $user = $query->row();
            $user = $user->id;
            $query1 = $this->db->query("UPDATE `user` SET `forgotpassword`='' WHERE `email`=(".$this->db->escape($username).')');
            $newdata = $this->db->query('SELECT `id`, `name`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json`, `dob`, `street`, `address`, `city`, `state`, `pincode`, `facebook`, `twitter`, `google`, `country`, `instagram`, `contact`, `eventnotification`, `photonotification`, `videonotification`, `blognotification`, `coverimage`, `forgotpassword` FROM `user` WHERE `id`=('.$this->db->escape($user).')')->row();
            $this->session->set_userdata($newdata);
            //print_r($newdata);
            return $newdata;
        } elseif ($query->num_rows == 0) {
            $query3 = $this->db->query('SELECT `id` FROM `user` WHERE `email`=('.$this->db->escape($username).') AND `forgotpassword`= ('.$this->db->escape($password).')');
            if ($query3->num_rows > 0) {
                $user = $query3->row();
                $user = $user->id;
                $query1 = $this->db->query("UPDATE `user` SET `forgotpassword`='',`password`=(".$this->db->escape($password).') WHERE `email`=('.$this->db->escape($username).')');
                $newdata = $this->db->query('SELECT `id`, `name`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json`, `dob`, `street`, `address`, `city`, `state`, `pincode`, `facebook`, `twitter`, `google`, `country`, `instagram`, `contact`, `eventnotification`, `photonotification`, `videonotification`, `blognotification`, `coverimage`, `forgotpassword` FROM `user` WHERE `id`=('.$this->db->escape($user).')')->row();

                $this->session->set_userdata($newdata);
                    //print_r($newdata);
                    return $newdata;
            } else {
                return false;
            }
        }
    }

    public function getAppConfig()
    {
        $query = $this->db->query('SELECT `id`, `title`, `content`, `text`, `type`, `image` FROM `config`')->result();

        return $query;
    }

    public function profileSubmit($id, $name, $email, $password, $dob, $contact)
    {
        $password = md5($password);
        $query = $this->db->query('UPDATE `user`
 SET `name` = '.$this->db->escape($name).', `email` = '.$this->db->escape($email).',`password` = '.$this->db->escape($password).',`dob` = '.$this->db->escape($dob).',`contact` = '.$this->db->escape($contact).'
 WHERE id = ('.$this->db->escape($id).')');
        if (!$query) {
            return  0;
        } else {
            return  1;
        }
    }
    public function editProfile($id, $name, $email, $dob, $contact, $location)
    {
        //        $data=array("name" => $name,"email" => $email,"dob" => $dob,"contact" => $contact,"address" => $location);
//        $this->db->where( "id", $id );
//        $query=$this->db->update( "user", $data );
         $query = $this->db->query('UPDATE `user`
 SET `name` = '.$this->db->escape($name).', `email` = '.$this->db->escape($email).',`dob` = '.$this->db->escape($dob).',`contact` = '.$this->db->escape($contact).',`address` = '.$this->db->escape($location).'
 WHERE id = ('.$this->db->escape($id).')');

        $query1 = $this->db->query('SELECT `id`, `name`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json`, `dob`, `street`, `address`, `city`, `state`, `pincode`, `facebook`, `twitter`, `google`, `country`, `instagram`, `contact` FROM `user` WHERE `id`=('.$this->db->escape($id).')')->row();
        if ($query) {
            return  $query1;
        } else {
            return  0;
        }
    }
    public function searchArticleTitle($searchElement)
    {
        $query = $this->db->query("SELECT `id`, `status`, `title`, `json`, `content`, `timestamp`, `image` FROM `webapp_articles` WHERE `title` LIKE '%".$this->db->escape_like_str($searchElement)."%'")->result();

        return $query;
    }
    public function searchEventTitle($searchElement)
    {
        $query = $this->db->query("SELECT `id`, `status`, `title`, `timestamp`, `content`, `image`, `startdate`, `starttime` FROM `webapp_events` WHERE `title` LIKE '%".$this->db->escape_like_str($searchElement)."%'")->result();

        return $query;
    }
    public function searchBlogTitle($searchElement)
    {
        $query = $this->db->query("SELECT `id`, `name`, `title`, `json`, `content`, `timestamp` FROM `webapp_blog` WHERE `name` LIKe '%".$this->db->escape_like_str($searchElement)."%' OR `title` LIKE '%".$this->db->escape_like_str($searchElement)."%'")->result();

        return $query;
    }
    public function searchGalleryName($searchElement)
    {
        $query = $this->db->query("SELECT `id`, `order`, `status`, `name`, `json`, `timestamp`, `image` FROM `webapp_gallery` WHERE `name` LIKE '%".$this->db->escape_like_str($searchElement)."%'")->result();

        return $query;
    }
    public function searchVideoGalleryName($searchElement)
    {
        $query = $this->db->query("SELECT `id`, `order`, `status`, `name`, `json`, `timestamp` FROM `webapp_videogallery` WHERE `name` LIKE '%".$this->db->escape_like_str($searchElement)."%'")->result();

        return $query;
    }
    public function searchElement($searchElement)
    {
        $query['article'] = $this->db->query("SELECT `id`, `status`, `title`, `json`, `content`, `timestamp`, `image` FROM `webapp_articles` WHERE `title` LIKE '%".$this->db->escape_like_str($searchElement)."%'")->result();
        $query['events'] = $this->db->query("SELECT `id`, `status`, `title`, `timestamp`, `content`, `image`, `startdate`, `starttime` FROM `webapp_events` WHERE `title` LIKE '%".$this->db->escape_like_str($searchElement)."%'")->result();
        $query['blog'] = $this->db->query("SELECT `id`, `title`, `json`, `content`, `timestamp` FROM `webapp_blog` WHERE `title` LIKE '%".$this->db->escape_like_str($searchElement)."%'")->result();
        $query['gallery'] = $this->db->query("SELECT `id`, `order`, `status`, `name`, `json`, `timestamp`, `image` FROM `webapp_gallery` WHERE `name` LIKE '%".$this->db->escape_like_str($searchElement)."%'")->result();
        $query['videogallery'] = $this->db->query("SELECT `id`, `order`, `status`, `name`, `json`, `timestamp` FROM `webapp_videogallery` WHERE `name` LIKE '%".$this->db->escape_like_str($searchElement)."%'")->result();

        return $query;
    }

    public function getAllFrontmenu()
    {
        $query['menu'] = $this->db->query('SELECT `webapp_frontmenu`.`id`,`webapp_frontmenu`.`order`,`webapp_frontmenu`.`parent`,`webapp_frontmenu`.`status`,`webapp_frontmenu`.`name`,`webapp_frontmenu`.`json`,`webapp_frontmenu`.`image`,`webapp_frontmenu`.`linktype`,`webapp_frontmenu`.`event`,`webapp_frontmenu`.`blog`,`webapp_frontmenu`.`video`,`webapp_frontmenu`.`article`,`webapp_frontmenu`.`gallery`,`linktype`.`id` as `linktypeid`,`linktype`.`name` as `linktypename`,`linktype`.`status` as `linktypestatus`,`linktype`.`order` as `linktypeorder`,`linktype`.`link` as `linktypelink`,`webapp_events`.`title` as `eventname`,`webapp_blog`.`title` as `blogname`,`webapp_videogallery`.`name` as `videoname`,`webapp_articles`.`title` as `articlename`,`webapp_gallery`.`name` as `galleryname`,`webapp_frontmenu`.`icon` as `icon` FROM `webapp_frontmenu`
    LEFT OUTER JOIN `linktype` ON `linktype`.`id`=`webapp_frontmenu`.`linktype`
    LEFT OUTER JOIN `webapp_events` ON `webapp_events`.`id`=`webapp_frontmenu`.`event`
    LEFT OUTER JOIN `webapp_blog` ON `webapp_blog`.`id`=`webapp_frontmenu`.`blog`
    LEFT OUTER JOIN `webapp_videogallery` ON `webapp_videogallery`.`id`=`webapp_frontmenu`.`video`
    LEFT OUTER JOIN `webapp_articles` ON `webapp_articles`.`id`=`webapp_frontmenu`.`article`
    LEFT OUTER JOIN `webapp_gallery` ON `webapp_gallery`.`id`=`webapp_frontmenu`.`gallery` WHERE `webapp_frontmenu`.`status`=1 ORDER BY `webapp_frontmenu`.`order` ASC')->result();
        $query['config'] = $this->db->query('SELECT `id`, `title`, `content`, `text`, `type`, `image`, `description` FROM `config`')->result();

        return $query;
    }
    public function updateProfileImage($imageName, $userid)
    {
        $query = $this->db->query('UPDATE `user`
 SET `image` = '.$this->db->escape($imageName).'
 WHERE id = ('.$this->db->escape($userid).')');
        if (!$query) {
            return 0;
        } else {
            return $query;
        }
    }
    public function updateCoverImage($imageName, $userid)
    {
        $query = $this->db->query('UPDATE `user`
 SET `coverimage` = '.$this->db->escape($imageName).'
 WHERE id = ('.$this->db->escape($userid).')');
        if (!$query) {
            return 0;
        } else {
            return $query;
        }
    }
    public function getAllSliders()
    {
        $query = $this->db->query('SELECT `id`, `image`, `order`, `status`, `alt` FROM `slider` WHERE `status`=1')->result();

        return $query;
    }
    public function getSingleUserDetail($id)
    {
        $query = $this->db->query('SELECT `id`, `name`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json`, `dob`, `street`, `address` as `location`, `city`, `state`, `pincode`, `facebook`, `twitter`, `google`, `country`, `instagram`, `contact`, `eventnotification`, `photonotification`, `videonotification`, `blognotification`, `coverimage` FROM `user` WHERE `id`=('.$this->db->escape($id).')')->row();
        // eventnotification
        if ($query->eventnotification == 'true') {
            $query->eventnotification = true;
        } else {
            $query->eventnotification = false;
        }
        // photonotification
        if ($query->photonotification == 'true') {
            $query->photonotification = true;
        } else {
            $query->photonotification = false;
        }
        // videonotification
        if ($query->videonotification == 'true') {
            $query->videonotification = true;
        } else {
            $query->videonotification = false;
        }
        // blognotification
        if ($query->blognotification == 'true') {
            $query->blognotification = true;
        } else {
            $query->blognotification = false;
        }

        return $query;
    }
    public function getHomeContent()
    {
        $query = $this->db->query('SELECT `content` FROM `home`')->row();

        return $query;
    }
    public function changeSetting($id, $event, $photo, $video, $blog)
    {
        $query = $this->db->query('UPDATE `user` SET `eventnotification`=('.$this->db->escape($event).'),`photonotification`=('.$this->db->escape($photo).'),`videonotification`=('.$this->db->escape($video).'),`blognotification`=('.$this->db->escape($blog).') WHERE `id`=('.$this->db->escape($id).')');

        return $query;
    }
    public function changePassword($id, $oldpassword, $newpassword, $confirmpassword)
    {
        $oldpassword = md5($oldpassword);
        $newpassword = md5($newpassword);
        $confirmpassword = md5($confirmpassword);
        if ($newpassword === $confirmpassword) {
            $useridquery = $this->db->query('SELECT `id` FROM `user` WHERE `password`=('.$this->db->escape($oldpassword).')');
            if ($useridquery->num_rows() == 0) {
                return 0;
            } else {
                $query = $useridquery->row();
                $userid = $query->id;
                $updatequery = $this->db->query('UPDATE `user` SET `password`=('.$this->db->escape($newpassword).') WHERE `id`=('.$this->db->escape($userid).')');

                return 1;
            }
        } else {
            //            echo "New password and confirm password do not match!!!";
            return -1;
        }
    }
    public function sendNotificationAndroid($title, $message, $image, $icon)
    {
        $query = $this->db->query('SELECT * FROM `config` WHERE `id`=13')->row();
        $gcm = $query->content;
        $query1 = $this->db->query("SELECT * FROM `notificationtoken` WHERE `os`='Android'")->result();
        foreach ($query1 as $row) {
            $token = $row->token;
            $this->chintantable->sendGcm($gcm, $token, $title, $message, $image, $icon);
        }
    }
    public function sendNotificationIos($title)
    {
        $query = $this->db->query('SELECT * FROM `config` WHERE `id`=13')->row();
        $passphase = $query->description;
        $pem = $query->image;
        $query1 = $this->db->query("SELECT * FROM `notificationtoken` WHERE `os`='iOS'")->result();
        foreach ($query1 as $row) {
            $token = $row->token;
            $this->chintantable->sendApns($pem, $passphase, $token, $title);
        }
    }
}
