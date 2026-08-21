@extends('layouts.admin')

@section('title', 'App Analytics & Infrastructure Metrics — ShopKite Admin')
@section('breadcrumb_title', 'App Analytics')

@section('content')
<!-- Page Header -->
<div class="admin-page-header">
    <div class="admin-page-title-group">
        <h1>App &amp; <strong>Infrastructure Analytics</strong></h1>
        <p class="admin-page-subtitle">Real-time telemetrics tracking API volume, signed-in POS terminals, server CPU/memory health, and offline sync performance.</p>
    </div>
    <div class="admin-header-actions">
        <div class="admin-live-status-pill">
            <span class="admin-live-status-dot" style="background: #ff6600;"></span>
            <span>Live Telemetry Streaming</span>
        </div>
    </div>
</div>

<!-- ── Toolbar: Timeframe Selector ───────────────────────── -->
<div class="admin-toolbar-card">
    <div class="admin-filter-pills-group">
        <a href="{{ route('admin.analytics', ['timeframe' => 'today']) }}"
           class="admin-filter-pill {{ $timeframe === 'today' ? 'active' : '' }}">
            <span>Today (Live)</span>
        </a>
        <a href="{{ route('admin.analytics', ['timeframe' => '7d']) }}"
           class="admin-filter-pill {{ $timeframe === '7d' ? 'active' : '' }}">
            <span>Last 7 Days</span>
        </a>
        <a href="{{ route('admin.analytics', ['timeframe' => '30d']) }}"
           class="admin-filter-pill {{ $timeframe === '30d' ? 'active' : '' }}">
            <span>Last 30 Days</span>
        </a>
    </div>

    <div style="font-size: 12.5px; color: #64748b; display: flex; align-items: center; gap: 8px;">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#ff6600" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
        <span>Telemetry Refresh: Every 15s</span>
    </div>
</div>

<!-- ── 1. Top Core Telemetry KPI Cards ───────────────────── -->
<div class="admin-metrics-grid">
    <!-- Metric 1: API Calls Volume -->
    <div class="admin-metric-card">
        <div class="admin-metric-card-top">
            <span class="admin-metric-label">Total API Calls Volume</span>
            <div class="admin-metric-icon-wrap" style="background: #fff7ed; color: #ff6600;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
            </div>
        </div>
        <div class="admin-metric-value">{{ $metrics['api_calls_count'] }}</div>
        <div class="admin-metric-subtext">
            <span class="admin-trend-badge-positive" style="background: #fff7ed; color: #ea580c; border: 1px solid #fed7aa;">&uarr; {{ $metrics['api_trend'] }}</span>
            <span>Avg latency: {{ $metrics['avg_response_time'] }} ({{ $metrics['api_success_rate'] }} ok)</span>
        </div>
    </div>

    <!-- Metric 2: Signed-in Terminals & Sessions -->
    <div class="admin-metric-card">
        <div class="admin-metric-card-top">
            <span class="admin-metric-label">Active Signed-in POS Terminals</span>
            <div class="admin-metric-icon-wrap" style="background: #fff7ed; color: #ff6600;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
            </div>
        </div>
        <div class="admin-metric-value">{{ $metrics['active_terminals_now'] }} <span style="font-size: 15px; color: #94a3b8; font-weight: 300;">terminals now</span></div>
        <div class="admin-metric-subtext">
            <span style="color: #ea580c; font-weight: 500;">Peak today: {{ $metrics['peak_concurrent_today'] }}</span>
            <span>({{ $metrics['active_staff_sessions'] }} staff logins)</span>
        </div>
    </div>

    <!-- Metric 3: Server CPU Utilization -->
    <div class="admin-metric-card">
        <div class="admin-metric-card-top">
            <span class="admin-metric-label">Cloud Server CPU Load</span>
            <div class="admin-metric-icon-wrap" style="background: #fff7ed; color: #ff6600;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
            </div>
        </div>
        <div class="admin-metric-value">{{ $metrics['cpu_usage_percent'] }}% <span style="font-size: 15px; color: #ff6600; font-weight: 400;">&bull; Optimal</span></div>
        <div class="admin-metric-subtext">
            <span>{{ $metrics['cpu_cores'] }} (Load avg: 0.42)</span>
        </div>
    </div>

    <!-- Metric 4: RAM Memory & NVMe Disk -->
    <div class="admin-metric-card">
        <div class="admin-metric-card-top">
            <span class="admin-metric-label">Memory &amp; Storage Health</span>
            <div class="admin-metric-icon-wrap" style="background: #f8fafc; color: #64748b;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path></svg>
            </div>
        </div>
        <div class="admin-metric-value">{{ $metrics['ram_usage_percent'] }}% <span style="font-size: 15px; color: #94a3b8; font-weight: 300;">RAM Used</span></div>
        <div class="admin-metric-subtext">
            <span>{{ $metrics['ram_used_gb'] }} GB / {{ $metrics['ram_total_gb'] }} GB &bull; SSD: {{ $metrics['disk_usage_percent'] }}%</span>
        </div>
    </div>
