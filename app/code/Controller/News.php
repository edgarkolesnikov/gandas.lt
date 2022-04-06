<?php

namespace Controller;

use Core\ControllerAbstract;

class News extends ControllerAbstract
{
    public function show($slug)
    {
        $new = new \Model\News();
        $new ->loadBySlug($slug);
        echo $this->twig->render('news/single.html',['new'=>$new]);
    }

    public function all(){
        $news = new \Model\Collection\News();
        $news->filter('active', 1);
        $news->limit(3);
        echo $this->twig->render('news/all.html', ['news'=> $news->get()]);
    }

}