<?php namespace Lukaswhite\Capitalizer;

/**
 * Class Capitalizer
 *
 * @package Lukaswhite\Capitalizer
 */
class Capitalizer
{
    /**
     * Words that should be all lowercase (provided they are not the first word in the string)
     *
     * @var array
     */
    protected $lowercase;

    /**
     * Words that should always be capitalized; e.g. acronyms
     *
     * @var array
     */
    protected $uppercase;

    /**
     * Words that should be all uppercase, when used in a person's name
     *
     * @var array
     */
    protected $uppercaseName;

    /**
     * Words that should be all lowercase, when used in a person's name (provided they are
     * not the person's forename)
     *
     * @var array
     */
    protected $lowercaseName;

    /**
     * Prefixes; words straight after these should be capitalized (e.g. McDonald)
     *
     * @var array
     */
    protected $prefixes;

    /**
     * Suffixes; these should be decapitalized
     *
     * @var array
     */
    protected $suffixes;

    /**
     * Capitalizer constructor.
     */
    public function __construct()
    {
        $this->uppercase =['Po', 'Rr', 'Se', 'Sw', 'Ne', 'Nw' , 'St '];
        $this->lowercase =['A', 'An', 'And', 'As', 'By', 'In', 'Of', 'Or', 'To', 'The', 'On', 'Is', 'Under', 'Upon', 'Le'];

        $this->uppercaseName =[];
        $this->lowercaseName =['De', 'De La', 'De Las', 'Der', 'Van', 'Van De', 'Van Der', 'Vit De', 'Von', 'Or', 'And'];

        $this->prefixes =['Mc', 'St '];
        $this->suffixes =["'s"];
    }

    /**
     * Capitalize a title
     *
     * @param string $str
     * @return string
     */
    public function title($str): string
    {
        return $this->string($str);
    }

    /**
     * Capitalize a name
     *
     * @param string $str
     * @return string
     */
    public function name($str): string
    {
        return $this->smartUcwords($str, true);
    }

    /**
     * Capitalize a place
     *
     * @param string $str
     * @return string
     */
    public function place($str): string
    {
        return $this->string($str);
    }

    /**
     * Capitalize a string
     *
     * @param string $str
     * @return string
     */
    public function string($str): string
    {
        return $this->smartUcwords($str);
    }

    /**
     * Add a word that should be all uppercase; for example an acronym
     *
     * @param string $word
     * @return self
     */
    public function addUppercase($word): self
    {
        $word = ucfirst($word);
        if (! in_array($word, $this->uppercase)) {
            $this->uppercase[] = $word;
        }
        return $this;
    }

    /**
     * Add a word that should be all lowercase
     *
     * @param string $word
     * @return self
     */
    public function addLowercase($word): self
    {
        $word = ucfirst($word);
        if (! in_array($word, $this->lowercase)) {
            $this->lowercase[] = $word;
        }
        return $this;
    }

    /**
     * Add a word that should be all uppercase in a person's name
     *
     * (Probably not a use case for this?)
     *
     * @param string $word
     * @return self
     * @codeCoverageIgnore
     */
    public function addUppercaseName($word): string
    {
        $word = ucfirst($word);
        if (! in_array($word, $this->uppercaseName)) {
            $this->uppercaseName[] = $word;
        }
        return $this;
    }

    /**
     * Add a word that should be all lowercase, in a person's name
     *
     * @param string $word
     * @return self
     */
    public function addLowercaseName($word): self
    {
        $word = ucfirst($word);
        if (! in_array($word, $this->lowercaseName)) {
            $this->lowercaseName[] = $word;
        }
        return $this;
    }

    /**
     * Add a prefix
     *
     * @param string $word
     * @return self
     */
    public function addPrefix($word): self
    {
        $word = ucfirst($word);
        if (! in_array($word, $this->prefixes)) {
            $this->prefixes[] = $word;
        }
        return $this;
    }

    /**
     * Add a suffix
     *
     * @param string $word
     * @return self
     */
    public function addSuffix($word): self
    {
        if (! in_array($word, $this->suffixes)) {
            $this->suffixes[] = $word;
        }
        return $this;
    }

    /**
     * This is where the magic happens
     *
     * @param string $str
     * @param bool $isName Whether this is a person's name or not
     * @return string
     */
    public function smartUcwords($str, $isName = false): string
    {
        if ($isName) {
            $lowercase = $this->lowercaseName;
            $uppercase = $this->uppercaseName;
        } else {
            $lowercase = $this->lowercase;
            $uppercase = $this->uppercase;
        }

        // First pass; captialize all first letters
        $str = preg_replace_callback(
            "/\\b(\\w)/",
            function($matches) {
                return strtoupper($matches[ 1]);
            },
            strtolower(trim($str))
       );

        if (count($uppercase)) {
            // capitalize acronymns and initialisms e.g. PHP
            $uppercaseValues = implode('|', $uppercase);
            $str = preg_replace_callback(
                "/\\b($uppercaseValues)\\b/",
                function($matches) {
                    return strtoupper($matches[ 1]);
                },
                $str
           );
        }
        if (count($lowercase)) {
            $lowercaseValues = implode('|', $lowercase);
            // decapitalize short words e.g. and, of, on, the
            if ($isName) {
                // All occurences will be changed to lowercase
                $str = preg_replace_callback(
                    "/\\b($lowercaseValues)\\b/",
                    function($matches) {
                        return strtolower($matches[ 1]);
                    },
                    $str
               );
            } else {
                // First and last word will not be changed to lower case (i.e. titles)
                $str = preg_replace_callback(
                    "/(?<=\\W)($lowercaseValues)(?=\\W)/",
                    function($matches) {
                        return strtolower($matches[ 1]);
                    },
                    $str
               );
            }
        }
        if (count($this->prefixes)) {
            // Capitalize letter after certain name prefixes e.g 'Mc'
            $prefixesValues = implode('|', $this->prefixes);
            $str = preg_replace_callback(
                "/\\b($prefixesValues)(\\w)/",
                function($matches) {
                    return sprintf('%s%s', $matches[ 1], strtoupper($matches[ 2]));
                },
                $str
           );
        }
        if (count($this->suffixes)) {
            // decapitalize certain word suffixes e.g. 's
            $suffixesValues = implode('|', $this->suffixes);
            $str = preg_replace_callback(
                "/(\\w)($suffixesValues)\\b/",
                function($matches) {
                    return sprintf('%s%s', $matches[ 1], strtolower($matches[ 2]));
                },
                $str
           );
        }
        return $str;
    }

}
