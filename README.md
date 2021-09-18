# Capitalizer

A package for intelligent string capitalization.

PHP includes the `ucwords` function for capitalizing words in strings, but it's pretty dumb.

Consider the following names:

```
Nigel de Jong
Rajiv van La Parra
Malcolm McDonald
```

...or the following titles:

```
To Be or Not to Be
The Wizard of Oz
Gone With the Wind
```

...or the following places:

```
Newton on the Willow
Stoke on Trent
Stoke D'Abernon
```

This library is designed to properly handle cases like this.

## Usage

Create an instance with no arguments:

```php
use AgentSoftware\Capitalizer\Capitalizer;
$capitalizer = new Capitalizer( );
```

The method provides four methods for capitalization:

### `title()`

e.g. the title of a book, film, etc.

```php
print $capitalizer->title( 'to be or not to be' ) ); // prints To Be or Not to Be
```

### `name()`

The name of a person

```php
print $capitalizer->name( 'RAJIV VAN LA PARRA' ) ); // prints Rajiv van La Parra
```


### `place()`

The name of a place.

```php
print $capitalizer->place( 'STOKE ON TRENT' ) ); // prints Stoke on Trent
```

### `string()`

A generic string

```php
print $capitalizer->title( 'this is a string ) ); // prints This is a String
```

## Customizing Behaviour

You can customise the behaviour of the library using one or more of the following methods:

```php
$capitalizer = new Capitalizer( );

$capitalizer->addLowercase( 'con' ); // e.g. Chilli con Carne

$capitalizer->addUppercase( 'php' ); // good for acronyms

$capitalizer->addLowercaseName( 'of' ); // only applies to names; e.g. Jesus of Nazareth

$capitalizer->addPrefix( 'Mc' );

$capitalizer->addSuffix( '\'s' );
```

Note that all of them return the current instance (i.e. a fluent interface), so they can be chained together, for example:

```php
$capitalizer = new Capitalizer( );

$capitalizer->addLowercase( 'con' )
    ->addUppercase( 'php' )
    ->addLowercaseName( 'of' )
    ->addPrefix( 'Mc' )
    ->addSuffix( '\'s' );
```


Refer to the source code for more explanation of these methods.