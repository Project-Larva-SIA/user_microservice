<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;

Class UserController extends Controller {
use ApiResponser;
private $request;
public function __construct(Request $request){
$this->request = $request;
}

    public function index()
    {
        $users = User::all();
        return $this->successResponse($users);
    }

    public function addUser(Request $request ){
    $rules = [
    'Username' => 'required',
    'Password' => 'required',
    'Email' => 'required',
    ];
    $this->validate($request,$rules);
    $user = User::create($request->all());

    return $this->successResponse($user, Response::HTTP_CREATED);
    }

    public function show($userID)
    {
    $user = User::findOrFail($userID);
    return $this->successResponse($user);

    }

    public function updateUser(Request $request,$userID)
    {
        $rules = [
            'Username' => 'required',
            'Password' => 'required',
            'Email' => 'required',
            ];
            $this->validate($request,$rules);
    $user = User::findOrFail($userID);
    $user->fill($request->all());

    // if no changes happen
    if ($user->isClean()) {
    return $this->errorResponse('Please change any value', Response::HTTP_UNPROCESSABLE_ENTITY);
    }
    $user->save();
    return $this->successResponse($user);

    }

    public function deleteUser($userID)
    {
        $user = User::findOrFail($userID);

        // Create an array to store the deleted users
        $deletedUser = [];

        // Add the user to the deleted users array
        $deletedUser[] = $user;

        // Delete the user from the database
        $user->delete();

        // Optionally, you can return the deleted users array or perform other actions
        return response()->json(['deletedUsers' => $deletedUser]);
    }

        public function searchByName(Request $request)
    {
        $key = $request->input('q');
        
        // Perform the search query to find users by name
        $users = User::where('Username', 'LIKE', '%' . $key . '%')->get();
        
        return response()->json(['data' => $users]);
    }
}


