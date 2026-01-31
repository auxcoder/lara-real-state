@extends('admin.layout.master')

@section('content')
<div class="content">
    <!-- Start Content-->
    <div class="container-xxl">

        <div class="d-flex flex-column flex-sm-row align-items-sm-center py-3">
            <div class="flex-grow-1">
                <h4 class="m-0 fs-18 fw-semibold">Pie Chart</h4>
            </div>

            <div class="text-end">
                <ol class="m-0 py-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Charts</a></li>
                    <li class="active breadcrumb-item">Pie Charts</li>
                </ol>
            </div>
        </div>

        <!-- Simple Pie Charts -->
        <div class="row">
            <!-- Simple Pie Charts -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 card-title">Simple Pie Chart</h5>
                    </div>

                    <div class="card-body">
                        <div id="simple_pie_chart" class="apex-charts"></div>
                    </div>
                </div>
            </div>

            <!-- Simple Donut Charts -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 card-title">Simple Donut Chart</h5>
                    </div>

                    <div class="card-body">
                        <div id="simple_donut_chart" class="apex-charts"></div>
                    </div>
                </div>
            </div>

            <!-- Monochrome Pie Charts -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 card-title">Monochrome Pie Chart</h5>
                    </div>

                    <div class="card-body">
                        <div id="monochrome_pie_chart" class="apex-charts"></div>
                    </div>

                </div>
            </div>

            <!-- Gradient Donut Pie Charts -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 card-title">Gradient Donut Pie Chart</h5>
                    </div>

                    <div class="card-body">
                        <div id="gradient_donut_pie_chart" class="apex-charts"></div>
                    </div>
                </div>
            </div>

            <!-- Semi Donut Pie Charts -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 card-title">Semi Donut Pie Chart</h5>
                    </div>

                    <div class="card-body">
                        <div id="semi_donut_pie_chart" class="apex-charts"></div>
                    </div>
                </div>
            </div>

            <!-- Donut with Pattern Charts -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 card-title">Donut with Pattern Chart</h5>
                    </div>

                    <div class="card-body">
                        <div id="pattern_donut_pie_chart" class="apex-charts"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
