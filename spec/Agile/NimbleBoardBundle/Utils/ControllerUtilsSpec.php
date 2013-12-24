<?php

namespace spec\Agile\NimbleBoardBundle\Utils;

use Doctrine\ORM\EntityRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

class ControllerUtilsSpec extends ObjectBehavior
{
    function let(
        ContainerInterface $container,
        RegistryInterface $doctrine,
        EntityRepository $repository,
        EngineInterface $templating,
        Response $mockResponse
    ) {
        $this->beConstructedWith($container);
        $container->get('doctrine')->willReturn($doctrine);
        $doctrine->getRepository('AgileNimbleBoardBundle:Project')->willReturn($repository);

        $container->get('templating')->willReturn($templating);
        $templating
            ->renderResponse(
                'AgileNimbleBoardBundle:Project:list.html.twig',
                array('projects' => array('project 1', 'project 2'))
            )
            ->willReturn($mockResponse);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Agile\NimbleBoardBundle\Utils\ControllerUtils');
    }

    function it_should_have_get_repository(EntityRepository $repository)
    {
        $this->getRepository('AgileNimbleBoardBundle:Project')->shouldReturn($repository);
    }

    function it_should_have_render_view(Response $mockResponse)
    {
        $this
            ->renderView(
                'AgileNimbleBoardBundle:Project:list.html.twig',
                array('projects' => array('project 1', 'project 2'))
            )
            ->shouldReturn($mockResponse);
    }
}
