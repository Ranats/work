<?php
/**
 * Created by PhpStorm.
 * User: sopur
 * Date: 2017/04/12
 * Time: 18:39
 */

/**
 * CSV出力
 */
function export_csv($meta_bukken){

    //  ファイル名
    $file_path = "export.csv";

    //  タイトル行
    $export_csv_title = array("id","氏名", "性別", "電話番号");

    //  出力する内容
    $sql_export = "SELECT id, 氏名, 性別, 電話番号 FROM table1 ";
    $res_export = mysql_query( $sql_export, $connect );


}