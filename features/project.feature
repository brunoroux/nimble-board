Feature: project
    In order to see a clear state of my projects
    As a user
    I want to be able to manage my projects

    Scenario: Viewing the project list
        Given there are following projects
            | name         |
            | nimbleboard  |
            | test project |
        And I am logged in as user
        When I go to the project list page
        Then I should see "Projects"
        And I should see 2 projects
        And I should see project with name "nimbleboard"