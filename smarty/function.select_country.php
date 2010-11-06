<?php /*
Copyright (c) 2010 Dave Miller

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
 * @author Dave Miller
 * @copyright Copyright (c) 2010 Dave Miller
 * @license http://www.dave-miller.com/mit-license MIT License
 */

require_once dirname(__FILE__) . '/../classes/djmCountries.php';

/**
 * Generate <select> and <option> tags for country pickers.
 * 
 * @param array Smarty parameters
 * - string <b>name</b> = null:
 *    The name of the <select> tag (default: no <select> tag is output).
 * - string <b>selected</b> = null:
 *    The value to mark as selected.
 * - array <b>data</b> = false:
 *    Any parameters passed from the controller as an array.
 * - string <b>assign</b> = null:
 *    The name of a variable to assign the output to. (default: output it}
 * - Any other parameters are used as attributes on the <select> tag (e.g. class="myclass").
 * @param Smarty The Smarty object.
 * @return string
 */
function smarty_function_select_country($params, &$smarty)
{
    $params['options'] = djmCountries::getList();
    
    // Convert country name to code
    if (!empty($params['selected']) && strlen($params['selected']) > 2) {
        $params['selected'] = djmCountries::countryToCode($params['selected']);
    }
    
    /**
     * @see function.options.php
     */
    require_once $smarty->_get_plugin_filepath('function', 'options');
    return smarty_function_options($params, $smarty);
}
