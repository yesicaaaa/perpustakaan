<table style="border-collapse: collapse;">
  <tr>
    <th style="border: 1px solid; padding: 2px">#</th>
    <th style="border: 1px solid; padding: 2px">Kode Buku</th>
    <th style="border: 1px solid; padding: 2px">Judul</th>
    <th style="border: 1px solid; padding: 2px">Pengarang</th>
    <th style="border: 1px solid; padding: 2px">Penerbit</th>
    <th style="border: 1px solid; padding: 2px">Tahun Terbit</th>
    <th style="border: 1px solid; padding: 2px">Bahasa</th>
    <th style="border: 1px solid; padding: 2px">Genre</th>
    <th style="border: 1px solid; padding: 2px">Jumlah Halaman</th>
    <th style="border: 1px solid; padding: 2px">Stok</th>
    <!-- <th style="border: 1px solid; padding: 2px">Gambar</th> -->
  </tr>
  <tbody>
    @foreach($buku as $b)
    <tr>
      <td style="border: 1px solid; padding: 2px">{{$loop->iteration}}</td>
      <td style="border: 1px solid; padding: 2px">BK{{str_pad($b->id_buku, 4, '0', STR_PAD_LEFT)}}</td>
      <td style="border: 1px solid; padding: 2px">{{$b->judul}}</td>
      <td style="border: 1px solid; padding: 2px">{{$b->pengarang}}</td>
      <td style="border: 1px solid; padding: 2px">{{$b->penerbit}}</td>
      <td style="border: 1px solid; padding: 2px">{{$b->tahun_terbit}}</td>
      <td style="border: 1px solid; padding: 2px">{{$b->bahasa}}</td>
      <td style="border: 1px solid; padding: 2px">{{$b->genre}}</td>
      <td style="border: 1px solid; padding: 2px">{{$b->jml_halaman}}</td>
      <td style="border: 1px solid; padding: 2px">{{$b->stok}}</td>
      <!-- <td style="border: 1px solid; padding: 2px"><img src="{{asset('/img/buku'). '/' . $b->foto}}" alt="{{$b->foto}}"></td> -->
    </tr>   
    @endforeach
  </tbody>
</table>