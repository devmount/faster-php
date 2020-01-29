# faster-php

Different approaches to improve PHP script performance

## Get started

```bash
git clone https://github.com/devmount/faster-php
cd faster-php
php composer.phar install
php test_array_unique.php # or whatever test file you'd like to run
```

## List of methods

### 1. Removing duplicates

Method:

```php
// using
array_keys(array_flip($a));
// instead of
array_unique($array);
```

Test:

```bash
php test_array_unique.php
```

Result:

| method | time | memory |
|--------|-----:|-------:|
| `array_unique` | 787.31 ms | 230.00 MB |
| `array_keys` `array_flip` | 434.03 ms | 0.00 KB |

The alternative approach is **44.87 %** faster in this measurement. On average, it was 30 % faster.
