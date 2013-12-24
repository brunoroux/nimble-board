<?php

namespace Agile\NimbleBoardBundle\Utils;

use Symfony\Component\DependencyInjection\ContainerInterface;

class ControllerUtils
{
    /**
     * @var ContainerInterface $container
     */
    private $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $repository
     *
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    public function getRepository($repository)
    {
        return $this->container->get('doctrine')->getRepository($repository);
    }

    /**
     * @param $template
     * @param $vars
     *
     * @return mixed
     */
    public function renderView($template, $vars)
    {
        return $this->container->get('templating')->renderResponse($template, $vars);
    }
}
