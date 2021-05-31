<?php

namespace Rutatiina\Banking\Classes;

use PragmaRX\Countries\Package\Countries;
use Rutatiina\Banking\Models\Bank;
use Maatwebsite\Excel\Concerns\ToModel;

class BanksImport implements ToModel
{
    public function model(array $row)
    {
        if (!isset($row[0]) || empty($row[0])) {
            return null;
        }

        if ($row[0] == '[country]') {
            return null;
        }

        //generate the type
        $explode = explode('(', $row[1]);
        $type = end($explode);
        $type = str_ireplace(')', '', $type);

        $name = str_ireplace('('.$type.')', '', $row[1]);

        $string = htmlentities($row[0], null, 'utf-8');
        $country = str_replace("&nbsp;", "", $string);
        $country = html_entity_decode($country);

        $name = htmlentities($name, null, 'utf-8');
        $name = str_replace("&nbsp;", "", $name);
        $name = html_entity_decode($name);

        // TODO: Implement model() method.
        return new Bank([
            'country' => trim($country),
            'name' => trim($name),
            'type' => trim($type),
        ]);
    }
}
