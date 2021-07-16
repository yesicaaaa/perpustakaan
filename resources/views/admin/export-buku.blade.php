<h1>Daftar Buku Fiore Library</h1>
<table>
  <tr>
    <th scope="col">#</th>
    <th scope="col">Kode</th>
    <th scope="col">Judul</th>
    <th scope="col">Pengarang</th>
    <th scope="col">Penerbit</th>
    <th scope="col">Tahun Terbit</th>
    <th scope="col">Bahasa</th>
    <th scope="col">Genre</th>
    <th scope="col">Jumlah Halaman</th>
    <th scope="col">Stok</th>
    <th scope="col">Created at</th>
    <th scope="col">Updated at</th>
  </tr>
  <tbody>
    @foreach($buku as $b)
    <tr>
      <td>{{$loop->iteration}}</td>
      <td>BK{{str_pad($b->id_buku, 4, '0', STR_PAD_LEFT)}}</td>
      <td>{{$b->judul}}</td>
      <td>{{$b->pengarang}}</td>
      <td>{{$b->penerbit}}</td>
      <td>{{$b->tahun_terbit}}</td>
      <td>{{$b->bahasa}}</td>
      <td>{{$b->genre}}</td>
      <td>{{$b->jml_halaman}}</td>
      <td>{{$b->stok}}</td>
      <td>{{$b->created_at}}</td>
      <td>{{$b->updated_at}}</td>
    </tr>
    @endforeach
  </tbody>
</table>