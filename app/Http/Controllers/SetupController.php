<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SetupController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Response
    {
        $setup_complete = Setting::where('key', 'setup_complete')
            ->firstOrCreate(
                ['key' => 'setup_complete'],
                ['value' => 'false']
            );

        if ($setup_complete['value'] === 'true') return abort(404);

        $response = (new AuthController())->register($request, "admin");

        // TODO: Add admin to the employees table

        if ($response->getStatusCode() === 201) {
            $setup_complete->value = 'true';
            $setup_complete->save();
        }

        return $response;
    }
}
