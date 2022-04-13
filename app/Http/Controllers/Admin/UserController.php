<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
  public function getUsers()
  {
    $users = User::paginate(10);
    return view('admin.users')->with('users', $users);
  }

  public function create()
  {
    return view('admin.users_add');
  }

  public function  Store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|max:255',
      'login' => 'required|max:255',
      'password' => 'required',
      'categories' => 'required',
      'email' => 'required|email|unique:users'
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $user = new User();
    $user->name = $request->name;
    $user->email = $request->login;
    $user->email_field = $request->email;
    $user->password = bcrypt($request->password);
    $user->status = $request->categories;
    $user->save();

    return redirect('/admin/users');
  }

  public function Show(Request $request)
  {
    $user = User::where('id', '=', $request->id)->first();
    return view('admin.users_edit')->with('user', $user);
  }

  public function update(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|max:255',
      'password' => 'required',
      'confirm_password' => 'required',
      'categories' => 'required',
      'id' => 'required',
      'email' => 'required|email|unique:users'
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }
    $user = User::find($request->id);

    if ($request->password == $request->confirm_password) {
      $user->name = $request->name;
      $user->status = $request->categories;
      $user->password = bcrypt($request->confirm_password);
      $user->email_field = $request->email;
      $user->update();
      return redirect('/admin/users/');
    } else {
      return back()->with('error', 'Wrong passwords!');
    }
  }

  public function  destroy(Request $request)
  {
    $user = User::find($request->id);
    if ($user) {
      $user->delete();
    } else {
      abort(404);
    }

    return redirect('/admin/users/');
  }

  public function Profile()
  {
    return view('admin.profile');
  }

  public function profile_update(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|max:255',
      'old_password' => 'required|max:255',
      'new_password' => 'required',
      'confirm_password' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $user = User::find(auth()->id());

    if (Hash::check($request->old_password, $user->password)) {
      if ($request->new_password == $request->confirm_password) {
        $user->name = $request->name;
        $user->password = Hash::make($request->confirm_password);
        $user->save();

        return redirect('/admin/users/profile/');
      }
    }
  }

  public function forgotPassword()
  {
    return view('auth.passwords.email');
  }

  public function sendPassword(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email' => 'required|email',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $user = User::where('email_field', $request->email)->first();

    if ($user) {
      $password = mt_rand(100000, 999999);
      $user->password = bcrypt($password);
      $user->save();
      $text = "Username: $user->name\nPassword: $password";
      Mail::raw($text, function ($message) use ($user) {
        $message->from(env('MAIL_FROM_ADDRESS', 'noreply@greencentralasia.org'), env('MAIL_FROM_NAME', 'greencentralasia.org'));
        $message->to($user->email_field, $user->name);
        // $message->cc('umid-berdiev82@mail.ru', 'Bobur');
        $message->subject('Запрос на авторизацию!');
      });
      return redirect('login')->with('success', 'Password is sent. Check email!');
    } else {
      return back()->with('error', 'Wrong email!');
    }
  }
}
