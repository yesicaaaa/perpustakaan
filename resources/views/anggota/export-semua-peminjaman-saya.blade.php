<table style="border-collapse: collapse;">
  <tr>
    <th style="border: 1px solid; padding: 2px;">#</th>
    <th style="border: 1px solid; padding: 2px;">Kode Peminjaman</th>
    <th style="border: 1px solid; padding: 2px;">Judul</th>
    <th style="border: 1px solid; padding: 2px;">Qty</th>
    <th style="border: 1px solid; padding: 2px;">Peminjaman</th>
    <th style="border: 1px solid; padding: 2px;">Status</th>
  </tr>
  <tbody>
    @foreach($peminjaman as $p)
    <tr>
      <td style="border: 1px solid; padding: 2px;">{{$loop->iteration}}</td>
      <td style="border: 1px solid; padding: 2px;">PMJ{{str_pad($p->id_peminjaman, 4, 0, STR_PAD_LEFT)}}</td>
      <td style="border: 1px solid; padding: 2px;">{{$p->judul}} </td>
      <td style="border: 1px solid; padding: 2px;">{{$p->qty}}</td>
      <td style="border: 1px solid; padding: 2px;">{{$p->tgl_pinjam}}</td>
      <td style="border: 1px solid; padding: 2px;">{{$p->status}} </td>
    </tr>
    @endforeach
  </tbody>
</table>