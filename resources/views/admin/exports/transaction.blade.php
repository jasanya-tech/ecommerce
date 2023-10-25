<table border="1" style="border-spacing: 0; margin: 0 auto;">
    <thead>
        <tr>
            <th scope="col" style="padding: 0.3rem; text-align: center;">No</th>
            <th scope="col" style="padding: 0.3rem; text-align: left;">Nama</th>
            <th scope="col" style="padding: 0.3rem; text-align: left;">Jenis Kelamin</th>
            <th scope="col" style="padding: 0.3rem; text-align: left;">Negara</th>
            <th scope="col" style="padding: 0.3rem; text-align: left;">Email</th>
            <th scope="col" style="padding: 0.3rem; text-align: left;">Berat Badan</th>
            <th scope="col" style="padding: 0.3rem; text-align: left;">Tinggi Badan</th>
            <th scope="col" style="padding: 0.3rem; text-align: left;">Umur</th>
            <th scope="col" style="padding: 0.3rem; text-align: left;">Tanggal Lahir</th>
            <th scope="col" style="padding: 0.3rem; text-align: left;">Jenis Kegiatan</th>
            <th scope="col" style="padding: 0.3rem; text-align: left;">Tujuan</th>
            <th scope="col" style="padding: 0.3rem; text-align: left;">Tujuan Berat Badan</th>
            <th scope="col" style="padding: 0.3rem; text-align: left;">Kecepatan Tujuan</th>
        </tr>
    </thead>
    <tbody>
        {{-- @forelse ($users as $user)
            <tr>
                <td style="text-align: center; padding: 0.3rem;">{{ $loop->iteration }}</td>
                <td style="padding: 0.3rem;">{{ $user->name }}</td>
                <td style="padding: 0.3rem; text-align: left;">{{ $user->userDetail->gender }}</td>
                <td style="padding: 0.3rem; text-align: left;">{{ $user->userDetail->country->name }}</td>
                <td style="padding: 0.3rem; text-align: left;">{{ $user->email }}</td>
                <td style="padding: 0.3rem; text-align: left;">{{ $user->userDetail->weight }} KG</td>
                <td style="padding: 0.3rem; text-align: left;">{{ $user->userDetail->height }} CM</td>
                <td style="padding: 0.3rem; text-align: left;">{{ $user->userDetail->age }} Tahun</td>
                <td style="padding: 0.3rem; text-align: left;">{{ $user->userDetail->date_of_birth }}</td>
                <td style="padding: 0.3rem; text-align: left;">
                    @if ($user->userDetail->activity_level == '1.20')
                        Jarang sekali
                    @elseif($user->userDetail->activity_level == '1.38')
                        Sedikit aktif
                    @elseif($user->userDetail->activity_level == '1.55')
                        Aktif
                    @elseif($user->userDetail->activity_level == '1.73')
                        Sangat aktif
                    @endif
                </td>
                <td style="padding: 0.3rem; text-align: left;">{{ $user->userDetail->goal }}</td>
                <td style="padding: 0.3rem; text-align: left;">
                    {{ $user->userDetail->weightGoal == null ? '' : $user->userDetail->weightGoal . ' KG' }}</td>
                <td style="padding: 0.3rem; text-align: left;">
                    @if ($user->userDetail->option == null)
                    @else
                        @if ($user->userDetail->option == 1000)
                            Sangat cepat
                        @else
                            Normal
                        @endif
                    @endif

                </td>
            </tr>
        @empty --}}
        <p>data tidak tersedia</p>
        {{-- @endforelse --}}
    </tbody>
</table>
