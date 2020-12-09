<?php

    /**
     * Class mEmail
     *
     * Mahan | Email Manager
     *
     * @package    -
     * @author     Milad Abooali <m.abooali@hotmail.com>
     * @copyright  -
     * @license    -
     * @version    1.0
     */


    namespace App\Core;

    if (!defined('START')) die('__ You just find me! 😹 . . . <a href="javascript:history.back()">Go Back</a>');

    class mEmail
    {

        private $db,$site_email,$path;

        function __construct() {
            $this->db = new iSQL(DB_INFO);
            $this->site_email = SITE['email'];
            $this->path = APP_ROOT.'core/inc/email-themes/';
        }

        /**
         * Send Email
         * @param array $receivers
         * @param string $subject
         * @param string $message
         * @param bool|string $theme
         * @return bool
         */
        public function send($receivers, $subject, $theme=false, $message=null) {
            foreach ($receivers as $receiver) {
                $headers = "MIME-Version: 1.0" . "\r\n";
                if ($theme) {
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $content = $this->_make($theme,$receiver['data'],$message);
                } else {
                    $headers .= "Content-type:text/plain;charset=UTF-8" . "\r\n";
                    $content = wordwrap($message,70);
                }
                $headers .= "From: ".$this->site_email;
                if(mail($receiver['email'], $subject, $content, $headers)) $this->_log($subject, $content, $receiver);
            }
            return true;
        }

        /**
         * Send Email
         * @param int $theme
         * @param array $data
         * @param string $message
         * @return bool
         */
        private function _make($theme,$data,$message) {
            $content = file_get_contents($this->path.$theme.'.htm');
            $searchVal[] = '{__ExtraMessage__}';
            $replaceVal[] = $message;
            if ($data) foreach ($data as $k => $v) {
                $searchVal[] = '{~~'.$k.'~~}';
                $replaceVal[] = $v;
            }
            return str_replace($searchVal, $replaceVal, $content);
        }

        /**
         * Log Sent Mails in Database
         * @param string $subject
         * @param string $content
         * @param array $receiver
         * @return bool
         */
        private function _log($subject, $content, $receiver) {
            $content_escaped = $this->db->escape($content);
            $data['subject'] = $this->db->escape($subject);
            $data['content'] = $content_escaped;
            $data['user_id'] = $receiver['id'];
            $data['email']   = $receiver['email'];
            $this->db->insert('log_email', $data);
            return true;
        }

    }