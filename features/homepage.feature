Feature: homepage
    In order to manage my projects
    As a visitor
    I want to be able to see the homepage

    Scenario: Viewing the homepage at website root
    When I go to the homepage
    Then I should be redirected to the fos_user_security_login page
    And I should see "Login"