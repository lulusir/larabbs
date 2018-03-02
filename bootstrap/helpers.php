<?php
/**
 * 根据当前路由返回对应的样式类名
 * 
 * @example users.edit => user-edit
 * @return string
 */
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}