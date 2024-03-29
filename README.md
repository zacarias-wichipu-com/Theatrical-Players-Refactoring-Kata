Theatrical Players Refactoring Kata
====================================

The first chapter of [\'Refactoring\' by Martin Fowler, 2nd Edition](https://www.thoughtworks.com/books/refactoring2)
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
Thank you to Martin Fowler and Emily Blanche for kindly giving permission to use his code.

Thanks also to [Fran Iglesias](https://franiglesias.github.io/) for the teachings and for sharing his knowledge and experience in
the [Object Calisthenics refactoring exercises series](https://www.youtube.com/watch?v=Y666Sa9fcTU) of the Emily
Blanche [Theatrical Players Refactoring Kata](https://github.com/emilybache/Theatrical-Players-Refactoring-Kata) and the [Refactor a polimorfismo](https://www.youtube.com/watch?v=8r8PjcHPaKA) exercise.

Object Calisthenics
-------------------

This exercise follows and applies the refactoring of the original _Theatrical Players Refactoring Kata_ code by applying
the **Object Calisthenics** as [Fran Iglesias](https://franiglesias.github.io/) proposes in his video
series [Object Calisthenics refactoring exercises series](https://www.youtube.com/watch?v=Y666Sa9fcTU)

The following list shows the commits at which the application of each of the Object Calisthenics is started:

- [Object Calisthenics: Wrap All Primitives And Strings.](https://github.com/zacarias-wichipu-com/Theatrical-Players-Refactoring-Kata/commit/64c764ef9ed6dcad64f09947381561f0c817d54a)
- [Object Calisthenics: Only one level of indentation per method.](https://github.com/zacarias-wichipu-com/Theatrical-Players-Refactoring-Kata/commit/b04c2174b6d3c244ccfcecfbf92af24f93803f66)
- [Object Calisthenics: Don’t use the “else” keyword.](https://github.com/zacarias-wichipu-com/Theatrical-Players-Refactoring-Kata/commit/d534764e06020de66b86bdf645512d77040305e4)
- [Object Calisthenics: Keep All Entities Small.](https://github.com/zacarias-wichipu-com/Theatrical-Players-Refactoring-Kata/commit/477f11e5fefd6387a1918a113e74ae7ed2feb929)
- [Object Calisthenics: First Class Collections.](https://github.com/zacarias-wichipu-com/Theatrical-Players-Refactoring-Kata/commit/e29bfe26661d315e3495127e3576717bdf827f43)
- [Object Calisthenics: One Dot Per Line.](https://github.com/zacarias-wichipu-com/Theatrical-Players-Refactoring-Kata/commit/03589d95966bba9e5e076d0f903ad6761c74cb68)
- [Object Calisthenics: Do not Use Getters and Setters.](https://github.com/zacarias-wichipu-com/Theatrical-Players-Refactoring-Kata/commit/d76611a9050b29634ad2d78d3e8b8a039b6ec5fd)
- [Object Calisthenics: Do Not Use Classes With More Than Two Instance Variables.](https://github.com/zacarias-wichipu-com/Theatrical-Players-Refactoring-Kata/commit/a8dc01223d5333e98873019ac05501fc2f12fda1)
- Object Calisthenics: Don’t Abbreviate.

Refactor to polymorphism
------------------------

This exercise follows and applies the refactor to polymorphism of the _Object Calisthenics refactoring exercises series_ that [Fran Iglesias](https://franiglesias.github.io/) proposes in his video [Refactor a polimorfismo](https://www.youtube.com/watch?v=8r8PjcHPaKA).

The initial commit of this refactor:

- [Refactor to polymorphism.](https://github.com/zacarias-wichipu-com/Theatrical-Players-Refactoring-Kata/commit/5fce337ee5b179441b98ed09aa0dfd6bc3a074ed)

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
