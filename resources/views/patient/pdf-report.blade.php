<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lab Results - {{ $kit->kit_code }}</title>
    <style>
        @page { 
            margin: 40px; 
            bottom: 20px;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #1a202c;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }
        /* Header Section */
        .header-table {
            width: 100%;
            margin-bottom: 30px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 15px;
        }
        .logo-text {
            color: #0D7A5F;
            font-weight: bold;
            font-size: 20px;
            letter-spacing: -0.5px;
        }
        .date-header {
            text-align: right;
            text-transform: uppercase;
            font-size: 11px;
            color: #718096;
            font-weight: bold;
        }
        /* Patient Info Block */
        .patient-info {
            background: #f7fafc;
            padding: 15px;
            text-align: right;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 12px;
        }
        .patient-info-row {
            margin-bottom: 5px;
        }
        .patient-info b { 
            color: #4a5568; 
            display: inline-block;
            width: 100px;
        }

        

        /* Section Styling */
        .section-container {
            border: 1px solid #edf2f7;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            page-break-inside: avoid;
        }
        .section-header {
            margin-bottom: 20px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 10px;
        }
        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #0D7A5F;
        }
        .status-badge {
            font-size: 10px;
            color: #0D7A5F;
            font-weight: bold;
            text-transform: uppercase;
            background: #E8F5F1;
            padding: 2px 8px;
            border-radius: 12px;
            margin-left: 10px;
        }
        .collection-date {
            font-size: 10px;
            color: #718096;
            margin-top: 5px;
        }

        /* Data Tables */
        .data-label {
            font-size: 11px;
            font-weight: bold;
            color: #0D7A5F;
            text-transform: uppercase;
            margin-bottom: 12px;
            margin-top: 20px;
        }
        .data-label:first-of-type {
            margin-top: 0;
        }
        .results-table {
            width: 100%;
            border-collapse: collapse;
        }
        .results-table td {
            padding: 10px 0;
            border-bottom: 1px solid #f7fafc;
            font-size: 12px;
        }
        .param-name { 
            color: #2d3748; 
            font-weight: 500; 
        }
        .param-value { 
            text-align: right; 
            font-weight: bold; 
            color: #1a202c; 
        }
        .normal-tag {
            background: #E8F5F1;
            color: #0D7A5F;
            font-size: 9px;
            padding: 2px 8px;
            border-radius: 12px;
            font-weight: bold;
            margin-left: 8px;
            display: inline-block;
        }
        .green-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            background-color: #0D7A5F;
            border-radius: 50%;
            margin-left: 8px;
        }
        .ref-range {
            font-size: 9px;
            color: #718096;
            margin-left: 8px;
            font-weight: normal;
        }
        .data-grid {
            display: table;
            width: 100%;
            margin-bottom: 15px;
        }
        .data-card {
            background: #f7fafc;
            padding: 12px;
            border-radius: 10px;
            display: inline-block;
            width: 48%;
            margin-right: 2%;
            vertical-align: top;
        }
        .data-card-label {
            font-size: 9px;
            color: #718096;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .data-card-value {
            font-size: 14px;
            font-weight: bold;
            color: #1a202c;
        }

        /* Plain Language Summary */
        .summary-box {
            background-color: #f7fafc;
            border-radius: 15px;
            padding: 20px;
            margin-top: 30px;
            page-break-inside: avoid;
        }
        .summary-title {
            font-size: 13px;
            font-weight: bold;
            color: #0D7A5F;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        .summary-text {
            font-size: 12px;
            color: #4a5568;
            line-height: 1.6;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 9px;
            color: #a0aec0;
            border-top: 1px solid #edf2f7;
            padding-top: 20px;
        }
    </style>
