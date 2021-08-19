<table style="border-collapse: collapse;">
  <tr>
    <th style="border: 1px solid; padding: 5px" width="3%">#</th>
    <th style="border: 1px solid; padding: 5px">Kode</th>
    <th style="border: 1px solid; padding: 5px">Judul</th>
    <th style="border: 1px solid; padding: 5px">Pengarang</th>
    <th style="border: 1px solid; padding: 5px">Penerbit</th>
    <th style="border: 1px solid; padding: 5px">Tahun Terbit</th>
    <th style="border: 1px solid; padding: 5px">Bahasa</th>
    <th style="border: 1px solid; padding: 5px">Genre</th>
    <th style="border: 1px solid; padding: 5px">Jumlah Halaman</th>
    <th style="border: 1px solid; padding: 5px">Stok</th>
  </tr>
  <tbody>
    @foreach($buku as $b)
    <tr>
      <td style="border: 1px solid; padding: 5px">{{$loop->iteration}}</td>
      <td style="border: 1px solid; padding: 5px">BK{{str_pad($b->id_buku, 4, '0', STR_PAD_LEFT)}}</td>
      <td style="border: 1px solid; padding: 5px">{{$b->judul}}</td>
      <td style="border: 1px solid; padding: 5px">{{$b->pengarang}}</td>
      <td style="border: 1px solid; padding: 5px">{{$b->penerbit}}</td>
      <td style="border: 1px solid; padding: 5px">{{$b->tahun_terbit}}</td>
      <td style="border: 1px solid; padding: 5px">{{$b->bahasa}}</td>
      <td style="border: 1px solid; padding: 5px">{{$b->genre}}</td>
      <td style="border: 1px solid; padding: 5px">{{$b->jml_halaman}}</td>
      <td style="border: 1px solid; padding: 5px">{{$b->stok}}</td>
    </tr>
    @endforeach
  </tbody>
</table>