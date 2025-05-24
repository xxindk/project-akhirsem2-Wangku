<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Keuangan Bulanan - WangKu</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(140deg, #5e8c94, #b1c6c8);
      color: #333;
      padding: 2rem;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 2rem;
    }

    .logo {
      display: flex;
      align-items: center;
    }

    .logo img {
      height: 30px;
      margin-right: 0.5rem;
    }

    .user-info {
      color: white;
      font-size: 0.9rem;
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
      text-align: left;
    }

    .chart-container {
      background-color: white;
      padding: 2rem;
      border-radius: 8px;
    }
  </style>
</head>
<body>
  <header>
    <div class="logo">
      <img src="/images/lightlogoandfont.png" alt="WangKu Logo" />
    </div>
    <div class="user-info">
      Hello, User!
    </div>
  </header>

  <h2>Keuangan Bulanan</h2>

  <div class="filter">
    <select>
      <option>Tahun</option>
      <option>2025</option>
    </select>
    <select>
      <option>Bulan</option>
      <option>Mei</option>
    </select>
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
        <td>Rp 7.300.000,-</td>
      </tr>
      <tr>
        <td>Pemasukan</td>
        <td>Rp 16.900.000,-</td>
      </tr>
    </tbody>
  </table>

  <h2>Grafik Keuangan Bulanan</h2>

  <div class="chart-container">
    <canvas id="chart"></canvas>
  </div>

  <script>
    const ctx = document.getElementById('chart').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Pengeluaran', 'Pemasukan'],
        datasets: [{
          label: 'Jumlah (juta)',
          data: [7.3, 16.9],
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
</body>
</html>
