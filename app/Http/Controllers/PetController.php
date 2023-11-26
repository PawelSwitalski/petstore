<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePetRequest;
use App\Services\PetService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PetController extends Controller
{

    public function __construct(
        protected PetService $petService
    )
    {}

    public function index()
    {
        return view('pet', ['pet' => null]);
    }

    public function create(StorePetRequest $request)
    {


        return $this->petService->createPet($request);
    }


    public function show(Request $request)
    {
//        return $this->petService->showPet($request->id);
//        return Inertia::render('Pet/Show');
        $pet = $this->petService->showPet($request->id);
        if ($pet == 'Error. Pet not found')
            return 'Error. Pet not found';
        return view('pet', ['pet' => $pet]);
    }

    public function update(StorePetRequest $request, $id)
    {
        $this->petService->updatePet($request);
        $pet = $this->petService->showPet($id);
        return view('pet', ['pet' => $pet]);

//        return $this->petService->updatePet($request);
//        return $request->petPhotoUrl1;
    }

    public function uploadImage(Request $request, $id)
    {
        $uploadResponse = $this->petService->
            uploadImage($id, $request->additionalMetadata, $request->petPhotoFile);
        return $uploadResponse;
//        $pet = $this->petService->showPet($id);
//        if ($pet == 'Error. Pet not found')
//            return 'Error. Pet not found';
//        return view('pet', ['pet' => $pet]);
    }

    public function destroy(Request $request, $id)
    {

        if (!empty($id))
            return $this->petService->deletePet($id);

        return 'petId is empty';
    }

    /**
     * @throws ValidationException
     */
    public function findByStatus($status)
    {
        $this->validate($status, [
            'status' => 'required|in:available,pending,sold',
        ]);

        $pets = $this->petService->findByStatus($status);
        return view('petsByStatus',
            ['status' => $status, 'pets' => $pets]);
    }
}
