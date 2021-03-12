<?php
/**
 * Class Simple User
 *
 * Mahan | Core simple user management
 *
 * @package    App\Core
 * @author     Milad Abooali <m.abooali@hotmail.com>
 * @copyright  2012 - 2020 Codebox
 * @license    http://codebox.ir/license/1_0.txt  Codebox License 1.0
 * @version    1.0.0 - Costume
 */

namespace App\Core;

if (!defined('START')) die('__ You just find me! 😹 . . . <a href="javascript:history.back()">Go Back</a>');

class simple_user
{

    public $ERROR;
    private $db, $user=array();

    /**
     * simple_user constructor.
     */
    function __construct() {
        $this->db = new iSQL(DB_INFO);
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
    public function register($email,$password,$f_name,$l_name,$phone,$extra=null)
    {
        $insert_data = array();
        $insert_data['email'] = $email;
        $insert_data['password'] = password_hash($password, PASSWORD_BCRYPT, ["cost" => 8]);
        $insert_data['f_name'] = $f_name;
        $insert_data['l_name'] = $l_name;
        $insert_data['phone'] = $phone;
        $insert_data['extra'] = json_encode($extra);
        $insert_data['status'] = 0;
        $insert_id = $this->db->insert('users',$insert_data);
        if ($insert_id) {
            $hash_reg = $insert_id.md5($insert_id);
            $link_reg = APP_URL.'register&i='.$insert_data['email'].'&h='.$hash_reg;
            $mail = new mEmail();
            $receivers[] = array(
                'id' => $insert_id,
                'email' => $insert_data['email'],
                'data' => array(
                    'LINK' => $link_reg
                )
            );
            $subject = 'Registration on '.SITE['name'];
            $mail->send($receivers, $subject, 'register-activate');
            return true;
        }
        return false;
    }

    /**
     * Activate
     * @param string $username
     * @param string $hash
     * @return bool
     */
    public function activate($username, $hash) {
        if ($this->getUser($username)) {
            $hash_reg = $this->user['id'].md5($this->user['id']);
            if (($hash == $hash_reg) && ($this->user['status']==0)) {
                $data['status'] = 1;
                $this->update($this->user['id'], $data);
                $mail = new mEmail();
                $receivers[] = array(
                    'id' => $this->user['id'],
                    'email' => $this->user['email'],
                    'data' => array(
                        'LINK' => APP_URL.'login',
                        'NAME' => $this->user['f_name']
                    )
                );
                $subject = 'Welcome to '.SITE['name'];
                $mail->send($receivers, $subject, 'register-welcome');
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * Get All users
     * @return array
     */
    public function getAll() {
        return $this->db->select('users') ?? array();
    }

    /**
     * Get user by ID
     * @param int $id
     * @return bool
     */
    public function getId($id) {
        $id = intval($id);
        return ($id) ? $this->db->selectId('users',$id) : false;
    }

    /**
     * Check username
     * @param string $username
     * @return bool
     */
    public function getUser($username) {
        $username = $this->db->escape($username);
        $this->user = $this->db->selectRow('users',"email='$username'");
        return ($this->user) ? true : false;
    }

    /**
     * Check Password
     * @param string $password
     * @return bool
     */
    public function checkPass($password) {
        return (password_verify($password, $this->user['password'])) ? true : false;
    }

    /**
     * Login
     * @param string $password
     * @param string $username
     * @return bool
     */
    public function login($username, $password) {
        $_SESSION['M']['vendor'] = false;
        $_SESSION['M']['user'] = false;
        if ($this->getUser($username)) {
            if ($this->user['status']==0) {
                $_SESSION['M']['user'] = false;
                return false;
            }
            if ($this->checkPass($password)) {
                $_SESSION['M']['user'] = $this->user;
                $_SESSION['M']['user']['extra'] = json_decode($this->user['extra']);
                return true;
            } else {
                $_SESSION['M']['user'] = false;
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
    public function logout() {
        $_SESSION['M']['user'] = false;
        $_SESSION['M']['vendor'] = false;
//        session_unset();
        return true;
    }

    /**
     * Update User Password.
     * @param int $id
     * @param string $password
     * @return bool|int|string|null
     */
    public function updatePass($id, $password) {
        $data['password'] = password_hash($password, PASSWORD_BCRYPT, ["cost" => 8]);
        return $this->db->updateId('users',$id, $data);
    }

    /**
     * Upate User.
     * @param int $id
     * @param array $data
     * @return bool|int|string|null
     */
    public function update($id, $data) {
        $output =  $this->db->updateId('users', $id, $data);
        $_SESSION['M']['user'] = $this->getId($id);
        $_SESSION['M']['user']['extra'] = json_decode($_SESSION['M']['user']['extra']);
        return $output;
    }

    public function recoverPass($username)
    {
        if ($this->getUser($username)) {
            $data['status'] = 2;
            $this->update($this->user['id'], $data);
            $hash = md5($this->user['email']).md5($this->user['id']);
            $link = APP_URL.'recoverPassword&i='.$this->user['email'].'&h='.$hash;
            $mail = new mEmail();
            $receivers[] = array(
                'id' => $this->user['id'],
                'email' => $this->user['email'],
                'data' => array(
                    'LINK' => $link,
                    'NAME' => $this->user['f_name']
                )
            );
            $subject = 'Password Recovery Request on '.SITE['name'];
            $mail->send($receivers, $subject, 'recovery-pass-link');
            return true;
       } else {
           return false;
       }
    }

    public function recoverCheck($username,$hash)
    {
        if ($this->getUser($username)) {
            if (($hash == (md5($this->user['email']).md5($this->user['id']))) && ($this->user['status']==2)) {
                $data['status'] = 1;
                $this->update($this->user['id'], $data);
                return true;
            }
        } else {
            return false;
        }
    }

    public function changePass($username,$new_pass)
    {
        if ($this->getUser($username)) {
            if ($this->updatePass($this->user['id'], $new_pass)) {
                $mail = new mEmail();
                $receivers[] = array(
                    'id' => $this->user['id'],
                    'email' => $this->user['email'],
                    'data' => array(
                        'LINK' => APP_URL.'login',
                        'NAME' => $this->user['f_name']
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
