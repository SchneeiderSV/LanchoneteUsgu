<?php

function validate($data, $type) {
    switch ($type) {
        case 'string':
            return is_string($data) && trim($data) !== '';
        case 'email':
            return filter_var($data, FILTER_VALIDATE_EMAIL) !== false;
        case 'int':
            return filter_var($data, FILTER_VALIDATE_INT) !== false;
        case 'float':
            return filter_var($data, FILTER_VALIDATE_FLOAT) !== false;
        case 'img':
            if (isset($data['tmp_name']) && is_uploaded_file($data['tmp_name'])) {
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                $fileExtension = strtolower(pathinfo($data['name'], PATHINFO_EXTENSION));
                $isValidExtension = in_array($fileExtension, $allowedExtensions);
                $isValidSize = $data['size'] <= 5 * 1024 * 1024; // 5MB

                return $isValidExtension && $isValidSize;
            }
            return false;
        default:
            return false; // Invalid type
    }
}

?>