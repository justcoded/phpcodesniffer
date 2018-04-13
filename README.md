## PHP Code Sniffer and Mess Detector scripts / rules

Installation instructions:

1. Clone repository on your drive
2. Run `composer install`
2. Run: `chmod +x phpcsx phpmd`
3. Configure your PhpStorm to use both scripts
4. (Optional) Open PhpStorm Settings -> Editor -> File and Code Templates [Includes] -> Php Function Doc Comment 
And replace content with:
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
This will generate a **short description** for functions and methods with Function / Method name.
