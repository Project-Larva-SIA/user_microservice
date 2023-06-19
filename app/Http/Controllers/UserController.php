<?php
namespace App\Http\Controllers;
use Carbon\Carbon;
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
        return $this->successResponseAdmin($users);
    }

    public function addUser(Request $request ){
    $rules = [
    'name' => 'required',
    'password' => 'required',
    'email' => ['required', 'email', 'unique:users'],
    ];
    $this->validate($request,$rules);

    $user = User::create($request->all());

    return $this->successResponseAdmin($user, Response::HTTP_CREATED);
    }

    public function show($userID)
    {
    $user = User::findOrFail($userID);
    return $this->successResponse($user);

    }

    public function updateUser(Request $request,$userID)
    {
        $rules = [
            'name' => 'required',
            'email' => ['required', 'email'], 
            'password' => 'required',
            ];
    $this->validate($request,$rules);
    $user = User::findOrFail($userID);
    $user->fill($request->all());

    // if no changes happen
    if ($user->isClean()) {
    return $this->errorResponse('Please change any value', Response::HTTP_UNPROCESSABLE_ENTITY);
    }
    
    $user->save();
    return $this->successResponseAdmin($user);

    }

    public function deleteUser($userID)
    {
        $user = User::findOrFail($userID);
        // Delete the user from the database
        $user->delete();
        return $this->successResponse($user);
    }

        public function searchByName(Request $request)
    {
        
        $key = $request->input('q');
        // Perform the search query to find users by name
        $users = User::where('name', 'LIKE', '%' . $key . '%')->get();
        return response()->json(['data' => $users]);

    }
}


