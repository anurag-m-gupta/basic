<?php
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/index.js',['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<br>
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <div class="dropdown" >
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                            Filter by coupon type [Deal/Coupon]<span class="caret"></span></button>
                        <ul class="dropdown-menu" style="overflow-y: scroll;">
                            <?php foreach ($resultType as $name) {
                                    echo '<li><input type="radio" name="$name" id="$name" onclick="loadSiteCouponByType(\''.$name.'\');" /> '.$name.'</li>';
                            } ?>
                        </ul>
            </div><br><br>
                    
            <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                Filter by Stores<span class="caret"></span></button>
                        <ul class="dropdown-menu" style="overflow-y: scroll; height: 300px;">
                            <?php foreach ($resultStores as $name) {
                                 echo '<li><input type="radio" name="$name" id="$name" onclick="loadSiteCoupon(\''.$name.'\');" /> '.$name.'</li>';
                            } ?>
                        </ul>
            </div><br><br>
                    
            <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                            Filter by Categories<span class="caret"></span></button>
                        <ul class="dropdown-menu" style="overflow-y: scroll; height: 300px;">
                            <?php foreach ($resultCategory as $name) {
                                    echo '<li><input type="radio" name="$name" id="$name" onclick="loadSiteCouponByCategory(\''.$name.'\');"/> '.$name.'</li>';
                            } ?>
                        </ul>
            </div><br><br>
            <a href="javascript:void(0);" onclick="loadDownload();" class="btn btn-success">Download</a>        
        </div>
                
            <div class="col-sm-1"></div>
                
            <div class="col-sm-7" style="overflow-y: scroll; height: 88vh;" id="CouponDisplay">
                    <?php 
                    for($idx = 0;$idx < 60 && $idx < count($resultDetail);$idx++) {
                        $expiry = $resultDetail[$idx]['Expiry'];
                            if($expiry == null) {
                                $expiry = '2020-01-01 23:59:59';
                            }
                        $deal = [
                            'type' => $resultDetail[$idx]['CouponType'],
                            'site'  => $resultDetail[$idx]['Site'],
                            'description' => $resultDetail[$idx]['Description'],
                            'expiry' => $expiry,
                            'code' => $resultDetail[$idx]['CouponCode'],
                            'logo' => 'logo.png',
                            'link' => $resultDetail[$idx]['url']
                        ];
                        ?>
                    
                    <div class="row">
                        <div class="col-sm-6" style="text-align: left;">
                            Type: <?= $deal['type'] ?><br><br>
                            <b><?= $deal['site'] ?></b><br>
                            <?php for($c = 0;$c < strlen($deal['site'])*2;$c++) echo '<b>-</b>';?>
                        </div>
                        <div class="col-sm-6" style="text-align: right;">
                            <?= "<h3>".$deal['site']."</h3>" ?>
                        </div>
                    </div>
                    
                    <div class="row" style="padding-left: 13px;">
                        <?= $deal['description']; ?>
                    </div><br>
                    
                    <div class="row" style="text-align: right;">
                        <?= '<h6>Expiry: '.$deal['expiry'].'</h6>'; ?>
                    </div>
                    
                    <div class="row" style="text-align: center;">
                        <?php 
                        $msg = '';
                        $btnDisplay = '';
                        if($deal['code'] == '[YOUR OWN COUPON]') {
                            $msg = 'Your deal is Activated!';
                            $btnDisplay = 'ACTIVATE DEAL';
                        } else {
                            $msg = 'Your Coupon Code: '.$deal['code'];
                            $btnDisplay = 'GET CODE';
                        }
                        ?>
                        <button type="button" class="btn btn-primary" onclick='alert("<?= $msg ?>");'><?= $btnDisplay ?></button><br>
                    </div><br>
                    
                    <div class="row" style="text-align: center;">
                        <a href="javascript:void(0);" onclick="loadSiteCoupon('<?= $deal['site'] ?>')" id="link">Grab all deals from <?= ucfirst(strtolower($deal['site'])); ?></a>
                    </div>
                    <b><hr></b>
                    
                    <?php }?>
            </div>
            <div class="col-sm-1"></div>
    </div>
</div>