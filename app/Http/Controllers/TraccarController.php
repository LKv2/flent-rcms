<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class TraccarController extends Controller
{
    private $traccarUrl;
    private $traccarUsername;
    private $traccarPassword;

    public function __construct()
    {
        // Set Traccar API details (replace with your actual values)
        $this->traccarUrl = env('traccar_api_url');
        $this->traccarUsername = env('traccar_api_username');
        $this->traccarPassword = env('traccar_api_pass');
    }

    public function index()
    {
        $cars = Auth::user()->cars;
        return view('gps.index', compact('cars'));
    }
    public function getHistoricalRoute($deviceId)
    {
        try {
            // Fetch historical route data for the specified device
            $response = Http::withBasicAuth($this->traccarUsername, $this->traccarPassword)
                ->get($this->traccarUrl . "/api/reports/route", [
                    'deviceId' => $deviceId,
                    'from' => date('c', strtotime('-30 days')), // ISO 8601 format
                    'to' => date('c', strtotime('now')), // ISO 8601 format for the current date/time
                ]);

            // Check if the request was successful (HTTP status code 2xx)
            if ($response->successful()) {
                $historicalRoute = $response->json();

                // Classify the historical route data by days
                $classifiedRoute = $this->classifyRouteByDays($historicalRoute);
                return response()->json($classifiedRoute);
            } else {
                // Handle the case where the request was not successful
                $errorMessage = $response->json();
                return response()->json(['error' => $errorMessage], $response->status());
            }
        } catch (\Exception $e) {
            // Handle exceptions (e.g., connection error, authentication failure)
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function classifyRouteByDays($historicalRoute)
    {
        // Initialize an associative array to store classified data
        $classifiedData = [];

        foreach ($historicalRoute as $position) {
            // Extract the date from the timestamp
            $date = date('Y-m-d', strtotime($position['fixTime']));
            $time = date('h:i:s A', strtotime($position['fixTime']));

            // Create an array for each date if it doesn't exist
            if (!isset($classifiedData[$date])) {
                $classifiedData[$date] = [];
            }

            // Add the position data to the corresponding date
            $classifiedData[$date][] = [
                'date' => $date,
                'time' => $time,
                'latitude' => $position['latitude'],
                'longitude' => $position['longitude'],
                'speed' => $position['speed']
            ];
        }

        return $classifiedData;
    }

    public function getDevices()
    {
        $response = Http::withBasicAuth($this->traccarUsername, $this->traccarPassword)
            ->get("{$this->traccarUrl}/api/devices");

        return $response->json();
    }

    public function getDevicePositions($deviceId)
    {
        $response = Http::withBasicAuth($this->traccarUsername, $this->traccarPassword)
            ->get("{$this->traccarUrl}/api/positions", ['deviceId' => $deviceId]);

        return $response->json();
    }

    public function storeGroupe($name)
    {

        // Prepare the data to be sent to Traccar API for group creation
        $data = [
            'name' => $name,
            // Add other data fields as needed
        ];

        // Make a request to Traccar API to create the group
        $response = Http::withBasicAuth($this->traccarUsername, $this->traccarPassword)
            ->post("{$this->traccarUrl}/api/groups", $data);

        // Check if the group creation was successful
        if ($response->successful()) {
            return response()->json(['message' => 'Group created successfully'], 201);
        } else {
            return response()->json(['error' => 'Failed to create group'], $response->status());
        }
    }

    public function storeGeofence(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string',
            'area' => 'required|string',
            // Add other validation rules as needed
        ]);

        // Prepare the data to be sent to Traccar API for geofence creation
        $data = [
            'name' => $request->input('name'),
            'area' => $request->input('area'),
            // Add other data fields as needed
        ];

        // Make a request to Traccar API to create the geofence
        $response = Http::withBasicAuth($this->traccarUsername, $this->traccarPassword)
            ->post("{$this->traccarUrl}/api/geofences", $data);

        // Check if the geofence creation was successful
        if ($response->successful()) {
            return response()->json(['message' => 'Geofence created successfully'], 201);
        } else {
            return response()->json(['error' => 'Failed to create geofence'], $response->status());
        }
    }

    public function storeDevice(Request $request)
    {
        
        $car = Car::find($request->car);
        // Prepare the data to be sent to Traccar API for device creation
        $data = [
            'name' => $car->marque()->name . ' ' . $car->mode->name . ' : ' . $car->immatriculation(),
            'uniqueId' => $request->GPSCode,
            'phone' => $car->phoneGPS,
        ];
        $car->GPSCode = $request->GPSCode;
        $car->phoneGPS = $request->phoneGPS;
        $car->save();
        // Make a request to Traccar API to create the device
        $response = Http::withBasicAuth($this->traccarUsername, $this->traccarPassword)
            ->post("{$this->traccarUrl}/api/devices", $data);

        // Check if the device creation was successful
        if ($response->successful()) {
            return response()->json(['message' => 'Device created successfully'], 201);
        } else {
            return response()->json(['error' => 'Failed to create device'], $response->status());
        }
    }
    public function storeUser(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',

            // Add other validation rules as needed
        ]);

        // Prepare the data to be sent to Traccar API for user creation
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            // Add other data fields as needed
        ];

        // Make a request to Traccar API to create the user
        $response = Http::withBasicAuth($this->traccarUsername, $this->traccarPassword)
            ->post("{$this->traccarUrl}/api/users", $data);

        // Check if the user creation was successful
        if ($response->successful()) {
            return response()->json(['message' => 'User created successfully'], 201);
        } else {
            return response()->json(['error' => 'Failed to create user'], $response->status());
        }
    }
}
