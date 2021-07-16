<h1>Data Petugas Fiore Library</h1>
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
    @foreach($petugas as $p)
    <tr>
      <td>{{$loop->iteration}}</td>
      <td>{{$p->name}}</td>
      <td>{{$p->email}}</td>
      <td>{{$p->phone}}</td>
      <td>{{$p->alamat}}</td>
      <td>{{$p->display_name}}</td>
      <td>{{$p->created_at}}</td>
      <td>{{$p->updated_at}}</td>
    </tr>
    @endforeach
  </tbody>
</table>