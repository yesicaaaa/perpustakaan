<table style="border-collapse: collapse;">
  <tr>
    <th style="border: 1px solid; padding:2px">#</th>
    <th style="border: 1px solid; padding:2px">Nama Lengkap</th>
    <th style="border: 1px solid; padding:2px">Email</th>
    <th style="border: 1px solid; padding:2px">No. Telepon</th>
    <th style="border: 1px solid; padding:2px">Alamat</th>
    <th style="border: 1px solid; padding:2px">Role</th>
    <th style="border: 1px solid; padding:2px">Created_at</th>
  </tr>
  <tbody>
    @foreach($petugas as $p)
    <tr>
      <td style="border: 1px solid; padding:2px">{{$loop->iteration}}</td>
      <td style="border: 1px solid; padding:2px">{{$p->name}}</td>
      <td style="border: 1px solid; padding:2px">{{$p->email}}</td>
      <td style="border: 1px solid; padding:2px">{{$p->phone}}</td>
      <td style="border: 1px solid; padding:2px">{{$p->alamat}}</td>
      <td style="border: 1px solid; padding:2px">{{$p->display_name}}</td>
      <td style="border: 1px solid; padding:2px">{{$p->created_at}}</td>
    </tr>
    @endforeach
  </tbody>
</table>