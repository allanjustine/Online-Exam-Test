<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Exam;
use App\Models\Result;
use App\Models\Essay;
use App\Models\Color;
use Hash;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = bin2hex(random_bytes(20));
        $input = $request->all();
        if ($input['role'] == 'S') {
            $color = '#' . dechex(rand(256, 16777215));
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'mobile' => 'unique:users',
                'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
                'password_confirmation' => 'min:6',
            ]);
            User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => bcrypt($input['password']),
                'role' => $input['role'],
                'remember_token' => $input['_token'],
            ]);
            $admin_id = User::where('name', $input['name'])->select('id')->get();
            Color::create([
                'user_id' => $admin_id[0]->id,
                'profile_color' => $color,
            ]);
            return back()->with('added', 'Administrator has been added');
        } else {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'mobile' => 'unique:users',
            ]);
            User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'role' => $input['role'],
                'mobile' => $input['mobile'],
                'address' => $input['address'],
                'token' => $token,
                'applied_position' => $input['applied_position'],
                'added_by' => $input['auth'],
                'password' => 'password',
            ]);
            return back()->with('added', 'Examinee has been added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $user = User::where('id', $request->id)->select('role')->get();
            $user = $user[0];
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email',
                //'password' => 'required|string|min:6',
                //'mobile' => 'unique:users',
            ]);


            // if(isset($request->changepass))
            //    {
            //       DB::table('users')->where('id', $user->id)->update(['password' => Hash::make($request->password)]);
            //    }
            //    else
            //    {
            //      $input['password'] = $user->password;
            //    }

            if ($user->role == 'S') {
                User::where('id', $request->id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);
                return response()->json(['success' => 'Form is successfully submitted!']);
            } else if ($user->role == 'E') {
                User::where('id', $request->id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'address' => $request->address,
                    'applied_position' => $request->applied_position,
                ]);

                return back()->with('updated', 'Profile has been updated');
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('essay')->where('user_id', $id)->delete();
        DB::table('result')->where('user_id', $id)->delete();
        DB::table('exam')->where('user_id', $id)->delete();
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('deleted', 'User has been deleted');
    }
}
