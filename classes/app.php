<?php
class Application
{
    /**
     * @throws RouterException
     */
    public function run()
    {
        session_start();

        $router = new Router();
        $pageName = strtolower($router->getPageName());
        if (!$this->checkPageName($pageName)) {
            throw new RouterException('Error 404: wrong page name');
        }
        $pageFileName = getcwd() . '/../pages/' . $pageName . '.php';
        if (!file_exists($pageFileName)) {
            throw new RouterException('Error 404: page ' . $pageName . ' not found');
        } else {
            include $pageFileName;
        }
    }

    private function checkPageName(string $pageName)
    {
        return preg_match('/^[a-zA-Z0-9]+$/', $pageName);
    }
}