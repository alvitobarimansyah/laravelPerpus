  @php
    $no = 1;
    $ar_judul = ['No', 'Kategori'];
  @endphp
      <h6 align="center"> Daftar Kategori </h6>
        <table border="1" width="100%" cellspacing="0">
          <thead>
            <tr>
              @foreach ($ar_judul as $jdl)
                <th> {{ $jdl }} </th>
              @endforeach 
            </tr>
          </thead>
          <tbody>
            @foreach ($ar_kategori as $kategori)
              <tr>
                <td> {{ $no++ }} </td>
                <td> {{ $kategori->nama }} </td>
              </tr>
            @endforeach
          </tbody>
        </table>