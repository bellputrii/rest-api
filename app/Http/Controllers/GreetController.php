<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GreetController extends Controller
{
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Sample API Documentation",
     *      description="API documentation for the GreetController",
     *      @OA\Contact(
     *          email="your-email@example.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="https://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     * 
     * @OA\Get(
     *     path="/api/greet",
     *     tags={"Greeting"},
     *     summary="Greet the user",
     *     description="Returns a greeting message with user details",
     *     @OA\Parameter(
     *         name="firstname",
     *         in="query",
     *         description="User's first name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="lastname",
     *         in="query",
     *         description="User's last name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Berhasil memproses masukan user",
     *                 "data": {
     *                     "output": "Halo John Doe",
     *                     "firstname": "John",
     *                     "lastname": "Doe"
     *                 }
     *             }
     *         )
     *     )
     * )
     */
    public function greet(Request $request)
    {
        $userData = $request->only(['firstname', 'lastname']);

        if (empty($userData['firstname']) || empty($userData['lastname'])) {
            return response()->json(['message' => 'Missing data', 'success' => false], 404);
        }

        return response()->json([
            'message' => 'Berhasil memproses masukan user',
            'success' => true,
            'data' => [
                'output' => 'Halo ' . $userData['firstname'] . ' ' . $userData['lastname'],
                'firstname' => $userData['firstname'],
                'lastname' => $userData['lastname'],
            ]
        ], 200);
    }
}
