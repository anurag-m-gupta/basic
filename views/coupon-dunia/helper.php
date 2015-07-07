<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use app\models\Coupon;
use app\models\Website;
use app\models\CouponCategories;

// globals variables to be share between different function 
$ind = 0;
$result = 0;

// to display types of Coupon in Dropdown of "Filter by coupon type [Deal/Coupon]"
function GetCouponTypeInList() {
    $coupon = new Coupon;
    $result = $coupon->getAllCouponType();
    foreach ($result as $name) {
        echo '<li><input type="radio" name="$name" id="$name" onclick="loadSiteCouponByType(\''.$name.'\');" /> '.$name.'</li>';
    }
}

// to display all store names available in Dropdown of "Filter by Stores"
function GetStoresNameInList() {
    $website = new Website();
    $result = $website->getAllWebsiteName();
    foreach ($result as $name) {
        echo '<li><input type="radio" name="$name" id="$name" onclick="loadSiteCoupon(\''.$name.'\');" /> '.$name.'</li>';
    }
}

// to display all store names available in Dropdown of "Filter by Categories"
function GetCategoriesNamesInList() {
    $coupon = new CouponCategories();
    $result = $coupon->getAllStoresName();
    foreach ($result as $name) {
        echo '<li><input type="radio" name="$name" id="$name" onclick="loadSiteCouponByCategory(\''.$name.'\');"/> '.$name.'</li>';
    }
}

// get next coupon detail as per filteration that was applied
function GetNextCouponForUser() {
    global $result, $ind;
    $idx = $ind++;
    $expiry = $result[$idx]['Expiry'];
    if($expiry == null) {
        $expiry = '2020-01-01 23:59:59';
    }
    return [
        'type' => $result[$idx]['CouponType'],
        'site'  => $result[$idx]['Site'],
        'description' => $result[$idx]['Description'],
        'expiry' => $expiry,
        'code' => $result[$idx]['CouponCode'],
        'logo' => 'logo.png',
        'link' => $result[$idx]['url']
    ];
}

// get all coupon details..(this will display coupon on the very first load of page index.php)
function getAllCouponsDetail() {
    global $result, $ind;
    $ind = 0;
    $couponDetail = new Coupon;
    $result = $couponDetail->getAllCouponDetail();
}

// getting details of all coupons available as per store filteration  
function getAllCouponDetailBySiteName($site) { // by dealers
    global $result, $ind;
    $ind = 0;
    $couponDetail = new Coupon;
    $result = $couponDetail->getAllCouponDetailBySite($site);
    if(count($result) == 0) {
        echo '<strong>oops!!</strong><br>Looks like there\'s no offer for you...:(<br>';
    }
}

// getting details of all coupons available as per category filteration
function getAllCouponDetailByCategoryName($category) { // by coupon category
    global $result, $ind;
    $ind = 0;
    $couponDetail = new Coupon;
    $result = $couponDetail->getAllCouponDetailByCategory($category);
    if(count($result) == 0) {
        echo '<strong>oops!!</strong><br>Looks like there\'s no offer for you...:(<br>';
    }
}

// getting details of all coupons available as per couponType filteration
function getAllCouponDetailByType($type) {  // by coupon type
    global $result, $ind;
    $ind = 0;
    $couponDetail = new Coupon;
    $result = $couponDetail->getAllCouponDetailByType($type);
    if(count($result) == 0) {
        echo '<strong>oops!!</strong><br>Looks like there\'s no offer for you...:(<br>';
    }
}


// checking if there are further coupons available as per asked filteration
function NextDealExist(){
    global $result, $ind;
    if($ind < count($result)) {
        return true;
    }
    return false;
}