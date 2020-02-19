<?php

function getCities()
{
    return json_decode(file_get_contents(__DIR__ . '/cities.json'), true);
}

function getCityById($id)
{
    $cities = getCities();
    foreach ($cities as $city) {
        if ($city['id'] == $id) {
            return $city;
        }
    }
    return null;
}

function createCity($data)
{
    $cities = getCities();

    $data['id'] = rand(1000000, 2000000);
    $data['icon'] = addIcon($data['description']);
    $cities[] = $data;

    putJson($cities);

    return $data;
}

function updateCity($data, $id)
{
    $data['icon'] = addIcon($data['description']);
    $updatecity = [];
    $cities = getCities();
    foreach ($cities as $i => $city) {
        if ($city['id'] == $id) {
            $cities[$i] = $updateCity = array_merge($city, $data);
        }
    }

    putJson($cities);

    return $updateCity;
}

function deleteCity($id)
{
    $cities = getCities();

    foreach ($cities as $i => $city) {
        if ($city['id'] == $id) {
            array_splice($cities, $i, 1);
        }
    }

    putJson($cities);
}

function putJson($cities)
{
    file_put_contents(__DIR__ . '/cities.json', json_encode($cities, JSON_PRETTY_PRINT));
}

function validateCity($city, &$errors)
{
    $isValid = true;

    if (!$city['name']) {
        $isValid = false;
        $errors['name'] = 'Nazwa jest wymagana';
    }
    if (!$city['temperature'] || !filter_var($city['temperature'], FILTER_VALIDATE_FLOAT)) {
        $isValid = false;
        $errors['temperature'] = 'Temperatura musi być liczbą';
    }
    if (!$city['humidity'] || !filter_var($city['humidity'], FILTER_VALIDATE_INT)) {
        $isValid = false;
        $errors['humidity'] = 'Wilgotność musi być liczbą';
    }
    if (!$city['wind'] || !filter_var($city['wind'], FILTER_VALIDATE_FLOAT)) {
        $isValid = false;
        $errors['wind'] = 'Wiatr musi być liczbą';
    }
    if (!$city['description']) {
        $isValid = false;
        $errors['description'] = 'Opis jest wymagany';
    }

    return $isValid;
}

function addIcon($description)
{
    switch ($description) {
        case "bezchmurnie":
            return "01d";
        case "rozproszone chmury":
            return "02d";
        case "całkowite zachmurzenie":
            return "04d";
        case "deszcz":
            return "10d";
        case "ulewa":
            return "09d";
        case "śnieg":
            return "13d";
        case "mgła":
            return "50d";
        case "burza z piorunami":
            return "11d";
    }
}
