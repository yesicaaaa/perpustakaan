<table style="border-collapse: collapse;">
  <tr>
    <th style="border: 1px solid; padding: 2px;">#</th>
    <th style="border: 1px solid; padding: 2px;">Tanggal</th>
    <th style="border: 1px solid; padding: 2px;">Buku Dikembalikan</th>
  </tr>
  <tbody>
    @foreach($laporanPengembalian as $lp)
    <tr>
      <td style="border: 1px solid; padding: 2px;">{{$loop->iteration}}</td>
      <td style="border: 1px solid; padding: 2px;">{{$lp->tgl_kembali}}</td>
      <td style="border: 1px solid; padding: 2px;">{{$lp->buku_dikembalikan}} </td>
    </tr>
    @endforeach
  </tbody>
</table>