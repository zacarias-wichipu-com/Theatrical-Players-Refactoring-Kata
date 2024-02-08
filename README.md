Theatrical Players Refactoring Kata
====================================

The first chapter of ['Refactoring' by Martin Fowler, 2nd Edition](https://www.thoughtworks.com/books/refactoring2)
contains a worked example of this exercise, in javascript. That chapter is available to download for free.

This is the PHP version for this exercise, with tests, so you can try it out for yourself.

What you need to change
-----------------------
Refactoring is usually driven by a need to make changes. In the book, Fowler adds code to print the statement as HTML in
addition to the existing plain text version. He also mentions that the theatrical players want to add new kinds of plays
to their repertoire, for example history and pastoral.

Automated tests
---------------
In his book Fowler mentions that the first step in refactoring is always the same - to ensure you have a solid set of
tests for that section of code. However, Fowler did not include the test code for this example in his book. I have used
an [Approval testing](https://medium.com/97-things/approval-testing-33946cde4aa8) approach and added some tests. I find
Approval testing to be a powerful technique for rapidly getting existing code under test and to support refactoring. You
should review these tests and make sure you understand what they cover and what kinds of refactoring mistakes they would
expect to find.

Acknowledgements
----------------
Thankyou to Martin Fowler for kindly giving permission to use his code.

Thanks also to Fran Iglesias for the teachings and for sharing his knowledge and experience in
the [Object Calisthenics refactoring exercises series](https://www.youtube.com/watch?v=Y666Sa9fcTU) of the Emily
Blanche [Theatrical Players Refactoring Kata](https://github.com/emilybache/Theatrical-Players-Refactoring-Kata).

## Installation

The kata uses:

- [PHP 8.0+](https://www.php.net/downloads.php)
- [Composer](https://getcomposer.org)

Recommended:

- [Git](https://git-scm.com/downloads)

See [GitHub cloning a repository](https://help.github.com/en/articles/cloning-a-repository) for details on how to
create a local copy of this project on your computer.

```sh
git clone git@github.com:emilybache/Theatrical-Players-Refactoring-Kata.git
```

or

```shell script
git clone https://github.com/emilybache/Theatrical-Players-Refactoring-Kata.git
```

Install all the dependencies using composer:

```sh
cd ./Theatrical-Players-Refactoring-Kata/php
composer install
```

## Dependencies

The project uses composer to install:

- [PHPUnit](https://phpunit.de/)
- [ApprovalTests.PHP](https://github.com/approvals/ApprovalTests.php)
- [PHPStan](https://github.com/phpstan/phpstan)
- [Easy Coding Standard (ECS)](https://github.com/symplify/easy-coding-standard)

## Folders

- `src` - Contains the **StatementPrinter** Class along with the setup classes. Only **StatementPrinter.php** is
  refactored.
- `tests` - Contains the corresponding tests. There should be no need to amend the test.
    - `approvals` - Contains the text output for the tests. There should be no need to amend.

## Testing

PHPUnit is configured for testing, a composer script has been provided. To run the unit tests, from the root of the PHP
project run:

```shell script
composer tests
```

On Windows a batch file has been created, like an alias on Linux/Mac (e.g. `alias pu="composer tests"`), the same
PHPUnit `composer tests` can be run:

```shell script
pu.bat
```

### Tests with Coverage Report

To run all test and generate a html coverage report run:

```shell script
composer test-coverage
```

The test-coverage report will be created in /builds, it is best viewed by opening /builds/**index.html** in your
browser.

The [XDEbug](https://xdebug.org/download) extension is required for coverage report generating.

## Code Standard

Easy Coding Standard (ECS) is configured for style and code standards,
**[PSR-12](https://www.php-fig.org/psr/psr-12/)** is used. As the code is constantly being refactored only run code
standard checks once the chapter is complete.

### Check Code

To check code, but not fix errors:

```shell script
composer check-cs
``` 

On Windows a batch file has been created, like an alias on Linux/Mac (e.g. `alias cc="composer check-cs"`), the
same ECS `composer check-cs` can be run:

```shell script
cc.bat
```

### Fix Code

ECS provides may code fixes, automatically, if advised to run --fix, the following script can be run:

```shell script
composer fix-cs
```

On Windows a batch file has been created, like an alias on Linux/Mac (e.g. `alias fc="composer fix-cs"`), the same
ECS `composer fix-cs` can be run:

```shell script
fc.bat
```

## Static Analysis

PHPStan is used to run static analysis checks. As the code is constantly being refactored only run static analysis
checks once the chapter is complete.

```shell script
composer phpstan
```

On Windows a batch file has been created, like an alias on Linux/Mac (e.g. `alias ps="composer phpstan"`), the
same PHPStan `composer phpstan` can be run:

```shell script
ps.bat
```

**Happy coding**!
