<table style="border-collapse: collapse;">
  <tr>
    <th style="border: 1px solid; padding: 2px;">#</th>
    <th style="border: 1px solid; padding: 2px;">Kode Pengembalian</th>
    <th style="border: 1px solid; padding: 2px;">Pengembalian</th>
    <th style="border: 1px solid; padding: 2px;">Terlambat</th>
    <th style="border: 1px solid; padding: 2px;">Denda</th>
    <th style="border: 1px solid; padding: 2px;">Petugas</th>
  </tr>
  <tbody>
    @foreach($denda as $d)
    <tr>
      <td style="border: 1px solid; padding: 2px;">{{$loop->iteration}}</td>
      <td style="border: 1px solid; padding: 2px;">PGM{{str_pad($d->id_pengembalian, 4, 0, STR_PAD_LEFT)}}</td>
      <td style="border: 1px solid; padding: 2px;">{{$d->tgl_kembali}} </td>
      <td style="border: 1px solid; padding: 2px;">{{($d->terlambat) ? $d->terlambat . ' hari' : '-'}}</td>
      <td style="border: 1px solid; padding: 2px;">{{($d->denda) ? 'Rp' . number_format($d->denda, 0, ',', '.') : '-'}}</td>
      <td style="border: 1px solid; padding: 2px;">{{$d->name}}</td>
    </tr>
    @endforeach
  </tbody>
</table>