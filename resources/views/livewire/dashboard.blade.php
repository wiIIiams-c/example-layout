<div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <i class="bi bi-calendar"></i> This week
            </button>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text display-4">{{ $totalUsers }}</p>
                </div>
                <div class="card-footer text-muted">
                    <small>Updated just now</small>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Products</h5>
                    <p class="card-text display-4">{{ $totalProducts }}</p>
                </div>
                <div class="card-footer text-muted">
                    <small>Updated just now</small>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Revenue</h5>
                    <p class="card-text display-4">${{ number_format($totalRevenue, 2) }}</p>
                </div>
                <div class="card-footer text-muted">
                    <small>Updated just now</small>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            Recent Activities
        </div>
        <div class="card-body">
            <button wire:click="refreshData" class="btn btn-primary mb-3">
                <i class="bi bi-arrow-clockwise"></i> Refresh Data
            </button>
            
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Action</th>
                            <th scope="col">User</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activities as $index => $activity)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $activity['action'] }}</td>
                            <td>{{ $activity['user'] }}</td>
                            <td>{{ $activity['date'] }}</td>
                            <td>
                                <span class="badge bg-{{ $activity['status_color'] }}">
                                    {{ $activity['status'] }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
