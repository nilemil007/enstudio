<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Imports\UsersImport;
use App\Models\DdHouse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::latest()->get();
        return view('modules.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $houses = DdHouse::all();
        return view('modules.user.create', compact('houses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request): JsonResponse
    {
        $user = $request->validated();

        if ($request->hasFile('image')) {
            $name = 'user'.$request->image->hashname();
            $request->image->storeAs('public/users', $name);
            $user['image'] = $name;
        }

        User::create($user);

        return response()->json(['success' => 'New user created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $houses = DdHouse::all();
        return view('modules.user.edit', compact('user','houses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user): JsonResponse
    {
        $information = $request->validated();

        if ($request->hasFile('image')) {

            if ( File::exists( public_path('storage/users/'.basename( $user->image ) ) ) )
            {
                File::delete( public_path('storage/users/'.basename( $user->image ) ) );
            }

            $name = 'user'.$request->image->hashname();
            $request->image->storeAs('public/users', $name);
            $information['image'] = $name;
        }

        $user->update($information);

        return response()->json(['success' => 'User updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        if ($user->delete()) {

            if ( File::exists( public_path('storage/users/'.basename( $user->image ) ) ) )
            {
                File::delete( public_path('storage/users/'.basename( $user->image ) ) );
            }
        }

        return response()->json(['success' => 'The user has been successfully deleted.']);
    }

    /**
     * Delete all users.
     */
    public function deleteAll(): JsonResponse
    {
        try {
            User::query()->delete();
            return response()->json(['success' => 'All users has been successfully deleted.']);
        }catch (Exception $exception){
           dd($exception);
        }
    }

    /**
     * User password update.
     */
    public function passwordUpdate(PasswordUpdateRequest $request, User $user): RedirectResponse
    {
        $password = $request->validated();

        if($user->update($password))
        {
            Alert::success('Success', 'User password updated successfully.');
        }else{
            Alert::error('Error', 'User password not updated.');
        }

        return to_route('user.index');
    }

    /**
     * Import users.
     */
    public function import(Request $request): RedirectResponse
    {
        try {
            Excel::import(new UsersImport, $request->file('import_users'));

            Alert::success('Success', 'Users imported successfully.');

            return to_route('user.index');

        } catch (ValidationException $e) {

            return to_route('user.create')->with('import_errors', $e->failures());
        }
    }

    /**
     * Sample file download.
     */
    public function sampleFileDownload(): BinaryFileResponse
    {
        return Response::download(public_path('download/sample/Users.xlsx'));
    }
}
