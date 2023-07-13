<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Breed\StoreBreedRequest;
use App\Models\Breed;
use Inertia\Inertia;


class BreedController extends Controller
{

    public function index()
    {
        $breeds = Breed::orderBy('created_at', 'desc')->get();

        $breeds->load('user');
        $breeds->load('image');

        return response()->json([
            'res' => true,
            'breeds' => $breeds
        ]);
    }

    public function create()
    {
        return Inertia::modal('Breed/BreedForm')->baseRoute('welcome');
    }

    public function store(StoreBreedRequest $request)
    {
        $imageController = new ImageController();

        // Create an image and obtain the id from the database
        $image_id = $imageController->store(
            $request->name,
            $request->image,
        );

        $breed = Breed::create([
            'name' => $request->name,
            'image_id' => $image_id,
            'description' => $request->description,
            'age' => $request->age,
            'state' => $request->state,
            'user_id' => $request->user_id
        ]);

        return response()->json([
            'res' => true,
            'breed' => $breed,
        ]);
    }
}
