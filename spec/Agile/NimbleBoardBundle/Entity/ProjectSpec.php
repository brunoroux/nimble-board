<?php

namespace spec\Agile\NimbleBoardBundle\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProjectSpec extends ObjectBehavior
{
    function let()
    {
        $name = "Project name";
        $description = "My project description";
        $start = new \DateTime();
        $end = new \DateTime('+1 month');
        $this->beConstructedWith($name, $description, $start, $end);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Agile\NimbleBoardBundle\Entity\Project');
    }
}
