youtube symfony tutorial Refactoring:

Building a Symfony 3 App
on: https://www.youtube.com/watch?v=HchMW8EhWPU

the target ist to use Forms with the latest symfony release,
so you have better support of your IDE e.g. PhpStom 
and the Structure of the Code is much better

Layout of the form layout: use in config.yml:
# Twig Configuration
twig:
    debug:            "%kernel.debug%"
    strict_variables: "%kernel.debug%"
    form_themes:
    - 'bootstrap_3_layout.html.twig'