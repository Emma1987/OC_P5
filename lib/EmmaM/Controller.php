<?php
namespace EmmaM;

class Controller
{
    protected $app;
    protected $action = '';
    protected $module = '';
    protected $page = null;
    protected $view = '';
    protected $layout = '';
    protected $manager = null;

    public function __construct(Application $app, $module, $action, $layout)
    {
        $this->app = $app;
        $this->page = new Page();
        $this->manager = new Manager();

        $this->setAction($action);
        $this->setModule($module);
        $this->setView($action);
        $this->setLayout($layout);
    }

    public function execute()
    {
        $method = 'execute' . ucfirst($this->getAction());

        if (!is_callable([$this, $method])) {
            throw new \RuntimeException('L\'action "' . $this->action . '" n\'est pas définie sur ce module');
        }

        $this->$method($this->app->getHttpRequest());
    }

    public function setView($view)
    {
        if (!is_string($view) || empty($view)) {
            throw new \InvalidArgumentException('La vue doit être une chaine de caractères non nulle.');
        }

        $this->view = $view;
        $this->page->setContentFile(__DIR__.'/../../App/Modules/'.$this->module.'/Views/'.$this->view.'View.php');
    }

    public function setLayout($layout)
    {
        if (!is_string($layout)) {
            throw new \InvalidArgumentException('Le layout doit être une chaine de caractères.');
        }

        $this->layout = $layout;
        $this->page->setLayout(__DIR__ . '/../../App/Templates/' . $this->layout . 'Layout.php');
    }

    // FUNCTIONS USED IN SEVERAL CONTROLLERS
    
    private function restrictAccess()
    {
        if (!(Session::getInstance()->isActive()) || (Session::getInstance()->getAttribute('auth')->getRole() != 2)) {
            Session::getInstance()->setFlash(
                'danger', 
                'Vous n\'avez pas les droits nécessaires pour accéder à l\'administration.'
            );
            $this->app->getHttpResponse()->redirect('/');
        } else {
            return true;
        }
    }

    protected function adminLayout()
    {
        $this->restrictAccess();

        $adminPosts = $this->manager->getManagerOf('Post')->countPosts();
        $adminComments = $this->manager->getManagerOf('Comment')->countComments();
        $adminCategories = $this->manager->getManagerOf('Category')->countCategories();
        $userLogged = $this->manager->getManagerOf('User')->getUserById($_SESSION['auth']->getId());
        $adminUsers = $this->manager->getManagerOf('User')->countUsers();

        $this->page->addVar('adminPosts', $adminPosts);
        $this->page->addVar('adminComments', $adminComments);
        $this->page->addVar('adminCategories', $adminCategories);
        $this->page->addVar('userLogged', $userLogged);
        $this->page->addVar('adminUsers', $adminUsers);
    }

    protected function listPosts()
    {
        $listPosts = $this->manager->getManagerOf('Post')->getAllPosts();
        $images = $this->manager->getManagerOf('Image')->getAllImages();

        foreach ($images as $image) {
            $postImage[$image->getPostId()] = $image->getTitle() . $image->getPostId() . '.' . $image->getExtension();
        }

        $this->page->addVar('listPosts', $listPosts);
        $this->page->addVar('postImage', $postImage);
    }

    protected function post()
    {
        $request = $this->app->getHttpRequest();

        $post = $this->manager->getManagerOf('Post')->getPostById($request->getData('id'));
        if (empty($post)) {
            $this->app->getHttpResponse()->redirect404();
        }
        $comments = $this->manager->getManagerOf('Comment')->getPublishedCommentsByPostId($request->getData('id'));
        $categories = $this->manager->getManagerOf('Category')->getCategoriesByPost($request->getData('id'));
        $image = $this->manager->getManagerOf('Image')->getImageByPost($request->getData('id'));    

        $this->page->addVar('title', $post->getTitle());
        $this->page->addVar('post', $post);
        $this->page->addVar('comments', $comments);
        $this->page->addVar('categories', $categories);
        $this->page->addVar('image', $image);
    }

    // GETTERS & SETTERS
    
    public function getApp()
    {
        return $this->app;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getModule()
    {
        return $this->module;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function getLayout()
    {
        return $this->layout;
    }

    public function getManager()
    {
        return $this->manager;
    }

    public function setAction($action)
    {
        $this->action = $action;
    }

    public function setModule($module)
    {
        $this->module = $module;
    }
}