<table>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Kode</th>
      <th scope="col">Judul</th>
      <th scope="col">Stok</th>
    </tr>
  <tbody>
    @foreach($buku as $b)
    <tr>
      <td>{{$loop->iteration}}</td>
      <td>BK{{str_pad($b->id_buku, 4, '0', STR_PAD_LEFT)}}</td>
      <td>{{$b->judul}}</td>
      <td>{{$b->stok}}</td>
    </tr>
    @endforeach
  </tbody>
</table>