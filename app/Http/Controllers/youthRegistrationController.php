<?php

namespace App\Http\Controllers;
use App\Models\youthRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class youthRegistrationController extends Controller
{
    public function youthregistration ()
    {
        // Get all youth registrations
        $registrations = YouthRegistration::all();

        // Return the data as JSON (or you could return a view)
        return response()->json($registrations);
    }



    public function addyouth(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'barangay' => 'required|string|max:255',
            'purok' => 'required|string|max:255',
            'firstName' => 'required|string|max:255',
            'middleName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:youthRegistration',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new youth registration
        $registration = YouthRegistration::create([
            'barangay' => $validatedData['barangay'],
            'purok' => $validatedData['purok'],
            'firstName' => $validatedData['firstName'],
            'middleName' => $validatedData['middleName'],
            'lastName' => $validatedData['lastName'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Return a success response
        return response()->json(['message' => 'Youth registration created successfully!', 'data' => $registration], 201);
    }


    public function updateyouth(Request $request, $id)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'barangay' => 'sometimes|required|string|max:255',
            'purok' => 'sometimes|required|string|max:255',
            'firstName' => 'sometimes|required|string|max:255',
            'middleName' => 'sometimes|required|string|max:255',
            'lastName' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:youthRegistration,email,' . $id . ',kk_id',
            'password' => 'sometimes|required|string|min:8|confirmed',
        ]);

        // Find the youth registration record or throw 404 if not found
        $registration = YouthRegistration::findOrFail($id);

        // Prepare data for update
        $updateData = $validatedData;

        // Hash the password if provided
        if (!empty($validatedData['password'])) {
            $updateData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($updateData['password']); // Remove password field if not provided
        }

        // Perform the update
        $registration->update($updateData);

        // Log the update action
        Log::info('Youth registration updated', ['registration' => $registration]);

        // Return a JSON response with success message and updated data
        return response()->json(['message' => 'Youth registration updated successfully!', 'data' => $registration]);
    }

    
    public function destroyyouth($id)
    {
        // Find the registration by ID and delete it
        $registration = YouthRegistration::findOrFail($id);
        $registration->delete();

        return response()->json(['message' => 'Youth registration deleted successfully!']);
    }

}