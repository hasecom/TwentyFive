<!DOCTYPE html>
<html lang="ja">
<head>
    <?php require_once(__DIR__.'/../Components/Head.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>25 -twenty five-</title>
</head>
<body>
<div id="app">
    <div id="timer">{{displayTimer}}</div>
    <div id="twentyfive">
        <div id="twentyfiveWrap">
            <div id="startBtn" @click="start">
                <button class="btn btn-lg btn-info">スタート</button>
            </div>
        </div>
        <div class="col_wrap">
            <div class="d-inline-block _block _block_border" v-for="n in 5">
                <span :id="'block_'+Number(n)"></span>
            </div>
        </div>
        <div class="col_wrap">
            <div class="d-inline-block _block _block_border" v-for="n in 5" >
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
            timer:''
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
                    if(this_.nextVal == this_.maxNum){
                        console.log("koo")
                        this_.stop();
                    }
                    this_.nextVal++;
                }
            })
        },
        methods:{
            mounteds(){
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
                    this_.displayTimer = sec + ':' + mSec
                    this_.timer = setTimeout(countup, 10);
                }
                countup();
            },
            stop(){
                clearTimeout(this.timer);　
            }
        }
     });
</script>
</html>