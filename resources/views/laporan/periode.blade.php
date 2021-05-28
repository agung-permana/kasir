@extends('layouts.main')

@section('title', 'Pilih Periode')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>Ubah Periode</strong>
                </div>
                <div class="card-body">
                    <form action="{{ route('laporan.periode') }}" method="GET">
                    <div class="form-group">
                        <label class="sr-only">Pilih Periode</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-calendar"></i>
                            </div>
                            </div>
                            <input type="text" class="form-control" id="daterange" name="daterange">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if (!empty($startDate))
        <div class="row mt-3">
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
    @endif
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

@push('scripts')
    
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    $(function() {
        $('#daterange').daterangepicker({
            locale:{
                format: 'YYYY-MM-DD'
            }
        })
    });
</script>
@endpush