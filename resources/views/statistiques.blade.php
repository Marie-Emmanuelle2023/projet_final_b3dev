<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        @include('components.navbar-coordi')
        <main class="flex-1 p-8">
            <div class="container mx-auto px-6 py-8">
                <h1 class="text-2xl font-bold mb-6">Statistiques de présence</h1>

                <!-- Graphe 1 : Taux de présence par étudiant -->
                <div class="mb-10">
                    <h2 class="text-xl font-semibold mb-4">Taux de présence par étudiant</h2>
                    <canvas id="etudiantsChart" height="100"></canvas>
                </div>

                <!-- Graphe 2 : Taux de présence par classe -->
                <div class="mb-10">
                    <h2 class="text-xl font-semibold mb-4">Taux de présence par classe</h2>
                    <canvas id="classesChart" height="100"></canvas>
                </div>

                <!-- Graphe 3 : Taux de présence par niveau -->
                <div class="mb-10">
                    <h2 class="text-xl font-semibold mb-4">Taux de présence par niveau</h2>
                    <canvas id="niveauxChart" height="100"></canvas>
                </div>

                <!-- Graphe 4 : Volume de cours par type -->
                <div class="mb-10">
                    <h2 class="text-xl font-semibold mb-4">Volume de cours par type</h2>
                    <canvas id="typeCoursChart" height="100"></canvas>
                </div>

                <!-- Graphe 5 : Volume cumulé par trimestre et niveau -->
                <div class="mb-10">
                    <h2 class="text-xl font-semibold mb-4">Volume de cours par trimestre et niveau</h2>
                    <canvas id="volumeCumulChart" height="100"></canvas>
                </div>
            </div>
        </main>
    </div>

    <!-- Chart.js -->
    

    <script>
        // Graphe 1 : Taux de présence par étudiant avec couleurs dynamiques
        fetch("{{ route('statistiques.etudiants') }}")
            .then(res => res.json())
            .then(data => {
                const ctx = document.getElementById('etudiantsChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.map(d => d.etudiant),
                        datasets: [{
                            label: 'Taux (%)',
                            data: data.map(d => d.taux),
                            backgroundColor: data.map(d => d.color),
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            },
                            title: {
                                display: false
                            }
                        }
                    }
                });
            });

        // Graphe 2 : Taux de présence par classe
        fetch("{{ route('statistiques.classes') }}")
            .then(res => res.json())
            .then(data => {
                const ctx = document.getElementById('classesChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.map(d => d.classe),
                        datasets: [{
                            label: 'Taux (%)',
                            data: data.map(d => d.taux),
                            backgroundColor: '#3490dc'
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            },
                            title: {
                                display: false
                            }
                        }
                    }
                });
            });

        // Graphe 3 : Taux de présence par niveau
        fetch("{{ route('statistiques.niveaux') }}")
            .then(res => res.json())
            .then(data => {
                const ctx = document.getElementById('niveauxChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.map(d => d.niveau),
                        datasets: [{
                            label: 'Taux (%)',
                            data: data.map(d => d.taux),
                            backgroundColor: '#38c172'
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            },
                            title: {
                                display: false
                            }
                        }
                    }
                });
            });

        // Graphe 4 : Volume de cours par type
        fetch("{{ route('statistiques.volumeType') }}")
            .then(res => res.json())
            .then(data => {
                const ctx = document.getElementById('typeCoursChart').getContext('2d');
                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: data.map(d => d.type),
                        datasets: [{
                            label: 'Volume',
                            data: data.map(d => d.volume),
                            backgroundColor: ['#f9c74f', '#90be6d', '#f94144']
                        }]
                    },
                    options: {
                        responsive: true
                    }
                });
            });

        // Graphe 5 : Volume cumulé par trimestre et niveau
        fetch("{{ route('statistiques.volumeCumul') }}")
            .then(res => res.json())
            .then(data => {
                const ctx = document.getElementById('volumeCumulChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.map(d => d.niveau),
                        datasets: [{
                                label: 'Trimestre 1',
                                data: data.map(d => d.trim1),
                                backgroundColor: '#6c5ce7'
                            },
                            {
                                label: 'Trimestre 2',
                                data: data.map(d => d.trim2),
                                backgroundColor: '#00cec9'
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            title: {
                                display: false
                            }
                        }
                    }
                });
            });
    </script>
</x-app-layout>
