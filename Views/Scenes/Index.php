<!DOCTYPE html>
<html lang="ja">
<head>
    <?php require_once(__DIR__.'/../Components/Head.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>25 -twenty five-</title>
</head>
<body>
    <div id="app">
        <h2>25 -twenty five-</h2>
        <button class="btn btn-lg" onClick="location.href='./game'">ゲームを始める</button>
        <button class="btn btn-lg" onClick="location.href='./ranking'">ランキング</button>
    </div>
</body>
<script type="module">
 var app = new Vue({
        el: "#app",
        data:{
            items:[],
        }     
     });
</script>

</html>