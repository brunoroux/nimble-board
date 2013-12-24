<?php

namespace Agile\NimbleBoardBundle\Behat;


use Agile\NimbleBoardBundle\Entity\Project;
use Agile\NimbleBoardBundle\Entity\User;
use Behat\Behat\Context\BehatContext;
use Behat\Gherkin\Node\TableNode;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Faker\Factory as FakerFactory;

class DataContext extends BehatContext implements KernelAwareInterface
{
    /**
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     * @var KernelInterface
     */
    private $kernel;

    public function __construct()
    {
        $this->faker = FakerFactory::create();
    }

    /**
     * {@inheritdoc}
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    public function thereIsUser($username, $email, $password, $role)
    {
        $user = new User();
        $user->setUsername($username);
        $user->setPlainPassword($password);
        $user->setEmail($email);
        $user->setEnabled(true);
        $user->addRole($role);

        $this->getManager()->persist($user);
        $this->getManager()->flush();
    }

    /**
     * @Given /^there are following projects$/
     */
    public function thereAreFollowingProjects(TableNode $projects)
    {
        foreach ($projects->getHash() as $data) {
            $this->thereIsProject($data['name']);
        }
    }

    public function thereIsProject($name)
    {
        $project = new Project();
        $project->setName($name);
        $project->setDescription($this->faker->text());
        $project->setStart(new \DateTime());
        $project->setEnd(new \DateTime('+1 year'));

        $this->getManager()->persist($project);
        $this->getManager()->flush();
    }

    protected function getManager()
    {
        return $this->kernel->getContainer()->get('doctrine')->getManager();
    }
} 