<?php

namespace spec\Agile\NimbleBoardBundle\Controller;

use Agile\NimbleBoardBundle\Utils\ControllerUtils;
use Doctrine\ORM\EntityRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\HttpFoundation\Response;

class ProjectControllerSpec extends ObjectBehavior
{
    function let(ControllerUtils $utils, EntityRepository $repository, Response $mockResponse)
    {
        $utils
            ->getRepository('AgileNimbleBoardBundle:Project')
            ->willReturn($repository);

        $utils
            ->renderView(
                'AgileNimbleBoardBundle:Project:list.html.twig',
                array('projects' => array('project 1', 'project 2'))
            )
            ->willReturn($mockResponse);

        $this->beConstructedWith($utils);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Agile\NimbleBoardBundle\Controller\ProjectController');
    }

    function it_should_respond_to_list_action(EntityRepository $repository, Response $mockResponse)
    {
        $repository->findAll()->willReturn(array('project 1', 'project 2'));

        $this->listAction()->shouldBe($mockResponse);
    }
}
