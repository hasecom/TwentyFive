<?php 
namespace App\Controllers;
require_once(__DIR__.'/../Services/RankingService.php');
use App\Services\RankingService;
class RankingController{
    //登録
    public function registRanking($param){
        $rankingService = new RankingService;
        $rtnVal = $rankingService->registRanking([
            'user_name'=>$param['name'],
            'time'=>$param['time']
        ]);
        echo json_encode($rtnVal);
    }
    //ランキング取得
    public function getRanking(){
        $rankingService = new RankingService;
        $rtnVal = $rankingService->getRanking();
        echo json_encode($rtnVal);
    }
}
?>