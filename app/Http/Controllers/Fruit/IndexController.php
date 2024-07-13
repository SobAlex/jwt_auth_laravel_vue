<?php

namespace App\Http\Controllers\Fruit;

use App\Http\Resources\Fruit\FruitResource;
use App\Models\Fruit;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index() {

        $fruits = Fruit::all();

        return FruitResource::collection($fruits);
    }
}
