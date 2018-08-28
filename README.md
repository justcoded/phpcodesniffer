## PHP Code Sniffer and Mess Detector scripts / rules

Installation instructions:

1. Clone repository on your drive
2. Run `composer install`
3. Run: `chmod +x phpcsx phpmd.phar`
4. Configure your PhpStorm to use both scripts
    - Close all projects to edit settings without project dependency
    - Open Settings
    - Open Languages & Frameworks > PHP > Code Sniffer
        - Add new configuration and specify a path to `phpcsx`
    - Open Languages & Frameworks > PHP > Mess Detector
        - Add new configuration and specify a path to `phpmd.phar`
    - Open Editor > Inspections
        - Find PHP Mess Detector and enable it.
        - Find PHP Code Sniffer and enable it. Specify default standard as "JustcodedWordPress" or "JustcodedPSR2"

## About

[PHP Code Sniffer](https://github.com/squizlabs/PHP_CodeSniffer) is a library, which can validate coding style standard and best practices to be in used.
You can check simple video to find out basics about PHPCS: https://www.youtube.com/watch?v=tKih3UZuwXw  

[PHP Mess Detector](https://phpmd.org/) is another cool code analyzer tool. It can analyze possible bugs, suboptimal code, overcomplicated expressions, ununsed code, etc.

## Usage

### From PHPStorm

Inside PHP Storm you can configure to auto-run it directly inside your editor (default settings, when you enable an Inspection).
Or you can run a specific inspection from a menu: Code > Inspect Code. And then see all errors across some file or even folder.

### CLI

By default PHPCS has a command line interface to run the same checks. For example, you can run:

```bash
./phpcsx --standard=JustcodedWordpress /var/www/wordpress/wp-content/themes/my-theme/
``` 

## PHPStorm configuration

### Code style import

PHPStorm has it's own built-in WordPress and PSR-2 code styles presets, however they follow only must rules and it some cases are not accurate.
We updated code styles to work with current WordPress repository rulesets and modern framework code styles. 
You can find code styles inside `phpstorm` directory in this repository.

To import a code style:

- Open Settings
- Navigate Editor > Code Style 
- Click on wheel icon near a "Scheme" and choose "Import scheme"
- Select xml file to import
- Select new "Wordpress" or "PSR2 tabs" scheme

### Code templates configuration

We belive that all code should be well documented and this means that all properties and methods should have a proper descriptions.
However some methods are self-explanatory like getters or setters. You can configure you PHPStorm to autocomplete short method name to help you minimize you text typing for self-explanatory methods.

To configure that:  

* Open Settings > Editor > File and Code Templates > "Includes" tab -> Php Function Doc Comment
* Replace template with the following: 

```java
#set( $name = ${NAME} )
/**
* $name.substring(0,1).toUpperCase()$name.substring(1).replaceAll("([A-Z])", " $1")
*
${PARAM_DOC}
#if (${TYPE_HINT} != "void") * @return ${TYPE_HINT}
#end
${THROWS_DOC}
*/

```

