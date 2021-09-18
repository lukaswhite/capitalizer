<?php

use Lukaswhite\Capitalizer\Capitalizer;

/**
 * Tests the Capitalizer feature
 */
class CapitalizerTest extends \PHPUnit\Framework\TestCase {

  public function test_no_syntax_errors( )
  {
      $var = new Capitalizer( );
      $this->assertTrue( is_object( $var ) );
      unset( $var );
  }

  public function test_can_capitalize_titles( )
  {
      $capitalizer = new Capitalizer( );

      $this->assertTrue( method_exists( $capitalizer, 'title' ) );
      $this->assertTrue( is_string( $capitalizer->title( 'a string' ) ) );

      $this->assertEquals( 'Gladiator', $capitalizer->title( 'gladiator' ) );
      $this->assertEquals( 'Gladiator', $capitalizer->title( 'GLADIATOR' ) );
      $this->assertEquals( 'Gladiator', $capitalizer->title( 'gLADiAtoR' ) );

      $this->assertEquals( 'Gone With the Wind', $capitalizer->title( 'gone with the wind' ) );
      $this->assertEquals( 'Gone With the Wind', $capitalizer->title( 'GONE WITH THE WIND' ) );
      $this->assertEquals( 'Gone With the Wind', $capitalizer->title( 'Gone With The Wind' ) );

      $this->assertEquals( 'To Be or Not to Be', $capitalizer->title( 'to be or not to be' ) );
      $this->assertEquals( 'To Be or Not to Be', $capitalizer->title( 'TO BE OR NOT TO BE' ) );

      $this->assertEquals( 'The Wizard of Oz', $capitalizer->title( 'the wizard of oz' ) );
      $this->assertEquals( 'The Wizard of Oz', $capitalizer->title( 'THE WIZARD OF OZ' ) );
      $this->assertEquals( 'The Wizard of Oz', $capitalizer->title( 'The WizArd of Oz' ) );
      $this->assertEquals( 'The Wizard of Oz', $capitalizer->title( 'The Wizard of Oz' ) );

  }

  public function test_can_capitalize_names( )
  {
      $capitalizer = new Capitalizer( );

      $this->assertTrue( method_exists( $capitalizer, 'name' ) );
      $this->assertTrue( is_string( $capitalizer->name( 'a string' ) ) );

      $this->assertEquals( 'John Smith', $capitalizer->name( 'john smith' ) );
      $this->assertEquals( 'John Smith', $capitalizer->name( 'JOHN SMITH' ) );

      //$this->assertEquals( "Baba o'Reilly", $capitalizer->name( "baba o'reilly" ) );
      //$this->assertEquals( "Baba o'Reilly", $capitalizer->name( "BABA O'REILLY" ) );

      $this->assertEquals( 'Nigel de Jong', $capitalizer->name( 'nigel de jong' ) );
      $this->assertEquals( 'Nigel de Jong', $capitalizer->name( 'Nigel De Jong' ) );
      $this->assertEquals( 'Nigel de Jong', $capitalizer->name( 'NIGEL DE JONG' ) );

      $this->assertEquals( 'Rajiv van La Parra', $capitalizer->name( 'rajiv van la parra' ) );

      $this->assertEquals( 'Malcolm McDonald', $capitalizer->name( 'malcolm mcdonald' ) );
  }

  public function test_can_capitalize_places( )
  {
      $capitalizer = new Capitalizer( );

      $this->assertTrue( method_exists( $capitalizer, 'place' ) );
      $this->assertTrue( is_string( $capitalizer->place( 'a string' ) ) );

      $this->assertEquals( 'London', $capitalizer->place( 'london' ) );
      $this->assertEquals( 'London', $capitalizer->place( 'LONDON' ) );

      $this->assertEquals( 'Newton on the Moor', $capitalizer->place( 'newton on the moor' ) );
      $this->assertEquals( 'Newton on the Moor', $capitalizer->place( 'NEWTON ON THE MOOR' ) );

      $this->assertEquals( 'Stoke on Trent', $capitalizer->place( 'stoke on trent' ) );
      $this->assertEquals( 'Stoke on Trent', $capitalizer->place( 'STOKE ON TRENT' ) );

      $this->assertEquals( "Stoke D'Abernon", $capitalizer->place( "stoke d'abernon" ) );
      $this->assertEquals( "Stoke D'Abernon", $capitalizer->place( "STOKE D'ABERNON" ) );

      $this->assertEquals( 'Bury St. Edmunds', $capitalizer->place( 'bury st. edmunds' ) );
      $this->assertEquals( 'Bury St. Edmunds', $capitalizer->place( 'BURY ST. EDMUNDS' ) );

      $this->assertEquals( 'Newcastle upon Tyne', $capitalizer->place( 'newcastle upon tyne' ) );
      $this->assertEquals( 'Newcastle upon Tyne', $capitalizer->place( 'NEWCASTLE UPON TYNE' ) );

      $this->assertEquals( 'Southend on Sea', $capitalizer->place( 'southend on sea' ) );
      $this->assertEquals( 'Southend on Sea', $capitalizer->place( 'SOUTHEND ON SEA' ) );

      $this->assertEquals( 'Somewhere by the Sea', $capitalizer->place( 'somewhere by the sea' ) );
      $this->assertEquals( 'Somewhere by the Sea', $capitalizer->place( 'SOMEWHERE BY THE SEA' ) );

      $this->assertEquals( 'Ysbyty Ystwyth', $capitalizer->place( 'ysbyty ystwyth' ) );

      $this->assertEquals( 'Newcastle under Lyme', $capitalizer->place( 'newcastle under lyme' ) );
      $this->assertEquals( 'Newcastle under Lyme', $capitalizer->place( 'Newcastle Under Lyme' ) );

      $this->assertEquals( 'Kdhgsdgsdg on a Kuidhsg', $capitalizer->place( 'kdhgsdgsdg on a kuidhsg' ) );

      $this->assertEquals( 'Newton-le-Willows', $capitalizer->place( 'newton-le-willows' ) );

      $this->assertEquals( 'Stoke-on-Trent', $capitalizer->place( 'stoke-on-trent' ) );

      $this->assertEquals( 'Walton-on-Thames', $capitalizer->place( 'walton-on-thames' ) );

      $this->assertEquals( 'Stratford-upon-Avon', $capitalizer->place( 'stratford-upon-avon' ) );

      $this->assertEquals( 'Henley-in-Arden', $capitalizer->place( 'henley-in-arden' ) );

      $this->assertEquals( 'Westbury-on-Severn', $capitalizer->place( 'westbury-on-severn' ) );

      $this->assertEquals( 'Westcliff-on-Sea', $capitalizer->place( 'westcliff-on-sea' ) );

      $this->assertEquals( 'Leigh-on-Sea', $capitalizer->place( 'leigh-on-sea' ) );

      $this->assertEquals( 'Houghton-le-Spring', $capitalizer->place( 'houghton-le-spring' ) );

  }

