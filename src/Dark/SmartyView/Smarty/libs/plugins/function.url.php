<?php
/**
 * Smarty plugin to make use of Laravel's URL helper functions
 */

/**
 * Smarty {url} plugin
 *
 * Type:     function<br>
 * Name:     url<br>
 * Purpose:  access Laravel's URL helper functions
 *
 * @author Jakob Gahde <j5lx@fmail.co.uk>
 * @param array                    $params   parameters
 * @param Smarty_Internal_Template $template template object
 * @return string|null if the assign parameter is passed, Smarty assigns the result to a template variable
 */
function smarty_function_url($params, $template)
{

    $targetTypes = array('action', 'asset', 'route', 'url');
    $functionName = null;
    $target = null;
    foreach ($targetTypes as $targetType) {
        if (!is_null($params[$targetType])) {
            $functionName = $targetType;
            $target = $params[$targetType];
            unset($params[$targetType]);
            break;
        }
    }

    if (is_null($functionName)) {
        throw new SmartyException("{url} needs exactly one of the following params: " . implode(', ', $targetTypes));
    }

    if ($functionName == 'asset') {
        $secure = array_get($params, 'secure', null);
        unset($params['secure']);

        $value = asset($target, $secure);
    } elseif ($functionName == 'url') {
        $secure = array_get($params, 'secure', null);
        unset($params['secure']);

        $value = url($target, $params, $secure);
    } else {
        $value = $functionName($target, $params);
    }

    if (!empty($params['assign'])) {
        $template->assign($params['assign'], $value);
    } else {
        return $value;
    }
}
