<?php

// //////////////////////////////
// [1] FORM VALIDATORS
// //////////////////////////////

/**
 * Check if field values are the same
 *
 * @param $form_values
 * @param array $form
 * @param array $params
 * @return bool
 */
function validate_fields_match($form_values, array &$form, array $params): bool
{
    foreach ($params as $field_index) {
        if ($form_values[$params[0]] !== $form_values[$field_index]) {
            $form['fields'][$field_index]['error'] = strtr('Field does not match with @field field', [
                '@field' => $form['fields'][$params[0]]['label']
            ]);

            return false;
        }
    }

    return true;
}

// //////////////////////////////
// [2] FIELD VALIDATORS
// //////////////////////////////

/**
 * Check if field is not empty
 *
 * @param string $field_value
 * @param array $field
 * @return bool
 */
function validate_field_not_empty(string $field_value, array &$field): bool
{

    if ($field_value == '') {
        $field['error'] = 'Laukelis privalo būti užpildytas';
        return false;
    }

    return true;
}

/**
 * Chef if field contains space
 *
 * @param string $field_value
 * @param array $field
 * @return bool
 */
function validate_field_contains_space(string $field_value, array &$field): bool
{
    if (str_word_count(trim($field_value)) < 2) {
        $field['error'] = 'Field must contain space';
        return false;
    }

    return true;
}

/**
 * Chef if number is within the min and max range.
 *
 * @param string $field_value
 * @param array $field
 * @param array $params
 * @return bool
 */
function validate_field_range(string $field_value, array &$field, array $params): bool
{
    if ($field_value < $params['min'] || $field_value > $params['max']) {
        $field['error'] = strtr('Insert a number between @min - @max!', [
            '@min' => $params['min'],
            '@max' => $params['max']
        ]);

        return false;
    }

    return true;
}

/**
 * Check if input is numeric
 *
 * @param string $field_value
 * @param array $field
 * @return bool
 */
function validate_numeric(string $field_value, array &$field): bool
{
    if (!is_numeric($field_value)) {
        $field['error'] = 'Field input must be numeric';

        return false;
    };

    return true;
}


/**
 * Check if provided email is in correct format
 *
 * @param string $field_value
 * @param array $field
 * @return bool
 */
function validate_email(string $field_value, array &$field): bool
{
    if (!preg_match('/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/', $field_value)) {
        $field['error'] = 'Netaisyklingas el. paštas';

        return false;
    }

    return true;
}


/**
 * Check if comment isn't longer than 500 symbols
 *
 * @param string $field_value
 * @param array $field
 * @return bool
 */
function validate_comments_length(string $field_value, array &$field): bool
{
    if (strlen($field_value) > 500) {
        $field['error'] = 'Komentaras negali sudaryti daugiau negu 500 simbolių';

        return false;
    };

    return true;
}


/**
 * Checks if new password is safe enough
 *
 * @param string $field_value
 * @param array $field
 * @return bool
 */
function validate_strong_password(string $field_value, array &$field): bool
{
    $uppercase = preg_match('@[A-Z]@', $field_value);
    $lowercase = preg_match('@[a-z]@', $field_value);
    $number = preg_match('@[0-9]@', $field_value);
    $specialChars = preg_match('@[^\w]@', $field_value);

    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($field_value) < 8) {
        $field['error'] = 'Slaptažodį turi sudaryti bent 8 simboliai, tarp kurių būtų didžiosios ir mažosios raidės, skaičiai, ženklai';

        return false;
    }

    return true;
}

/**
 * Checks if word contains only letters
 *
 * @param string $field_value
 * @param array $field
 * @return bool
 */
function validate_real_name(string $field_value, array &$field): bool
{
    if(!ctype_alpha($field_value)) {
        $field['error'] = 'Galima įrašyti tik raides';

        return false;
    }

    return true;
}

/**
 * Checks if word is not longer than 40 characters
 *
 * @param string $field_value
 * @param array $field
 * @return bool
 */
function validate_short_name(string $field_value, array &$field): bool
{
    if(strlen($field_value) > 40) {
        $field['error'] = 'Žodžio negali sudaryti daugiau negu 40 žanklų';

        return false;
    }

    return true;
}

/**
 * Checks if phone number is written properly
 *
 * @param string $field_value
 * @param array $field
 * @return bool
 */
function validate_phone_number(string $field_value, array &$field): bool
{

    $number = preg_match('@[0-9]@', $field_value);

    if(!$number || strlen($field_value) !== 9) {
        $field['error'] = 'Neteisingas telefono numeris';

        return false;
    }

    return true;
}