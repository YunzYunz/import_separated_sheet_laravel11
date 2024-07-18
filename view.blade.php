<form id="importForm" class="d-inline" enctype="multipart/form-data" action="{{ route('admin.importkaryawan') }}" method="POST">
    @csrf
    <input type="file" id="importFile" name="importFile" class="d-none">
    <button type="button" id="importExcel" class="btn btn-secondary col-12 col-md-auto mb-2">Import</button>
</form>
