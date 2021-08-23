<table style="border-collapse: collapse;">
  <tr>
    <th style="border: 1px solid; padding: 5px">#</th>
    <th style="border: 1px solid; padding: 5px">Nama</th>
    <th style="border: 1px solid; padding: 5px">Email</th>
    <th style="border: 1px solid; padding: 5px">Created at</th>
  </tr>
  <tbody>
    @foreach($anggota as $a)
    <tr>
      <td style="border: 1px solid; padding: 5px">{{$loop->iteration}}</td>
      <td style="border: 1px solid; padding: 5px">{{$a->name}}</td>
      <td style="border: 1px solid; padding: 5px">{{$a->email}}</td>
      <td style="border: 1px solid; padding: 5px">{{$a->created_at}}</td>
    </tr>
    @endforeach
  </tbody>
</table>