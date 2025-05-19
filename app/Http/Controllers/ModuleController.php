<?php

namespace App\Http\Controllers;

use App\Services\ModuleRegistry;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    protected $registry;

    public function __construct(ModuleRegistry $registry)
    {
        $this->registry = $registry;
    }

    public function handle(Request $request, $module)
    {
        $service = $this->registry->get($module);

        if (!$service) {
            return response()->json(['error' => 'Module not found'], 404);
        }

        $method = $request->method();
        $id = $request->route('id');
        if ($method === 'GET') return $service->list($request);
        if ($method === 'POST') return $service->create($request->all());
        if ($method === 'PUT') return $service->update($id, $request->all());
        return response()->json(['error' => 'Unsupported method'], 405);
    }
}
