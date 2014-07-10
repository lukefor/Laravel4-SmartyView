<?php
/**
 * Smarty plugin to get Laravel configuration values
 */

/**
 * Smarty {config} plugin
 *
 * Type:     function<br>
 * Name:     config<br>
 * Purpose:  get Laravel configuration values
 *
 * @author Jakob Gahde <j5lx@fmail.co.uk>
 * @param array                    $params   parameters
 * @param Smarty_Internal_Template $template template object
 * @return string|null if the assign parameter is passed, Smarty assigns the result to a template variable
 */
function smarty_function_config($params, $template)
{
    if (is_null($params['key'])) {
        return;
    }

    if (!is_null($params['default'])) {
        $value = Config::get($params['key'], $params['default']);
    } else {
        $value = Config::get($params['key']);
    }

    if (!empty($params['assign'])) {
        $template->assign($params['assign'], $value);
    } else {
        return $value;
    }
}
