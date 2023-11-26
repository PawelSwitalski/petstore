<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PetService
{

    private string $baseUrl = 'https://petstore.swagger.io/v2/pet';

    public function uploadImage($petId, $additionalMetadata, $file)
    {

        return Http::attach(
            'file',
            file_get_contents($file),
            $file->getClientOriginalName()
        )->post($this->baseUrl . '/' . $petId . '/uploadImage', [
            'additionalMetadata' => $additionalMetadata,
        ])->json();
    }


    public function createPet($request)
    {
        return Http::post(
            $this->baseUrl,
            $this->prepareData($request)
        )->json();
    }

    public function updatePet($request)
    {
        $data = $this->prepareData($request);

        return Http::put($this->baseUrl, $data)->json();
    }

    public function showPet($id)
    {
        $pet = Http::withUrlParameters([
                'page' => 'https://petstore.swagger.io',
                'version' => 'v2',
                'topic' => 'pet',
                'id' => $id,
            ])->get('{+page}/{version}/{topic}/{id}')->json();

        if (empty($pet) || !empty($pet['type']))
            return 'Error. Pet not found';

        if (empty($pet['photoUrls']))
            $pet['photoUrls'] = [];

        if (empty($pet['tags']))
            $pet['tags'] = ['id' => null, 'name' => null];

        return $pet;
    }

    public function findByStatus($status): array
    {
        return Http::get($this->baseUrl . '/findByStatus', [
            'status' => $status,
        ])->json();
    }

    public function deletePet($id)
    {
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'api_key' => 'special-key',
        ])->delete($this->baseUrl . '/' . $id)
        ->json();

//        return Http::delete($this->baseUrl . '/' . $id, [
//            'api_key' => 'special-key',
//        ])->json();
    }

    /**
     * @param $petData
     * @return array
     */
    public function prepareData($petData): array
    {
        $data = [
            'id' => $petData->petId,
            'category' => [
                'id' => $petData->petCategoryId,
                'name' => $petData->petCategoryName
            ],
            'name' => $petData->petName,
            'photoUrls' => [],
            'tags' => [],
            'status' => $petData->petStatus
        ];
        for ($i = 0; $i <= 10; $i++) {
            if (!empty($petData['petPhotoUrl' . $i])) {
                $data['photoUrls'][] = $petData['petPhotoUrl' . $i];
            }
        }

        for ($i = 0; $i <= 10; $i++) {
            if (($petData['petTagId' . $i]) != null &&
                ($petData['petTagName' . $i]) != null) {
                $data['tags'][] = [
                    'id' => $petData['petTagId' . $i],
                    'name' => $petData['petTagName' . $i]
                ];
            }
        }
        return $data;
    }
}
