<table style="border-collapse: collapse;">
  <tr>
    <th style="border: 1px solid; padding: 2px;">#</th>
    <th style="border: 1px solid; padding: 2px;">Kode Pengembalian</th>
    <th style="border: 1px solid; padding: 2px;">Judul</th>
    <th style="border: 1px solid; padding: 2px;">Qty</th>
    <th style="border: 1px solid; padding: 2px;">Harus Kembali</th>
    <th style="border: 1px solid; padding: 2px;">Kembali</th>
    <th style="border: 1px solid; padding: 2px;">Terlambat</th>
    <th style="border: 1px solid; padding: 2px;">Denda</th>
  </tr>
  <tbody>
    @foreach($history as $h)
    <tr>
      <td style="border: 1px solid; padding: 2px;">{{$loop->iteration}}</td>
      <td style="border: 1px solid; padding: 2px;">PGM{{str_pad($h->id_pengembalian, 4, 0, STR_PAD_LEFT)}}</td>
      <td style="border: 1px solid; padding: 2px;">{{$h->judul}} </td>
      <td style="border: 1px solid; padding: 2px;">{{$h->qty}}</td>
      <td style="border: 1px solid; padding: 2px;">{{$h->tgl_hrs_kembali}} </td>
      <td style="border: 1px solid; padding: 2px;">{{$h->tgl_kembali}}</td>
      <td style="border: 1px solid; padding: 2px;">{{($h->terlambat) ? $h->terlambat . ' hari' : '-'}}</td>
      <td style="border: 1px solid; padding: 2px;">{{($h->denda) ? 'Rp' . number_format($h->denda, 0, ',', '.') : '-'}}</td>
    </tr>
    @endforeach
  </tbody>
</table>