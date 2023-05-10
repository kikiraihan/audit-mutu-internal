<!DOCTYPE html>
<html>

<head>
    <title>Hi</title>
    <style>
        td,
        tr {
            padding: 5px;
        }
    </style>
</head>

<body>
    <h1>Laporan Audit</h1>
    <table style="min-width: 100%;  border-collapse: collapse; text-align: center" border="1">
        <tbody>
            <tr style="font-weight: bold;">
                <td>Auditee</td>
                <td colspan="2">Standar/Kriteria</td>
            </tr>
            <tr>
                <td>{{$user_auditee->name}}</td>
                <td colspan="2">{{$ami->judul}}</td>
            </tr>
            <tr style="font-weight: bold;">
                <td>Lokasi</td>
                <td>Ruang Lingkup</td>
                <td>Tanggal Audit</td>
            </tr>
            <tr>
                <td>{{$form->lapangan_lokasi}}</td>
                <td>{{$form->ruang_lingkup}}</td>
                <td>{{$form->lapangan_tanggal}}</td>
            </tr>
            <tr style="font-weight: bold;">
                <td>Wakil auditee</td>
                <td>Auditor Ketua</td>
                <td>Auditor Anggota</td>
            </tr>
            <tr>
                <td>{{$form->wakil_auditee}}</td>
                <td>{{$ketuaAuditor->name}}</td>
                <td>
                    @foreach ($timAuditor as $idx=>$item)
                    {{$idx+1}}. {{$item->name}}<br>
                    @endforeach
                </td>
            </tr>
        </tbody>
    </table>

    <h4 style="margin-top: 30pt;">Butir Standar</h4>
    <table style="min-width: 100%;  border-collapse: collapse; text-align: center" border="1">
        <thead>
            <tr>
                <th style="width: 30pt">No</th>
                <th>Uraian</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ami->uraians as $idx=>$item)
            <tr>
                <td>{{$item->nomor}}</td>
                <td style="text-align: left">{{$item->isi}}</td>
            </tr>
            @foreach ($item->suburaians as $idx2=>$item2)
            <tr>
                <td></td>
                {{-- <td style="text-align: right">{{$item2->nomor}}</td> --}}
                <td style="text-align: left">
                    {{$item2->nomor}}. {{$item2->isi}}
                </td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>

    <h4 style="margin-top: 30pt;">Jawaban Auditee</h4>
    <table style="min-width: 100%;  border-collapse: collapse; text-align: center" border="1">
        <thead>
            <tr>
                <th style="width: 30pt">No</th>
                <th style="width: 80pt">Jawaban</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @php $recent=null; @endphp
            @foreach ($jawabanForm as $idx=>$item)
            @if ($item->jawabanable_type=='App\Models\SubUraian')
            @php
            $recent=$item->jawabanable->id_uraian ;
            $uraian=App\Models\Uraian::find($item->jawabanable->id_uraian);
            @endphp
            <tr>
                <td>{{$uraian->nomor}}. {{$item->jawabanable->nomor}}</td>
                <td>{{$item->jawaban}}</td>
                <td style="text-align: left">{{$item->catatan}}</td>
            </tr>
            @else
            <tr>
                <td>{{$item->jawabanable->nomor}}</td>
                <td>{{$item->jawaban}}</td>
                <td style="text-align: left">{{$item->catatan}}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>


    <h4 style="margin-top: 30pt;">Ringkasan kondisi oleh Auditor</h4>
    <table style="min-width: 100%;  border-collapse: collapse; text-align: center" border="1">
        <thead>
            <tr>
                <th style="width: 30pt">No</th>
                <th>Deskripsi</th>
                <th style="width: 80pt">Kategori (OB/KTS)</th>
            </tr>
        </thead>
        <tbody>
            @php $recent=null; @endphp
            @foreach ($jawabanForm as $idx=>$item)
            @if ($item->jawabanable_type=='App\Models\SubUraian')
            @php
            $recent=$item->jawabanable->id_uraian ;
            $uraian=App\Models\Uraian::find($item->jawabanable->id_uraian);
            @endphp
            <tr>
                <td>{{$uraian->nomor}}. {{$item->jawabanable->nomor}}</td>
                <td style="text-align: left">{{$item->deskripsi}}</td>
                <td>{{$item->kts}}</td>
            </tr>
            @else
            <tr>
                <td>{{$item->jawabanable->nomor}}</td>
                <td style="text-align: left">{{$item->deskripsi}}</td>
                <td>{{$item->kts}}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>


    @if ($temuan->isNotEmpty()) <h4 style="margin-top: 30pt;">Deskripsi Temuan Auditee</h4> @endif
    {{-- <table style="min-width: 100%;  border-collapse: collapse; text-align: center; border-bottom: 0pt;" border="1">
        <tbody>
            <tr>
                <td>Auditee</td>
                <td colspan="2">Standar/Kriteria</td>
            </tr>
            <tr>
                <td>prodi kedokteran</td>
                <td colspan="2">Pendidikan</td>
            </tr>
            <tr>
                <td>Lokasi</td>
                <td>Ruang Lingkup</td>
                <td>Tanggal Audit</td>
            </tr>
            <tr>
                <td>...nama...</td>
                <td>...</td>
                <td>...</td>
            </tr>
            <tr>
                <td>Auditor Ketua</td>
                <td colspan="2">Auditor Anggota</td>
            </tr>
            <tr>
                <td>...</td>
                <td colspan="2">
                    1...
                    2...
                    3...
                    dst
                </td>
            </tr>
        </tbody>
    </table> --}}
    @foreach ($temuan as $item)
    <table style="min-width: 100%;  border-collapse: collapse; text-align: left; margin-top: 20pt;" border="1">
        <tbody>
            <tr>
                <td style="width: 100pt; font-weight: bold;">Deskripsi</td>
                <td colspan="3">{{$item->deskripsi}}</td>
            </tr>
            <tr>
                <td style="width: 100pt; font-weight: bold;">Kriteria</td>
                <td colspan="3">{{$ami->judul}}</td>
            </tr>
            <tr>
                <td style="width: 100pt; font-weight: bold;">Akar Penyebab</td>
                <td colspan="3">{{$item->deskripsiTemuan->akar_penyebab}}</td>
            </tr>
            <tr>
                <td style="width: 100pt; font-weight: bold;">Akibat</td>
                <td colspan="3">{{$item->deskripsiTemuan->akibat}}</td>
            </tr>
            <tr>
                <td style="width: 100pt; font-weight: bold;">Rekomendasi</td>
                <td colspan="3">{{$item->deskripsiTemuan->rekomendasi}}</td>
            </tr>
            <tr>
                <td style="width: 100pt; font-weight: bold;">Tanggapan Auditi</td>
                <td colspan="3">{{$item->deskripsiTemuan->tanggapan_auditee}}</td>
            </tr>
            <tr>
                <td style="width: 100pt; font-weight: bold;">Rencana Perbaikan</td>
                <td colspan="3">{{$item->deskripsiTemuan->rencana_perbaikan}}</td>
            </tr>
            <tr>
                <td style="width: 100pt; font-weight: bold;">Jadwal Perbaikan</td>
                <td>{{$item->deskripsiTemuan->jadwal_perbaikan}}</td>
                <td style="width: 100pt; font-weight: bold;">Penanggung jawab</td>
                <td>{{$item->deskripsiTemuan->pj_perbaikan}}</td>
            </tr>
            <tr>
                <td style="width: 100pt; font-weight: bold;">Rencana Pencegahan</td>
                <td colspan="3">{{$item->deskripsiTemuan->rencana_pencegahan}}</td>
            </tr>
            <tr>
                <td style="width: 100pt; font-weight: bold;">Jedwal Pencegahan</td>
                <td>{{$item->deskripsiTemuan->pj_pencegahan}}</td>
                <td style="width: 100pt; font-weight: bold;">Penanggung jawab</td>
                <td>{{$item->deskripsiTemuan->jadwal_pencegahan}}</td>
            </tr>
        </tbody>
    </table>

    @endforeach

    <table style="min-width: 100%;  border-collapse: collapse; text-align: center; border-bottom: 0pt; margin-top: 20pt"
        border="1">
        <tbody>
            <tr>
                <td style="font-weight: bold;">Pimpinan Auditee</td>
                <td>{{$form->wakil_auditee}}</td>
                <td style="width: 100pt; height: 40pt"></td>
                <td style="font-weight: bold;">Ketua Auditor</td>
                <td>{{$ketuaAuditor->name}}</td>
                <td style="width: 100pt; height: 40pt"></td>
            </tr>
            <tr>
                <td style="font-weight: bold;" colspan="6">Direview Oleh:</td>
            </tr>
            <tr>
                <td style="font-weight: bold;" colspan="2">Penjamin Mutu</td>
                <td colspan="2">{{$form->di_review_oleh}}</td>
                <td colspan="2" style="width: 100pt; height: 40pt"></td>
            </tr>
        </tbody>
    </table>

</body>

</html>