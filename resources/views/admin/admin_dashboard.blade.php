@extends('admin.body.dashboard')
@section('content')
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
            </div>

        </div>

        <div class="row">
            <!-- total hotels  -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">TOTAL HOTELS</h6>
                            <div class="dropdown mb-2">
                                <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                </a>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h3 class="mb-2">{{ $total_hotels }}</h3>
                                <p class="text-success">
                                    <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- total rooms -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">TOTAL ROOMS</h6>
                            <div class="dropdown mb-2">
                                <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                </a>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h3 class="mb-2">{{ $total_rooms }}</h3>
                                <p class="text-success">
                                    <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                </p>
                            </div>
                            <div class="flex-grow-1">
                                <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- total users -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">TOTAL USERS</h6>
                            <div class="dropdown mb-2">
                                <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                </a>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h3 class="mb-2">{{ $totalUsers }}</h3>
                                <p class="text-success">
                                    <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                </p>
                            </div>
                            <div class="flex-grow-1">
                                <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- total bookings -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">TOTAL BOOKINGS</h6>
                            <div class="dropdown mb-2">
                                <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                </a>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h3 class="mb-2">{{ $totalBookings }}</h3>
                                <p class="text-success">
                                    <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                </p>
                            </div>
                            <div class="flex-grow-1">
                                <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- total revenue -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">TOTAL REVENUE</h6>
                            <div class="dropdown mb-2">
                                <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                </a>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h3 class="mb-2">{{ $totalRevenue }} $</h3>
                                <p class="text-success">
                                    <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                </p>
                            </div>
                            <div class="flex-grow-1">
                                <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- total revenue in this week -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">TOTAL REVENUE IN THIS WEEK</h6>
                            <div class="dropdown mb-2">
                                <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                </a>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h3 class="mb-2">{{ $totalRevenueThisWeek }} $</h3>
                                <p class="text-success">
                                    <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                </p>
                            </div>
                            <div class="flex-grow-1">
                                <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- total revenue in this month -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">TOTAL REVENUE IN THIS MONTH</h6>
                            <div class="dropdown mb-2">
                                <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                </a>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h3 class="mb-2">{{ $totalRevenueThisMonth }} $</h3>
                                <p class="text-success">
                                    <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                </p>
                            </div>
                            <div class="flex-grow-1">
                                <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- total revenue in this year -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">TOTAL REVENUE IN THIS YEAR</h6>
                            <div class="dropdown mb-2">
                                <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                </a>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h3 class="mb-2">{{ $totalRevenueThisYear }} $</h3>
                                <p class="text-success">
                                    <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                </p>
                            </div>
                            <div class="flex-grow-1">
                                <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
