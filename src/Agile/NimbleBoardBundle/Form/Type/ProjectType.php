<?php

namespace Agile\NimbleBoardBundle\Form\Type;

use Agile\NimbleBoardBundle\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProjectType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('label' => 'project.name'))
            ->add('description', 'textarea', array('label' => 'project.description'))
            ->add('start', 'date', array('label' => 'project.start'))
            ->add('end', 'date', array('label' => 'project.end'))
            ->add('submit', 'submit', array('label' => 'project.submit'));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Agile\NimbleBoardBundle\Entity\Project',
            'empty_data' => function (FormInterface $form) {
                    return new Project(
                        $form->get('name')->getData(),
                        $form->get('description')->getData(),
                        $form->get('start')->getData(),
                        $form->get('end')->getData()
                    );
                }
        ));
    }

    public function getName()
    {
        return "project";
    }
} 