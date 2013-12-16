<?php

namespace Agile\NimbleBoardBundle\Behat;

use Behat\MinkExtension\Context\MinkContext;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';

/**
 * Features context.
 */
class FeatureContext extends MinkContext implements KernelAwareInterface
{
    /**
     * Initializes context.
     * Every scenario gets its own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
    }

    /**
     * {@inheritdoc}
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @Then /^I should be redirected to the (.+) (page|step)$/
     */
    public function iShouldBeOnThePage($page)
    {
        $this->assertSession()->addressEquals($this->generatePageUrl($page));
    }

    /**
     * Generate page url.
     * This method uses simple convention where page argument is prefixed
     * with "sylius_" and used as route name passed to router generate method.
     *
     * @param string $page
     * @param array $parameters
     *
     * @return string
     */
    private function generatePageUrl($page, array $parameters = array())
    {
        $parts = explode(' ', trim($page), 2);

        $route = implode('_', $parts);
        $routes = $this->getContainer()->get('router')->getRouteCollection();

        if (null === $routes->get($route)) {
            $route = 'agile_nimble_board_'.$route;
        }

        $path = $this->generateUrl($route, $parameters);

        if ('Selenium2Driver' === strstr(get_class($this->getSession()->getDriver()), 'Selenium2Driver')) {
            return sprintf('%s%s', $this->getMinkParameter('base_url'), $path);
        }

        return $path;
    }

    /**
     * Generate url.
     *
     * @param string $route
     * @param array $parameters
     * @param Boolean $absolute
     *
     * @return string
     */
    private function generateUrl($route, array $parameters = array(), $absolute = false)
    {
        return $this->getService('router')->generate($route, $parameters, $absolute);
    }

    /**
     * Get service by id.
     *
     * @param string $id
     *
     * @return object
     */
    private function getService($id)
    {
        return $this->getContainer()->get($id);
    }

    /**
     * Returns Container instance.
     *
     * @return ContainerInterface
     */
    private function getContainer()
    {
        return $this->kernel->getContainer();
    }
}
