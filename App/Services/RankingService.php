<?php 
namespace App\Services;

require_once(__DIR__.'/../Connection/connection.php');
use App\Connection\Connection;
class RankingService{
    public function registRanking($param){
    $sql = null;
    $sql.= 'INSERT INTO ranking';
    $sql.='     (';
    $sql.='         user_name';
    $sql.='         ,time';
    $sql.='     )';
    $sql.='     VALUE';
    $sql.='     (';
    $sql.='         :user_name';
    $sql.='         , :time';
    $sql.='     ) ';

    $connection = new Connection();
    return $connection->con($sql,$param);
    }
    public function getRanking(){
        $sql = null;
        $sql.="SELECT * FROM ranking ORDER by time LIMIT 100 OFFSET 0";
        $connection = new Connection();
        return $connection->con($sql);
        }
}
?>