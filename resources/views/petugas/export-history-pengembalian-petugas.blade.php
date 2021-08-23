<table style="border-collapse: collapse;">
  <tr>
    <th style="border: 1px solid; padding: 5px">#</th>
    <th style="border: 1px solid; padding: 5px">Kode</th>
    <th style="border: 1px solid; padding: 5px">Nama</th>
    <th style="border: 1px solid; padding: 5px">Harus Kembali</th>
    <th style="border: 1px solid; padding: 5px">Pengembalian</th>
    <th style="border: 1px solid; padding: 5px">Terlambat</th>
    <th style="border: 1px solid; padding: 5px">Denda</th>
  </tr>
  <tbody>
    @foreach($pengembalian as $p)
    <tr>
      <td style="border: 1px solid; padding: 5px">{{$loop->iteration}}</td>
      <td style="border: 1px solid; padding: 5px">PMJ{{str_pad($p->id_peminjaman, 4, 0, STR_PAD_LEFT)}}</td>
      <td style="border: 1px solid; padding: 5px">{{$p->name}}</td>
      <td style="border: 1px solid; padding: 5px">{{$p->tgl_hrs_kembali}}</td>
      <td style="border: 1px solid; padding: 5px">{{$p->tgl_kembali}}</td>
      <td style="border: 1px solid; padding: 5px">{{($p->terlambat) ? $p->terlambat . ' hari' : '-'}}</td>
      <td style="border: 1px solid; padding: 5px">Rp{{number_format($p->denda, 0, ',', '.')}}</td>
    </tr>
    @endforeach
  </tbody>
</table>