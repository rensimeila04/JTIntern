@extends('layout.template')

@section('content')
    <div class="space-y-4">
        <div class="flex flex-col lg:flex-row gap-4">
            <!-- Card 1 -->
            <div class="bg-white rounded-[8px] p-4 w-full h-fit flex flex-col justify-between">
                <div class="flex items-center justify-center gap-[8px] mb-2">
                    <div class="bg-primary-50 rounded-sm p-2 w-fit h-fit flex items-center justify-center">
                        <x-lucide-user-check class="size-5 text-primary-600" stroke-width="1.5" />
                    </div>
                    <span class="text-base text-neutral-400 font-medium">Mahasiswa Magang</span>
                </div>
                <div class="flex-1 flex items-center justify-center">
                    <span class="text-4xl font-medium text-gray-800">{{ $countMahasiswa }}</span>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="bg-white rounded-[8px] p-4 w-full h-fit flex flex-col justify-between">
                <div class="flex items-center justify-center gap-[8px] mb-2">
                    <div class="bg-primary-50 rounded-sm p-2 w-fit h-fit flex items-center justify-center">
                        <x-lucide-square-user-round class="size-5 text-primary-600" stroke-width="1.5" />
                    </div>
                    <span class="text-base text-neutral-400 font-medium">Dosen Pembimbing</span>
                </div>
                <div class="flex-1 flex items-center justify-center">
                    <span class="text-4xl font-medium text-gray-800">{{ $countDosenPembimbing }}</span>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="bg-white rounded-[8px] p-4 w-full h-fit flex flex-col justify-between">
                <div class="flex items-center justify-center gap-[8px] mb-2">
                    <div class="bg-primary-50 rounded-sm p-2 w-fit h-fit flex items-center justify-center">
                        <x-lucide-building-2 class="size-5 text-primary-600" stroke-width="1.5" />
                    </div>
                    <span class="text-base text-neutral-400 font-medium">Perusahaan</span>
                </div>
                <div class="flex-1 flex items-center justify-center">
                    <span class="text-4xl font-medium text-gray-800">{{ $countPerusahaanMitra }}</span>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="bg-white rounded-[8px] p-4 w-full h-fit flex flex-col justify-between">
                <div class="flex items-center justify-center gap-[8px] mb-2">
                    <div class="bg-primary-50 rounded-sm p-2 w-fit h-fit flex items-center justify-center">
                        <x-lucide-briefcase class="size-5 text-primary-600" stroke-width="1.5" />
                    </div>
                    <span class="text-base text-neutral-400 font-medium">Lowongan</span>
                </div>
                <div class="flex-1 flex items-center justify-center">
                    <span class="text-4xl font-medium text-gray-800">{{ $countLowongan }}</span>
                </div>
            </div>
        </div>
        <div class="flex flex-col lg:flex-row gap-4">
            <!-- Chart 1 -->
            <div class="bg-white rounded-[8px] flex flex-col items-center w-[600px] h-[324px] p-4">
                <h2 class="text-lg font-medium text-Neutral-700 self-start mb-6">Rasio Dosen & Mahasiswa</h2>
                <div class="flex flex-col items-center justify-center flex-1 w-full h-full">
                    <div class="w-[200px] h-[200px] flex items-center justify-center">
                        <div id="hs-doughnut-chart" class="w-full h-full"></div>
                    </div>
                    <!-- Legend Indicator -->
                    <div class="flex justify-center items-center gap-x-4 mt-4">
                        <div class="inline-flex items-center">
                            <span class="size-4 inline-block bg-primary-600 rounded-full me-2"></span>
                            <span class="text-xs text-gray-600 dark:text-neutral-400">
                                Mahasiswa Magang
                            </span>
                        </div>
                        <div class="inline-flex items-center">
                            <span class="size-4 inline-block bg-primary-200 rounded-full me-2"></span>
                            <span class="text-xs text-gray-600 dark:text-neutral-400">
                                Dosen Pembimbing
                            </span>
                        </div>
                    </div>
                    <!-- End Legend Indicator -->
                </div>
            </div>
            <!-- Chart 2 -->
            <div class="bg-white rounded-[8px] flex flex-col items-center w-[870px] h-[324px] p-4">
                <h2 class="text-lg font-medium text-Neutral-700 self-start">Tren Peminatan Mahasiswa</h2>
                <div class="w-full h-[240px]" id="hs-single-bar-chart"></div>
            </div>

        </div>
        <div class="flex flex-col lg:flex-row gap-4">
            <!-- Progress Bar 1-->
            <div class="bg-white rounded-[8px] flex flex-col items-center w-full h-fit p-4">
                <h2 class="text-lg font-medium text-Neutral-700 self-start pb-6">Tren Peminatan Mahasiswa</h2>
                <div class="space-y-5 w-full">
                    @foreach ($feedbackKepuasanData as $nilai => $data)
                        <!-- Progress -->
                        <div>
                            <div class="mb-2 flex justify-between items-center">
                                <h3 class="text-sm font-medium text-neutral-800 dark:text-white">{{ $data['label'] }} </h3>
                                <span class="text-sm text-neutral-800 dark:text-white">{{ $data['persentase'] }}%</span>
                            </div>
                            <div class="flex w-full h-2 bg-gray-200 rounded-full overflow-hidden dark:bg-neutral-700"
                                role="progressbar" aria-valuenow="{{ $data['persentase'] }}%" aria-valuemin="0"
                                aria-valuemax="100">
                                <div class="flex flex-col justify-center rounded-full overflow-hidden bg-primary-500 text-xs text-white text-center whitespace-nowrap transition duration-500"
                                    style="width: {{ $data['persentase'] }}%"></div>
                            </div>
                        </div>
                        <!-- End Progress -->
                    @endforeach
                </div>
            </div>

            <!-- Progress Bar 2-->
            <div class="bg-white rounded-[8px] flex flex-col items-center w-full h-fit p-4">
                <h2 class="text-lg font-medium text-Neutral-700 self-start pb-6">Kecocokan Rekomendasi dengan
                    Kebutuhan/Minat
                </h2>
                <div class="space-y-5 w-full">
                    @foreach ($feedbackKesesuaianData as $nilai => $data)
                        <!-- Progress -->
                        <div>
                            <div class="mb-2 flex justify-between items-center">
                                <h3 class="text-sm font-medium text-neutral-800 dark:text-white">{{ $data['label'] }}</h3>
                                <span class="text-sm text-neutral-800 dark:text-white">{{ $data['persentase'] }}%</span>
                            </div>
                            <div class="flex w-full h-2 bg-gray-200 rounded-full overflow-hidden dark:bg-neutral-700"
                                role="progressbar" aria-valuenow="{{ $data['persentase'] }}%" aria-valuemin="0" aria-valuemax="100">
                                <div class="flex flex-col justify-center rounded-full overflow-hidden bg-primary-300 text-xs text-white text-center whitespace-nowrap transition duration-500"
                                    style="width: {{ $data['persentase'] }}%"></div>
                            </div>
                        </div>
                        <!-- End Progress -->
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script src="https://preline.co/assets/js/hs-apexcharts-helpers.js"></script>

    <script>
        window.addEventListener('load', () => {
            // Apex Doughnut Chart
            (function () {
                buildChart('#hs-doughnut-chart', (mode) => ({
                    chart: {
                        height: 200,
                        width: 200,
                        type: 'donut',
                        zoom: {
                            enabled: false
                        }
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '75%'
                            }
                        }
                    },
                    series: @json([$countDosenPembimbing, $countMahasiswa]),
                    labels: ['Dosen Pembimbing', 'Mahasiswa Magang'],
                    legend: {
                        show: false
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: 5
                    },
                    grid: {
                        padding: {
                            top: -12,
                            bottom: -11,
                            left: -12,
                            right: -12
                        }
                    },
                    states: {
                        hover: {
                            filter: {
                                type: 'none'
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                        custom: function (props) {
                            return buildTooltipForDonut(
                                props,
                                mode === 'dark' ? ['#fff', '#fff'] : ['#fff', '#fff']
                            );
                        }
                    }
                }), {
                    colors: ['#BEDCC6', '#4C956C',],
                    stroke: {
                        colors: ['rgb(255, 255, 255)']
                    }
                }, {
                    colors: ['#BEDCC6', '#4C956C'],
                    stroke: {
                        colors: ['rgb(38, 38, 38)']
                    }
                });
            })();
        });
    </script>
    <script>
        window.addEventListener('load', () => {
            // Apex Single Bar Charts
            (function () {
                buildChart('#hs-single-bar-chart', (mode) => ({
                    chart: {
                        type: 'bar',
                        height: 280,
                        toolbar: {
                            show: false
                        },
                        zoom: {
                            enabled: false
                        },
                        offsetX: 0,
                        offsetY: 0,
                    },
                    series: [{
                        name: 'Jumlah',
                        data: @json($trenPeminatanData)
                    }],
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '40px',
                            borderRadius: 0,
                            endingShape: 'flat',
                        }
                    },
                    legend: {
                        show: false
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        width: 8,
                        colors: ['transparent']
                    },
                    xaxis: {
                        categories: @json($trenPeminatanLabel),
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        },
                        crosshairs: {
                            show: false
                        },
                        labels: {
                            style: {
                                colors: '#6B7280',
                                fontSize: '14px',
                                fontFamily: 'Inter, ui-sans-serif',
                                fontWeight: 400
                            },
                            formatter: function (value) {
                                // Jika nilai bukan string, kembalikan nilai asli
                                if (typeof value !== 'string') return value;

                                // Pecah string berdasarkan spasi
                                var words = value.split(' ');

                                // Jika hanya satu kata, kembalikan kata tersebut
                                if (words.length <= 1) return value;

                                // Jika ada dua kata atau lebih, pisahkan menjadi 2 baris
                                // Kata pertama di baris pertama, sisanya di baris kedua
                                return words[0] + '\n' + words.slice(1).join(' ');
                            }
                        },
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        }
                    },
                    yaxis: {
                        min: 0,
                        max: 150,
                        tickAmount: 3,
                        labels: {
                            style: {
                                colors: '#6B7280',
                                fontSize: '14px',
                                fontFamily: 'Inter, ui-sans-serif',
                                fontWeight: 400
                            }
                        }
                    },
                    states: {
                        hover: {
                            filter: {
                                type: 'darken',
                                value: 0.9
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                        y: {
                            formatter: (value) => `$${value >= 1000 ? `${value / 1000}k` : value}`
                        },
                        custom: function (props) {
                            const {
                                categories
                            } = props.ctx.opts.xaxis;
                            const {
                                dataPointIndex
                            } = props;
                            const title = categories[dataPointIndex];
                            const value = props.series[props.seriesIndex][dataPointIndex];
                            const newTitle = `${title}: ${value}`;

                            return buildTooltip(props, {
                                title: newTitle,
                                mode,
                                hasTextLabel: true,
                                wrapperExtClasses: 'min-w-28',
                                labelDivider: ':',
                                labelExtClasses: 'ms-2'
                            });
                        }
                    },
                    responsive: [{
                        breakpoint: 568,
                        options: {
                            chart: {
                                height: 300
                            },
                            plotOptions: {
                                bar: {
                                    columnWidth: '14px'
                                }
                            },
                            stroke: {
                                width: 8
                            },
                            labels: {
                                style: {
                                    colors: '#9ca3af',
                                    fontSize: '11px',
                                    fontFamily: 'Inter, ui-sans-serif',
                                    fontWeight: 400
                                },
                                offsetX: -2,
                                formatter: (title) => title.slice(0, 3)
                            },
                            yaxis: {
                                labels: {
                                    align: 'left',
                                    minWidth: 0,
                                    maxWidth: 140,
                                    style: {
                                        colors: '#9ca3af',
                                        fontSize: '11px',
                                        fontFamily: 'Inter, ui-sans-serif',
                                        fontWeight: 400
                                    },
                                    formatter: (value) => value >= 1000 ?
                                        `${value / 1000}k` : value
                                }
                            },
                        },
                    }]
                }), {
                    colors: ['#4C956C', '#d1d5db'],
                    xaxis: {
                        labels: {
                            style: {
                                colors: '#9ca3af',
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                colors: '#9ca3af'
                            }
                        }
                    },
                    grid: {
                        borderColor: '#e5e7eb'
                    }
                });
            })();
        });
    </script>
@endsection