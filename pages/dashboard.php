<div class="page-header">
  <h1>Dashboard</h1>
  <p class="muted">Overview of your business · <?= date('l, F j, Y') ?></p>
</div>

<section class="kpi-grid">
  <div class="kpi-card">
    <div class="kpi-label">Today's Sales</div>
    <div class="kpi-value">₦248,500</div>
    <div class="kpi-trend up"><i class="fa-solid fa-arrow-up"></i> 12.4%</div>
  </div>
  <div class="kpi-card warn">
    <div class="kpi-label">Unpaid Invoices</div>
    <div class="kpi-value">14</div>
    <div class="kpi-trend"><i class="fa-solid fa-minus"></i> 0%</div>
  </div>
  <div class="kpi-card danger">
    <div class="kpi-label">Low Stock</div>
    <div class="kpi-value">3</div>
    <div class="kpi-trend down"><i class="fa-solid fa-arrow-down"></i> 2 items</div>
  </div>
  <div class="kpi-card info">
    <div class="kpi-label">Pending POs</div>
    <div class="kpi-value">7</div>
    <div class="kpi-trend up"><i class="fa-solid fa-arrow-up"></i> 3</div>
  </div>
</section>

<section class="card">
  <h3>Recent Transactions</h3>
  <table class="data-table">
    <thead><tr><th>Invoice</th><th>Customer</th><th>Amount</th><th>Status</th><th>Date</th></tr></thead>
    <tbody>
      <tr><td>INV-1024</td><td>Acme Ltd</td><td>₦45,200</td><td><span class="badge paid">Paid</span></td><td>Nov 18, 09:12</td></tr>
      <tr><td>INV-1023</td><td>Beta Co</td><td>₦12,900</td><td><span class="badge unpaid">Unpaid</span></td><td>Nov 17, 15:40</td></tr>
      <tr><td>INV-1022</td><td>Gamma Inc</td><td>₦88,000</td><td><span class="badge partial">Partial</span></td><td>Nov 17, 11:02</td></tr>
    </tbody>
  </table>
</section>