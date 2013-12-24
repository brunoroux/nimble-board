<?php

namespace Agile\NimbleBoardBundle\Controller;

use Agile\NimbleBoardBundle\Utils\ControllerUtils;

class ProjectController
{
    /**
     * @var ControllerUtils $utils
     */
    protected $utils;

    public function __construct(ControllerUtils $utils)
    {
        $this->utils = $utils;
    }

    public function listAction()
    {
        $projects = $this->utils->getRepository('AgileNimbleBoardBundle:Project')->findAll();

        return $this->utils->renderView('AgileNimbleBoardBundle:Project:list.html.twig', array('projects' => $projects));
    }
}
