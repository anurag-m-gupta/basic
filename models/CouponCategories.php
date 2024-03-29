<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "CouponCategories".
 *
 * @property integer $CategoryID
 * @property string $Name
 * @property string $URLKeyword
 * @property integer $Priority
 * @property string $ImageLink
 * @property string $Title
 * @property string $MetaDescription
 * @property integer $NumActiveCoupons
 * @property string $CategoryImageColourCode
 * @property integer $FeaturedOnAppHome
 * @property double $CategoryPopularityScore
 */
class CouponCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'CouponCategories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['URLKeyword', 'ImageLink', 'MetaDescription'], 'required'],
            [['Priority', 'NumActiveCoupons', 'FeaturedOnAppHome'], 'integer'],
            [['ImageLink', 'Title', 'MetaDescription'], 'string'],
            [['CategoryPopularityScore'], 'number'],
            [['Name', 'URLKeyword'], 'string', 'max' => 200],
            [['CategoryImageColourCode'], 'string', 'max' => 50],
            [['Name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CategoryID' => 'Category ID',
            'Name' => 'Name',
            'URLKeyword' => 'Urlkeyword',
            'Priority' => 'Priority',
            'ImageLink' => 'Image Link',
            'Title' => 'Title',
            'MetaDescription' => 'Meta Description',
            'NumActiveCoupons' => 'Num Active Coupons',
            'CategoryImageColourCode' => 'Category Image Colour Code',
            'FeaturedOnAppHome' => 'Featured On App Home',
            'CategoryPopularityScore' => 'Category Popularity Score',
        ];
    }
    
    // get all store name available
    function getAllStoresName() {
        $result = CouponCategories::find()
                ->orderBy('Name')
                ->distinct(true)
                ->select('Name')
                ->all();
        
        
        $type = array();
        $ind = 0;
        foreach ($result as $value) {
            $type[$ind++] = $value->Name;
        }
        return $type;
        
    }
    
    function getCategoryId() {
        $command = new \yii\db\Query;
        
        return $command->select(["CategoryId"])
                ->from(self::tableName())
                ->where(["Name" => $this->Name])
                ->one();
    }
}
