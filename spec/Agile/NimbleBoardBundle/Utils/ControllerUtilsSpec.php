<?php

namespace spec\Agile\NimbleBoardBundle\Utils;

use Doctrine\ORM\EntityRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Translation\TranslatorInterface;

class ControllerUtilsSpec extends ObjectBehavior
{
    function let(
        ContainerInterface $container,
        RegistryInterface $doctrine,
        EntityRepository $repository,
        EngineInterface $templating,
        Request $request,
        Response $mockResponse,
        FormFactory $formFactory,
        FormBuilder $builder,
        TranslatorInterface $translator,
        RouterInterface $router
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

        $container->get('request')->willReturn($request);

        $container->get('form.factory')->willReturn($formFactory);
        $formFactory->createBuilder('form', null, array())->willReturn($builder);

        $container->get('translator')->willReturn($translator);

        $container->get('router')->willReturn($router);
        $router->generate('some_route', array(), UrlGeneratorInterface::ABSOLUTE_PATH)->willReturn('/some_url');
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

    function it_should_have_get_request(Request $request)
    {
        $this->getRequest()->shouldReturn($request);
    }

    function it_should_have_get_form_builder(FormBuilder $builder)
    {
        $this->getFormBuilder()->shouldReturn($builder);
    }

    function it_should_have_get_translator(TranslatorInterface $translator)
    {
        $this->getTranslator()->shouldReturn($translator);
    }

    function it_should_have_redirect()
    {
        $this->redirect('http://www.google.fr/')->shouldHaveType('Symfony\Component\HttpFoundation\RedirectResponse');
    }

    function it_should_have_generate_url()
    {
        $this->generateUrl('some_route')->shouldReturn('/some_url');
    }
}
