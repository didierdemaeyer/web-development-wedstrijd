<?php

/**
 * Flash message
 *
 * @param string $type
 * @param string $message
 * @return mixed
 */
function showMessage($type, $message) {
    $data = [
        'type' => $type,
        'messages' => array(
            $message,
        ),
    ];

    return session()->flash('data', $data);
}

/**
 * Flash messages
 *
 * @param string $type
 * @param array $messages
 * @return mixed
 */
function showMessages($type, $messages) {
    $data = [
        'type' => $type,
        'messages' => $messages,
    ];

    return session()->flash('data', $data);
}

/**
 * Flash error messages
 *
 * @param $messages
 * @return mixed
 */
function showErrors($messages) {
    $data = [
        'type' => 'error',
        'messages' => $messages,
    ];

    return session()->flash('data', $data);
}

/**
 * Flash success messages
 *
 * @param $messages
 * @return mixed
 */
function showSuccess($messages) {
    $data = [
        'type' => 'success',
        'messages' => $messages,
    ];

    return session()->flash('data', $data);
}

/**
 * Flash info messages
 *
 * @param $messages
 * @return mixed
 */
function showInfo($messages) {
    $data = [
        'type' => 'info',
        'messages' => $messages,
    ];

    return session()->flash('data', $data);
}