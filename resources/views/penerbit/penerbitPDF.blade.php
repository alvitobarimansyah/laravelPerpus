@php
    $no = 1;
    $ar_judul = ['No', 'Penerbit', 'Alamat', 'Email'];
@endphp
      <h6 align="center"> Daftar Penerbit </h6>
        <table border="1" width="100%" cellspacing="0">
            <thead>
                <tr>
                @foreach ($ar_judul as $jdl)
                    <th> {{ $jdl }} </th>
                @endforeach 
                </tr>
            </thead>
            <tbody>
                @foreach ($ar_penerbit as $penerbit)
                <tr>
                    <td> {{ $no++ }} </td>
                    <td> {{ $penerbit->nama }} </td>
                    <td> {{ $penerbit->alamat }} </td>
                    <td> {{ $penerbit->email }} </td>
                </tr>
                @endforeach
            </tbody>
        </table>