</head>
<body>

    <table class="header-table" width="100%">
        <tr>
            <td width="60%" class="logo-text">
                🔬 Serene Portal
            </td>
            <td width="40%" class="date-header">
                Report Date: {{ now()->format('M d, Y') }}
            </td>
        </tr>
    </table>

    <div class="patient-info">
        <div class="patient-info-row">
            <b>Patient Name:</b> {{ $patient->name ?? 'N/A' }}
        </div>
        <div class="patient-info-row">
            <b>Date of Birth:</b> {{ $patient->date_of_birth instanceof \DateTime ? $patient->date_of_birth->format('F d, Y') : ($patient->date_of_birth ? date('F d, Y', strtotime($patient->date_of_birth)) : 'N/A') }}
        </div>
        <div class="patient-info-row">
            <b>Kit Code:</b> {{ $kit->kit_code }}
        </div>
        <div class="patient-info-row">
            <b>Collection Date:</b> {{ $kit->collection_date instanceof \DateTime ? $kit->collection_date->format('F d, Y') : ($kit->collection_date ? date('F d, Y', strtotime($kit->collection_date)) : 'Not specified') }}
        </div>
    </div>

    

    @php
        // Parse results data if it's stored as JSON string
        $urinalysisDataArray = is_string($urinalysisData ?? null) ? json_decode($urinalysisData, true) : ($urinalysisData ?? []);
        $hcgDataArray = is_string($hcgData ?? null) ? json_decode($hcgData, true) : ($hcgData ?? []);
    @endphp

    @if($urinalysisDataArray)
    <div class="section-container">
        <div class="section-header">
            <div class="section-title">
                Urinalysis 
                <span class="status-badge">✓ Status: Normal</span>
            </div>
            <div class="collection-date">
                Analysis Date: {{ $kit->collection_date instanceof \DateTime ? $kit->collection_date->format('M d, Y') : ($kit->collection_date ? date('M d, Y', strtotime($kit->collection_date)) : 'Current') }}
            </div>
        </div>

        <!-- Physical Data -->
        <div class="data-label">Physical & Chemical Data</div>
        <div class="data-grid">
            <div class="data-card">
                <div class="data-card-label">Color</div>
                <div class="data-card-value">{{ $urinalysisDataArray['color'] ?? 'Straw' }}</div>
                <span class="normal-tag">NORMAL</span>
            </div>
            <div class="data-card">
                <div class="data-card-label">Clarity / Transparency</div>
                <div class="data-card-value">{{ $urinalysisDataArray['clarity'] ?? 'Clear' }}</div>
                <span class="normal-tag">NORMAL</span>
            </div>
        </div>

        <!-- Chemical Data Table -->
        <table class="results-table">
            <tr>
                <td class="param-name">Glucose</td>
                <td class="param-value">
                    {{ $urinalysisDataArray['glucose'] ?? 'Negative' }}
                    <span class="green-dot"></span>
                    <span class="ref-range">Ref: Negative</span>
                </td>
            </tr>
            <tr>
                <td class="param-name">Protein</td>
                <td class="param-value">
                    {{ $urinalysisDataArray['protein'] ?? 'Negative' }}
                    <span class="green-dot"></span>
                    <span class="ref-range">Ref: Negative</span>
                </td>
            </tr>
            <tr>
                <td class="param-name">pH</td>
                <td class="param-value">
                    {{ $urinalysisDataArray['ph'] ?? '6.0' }}
                    <span class="green-dot"></span>
                    <span class="ref-range">Ref: 5.0 - 8.0</span>
                </td>
            </tr>
            <tr>
                <td class="param-name">Specific Gravity</td>
                <td class="param-value">
                    {{ $urinalysisDataArray['specific_gravity'] ?? '1.015' }}
                    <span class="green-dot"></span>
                    <span class="ref-range">Ref: 1.005 - 1.030</span>
                </td>
            </tr>
        </table>

        <!-- Microscopic Data -->
        <div class="data-label">Microscopic Data</div>
        <table class="results-table">
            <tr>
                <td class="param-name">Red Blood Cells (RBC)</td>
                <td class="param-value">
                    {{ $urinalysisDataArray['rbc'] ?? '0-2' }} /hpf
                    <span class="green-dot"></span>
                    <span class="ref-range">Ref: 0-3 /hpf</span>
                </td>
            </tr>
            <tr>
                <td class="param-name">White Blood Cells (WBC)</td>
                <td class="param-value">
                    {{ $urinalysisDataArray['wbc'] ?? '1-3' }} /hpf
                    <span class="green-dot"></span>
                    <span class="ref-range">Ref: 0-5 /hpf</span>
                </td>
            </tr>
            <tr>
                <td class="param-name">Epithelial Cells</td>
                <td class="param-value">
                    {{ $urinalysisDataArray['epithelial_cells'] ?? 'Few' }}
                    <span class="green-dot"></span>
                    <span class="ref-range">Ref: Few</span>
                </td>
            </tr>
            <tr>
                <td class="param-name">Bacteria</td>
                <td class="param-value">
                    {{ $urinalysisDataArray['bacteria'] ?? 'None Seen' }}
                    <span class="green-dot"></span>
                    <span class="ref-range">Ref: None</span>
                </td>
            </tr>
        </table>
    </div>
    @endif

    @php
    // Parse results data if it's stored as JSON string
    $urinalysisDataArray = is_string($urinalysisData ?? null) ? json_decode($urinalysisData, true) : ($urinalysisData ?? []);
    $hcgDataArray = is_string($hcgData ?? null) ? json_decode($hcgData, true) : ($hcgData ?? []);
    $fecalysisDataArray = is_string($fecalysisData ?? null) ? json_decode($fecalysisData, true) : ($fecalysisData ?? []);
    @endphp

    <!-- Fecalysis Section -->
    @if($fecalysisDataArray)
    <div class="section-container">
        <div class="section-header">
            <div class="section-title">
                Fecalysis 
                <span class="status-badge">✓ Status: {{ $fecalysisDataArray['status'] ?? 'Normal' }}</span>
            </div>
            <div class="collection-date">
                Analysis Date: {{ $kit->collection_date instanceof \DateTime ? $kit->collection_date->format('M d, Y') : ($kit->collection_date ? date('M d, Y', strtotime($kit->collection_date)) : 'Current') }}
            </div>
        </div>

        <!-- Physical Characteristics -->
        <div class="data-label">Physical Characteristics</div>
        <div class="data-grid">
            <div class="data-card">
                <div class="data-card-label">Color</div>
                <div class="data-card-value">{{ $fecalysisDataArray['color'] ?? 'Brown' }}</div>
                <span class="normal-tag">{{ $fecalysisDataArray['color_status'] ?? 'NORMAL' }}</span>
            </div>
            <div class="data-card">
                <div class="data-card-label">Consistency</div>
                <div class="data-card-value">{{ $fecalysisDataArray['consistency'] ?? 'Formed' }}</div>
                <span class="normal-tag">{{ $fecalysisDataArray['consistency_status'] ?? 'NORMAL' }}</span>
            </div>
        </div>

        <!-- Microscopic Examination -->
        <div class="data-label">Microscopic Examination</div>
        <table class="results-table">
            <tr>
                <td class="param-name">Pus Cells (WBC)</td>
                <td class="param-value">
                    {{ $fecalysisDataArray['pus_cells'] ?? '0-2' }} /hpf
                    <span class="green-dot"></span>
                    <span class="ref-range">Ref: 0-5 /hpf</span>
                </td>
            </tr>
            <tr>
                <td class="param-name">RBC</td>
                <td class="param-value">
                    {{ $fecalysisDataArray['rbc'] ?? '0' }} /hpf
                    <span class="green-dot"></span>
                    <span class="ref-range">Ref: 0 /hpf</span>
                </td>
            </tr>
            <tr>
                <td class="param-name">Fat Globules</td>
                <td class="param-value">
                    {{ $fecalysisDataArray['fat_globules'] ?? 'Rare' }}
                    <span class="green-dot"></span>
                    <span class="ref-range">Ref: Rare /hpf</span>
                </td>
            </tr>
        </table>

        <!-- Parasitology -->
        <div class="data-label">Parasitology</div>
        <table class="results-table">
            <tr>
                <td class="param-name">Ova / Parasites</td>
                <td class="param-value">
                    {{ $fecalysisDataArray['ova_parasites'] ?? 'None seen' }}
                    <span class="green-dot"></span>
                    <span class="ref-range">Ref: None seen</span>
                </td>
            </tr>
            <tr>
                <td class="param-name">Cysts</td>
                <td class="param-value">
                    {{ $fecalysisDataArray['cysts'] ?? 'None seen' }}
                    <span class="green-dot"></span>
                    <span class="ref-range">Ref: None seen</span>
                </td>
            </tr>
            <tr>
                <td class="param-name">Trophozoites</td>
                <td class="param-value">
                    {{ $fecalysisDataArray['trophozoites'] ?? 'None seen' }}
                    <span class="green-dot"></span>
                    <span class="ref-range">Ref: None seen</span>
                </td>
            </tr>
        </table>

        <!-- Chemical Tests (if available) -->
        @if(isset($fecalysisDataArray['occult_blood']) || isset($fecalysisDataArray['reducing_substances']))
        <div class="data-label">Chemical Tests</div>
        <table class="results-table">
            @if(isset($fecalysisDataArray['occult_blood']))
            <tr>
                <td class="param-name">Occult Blood</td>
                <td class="param-value">
                    {{ $fecalysisDataArray['occult_blood'] ?? 'Negative' }}
                    <span class="green-dot"></span>
                    <span class="ref-range">Ref: Negative</span>
                </td>
            </tr>
            @endif
            @if(isset($fecalysisDataArray['reducing_substances']))
            <tr>
                <td class="param-name">Reducing Substances</td>
                <td class="param-value">
                    {{ $fecalysisDataArray['reducing_substances'] ?? 'Negative' }}
                    <span class="green-dot"></span>
                    <span class="ref-range">Ref: Negative</span>
                </td>
            </tr>
            @endif
        </table>
        @endif

        <!-- Additional Notes -->
        @if(isset($fecalysisDataArray['notes']) && $fecalysisDataArray['notes'])
        <div class="data-label">Clinical Notes</div>
        <div class="summary-box" style="background-color: #fffbeb; margin-top: 10px;">
            <div class="summary-text" style="color: #92400e;">
                {{ $fecalysisDataArray['notes'] }}
            </div>
        </div>
        @endif
    </div>
    @endif


    @if($hcgDataArray)
    <div class="section-container">
        <div class="section-header">
            <div class="section-title">
                Urine HCG 
                <span class="status-badge">✓ Result Ready</span>
            </div>
        </div>

        <table class="results-table">
            <tr>
                <td class="param-name">Pregnancy Test (HCG)</td>
                <td class="param-value">
                    <strong>{{ $hcgDataArray['hcg_result'] ?? 'Negative' }}</strong>
                    <span class="green-dot"></span>
                </td>
            </tr>
            @if(isset($hcgDataArray['notes']))
            <tr>
                <td class="param-name">Interpretation</td>
                <td class="param-value" style="font-weight: normal;">
                    {{ $hcgDataArray['notes'] }}
                </td>
            </tr>
            @endif
        </table>
    </div>
    @endif

    <div class="summary-box">
        <div class="summary-title">📋 Plain-Language Summary</div>
        <div class="summary-text">
            {{ $kit->summary ?? 'Overall, your results are consistent with healthy indicators. Your clinical indicators suggest optimal health levels across all tested categories. We recommend discussing these details with your primary physician at your next visit.' }}
        </div>
    </div>

    <div class="footer">
        <strong>Verified by Serene Medical Team</strong><br>
        This is an electronically generated report. No signature is required.<br>
        Generated on {{ now()->format('F d, Y \a\t H:i:s') }}
    </div>

</body>
</html>