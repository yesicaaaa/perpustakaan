<table style="border-collapse: collapse;">
  <tr>
    <th style="border: 1px solid; padding: 5px">#</th>
    <th style="border: 1px solid; padding: 5px">Kode</th>
    <th style="border: 1px solid; padding: 5px">Nama</th>
    <th style="border: 1px solid; padding: 5px">Judul</th>
    <th style="border: 1px solid; padding: 5px">Qty</th>
    <th style="border: 1px solid; padding: 5px">Peminjaman</th>
    <th style="border: 1px solid; padding: 5px">Perpanjangan</th>
    <th style="border: 1px solid; padding: 5px">Harus Kembali</th>
  </tr>
  <tbody>
    @foreach($pengembalian as $p)
    <tr>
      <td style="border: 1px solid; padding: 5px">{{$loop->iteration}}</td>
      <td style="border: 1px solid; padding: 5px">PMJ{{str_pad($p->id_peminjaman, 4, 0, STR_PAD_LEFT)}}</td>
      <td style="border: 1px solid; padding: 5px">{{$p->name}}</td>
      <td style="border: 1px solid; padding: 5px">{{$p->judul}}</td>
      <td style="border: 1px solid; padding: 5px">{{$p->qty}}</td>
      <td style="border: 1px solid; padding: 5px">{{$p->tgl_pinjam}}</td>
      <td style="border: 1px solid; padding: 5px">{{($p->perpanjang_pinjam) ? $p->perpanjang_pinjam . ' hari' : '-'}}</td>
      <td style="border: 1px solid; padding: 5px">{{$p->tgl_hrs_kembali}}</td>
    </tr>
    @endforeach
  </tbody>
</table>