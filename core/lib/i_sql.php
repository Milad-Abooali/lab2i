<?php

     /**
     * Class i_sql
     *
     * Database Adaptor using mysqli for MySQL and MariaDB
     *
     * @package    App\Core\Database
     * @author     Milad Abooali <m.abooali@hotmail.com>
     * @copyright  2012 - 2020 Codebox
     * @license    http://codebox.ir/license/1_0.txt  Codebox License 1.0
     * @version    1.5.13
     */

    namespace App\Core;

    if (!defined('START')) die('__ You just find me! 😹 . . . <a href="javascript:history.back()">Go Back</a>');

    use mysqli_result;
    use RuntimeException;
    use function date;
    use function intval;
    use function is_object;
    use function mysqli_close;
    use function mysqli_connect;
    use function mysqli_connect_errno;
    use function mysqli_error;
    use function mysqli_free_result;
    use function mysqli_insert_id;
    use function mysqli_real_escape_string;
    use function mysqli_set_charset;
    use function mysqli_query;
    use function mysqli_fetch_array;

    class i_sql
    {
        private $hostname, $port , $database , $username , $password , $prefix, $note=array(), $sql=array(), $error=array();
        public  $DATE, $LINK;

        /**
         * MySQL Constructor.
         * @param array $database
         */
        function __construct($database)
        {
            $this->hostname = $database['hostname'];
            $this->port     = $database['port'];
            $this->username = $database['username'];
            $this->password = $database['password'];
            $this->database = $database['name'];
            $this->prefix   = $database['prefix'];
            $this->DATE     = date("y-m-d");
            $this->LINK = mysqli_connect($this->hostname, $this->username, $this->password, $this->database, $this->port);
            if (mysqli_connect_errno()) {throw new RuntimeException("Connect failed: %s\n", mysqli_connect_error());}
            mysqli_set_charset($this->LINK,'utf8');
        }

        /**
         * MySQL Destructor.
         */
        function __destruct()
        {
            mysqli_close($this->LINK);
        }

        /**
         * MySQL Run SQL.
         * @param  string $sql
         * @param  bool $insert
         * @return  bool|int|mysqli_result|string|null
         */
        private function _run($sql, $insert=false) {
            $insert_id = null;
            $this->sql[] = $sql;
            $sql_number = count($this->sql)-1;
            $result = mysqli_query($this->LINK, $sql) or false;
            $error = 0;
            $log = $sql;
            if (!$result) {
                $error = 1;
                $log .= '<br><b style="color:deeppink">#</b> ' . mysqli_error($this->LINK);
                $this->error[$sql_number] =  "Error: ".mysqli_error($this->LINK);
            }
            if ($insert && $result) {
                $result = mysqli_insert_id($this->LINK);
                $log .= ' <b style="color:deeppink">#</b> Inserted ID: <b style="color:blue">'.$result.'</b>';
            }
            m::aLog('database', $log, $error, 'sql');
            return ($this->error[$sql_number] ?? false) ? false : $result;
        }

        /**
         * MySQL Run SQL raw result.
         * @param string $sql
         * @return bool|int|mysqli_result|string|null
         */
        public function run($sql)
        {
            return $this->_run($sql);
        }

        /**
         * MySQL Escape inputs.
         * @param  array|string $input
         * @return  bool|array|string
         */
        public function escape($input)
        {
            $escaped = null;
            if ($input) {
                if (is_array($input)) {
                    foreach ($input as $key => $value)
                    {
                        $this->note[count($this->sql)][] =  "Escaped $value";
                        $key = mysqli_real_escape_string($this->LINK, $key);
                        $value = mysqli_real_escape_string($this->LINK, $value);
                        $escaped[$key] = $value;

                    }
                } else {
                    $this->note[count($this->sql)][] =  "Escaped $input";
                    $escaped = mysqli_real_escape_string($this->LINK, $input);
                }
            }

            return ($escaped) ?? false;
        }

        /**
         * MySQL Do query.
         * @param  string $sql
         * @param  int|null $limit
         * @param  string|null $order
         * @param  string|null $group
         * @return  array|bool
         */
        public function query($sql, $limit=null, $order=null, $group=null)
        {
            $order = $this->escape($order);
            $limit = intval($this->escape($limit));
            $group = $this->escape($group);
            (!$group) ?: $sql.=" GROUP BY $group ";
            (!$order) ?: $sql.=" ORDER BY $order ";
            (!$limit) ?: $sql.=" LIMIT $limit ";

            $result = $this->_run($sql);
            $output=array();
            if(is_object($result)) {
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                {
                    $output[] = $row;
                }
                mysqli_free_result($result);
            }
            return ($output) ? $output : false;
        }

        /**
         * MySQL Check database version.
         * @return string
         */
        public function ver()
        {
            $result = $this->query("SELECT version() as ver")[0]['ver'];
            $this->note[count($this->sql)][] =  "version: $result";
            return $result;
        }

        /**
         * MySQL Test if table is exist.
         * @param  string|null $table
         * @return  bool
         */
        public function isTable($table)
        {
            $result = $this->_run("show tables like '$table'");
            return (mysqli_fetch_array($result, MYSQLI_ASSOC)) ? true : false;
        }

        /**
         * MySQL Table information.
         * @param  string|null $table
         * @return  array|null
         */
        public function tableInfo($table)
        {
            return $this->query("show table status from ".$this->database." WHERE Name='$table'");
        }

        /**
         * MySQL Table column list.
         * @param null $table
         * @return array|bool
         */
        public function tableCol($table)
        {
            $list  = $this->query("SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE TABLE_NAME='$table' AND TABLE_SCHEMA='$this->database'");
            return ($list) ?? False;
        }

        /**
         * MySQL Clear data from table.
         * @param string|null $table
         * @return bool
         */
        public function clearData($table) {

            return $this->_run("TRUNCATE TABLE $table");
        }

        /**
         * MySQL Delete row by id.
         * @param $id
         * @param string|null $table
         * @return bool
         */
        public function deleteId($table, $id) {
            $id     = intval($this->escape($id));
            return $this->_run("DELETE FROM $table Where id=$id");
        }

        /**
         * MySQL Delete multi row.
         * @param string|null $table
         * @param string|null $where
         * @param string|null $end
         * @param string $start
         * @return bool
         */
        public function deleteAny($table, $where=null, $end=null, $start='0000-00-00') {
            $end       = $this->escape($end);
            $start     = $this->escape($start);
            $sql       = "DELETE FROM $table WHERE ";
            $sql      .= (!$where) ? null : " $where AND ";
            $sql      .= (!$end) ? ' 1 ': " DATE(timestamp) between '$start' and '$end' ";
            return $this->_run($sql);
          }

        /**
         * MySQL Insert data.
         * @param array $input
         * @param string|null $table
         * @return bool|int False on error, Int as inserted row id.
         *
         */
        public function insert($table, $input)
        {
            $data = array();
            foreach($input as $k => $v)
            {
                $key          = $this->escape($k);
                $data[$key]  = $this->escape($v);
            }
            $columns = implode(", ",array_keys($data));
            $values  = implode("', '", $data);
            $sql = "INSERT INTO `$table` ($columns) VALUES ('$values')";
            return $this->_run($sql,1);
        }

        /**
         * MySQL Generate SQL for update.
         * @param string|null $table
         * @param array $data
         * @return string
         */
        private function _updateSQL($table, $data)
        {

            $sql    = "UPDATE `$table` SET";
            foreach ($data as $k => $v) {
                $column  = $this->escape($k);
                $value   = $this->escape($v);
                $sql    .= " $column='$value'";
                end($data);
                $sql    .= ($k === key($data)) ? null : ',';
            }
            return $sql;
        }

        /**
         * MySQL Update row by id.
         * @param int $id
         * @param array $data
         * @param string|null $table
         * @return bool
         */
        public function updateId($table, $id, $data)
        {
            $id      = intval($this->escape($id));
            $sql     = $this->_updateSQL($table, $data);
            $sql    .= " WHERE id=$id";
            return $this->_run($sql);
        }

        /**
         * MySQL Update Multi row by id.
         * @param string $id | seprate by ,
         * @param array $data
         * @param string|null $table
         * @return bool
         */
        public function updateMultiIds($table, $id, $data)
        {
            $id      = intval($this->escape($id));
            $sql     = $this->_updateSQL($table, $data);
            $sql    .= " WHERE id IN ($id)";
            return $this->_run($sql);
        }
        /**
         * MySQL Update multi row.
         * @param array $data
         * @param string|null $table
         * @param string|null $where
         * @param string|null $end
         * @param string|null $start
         * @return bool
         */
        public function updateAny($table, $data, $where=null, $end=null, $start='0000-00-00')
        {
            $end       = $this->escape($end);
            $start     = $this->escape($start);
            $sql       = $this->_updateSQL($table, $data).' WHERE ';
            $sql      .= (!$where) ? null : " $where AND ";
            $sql      .= (!$end) ? ' 1 ': " DATE(timestamp) between '$start' and '$end' ";
            return $this->_run($sql);
        }

        /**
         * MySQL Increase value.
         * @param string $column
         * @param string|null $where
         * @param int $count
         * @param string|null $table
         * @return bool
         */
        public function increase($table, $column, $where=null, $count=1)
        {

            $column     = $this->escape($column);
            $count      = intval ($this->escape($count));
            $sql        = "UPDATE $table SET $column=$column+$count";
            (!$where)  ?: $sql.=" WHERE $where ";
            return $this->_run($sql);
        }

        /**
         * MySQL Decrease value.
         * @param string $column
         * @param string|null $where
         * @param int $count
         * @param string|null $table
         * @return bool
         */
        public function decrease($table, $column, $where=null, $count=1)
        {
            $column     = $this->escape($column);
            $count      = intval ($this->escape($count));
            $sql        = "UPDATE $table SET $column=$column-$count";
            (!$where)  ?: $sql.=" WHERE $where ";
            return $this->_run($sql);
        }

        /**
         * MySQL Append Dtring.
         * @param string|null $table
         * @param string $column
         * @param string|null $where
         * @param $string
         * @return bool
         */
        public function append($table, $column, $where=null,$string)
        {
            $column     = $this->escape($column);
            $count      = intval ($this->escape($string));
            $sql        = "UPDATE $table SET $column = CONCAT($column, '$string')";
            (!$where)  ?: $sql.=" WHERE $where ";
            return $this->_run($sql);
        }

        /**
         * MySQL Check if row exist.
         * @param string|null $where
         * @param string|null $end
         * @param string $start
         * @param string|null $table
         * @return int|bool
         */
        public function exist($table, $where=null, $end=null, $start='000-00-00')
        {
            $start      = $this->escape($start);
            $end        = $this->escape($end);
            $sql        = "SELECT * FROM $table WHERE ";
            $sql       .= (!$where) ? null : " $where AND ";
            $sql       .= (!$end) ? ' 1 ': " DATE(timestamp) between '$start' and '$end' ";
            $result     = $this->query($sql);
            return ($result) ? count($result) : false;
        }

        /**
         * MySQL Count COL rows.
         * @param string|null $table
         * @param string|null $where
         * @param string $col
         * @return int|bool
         */
        public function countCol($table, $where=null, $col='id')
        {
            $sql        = "SELECT COUNT($col) as count FROM $table";
            $sql       .= (!$where) ? null : " WHERE $where";
            return $this->query($sql,1)[0]['count'];
        }

        /**
         * MySQL Count rows.
         * @param string|null $where
         * @param string|null $end
         * @param string $start
         * @param string|null $table
         * @return int|bool
         */
        public function count($table, $where=null, $end=null, $start='000-00-00')
        {
            $start      = $this->escape($start);
            $end        = $this->escape($end);
            $sql        = "SELECT COUNT(*) as count FROM $table WHERE ";
            $sql       .= (!$where) ? null : " $where AND ";
            $sql       .= (!$end) ? ' 1 ': " DATE(timestamp) between '$start' and '$end' ";
            return $this->query($sql,1)[0]['count'];
        }

        /**
         * MySQL Sum column.
         * @param string|null $table
         * @param $column
         * @param string|null $where
         * @param string|null $end
         * @param string $start
         * @return int|bool
         */
        public function sum($table, $column, $where=null, $end=null, $start='000-00-00')
        {
            $start      = $this->escape($start);
            $end        = $this->escape($end);
            $column     = $this->escape($column);
            $sql        = "SELECT SUM($column) as sum FROM $table WHERE ";
            $sql       .= (!$where) ? null : " $where AND ";
            $sql       .= (!$end) ? ' 1 ': " DATE(timestamp) between '$start' and '$end' ";
            return $this->query($sql,1)[0]['sum'];
        }

        /**
         * MySQL Average column.
         * @param string|null $table
         * @param $column
         * @param string|null $where
         * @param string|null $end
         * @param string $start
         * @return int|bool
         */
        public function avg($table, $column, $where=null, $end=null, $start='000-00-00')
        {
            $start      = $this->escape($start);
            $end        = $this->escape($end);
            $column     = $this->escape($column);
            $sql        = "SELECT AVG($column) as avg FROM $table WHERE ";
            $sql       .= (!$where) ? null : " $where AND ";
            $sql       .= (!$end) ? ' 1 ': " DATE(timestamp) between '$start' and '$end' ";
            return $this->query($sql,1)[0]['avg'];
        }

        /**
         * MySQL Get row status.
         * @param int $id
         * @param string|null $table
         * @return bool|mixed
         */
        public function getStatus($table, $id)
        {
            $id      = intval($this->escape($id));
            $result = $this->query("SELECT status FROM $table WHERE id=$id",1);
            return ($result) ?  $result[0]['status'] : False;
        }

        /**
         * MySQL Get row timestamp.
         * @param int $id
         * @param string|null $table
         * @return bool|mixed
         */
        public function timestamp($table, $id)
        {
            $id      = intval($this->escape($id));
            $result = $this->query("SELECT timestamp FROM $table WHERE id=$id",1);
            return ($result) ?  $result[0]['timestamp'] : False;
        }

        /**
         * MySQL Main select.
         * @param string|null $table
         * @param string|null $where
         * @param string $column
         * @param int|null $limit
         * @param string|null $order
         * @param string|null $group
         * @param string|null $end
         * @param string $start
         * @return array|bool
         */
        public function select($table, $where=null, $column='*', $limit=null, $order=null, $group=null, $end=null, $start='000-00-00')
        {
            $column     = $this->escape($column);
            $sql        = "SELECT $column FROM $table WHERE";
            $sql       .= (!$where) ? null : " $where AND ";
            $sql       .= (!$end) ? ' 1 ': " DATE(timestamp) between '$start' and '$end' ";
            return $this->query($sql, $limit, $order, $group);
        }

        /**
         * MySQL Select rRow.
         * @param string|null $where
         * @param string|null $order
         * @param string|null $table
         * @return array|bool
         */
        public function selectRow($table, $where=null, $order=null)
        {
            $sql = "SELECT * FROM $table";
            (!$where) ?: $sql.=" WHERE $where ";
            return $this->query($sql, 1, $order)[0] ?? false;
        }

        /**
         * MySQL Select row by id.
         * @param int $id
         * @param string|null $column
         * @param string|null $table
         * @return array|bool
         */
        public function selectId($table, $id, $column='*')
        {
            $column     = $this->escape($column);
            $id         = intval($this->escape($id));
            return $this->query("SELECT $column FROM $table WHERE id=$id",1)[0] ?? false;
        }

        /**
         * MySQL Select All.
         * @param int|null $limit
         * @param string|null $order
         * @param string|null $table
         * @return array|bool
         */
        public function selectAll($table, $limit=null, $order=null)
        {
            $sql = "SELECT * FROM $table";
            return $this->query($sql, $limit, $order);
        }

        /**
         * MySQL Log query and errors.
         * @param  string $type 'e' for Error Only, 'sql' for SQL only, null and other for All.
         * @return array
         */
        public function log($type=null)
        {
            if ($type=='e') {
                return $this->error;
            } elseif ($type=='sql') {
                return $this->sql;
            } else  {
                $logs=array();
                foreach ($this->sql as $i => $sql)
                {
                    $logs[$i]['SQL']=$sql;
                    $logs[$i]['Status']= ($this->error[$i]) ?? true;
                }
                return $logs;
            }
        }

    }

### Test Pad
