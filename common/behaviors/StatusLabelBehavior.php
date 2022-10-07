<?php


namespace common\behaviors;

use yii\base\InvalidCallException;
use yii\base\UnknownPropertyException;
use yii\db\BaseActiveRecord;

class StatusLabelBehavior extends \yii\behaviors\AttributeBehavior
{
    public $attributes;

    public function init()
    {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [
                BaseActiveRecord::EVENT_AFTER_FIND => [$this->attributes],
            ];
        }
    }

    public function __get($name)
    {
        foreach ($this->attributes as $attribute) {
            if ($name === $attribute . '_label') {
                switch ($this->owner->status) {
                    case 0:
                        return 'Deleted';
                        break;

                    case 9:
                        return 'Inactive';
                        break;
                    case 10:
                        return 'Active';
                        break;
                }
            }
        }
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->$getter();
        } elseif (method_exists($this, 'set' . $name)) {
            throw new InvalidCallException('Getting write-only property: ' . get_class($this) . '::' . $name);
        }

        throw new UnknownPropertyException('Getting unknown property: ' . get_class($this) . '::' . $name);
    }
    public function canGetProperty($name, $checkVars = true)
    {
        foreach ($this->attributes as $attribute) {
            if ($name === $attribute . '_label') {
                return true;
            }
        }
    }
}
