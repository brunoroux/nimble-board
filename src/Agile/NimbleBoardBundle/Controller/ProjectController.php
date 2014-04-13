<?php

namespace Agile\NimbleBoardBundle\Controller;

use Agile\NimbleBoardBundle\Entity\Project;
use Agile\NimbleBoardBundle\Form\Type\ProjectType;
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

    public function addAction()
    {
        $form = $this->utils->createForm(new ProjectType());
        $form->handleRequest($this->utils->getRequest());

        if ($form->isValid()) {
            // perform some action, such as saving the task to the database

            return $this->utils->redirect($this->utils->generateUrl('agile_nimble_board_project_list'));
        }

        return $this->utils->renderView(
            'AgileNimbleBoardBundle:Project:add.html.twig',
            array('form' => $form->createView())
        );
    }
}
