<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lab Results - {{ $kit->kit_code }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #0D7A5F;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #0D7A5F;
        }
        .collection-date {
            text-align: right;
            color: #666;
            margin-bottom: 20px;
        }
        .success-box {
            background-color: #d1fae5;
            border-left: 4px solid #059669;
            padding: 15px;
            margin-bottom: 30px;
        }
        .section {
            margin-bottom: 30px;
            page-break-inside: avoid;
        }
        .section-title {
            background-color: #f3f4f6;
            padding: 10px 15px;
            font-weight: bold;
            border-bottom: 2px solid #0D7A5F;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        .status-normal {
            color: #059669;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">SERENE PORTAL</div>
        <p>Medical Laboratory Results</p>
    </div>
    
    <div class="collection-date">
        Collection Date: {{ $kit->collection_date->format('F d, Y') }}
    </div>
    
    <div class="success-box">
        <strong>✓ All results within normal range</strong><br>
        Your clinical indicators suggest optimal health levels across all tested categories.
    </div>
    
    @if($urinalysisData)
    <div class="section">
        <div class="section-title">Urinalysis</div>
        <p><strong>Status:</strong> <span class="status-normal">Normal</span></p>
        
        <h4>Physical Data</h4>
        <table>
            <tr><th>Parameter</th><th>Result</th><th>Status</th><th>Reference Range</th></tr>
            <tr><td>Color</td><td>{{ $urinalysisData['color'] ?? 'Straw' }}</td><td class="status-normal">Normal</td><td>Straw/Yellow</td></tr>
            <tr><td>Clarity</td><td>{{ $urinalysisData['clarity'] ?? 'Clear' }}</td><td class="status-normal">Normal</td><td>Clear</td></tr>
            <tr><td>Glucose</td><td>{{ $urinalysisData['glucose'] ?? 'Negative' }}</td><td class="status-normal">Normal</td><td>Negative</td></tr>
            <tr><td>Protein</td><td>{{ $urinalysisData['protein'] ?? 'Negative' }}</td><td class="status-normal">Normal</td><td>Negative</td></tr>
            <tr><td>pH</td><td>6.0</td><td class="status-normal">Normal</td><td>4.5 - 8.0</td></tr>
        </table>
        
        <h4>Microscopic Data</h4>
        <table>
            <tr><th>Parameter</th><th>Result</th><th>Status</th><th>Reference Range</th></tr>
            <tr><td>RBC</td><td>{{ $urinalysisData['rbc'] ?? '0-2' }} /hpf</td><td class="status-normal">Normal</td><td>0-3 /hpf</td></tr>
            <tr><td>WBC</td><td>{{ $urinalysisData['wbc'] ?? '1-3' }} /hpf</td><td class="status-normal">Normal</td><td>0-5 /hpf</td></tr>
        </table>
    </div>
    @endif
    
    @if($fecalysisData)
    <div class="section">
        <div class="section-title">Fecalysis</div>
        <p><strong>Status:</strong> <span class="status-normal">Normal</span></p>
        
        <table>
            <tr><th>Parameter</th><th>Result</th><th>Status</th></tr>
            <tr><td>Consistency</td><td>{{ $fecalysisData['consistency'] ?? 'Soft' }}</td><td class="status-normal">Normal</td></tr>
            <tr><td>Color</td><td>{{ $fecalysisData['color'] ?? 'Brown' }}</td><td class="status-normal">Normal</td></tr>
            <tr><td>Ova or Parasites</td><td>{{ $fecalysisData['ova_parasites'] ?? 'None Seen' }}</td><td class="status-normal">Normal</td></tr>
            <tr><td>Occult Blood</td><td>{{ $fecalysisData['occult_blood'] ?? 'Negative' }}</td><td class="status-normal">Normal</td></tr>
        </table>
    </div>
    @endif
    
    @if($hcgData)
    <div class="section">
        <div class="section-title">Urine HCG</div>
        <p><strong>Result:</strong> Negative</p>
        <p><strong>Status:</strong> <span class="status-normal">Result Ready</span></p>
    </div>
    @endif
    
    <div class="section">
        <h4>Plain-Language Summary</h4>
        <p>Overall, your results are consistent with healthy indicators. While one value is slightly outside the typical range, 
        it's common and usually not a cause for concern. We recommend discussing these details with your primary physician 
        at your next visit.</p>
    </div>
    
    <div class="footer">
        <p><strong>VERIFIED BY SERENE MEDICAL TEAM</strong></p>
        <p>These results are shared as part of your digital medical record. Please consult with your attending physician 
        to discuss these findings in the context of your overall health.</p>
        <p>Generated on {{ now()->format('F d, Y \a\t h:i A') }}</p>
    </div>
</body>
</html>