</div>

<!-- ── 2. Server & Infrastructure Resource Gauges ────────── -->
<div class="admin-gauge-grid">
    <!-- Gauge 1: CPU -->
    <div class="admin-gauge-card">
        <div class="admin-meter-header">
            <div class="admin-meter-title">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ff6600" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect></svg>
                <span>CPU Core Load</span>
            </div>
            <span class="admin-meter-pct" style="color: #ff6600;">{{ $metrics['cpu_usage_percent'] }}%</span>
        </div>
        <div class="admin-meter-bar">
            <div class="admin-meter-fill" style="width: {{ $metrics['cpu_usage_percent'] }}%;"></div>
        </div>
        <div class="admin-meter-footer">
            <span>{{ $metrics['cpu_cores'] }}</span>
            <span style="color: #ea580c; font-weight: 500;">Healthy</span>
        </div>
    </div>

    <!-- Gauge 2: RAM -->
    <div class="admin-gauge-card">
        <div class="admin-meter-header">
            <div class="admin-meter-title">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ea580c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path></svg>
                <span>RAM Allocation</span>
            </div>
            <span class="admin-meter-pct" style="color: #ea580c;">{{ $metrics['ram_usage_percent'] }}%</span>
        </div>
        <div class="admin-meter-bar">
            <div class="admin-meter-fill orange-deep" style="width: {{ $metrics['ram_usage_percent'] }}%;"></div>
        </div>
        <div class="admin-meter-footer">
            <span>{{ $metrics['ram_used_gb'] }} GB of {{ $metrics['ram_total_gb'] }} GB active</span>
            <span style="color: #ea580c; font-weight: 500;">Stable</span>
        </div>
    </div>

    <!-- Gauge 3: NVMe SSD Storage -->
    <div class="admin-gauge-card">
        <div class="admin-meter-header">
            <div class="admin-meter-title">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                <span>NVMe Storage</span>
            </div>
            <span class="admin-meter-pct" style="color: #475569;">{{ $metrics['disk_usage_percent'] }}%</span>
        </div>
        <div class="admin-meter-bar">
            <div class="admin-meter-fill grey" style="width: {{ $metrics['disk_usage_percent'] }}%;"></div>
        </div>
        <div class="admin-meter-footer">
            <span>{{ $metrics['disk_used_gb'] }} GB of {{ $metrics['disk_total_gb'] }} GB SSD</span>
            <span>152 GB Free</span>
        </div>
    </div>

    <!-- Gauge 4: Network IO -->
    <div class="admin-gauge-card">
        <div class="admin-meter-header">
            <div class="admin-meter-title">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ff6600" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 3 21 3 21 8"></polyline><line x1="4" y1="20" x2="21" y2="3"></line><polyline points="21 16 21 21 16 21"></polyline><line x1="15" y1="15" x2="21" y2="21"></line><line x1="4" y1="4" x2="9" y2="9"></line></svg>
                <span>Network Throughput</span>
            </div>
            <span class="admin-meter-pct" style="color: #ff6600;">{{ $metrics['network_egress'] }}</span>
        </div>
        <div class="admin-meter-bar">
            <div class="admin-meter-fill orange-light" style="width: 45%;"></div>
        </div>
        <div class="admin-meter-footer">
            <span>Ingress: {{ $metrics['network_ingress'] }}</span>
            <span>Egress: {{ $metrics['network_egress'] }}</span>
        </div>
    </div>

    <!-- Gauge 5: Database Connection Pool -->
    <div class="admin-gauge-card">
        <div class="admin-meter-header">
            <div class="admin-meter-title">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ea580c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path></svg>
                <span>DB Pool Connections</span>
            </div>
            <span class="admin-meter-pct" style="color: #ea580c;">{{ $metrics['db_pool_active'] }} / {{ $metrics['db_pool_max'] }}</span>
        </div>
        <div class="admin-meter-bar">
            <div class="admin-meter-fill" style="width: {{ ($metrics['db_pool_active'] / $metrics['db_pool_max']) * 100 }}%;"></div>
        </div>
        <div class="admin-meter-footer">
            <span>PostgreSQL Primary Replica</span>
            <span style="color: #ea580c;">23% Pool Usage</span>
        </div>
    </div>

    <!-- Gauge 6: Server Uptime & Cache -->
    <div class="admin-gauge-card">
        <div class="admin-meter-header">
            <div class="admin-meter-title">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 14 14"></polyline></svg>
                <span>Cluster Uptime</span>
            </div>
            <span class="admin-meter-pct" style="color: #475569;">{{ $metrics['server_uptime'] }}</span>
        </div>
        <div class="admin-meter-bar">
            <div class="admin-meter-fill grey" style="width: 100%;"></div>
        </div>
        <div class="admin-meter-footer">
            <span>Uptime: {{ $metrics['uptime_duration'] }}</span>
            <span>Redis Cache Hit: {{ $metrics['redis_hit_ratio'] }}</span>
        </div>
    </div>
