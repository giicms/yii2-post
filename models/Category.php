<?php

namespace giicms\news\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property integer $parent_id
 * @property string $description
 * @property integer $order
 * @property integer $status
 */
class Category extends \yii\db\ActiveRecord
{

    const PUBLISH_ACTIVE = 1;
    const PUBLISH_NOACTIVE = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'giicms_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required', 'message' => '{attribute} không được rỗng.'],
            [['parent_id', 'publish'], 'integer'],
            ['publish', 'default', 'value' => self::PUBLISH_ACTIVE],
            ['type', 'default', 'value' => 'news'],
            [['description'], 'string'],
            [['title', 'slug', 'type'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Tiêu đề',
            'slug' => 'Slug',
            'parent_id' => 'Parent',
            'description' => 'Mô tả',
            'publish' => 'Trạng thái',
        ];
    }

    public function getCategories(&$data = [], $parent = NULL)
    {
        $category = Category::find()->where(['parent_id' => $parent, 'type' => 'news'])->andWhere(['NOT IN', 'id', (!$this->isNewRecord) ? $this->id : 0])->all();
        foreach ($category as $key => $value)
        {
            $data[$value->id] = $this->getIndent($value->indent) . $value->title;
            unset($category[$key]);
            $this->getCategories($data, $value->id);
        }
        return $data;
    }

    public function getIndent($int)
    {
        if ($int > 0)
        {
            for ($index = 1; $index <= $int; $index++)
            {
                $data[] = '—';
            }
            return implode('', $data) . ' ';
        }
        else
            return '';
    }

}
