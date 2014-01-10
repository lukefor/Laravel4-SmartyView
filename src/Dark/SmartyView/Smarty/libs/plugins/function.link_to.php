<?php
/**
 * Smarty plugin to make use of Laravel's link_to helper functions
 */

/**
 * Smarty {link_to} plugin
 *
 * Type:     function<br>
 * Name:     link_to<br>
 * Purpose:  access Laravel's link_to helper functions
 *
 * @author Jakob Gahde <j5lx@fmail.co.uk>
 * @param array                    $params   parameters
 * @param Smarty_Internal_Template $template template object
 * @return string|null if the assign parameter is passed, Smarty assigns the result to a template variable
 */
function smarty_function_link_to($params, $template)
{

    $title = array_get($params, '_title', null);
    unset($params['_title']);

    $targetTypes = array('action', 'asset', 'route', 'url');
    $functionName = null;
    $target = null;
    foreach ($targetTypes as $targetType) {
        if (!is_null($params[$targetType])) {
            $functionName = 'link_to_' . $targetType;
            $target = $params[$targetType];
            unset($params[$targetType]);
            break;
        }
    }

    if (is_null($functionName)) {
        throw new SmartyException("{link_to} needs exactly one of the following params: " . implode(', ', $targetTypes));
    }

    if ($functionName == 'link_to_url') {
        $functionName = 'link_to';
    }

    if ($functionName == 'link_to_asset' || $functionName == 'link_to') {
        $secure = array_get($params, 'secure', null);
        unset($params['secure']);

        $value = $functionName($target, $title, $params, $secure);
    } else {
        $parameters = $attributes = array();
        foreach ($params as $key => $value) {
            if (starts_with($key, 'param_')) {
                $key = ltrim($key, 'param_');
                $parameters[$key] = $value;
            }
            if (starts_with($key, 'attrib_')) {
                $key = ltrim($key, 'attrib_');
                $attributes[$key] = $value;
            }
        }

        $value = $functionName($target, $title, $parameters, $attributes);
    }

    if (!empty($params['assign'])) {
        $template->assign($params['assign'], $value);
    } else {
        return $value;
    }
}
