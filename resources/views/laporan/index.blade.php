@extends('layouts.main')

@section('title', 'Laporan')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Laporan Pendapatan {{ Date::parse($startDate)->format('j F Y') }} s/d {{ Date::parse($endDate)->format('j F Y') }}
                </div>
                <div class="card-body">
                        <a href="{{ route('laporan.periode') }}" class="btn btn-primary mb-3">Ubah Periode</a>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=0;
                                $total=0;
                            @endphp
                            @while (strtotime($startDate) <= strtotime($endDate))
                            @php
                                $no++;
                                $date = $startDate;
                                $startDate = date('Y-m-d', strtotime("+1 day", strtotime($startDate)));
                                $subtotal = $income->income($date);
                                $total = $total+$subtotal;
                            @endphp
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ Date::parse($date)->format('j F Y') }}</td>
                                <td>{{ number_format($income->income($date)) }}</td>
                            </tr>
                            @endwhile
                            <tr>
                                <td colspan="2"><strong>Total Pendapatan</strong></td>
                                <td><strong>{{ number_format($total) }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection