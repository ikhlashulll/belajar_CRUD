<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Belajar CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>

    <div class="container mt-5">
      <h2 class="mb-4">Data TPK</h2>
      @session("success")
      <div class="alert alert-success">{{ $value }}</div>
      @endsession
      <a href="{{ route('tpk.create') }}" class="btn btn-success btn-sm mb-3">Tambah TPK</a>
      <table class="table table-bordered table-striped">
        <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Kecamatan</th>
            <th>Kelurahan</th>
            <th>No HP</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($tpks as $index => $tpk)
          <tr>
            <td>{{ $index + 1 }}</td> <!-- No urut -->
            <td>{{ $tpk->NIK }}</td>
            <td>{{ $tpk->nama }}</td>
            <td>{{ $tpk->tanggal_lahir }}</td>
            <td>{{ $tpk->jenis_kelamin }}</td>
            <td>{{ $tpk->kecamatan }}</td>
            <td>{{ $tpk->kelurahan }}</td>
            <td>{{ $tpk->no_hp }}</td>
            <td>
              <a href="{{ route('tpk.edit', $tpk->id) }}" class="btn btn-primary btn-sm">Edit</a>
              <form action="{{ route('tpk.destroy', $tpk->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau hapus?')">Hapus</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
