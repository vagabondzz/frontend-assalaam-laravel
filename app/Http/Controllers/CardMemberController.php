<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CardMember;
// use App\Models\User;
use Carbon\Carbon;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Imports\MembersImport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class CardMemberController extends Controller
{
    public function formulirMember()
    {
        return view('auth.form');
    }

    public function member(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'no_member' => 'nullable|string|unique:card_members,no_member|min:11|max:11',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required',
            'no_identitas' => 'nullable|string|unique:card_members,no_identitas',
            'jenis_kelamin' => 'required|string',
            'alamat' => 'required|string',
            "rt_rw" => 'required|string',
            "kelurahan" => 'required|string',
            "kecamatan" => 'required|string',
            "kota" => 'required|string',
            "kode_pos" => 'required|string',
            "no_hp" => 'required|string',
            "status" => 'required|string',
            "jumlah_tanggungan" => 'required|string',
            "pendapatan" => 'required',
            "npwp" => 'nullable|string',
            "kewarganegaraan" => 'nullable|string',
            "agama" => 'nullable|string',
            "validation" => 'required',
            "file" => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $filename = '';
        if ($request->file('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('member-profile', $filename, 'public');
        }

        CardMember::create([
            'nama' => $validated['nama'],
            'no_member' => $validated['no_member'] ?? '',
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'no_identitas' => $validated['no_identitas'] ?? '',
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
            "npwp" => $validated['npwp'] ?? '',
            "kewarganegaraan" => $validated['kewarganegaraan'] ?? '',
            "agama" => $validated['agama'] ?? '',
            "validation" => $validated['validation'],
            "member_profile" => $filename ? $filename : null
        ]);

        return redirect(route('table'));
    }

    public function registerMember(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required',
            'no_identitas' => 'nullable|string|unique:card_members,no_identitas',
            'jenis_kelamin' => 'required|string',
            'alamat' => 'required|string',
            "rt_rw" => 'required|string',
            "kelurahan" => 'required|string',
            "kecamatan" => 'required|string',
            "kota" => 'required|string',    
            "kode_pos" => 'required|string',
            "no_hp" => 'required|string',
            "status" => 'required|string',
            "jumlah_tanggungan" => 'required|string',
            "pendapatan" => 'required',
            "npwp" => 'nullable|string',
            "kewarganegaraan" => 'nullable|string',
            "agama" => 'nullable|string',
            "validation" => 'required',
            "file" => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $filename = '';
        if ($request->file('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('member-profile', $filename, 'public');
        }

        $member = CardMember::create([
            'nama' => $validated['nama'],
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

        $member->user_id = Auth::user()->id;
        $member->save();

        return redirect(route('information'));
    }

    public function updateMemberStatus(Request $request)
    {
        $card_member = CardMember::find($request->id_member);
        if ($card_member->is_active || $card_member->active_end > Carbon::today()) {
            return redirect(route('table'));
        } else {
            $card_member->update([
                'active_start' => Carbon::today()->format('Y-m-d'),
                'active_end' => Carbon::today()->addMonth(3)->format('Y-m-d'),
                'is_active' => !$card_member->is_active
            ]);

            return redirect(route('table'));
        }
    }

    public function delete(CardMember $card_member)
    {
        $card_member->delete();

        toastr()->success('Data member berhasil dihapus.');
        return redirect(route('table'));
    }

    public function showMembers()
    {
        $query = CardMember::query();

        if (request()->has('search')) {
            $search = request()->input('search');
            $query->whereAny(['nama', 'no_member'], 'like', "%$search%");
        }

        $members = $query->latest()->paginate(10); // Mengambil semua data dari tabel cardmembers
        return view('auth.table', compact('members'));
    }

    public function importMember(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        if ($request->boolean('reset_table')) {
            DB::table('card_members')->delete();
        }

        try {
            $import = new MembersImport;
            Excel::import($import, $request->file('file'));

            if ($import->existing_members) {
                return redirect(route('table'))
                    ->with('error_import', 'Beberapa member sudah terdaftar ' . implode(', ', array_column($import->existing_members, 'no_member')))
                    ->with('existing_members', $import->existing_members);
            }
        } catch (\Exception $e) {
            return redirect(route('table'))->with('failed', $e->getMessage());
        }

        return redirect(route('table'))->with('successMember', 'Data berhasil di import.');
    }

    public function updateExistingMember(Request $request)
    {
        $existing_members = json_decode($request->existing_members);

        foreach ($existing_members as $member) {
            $data = CardMember::where('no_member', $member->no_member)->first();
            $data->update([
                'nama' => $member->nama,
                'tempat_lahir' => $member->tempat_lahir,
                'tanggal_lahir' => $member->tanggal_lahir,
                'no_identitas' => $member->no_identitas,
                'jenis_kelamin' => $member->jenis_kelamin,
                'alamat' => $member->alamat,
                'rt_rw' => $member->rt_rw,
                'kelurahan' => $member->kelurahan,
                'kecamatan' => $member->kecamatan,
                'kota' => $member->kota,
                'kode_pos' => $member->kode_pos,
                'no_hp' => $member->no_hp,
                'status' => $member->status,
                'jumlah_tanggungan' => $member->jumlah_tanggungan,
                'pendapatan' => $member->pendapatan,
                'npwp' => $member->npwp,
                'kewarganegaraan' => $member->kewarganegaraan,
                'agama' => $member->agama,
                'active_start' => $member->active_start,
                'active_end' => $member->active_end,
                'is_active' => $member->is_active,
            ]);
        }

        return redirect(route('table'))->with('successMember', 'Data member berhasil di perbarui.');
    }

    public function edit($id)
    {
        $member = CardMember::find($id);

        return view('auth.form-edit', compact('member'));
    }

    public function update(Request $request, CardMember $card_member)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'no_member' => 'nullable|string|min:11|max:11|unique:card_members,no_member,' . $card_member->id,
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required',
            'no_identitas' => 'nullable|string|unique:card_members,no_identitas,' . $card_member->id,
            'jenis_kelamin' => 'required|string',
            'alamat' => 'required|string',
            "rt_rw" => 'required|string',
            "kelurahan" => 'required|string',
            "kecamatan" => 'required|string',
            "kota" => 'required|string',
            "kode_pos" => 'required|string',
            "no_hp" => 'required|string',
            "status" => 'required|string',
            "jumlah_tanggungan" => 'required|string',
            "pendapatan" => 'required',
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
            'no_member' => $validated['no_member'] ?? '',
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'no_identitas' => $validated['no_identitas'] ?? '',
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
            "npwp" => $validated['npwp'] ?? '',
            "kewarganegaraan" => $validated['kewarganegaraan'] ?? '',
            "agama" => $validated['agama'] ?? '',
            "validation" => $validated['validation'],
            "member_profile" => $filename ? $filename : null
        ]);

        $card_member->save();

        return redirect(route('table'))->with('success', 'Data berhasil diperbarui!');
    }
}
