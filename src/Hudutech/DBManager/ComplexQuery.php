<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 3/28/17
 * Time: 1:31 AM
 */

namespace Hudutech\DBManager;


class ComplexQuery
{

    /**
     * @param $table = database table
     * @param $tableColumns = array table columns
     * @param $options = array($key=>$value), $key is the
     * name of table column this parameter is used for
     * constriction of the sql query condition
     * @return mixed
     * key meta in options takes values of ASC OR DESC
     * This specifies the type of ordering.
     * order_by key is an array of columns used to order your
     * results eg order_by =>array("column1", column2")
     */
    public static function customFilter($table, $tableColumns, $options)
    {
        $db = new DB();
        $conn = $db->connect();

        $order_by = '';
        $limit = '';
        $meta = '';

        if (array_key_exists("order_by", $options)) {

            $order_by_array = $options['order_by'];
            $order_by = rtrim(implode(' ,', $order_by_array), ',');
        }
        if (array_key_exists("limit", $options)) {
            $limit = $options['limit'];

        }

        if (array_key_exists("meta", $options)) {
            $meta = $options['meta'];

        }

        unset($options['order_by']);
        unset($options['limit']);
        unset($options['meta']);

        if (is_array($tableColumns) and is_array($options)) {


            $new_options_array = array();
            foreach ($options as $key => $value) {
                $option = $key . "='" . $value . "'";
                array_push($new_options_array, $option);
            }
            if (empty($options)) {
                $sql_condition_string = 1;
            } else {
                $order_by_string = '';
                $limit_string = '';
                if ($order_by != '') {
                    $order_by_string = 'ORDER BY ' . $order_by;
                }

                if ($limit != '') {
                    $limit_string = 'LIMIT ' . $limit;
                }

                $extras = $order_by_string . " " . "" . $meta . " " . $limit_string;

                $sql_condition_string = rtrim(implode(' AND ', $new_options_array), ',');
                $sql_condition_string .= " " . $extras;

            }
            $tableColumns = empty($tableColumns) ? '*' : rtrim(implode(',', $tableColumns), ',');


            try {

                $stmt = $conn->prepare("SELECT $tableColumns FROM $table WHERE $sql_condition_string");

                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $results = array();
                    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                        $results[] = $row;
                    }
                    $db->closeConnection();
                    return $results;

                } else {
                    return [];
                }

            } catch (\PDOException $e) {
                echo $e->getMessage();
                return [];
            }

        }
        return true;
    }

    /**
     * @param $table
     * @param array $tableColumns
     * @param $searchText
     * @return array|null
     */
    public static function search($table, array $tableColumns, $searchText)
    {

        $db = new DB();
        $conn = $db->connect();

        $condition = '';
        for ($i = 0; $i < sizeof($tableColumns) - 1; $i++) {
            $condition .= $tableColumns[$i] . " LIKE '%" . $searchText . "%' OR ";
        }
        $condition .= $tableColumns[$i] . " LIKE '%" . $searchText . "%'";


        try {

            $stmt = $conn->prepare("SELECT * FROM $table WHERE $condition");

            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $data = array();
                while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                    if (!empty($row)) {
                      $data[] = $row;
                    }
                }
                $db->closeConnection();
                return $data;
            } else {
                return [];
            }


        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return null;
        }


    }
}