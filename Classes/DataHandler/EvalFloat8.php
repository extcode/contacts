<?php

namespace Extcode\Contacts\DataHandler;

/*
 * This file is part of the package extcode/contacts.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

class EvalFloat8
{

    /**
     * JavaScript code for client side validation/evaluation
     */
    public function returnFieldJS(): string
    {
        return 'return +(Math.round(value + "e+8") + "e-8");';
    }

    /**
     * Server-side validation/evaluation on saving the record
     */
    public function evaluateFieldValue(string $value, string $is_in, bool &$set): string
    {
        $value = preg_replace('/[^0-9,\\.-]/', '', $value);
        $negative = $value[0] === '-';
        $value = strtr($value, [',' => '.', '-' => '']);
        if (strpos($value, '.') === false) {
            $value .= '.0';
        }
        $valueArray = explode('.', $value);
        $dec = array_pop($valueArray);
        $value = implode('', $valueArray) . '.' . $dec;
        if ($negative) {
            $value *= -1;
        }
        $value = number_format($value, 8, '.', '');

        return $value;
    }
}
