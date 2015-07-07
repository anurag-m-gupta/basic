<?php

// contains all required functions as per filter result requirement..
include_once 'helper.php';
?>

<script type="text/javascript">
var filterType = '';
var filterValue = '';

// for onclick event of filter by store
function loadSiteCoupon(dealSite){
    filterType = 'store';
    filterValue = dealSite;
    if(window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
    }
    xmlhttp.onreadystatechange = function() {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('CouponDisplay').innerHTML = xmlhttp.responseText;
        }
    }
    
    xmlhttp.open('GET', "http://localhost:8888/basic/web/index.php?r=coupon-dunia/display-coupon&site="+dealSite, true);
    xmlhttp.send();
}

// for onclick event of filter by category
function loadSiteCouponByCategory(category) {
    filterType = 'category';
    filterValue = category;
    if(window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
    }
    xmlhttp.onreadystatechange = function() {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('CouponDisplay').innerHTML = xmlhttp.responseText;
        }
    }
    
    xmlhttp.open('GET', "http://localhost:8888/basic/web/index.php?r=coupon-dunia/display-coupon-by-category&cat="+category, true);
    xmlhttp.send();
}

// for onclick event of filter by coupon type
function loadSiteCouponByType(type) {
    filterType = 'coupontype';
    filterValue = type;
    if(window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
    }
    xmlhttp.onreadystatechange = function() {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('CouponDisplay').innerHTML = xmlhttp.responseText;
        }
    }
    
    xmlhttp.open('GET', "http://localhost:8888/basic/web/index.php?r=coupon-dunia/display-coupon-by-type&type="+type, true);
    xmlhttp.send();
}

// for onclick event of download button
function loadDownload() {
    if(window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
    }
    xmlhttp.onreadystatechange = function() {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //document.getElementById('').innerHTML = xmlhttp.responseText;
            alert('Dowload successful!\ndownloaded to path : "web/CouponExcel.xlsx"');
        }
    }
    
    xmlhttp.open('GET', "http://localhost:8888/basic/web/index.php?r=coupon-dunia/download&type="+filterType+"&value="+filterValue, true);
    xmlhttp.send();
}

</script>
<br>
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <div class="dropdown" >
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                            Filter by coupon type [Deal/Coupon]<span class="caret"></span></button>
                        <ul class="dropdown-menu" style="overflow-y: scroll;">
                            <?php GetCouponTypeInList(); ?>
                        </ul>
            </div><br><br>
                    
            <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                Filter by Stores<span class="caret"></span></button>
                        <ul class="dropdown-menu" style="overflow-y: scroll; height: 300px;">
                            <?php GetStoresNameInList(); ?>
                        </ul>
            </div><br><br>
                    
            <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                            Filter by Categories<span class="caret"></span></button>
                        <ul class="dropdown-menu" style="overflow-y: scroll; height: 300px;">
                            <?php GetCategoriesNamesInList(); ?>
                        </ul>
            </div><br><br>
            <a href="javascript:void(0);" onclick="loadDownload();" class="btn btn-success">Download</a>        
        </div>
                
            <div class="col-sm-1"></div>
                
            <div class="col-sm-7" style="overflow-y: scroll; height: 88vh;" id="CouponDisplay">
                    <?php 
                      getAllCouponsDetail();
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
                        <a href="javascript:void(0);" onclick="loadSiteCoupon('<?= $deal['site'] ?>')" id="link">Grab all deals from <?= ucfirst(strtolower($deal['site'])); ?></a>
                    </div>
                    <b><hr></b>
                    
                    <?php }?>
            </div>
            <div class="col-sm-1"></div>
    </div>
</div>