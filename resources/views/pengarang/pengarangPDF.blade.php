@php
    $no = 1;
    $ar_judul = ['No', 'Pengarang', 'Email', 'No.Hp', 'Foto'];
@endphp
      <h6 align="center"> Daftar Pengarang </h6>
        <table border="1" width="100%" cellspacing="0">
            <thead>
                <tr>
                @foreach ($ar_judul as $jdl)
                    <th> {{ $jdl }} </th>
                @endforeach 
                </tr>
            </thead>
            <tbody>
                @foreach ($ar_pengarang as $pengarang)
                <tr>
                    <td> {{ $no++ }} </td>
                    <td> {{ $pengarang->nama }} </td>
                    <td> {{ $pengarang->email }} </td>
                    <td> {{ $pengarang->hp }} </td>
                    @if(!empty($pengarang->foto))
                    <td><img src="{{asset('img/pengarang')}}/{{ $pengarang->foto }}" height="20%" /></td>
                    @else
                    <td><img src="{{asset('img')}}/nophoto.png" height="20%" /></td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>