<?php

namespace spec\Agile\NimbleBoardBundle\Form\Type;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProjectTypeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Agile\NimbleBoardBundle\Form\Type\ProjectType');
        $this->shouldHaveType('Symfony\Component\Form\AbstractType');
    }

    function it_should_have_a_name()
    {
        $this->getName()->shouldBe('project');
    }

    function it_should_build_a_form(FormBuilderInterface $builder)
    {
        $builder->add('name', 'text', Argument::cetera())->willReturn($builder);
        $builder->add('description', 'textarea', Argument::cetera())->willReturn($builder);
        $builder->add('start', 'date', Argument::cetera())->willReturn($builder);
        $builder->add('end', 'date', Argument::cetera())->willReturn($builder);
        $builder->add('submit', 'submit', Argument::cetera())->willReturn($builder);

        $this->buildForm($builder, array());
    }

    function it_should_set_default_options(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(Argument::withEntry('data_class', 'Agile\NimbleBoardBundle\Entity\Project'))->shouldBeCalled();
        $this->setDefaultOptions($resolver);
    }
}
