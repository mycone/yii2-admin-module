<?php


namespace asdfstudio\admin\base;


use asdfstudio\admin\forms\Form;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\helpers\Inflector;
use ReflectionClass;

/**
 * Class Entity
 * @package asdfstudio\admin
 */
abstract class Entity extends Component
{
    /**
     * Triggers after new model creation
     */
    const EVENT_CREATE_SUCCESS  = 'entity_create_success';
    const EVENT_CREATE_FAIL     = 'entity_create_fail';
    /**
     * Trigers after model updated
     */
    const EVENT_UPDATE_SUCCESS  = 'entity_update_success';
    const EVENT_UPDATE_FAIL     = 'entity_update_fail';
    /**
     * Triggers after model deleted
     */
    const EVENT_DELETE_SUCCESS  = 'entity_delete_success';
    const EVENT_DELETE_FAIL     = 'entity_delete_fail';

    /**
     * @var string Entity Id
     */
    public $id;
    /**
     * @var Model's class name
     */
    public $modelClass;
    /**
     * @var array Labels
     */
    public $labels;

    /**
     * Should return an array with single and plural form of model name, e.g.
     *
     * ```php
     *  return ['User', 'Users'];
     * ```
     *
     * @return array
     */
    public function labels() {
        $class = new ReflectionClass(static::className());
        $class = $class->getShortName();

        return [$class, Inflector::pluralize($class)];
    }

    /**
     * Slug for url, e.g.
     * Slug should match regex: [\w\d-_]+
     *
     * ```php
     *  return 'user'; // url will be /admin/manage/user[<id>[/<action]]
     * ```
     *
     * @return string
     */
    public function slug() {
        return Inflector::slug(static::model());
    }

    /**
     * Model's class name
     *
     * ```php
     *  return vendorname\blog\Post::className();
     * ```
     *
     * @return string
     * @throws InvalidConfigException
     */
    abstract public function model();

    /**
     * Class name of form using for update or create operation
     * Default form class is `asdfstudio\admin\base\Form`
     * For configuration syntax see [[[Form]]
     *
     * ```php
     *  return [
     *      'class' => vendorname\blog\forms\PostForm::className(),
     *  ];
     * ```
     *
     * @return array
     */
    public function form()
    {
        return [
            'class' => Form::className(),
        ];
    }
}
