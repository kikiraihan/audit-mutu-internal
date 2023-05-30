<x-slot name="stylehalaman">
    @livewireStyles
</x-slot>

<x-slot name="scripthalaman">
    @livewireScripts
    @include('layouts.scriptsweetalert')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      const chart_pie_auditee = document.getElementById('chart_pie_auditee');
      new Chart(chart_pie_auditee, {
        type: 'doughnut',
        data: {
          labels: [ '{!! implode("', '",$pie_auditee['categories']) !!}' ],
          datasets: [{
            label: '# of Votes',
            data: [ {!! implode(", ",$pie_auditee['rowCounts']) !!} ],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });

      // line_form_ami

      const chart_line_form_audit = document.getElementById('chart_line_form_audit');
      const labels = [ '{!! implode("', '",$line_form_ami['bulan']) !!}' ];
      const data = {
        labels: labels,
        datasets: [{
          label: 'Jumlah form ami per bulan',
          data: [ {!! implode(", ",$line_form_ami['rowCounts']) !!} ],
          fill: false,
          borderColor: 'rgb(75, 192, 192)',
          tension: 0.1
        }]
      };
      new Chart(chart_line_form_audit, {
        type: 'line',
        data: data,
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    </script>
</x-slot>

<div class="w-full overflow-x-hidden flex flex-row p-3 gap-6">
  <div class="w-1/3 flex flex-col items-center">
    <div>
      Auditee per tipe
    </div>
    <canvas id="chart_pie_auditee"></canvas>
  </div>

  <div class="w-2/3 flex flex-col items-center">
    <div>
      Aktivitas Form Audit
    </div>
    <canvas id="chart_line_form_audit"></canvas>
  </div>
</div>