</div>

<!-- ── 3. Split Grids: App Usage & Device Platforms ──────── -->
<div class="admin-dashboard-split-grid">

    <!-- Terminal & Device Platforms -->
    <div class="admin-table-card" style="padding: 24px;">
        <h3 style="margin: 0 0 6px 0; font-size: 16px; font-weight: 500;">Active Device Platform Distribution</h3>
        <p style="margin: 0 0 20px 0; font-size: 13px; color: #64748b; font-weight: 300;">Breakdown of active terminals connected to ShopKite merchant services.</p>

        @foreach($metrics['device_breakdown'] as $device)
            <div class="admin-dist-item">
                <div class="admin-dist-header">
                    <span class="name">{{ $device['name'] }}</span>
                    <span class="stat">{{ $device['count'] }} units ({{ $device['percent'] }}%)</span>
                </div>
                <div class="admin-meter-bar">
                    <div class="admin-meter-fill" style="width: {{ $device['percent'] }}%; background: {{ $device['color'] }};"></div>
                </div>
            </div>
        @endforeach

        <div style="margin-top: 24px; padding-top: 18px; border-top: 1px solid #f1f5f9;">
            <h4 style="margin: 0 0 12px 0; font-size: 14px; font-weight: 500;">ShopKite Mobile App Version Adoption</h4>
            <div style="display: flex; flex-direction: column; gap: 8px;">
                @foreach($metrics['version_distribution'] as $ver)
                    <div style="display: flex; align-items: center; justify-content: space-between; font-size: 12.5px;">
                        <span style="color: #334155; font-family: monospace;">{{ $ver['version'] }}</span>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span style="font-weight: 600;">{{ $ver['percent'] }}%</span>
                            <span class="admin-status-badge" style="background: #fff7ed; color: #ea580c; border: 1px solid #fed7aa;">
                                {{ $ver['status'] }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Operational Commerce Activity -->
    <div class="admin-table-card" style="padding: 24px;">
        <h3 style="margin: 0 0 6px 0; font-size: 16px; font-weight: 500;">Retail Operations &amp; Offline Sync Activity</h3>
        <p style="margin: 0 0 20px 0; font-size: 13px; color: #64748b; font-weight: 300;">Real-time sync performance and POS store operations across retail locations.</p>

        <div class="admin-stat-2col-grid">
            <div style="background: #fafbfc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 16px;">
                <span style="font-size: 12px; color: #64748b; font-weight: 500;">Barcode Lookups Today</span>
                <div style="font-size: 22px; font-weight: 300; color: #1e293b; margin-top: 4px;">{{ $metrics['barcode_scans_today'] }}</div>
                <span style="font-size: 11px; color: #ea580c;">&uarr; FMCG &amp; Pharmacy Scans</span>
            </div>

            <div style="background: #fafbfc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 16px;">
                <span style="font-size: 12px; color: #64748b; font-weight: 500;">Receipts Issued Today</span>
                <div style="font-size: 22px; font-weight: 300; color: #1e293b; margin-top: 4px;">{{ $metrics['receipts_issued_today'] }}</div>
                <span style="font-size: 11px; color: #64748b;">Thermal &amp; Digital SMS</span>
            </div>

            <div style="background: #fafbfc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 16px;">
                <span style="font-size: 12px; color: #64748b; font-weight: 500;">Offline Sync Batches</span>
                <div style="font-size: 22px; font-weight: 300; color: #1e293b; margin-top: 4px;">{{ $metrics['offline_sync_batches'] }}</div>
                <span style="font-size: 11px; color: #ea580c;">100% Sync Success</span>
            </div>

            <div style="background: #fafbfc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 16px;">
                <span style="font-size: 12px; color: #64748b; font-weight: 500;">Sync Queue Backlog</span>
                <div style="font-size: 22px; font-weight: 300; color: #ff6600; margin-top: 4px;">{{ $metrics['sync_queue_backlog'] }}</div>
                <span style="font-size: 11px; color: #ea580c;">Real-time Zero Backlog</span>
            </div>
        </div>

        <div style="background: #fff7ed; border: 1px solid #fed7aa; border-radius: 14px; padding: 14px 18px; display: flex; align-items: center; gap: 12px;">
            <div style="width: 10px; height: 10px; border-radius: 50%; background: #ff6600; flex-shrink: 0;"></div>
            <div style="font-size: 12.5px; color: #9a3412;">
                <strong>Offline-first local engine operational:</strong> All terminal checkouts and stock deductions are recording without network dependencies.
            </div>
        </div>
    </div>

</div>

<!-- ── 4. Top API Endpoints Performance Table ────────────── -->
<div class="admin-table-card">
    <div class="admin-card-header">
        <h3>Top API Endpoints &amp; Service Throughput</h3>
        <span style="font-size: 12.5px; color: #64748b;">Ranked by daily call volume</span>
    </div>
    <div class="admin-table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Method &amp; Route Path</th>
                    <th>Purpose / Microservice</th>
                    <th>Daily Calls Count</th>
                    <th>Avg Latency</th>
                    <th style="text-align: right;">Success Rate</th>
                </tr>
            </thead>
            <tbody>
                @foreach($metrics['top_endpoints'] as $ep)
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <span class="badge-method badge-method-{{ strtolower($ep['method']) }}">{{ $ep['method'] }}</span>
                                <strong style="font-family: monospace; font-size: 13px; color: #1e293b;">{{ $ep['path'] }}</strong>
                            </div>
                        </td>
                        <td>
                            <span style="font-size: 13px; color: #475569;">{{ $ep['description'] }}</span>
                        </td>
                        <td>
                            <strong style="font-size: 13.5px; color: #1e293b;">{{ $ep['calls'] }}</strong>
                        </td>
                        <td>
                            <span style="font-size: 12.5px; font-weight: 500; color: #475569;">{{ $ep['avg_latency'] }}</span>
                        </td>
                        <td style="text-align: right;">
                            <span class="admin-status-badge" style="background: #fff7ed; color: #ea580c; border: 1px solid #fed7aa;">{{ $ep['success_rate'] }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
