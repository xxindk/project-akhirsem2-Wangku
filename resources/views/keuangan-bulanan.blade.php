@extends('layouts.appgreen')

@section('content')
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    h2 {
      color: white;
      margin-bottom: 1rem;
    }

    .filter {
      display: flex;
      gap: 1rem;
      margin-bottom: 1rem;
    }

    select {
      padding: 0.5rem;
      border-radius: 6px;
      border: none;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 2rem;
      background-color: white;
      border-radius: 8px;
      overflow: hidden;
    }

    thead {
      background-color: #f4a340;
      color: white;
    }

    th, td {
      padding: 1rem;
      text-align: center;
    }

    .chart-container {
      background-color: white;
      padding: 2rem;
      border-radius: 8px;
    }
  </style>

  <div class="container py-4">
<h2 class="h3 fw-semibold text-white mb-4 mt-4 opacity-100">Jurnal Keuangan Bulanan</h2>       

    <div class="filter">
      <form method="GET" action="{{ route('keuangan.bulanan') }}" id="filterForm" style="display: flex; gap: 1rem;">
        <select name="tahun" onchange="document.getElementById('filterForm').submit();">
          @foreach ($tahunList as $thn)
            <option value="{{ $thn }}" {{ $thn == $tahun ? 'selected' : '' }}>{{ $thn }}</option>
          @endforeach
        </select>

        <select name="bulan" onchange="document.getElementById('filterForm').submit();">
          @foreach ($bulanList as $bln)
            <option value="{{ $bln }}" {{ $bln == $bulan ? 'selected' : '' }}>{{ $bln }}</option>
          @endforeach
        </select>
      </form>
    </div>

    <table>
      <thead>
        <tr>
          <th>Jenis</th>
          <th>Nominal</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Pengeluaran</td>
          <td>Rp {{ number_format($pengeluaran, 0, ',', '.') }},-</td>
        </tr>
        <tr>
          <td>Pemasukan</td>
          <td>Rp {{ number_format($pemasukan, 0, ',', '.') }},-</td>
        </tr>
      </tbody>
    </table>

<h2 class="h3 fw-semibold text-white mb-4 mt-4 opacity-100">Grafik Keuangan Bulanan</h2>       

    <div class="chart-container">
      <canvas id="chart"></canvas>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const ctx = document.getElementById('chart').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Pengeluaran', 'Pemasukan'],
        datasets: [{
          label: 'Jumlah (juta)',
          data: [{{ $pengeluaran / 1000000 }}, {{ $pemasukan / 1000000 }}],
          backgroundColor: ['#e74c3c', '#27ae60']
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              stepSize: 5
            }
          }
        },
        plugins: {
          legend: {
            display: false
          }
        }
      }
    });
  </script>
@endsection
