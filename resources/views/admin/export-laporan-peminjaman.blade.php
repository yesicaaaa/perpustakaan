<table style="border-collapse: collapse;">
  <tr>
    <th style="border: 1px solid; padding: 2px">#</th>
    <th style="border: 1px solid; padding: 2px">Tanggal</th>
    <th style="border: 1px solid; padding: 2px">Buku Dipinjam</th>
  </tr>
  <tbody>
    @foreach($laporanPeminjaman as $lp)
    <tr>
      <td style="border: 1px solid; padding:2px;">{{$loop->iteration}}</td>
      <td style="border: 1px solid; padding:2px;">{{$lp->tgl_pinjam}}</td>
      <td style="border: 1px solid; padding:2px;">{{$lp->buku_dipinjam}} buah</td>
    </tr>
    @endforeach
  </tbody>
</table>