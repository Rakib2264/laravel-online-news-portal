<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use App\Models\Profile;
use App\Models\Thana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          $divisions = Division::pluck('name', 'id')->map(function ($name, $id) {
            return (object)['id' => $id, 'name' => $name];
        });
        $profile = Profile::with('division','districts','thana')->where('user_id',Auth::id())->latest()->first();



         return view('backend.modules.userprofile.userprofile',compact('divisions','profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

            $profile = Profile::where('user_id', Auth::id())->first();

            if ($profile) {
                // Update the existing profile with new data
                $profile->update($request->all());
            } else {
                // Create a new profile if it doesn't exist
                $newProfileData = $request->all();
                $newProfileData['user_id'] = Auth::id();
                Profile::create($newProfileData);
            }

// Additional logic...

return redirect()->back()->with('success', 'Profile updated successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }



    public function getDivision(int $district_id){

        $districts = District::select('name','id')->where('division_id',$district_id)->get();
       return response()->json($districts);
    }

    public function getThanas(int $thana_id){

         $thanas = Thana::select('name','id')->where('district_id',$thana_id)->get();
        return response()->json($thanas);
     }
}
