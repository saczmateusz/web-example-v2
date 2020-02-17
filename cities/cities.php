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

    $cities[] = $data;

    putJson($cities);

    return $data;
}

function updateCity($data, $id)
{
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
        $errors['name'] = 'Name is mandatory';
    }
    if (!$city['temperature'] || !filter_var($city['temperature'], FILTER_VALIDATE_FLOAT)) {
        $isValid = false;
        $errors['temperature'] = 'This must be a valid temperature';
    }
    if (!$city['humidity'] || !filter_var($city['humidity'], FILTER_VALIDATE_INT)) {
        $isValid = false;
        $errors['humidity'] = 'This must be a valid humidity';
    }
    if (!$city['wind'] || !filter_var($city['wind'], FILTER_VALIDATE_FLOAT)) {
        $isValid = false;
        $errors['wind'] = 'This must be a valid wind';
    }

    return $isValid;
}
