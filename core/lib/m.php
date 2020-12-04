<?php
/**
 * Class M
 *
 * Mahan | Static Functions
 *
 * @package    App\Core
 * @author     Milad Abooali <m.abooali@hotmail.com>
 * @copyright  2012 - 2020 Codebox
 * @license    http://codebox.ir/license/1_0.txt  Codebox License 1.0
 * @version    1.0.0
 */

    namespace App\Core;

    if (!defined('START')) die('__ You just find me! 😹 . . . <a href="javascript:history.back()">Go Back</a>');

    use function print_r;

    /**
     * Class M
     *
     * Mahan core functions
     *
     * @package    App\Core
     * @author     Milad Abooali <m.abooali@hotmail.com>
     * @copyright  2012 - 2020 Codebox
     * @license    http://codebox.ir/license/1_0.txt  Codebox License 1.0
     * @version    1.0
     */
    class M
    {

        /**
         * Print input in pre as code
         * @param string|array $input
         * @param bool $eol
         * @param string|bool $block
         */
        public static function print($input, $block=false, $eol=false) {
            echo ($block) ? "<$block>" : null;
            echo ($eol) ? PHP_EOL : null;;
            echo '<pre><code>';
            if(is_array($input)) {
                print_r($input);
            } else {
                print($input);
            }
            echo '</code></pre>';
            echo ($eol) ? PHP_EOL : null;;
            echo ($block) ? "</$block>" : null;
        }

        /**
         * App logs raw print
         * @param int $type     0 print on page | 1 console log
         */
        public static function log($type=0) {
            global $app_logs;
            if ($type==1) {
                $log['Mahan Log'] = $app_logs;
                M::console($log);
            } elseif (isset($_GET['mLog']) || LOG_FORCE) {
                echo PHP_EOL."<!-- Log by Mahan -->".PHP_EOL;
                echo '<style>
                        #m-log {
                            height: 10%;
                            overflow: hidden;
                            margin-bottom:100px;
                        }
                        #m-log:hover {
                            height: auto;
                        }
                        .m-log-table {
                            font-family: sans-serif;
                            font-size: 12px;
                            width: 1150px;
                            max-width: 90%;
                            border-collapse: collapse;
                            margin: 20px auto;
                        }
                        .m-log-table .m-log-by th {
                            background: #ffca08;
                            color: #fff;
                        }
                        .m-log-table th {
                            text-transform: capitalize;
                            text-align: center;
                            font-weight: 600;
                            font-size: 13px;
                            color: #039;
                            background: #b9c9fe;
                            padding: 8px;
                        }
                        .m-log-table td {
                            background: #e8edff;
                            border-top: 1px solid #fff;
                            color: #669;
                            padding: 8px;
                        }
                        .m-log-table tbody tr:hover td {
                            background: #d0dafd;
                        }
                        </style>';
                echo '<div id="m-log"><table class="m-log-table">';
                echo "<tr class='m-log-by'><th>Mahan App Logs</th></tr>";
                foreach ($app_logs as $section_name => $section) {
                    echo "<tr><th>$section_name</th></tr>";
                    echo "<tr><td>";
                    M::print($section);
                    echo "</td></tr>";
                }
                echo '</table></div>';
            }
        }

        /**
         * Time of process
         */
        public static function pTime() {
            return M::nf((microtime(true)-START)*1000,'4').' ms';
        }

        /**
         * Add Log
         * @param string $type
         * @param string|null $text
         * @param null $error
         * @param string|null $sub
         * @param null $id
         * @return bool
         */
        public static function aLog($type, $text=null, $error=null, $sub=null, $id=null) {
            global $app_logs;
            $error = ($error) ? ' <b style="color:red">Error</b> ' : ' <b style="color:darkolivegreen">OK</b> ';
            if ($id) {
                if ($sub) {
                    (!LOG[$type]) ?: $app_logs[$type][$sub][$id] = '[<b style="color: darkslateblue">'.M::nf((microtime(true)-START)*1000,'4').' ms</b>] '.$error.$text;
                } else {
                    (!LOG[$type]) ?: $app_logs[$type][$id] = '[<b style="color: darkslateblue">'.M::nf((microtime(true)-START)*1000,'4').' ms</b>] '.$error.$text;
                }
            } else {
                if ($sub) {
                    (!LOG[$type]) ?: $app_logs[$type][$sub][] = '[<b style="color: darkslateblue">'.M::nf((microtime(true)-START)*1000,'4').' ms</b>] '.$error.$text;
                } else {
                    (!LOG[$type]) ?: $app_logs[$type][] = '[<b style="color: darkslateblue">'.M::nf((microtime(true)-START)*1000,'4').' ms</b>] '.$error.$text;
                }
            }
            return true;
        }


        /**
         * Add JS to output
         * @param string $data
         */
        public static function addJS($data) {
            echo "<script>$data</script>";
        }

        /**
         * Alert on page
         * @param $data
         */
        public static function alert($data) {
            echo '<script>alert(JSON.stringify('.json_encode($data).'))</script>';
        }

        /**
         * Add to console log
         * @param null $data
         */
        public static function console($data=NULL) {
            echo '<script>console.log('.json_encode($data).')</script>';
        }

        /**
         * Get Client IP
         * @return mixed
         */
        public static function getClientIP () {
            return (!empty($_SERVER['HTTP_CLIENT_IP'])) ? $_SERVER['HTTP_CLIENT_IP'] : (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
        }

        /**
         * Format Numbers
         * @param int $num
         * @param int $dot
         * @return string
         */
        static function nf ($num=0, $dot=0) {
            if ($dot==0) {
                $num = round ($num);
                $output = number_format ($num, 0, '.', ',');
            } else {
                $output = number_format ($num, $dot, '.', ' ');
            }
            return $output;
        }

    }