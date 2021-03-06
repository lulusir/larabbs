<?php

/**
 * 此方法会将当前请求的路由名称转换为 CSS 类名称，
 * 作用是允许我们针对某个页面做页面样式定制。在后面的章节中会用到。
 *
 * @return string
 */
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

/**
 * 根据输入内容返回摘要，默认限制长度200
 *
 * @param string value
 * @param number length
 *
 * @return string
 */
function make_excerpt($value, $length = 200)
{
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
    return str_limit($excerpt, $length);
}
