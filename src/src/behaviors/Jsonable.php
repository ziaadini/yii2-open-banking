<?php

namespace sadi01\openbanking\behaviors;

use sadi01\openbanking\components\ActiveQueryJson;
use ReflectionProperty;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\UploadedFile;

/**
 * Jsonable handle JSON type attributes and add findJson() method for search on json type attributes
 *
 * To use Jsonable, insert the following code to your ActiveRecord class:
 *
 * ```php
 * use common\behaviors\Jsonable;
 *
 * function behaviors()
 * {
 *     return [
 *         'jsonable' => [
 *             'class' => Jsonable::class,
 *             'jsonAttributes' => [
 *                   'additional_data' => [
 *                      'color',
 *                   ],
 *              ],
 *         ],
 *     ];
 * }
 * ```
 *
 * @author SADi <sadshafiei.01@gmail.com>
 * @since 2.0
 *
 * Class Jsonable
 * @package common\behaviors
 *
 * @property array $jsonAttributes
 */
class Jsonable extends \yii\base\Behavior
{
    private $_oldJsonAttributes = [];
    public $jsonAttributes = [];
    public static $OWNER;

    public function attach($owner)
    {
        parent::attach($owner);
        self::$OWNER = $owner;

        foreach ($this->jsonAttributes as $jsonAttributeName => $jsonAttribute) {
            $jsonColumn = $this->owner::getTableSchema()->getColumn($jsonAttributeName);
            if (!$this->owner->hasProperty($jsonAttributeName)) {
                throw new InvalidConfigException("The `{$jsonAttributeName}` property must be define In " . get_class($owner));
            }
            if ($jsonColumn->type !== 'json') {
                throw new InvalidConfigException("The `{$jsonAttributeName}` property must be json type column.");
            }
            //            if ($jsonColumn->defaultValue !== 'JSON_OBJECT()') {
            //                throw new InvalidConfigException("The default value of `{$jsonAttributeName}` property must be `JSON_OBJECT()`.");
            //            }
            if (is_array($jsonAttribute)) {
                foreach ($jsonAttribute as $attribute) {
                    if (!$this->owner->hasProperty($attribute)) {
                        throw new InvalidConfigException("The `{$attribute}` property must be define.");
                    }
                }
            } else {
                throw new InvalidConfigException("The `{$jsonAttribute}` json property doesn't have proper value.");
            }
        }
    }

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeSave',
            ActiveRecord::EVENT_AFTER_FIND    => 'afterFind',
        ];
    }

    public function beforeInsert()
    {
        $commands = [];
        foreach ($this->jsonAttributes as $jsonAttributeName => $jsonAttributeValue) {
            foreach ($jsonAttributeValue as $attribute) {
                if ($this->isChanged($jsonAttributeName, $attribute)) {
                    $rp = new ReflectionProperty(get_class($this->owner), $attribute);
                    if (!($type = ($rp->getType() ? $rp->getType()->getName() : null))) {
                        $type = gettype($this->owner->$attribute);
                    }
                    switch ($type) {
                        case 'bool':
                        case 'boolean':
                        case 'integer':
                        case 'int':
                            $attributeValue = (int)$this->owner->$attribute;
                            break;
                        case 'string':
                            $attributeValue = "{$this->owner->$attribute}";
                            break;
                        case 'NULL':
                            $attributeValue = 'NULL';
                            break;
                        case 'array':
                            $attributeValue = $this->owner->$attribute;
                            break;
                        default :
                            $attributeValue = $this->owner->$attribute;
                    }
                    $commands[$jsonAttributeName][$attribute] = $attributeValue;
                }
            }
            $this->owner->$jsonAttributeName = $commands[$jsonAttributeName] ?? new Expression('JSON_OBJECT()');
        }
    }

    public function beforeSave()
    {
        foreach ($this->jsonAttributes as $jsonAttributeName => $jsonAttributeValue) {
            $command = '';
            $alphabet = "A";
            foreach ($jsonAttributeValue as $attribute) {
                if ($this->isChanged($jsonAttributeName, $attribute)) {
                    $rp = new ReflectionProperty(get_class($this->owner), $attribute);
                    if (!($type = ($rp->getType() ? $rp->getType()->getName() : null))) {
                        $type = gettype($this->owner->$attribute);
                    }
                    switch ($type) {
                        case 'bool':
                        case 'boolean':
                        case 'integer':
                        case 'int':
                            $attributeValue = (int)$this->owner->$attribute;
                            break;
                        case 'string':
                            $attributeValue = "{$this->owner->$attribute}";
                            break;
                        case 'NULL':
                            $attributeValue = 'NULL';
                            break;
                        case 'array':
                            $attributeValue = json_encode($this->owner->$attribute, JSON_UNESCAPED_UNICODE);
                            break;
                        case 'object':
                            $attributeValue = $this->owner->$attribute instanceof UploadedFile ? "'{$this->owner->$attribute->name}'" : $this->owner->$attribute;
                            break;
                        default :
                            $attributeValue = $this->owner->$attribute;
                    }
                    $command .= '"$.' . $attribute . '", :' . $alphabet . ',';
                    $params[$alphabet] = $attributeValue;
                    ++$alphabet;
                }
            }

            if ($command) {
                $this->owner->$jsonAttributeName = new Expression('JSON_SET(`' . $jsonAttributeName . '`, ' . trim($command, ',') . ')', $params);
            }
        }
    }

    public function afterFind()
    {
        foreach ($this->jsonAttributes as $jsonAttributeName => $jsonAttributeValue) {
            foreach ($jsonAttributeValue as $attribute) {
                $rp = new ReflectionProperty(get_class($this->owner), $attribute);
                if (!($type = ($rp->getType() ? $rp->getType()->getName() : null))) {
                    $type = gettype($this->owner->$attribute);
                }

                $attributeValue = $this->owner->$jsonAttributeName[$attribute] ?? null;

                switch ($type) {
                    case 'bool':
                    case 'boolean':
                    case 'integer':
                    case 'int':
                    case 'float':
                        $attributeDefaultValue = 0;
                        break;
                    case 'string':
                        $attributeDefaultValue = "";
                        break;
                    case 'NULL':
                        $attributeDefaultValue = null;
                        break;
                    case 'array':
                        $attributeValue = (!is_array($attributeValue) && $attributeValue != null) ? json_decode($attributeValue, true) : $attributeValue;
                        $attributeDefaultValue = null;
                        break;
                    case 'object':
                        $attributeDefaultValue = null;
                        break;
                    default :
                        $attributeDefaultValue = null;
                }

                $this->owner->{$attribute} = $attributeValue ?? $attributeDefaultValue;
                $this->_oldJsonAttributes[$jsonAttributeName][$attribute] = $attributeValue ?? $attributeDefaultValue;
            }
        }
    }

    private function isChanged($jsonAttribute, $attribute, $identical = true)
    {
        if ($identical) {
            return $this->owner->$attribute !== ($this->_oldJsonAttributes[$jsonAttribute][$attribute] ?? null);
        }
        return $this->owner->$attribute != ($this->_oldJsonAttributes[$jsonAttribute][$attribute] ?? null);
    }

    /**
     *
     * @return ActiveQueryJson|object
     * @throws \yii\base\InvalidConfigException
     * @example
     * $this->jsonWhere([Query::where()])
     */
    public static function findJson()
    {
        return Yii::createObject(ActiveQueryJson::class, [self::$OWNER]);
    }
}