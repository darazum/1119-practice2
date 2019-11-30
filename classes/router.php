<?php
class Router
{
    public function getPageName()
    {
        $page = 'main';
        $parts = explode('/', $_SERVER['REQUEST_URI']);
        if (!empty($parts[1])) {
            $page = $parts[1];
        }

        return $page;
    }
}