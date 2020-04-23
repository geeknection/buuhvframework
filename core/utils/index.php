<?php
/**
 * Utils - BuuhV Framework.
 * PHP Version 7.4.
 *
 * @see https://github.com/geeknection/buuhvframework The BuuhVFramework GitHub project
 *
 * @author    Bruno Nascimento (original founder)
 */

/**
 * Create new file
 * @return void
 */
function createFile($file = '', $content = '')
{
    if (empty($file)) return false;

    fopen($file, 'w');
    $file = $content;
    fclose($file);
}
/**
 * Find index as findIndex javascript
 * @param array $items array
 * @param string $label to compare
 * @param string $value to compare
 * @return number
 */
function findIndex($items, $label, $value)
{
    if (!is_array($items))
    {
        throw new Exception("Items is not array");
    }
    $found = false;
    $indexOf = -1;
    foreach ($items as $key => $item) {
        if ($found === true) break;
        if ($item[$label] === $value)
        {
            $found = true;
            $indexOf = $key;
        }
    }

    return $indexOf;
}