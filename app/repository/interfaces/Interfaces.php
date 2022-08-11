<?php

namespace App\repository\interfaces;

interface Interfaces
{
    function all();
    function create(array $data);
    function update(int $id, array $data);
    function delete(int $id);
}
