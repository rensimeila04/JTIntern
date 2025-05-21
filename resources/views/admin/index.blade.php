@extends('layout.template')

@section('content')
    <div class="flex flex-col lg:flex-row gap-4 mt-6">
        <!-- Card 1 -->
        <div class="bg-white rounded-[8px] p-4 w-full h-fit flex flex-col justify-between">
            <div class="flex items-center justify-center gap-[8px] mb-2">
                <div class="bg-primary-50 rounded-[4px] p-2 w-[32px] h-[32px] flex items-center justify-center">
                    <x-lucide-user-check class="size-6 text-primary-600" stroke-width="1.5" />
                </div>
                <span class="text-base text-neutral-400 font-medium">Mahasiswa Magang</span>
            </div>
            <div class="flex-1 flex items-center justify-center">
                <span class="text-4xl font-semibold text-gray-800">260</span>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="bg-white rounded-[8px] p-4 w-full h-fit flex flex-col justify-between">
            <div class="flex items-center justify-center gap-[8px] mb-2">
                <div class="bg-primary-50 rounded-[4px] p-2 w-[32px] h-[32px] flex items-center justify-center">
                    <x-lucide-square-user-round class="size-6 text-primary-600" stroke-width="1.5" />
                </div>
                <span class="text-base text-neutral-400 font-medium">Dosen Pembimbing</span>
            </div>
            <div class="flex-1 flex items-center justify-center">
                <span class="text-4xl font-semibold text-gray-800">65</span>
            </div>
        </div>
        <!-- Card 3 -->
        <div class="bg-white rounded-[8px] p-4 w-full h-fit flex flex-col justify-between">
            <div class="flex items-center justify-center gap-[8px] mb-2">
                <div class="bg-primary-50 rounded-[4px] p-2 w-[32px] h-[32px] flex items-center justify-center">
                    <x-lucide-building-2 class="size-6 text-primary-600" stroke-width="1.5" />
                </div>
                <span class="text-base text-neutral-400 font-medium">Perusahaan</span>
            </div>
            <div class="flex-1 flex items-center justify-center">
                <span class="text-4xl font-semibold text-gray-800">35</span>
            </div>
        </div>
        <!-- Card 4 -->
        <div class="bg-white rounded-[8px] p-4 w-full h-fit flex flex-col justify-between">
            <div class="flex items-center justify-center gap-[8px] mb-2">
                <div class="bg-primary-50 rounded-[4px] p-2 w-[32px] h-[32px] flex items-center justify-center">
                    <x-lucide-briefcase class="size-6 text-primary-600" stroke-width="1.5" />
                </div>
                <span class="text-base text-neutral-400 font-medium">Lowongan</span>
            </div>
            <div class="flex-1 flex items-center justify-center">
                <span class="text-4xl font-semibold text-gray-800">85</span>
            </div>
        </div>
    </div>
    <div class="flex flex-col lg:flex-row gap-4 mt-4">
        <!-- Chart 1 -->
        <div class="bg-white rounded-[8px] flex flex-col items-center w-[456px] h-[324px] p-4">
            <h2 class="text-lg font-semibold text-Neutral-700 self-start mb-6">Rasio Dosen & Mahasiswa</h2>
            <div class="flex flex-col items-center justify-center flex-1 w-full h-full">
                <div class="w-[200px] h-[200px] flex items-center justify-center">
                    <div id="hs-doughnut-chart" class="w-full h-full"></div>
                </div>
                <!-- Legend Indicator -->
                <div class="flex justify-center items-center gap-x-4 mt-4">
                    <div class="inline-flex items-center">
                        <span class="size-4 inline-block bg-primary-600 rounded-full me-2"></span>
                        <span class="text-[13px] text-gray-600 dark:text-neutral-400">
                            Mahasiswa Magang
                        </span>
                    </div>
                    <div class="inline-flex items-center">
                        <span class="size-4 inline-block bg-primary-200 rounded-full me-2"></span>
                        <span class="text-[13px] text-gray-600 dark:text-neutral-400">
                            Dosen Pembimbing
                        </span>
                    </div>
                </div>
                <!-- End Legend Indicator -->
            </div>
        </div>
        <!-- Chart 2 -->
        <div class="bg-white rounded-[8px] flex flex-col items-center w-[752px] h-[324px] p-4">
            <h2 class="text-lg font-semibold text-Neutral-700 self-start">Tren Peminatan Mahasiswa</h2>
            <div class="w-full h-[240px]" id="hs-single-bar-chart"></div>
        </div>

    </div>
    <div class="flex flex-col lg:flex-row gap-4 mt-4">
        <!-- Progress Bar 1-->
        <div class="bg-white rounded-[8px] flex flex-col items-center w-full h-fit p-4">
            <h2 class="text-lg font-semibold text-Neutral-700 self-start pb-6">Tren Peminatan Mahasiswa</h2>
            <div class="space-y-5 w-full">
                <!-- Progress -->
                <div>
                    <div class="mb-2 flex justify-between items-center">
                        <h3 class="text-sm font-semibold text-neutral-800 dark:text-white">Sangat Puas</h3>
                        <span class="text-sm text-neutral-800 dark:text-white">50%</span>
                    </div>
                    <div class="flex w-full h-2 bg-gray-200 rounded-full overflow-hidden dark:bg-neutral-700"
                        role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                        <div class="flex flex-col justify-center rounded-full overflow-hidden bg-primary-500 text-xs text-white text-center whitespace-nowrap transition duration-500"
                            style="width: 50%"></div>
                    </div>
                </div>
                <!-- End Progress -->

                <!-- Progress -->
                <div>
                    <div class="mb-2 flex justify-between items-center">
                        <h3 class="text-sm font-semibold text-neutral-800 dark:text-white">Puas</h3>
                        <span class="text-sm text-neutral-800 dark:text-white">20%</span>
                    </div>
                    <div class="flex w-full h-2 bg-gray-200 rounded-full overflow-hidden dark:bg-neutral-700"
                        role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                        <div class="flex flex-col justify-center rounded-full overflow-hidden bg-primary-500 text-xs text-white text-center whitespace-nowrap transition duration-500"
                            style="width: 20%"></div>
                    </div>
                </div>
                <!-- End Progress -->

                <!-- Progress -->
                <div>
                    <div class="mb-2 flex justify-between items-center">
                        <h3 class="text-sm font-semibold text-neutral-800 dark:text-white">Netral</h3>
                        <span class="text-sm text-neutral-800 dark:text-white">10%</span>
                    </div>
                    <div class="flex w-full h-2 bg-gray-200 rounded-full overflow-hidden dark:bg-neutral-700"
                        role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                        <div class="flex flex-col justify-center rounded-full overflow-hidden bg-primary-500 text-xs text-white text-center whitespace-nowrap transition duration-500"
                            style="width: 10%"></div>
                    </div>
                </div>
                <!-- End Progress -->

                <!-- Progress -->
                <div>
                    <div class="mb-2 flex justify-between items-center">
                        <h3 class="text-sm font-semibold text-neutral-800 dark:text-white">Tidak Puas</h3>
                        <span class="text-sm text-neutral-800 dark:text-white">10%</span>
                    </div>
                    <div class="flex w-full h-2 bg-gray-200 rounded-full overflow-hidden dark:bg-neutral-700"
                        role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                        <div class="flex flex-col justify-center rounded-full overflow-hidden bg-primary-500 text-xs text-white text-center whitespace-nowrap transition duration-500"
                            style="width: 10%"></div>
                    </div>
                </div>
                <!-- End Progress -->

                <!-- Progress -->
                <div>
                    <div class="mb-2 flex justify-between items-center">
                        <h3 class="text-sm font-semibold text-neutral-800 dark:text-white">Sangat Tidak Puas</h3>
                        <span class="text-sm text-neutral-800 dark:text-white">10%</span>
                    </div>
                    <div class="flex w-full h-2 bg-gray-200 rounded-full overflow-hidden dark:bg-neutral-700"
                        role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                        <div class="flex flex-col justify-center rounded-full overflow-hidden bg-primary-500 text-xs text-white text-center whitespace-nowrap transition duration-500"
                            style="width: 10%"></div>
                    </div>
                </div>
                <!-- End Progress -->
            </div>
        </div>

        <!-- Progress Bar 2-->
        <div class="bg-white rounded-[8px] flex flex-col items-center w-full h-fit p-4">
            <h2 class="text-lg font-semibold text-Neutral-700 self-start pb-6">Kecocokan Rekomendasi dengan Kebutuhan/Minat
            </h2>
            <div class="space-y-5 w-full">
                <!-- Progress -->
                <div>
                    <div class="mb-2 flex justify-between items-center">
                        <h3 class="text-sm font-semibold text-neutral-800 dark:text-white">Sangat Sesuai</h3>
                        <span class="text-sm text-neutral-800 dark:text-white">50%</span>
                    </div>
                    <div class="flex w-full h-2 bg-gray-200 rounded-full overflow-hidden dark:bg-neutral-700"
                        role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                        <div class="flex flex-col justify-center rounded-full overflow-hidden bg-primary-300 text-xs text-white text-center whitespace-nowrap transition duration-500"
                            style="width: 50%"></div>
                    </div>
                </div>
                <!-- End Progress -->

                <!-- Progress -->
                <div>
                    <div class="mb-2 flex justify-between items-center">
                        <h3 class="text-sm font-semibold text-neutral-800 dark:text-white">Sesuai</h3>
                        <span class="text-sm text-neutral-800 dark:text-white">20%</span>
                    </div>
                    <div class="flex w-full h-2 bg-gray-200 rounded-full overflow-hidden dark:bg-neutral-700"
                        role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                        <div class="flex flex-col justify-center rounded-full overflow-hidden bg-primary-300 text-xs text-white text-center whitespace-nowrap transition duration-500"
                            style="width: 20%"></div>
                    </div>
                </div>
                <!-- End Progress -->

                <!-- Progress -->
                <div>
                    <div class="mb-2 flex justify-between items-center">
                        <h3 class="text-sm font-semibold text-neutral-800 dark:text-white">Cukup Sesuai</h3>
                        <span class="text-sm text-neutral-800 dark:text-white">10%</span>
                    </div>
                    <div class="flex w-full h-2 bg-gray-200 rounded-full overflow-hidden dark:bg-neutral-700"
                        role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                        <div class="flex flex-col justify-center rounded-full overflow-hidden bg-primary-300 text-xs text-white text-center whitespace-nowrap transition duration-500"
                            style="width: 10%"></div>
                    </div>
                </div>
                <!-- End Progress -->

                <!-- Progress -->
                <div>
                    <div class="mb-2 flex justify-between items-center">
                        <h3 class="text-sm font-semibold text-neutral-800 dark:text-white">Kurang Sesuai</h3>
                        <span class="text-sm text-neutral-800 dark:text-white">10%</span>
                    </div>
                    <div class="flex w-full h-2 bg-gray-200 rounded-full overflow-hidden dark:bg-neutral-700"
                        role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                        <div class="flex flex-col justify-center rounded-full overflow-hidden bg-primary-300 text-xs text-white text-center whitespace-nowrap transition duration-500"
                            style="width: 10%"></div>
                    </div>
                </div>
                <!-- End Progress -->

                <!-- Progress -->
                <div>
                    <div class="mb-2 flex justify-between items-center">
                        <h3 class="text-sm font-semibold text-neutral-800 dark:text-white">Tidak Sesuai</h3>
                        <span class="text-sm text-neutral-800 dark:text-white">10%</span>
                    </div>
                    <div class="flex w-full h-2 bg-gray-200 rounded-full overflow-hidden dark:bg-neutral-700"
                        role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                        <div class="flex flex-col justify-center rounded-full overflow-hidden bg-primary-300 text-xs text-white text-center whitespace-nowrap transition duration-500"
                            style="width: 10%"></div>
                    </div>
                </div>
                <!-- End Progress -->
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
                    series: [25, 75],
                    labels: ['Mahasiswa Magang', 'Dosen Pembimbing'],
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
                    colors: ['#BEDCC6', '#4C956C'],
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
                    series: [
                        {
                            name: 'Jumlah',
                            data: [80, 110, 130, 55, 150]
                        }
                    ],
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
                        categories: [
                            'Data\nScience',
                            'Game\nDev',
                            'Software\nDev',
                            'UI/UX\nDesign',
                            'Lainnya'
                        ],
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
                                // Pecah label menjadi dua baris jika ada spasi
                                return value.split(' ').join('\n');
                            }
                        },
                        axisBorder: { show: false },
                        axisTicks: { show: false }
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
                        y: {
                            formatter: (value) => `$${value >= 1000 ? `${value / 1000}k` : value}`
                        },
                        custom: function (props) {
                            const { categories } = props.ctx.opts.xaxis;
                            const { dataPointIndex } = props;
                            const title = categories[dataPointIndex];
                            const newTitle = `${title}`;

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
                                    formatter: (value) => value >= 1000 ? `${value / 1000}k` : value
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