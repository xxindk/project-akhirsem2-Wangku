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
      background-color: #F4A261;
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

  <div class="container mx-auto p-4">
<h2 class="h3 fw-semibold text-white mb-4 opacity-100" style="margin-top: 50px;">Jurnal Keuangan Bulanan</h2>       

    <!-- Filter Tahun & Bulan -->
    <div class="filter">
      <form method="GET" action="{{ route('keuangan.bulanan') }}" id="filterForm" style="display: flex; gap: 1rem;">
        <select name="tahun" onchange="document.getElementById('filterForm').submit();">
          @foreach ($tahunList as $thn)
            <option value="{{ $thn }}" {{ $thn == $tahun ? 'selected' : '' }}>{{ $thn }}</option>
          @endforeach
        </select>

        <select name="bulan" onchange="document.getElementById('filterForm').submit();">
          @foreach (range(1, 12) as $i)
            <option value="{{ $i }}" {{ $i == $bulan ? 'selected' : '' }}>
              {{ DateTime::createFromFormat('!m', $i)->format('F') }}
            </option>
          @endforeach
        </select>
      </form>
    </div>

    <!-- Tabel Ringkasan -->
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

    <!-- Grafik -->
    <h2>Grafik Keuangan Bulanan</h2>

    <div class="chart-container">
      <canvas id="chart"></canvas>
    </div>
  </div>

  <!-- Chart.js -->
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
        responsive: true,
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
          },
          title: {
            display: true,
            text: 'Periode: {{ DateTime::createFromFormat("!m", $bulan)->format("F") }} {{ $tahun }}'
          }
        }
      }
    });
  </script>
@endsection
