@extends('layouts.app')

@section('content')

<style>
    .event-card {
        border: none;
        border-radius: 16px;
        background: #ffffff;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .event-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 18px 35px rgba(0, 0, 0, 0.1);
    }

    .event-card-header {
        position: relative;
        background: linear-gradient(135deg, #10b981, #059669);
        height: 100px;
        padding: 1.25rem;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
    }

    .price-badge {
        font-weight: 700;
        padding: 0.5rem 0.9rem;
        border-radius: 12px;
        font-size: 0.85rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .event-card-body {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .meta-info-item {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        color: #475569;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .meta-info-item i {
        color: #10b981;
        font-size: 1rem;
    }

    .progress-thin {
        height: 6px;
        border-radius: 10px;
        background-color: #f1f5f9;
    }

    .btn-details {
        background: #f8fafc;
        color: #10b981;
        border: 1px solid #e2e8f0;
        font-weight: 600;
        border-radius: 10px;
        padding: 0.65rem 1.25rem;
        width: 100%;
        transition: all 0.2s ease;
    }

    .event-card:hover .btn-details {
        background: linear-gradient(135deg, #10b981, #059669);
        color: #ffffff;
        border-color: transparent;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .empty-state {
        background: #ffffff;
        border-radius: 16px;
        padding: 4rem 2rem;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }
</style>

<div class="container-fluid py-3">

    <!-- Header Section -->
    <div class="mb-4">
        <h3 class="fw-bold text-dark mb-1">
            <i class="bi bi-calendar-event text-success me-2"></i>Événements disponibles
        </h3>
        <p class="text-muted small mb-0">Découvrez et réservez vos places pour les prochains événements du BDE.</p>
    </div>

    <div class="row g-4">
        @forelse($events as $event)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card event-card h-100">

                    <!-- Card Top Graphic Header -->
                    <div class="event-card-header">
                        <span class="badge bg-white bg-opacity-20 text-white backdrop-blur rounded-pill px-3 py-1.5 small">
                            <i class="bi bi-tag-fill me-1"></i> BDE Event
                        </span>

                        <!-- Price Tag -->
                        @if($event->prix == 0)
                            <span class="badge bg-white text-success price-badge">
                                Gratuit
                            </span>
                        @else
                            <span class="badge bg-dark text-white price-badge">
                                {{ $event->prix }} DH
                            </span>
                        @endif
                    </div>

                    <!-- Card Body -->
                    <div class="event-card-body">
                        <h4 class="fw-bold text-dark mb-2 text-truncate" title="{{ $event->titre }}">
                            {{ $event->titre }}
                        </h4>

                        <p class="text-muted small mb-4 flex-grow-1" style="line-height: 1.5;">
                            {{ Str::limit($event->description, 90) }}
                        </p>

                        <!-- Meta Info List -->
                        <div class="mb-4">
                            <div class="meta-info-item">
                                <i class="bi bi-calendar3"></i>
                                <span class="fw-medium">{{ $event->date }}</span>
                            </div>
                            <div class="meta-info-item">
                                <i class="bi bi-clock"></i>
                                <span>{{ $event->heure }}</span>
                            </div>
                            <div class="meta-info-item">
                                <i class="bi bi-geo-alt"></i>
                                <span class="text-truncate" style="max-width: 220px;">{{ $event->lieu }}</span>
                            </div>
                        </div>

                        <!-- Availability Progress -->
                        @php
                            $restantes = $event->placesRestantes();
                            $percentage = $event->places > 0 ? ($restantes / $event->places) * 100 : 0;
                        @endphp
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center small mb-1">
                                <span class="text-muted">Places restantes</span>
                                <span class="fw-bold {{ $restantes > 0 ? 'text-success' : 'text-danger' }}">
                                    {{ $restantes }} / {{ $event->places }}
                                </span>
                            </div>
                            <div class="progress progress-thin">
                                <div class="progress-bar {{ $restantes > 0 ? 'bg-success' : 'bg-danger' }}"
                                     role="progressbar"
                                     style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>

                        <!-- CTA Button -->
                        <a href="{{ route('events.show', $event) }}" class="btn btn-details d-flex align-items-center justify-content-center">
                            <span>Voir détails</span>
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>

                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state">
                    <div class="bg-light rounded-circle d-inline-flex p-3 mb-3">
                        <i class="bi bi-calendar-x text-muted fs-1"></i>
                    </div>
                    <h4 class="fw-bold text-dark">Aucun événement disponible</h4>
                    <p class="text-muted mb-0">Revenez plus tard pour découvrir les nouvelles activités et soirées !</p>
                </div>
            </div>
        @endforelse
    </div>

</div>

@endsection
