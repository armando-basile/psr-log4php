[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/abacaphiliac/psr-log4php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/abacaphiliac/psr-log4php/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/abacaphiliac/psr-log4php/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/abacaphiliac/psr-log4php/?branch=master)
[![Build Status](https://travis-ci.org/abacaphiliac/psr-log4php.svg?branch=master)](https://travis-ci.org/abacaphiliac/psr-log4php)

# abacaphiliac/psr-log4php
A PSR-3-compliant log4php-wrapper.

# Installation
```bash
composer require abacaphiliac/psr-log4php
```

# Usage

```
$nonPsrLogger = \Logger::getLogger('MyLogger');
$psrLogger = new \Abacaphiliac\PsrLog4Php\LoggerWrapper($nonPsrLogger);
```

# Dependencies
See [composer.json](composer.json).

## Contributing
```
composer update && vendor/bin/phing
```

This library attempts to comply with [PSR-1][], [PSR-2][], and [PSR-4][]. If
you notice compliance oversights, please send a patch via pull request.

[PSR-1]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md
[PSR-2]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[PSR-4]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md
