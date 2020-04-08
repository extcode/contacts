<?php

namespace Extcode\Contacts\DataHandler;

/*
 * This file is part of the package extcode/cart.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

/**
 * Class for field value validation/evaluation to be used in 'eval' of TCA
 */
class EvalFloat8
{

    /**
     * JavaScript code for client side validation/evaluation
     *
     * @return string JavaScript code for client side validation/evaluation
     */
    public function returnFieldJS()
    {
        return 'return +(Math.round(value + "e+8") + "e-8");';
    }

    /**
     * Server-side validation/evaluation on saving the record
     *
     * @param string $value The field value to be evaluated
     * @param string $is_in The "is_in" value of the field configuration from TCA
     * @param bool $set Boolean defining if the value is written to the database or not.
     * @return string Evaluated field value
     */
    public function evaluateFieldValue($value, $is_in, &$set)
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
