<?php
/**
 * Class View
 *
 * Mahan | View handler
 *
 * @package    App\Core
 * @author     Milad Abooali <m.abooali@hotmail.com>
 * @copyright  2012 - 2020 Codebox
 * @license    http://codebox.ir/license/1_0.txt  Codebox License 1.0
 * @version    1.0.0
 */

    namespace App\Core;

    if (!defined('START')) die('__ You just find me! 😹 . . . <a href="javascript:history.back()">Go Back</a>');

    class View
    {
        public $THEME, $INFO, $PATH, $LANG;
        private $page, $page_path, $data=array(), $cache;

        /**
         * View constructor.
         * @param array $page
         * @param string $them
         * @param string|null $lang
         */
        function __construct($page, $them='termeh', $lang=null) {
            $this->setTheme($them);
            $this->page = $page;
            $this->data['GET'] = $page['data'];
            $this->cache = $page['cache'] ?? true;
            $this->LANG = $lang ?? SITE['lang'];
        }

        /**
         * Set active theme
         * @param string|null $them
         */
        public function setTheme($them=null)
        {
            $them = (!$them) ? 'termeh' : $them;
            $this->PATH="core/view/$them/";
            if (file_exists($this->PATH.'info.json')) {
                $this->THEME = $them;
                $this->INFO = json_decode(file_get_contents($this->PATH.'info.json'));
                M::aLog('view',"Them set to <b style='color:purple'>$this->THEME</b>.");
                M::aLog('view',json_encode($this->INFO));
            } else {
                M::aLog('view',"Them set to <b style='color:purple'>$this->THEME</b>.",1);
            }
        }

        /**
         * Load page view
         */
        public function loadPage()
        {
            $this->page_path = $this->PATH.$this->page['view'].'.php';

            if (isset($_GET['mLive'])) {
                M::aLog('view',"<b style='color:blue'>M</b>: Force to load live version and delete the cached file");
                $this->clearCache($this->page['vid'].'_');
            }

            if (file_exists($this->page_path)) {
                (!isset($this->page['upon'])) ?: $this->_runUpon();
                if (CACHE['enable']) {
                    M::aLog('view',"Server Cache is <b style='color:green'>ON</b>");
                    if ($this->cache) {
                        M::aLog('view',"File Cache is <b style='color:green'>ON</b>");
                        $this->_doCache();
                    } else {
                        M::aLog('view',"File Cache is <b style='color:orange'>OFF</b>, run on live version.");
                        ($this->page['vid']==false) ?: $this->clearCache($this->page['vid'].'*');
                        (!isset($this->page['inc'])) ?: $this->_runInc();
                        $output = file_get_contents($this->page_path);
                        $output = $this->_doUpon($output);
                        eval ("?> $output");
                        M::aLog('view',"View: <b style='color:green'>$this->page_path</b> is loaded.");
                    }
                } else {
                    M::aLog('view',"Server Cache is <b style='color:orange'>OFF</b>, run on live version.");
                    (!isset($this->page['inc'])) ?: $this->_runInc();
                    $output = file_get_contents($this->page_path);
                    $output = $this->_doUpon($output);
                    eval ("?> $output");
                    M::aLog('view',"View: <b style='color:green'>$this->page_path</b> is loaded.");
                }
            } else {
                M::aLog('view',"View: <b style='color:red'>$this->page_path</b> is not exists!",1);
            }
        }

        /**
         * Run page live processes - upon
         */
        private function _runUpon()
        {
            $page_upon = 'core/upon/'.$this->page['upon'].'.php';
            if (file_exists($page_upon)) {
                /** @noinspection PhpIncludeInspection */
                include $page_upon;
                M::aLog('view',"Upon: <b style='color:green'>$page_upon</b> is loaded.");
            } else {
                M::aLog('view',"Upon: <b style='color:red'>$page_upon</b> is not exists!",1);
            }
        }

        /**
         * Run page processes - Inc
         */
        private function _runInc()
        {
            $page_inc = 'core/inc/'.$this->page['inc'].'.php';
            if (file_exists($page_inc)) {
                /** @noinspection PhpIncludeInspection */
                include $page_inc;
                M::aLog('view',"Inc: <b style='color:green'>$page_inc</b> is loaded.");
            } else {
                M::aLog('view',"Inc: <b style='color:red'>$page_inc</b> is not exists!",1);
            }
        }

        /**
         * Make upon tag
         * @param $input
         * @return string|string[]
         */
        private function _doUpon($input)
        {
            $find   = array(
                '<upon>',
                '<uponE>',
                '</upon>',
                '</uponE>'
            );
            $place  = array(
                '<?php ',
                '<?= ',
                ' ?>',
                ' ?>'
            );
            return str_replace($find,$place,$input);
        }

        /**
         * Make minify
         * @param $code
         * @return string|string[]
         */
        private function _doMinfy($code)
        {
            $search = array(

                // Remove whitespaces after tags
              '/\>[^\S ]+/s',

                // Remove whitespaces before tags
              '/[^\S ]+\</s',

                // Remove multiple whitespace sequences
              '/(\s)+/s',

                // Removes comments
              '/<!--(.|\s)*?-->/'
            );
            $replace = array('>', '<', '\\1');
            $code = preg_replace($search, $replace, $code);
            return $code;
        }

        /**
         * Creat cache file
         */
        private function _doCache()
        {
            $cached_file_name = $this->THEME.'_'.$this->LANG.'__'.$this->page['vid'].'_'.implode('_',$this->page['data']).'.php';
            $cached_file_path = './cache/'.$cached_file_name;
            if (file_exists($cached_file_path) && time() - CACHE['expire'] < filemtime($cached_file_path)) {
                M::aLog('view',"Load Cached File: <b style='color:maroon'>$cached_file_path</b>");
                $output = "<!-- Cached version, generated ".date('Y-m-d H:i', filemtime($cached_file_path))." by Mahan -->".file_get_contents($cached_file_path);
                $output = $this->_doUpon($output);
                eval ("?> $output");
            } else {
                M::aLog('view',"Start Caching File: <b style='color:maroon'>$cached_file_path</b>");
                (!isset($this->page['inc'])) ?: $this->_runInc();
                $output = file_get_contents($this->page_path);
                ob_start();
                eval ("?> $output");
                $cached = fopen($cached_file_path, 'w');
                if (CACHE['minify']) {
                    M::aLog('view',"Minification is <b style='color:green'>ON</b>, do minify.");
                    $ob_content = $this->_doMinfy(ob_get_contents());
                } else {
                    M::aLog('view',"Minification is <b style='color:orange'>OFF</b>.");
                    $ob_content = ob_get_contents();
                }
                fwrite($cached, $ob_content);
                fclose($cached);
                ob_end_clean();
                $output = $this->_doUpon($output);
                eval ("?> $output");
            }
        }

        /**
         * Clear cached files
         * @param string|null $theme
         * @param string|null $lang
         * @param string|null $vid
         */
        public function clearCache($vid=Null, $theme=Null, $lang=Null) {
            $theme = ($theme) ?? '*';
            $lang = ($lang) ?? '*';
            $vid = ($vid) ? str_replace('/','_', $vid) : '*';
            $make = './cache/'.$theme.'_'.$lang.'_'.$vid.'.php';
            array_map('unlink', glob($make));
            M::aLog('view',"Clear Cache: <b style='color:red'>$make</b>.");
        }

    }