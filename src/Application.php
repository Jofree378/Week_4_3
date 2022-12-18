<?php
namespace Base;

use App\Controller\Loop;
use Exception;

class Application
{
    private $route;
    private $controller;
    private $actionName;

    public function __construct()
    {
        $this->route = new Route();
    }

    // Начало сессии подключение данных пользователя, сообщений и вывод ошибок
    public function run()
    {
        try {
            $this->addRoutes();
            $this->initController();
            $this->initAction();

            $content = $this->controller->{$this->actionName}();
            echo $content;

        } catch (Exception $e) {
            header('Location: ' . $e->getMessage());
            die;
        }

    }

    // Добавление роута
    private function addRoutes()
    {
        $this->route->addRoute('/loop', Loop::class, 'image');
    }

    // Инициализация контроллера
    private function initController()
    {
        $controllerName = $this->route->getControllerName();
        if (!class_exists($controllerName)) {
            throw new Exception('Can`t find controller' . $controllerName);
        }
        $this->controller = new $controllerName;
    }

    // Инициализация метода
    private function initAction()
    {
        $actionName = $this->route->getActionName();
        if (!method_exists($this->controller, $actionName)) {
            throw new Exception('Action ' . $actionName . ' not found in ' . get_class($this->controller));
        }
        $this->actionName = $actionName;
    }

}