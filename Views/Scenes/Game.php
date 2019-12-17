<!DOCTYPE html>
<html lang="ja">

<head>
    <?php require_once(__DIR__ . '/../Components/Head.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>25 -twenty five-</title>
    <meta name="twitter:card" content="summary_large_image">
    <meta property="og:url" content="http://25-twentyfive.site/" />
    <meta property="og:title" content="25 -twenty five-" />
    <meta property="og:description" content="1から順に番号を押していくシンプルゲームです。" />
    <meta property="og:image" content="http://25-twentyfive.site/Views/Assets/images/25.png" />
</head>

<body>
    <div id="app">
        <h2 class="bg-light text-center">25</h2>
        <div id="timer">{{displayTimer}}</div>
        <div id="twentyfive">
            <div id="twentyfiveWrap">
                <div id="startBtn" @click="start">
                    <button class="btn btn-lg btn-info">スタート</button>
                </div>
            </div>
            <div id="retryWrap" class="d-none">
                <div id="score">{{result}}秒</div>
                <div id="retry">
                    <button id="retry_btn" @click="retryClick()" class="btn btn-lg btn-info">リトライ</button>
                </div>
            </div>
            <div class="col_wrap">
                <div class="d-inline-block _block _block_border" v-for="n in 5">
                    <span :id="'block_'+Number(n)"></span>
                </div>
            </div>
            <div class="col_wrap">
                <div class="d-inline-block _block _block_border" v-for="n in 5">
                    <span :id="'block_'+Number(n+5)"></span>
                </div>
            </div>
            <div class="col_wrap">
                <div class="d-inline-block _block _block_border" v-for="n in 5">
                    <span :id="'block_'+Number(n+10)"></span>
                </div>
            </div>
            <div class="col_wrap">
                <div class="d-inline-block _block _block_border" v-for="n in 5">
                    <span :id="'block_'+Number(n+15)"></span>
                </div>
            </div>
            <div class="col_wrap">
                <div class="d-inline-block _block _block_border" v-for="n in 5">
                    <span :id="'block_'+Number(n+20)"></span>
                </div>
            </div>
        </div>
        <div class="other mt-3">
            <div id="ranking_wrap">
                <button id="Ranking" class="btn btn-dark btn-outline-light" @Click="SeeRanking()">ランキングを見る</button>
                <button id="registRanking" class="btn btn-dark btn-outline-light" data-toggle="modal" data-target="#rankingModal">ランキングに登録</button>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="seerankingModalScrollable" tabindex="-1" role="dialog" aria-labelledby="seerankingModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="seerankingModalScrollableTitle">ランキング</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div v-for="val,index in rank" :key='index' class="border my-1 py-3 px-3">
                            <div>
                                <span>{{index + 1}}位</span>
                                <span class="px-2">{{val.user_name}}</span>
                                <span>{{val.time}}秒</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="rankingModal" tabindex="-1" role="dialog" aria-labelledby="rankingModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rankingModalLabel">ランキングに登録</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="result_time" class="text-center">記録:{{result}}秒</div>
                        <div class="form-group mb-3">
                            <label class="label" for="name">名前</label>
                            <input type="text" id="name" class="form-control" maxlength="10" placeholder="" aria-label="" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                        <button type="button" class="btn btn-primary" @click='registClick' data-dismiss="modal">登録</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="ads" class="mt-3">
            <a href="https://px.a8.net/svt/ejp?a8mat=35U7T3+70FVL6+3JZI+6RHFL" rel="nofollow">
            <img border="0" width="200" height="200" alt="" src="https://www24.a8.net/svt/bgt?aid=191206407424&wid=004&eno=01&mid=s00000016587001136000&mc=1"></a>
            <img border="0" width="1" height="1" src="https://www19.a8.net/0.gif?a8mat=35U7T3+70FVL6+3JZI+6RHFL" alt="">
        </div>
    </div>
</body>
<script type="module">
    var app = new Vue({
        el: "#app",
        data:{
            items:[],
            count:0,
            maxNum:25,
            displayTimer:'0:00',
            nextVal:1,
            timer:'',
            result:'記録なし',
            rank:[]
        },
        mounted(){
            this.mounteds();
            var this_ = this;
            $('._block').on('click',function(){
                //クリックすべきボックスをクリックしたら
                if($(this).text() == this_.nextVal){
                    $(this).css('background','rgba(0,0,0,0.1)');
                    $(this).css('color','rgba(0,0,0,0.4)');
                    //すべて押したら
                    if(this_.nextVal == this_.maxNum ){//
                        this_.finish();
                    }
                    this_.nextVal++;
                }
            })
        },
        methods:{
            mounteds(){
                //ボタンを非活性
                $('#registRanking').prop("disabled", true);
                this.setNumber();
            },
            setNumber(){
                var setNumber = this.random();
                var max = 25;
                for(var i = 1; i <= max; i++){
                    $('#block_'+ i).text(setNumber[i-1]);
                }
            },
            random(){
                /** 重複チェック用配列 */
                var randoms = [];
                /** 最小値と最大値 */
                var min = 1, max = 25;
                /** 重複チェックしながら乱数作成 */
                for(var i = min; i <= max; i++){
                    while(true){
                        var tmp = this.intRandom(min, max);
                        if(!randoms.includes(tmp)){
                        randoms.push(tmp);
                        break;
                        }
                    }
                }
                return randoms;
            },
            intRandom(min,max){
                return Math.floor( Math.random() * (max - min + 1)) + min;
            },
            start(){
                $('#twentyfiveWrap').remove();
                var this_ = this;
                this_.count = 0;
                var countup = function(){
                    this_.count++;
                    var min = Math.floor(this_.count/100/60);
                    var sec = Math.floor(this_.count/100);
                    var mSec = this_.count % 100;
                    this_.displayTimer = sec + '.' + mSec
                    this_.timer = setTimeout(countup, 10);
                }
                countup();
            },
            stop(){
                clearTimeout(this.timer);　
            },
            finish(){
                this.stop();
                $('#registRanking').prop("disabled", false);
                $('#retryWrap').removeClass('d-none');
                this.result = this.displayTimer;
            },
            registClick(){
                this.regist('request/ranking/registRanking');
                //ボタンを非活性
                $('#registRanking').prop("disabled", true);
            },
            regist(AjaxUrl){
            let params = new URLSearchParams();
            params.append('name', $('#name').val());
            params.append('time', this.result);
            axios.post(AjaxUrl,params)
              .then(res => {
              })
            },
            SeeRanking(){
                var AjaxUrl = 'request/ranking/getRanking'
                axios.get(AjaxUrl,{
                    params:{
                    name: $('#name').val(),
                    time:this.result
                }
                 })
              .then(res => {
                  this.rank = res['data'];
                  $('#seerankingModalScrollable').modal('show')
              })
            },
            retryClick(){
                location.reload();
            }
        }
     });
</script>

</html>