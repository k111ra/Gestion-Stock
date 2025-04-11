@extends('layouts.layout')

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Statistiques -->
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="card-info">
                                <p class="card-text">Produits en stock</p>
                                <h4 class="card-title mb-0">{{ $totalProduits }}</h4>
                                <small>Produits disponibles</small>
                            </div>
                            <div class="card-icon">
                                <span class="badge bg-label-primary rounded p-2">
                                    <i class="bx bx-package bx-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="card-info">
                                <p class="card-text">Mouvements du mois</p>
                                <h4 class="card-title mb-0">{{ $totalMouvements }}</h4>
                                <small>Entrées et sorties</small>
                            </div>
                            <div class="card-icon">
                                <span class="badge bg-label-success rounded p-2">
                                    <i class="bx bx-transfer bx-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="card-info">
                                <p class="card-text">Valeur du stock</p>
                                <h4 class="card-title mb-0">{{ number_format($valeurStock, 0, ',', ' ') }} F</h4>
                                <small>Valeur totale</small>
                            </div>
                            <div class="card-icon">
                                <span class="badge bg-label-warning rounded p-2">
                                    <i class="bx bx-money bx-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="card-info">
                                <p class="card-text">Alertes stock</p>
                                <h4 class="card-title mb-0">{{ $alertes }}</h4>
                                <small>Produits en alerte</small>
                            </div>
                            <div class="card-icon">
                                <span class="badge bg-label-danger rounded p-2">
                                    <i class="bx bx-bell bx-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Graphiques -->
        <div class="row">
            <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card">
                    <div class="row row-bordered g-0">
                        <div class="col-md-8">
                            <h5 class="card-header m-0 me-2 pb-3">Mouvements mensuels</h5>
                            <div id="totalRevenueChart" class="px-2" style="min-height: 315px;"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-body text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                        id="mouvementsYearDropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        {{ $selectedYear }}
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        @for ($year = 2025; $year >= 2022; $year--)
                                            <a class="dropdown-item {{ $selectedYear == $year ? 'active' : '' }}"
                                                href="{{ route('dashboard', ['year' => $year]) }}">{{ $year }}</a>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="text-center fw-semibold pt-3">Mouvements de stock</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">Produits en alerte</h5>
                        <div class="text-end">
                            <small class="text-muted">Total: {{ count($produitsEnAlerte) }}</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            @forelse($produitsEnAlerte as $produit)
                                <li class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <span class="fw-semibold">{{ $produit->nom }}</span>
                                        <br>
                                        <small class="text-muted">Seuil: {{ $produit->seuil_alerte }}</small>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-danger">{{ $produit->stock }}</span>
                                        <br>
                                        <small class="text-danger">Stock</small>
                                    </div>
                                </li>
                            @empty
                                <p class="text-center text-muted mb-0">Aucun produit en alerte.</p>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection

@section('scripts')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const mouvementsParAnnee = @json($mouvementsParAnnee);
            const selectedYear = @json($selectedYear);
            const currentYear = @json(date('Y'));

            const options = {
                series: [{
                    name: `Entrées ${selectedYear}`,
                    data: mouvementsParAnnee[selectedYear].entrees,
                    color: '#71DD37'
                }, {
                    name: `Sorties ${selectedYear}`,
                    data: mouvementsParAnnee[selectedYear].sorties.map(val => -val),
                    color: '#FF3E1D'
                }],
                chart: {
                    height: 300,
                    stacked: true,
                    type: 'bar',
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '33%',
                        borderRadius: 8,
                        startingShape: 'rounded',
                        endingShape: 'rounded'
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2,
                    lineCap: 'round',
                    colors: ['transparent']
                },
                legend: {
                    show: true,
                    horizontalAlign: 'left',
                    position: 'top',
                    markers: {
                        height: 8,
                        width: 8,
                        radius: 12,
                        offsetX: -3
                    },
                    labels: {
                        colors: '#697a8d'
                    },
                    itemMargin: {
                        horizontal: 10
                    }
                },
                grid: {
                    borderColor: '#dbdade',
                    padding: {
                        top: 0,
                        bottom: -8,
                        left: 20,
                        right: 20
                    }
                },
                xaxis: {
                    categories: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov',
                        'Déc'
                    ],
                    labels: {
                        style: {
                            fontSize: '13px',
                            colors: '#697a8d'
                        }
                    },
                    axisTicks: {
                        show: false
                    },
                    axisBorder: {
                        show: false
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            fontSize: '13px',
                            colors: '#697a8d'
                        }
                    }
                },
                states: {
                    hover: {
                        filter: {
                            type: 'none'
                        }
                    },
                    active: {
                        filter: {
                            type: 'none'
                        }
                    }
                }
            };

            // Création et rendu du graphique
            const chart = new ApexCharts(document.querySelector("#totalRevenueChart"), options);
            chart.render();
        });
    </script>
@endsection