    public function test_can_capitalize_generic_strings( )
    {
        $capitalizer = new Capitalizer( );

        $this->assertTrue( method_exists( $capitalizer, 'string' ) );
        $this->assertTrue( is_string( $capitalizer->string( 'a string' ) ) );

        $this->assertEquals( 'This is a String', $capitalizer->string( 'this is a string' ) );
        $this->assertEquals( 'This is a String', $capitalizer->string( 'THIS IS A STRING' ) );
    }

    public function test_can_add_additional_uppercase_strings( )
    {
        $capitalizer = new Capitalizer( );
        $this->assertInstanceOf( Capitalizer::class, $capitalizer->addUppercase( 'Php' ) );
        $this->assertEquals( 'A Book About PHP', $capitalizer->title( 'a book about php' ) );
        $capitalizer->addUppercase( 'Php' );

        unset( $capitalizer );

        $capitalizer = new Capitalizer( );
        $this->assertInstanceOf( Capitalizer::class, $capitalizer->addUppercase( 'php' ) );
        $this->assertEquals( 'A Book About PHP', $capitalizer->title( 'a book about php' ) );
        $capitalizer->addUppercase( 'Php' );
    }

    public function test_can_add_additional_lowercase_strings( )
    {
        $capitalizer = new Capitalizer( );
        $this->assertInstanceOf( Capitalizer::class, $capitalizer->addLowercase( 'Con' ) );
        $this->assertEquals( 'Chilli con Carne', $capitalizer->string( 'chilli con carne' ) );
        $capitalizer->addLowercase( 'Con' );

        unset( $capitalizer );

        $capitalizer = new Capitalizer( );
        $this->assertInstanceOf( Capitalizer::class, $capitalizer->addLowercase( 'con' ) );
        $this->assertEquals( 'Chilli con Carne', $capitalizer->string( 'chilli con carne' ) );
        $capitalizer->addLowercase( 'con' );
    }

    public function test_can_add_additional_lowercase_strings_in_names( )
    {
        $capitalizer = new Capitalizer( );
        $this->assertInstanceOf( Capitalizer::class, $capitalizer->addLowercaseName( 'Of' ) );
        $this->assertEquals( 'Jesus of Nazareth', $capitalizer->string( 'jesus of nazareth' ) );
        $capitalizer->addLowercaseName( 'Of' );

        unset( $capitalizer );

        $capitalizer = new Capitalizer( );
        $this->assertInstanceOf( Capitalizer::class, $capitalizer->addLowercaseName( 'of' ) );
        $this->assertEquals( 'Jesus of Nazareth', $capitalizer->string( 'jesus of nazareth' ) );
        $capitalizer->addLowercaseName( 'of' );
    }

    public function test_can_add_additional_prefixes( )
    {
        $capitalizer = new Capitalizer( );
        $this->assertInstanceOf( Capitalizer::class, $capitalizer->addPrefix( 'La' ) );
        $this->assertEquals( 'Pierre La Monde', $capitalizer->name( 'pierre la monde' ) );
        // The above is a bad example - what happens to Lamont, Lambert etc?
        $capitalizer->addPrefix( 'La' );

        unset( $capitalizer );

        $capitalizer = new Capitalizer( );
        $this->assertInstanceOf( Capitalizer::class, $capitalizer->addPrefix( 'la' ) );
        $this->assertEquals( 'Pierre La Monde', $capitalizer->name( 'pierre la monde' ) );
        $capitalizer->addPrefix( 'la' );

        unset( $capitalizer );

        $capitalizer = new Capitalizer( );
        $this->assertInstanceOf( Capitalizer::class, $capitalizer->addPrefix( 'la' ) );
        $this->assertEquals( 'St Georges', $capitalizer->name( 'st georges' ) );
        $capitalizer->addPrefix( 'st' );
    }

    public function test_can_add_additional_suffixes( )
    {
        // Can't think of any use cases...
        $capitalizer = new Capitalizer( );
        $this->assertInstanceOf( Capitalizer::class, $capitalizer->addSuffix( "'s" ) );
        $this->assertInstanceOf( Capitalizer::class, $capitalizer->addSuffix( "'x" ) );
    }

}
