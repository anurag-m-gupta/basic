<?php
include_once 'helper.php';
$site = $_GET['site'];
?>
<?php 
    // get details of coupon by store name
     getAllCouponDetailBySiteName($site);
                    for($i = 0;$i < 60 && NextDealExist();$i++) {
                        $deal = GetNextCouponForUser(); ?>
                    
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
                        <a href="javascript:void(0);" onclick="loadSiteCoupon('<?= $deal['site'] ?>')">Grab all deals from <?= ucfirst(strtolower($deal['site'])); ?></a>
                    </div>
                    <b><hr></b>
                    
<?php } ?>