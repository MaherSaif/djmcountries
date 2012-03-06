<?php /*
Copyright (c) 2010-2012 Dave James Miller

Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in
the Software without restriction, including without limitation the rights to
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
the Software, and to permit persons to whom the Software is furnished to do so,
subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. */

/**
 * @author Dave James Miller
 * @copyright Copyright (c) 2010-2012 Dave James Miller
 * @license http://davejamesmiller.com/mit-license MIT License
 */

class djmCountries
{

    public static function getNameToCodeList()
    {
        return require dirname(__FILE__) . '/../data/name-to-code.php';
    }

    public static function getCodeToNameList()
    {
        return require dirname(__FILE__) . '/../data/code-to-name.php';
    }

    public static function getList()
    {
        return self::getCodeToNameList();
    }

    public static function codeToName($code)
    {
        $list = self::getCodeToNameList();
        $code = strtoupper($code);
        if (isset($list[$code])) {
            return $list[$code];
        } else {
            return null;
        }
    }

    /**
     * @deprecated
     */
    public static function codeToCountry($code)
    {
        return self::codeToName($code);
    }

    public static function nameToCode($name)
    {
        $name = strtolower($name);
        $list = self::getNameToCodeList();
        if (isset($list[$name])) {
            return $list[$name];
        } else {
            return null;
        }
    }

    /**
     * @deprecated
     */
    public static function countryToCode($name)
    {
        return self::nameToCode($name);
    }

    public static function isValidCode($code)
    {
        return (bool) self::codeToName($code);
    }

    public static function isValidName($name)
    {
        return (bool) self::nameToCode($name);
    }

    public static function isValid($value)
    {
        return (self::isValidCode($value) || self::isValidName($value));
    }

    public static function canonicalName($name)
    {
        $code = self::nameToCode($name);
        if ($code) {
            return self::codeToName($name);
        } else {
            return null;
        }
    }

    public static function toCode($value)
    {
        if (self::isValidCode($value)) {
            return strtoupper($value);
        } else {
            return self::nameToCode($value);
        }
    }

    public static function toName($value)
    {
        if (self::isValidCode($value)) {
            return self::codeToName($value);
        } else {
            return self::canonicalName($value);
        }
    }

}
