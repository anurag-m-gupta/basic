<?php

namespace app\controllers;

use PHPExcel;
use app\models\Coupon;
use app\models\Website;
use app\models\CouponCategories;
use Yii;

class CouponDuniaController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $couponType = new Coupon;
        $resultCouponType = $couponType->getAllCouponType();
        $websiteStores = new Website();
        $resultStores = $websiteStores->getAllWebsiteName();
        $couponCategories = new CouponCategories();
        $resultCategory = $couponCategories->getAllStoresName();
        $couponDetail = new Coupon;
        $resultDetail = $couponDetail->getAllCouponDetail();
        return $this->render('index', ['resultType' => $resultCouponType,
            'resultStores' => $resultStores,
            'resultCategory' => $resultCategory,
            'resultDetail' => $resultDetail
            ]);
    }
    
    public function actionDisplayCoupon() {
        $site = $_GET['site'];
        $couponDetail = new Coupon;
        $result = $couponDetail->getAllCouponDetailBySite($site);
        if(count($result) == 0) {
          echo '<strong>oops!!</strong><br>Looks like there\'s no offer for you...:(<br>';
        } else {
            return $this->renderPartial('displaycoupon', ['site' => $site, 'resultStore' => $result]);
        }
    }
    
    public function actionDisplayCouponByCategory() {
        $category = $_GET['cat'];
        $couponDetail = new Coupon;
        $resultcategory = $couponDetail->getAllCouponDetailByCategory($category);
        if(count($resultcategory) == 0) {
          echo '<strong>oops!!</strong><br>Looks like there\'s no offer for you...:(<br>';
        } else {
            return $this->renderPartial('displaycouponbycategory', ['cat' => $category, 'resultCategory' => $resultcategory]);
        }
    }

    public function actionDisplayCouponByType() {
        $type = $_GET['type'];
        $couponDetail = new Coupon;
        $resultType = $couponDetail->getAllCouponDetailByType($type);
        if(count($resultType) == 0) {
          echo '<strong>oops!!</strong><br>Looks like there\'s no offer for you...:(<br>';
        } else {
        return $this->renderPartial('displaycouponbytype', ['resultType' => $resultType]);
        }
    }
    
    public function actionDownload($type = 'none', $value = 'none') {
        if($type == '' && $value == '') {
            $couponDetail = new Coupon;
            $result = $couponDetail->getAllCouponDetail();
        } else if($type == 'category') {
            $couponDetail = new Coupon;
            $result = $couponDetail->getAllCouponDetailByCategory($value);
        } else if($type == 'coupontype') {
            $couponDetail = new Coupon;
            $result = $couponDetail->getAllCouponDetailByType($value);
        } else if($type == 'store') {
            $couponDetail = new Coupon;
            $result = $couponDetail->getAllCouponDetailBySite($value);
        } else {
            echo '<strong>oops!!</strong><br>seems like it\'s not working...:(<br>';
        }
        
        $data = array();
        // CouponType, Website.WebsiteName AS Site, Coupon.Description AS Description, Coupon.Expiry AS Expiry, CouponCode, WebsiteURL AS url
            array_push($data, array('Coupon Type' => "Coupon Type",
                'Store name' => 'Store name',
                'Coupon Description' => 'Coupon Description',
                'Coupon Expiry' => 'Coupon Expiry',
                'Coupon Code' => 'Coupon Code',
                'store url' => 'Store URL'
                ));
        foreach ($result as $row) {
            $expiry = $row['Expiry'];
            if($expiry == NULL) {
                $expiry = "2020-01-01 23:59:59";
            }
            array_push($data, array('Coupon Type' => $row['CouponType'],
                'Store name' => $row['Site'],
                'Coupon Description' => $row['Description'],
                'Coupon Expiry' => $expiry,
                'Coupon Code' => $row['CouponCode'],
                'store url' => $row['url']
                ));
        }
        //print_r($data);
        $obj = new \PHPExcel();

        // Create new PHPExcel object
        $objPHPExcel = new \PHPExcel();
        
        // Fill worksheet from values in array
        $objPHPExcel->getActiveSheet()->fromArray($data, null, 'A1');
        
        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Members');
        
        // Set AutoSize for name and email fields
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);

        //print_r($objPHPExcel);
        // Save Excel 2007 file
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('CouponExcel.xlsx');
        $fileLocation = '../web/CouponExcel.xlsx';
        
    }
}
