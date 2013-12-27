<?php
/**
 * Smarty plugin to make use of the Laravel translator
 */

/**
 * Smarty {t}{/t} block plugin
 *
 * Type:     block function<br>
 * Name:     t<br>
 * Purpose:  provides access to Laravel's translator<br>
 * Params:
 * <pre>
 * - _count         - used for pluralization
 * </pre>
 * All other params are passed to Laravel's translator as replacements
 *
 * @param array                    $params   parameters
 * @param string                   $content  contents of the block
 * @param Smarty_Internal_Template $template template object
 * @param boolean                  &$repeat  repeat flag
 * @return string content translated
 * @author Jakob Gahde <j5lx@fmail.co.uk>
 */
function smarty_block_t($params, $content, $template, &$repeat)
{
    if (is_null($content)) {
        return;
    }

    if (array_key_exists('_count', $params)) {
        $count = $params['_count'];
        unset($params['_count']);

        $translated = Lang::choice($content, $count, $params);
    } else {
        $translated = Lang::get($content, $params);
    }

    return $translated;
}
