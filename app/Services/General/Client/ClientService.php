<?php

namespace App\Services\General\Client;
use App\Models\Client;

class ClientService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function index()
    {
        return Client::orderByDesc('created_at')->get();
    }
}
