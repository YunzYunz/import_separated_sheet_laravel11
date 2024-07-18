public function importKaryawan(Request $request)
    {
        $request->validate([
            'importFile' => 'required|mimes:xls,xlsx'
        ]);

        try {
            $file = $request->file('importFile');
            Excel::import(new UsersImport, $file);

            return redirect()->back()->with('success', 'Data karyawan berhasil diimpor.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengimpor data karyawan: ' . $e->getMessage());
        }
    }
