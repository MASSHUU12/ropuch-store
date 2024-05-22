<?php

namespace App\Http\Controllers;

use App\Models\Employee;
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

        Employee::create([
            'user_id' => $response->original['user']['id'],
            'joining_date' => now(),
            'role' => 'admin'
        ]);

        if ($response->getStatusCode() === 201) {
            $setup_complete->value = 'true';
            $setup_complete->save();
        }

        return $response;
    }
}
