Yii2 admin module
=================

Модуль находится в состоянии активной разработки. Не используйте его!

Модуль админки вдохновлён админкой [Django](https://www.djangoproject.com/).
Для интерфейса используется [SB Admin](http://startbootstrap.com/template-overviews/sb-admin/).



##Использование

Сперва создайте модуль `admin` в директории модулей своего проекта (например `/path/to/project/frontent/modules/admin`). Создаёте класс `Module` расширяющий `asdfstudio\admin\Module`.

```php
use asdfstudio\admin\Module as AdminModule;

class Module extends AdminModule {

}
```

Теперь добавьте следующте строки в свой кофигурационный файл, в секции `modules` и `bootstrap`

```php
return [
    'bootstrap' => ['admin'],
    'modules' => [
    	...
        'admin' => [
            'class' => 'frontend\modules\admin\Module',
        ],
        ...
    ],
    ...
];
```

На этом всё. Теперь вы можете попасть в админку, зайдя на `/admin`.


###Регистрация моделей

Теперь нам нужно зарегистрировать первую модель в панели управления. Создайте класс `UserEntity` в в своей папке `admin/entities`.
Класс должен наследовать `asdfstudio\admin\base\Entity`.
Формат записи атрибутов модели такой же как у [DetailView](http://www.yiiframework.com/doc-2.0/guide-data-widgets.html#detailview) (в будущем это может измениться, т.к. админки ещё на ранней стадии развития).

```php
use asdfstudio\admin\base\Entity;
use common\models\User;

class UserEntity extends Entity
{
    public static function attributes()
    {
        return [ // this attributes will show in table and detail view
            'id',
            'username',
            'email:email',
            [
                'attribute' => 'role',
                'format' => ['list', [User::ROLE_USER => 'User', User::ROLE_ADMIN => 'Admin']],
            ],
            [
                'attribute' => 'status',
                'format' => ['list', [User::STATUS_ACTIVE => 'Active', User::STATUS_DELETED => 'Deleted', User::STATUS_BANNED => 'Banned']],
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ];
    }

    public static function labels()
    {
        return ['User', 'Users']; // labels used in admin page
    }

    public static function slug()
    {
        return 'user'; // this is a path inside admin module. E.g. /admin/manage/user[/<id>[/edit]]
    }

    public static function model()
    {
        return User::className(); // class of User model
    }

    public function form($scenario = Model::SCENARIO_DEFAULT)
    {
        return [ // form configuration
            'class' => Form::className(), // form class name
            'renderSaveButton' => true, // render save button or not
            'fields' => [ // fields configuration
                [
                    'wrapper' => '<div class="col-md-8">{items}</div>', // wrapper of items
                    'items' => [
                        [
                            'class' => Input::className(),
                            'attribute' => 'username',
                        ],
                        [
                            'class' => Select::className(),
                            'attribute' => 'role',
                            'items' => [User::ROLE_USER => 'User', User::ROLE_ADMIN => 'Admin'],
                        ],
                        [ // list of all user posts
                            'class' => Select::className(),
                            'attribute' => 'posts', // attribute name, for saving should implement setter for `posts` attribute
                            'labelAttribute' => 'title', // shows in select box
                            'query' => Post::find()->indexBy('id'), // all posts, should be indexed
                        ],
                    ]
                ],
                [
                    'wrapper' => '<div class="col-md-4">{items}</div>',
                    'items' => [
                        [ // example button
                            'id' => 'ban',
                            'class' => Button::className(),
                            'label' => 'Ban user',
                            'options' => [
                                'class' => 'btn btn-danger'
                            ],
                            'action' => function(User $model) {
                                $model->setAttribute('status', User::STATUS_BANNED);
                                return true;
                            },
                        ],
                    ],
                ],
            ],
        ];
    }
}
```

Зарегистрируйте этусущность в своём модуле:

```php
use asdfstudio\admin\Module as AdminModule;

class Module extends AdminModule {
	...
	public function init() {
		parent::init();

		$this->registerEntity(UserEntity::className()); // this register entity in admin module

		$this->sidebar->addItem(UserEntity::className());// and this creates link in sidebar
	}
	...
}

```

Теперь переходите на `/admin/manage/user` и увидите таблицу со всеми пользоватеоями сайта.

Для примера смотрите [asdf-studio/yii2-blog-module](https://github.com/asdf-studio/yii2-blog-module).


###Создание произвольных страниц

Для создания произвольной страницы, вы долны создать контроллер в папке `@app/modules/admin/controllers`.
Он должен наследовать `asdfstudio\admin\controllers\Controller`:

```php
namespace frontend\modules\admin\controllers;

use asdfstudio\admin\controllers\Controller;

class MyController extends Controller
{
    public function actionIndex() {
        return $this->render('@app/modules/admin/views/my/index');
    }
}
```

Есть одна неразрешенная проблема с `$viewPath`. Yii2 не разрешает переопределять его во время выполнения, так что нам придётся передавать полный путь к представлению.
Или вы можете переопределить метод `render()` как показано ниже:

```php
public function render($view, $params = []) {
    return parent::render("@app/modules/admin/views/{$this->id}/{$view}", $params);
}
```

После создания контроллера нам надо зарегистрировать его в админке:

```php
public function init()
{
    parent::init();

    $this->registerController('my', MyController::className()); // creating controller alias (@see $controllerMap)
    $this->registerRoutes([
        $this->urlPrefix . '/my' => $this->id . '/my/index' // creating rule
    ]);
}
```

Не забудьте создать представление `my/index`!
Теперь можете перейти на `/admin/my` и вы увидите свою страницу.
