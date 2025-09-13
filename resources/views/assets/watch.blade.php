@extends('layout.master')

@section('title', 'Asset Details - ' . $asset->asset_name)

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Asset Details</h1>
        <div>
            <a href="{{ route('assets.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left mr-1"></i> Back to Assets
            </a>
            @can('editAsset')
            <a href="{{ route('assets.edit', $asset->id) }}" class="btn btn-info btn-sm ml-2">
                <i class="fas fa-edit mr-1"></i> Edit Asset
            </a>
            @endcan
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 " style="background-color: cadetblue;">
            <h6 class="m-0 font-weight-bold text-white">
                {{ $asset->asset_name }} ({{ $asset->asset_id }})
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Asset Information Column -->
                <div class="col-lg-6">
                    <div class="card mb-4 border-left-primary">
                        <div class="card-header py-3 bg-light">
                            <h6 class="m-0 font-weight-bold text-info">Asset Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="small font-weight-bold text-gray-600">Asset ID</label>
                                <p class="font-weight-bold">{{ $asset->asset_id }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="small font-weight-bold text-gray-600">Asset Name</label>
                                <p class="font-weight-bold">{{ $asset->asset_name }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="small font-weight-bold text-gray-600">Department</label>
                                <p class="font-weight-bold">{{ ucfirst($asset->department_for) }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="small font-weight-bold text-gray-600">Asset Type</label>
                                <p class="font-weight-bold">{{ ucfirst($asset->asset_type) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Technical Details Column -->
                <div class="col-lg-6">
                    <div class="card mb-4 border-left-info">
                        <div class="card-header py-3 bg-light">
                            <h6 class="m-0 font-weight-bold text-info">Technical Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="small font-weight-bold text-gray-600">Serial Number</label>
                                <p class="font-weight-bold">{{ $asset->serial_number }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="small font-weight-bold text-gray-600">Asset Cost</label>
                                <p class="font-weight-bold">${{ number_format($asset->asset_cost, 2) }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="small font-weight-bold text-gray-600">Status</label>
                                <p>
                                    <span class="badge badge-pill 
                                        @if($asset->status == 'active') badge-success
                                        @elseif($asset->status == 'maintenance') badge-warning
                                        @elseif($asset->status == 'retired') badge-secondary
                                        @else badge-info @endif">
                                        {{ ucfirst($asset->status ?? 'N/A') }}
                                    </span>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label class="small font-weight-bold text-gray-600">Last Updated</label>
                                <p class="font-weight-bold">{{ $asset->updated_at->format('M d, Y h:i A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Asset Image Section -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4 border-left-success">
                        <div class="card-header py-3 bg-light">
                            <h6 class="m-0 font-weight-bold text-success">Asset Image</h6>
                        </div>
                        <div class="card-body text-center">
                            @if($asset->picture)
                            <img class="img-fluid rounded mb-3" 
                                 style="max-height: 300px; object-fit: contain;"
                                 src="{{ asset('storage/' . $asset->picture) }}" 
                                 alt="{{ $asset->asset_name }}"
                                 title="{{ $asset->asset_name }} | {{ $asset->asset_type }}">
                            @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                 style="height: 200px; margin: 0 auto;">
                                <i class="fas fa-image fa-3x text-gray-400"></i>
                                <span class="ml-2">No image available</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card-header {
        border-bottom: 1px solid rgba(0,0,0,.125);
    }
    .small {
        font-size: 0.875rem;
    }
    .badge {
        font-size: 0.75rem;
        padding: 0.35em 0.65em;
        font-weight: 500;
    }
    .img-fluid {
        max-width: 100%;
        height: auto;
    }
</style>
@endsection