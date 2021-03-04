<?php
/**
 * Class Tags
 *
 * Mahan | Core tags
 *
 * @package    App\Core
 * @author     Milad Abooali <m.abooali@hotmail.com>
 * @copyright  2012 - 2020 Codebox
 * @license    http://codebox.ir/license/1_0.txt  Codebox License 1.0
 * @version    1.0.0 - Costume
 */

namespace App\Core;

if (!defined('START')) die('__ You just find me! 😹 . . . <a href="javascript:history.back()">Go Back</a>');

class tags
{

    private $db, $table_tags='tags';

    /**
     * SimpleVendor constructor.
     */
    function __construct() {
        $this->db = new iSQL(DB_INFO);
    }

    /**
     * @param $tag
     * @return bool|int|\mysqli_result|string|null
     */
    public function add($tag) {
        $insert['name'] = $tag;
        return $this->db->insert('tags', $insert);
    }

    /**
     * @param $id
     * @param $tag
     * @return bool|int|\mysqli_result|string|null
     */
    public function update($id, $tag) {
        $update['name'] = $tag;
        return $this->db->updateId('tags',$id, $update);
    }

    /**
     * @param $id
     * @return bool|int|\mysqli_result|string|null
     */
    public function delete($id) {
        return $this->db->deleteId('tags',$id);
    }


}
