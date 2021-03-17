<?php
/**
 * Class Simple Vendor
 *
 * Mahan | Core simple vendor management
 *
 * @package    App\Core
 * @author     Milad Abooali <m.abooali@hotmail.com>
 * @copyright  2012 - 2020 Codebox
 * @license    http://codebox.ir/license/1_0.txt  Codebox License 1.0
 * @version    1.0.0 - Costume
 */

namespace App\Core;

if (!defined('START')) die('__ You just find me! 😹 . . . <a href="javascript:history.back()">Go Back</a>');

class simple_vendor
{

    public $ERROR;
    private $db, $vendor=array();

    /**
     * simple_vendor constructor.
     */
    function __construct() {
        $this->db = new i_sql(DB_INFO);
    }

    /**
     * Register
     * @param string $email
     * @param string $password
     * @param string $f_name
     * @param string $l_name
     * @param int $phone
     * @param array $extra
     * @return bool|int|mysqli_result|string|null
     */
    public function signup($email,$password,$f_name,$l_name,$phone,$map_data,$address,$extra=null)
    {
        $insert_data = array();
        $insert_data['email'] = $email;
        $insert_data['password'] = password_hash($password, PASSWORD_BCRYPT, ["cost" => 8]);
        $insert_data['f_name'] = $f_name;
        $insert_data['l_name'] = $l_name;
        $insert_data['phone'] = $phone;
        $insert_data['extra'] = json_encode($extra);
        $insert_data['map_data'] = $map_data;
        $insert_data['address'] = $address;
        $insert_data['status'] = 0;
        $insert_id = $this->db->insert('vendors',$insert_data);
        if ($insert_id) {
            $hash_reg = $insert_id.md5($insert_id);
            $link_reg = APP_URL.'v-signup&i='.$insert_data['email'].'&h='.$hash_reg;
            $mail = new memail();
            $receivers[] = array(
                'id' => $insert_id,
                'email' => $insert_data['email'],
                'data' => array(
                    'LINK' => $link_reg
                )
            );
            $subject = 'SignUp on '.SITE['name'];
            $mail->send($receivers, $subject, 'signup-activate');
            return true;
        }
        return false;
    }


    /**
     * Update
     * @param int $id
     * @param string $email
     * @param string $f_name
     * @param string $l_name
     * @param int $phone
     * @param $address
     * @return bool|int|mysqli_result|string|null
     */
    public function Update($id, $email, $f_name, $l_name, $phone, $address)
    {
        $update_data = array();
        $update_data['email'] = $email;
        $update_data['f_name'] = $f_name;
        $update_data['l_name'] = $l_name;
        $update_data['phone'] = $phone;
        $update_data['address'] = $address;
        $update = $this->db->updateId('vendors', $id, $update_data);
        if($update) foreach ($update_data as $k => $v) $_SESSION['M']['vendor'][$k] = $update_data[$k];
        return $update;
    }

    /**
     * Activate
     * @param string $email
     * @param string $hash
     * @return bool
     */
    public function activate($email, $hash) {
        if ($this->getVendor($email)) {
            $hash_reg = $this->vendor['id'].md5($this->vendor['id']);
            if (($hash == $hash_reg) && ($this->vendor['status']==0)) {
                $data['status'] = 1;
                $this->update($this->vendor['id'], $data);
                $mail = new memail();
                $receivers[] = array(
                    'id' => $this->vendor['id'],
                    'email' => $this->vendor['email'],
                    'data' => array(
                        'LINK' => APP_URL.'v-signin',
                        'NAME' => $this->vendor['f_name']
                    )
                );
                $subject = 'Welcome to '.SITE['name'];
                $mail->send($receivers, $subject, 'signup-welcome');
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * Get All vendors
     * @return array
     */
    public function getAll() {
        return $this->db->select('vendors') ?? array();
    }

    /**
     * Get vendor by ID
     * @param int $id
     * @return bool
     */
    public function getId($id) {
        $id = intval($id);
        return ($id) ? $this->db->selectId('vendors',$id) : false;
    }

    /**
     * Check vendorname
     * @param string $email
     * @return bool
     */
    public function getVendor($email) {
        $email = $this->db->escape($email);
        $this->vendor = $this->db->selectRow('vendors',"email='$email'");
        return ($this->vendor) ? true : false;
    }

    /**
     * Check Password
     * @param string $password
     * @return bool
     */
    public function checkPass($password) {
        return (password_verify($password, $this->vendor['password'])) ? true : false;
    }

    /**
     * SignIn
     * @param string $password
     * @param string $email
     * @return bool
     */
    public function signin($email, $password) {
        $_SESSION['M']['vendor'] = false;
        $_SESSION['M']['user'] = false;
        if ($this->getVendor($email)) {
            if ($this->vendor['status']==0) {
                $_SESSION['M']['vendor'] = false;
                return false;
            }
            if ($this->checkPass($password)) {
                $_SESSION['M']['vendor'] = $this->vendor;
                $_SESSION['M']['vendor']['extra'] = json_decode($this->vendor['extra']);
                return true;
            } else {
                $_SESSION['M']['vendor'] = false;
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Logout
     * @return bool
     */
    public function signout() {
        $_SESSION['M']['vendor'] = false;
        $_SESSION['M']['user'] = false;
//        session_unset();
        return true;
    }

    /**
     * Update vendor Password.
     * @param int $id
     * @param string $password
     * @return bool|int|string|null
     */
    public function updatePass($id, $password) {
        $data['password'] = password_hash($password, PASSWORD_BCRYPT, ["cost" => 8]);
        return $this->db->updateId('vendors',$id, $data);
    }

    public function recoverPass($email)
    {
        if ($this->getVendor($email)) {
            $data['status'] = 2;
            $this->update($this->vendor['id'], $data);
            $hash = md5($this->vendor['email']).md5($this->vendor['id']);
            $link = APP_URL.'v-recoverPassword&i='.$this->vendor['email'].'&h='.$hash;
            $mail = new memail();
            $receivers[] = array(
                'id' => $this->vendor['id'],
                'email' => $this->vendor['email'],
                'data' => array(
                    'LINK' => $link,
                    'NAME' => $this->vendor['f_name']
                )
            );
            $subject = 'Password Recovery Request on '.SITE['name'];
            $mail->send($receivers, $subject, 'recovery-pass-link');
            $this->logout();
            return true;
       } else {
           return false;
       }
    }

    public function recoverCheck($email,$hash)
    {
        if ($this->getVendor($email)) {
            if (($hash == (md5($this->vendor['email']).md5($this->vendor['id']))) && ($this->vendor['status']==2)) {
                $data['status'] = 1;
                $this->update($this->vendor['id'], $data);
                return true;
            }
        } else {
            return false;
        }
    }

    public function changePass($email,$new_pass)
    {
        if ($this->getVendor($email)) {
            if ($this->updatePass($this->vendor['id'], $new_pass)) {
                $mail = new memail();
                $receivers[] = array(
                    'id' => $this->vendor['id'],
                    'email' => $this->vendor['email'],
                    'data' => array(
                        'LINK' => APP_URL.'v-signin',
                        'NAME' => $this->vendor['f_name']
                    )
                );
                $subject = 'Password Changed - '.SITE['name'];
                $mail->send($receivers, $subject, 'recovery-pass-done');
                return true;
            }
        } else {
            return false;
        }
    }

}
