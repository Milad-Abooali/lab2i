<?php
/**
 * Class MySQL
 *
 * Mahan | MySQL Adaptor - SimpleDB
 *
 * @package    App\Core
 * @author     Milad Abooali <m.abooali@hotmail.com>
 * @copyright  2012 - 2020 Codebox
 * @license    http://codebox.ir/license/1_0.txt  Codebox License 1.0
 * @version    1.4.2
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

    class MySQL
    {
        private $hostname, $port, $database, $username, $password, $prefix;
        public $DATE, $LINK, $TABLE;

        /**
         * MySQL Constructor.
         * @param array $database
         * @param string|null $table
         */
        function __construct($database, $table = null)
        {
            $this->hostname = $database['hostname'];
            $this->port = $database['port'];
            $this->username = $database['username'];
            $this->password = $database['password'];
            $this->database = $database['name'];
            $this->prefix = $database['prefix'];
            $this->DATE = date("y-m-d");
            $this->LINK = mysqli_connect($this->hostname, $this->username, $this->password, $this->database, $this->port);
            if (mysqli_connect_errno()) {
                throw new RuntimeException("Connect failed: %s\n", mysqli_connect_error());
            }
            mysqli_set_charset($this->LINK, 'utf8');
            (!$table) ?: $this->setTable($table);
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
         * @param string $sql
         * @param bool $insert
         * @return  bool|int|mysqli_result|string|null
         */
        private function _run($sql, $insert = false)
        {
            $insert_id = null;
            $result = mysqli_query($this->LINK, $sql) or false;
            $error = 0;
            $log = $sql;
            if (!$result) {
                $error = 1;
                $log .= '<br><b style="color:deeppink">#</b> ' . mysqli_error($this->LINK);
            }
            if ($insert && $result) {
                $result = mysqli_insert_id($this->LINK);
                $log .= ' <b style="color:deeppink">#</b> Inserted ID: <b style="color:blue">'.$result.'</b>';
            }
            M::aLog('database', $log, $error, 'sql');
            return (!$result) ? false : $result;
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
         * @param array|string $input
         * @return  bool|array|string
         */
        public function escape($input)
        {
            $escaped = null;
            if ($input) {
                if (is_array($input)) {
                    foreach ($input as $key => $value) {
                        M::aLog('database', "Escaped $value", 0, 'note');
                        $key = mysqli_real_escape_string($this->LINK, $key);
                        $value = mysqli_real_escape_string($this->LINK, $value);
                        $escaped[$key] = $value;
                    }
                } else {
                    M::aLog('database', "Escaped $input", 0, 'note');
                    $escaped = mysqli_real_escape_string($this->LINK, $input);
                }
            }
            return ($escaped) ?? false;
        }

        /**
         * MySQL Do query.
         * @param string $sql
         * @param int|null $limit
         * @param string|null $order
         * @param string|null $group
         * @return  array|bool
         */
        public function query($sql, $limit = null, $order = null, $group = null)
        {
            $order = $this->escape($order);
            $limit = intval($this->escape($limit));
            $group = $this->escape($group);
            (!$group) ?: $sql .= " GROUP BY $group ";
            (!$order) ?: $sql .= " ORDER BY $order ";
            (!$limit) ?: $sql .= " LIMIT $limit ";

            $result = $this->_run($sql);
            $output = array();
            if (is_object($result)) {
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
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
            M::aLog('database', "version: $result", 0, 'note');
            return $result;
        }

        /**
         * MySQL Set table as environment.
         * @param string|null $table
         * @return  bool
         */
        public function setTable($table)
        {
            $this->TABLE = $this->prefix . $this->escape($table);
            M::aLog('database', "Set table: '$table'", 0, 'note');
            return ($this->TABLE) ? true : false;
        }

        /**
         * MySQL Test if table is exist.
         * @param string|null $table
         * @return  bool
         */
        public function isTable($table = null)
        {
            (!$table) ?: $this->setTable($table);
            $result = $this->_run("show tables like '$this->TABLE'");
            return (mysqli_fetch_array($result, MYSQLI_ASSOC)) ? true : false;
        }

        /**
         * MySQL Table information.
         * @param string|null $table
         * @return  array|null
         */
        public function tableInfo($table = null)
        {
            (!$table) ?: $this->setTable($table);
            return $this->query("show table status from " . $this->database . " WHERE Name='$this->TABLE'");
        }

        /**
         * MySQL Table column list.
         * @param null $table
         * @return array|bool
         */
        public function tableCol($table = null)
        {
            (!$table) ?: $this->setTable($table);
            $list = $this->query("SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE TABLE_NAME='$this->TABLE' AND TABLE_SCHEMA='$this->database'");
            return ($list) ?? False;
        }

        /**
         * MySQL Clear data from table.
         * @param string|null $table
         * @return bool
         */
        public function clearData($table = null)
        {
            (!$table) ?: $this->setTable($table);
            return $this->_run("TRUNCATE TABLE $this->TABLE");
        }

        /**
         * MySQL Delete row by id.
         * @param $id
         * @param string|null $table
         * @return bool
         */
        public function deleteId($id, $table = null)
        {
            (!$table) ?: $this->setTable($table);
            $id = intval($this->escape($id));
            return $this->_run("DELETE FROM $this->TABLE Where id=$id");
        }

        /**
         * MySQL Delete multi row.
         * @param string|null $table
         * @param string|null $where
         * @param string|null $end
         * @param string $start
         * @return bool
         */
        public function deleteAny($table = null, $where = null, $end = null, $start = '0000-00-00')
        {
            (!$table) ?: $this->setTable($table);
            $end = $this->escape($end);
            $start = $this->escape($start);
            $sql = "DELETE FROM $this->TABLE WHERE ";
            $sql .= (!$where) ? null : " $where AND ";
            $sql .= (!$end) ? ' 1 ' : " DATE(timestamp) between '$start' and '$end' ";
            return $this->_run($sql);
        }

        /**
         * MySQL Insert data.
         * @param array $input
         * @param string|null $table
         * @return bool|int False on error, Int as inserted row id.
         *
         */
        public function insert($input, $table = null)
        {
            (!$table) ?: $this->setTable($table);
            $data = array();
            foreach ($input as $k => $v) {
                $key = $this->escape($k);
                $data[$key] = $this->escape($v);
            }
            $columns = implode(", ", array_keys($data));
            $values = implode("', '", $data);
            $sql = "INSERT INTO `$this->TABLE` ($columns) VALUES ('$values')";
            return $this->_run($sql, 1);
        }

        /**
         * MySQL Generate SQL for update.
         * @param string|null $table
         * @param array $data
         * @return string
         */
        private function _updateSQL($table=null, $data)
        {
            (!$table) ?: $this->setTable($table);
            $sql = "UPDATE `$this->TABLE` SET";
            foreach ($data as $k => $v) {
                $column = $this->escape($k);
                $value = $this->escape($v);
                $sql .= " $column='$value'";
                end($data);
                $sql .= ($k === key($data)) ? null : ',';
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
        public function updateId($id, $data, $table = null)
        {
            $id = intval($this->escape($id));
            $sql = $this->_updateSQL($table, $data);
            $sql .= " WHERE id=$id";
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
        public function updateAny($data, $table = null, $where = null, $end = null, $start = '0000-00-00')
        {
            $end = $this->escape($end);
            $start = $this->escape($start);
            $sql = $this->_updateSQL($table, $data) . ' WHERE ';
            $sql .= (!$where) ? null : " $where AND ";
            $sql .= (!$end) ? ' 1 ' : " DATE(timestamp) between '$start' and '$end' ";
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
        public function increase($column, $where = null, $count = 1, $table = null)
        {
            (!$table) ?: $this->setTable($table);
            $column = $this->escape($column);
            $count = intval($this->escape($count));
            $sql = "UPDATE $this->TABLE SET $column=$column+$count";
            (!$where) ?: $sql .= " WHERE $where ";
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
        public function decrease($column, $where = null, $count = 1, $table = null)
        {
            (!$table) ?: $this->setTable($table);
            $column = $this->escape($column);
            $count = intval($this->escape($count));
            $sql = "UPDATE $this->TABLE SET $column=$column-$count";
            (!$where) ?: $sql .= " WHERE $where ";
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
        public function exist($where = null, $end = null, $start = '000-00-00', $table = null)
        {
            (!$table) ?: $this->setTable($table);
            $start = $this->escape($start);
            $end = $this->escape($end);
            $sql = "SELECT * FROM $this->TABLE WHERE ";
            $sql .= (!$where) ? null : " $where AND ";
            $sql .= (!$end) ? ' 1 ' : " DATE(timestamp) between '$start' and '$end' ";
            $result = $this->query($sql);
            return ($result) ? count($result) : false;
        }

        /**
         * MySQL Count rows.
         * @param string|null $where
         * @param string|null $end
         * @param string $start
         * @param string|null $table
         * @return int|bool
         */
        public function count($where = null, $end = null, $start = '000-00-00', $table = null)
        {
            (!$table) ?: $this->setTable($table);
            $start = $this->escape($start);
            $end = $this->escape($end);
            $sql = "SELECT COUNT(*) as count FROM $this->TABLE WHERE ";
            $sql .= (!$where) ? null : " $where AND ";
            $sql .= (!$end) ? ' 1 ' : " DATE(timestamp) between '$start' and '$end' ";
            return $this->query($sql, 1)[0]['count'];
        }

        /**
         * MySQL Sum column.
         * @param string|null $where
         * @param string|null $end
         * @param string $start
         * @param string|null $table
         * @return int|bool
         */
        public function sum($column, $where = null, $end = null, $start = '000-00-00', $table = null)
        {
            (!$table) ?: $this->setTable($table);
            $start = $this->escape($start);
            $end = $this->escape($end);
            $column = $this->escape($column);
            $sql = "SELECT SUM($column) as sum FROM $this->TABLE WHERE ";
            $sql .= (!$where) ? null : " $where AND ";
            $sql .= (!$end) ? ' 1 ' : " DATE(timestamp) between '$start' and '$end' ";
            return $this->query($sql, 1)[0]['sum'];
        }

        /**
         * MySQL Get row status.
         * @param int $id
         * @param string|null $table
         * @return bool|mixed
         */
        public function getStatus($id, $table = null)
        {
            (!$table) ?: $this->setTable($table);
            $id = intval($this->escape($id));
            $result = $this->query("SELECT status FROM $this->TABLE WHERE id=$id", 1);
            return ($result) ? $result[0]['status'] : False;
        }

        /**
         * MySQL Get row timestamp.
         * @param int $id
         * @param string|null $table
         * @return bool|mixed
         */
        public function timestamp($id, $table = null)
        {
            (!$table) ?: $this->setTable($table);
            $id = intval($this->escape($id));
            $result = $this->query("SELECT timestamp FROM $this->TABLE WHERE id=$id", 1);
            return ($result) ? $result[0]['timestamp'] : False;
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
        public function select($table = null, $where = null, $column = '*', $limit = null, $order = null, $group = null, $end = null, $start = '000-00-00')
        {
            (!$table) ?: $this->setTable($table);
            $column = $this->escape($column);
            $sql = "SELECT $column FROM $this->TABLE WHERE";
            $sql .= (!$where) ? null : " $where AND ";
            $sql .= (!$end) ? ' 1 ' : " DATE(timestamp) between '$start' and '$end' ";
            return $this->query($sql, $limit, $order, $group);
        }

        /**
         * MySQL Select rRow.
         * @param string|null $where
         * @param string|null $order
         * @param string|null $table
         * @return array|bool
         */
        public function selectRow($where = null, $order = null, $table = null)
        {
            (!$table) ?: $this->setTable($table);
            $sql = "SELECT * FROM $this->TABLE";
            (!$where) ?: $sql .= " WHERE $where ";
            return $this->query($sql, 1, $order)[0] ?? false;
        }

        /**
         * MySQL Select row by id.
         * @param int $id
         * @param string|null $column
         * @param string|null $table
         * @return array|bool
         */
        public function selectId($id, $column = '*', $table = null)
        {
            (!$table) ?: $this->setTable($table);
            $column = $this->escape($column);
            $id = intval($this->escape($id));
            return $this->query("SELECT $column FROM $this->TABLE WHERE id=$id", 1)[0] ?? false;
        }

        /**
         * MySQL Select All.
         * @param int|null $limit
         * @param string|null $order
         * @param string|null $table
         * @return array|bool
         */
        public function selectAll($limit = null, $order = null, $table = null)
        {
            (!$table) ?: $this->setTable($table);
            $sql = "SELECT * FROM $this->TABLE";
            return $this->query($sql, $limit, $order);
        }
    }