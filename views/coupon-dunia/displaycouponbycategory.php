<?php
    // get details of coupon by category 
                    for($idx = 0;$idx < 60 && $idx < count($resultCategory);$idx++) {
                        $expiry = $resultCategory[$idx]['Expiry'];
                            if($expiry == null) {
                                $expiry = '2020-01-01 23:59:59';
                            }
                        $deal = [
                            'type' => $resultCategory[$idx]['CouponType'],
                            'site'  => $resultCategory[$idx]['Site'],
                            'description' => $resultCategory[$idx]['Description'],
                            'expiry' => $expiry,
                            'code' => $resultCategory[$idx]['CouponCode'],
                            'logo' => 'logo.png',
                            'link' => $resultCategory[$idx]['url']
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