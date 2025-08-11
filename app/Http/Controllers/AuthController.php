<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
// use Illuminate\Support\Facades\Log; 
// use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\CardMemberController;
use App\Models\CardMember;

class AuthController extends Controller
{
    // page 1 regis
    public function register()
    {
        return view('auth/register');
    }
    // page 2 regis
    public function newRegis()
    {
        return view('auth.new_regis');
    }

    public function registerSave(Request $request)
    {
            // dd($request->all());
        if ($request->terms !== 'accepted') {
            return redirect()->route('register')->with('failed', 'Terms and conditions must be accepted.')->withInput();
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'no_member' => 'nullable|string|min:10|max:11|exists:card_members,no_member',
            'tanggal_lahir' => 'nullable|date|required_with:no_member',
            'password' => 'min:8',
            'password_confirmation' => 'min:8|same:password|required',
            'role' => 'required|in:user,admin,superadmin',
            'file' => 'nullable|image|mimes:jpeg,png,jpg'
        ], [
            'name.required' => 'Nama harus di isi.',
            'password_confirmation.same' => 'Konfirmasi password harus sama'
        ]);

        if ($request->no_member) {
            $member = CardMember::where('no_member', $request->no_member)->first();
            if ($member) {
    $tanggalLahirInput = \Carbon\Carbon::parse($request->tanggal_lahir)->format('Y-m-d');
    $tanggalLahirDatabase = \Carbon\Carbon::parse($member->tanggal_lahir)->format('Y-m-d');

    if ($tanggalLahirInput !== $tanggalLahirDatabase) {
        return redirect(route('register'))->with('failed', 'Tanggal lahir member tidak sesuai.');
    }
}
// if ($member && $request->tanggal_lahir != $member->tanggal_lahir) {
//                 return redirect(route('register'))->with('failed', 'Tanggal lahir member tidak sesuai.');
//             }
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        if ($request->no_member) {
            if ($member) {
                $member->user_id = $user->id;
                $member->save();
                
            }
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('files', $filename, 'public');
            $user->profile_photo = $filename;
            $user->save();
        }

        toastr()->success('Akun berhasil didaftarkan.');

        if ($request->is_admin) {
            return redirect()->route('table.akun');
        } else {
            return redirect()->route('login');
        }
    }

    public function updateUserProfile(Request $request, User $user)
    {
        $redirect = Auth::user()->role == 'admin' ? 'dashboard' : 'new-dashboard';
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|min:8',
                'password_confirmation' => 'required_with:password|same:password',
                'old_password' => 'required_with:password',
                'file' => 'nullable|image|mimes:jpeg,png,jpg'
            ]);
        } catch (ValidationException $e) {
            toastr()->error($e->getMessage());
            return redirect()->route($redirect)->withErrors($e->validator)->withInput();
        }

        if ($request->password && !Hash::check($request->old_password, $user->password)) {
            toastr()->error('Password lama tidak sesuai.');
            return redirect()->route($redirect);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->password) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('files', $filename, 'public');
            $user->profile_photo = $filename;
            $user->save();
        }

        toastr()->success('Data user berhasil di perbarui.');
        return redirect()->route($redirect);
    }

    public function update(Request $request, CardMember $card_member)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required',
            'no_identitas' => 'nullable|string|unique:card_members,no_identitas,' . $card_member->id,
            'jenis_kelamin' => 'nullable|string',
            'alamat' => 'required|string',
            "rt_rw" => 'required|string',
            "kelurahan" => 'required|string',
            "kecamatan" => 'required|string',
            "kota" => 'required|string',
            "kode_pos" => 'required|string',
            "no_hp" => 'required|string',
            "status" => 'nullable|string',
            "jumlah_tanggungan" => 'nullable|string',
            "pendapatan" => 'nullable',
            "npwp" => 'nullable|string',
            "kewarganegaraan" => 'nullable|string',
            "agama" => 'nullable|string',
            "validation" => 'required',
            "file" => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $filename = $card_member->member_profile;
        if ($request->file('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('member-profile', $filename, 'public');
        }

        $card_member->update([
            'nama' => $validated['nama'],
            'no_member' => $card_member->no_member,
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'no_identitas' => $validated['no_identitas'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'alamat' => $validated['alamat'],
            "rt_rw" => $validated['rt_rw'],
            "kelurahan" => $validated['kelurahan'],
            "kecamatan" => $validated['kecamatan'],
            "kota" => $validated['kota'],
            "kode_pos" => $validated['kode_pos'],
            "no_hp" => $validated['no_hp'],
            "status" => $validated['status'],
            "jumlah_tanggungan" => $validated['jumlah_tanggungan'],
            "pendapatan" => $validated['pendapatan'],
            "npwp" => $validated['npwp'],
            "kewarganegaraan" => $validated['kewarganegaraan'],
            "agama" => $validated['agama'],
            "validation" => $validated['validation'],
            "member_profile" => $filename ? $filename : null
        ]);

        $card_member->save();

        return redirect(route('new-dashboard'))->with('success', 'Data berhasil diperbarui!');
    }

    public function login()
    {
        return view('auth.login');
    }
    public function loginAction(request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }
        $request->session()->regenerate();

        if (Auth::user()->role === 'admin') {
            toastr()->success('Login berhasil.');
            return redirect()->route('dashboard');
        } elseif (Auth::user()->member && Auth::user()->member->no_member !== null) {
            toastr()->success('Login berhasil.');
            return redirect()->route('new-dashboard');
        } else {
            toastr()->success('Login berhasil.');
            return redirect()->route('form');
        }
    }

    public function updateAkun(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|min:8',
            'password_confirmation' => 'required_with:password|min:8',
        ]);

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        toastr()->success('Password berhasil diperbarui.');
        return redirect()->route('table.akun');
    }

    public function deleteAkun(User $user)
    {
        $user->delete();

        toastr()->success('Akun berhasil dihapus!');
        return redirect()->route('table.akun');
    }

    public function profil_form()
    {
        $member = Auth::user()->member;
        return view('auth.form-member', ['member' => $member]);
    }

    public function profil_table()
    {
        $user = Auth::user();
        return view('auth.table', ['user' => $user]);
    }

    // akun
    public function table_akun()
    {
        $query = User::query();
        if (request()->has('search')) {
            $search_term = request()->input('search');
            $query->where('name', 'like', "%$search_term%");
        }

        $users = $query->paginate(10);
        return view('auth.table_akun', ['users' => $users]);
    }

    public function information()
    {
        $user = User::all();
        return view('auth.information', ['user' => $user]);
    }

    public function barcode()
    {
        $member = Auth::user()->member;
        return view('auth.barcode', ['member' => $member]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect(route('login'));
    }
}
