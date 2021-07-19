<h1>Data anggota Fiore Library</h1>
<table>
  <tr>
    <th scope="col">#</th>
    <th scope="col">Nama Lengkap</th>
    <th scope="col">Email</th>
    <th scope="col">No. Telepon</th>
    <th scope="col">Alamat</th>
    <th scope="col">Role</th>
    <th scope="col">Created at</th>
    <th scope="col">Updated at</th>
  </tr>
  <tbody>
    @foreach($anggota as $a)
    <tr>
      <td>{{$loop->iteration}}</td>
      <td>{{$a->name}}</td>
      <td>{{$a->email}}</td>
      <td>{{$a->phone}}</td>
      <td>{{$a->alamat}}</td>
      <td>{{$a->display_name}}</td>
      <td>{{$a->created_at}}</td>
      @if($a->updated_at)
      <td>{{$a->updated_at}}</td>
      @else
      <td>-</td>
      @endif
    </tr>
    @endforeach
  </tbody>
</table>