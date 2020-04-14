# faster-php ⚡

Different approaches to improve PHP script performance. For discussion or additional methods [create an issue](https://github.com/devmount/faster-php/issues/new) or comment on the corresponding [DEV article](https://dev.to/devmount/massively-boost-your-php-script-performance-3d71) (soon to be published).

## Get started

To test the methods yourself, first make sure PHP 7.4 is installed:

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
|--------|---------------:|
| `array_unique` | 787.31 ms |
| `array_keys` `array_flip` | 434.03 ms |

The alternative approach is **1.8x** (44.87%) faster in this measurement. On average, it was ~1.5x (30%) faster. Tested on an array with 4166667 numeric elements having 3333333 unique entries.

Note: This is only applicable for simple, one-dimensional arrays since `array_flip` replaces keys by values.

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
|--------|---------------:|
| `array_rand` | 25.99 μs |
| `mt_rand` | 0.95 μs |

The alternative approach is **27.3x** (96.33%) faster in this measurement. On average, it was ~8x (87%) faster. Tested on an array with 5000000 random numeric elements.

### 3. Test for alphanumeric characters

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
|--------|---------------:|
| `preg_match` | 15.39 ms |
| `ctype_alnum` | 2.06 ms |

The alternative approach is **7.5x** (86.59%) faster in this measurement. On average, it was ~4x (76%) faster. Tested on an array of alphanumeric and non-alphanumeric strings with 104448 elements.

The same applies to `ctype_alpha()` (check for alphabetic characters) and `ctype_digit()` (check for numeric characters)

### 4. Replace substrings

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
|--------|---------------:|
| `str_replace` | 676.59 ms |
| `strtr` | 305.59 ms |

The alternative approach is **2.2x** (54.83%) faster in this measurement. On average, it was ~2x (51%) faster. Tested on an array of random strings with 5000000 elements.

### Additional performance improvements

Here are some additional points I integrated into my coding convention that I found to improve perfomance slightly (if applicable):

- Prefer JSON over XML
- Declare variables before, not in every iteration of the loop
- Avoid function calls in the loop header (in `for ($i=0; $i<count($array); $i)` the `count()` method gets called in every iteration)
- Unset memory consuming variables
- Prefer select statement over multiple if statements
- Prefer single quotes over double quotes (no parsing for in-quote variables if not needed)
- Prefer require/include over require_once/include_once (ensure proper opcode caching)

## Sources

- <https://gist.github.com/bsalim/4442047>
- <https://stackoverflow.com/questions/4195937/what-are-some-good-php-performance-tips>
