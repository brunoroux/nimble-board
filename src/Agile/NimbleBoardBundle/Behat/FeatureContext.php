<?php

namespace Agile\NimbleBoardBundle\Behat;

use Behat\MinkExtension\Context\MinkContext;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
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
        $this->useContext('data', new DataContext());
    }

    /**
     * {@inheritdoc}
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @Given /^I am logged in as user$/
     */
    public function iAmLoggedInAsUser()
    {
        $this->iAmLoggedInAsRole('ROLE_USER');
    }

    /**
     * Create user and login with given role.
     *
     * @param string $role
     */
    private function iAmLoggedInAsRole($role)
    {
        $this->getSubContext('data')->thereIsUser('user', 'user@example.com', 'user', $role);
        $this->getSession()->visit($this->generatePageUrl('fos_user_security_login'));

        $this->fillField('_username', 'user');
        $this->fillField('_password', 'user');
        $this->pressButton('Login');
    }

    /**
     * @When /^I go to the (.+) page$/
     */
    public function iGoToThePage($page)
    {
        $url = $this->generatePageUrl($page);
        $this->visit($url);
    }

    /**
     * @Then /^I should see (\d+) projects$/
     */
    public function iShouldSeeProjects($amount)
    {
        $this->assertSession()->elementsCount('css', 'div.project', $amount);
    }

    /**
     * @Then /^I should see project with name "([^"]*)"$/
     */
    public function iShouldSeeProjectWithName($name)
    {
        $locator = sprintf("div.project h2:contains('%s')", $name);

        $this->assertSession()->elementExists('css', $locator);
    }

    /**
     * @Then /^I should be redirected to the (.+) (page|step)$/
     */
    public function iShouldBeOnThePage($page)
    {
        $this->assertSession()->addressEquals($this->generatePageUrl($page));
    }

    /**
     * @Then /^display the response content$/
     */
    public function displayTheResponseContent()
    {
        echo $this->getSession()->getPage()->getContent();
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

    /**
     * @BeforeScenario
     */
    public function purgeDatabase()
    {
        $entityManager = $this->kernel->getContainer()->get('doctrine.orm.entity_manager');

        $purger = new ORMPurger($entityManager);
        $purger->purge();
    }
}
