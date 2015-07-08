/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
