<?php

namespace App\Services\Admin\Client;
use App\Http\Requests\Api\Admin\Client\CreateClientRequest;
use App\Http\Requests\Api\Admin\Client\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Support\Facades\Storage;

class ClientService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function store(CreateClientRequest $request)
    {
        $data = $request->validated();
        if (!$request->hasFile('logo'))
            throw new \Exception(__('messages.file_not_sent'), 422);
        $data['logo'] = $data['logo']->storePublicly('clients/logo', 'public');
        $client = Client::create($data);
        return $client;
    }
    public function update(UpdateClientRequest $request, Client $client)
    {
        $data = $request->validated();
        if (!$request->hasFile('logo'))
            throw new \Exception(__('messages.file_not_sent'), 422);
        if (Storage::exists("public/$client->logo")) {
            Storage::delete("public/$client->logo");
        }
        $data['logo'] = $data['logo']->storePublicly('clients/logo', 'public');
        $client->update($data);
        return $client;
    }
    public function destroy($client)
    {
        $client = Client::findOrFail($client);
        if (Storage::exists("public/$client->logo")) {
            Storage::delete("public/$client->logo");
        }

        $client->delete();

        return true;
    }

}
