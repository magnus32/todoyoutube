youtube symfony tutorial Refactoring:
the target ist to use Forms with the latest symfony release,
so you have much better support of PhpStom 
and the Structure of the Code is much better

Layout of the form layout: use in config.yml:
# Twig Configuration
twig:
    debug:            "%kernel.debug%"
    strict_variables: "%kernel.debug%"
    form_themes:
    - 'bootstrap_3_layout.html.twig'