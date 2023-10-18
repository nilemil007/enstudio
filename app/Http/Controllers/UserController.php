<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Imports\UsersImport;
use App\Models\DdHouse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::latest()->get();
        $trashed = User::onlyTrashed()->latest()->get();
        return view('modules.user.index', compact('users','trashed'));
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
    public function store(UserStoreRequest $request): RedirectResponse
    {
        $user = $request->validated();

        if ($request->hasFile('image')) {
            $name = 'user'.$request->image->hashname();
            Image::make($request->image)->resize(80,80)->save(public_path('assets/images/users/'.$name));
            $user['image'] = $name;
        }

        $id = User::create($user)->id;
        $newUser = User::findOrFail($id);
        $newUser->ddHouse()->attach($request->input('dd_house'));

        // toastr('New user created successfully.','success','Success');

        return to_route('user.index')->with('success','New user created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return 'user show method';
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
    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $information = $request->validated();

        if ($request->hasFile('image')) {

            if ( File::exists( public_path('assets/images/users/'.basename( $user->image ) ) ) )
            {
                File::delete( public_path('assets/images/users/'.basename( $user->image ) ) );
            }

            $name = 'user'.$request->image->hashname();
            Image::make($request->image)->resize(80,80)->save(public_path('assets/images/users/'.$name));
            $information['image'] = $name;
        }


        $user->update($information);
        $user->ddHouse()->sync($request->input('dd_house'));

        // toastr('User updated successfully.','success','Success!');

        return to_route('user.index')->with('success','User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        toastr('This user has been temporarily deleted.','success','Success');

        return to_route('user.index');
    }

    /**
     * User password update.
     */
    public function passwordUpdate(PasswordUpdateRequest $request, User $user): RedirectResponse
    {
        $password = $request->validated();

        $user->update($password);

        return to_route('user.index')->with('success','User password updated successfully.');
    }

    /**
     * Import users.
     */
    public function import(Request $request): JsonResponse|RedirectResponse
    {
        try {
            Excel::import(new UsersImport, $request->file('import_users'));
            // toastr('Users imported successfully.','success','Success');
            return to_route('user.index')->with('success','Users imported successfully.');

        } catch (ValidationException $e) {
            // toastr('Users not imported.','error','Error!');
            return to_route('user.create')->with('import_errors', $e->failures())->with('error','Users not imported.');
        }
    }

    /**
     * Sample file download.
     */
    public function sampleFileDownload(): BinaryFileResponse
    {
        return Response::download(public_path('download/sample/Users.xlsx'));
    }

    /**
     * Trash.
     */
    public function trash(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $trashedUser = User::onlyTrashed()->latest()->paginate(10);
        return view('modules.user.trash', compact('trashedUser'));
    }

    /**
     * Restore.
     */
    public function restore($id): RedirectResponse
    {
        User::withTrashed()->findOrFail($id)->restore();
        // toastr('User restored successfully.','success','Success');
        return to_route('user.index')->with('success','User restored successfully.');
    }

    /**
     * Permanently Delete.
     */
    public function permanentlyDelete($id): RedirectResponse
    {
        // Find a user to detach from the dd house.
        $user = User::with('ddHouse')->withTrashed()->findOrFail($id);

        // All houses associated with the user are being detached.
        foreach ($user->ddHouse as $house)
        {
            $user->ddHouse()->detach($house->id);
        }

        // Find and permanently delete trashed user.
        User::onlyTrashed()->findOrFail($id)->forceDelete();

        // If the user has a photo, that photo will be deleted.
        if ( File::exists( public_path('assets/images/users/'.basename( $user->image ) ) ) )
        {
            File::delete( public_path('assets/images/users/'.basename( $user->image ) ) );
        }

        // Notification [permanently deleted users.]
        toastr('This user has been permanently deleted.','success','Success');

        // Back to all users page.
        return to_route('user.index');
    }
}
