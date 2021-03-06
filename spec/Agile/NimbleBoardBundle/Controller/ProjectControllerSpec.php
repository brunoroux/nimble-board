<?php

namespace spec\Agile\NimbleBoardBundle\Controller;

use Agile\NimbleBoardBundle\Entity\Project;
use Agile\NimbleBoardBundle\Form\Type\ProjectType;
use Agile\NimbleBoardBundle\Utils\ControllerUtils;
use Doctrine\ORM\EntityRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\TranslatorInterface;

class ProjectControllerSpec extends ObjectBehavior
{
    function let(
        ControllerUtils $utils,
        EntityRepository $repository,
        TranslatorInterface $translator,
        FormBuilder $builder,
        Request $request,
        Response $mockResponse
    ) {
        $utils
            ->getRepository('AgileNimbleBoardBundle:Project')
            ->willReturn($repository);

        $utils
            ->getTranslator()
            ->willReturn($translator);

        $utils
            ->getFormBuilder(Argument::type('Agile\NimbleBoardBundle\Entity\Project'))
            ->willReturn($builder);

        $utils
            ->getRequest()
            ->willReturn($request);

        $this->beConstructedWith($utils);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Agile\NimbleBoardBundle\Controller\ProjectController');
    }

    function it_should_respond_to_list_action(
        ControllerUtils $utils,
        EntityRepository $repository,
        Response $mockResponse,
        Project $project1,
        Project $project2
    ) {
        $repository->findAll()->willReturn(array($project1, $project2));

        $utils
            ->renderView(
                'AgileNimbleBoardBundle:Project:list.html.twig',
                array('projects' => array($project1, $project2))
            )
            ->willReturn($mockResponse);

        $this->listAction()->shouldBe($mockResponse);
    }

    function it_should_respond_to_add_action(
        Response $mockResponse,
        Request $request,
        TranslatorInterface $translator,
        Form $form,
        FormView $formView,
        ControllerUtils $utils
    ) {
        $translator->trans(Argument::type('string'))->willReturn('some translation');

        $utils->createForm(new ProjectType())->willReturn($form);
        $form->handleRequest($request)->willReturn($form);
        $form->createView()->willReturn($formView);
        $form->isValid()->willReturn(false);

        $utils
            ->renderView(
                'AgileNimbleBoardBundle:Project:add.html.twig',
                array('form' => $formView)
            )
            ->willReturn($mockResponse);

        $this->addAction()->shouldBe($mockResponse);
    }
}
