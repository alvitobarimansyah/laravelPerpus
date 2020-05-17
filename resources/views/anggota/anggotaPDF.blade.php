  @php
    $no = 1;
    $ar_judul = ['No', 'No Anggota', 'Nama',                                                                                
                'Email', 'Foto'];
  @endphp
      <h6 align="center"> Daftar Anggota </h6>
        <table border="1" width="100%" cellspacing="0">
          <thead>
            <tr>
            @foreach ($ar_judul as $jdl)
              <th> {{ $jdl }} </th>
            @endforeach 
            </tr>
          </thead>
          <tbody>
            @foreach ($ar_anggota as $anggota)
              <tr>
                <td> {{ $no++ }} </td>
                <td> {{ $anggota->no_anggota }} </td>
                <td> {{ $anggota->nama }} </td>
                <td> {{ $anggota->email }} </td>
                @if(!empty($anggota->foto))
                <td><img src="{{asset('img/anggota')}}/{{ $anggota->foto }}" height="10%" /></td>
                @else
                <td><img src="{{asset('img')}}/nophoto.png" height="10%" /></td>
                @endif
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>