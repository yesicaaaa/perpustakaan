<table style="border-collapse: collapse;">
  <tr>
    <th style="border: 1px solid; padding: 5px">#</th>
    <th style="border: 1px solid; padding: 5px">Kode</th>
    <th style="border: 1px solid; padding: 5px">Judul</th>
    <th style="border: 1px solid; padding: 5px">Pengarang</th>
    <th style="border: 1px solid; padding: 5px">Stok</th>
    <th style="border: 1px solid; padding: 5px">Created at</th>
  </tr>
  <tbody>
    @foreach($buku as $b)
    <tr>
      <td style="border: 1px solid; padding: 5px">{{$loop->iteration}}</td>
      <td style="border: 1px solid; padding: 5px">BK{{str_pad($b->id_buku, 4, 0, STR_PAD_LEFT)}}</td>
      <td style="border: 1px solid; padding: 5px">{{$b->judul}}</td>
      <td style="border: 1px solid; padding: 5px">{{$b->pengarang}}</td>
      <td style="border: 1px solid; padding: 5px">{{$b->stok}}</td>
      <td style="border: 1px solid; padding: 5px">{{$b->created_at}}</td>
    </tr>
    @endforeach
  </tbody>
</table>