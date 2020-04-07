# faster-php ⚡

Different approaches to improve PHP script performance

## Get started

Make sure PHP 7.4 is installed:

```bash
$ php -v
PHP 7.4.4 (cli) (built: Mar 20 2020 13:47:17) ...
```

Then clone this repo and install dependencies:

```bash
git clone https://github.com/devmount/faster-php
cd faster-php
php composer.phar install
```

Now you are ready to call the one of the test scripts presented below.

## List of methods

### 1. Removing duplicates in array

Method:

```php
// using
array_keys(array_flip($array));
// instead of
array_unique($array);
```

Test:

```bash
php test_array_unique.php
```

Result:

| method | execution time |
|--------|-----:|
| `array_unique` | 787.31 ms |
| `array_keys` `array_flip` | 434.03 ms |

The alternative approach is **1.8x** (44.87%) faster in this measurement. On average, it was ~1.5x (30%) faster. Tested on an array with 4166667 numeric elements having 3333333 unique entries.

### 2. Get random array element

Method:

```php
// using
$array[mt_rand(0, count($array) - 1)];
// instead of
array_rand($array);
```

Test:

```bash
php test_array_rand.php
```

Result:

| method | execution time |
|--------|-----:|
| `array_rand` | 25.99 μs |
| `mt_rand` | 0.95 μs |

The alternative approach is **27.3x** (96.33%) faster in this measurement. On average, it was ~8x (87%) faster. Tested on an array with 5000000 random numeric elements.

### Test for alphanumeric characters

Method:

```php
// using
ctype_alnum($string);
// instead of
preg_match('/[a-zA-Z0-9]+/', $string);
```

Test:

```bash
php test_preg_match.php
```

Result:

| method | execution time |
|--------|-----:|
| `preg_match` | 15.39 ms |
| `ctype_alnum` | 2.06 ms |

The alternative approach is **7.5x** (86.59%) faster in this measurement. On average, it was ~4x (76%) faster. Tested on an array of alphanumeric and non-alphanumeric strings with 104448 elements.

The same applies to `ctype_alpha()` (check for alphabetic characters) and `ctype_digit()` (check for numeric characters)

### Replace substrings

Method:

```php
// using
strtr($string, 'a', 'b');
// instead of
str_replace('a', 'b', $string);
```

Test:

```bash
php test_string_replace.php
```

Result:

| method | execution time |
|--------|-----:|
| `str_replace` | 676.59 ms |
| `strtr` | 305.59 ms |

The alternative approach is **2.2x** (54.83%) faster in this measurement. On average, it was ~2x (51%) faster. Tested on an array of random strings with 5000000 elements.
