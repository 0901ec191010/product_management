<?php
namespace app\models;

use yii\db\ActiveRecord;
use DateTime;

class Products extends ActiveRecord
{
    public static function tableName()
    {
        return 'Products';
    }

    public function rules()
    {
        return [
            [['name', 'brand', 'category', 'manu_date', 'exp_date'], 'required'],
            [['manu_date', 'exp_date'], 'safe'],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Convert manu_date and exp_date to Y-m-d format before saving
            if ($this->manu_date) {
                $date = DateTime::createFromFormat('d-m-Y', $this->manu_date);
                if ($date !== false) {
                    $this->manu_date = $date->format('Y-m-d');
                } else {
                    $this->manu_date = null; // Handle conversion error
                }
            }
            if ($this->exp_date) {
                $date = DateTime::createFromFormat('d-m-Y', $this->exp_date);
                if ($date !== false) {
                    $this->exp_date = $date->format('Y-m-d');
                } else {
                    $this->exp_date = null; // Handle conversion error
                }
            }
            return true;
        }
        return false;
    }

    public function afterFind()
    {
        parent::afterFind();
        // Convert manu_date and exp_date to d-m-Y format after retrieving
        if ($this->manu_date) {
            $date = DateTime::createFromFormat('Y-m-d', $this->manu_date);
            if ($date !== false) {
                $this->manu_date = $date->format('d-m-Y');
            } else {
                $this->manu_date = null; // Handle conversion error
            }
        }
        if ($this->exp_date) {
            $date = DateTime::createFromFormat('Y-m-d', $this->exp_date);
            if ($date !== false) {
                $this->exp_date = $date->format('d-m-Y');
            } else {
                $this->exp_date = null; // Handle conversion error
            }
        }
    }
}
