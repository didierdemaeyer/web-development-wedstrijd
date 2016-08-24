<?php

/**
 * @return array|mixed|string
 */
function getClientIpAddress() {
    $ipAddress = $_SERVER['REMOTE_ADDR'];
    if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
        $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    return $ipAddress;
}