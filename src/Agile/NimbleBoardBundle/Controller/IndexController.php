<?php

namespace Agile\NimbleBoardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class IndexController extends Controller
{

    public function indexAction()
    {
        return $this->render('AgileNimbleBoardBundle:Index:index.html.twig');
    }
}