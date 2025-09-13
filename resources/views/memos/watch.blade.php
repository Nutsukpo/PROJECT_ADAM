@extends('layout.master')

@section('title', 'View Memo')

@section('content')
<div class="container">
    <div class="memo-wrapper bg-white rounded shadow-sm p-4 mx-auto" style="max-width: 800px;">
        
        <!-- Header with status and actions -->
        <div class="memo-header d-flex justify-content-between align-items-center mb-4">
            <h4 class="memo-title text-dark mb-0">Memo</h4>
            <div class="d-flex align-items-center gap-2">
                <span class="badge rounded-pill bg-{{ \App\Models\Memos::stageColors()[$memo->status] ?? 'secondary' }} px-1 py-2 text-light">
                  <h6>Status: {{ ucfirst($memo->status) }}</h6>  
                </span>
                <a href="{{ route('memos.download.word', $memo->id) }}" class="btn btn-sm btn-outline-light bg-info">
                    <i class="fas fa-download me-1"></i> Download
                </a>
            </div>
        </div>

        <!-- Letterhead -->
        <div class="text-center mb-4">
            <img src="{{ asset('img/LETTER HEAD.jpeg') }}" 
                 alt="Company Letterhead" 
                 class="letterhead-img">
        </div>

        <!-- Memo metadata -->
        <div class="memo-meta mb-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="meta-item">
                        <span class="text-dark">TO:</span>
                        <span class="meta-value">{{ $memo->to }}</span>
                    </div>
                    <div class="meta-item">
                        <span class="text-dark">FROM:</span>
                        <span class="meta-value">{{ $memo->from }}</span>
                    </div>
                    <div class="meta-item">
                        <span class="text-dark">DATE:</span>
                        <span class="meta-value">{{ \Carbon\Carbon::parse($memo->date)->format('M j, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Subject -->
        <div class="memo-subject mb-4">
            <h5 class="subject-title border-bottom pb-2">SUBJECT: <u>{{ $memo->subject }}</u></h5>
        </div>

        <!-- Body content -->
        <div class="memo-content mb-5">
            <div class="content-body p-2 bg-light rounded">
                {!! nl2br(e($memo->body)) !!}
            </div>
        </div>

        <!-- Signature section -->
        <div>
            <!-- <div class="memo-signature">
                @if($memo->signature)
                    <div class="signature-box text-center p-3">
                        <img src="{{ asset('storage/' . $memo->signature) }}" 
                            alt="Signature" 
                            class="signature-img mb-2">
                        <div class="signature-name">{{ $memo->name_of_employee }}</div>
                        <div class="signature-position text-muted small">{{ $memo->from }}</div>
                    </div>
                @else
                    <div class="alert alert-light text-center">No signature available</div>
                @endif
            </div> -->
            <div class=" d-sm-flex align-items-center justify-content-between">
                <div>
                    @if($memo->signature)
                    <img src="{{ asset('storage/' . $memo->signature) }}" alt="Signature" style="max-width:200px;">
                     @endif
                    <p>{{ $memo->name_of_employee }}</p>
                    <p>{{ $memo->from }}</p>
                </div>
                <div>
                @if($memo->minutes && $memo->status != 'draft')
                <div class="mt-4">
                    <div class="">
                       <u> {!! nl2br(e($memo->minute_to)) !!}</u>
                    </div>
                </div>
                @endif
                <div class="mb-3">
                    <div class="">
                        {!! nl2br(e($memo->minutes)) !!}
                    </div>
                </div>
                <div class="mb-3">
                <div class="">
                @if($memo->minute_signature)
                        <div class="mb-3">
                            <!-- <p><strong>Signed:</strong></p> -->
                            <img src="{{ asset('storage/' . $memo->minute_signature) }}" alt="Signature" style="max-width:200px;">
                        </div>
                @endif
                </div>
                </div>
                <div class="mb-3">
                <div class=" ">
                    {!! nl2br(e($memo->minute_date)) !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .memo-wrapper {
        border: 1px solid #e0e3eb;
    }
    
    .memo-title {
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    
    .letterhead-img {
        max-height: 100px;
        width: auto;
    }
    
    .meta-item {
        margin-bottom: 0.5rem;
    }
    
    .meta-label {
        font-weight: 600;
        color: #4a6fdc;
        display: inline-block;
        min-width: 50px;
    }
    
    .meta-value {
        color: #495057;
    }
    
    .subject-title {
        font-weight: 600;
        color: #343a40;
    }
    
    .content-body {
        /* white-space: pre-wrap; */
        line-height: 1.7;
        /* border-left: 3px solid #4a6fdc; */
    }
    
    .signature-box {
        /* border: 1px dashed #dee2e6; */
        /* border-radius: 5px; */
        display: inline-block;
        /* background-color: #f8fafc; */
    }
    
    .signature-img {
        max-width: 180px;
        max-height: 70px;
        /* border-bottom: 1px solid #e9ecef; */
        padding-bottom: 8px;
    }
    
    .signature-name {
        font-weight: 600;
        margin-top: 8px;
    }
</style>
@endsection