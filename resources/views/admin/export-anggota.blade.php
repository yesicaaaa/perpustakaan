<table style="border-collapse: collapse;">
  <tr>
    <th style="border: 1px solid; padding: 2px;">#</th>
    <th style="border: 1px solid; padding: 2px;">Nama Lengkap</th>
    <th style="border: 1px solid; padding: 2px;">Email</th>
    <th style="border: 1px solid; padding: 2px;">No. Telepon</th>
    <th style="border: 1px solid; padding: 2px;">Alamat</th>
    <th style="border: 1px solid; padding: 2px;">Role</th>
    <th style="border: 1px solid; padding: 2px;">Created at</th>
  </tr>
  <tbody>
    @foreach($anggota as $a)
    <tr>
      <td style="border: 1px solid; padding: 2px;">{{$loop->iteration}}</td>
      <td style="border: 1px solid; padding: 2px;">{{$a->name}}</td>
      <td style="border: 1px solid; padding: 2px;">{{$a->email}}</td>
      <td style="border: 1px solid; padding: 2px;">{{$a->phone}}</td>
      <td style="border: 1px solid; padding: 2px;">{{$a->alamat}}</td>
      <td style="border: 1px solid; padding: 2px;">{{$a->display_name}}</td>
      <td style="border: 1px solid; padding: 2px;">{{$a->created_at}}</td>
    </tr>
    @endforeach
  </tbody>
</table>