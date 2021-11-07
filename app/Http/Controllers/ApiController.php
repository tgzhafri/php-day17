<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeResource;
use App\Http\Resources\UserResource;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeJob;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
// use Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
// use JWTAuth;
use App\Http\Traits\JsonTrait;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class ApiController extends Controller
{
    use JsonTrait;

    /**
     * Create a new ApiController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // not a good practice cos have to change many place,
        // $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    /**
     * Login API
     *
     * @bodyParam   email    string  required    The email of the  user.      Example: superadmin@invoke.com
     * @bodyParam   password    string  required    The password of the  user.   Example: password
     *
     * @response {
     *  "access_token": {{token}},
     *  "token_type": "Bearer",
     * }
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return $this->jsonResponse(
                $validator->errors(),
                'Invalid Input Parameters',
                422
            ); // Error 422 = parameter / application error code
        }

        if (!$token = JWTAuth::attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }
    /**
     * Dashboard
     *
     * Check that the service is up. If everything is okay, you'll get a 200 OK Response
     * 
     * Otherwise, the request will fail with a 400 error, and a response list
     * 
     * @authenticated
     * @header Authorization Bearer {{token}}
     * @reponse 401 scenario="invalid token"
     */
    public function dashboard(Request $request)
    {
        $user_total = User::count();
        $job_total = EmployeeJob::count();
        $employee = Employee::whereId(1)
            ->with(['user', 'jobHistory'])
            ->first();
        $department_total = Department::count();
        $code = 0;

        return $this->jsonResponse(
            // compact('user_total', 'job_total', 'department_total','code'),
            compact('user_total', 'job_total', 'department_total','employee','code'),
            '',
            200
        );
        // return response()->json(
        //     compact('user_total', 'job_total', 'department_total', 'code')
        // );
    }
    /**
     * User API
     * 
     * Get all users by pagination
     * @bodyParam page int Page number for pagination. Example: 1
     * @authenticated
     * @header Authorization Bearer {{token}}
     */
    public function users()
    {
        $user = User::where('id',auth()->user()->id)->first();

        $response = Gate::inspect('update', $user);

        if ($response->allowed()) {
            // The action is authorized...
            $users = User::paginate(10);
            return $this->jsonResponse(
                UserResource::collection($users)
            );
        } else {
            echo $response->message();
        }
    }
    /**
     * Employee API
     * 
     * Employee details
     * @authenticated
     * @header Authorization Bearer {{token}}
     */
    public function employees(Request $request)
    {
        $employee = Employee::whereId(1)
            ->with(['user', 'jobHistory'])
            ->first();
        // $employee = Employee::paginate(10)->with(['user','jobHistory']);
        return $this->jsonResponse(
            // EmployeeResource::collection($employee)
            compact('employee'),
            '',
            200
        );
    }
        /**
     * Get Employee API
     * 
     * Get employee details
     * @bodyParam page int Page number for pagination. Example: 1
     * @authenticated
     * @header Authorization Bearer {{token}}
     */
    public function getEmployee(Request $request)
    {
        $employee = Employee::paginate(10);
            // ->with(['user', 'jobHistory'])
            // ->first();
        // $employee = Employee::paginate(10)->with(['user','jobHistory']);
        return $this->jsonResponse(
            // EmployeeResource::collection($employee)
            compact('employee'),
            '',
            200
        );
    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        return response()->json(auth()->user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}
