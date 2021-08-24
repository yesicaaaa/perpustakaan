<table style="border-collapse: collapse;">
  <tr>
    <th style="border: 1px solid; padding: 2px">#</th>
    <th style="border: 1px solid; padding: 2px">Kode Pengembalian</th>
    <th style="border: 1px solid; padding: 2px">Nama</th>
    <th style="border: 1px solid; padding: 2px">Judul</th>
    <th style="border: 1px solid; padding: 2px">Jumlah</th>
    <th style="border: 1px solid; padding: 2px">Perpanjangan</th>
    <th style="border: 1px solid; padding: 2px">harus Kembali</th>
    <th style="border: 1px solid; padding: 2px">Kembali</th>
    <th style="border: 1px solid; padding: 2px">Terlambat</th>
    <th style="border: 1px solid; padding: 2px">Denda</th>
  </tr>
  <tbody>
    @foreach($detailLaporan as $dl)
    <tr>
      <td style="border: 1px solid; padding: 2px">{{$loop->iteration}}</td>
      <td style="border: 1px solid; padding: 2px">PMG{{str_pad($dl->id_pengembalian, 4, 0, STR_PAD_LEFT)}}</td>
      <td style="border: 1px solid; padding: 2px">{{$dl->name}}</td>
      <td style="border: 1px solid; padding: 2px">{{$dl->judul}}</td>
      <td style="border: 1px solid; padding: 2px">{{$dl->qty}}</td>
      <td style="border: 1px solid; padding: 2px">{{($dl->perpanjang_pinjam) ? $dl->perpanjang_pinjam . ' hari' : '-'}}</td>
      <td style="border: 1px solid; padding: 2px">{{$dl->tgl_hrs_kembali}}</td>
      <td style="border: 1px solid; padding: 2px">{{$dl->tgl_kembali}}</td>
      <td style="border: 1px solid; padding: 2px">{{($dl->terlambat) ? $dl->terlambat . ' hari' : '-'}}</td>
      <td style="border: 1px solid; padding: 2px">{{($dl->denda) ? 'Rp' . number_format($dl->denda, 0 , ',', '.') : '-'}}</td>
    </tr>
    @endforeach
  </tbody>
</table>