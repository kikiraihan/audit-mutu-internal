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
                labels: ['{!! implode("', '",$pie_auditee["categories"]) !!}'
                ],
                datasets: [{
                    label: '# of Votes',
                    data: [{!!implode(", ", $pie_auditee['rowCounts']) !!}],
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
        const labels = ['{!! implode("', '",$line_form_ami["bulan"]) !!}'
        ];
        const data = {
            labels: labels,
            datasets: [{
                label: 'Jumlah form ami per bulan',
                data: [{!!implode(", ", $line_form_ami['rowCounts']) !!}],
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

        // line_kts
        const chart_line_KTS = document.getElementById('chart_line_KTS');
        const labels_line_KTS = ['{!! implode("', '",$line_kts["group"]) !!}'];
        const data_line_KTS = {
            labels: labels_line_KTS,
            datasets: [
                {
                    label: 'Jumlah KTS',
                    data: [{!!implode(", ", $line_kts['counts_kts']) !!}],
                    fill: false,
                    borderColor: 'rgb(227, 134, 142)',
                    tension: 0.1
                },
                {
                    label: 'Jumlah OB',
                    data: [{!!implode(", ", $line_kts['counts_ob']) !!}],
                    fill: false,
                    borderColor: 'rgb(110, 192, 75)',
                    tension: 0.1
                },
                {
                    label: 'Jumlah Belum',
                    data: [{!!implode(", ", $line_kts['counts_belum']) !!}],
                    fill: false,
                    borderColor: 'rgb(227, 220, 221)',
                    tension: 0.1
                },
            ]
        };
        new Chart(chart_line_KTS, {
            type: 'line',
            data: data_line_KTS,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        // line_KTS_per_audite
        const chart_line_KTS_per_audite = document.getElementById('chart_line_KTS_per_audite');
        const labels_line_KTS_per_audite = ['{!! implode("', '",$line_kts_per_audite["name"]) !!}'];
        const data_line_KTS_per_audite = {
            labels: labels_line_KTS_per_audite,
            datasets: [
                {
                    label: 'Jumlah KTS',
                    data: [{!!implode(", ", $line_kts_per_audite['jumlah_kts']) !!}],
                    fill: false,
                    backgroundColor: 'rgb(227, 134, 142)',
                    tension: 0.1
                },
                {
                    label: 'Jumlah OB',
                    data: [{!!implode(", ", $line_kts_per_audite['jumlah_ob']) !!}],
                    fill: false,
                    backgroundColor: 'rgb(110, 192, 75)',
                    tension: 0.1
                },
                {
                    label: 'Jumlah Belum',
                    data: [{!!implode(", ", $line_kts_per_audite['jumlah_belum']) !!}],
                    fill: false,
                    backgroundColor: 'rgb(227, 220, 221)',
                    tension: 0.1
                },
            ]
        };
        new Chart(chart_line_KTS_per_audite, {
            type: 'bar',
            data: data_line_KTS_per_audite,
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

<div class="w-full grid grid-flow-row lg:grid-cols-4 gap-6">


    <div class="flex flex-col items-center col-span-2">
        <div>
            Aktivitas Form Audit
        </div>
        <canvas id="chart_line_form_audit"></canvas>
    </div>

    <div class="flex flex-col items-center col-span-2">
        <div>
            Hasil AMI Per Semester Tahun {{$line_kts['currentYear']}}
        </div>
        <canvas id="chart_line_KTS"></canvas>
    </div>

    <div class="flex flex-col items-center col-span-2">
        <div> Hasil AMI Per Auditee Tahun {{$line_kts['currentYear']}}
    </div>
    <canvas id="chart_line_KTS_per_audite"></canvas>
    </div>

<div class="flex flex-col items-center">
    <div>
        Auditee per tipe
    </div>
    <canvas id="chart_pie_auditee"></canvas>
</div>
</div>
