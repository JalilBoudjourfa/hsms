<x-app-layout>

    <x-slot:header>
        {{ strtoupper($classroom->establishmentYear->composed_key) }} > {{ $classroom->classType->name }} >
        Inscriptions
    </x-slot:header>

    <p>
        <a href="{{ route('establishment-years.show', ['establishment_year' => $classroom->establishmentYear->composed_key]) }}"
            class="text-indigo-600 hover:text-indigo-900 flex">
            <x-icons.arrow-left />
            {{ strtoupper($classroom->establishmentYear->composed_key) }}
        </a>
    </p>

    <div class="grid grid-cols-12 gap-6">

        <x-cards.inner-card class="bg-white col-span-6">

            @livewire('table-classroom-registrations', ['classroomId' => $classroom->id])

        </x-cards.inner-card>

        <x-cards.inner-card class="bg-white col-span-6">
            <canvas id="myChart"></canvas>
        </x-cards.inner-card>

    </div>


    {{-- ========================================================================================== --}}
    @php
        $labels = ['min', 'max', 'total', 'accépté', 'en attente', 'refusé'];
        $data = [$classroom->rooms_sum_capacity_min, $classroom->rooms_sum_capacity_max, $classroom->student_registrations_count, $classroom->student_registrations_count_accepted, $classroom->student_registrations_count_pending, $classroom->student_registrations_count_refused];
    @endphp

    {{-- Setting JS variables from PHP --}}
    <script>
        // DATA FROM PHP TO JAVASCRIPT
        const labels = {!! json_encode($labels) !!};
        const data = {!! json_encode($data) !!};
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>

    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels, // <======= Here I set the x-axis
                datasets: [{
                    label: 'Inscriptions',
                    data: data, // <======= Here I set the y-axis
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
                // responsive: true,
                // maintainAspectRatio: false,
            }
        });
    </script>

</x-app-layout>
