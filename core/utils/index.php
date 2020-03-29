<?php
/**
 * Cria um novo arquivo
 * @param file - Precisa conter o path e o nome do arquivo
 * @return void
 */
function createFile($file = '')
{
    if (empty($file)) return false;

    fopen($file, 'w');
}
/**
 * Procura pelo indice de um array
 * @return boolean
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