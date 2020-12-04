<?php
/**
 * Class Language
 *
 * Mahan | Language Parser
 *
 * @package    App\Core
 * @author     Milad Abooali <m.abooali@hotmail.com>
 * @copyright  2012 - 2020 Codebox
 * @license    http://codebox.ir/license/1_0.txt  Codebox License 1.0
 * @version    1.0
 */

    namespace App\Core;

    if (!defined('START')) die('__ You just find me! 😹 . . . <a href="javascript:history.back()">Go Back</a>');

    use function file_exists;

    class Language
    {
        public $LANG, $PATH, $LOG=array();

        /**
         * Language constructor.
         * @param $lang
         */
        function __construct($lang=null) {
            global $app_logs;
            (!LOG['language']) ?: $this->LOG =& $app_logs['language'];
            $this->setCoreLang($lang);
        }

        /**
         * Set core language
         * @param string|null $lang
         */
        public function setCoreLang($lang=null) {
            $core_lang_file = APP_ROOT."/core/language/$lang/";
            $this->LANG = ($lang) ? $lang : SITE['lang'];
            $this->LOG[] = "Set core language: $this->LANG" ;
            $this->PATH  =   (file_exists($core_lang_file.'core.ini')) ? $core_lang_file :  APP_ROOT.'core/language/'.SITE['lang'].'/';
            $this->LOG[] = 'Lang folder: "'.$this->PATH .'".';
            if (file_exists($this->PATH.'core.ini')) {
                $this->LOG[] = "$this->LANG core file is exists.";
                return true;
            } else {
                $this->LOG[] = "$this->LANG core file is not exists !";
                return false;
            }
        }

    }

