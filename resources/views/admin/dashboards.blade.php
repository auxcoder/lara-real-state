@extends('admin.layout.master')

@section('content')
<div class="container-fluid">
    <x-admin.page-header
        title="Dashboard"
        :breadcrumbs="[['label' => 'Dashboard']]"
    />

    <div class="d-flex justify-content-between align-items-center mb-4 my-3">
        <h4 class="mb-0 text-muted">Welcome back, {{ auth()->user()->name }}!</h4>
        <div class="text-muted">
            <i class="bi bi-calendar3"></i> {{ now()->format('l, F j, Y') }}
        </div>
    </div>

    <x-admin.card title="Overview Statistics" class="my-3">
        <div class="row g-3">
            <div class="col-md-6 col-xl-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-1 text-muted small">Agent Properties</p>
                                <h3 class="mb-0">{{ $stats['total_properties'] }}</h3>
                            </div>
                            <div class="p-3 bg-opacity-10 bg-primary rounded">
                                <i class="text-primary bi bi-building" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-1 text-muted small">Developer Properties</p>
                                <h3 class="mb-0">{{ $stats['total_developer_properties'] }}</h3>
                            </div>
                            <div class="p-3 bg-opacity-10 bg-success rounded">
                                <i class="text-success bi bi-buildings" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-1 text-muted small">Total Agents</p>
                                <h3 class="mb-0">{{ $stats['total_agents'] }}</h3>
                            </div>
                            <div class="p-3 bg-info bg-opacity-10 rounded">
                                <i class="text-info bi bi-people" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-1 text-muted small">New Visitors (7d)</p>
                                <h3 class="mb-0">{{ $stats['pending_visitors'] }}</h3>
                            </div>
                            <div class="p-3 bg-opacity-10 bg-warning rounded">
                                <i class="text-warning bi bi-person-check" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-admin.card>

    <x-admin.card title="Additional Statistics" class="my-3">
        <div class="row g-3">
            <div class="col-md-6 col-xl-3">
                <div class="card border-0 shadow-sm">
                    <div class="text-center card-body">
                        <i class="mb-2 text-primary bi bi-briefcase" style="font-size: 2rem;"></i>
                        <h4 class="mb-0">{{ $stats['total_developers'] }}</h4>
                        <p class="mb-0 text-muted small">Developers</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card border-0 shadow-sm">
                    <div class="text-center card-body">
                        <i class="mb-2 text-success bi bi-geo-alt" style="font-size: 2rem;"></i>
                        <h4 class="mb-0">{{ $stats['total_communities'] }}</h4>
                        <p class="mb-0 text-muted small">Communities</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card border-0 shadow-sm">
                    <div class="text-center card-body">
                        <i class="mb-2 text-info bi bi-newspaper" style="font-size: 2rem;"></i>
                        <h4 class="mb-0">{{ $stats['total_blogs'] }}</h4>
                        <p class="mb-0 text-muted small">Blog Posts</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card border-0 shadow-sm">
                    <div class="text-center card-body">
                        <i class="mb-2 text-warning bi bi-person-circle" style="font-size: 2rem;"></i>
                        <h4 class="mb-0">{{ $stats['total_users'] }}</h4>
                        <p class="mb-0 text-muted small">Users</p>
                    </div>
                </div>
            </div>
        </div>
    </x-admin.card>

    <div class="row g-3" class="my-3">
        <div class="col-xl-6">
            <x-admin.card title="Properties by Type">
                <canvas id="propertiesByTypeChart" height="200"></canvas>
            </x-admin.card>
        </div>

        <div class="col-xl-6">
            <x-admin.card title="Properties by Status">
                <canvas id="propertiesByStatusChart" height="200"></canvas>
            </x-admin.card>
        </div>

        <div class="col-xl-6">
            <x-admin.card title="Latest Properties">
                <x-slot name="actions">
                    <a href="{{ route('property.index') }}" class="btn btn-outline-primary btn-sm">View All</a>
                </x-slot>

                <div class="table-responsive">
                    <table class="mb-0 table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Property</th>
                                <th>Location</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestProperties as $property)
                                <tr>
                                    <td>
                                        <div class="fw-semibold">{{ $property->translations->first()->title ?? 'No Title' }}</div>
                                        <small class="text-muted">{{ $property->created_at->format('M d, Y') }}</small>
                                    </td>
                                    <td>
                                        <i class="text-muted bi bi-geo-alt"></i> {{ $property->location }}
                                    </td>
                                    <td>
                                        <span class="text-dark bg-light badge">{{ $property->property_type }}</span>
                                    </td>
                                    <td>
                                        @if($property->price)
                                            <strong>{{ number_format($property->price) }} AED</strong>
                                        @else
                                            <span class="text-muted">Contact</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="bg- badge{{ $property->status == 'available' ? 'success' : 'secondary' }}">
                                            {{ ucfirst($property->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('property.show', $property->id) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-4 text-center text-muted">No properties found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </x-admin.card>
        </div>

        <div class="col-xl-6">
            <x-admin.card title="Properties by Location">
                <div class="list-group list-group-flush">
                    @forelse($propertiesByLocation as $location)
                        <div class="d-flex justify-content-between align-items-center px-0 list-group-item">
                            <div>
                                <i class="text-primary bi bi-geo-alt-fill"></i>
                                <span class="fw-semibold ms-2">{{ $location->location }}</span>
                            </div>
                            <div>
                                <span class="bg-primary rounded-pill badge">{{ $location->count }}</span>
                                <span class="text-muted ms-2 small">
                                    {{ number_format(($location->count / $stats['total_properties']) * 100, 1) }}%
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="py-4 text-center text-muted">No location data</div>
                    @endforelse
                </div>
            </x-admin.card>
        </div>

        <div class="col-xl-6">
            <x-admin.card title="Recent Properties">
                <x-slot name="actions">
                    <a href="{{ route('property.index') }}" class="btn btn-outline-primary btn-sm">View All</a>
                </x-slot>

                <div class="list-group list-group-flush">
                    @forelse($recentProperties as $property)
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1">{{ $property->translations->first()->title ?? 'No Title' }}</h6>
                                    <p class="mb-1 text-muted small">
                                        <i class="bi bi-geo-alt"></i> {{ $property->location }}
                                        <span class="mx-2">•</span>
                                        <i class="bi bi-tag"></i> {{ $property->property_type }}
                                    </p>
                                    <small class="text-muted">{{ $property->created_at->diffForHumans() }}</small>
                                </div>
                                <span class="bg- badge{{ $property->status == 'available' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($property->status) }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="py-4 text-center text-muted list-group-item">
                            No recent properties
                        </div>
                    @endforelse
                </div>
            </x-admin.card>
        </div>

        <div class="col-xl-6">
            <x-admin.card title="Recent Blog Posts">
                <x-slot name="actions">
                    <a href="{{ route('blogs.index') }}" class="btn btn-outline-primary btn-sm">View All</a>
                </x-slot>

                <div class="list-group list-group-flush">
                    @forelse($recentBlogs as $blog)
                        <div class="list-group-item">
                            <div class="d-flex align-items-center">
                                @if($blog->image)
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="" class="rounded me-3" width="60" height="60" style="object-fit: cover;">
                                @endif
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $blog->translate()->title }}</h6>
                                    <small class="text-muted">{{ $blog->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="py-4 text-center text-muted list-group-item">
                            No recent blog posts
                        </div>
                    @endforelse
                </div>
            </x-admin.card>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // Properties by Type Chart
    const typeCtx = document.getElementById('propertiesByTypeChart');
    new Chart(typeCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($propertiesByType->pluck('property_type')) !!},
            datasets: [{
                data: {!! json_encode($propertiesByType->pluck('count')) !!},
                backgroundColor: [
                    'rgba(13, 110, 253, 0.8)',
                    'rgba(25, 135, 84, 0.8)',
                    'rgba(255, 193, 7, 0.8)',
                    'rgba(220, 53, 69, 0.8)',
                    'rgba(13, 202, 240, 0.8)',
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });

    // Properties by Status Chart
    const statusCtx = document.getElementById('propertiesByStatusChart');
    new Chart(statusCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($propertiesByStatus->pluck('status')->map(fn($s) => ucfirst($s))) !!},
            datasets: [{
                label: 'Properties',
                data: {!! json_encode($propertiesByStatus->pluck('count')) !!},
                backgroundColor: 'rgba(13, 110, 253, 0.8)',
                borderRadius: 8,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection
