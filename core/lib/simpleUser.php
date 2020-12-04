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

class SimpleUser
{

    public $ERROR;
    private $db, $user=array();

    /**
     * SimpleUser constructor.
     */
    function __construct() {
        $this->db = new MySQL(DB_INFO);
    }

    /**
     * Register
     * @param string $email
     * @param string $password
     * @param string $f_name
     * @param string $l_name
     * @param int $phone
     * @param array $extra
     * @return bool|int|\mysqli_result|string|null
     */
    public function register($email,$password,$f_name,$l_name,$phone,$extra=null)
    {
        $this->db->setTable('users');
        $insert_data = array();
        $insert_data['email'] = $email;
        $insert_data['password'] = password_hash($password, PASSWORD_BCRYPT, ["cost" => 8]);
        $insert_data['f_name'] = $f_name;
        $insert_data['l_name'] = $l_name;
        $insert_data['phone'] = $phone;
        $insert_data['extra'] = json_encode($extra);
        $insert_data['status'] = 0;
        return $this->db->insert($insert_data);
    }

    /**
     * Get All users
     * @return array
     */
    public function getAll() {
        $this->db->setTable('users');
        return $this->db->select() ?? array();
    }

    /**
     * Get user by ID
     * @param int $id
     * @return bool
     */
    public function getId($id) {
        $this->db->setTable('users');
        $id = intval($id);
        return ($id) ? $this->db->selectId($id) : false;
    }

    /**
     * Check username
     * @param string $username
     * @return bool
     */
    public function getUser($username) {
        $this->db->setTable('users');
        $username = $this->db->escape($username);
        $this->user = $this->db->selectRow("username='$username'");
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
        if ($this->getUser($username)) {
            if ($this->user['status']==0) {
                $_SESSION['M']['user'] = false;
                return false;
            }
            if ($this->checkPass($password)) {
                $_SESSION['M']['user'] = $this->user;
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
        session_unset();
        return true;
    }

    /**
     * Upate User Password.
     * @param int $id
     * @param string $password
     * @return bool|int|string|null
     */
    public function updatePass($id, $password) {
        $this->db->setTable('user_list');
        $data['password'] = password_hash($password, PASSWORD_BCRYPT, ["cost" => 8]);
        return $this->db->updateId($id, $data);
    }

    /**
     * Upate User.
     * @param int $id
     * @param array $data
     * @return bool|int|\mysqli_result|string|null
     */
    public function update($id, $data) {
        $this->db->setTable('user_list');
        return $this->db->updateId($id, $data);
    }

}
