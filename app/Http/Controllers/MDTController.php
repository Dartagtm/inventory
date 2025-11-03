<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

class MDTController extends Controller
{
    public function landing()
    {
        $securityLayers = [
            [
                'title' => 'Hybrid Encryption Vault',
                'description' => 'Record data is encrypted with asymmetric keys before entering the MDT ledger, ensuring only authorised parties can decrypt it.'
            ],
            [
                'title' => 'Adaptive Hash Commitment',
                'description' => 'Every record is fingerprinted using SHA-3 hashing with dynamic salts so any tampering is immediately detected.'
            ],
            [
                'title' => 'Consent-bound Smart Contracts',
                'description' => 'Patients define who sees their records. Hospitals must present a valid permission token signed on-chain before data is revealed.'
            ],
        ];

        $features = [
            [
                'title' => 'Chain-verified Medical Records',
                'description' => 'All encounters, lab reports, and prescriptions are registered on the MDT ledger while sensitive payloads stay encrypted in secure storage.'
            ],
            [
                'title' => 'Instant Hospital Onboarding',
                'description' => 'Hospitals request access by scanning a patient wallet address and presenting a signed consent proof approved via MDT smart contracts.'
            ],
            [
                'title' => 'Revocable Permissions',
                'description' => 'Patients revoke hospital access in real time, immediately invalidating the read token across all connected systems.'
            ],
            [
                'title' => 'Analytics-ready Data Lake',
                'description' => 'Aggregated, de-identified insights feed dashboards so administrators can track disease prevalence and treatment outcomes.'
            ],
        ];

        $ecosystemStats = [
            'hospitalPartners' => 186,
            'patientsOnboarded' => 48219,
            'recordsSecured' => 1289340,
            'uptime' => '99.98%',
        ];

        $workflow = [
            'register' => [
                'title' => 'Register & Verify',
                'copy' => 'Hospitals and clinics complete KYB verification and connect their EMR systems via MDT APIs.'
            ],
            'consent' => [
                'title' => 'Request Patient Consent',
                'copy' => 'Patients approve data access directly from the MDT wallet, generating a time-bound smart contract grant.'
            ],
            'share' => [
                'title' => 'Share & Audit Records',
                'copy' => 'Encrypted medical payloads are shared only when consent is valid, logged, and auditable end-to-end.'
            ],
        ];

        $roadmap = [
            [
                'phase' => 'Now',
                'items' => [
                    'MDT Core Network live across 12 provinces',
                    'On-chain consent ledger with emergency overrides',
                    'Interoperability SDK for existing EMR providers',
                ],
            ],
            [
                'phase' => 'Q1 2026',
                'items' => [
                    'AI-guided diagnostic insights for clinicians',
                    'Cross-border data exchange pilots',
                    'Support for zero-knowledge proof based audits',
                ],
            ],
            [
                'phase' => 'Q3 2026',
                'items' => [
                    'Patient-owned insurance claim vaults',
                    'Predictive outbreak surveillance dashboard',
                    'Tokenized incentives for proactive health management',
                ],
            ],
        ];

        return view('mdt.landing', compact('securityLayers', 'features', 'ecosystemStats', 'workflow', 'roadmap'));
    }

    public function hospitalDashboard()
    {
        $summary = [
            'totalPatients' => 48219,
            'activeHospitals' => 186,
            'totalRecords' => 1289340,
            'consentRevocations' => 347,
            'patientMortality' => 918,
        ];

        $diseaseStats = collect([
            [
                'name' => 'Diabetes Mellitus',
                'totalPatients' => 1280,
                'currentMonth' => 54,
                'previousMonth' => 47,
            ],
            [
                'name' => 'Hipertensi Kronis',
                'totalPatients' => 970,
                'currentMonth' => 38,
                'previousMonth' => 35,
            ],
            [
                'name' => 'Penyakit Jantung Koroner',
                'totalPatients' => 612,
                'currentMonth' => 19,
                'previousMonth' => 22,
            ],
            [
                'name' => 'Asma',
                'totalPatients' => 432,
                'currentMonth' => 17,
                'previousMonth' => 21,
            ],
            [
                'name' => 'Tuberkulosis',
                'totalPatients' => 388,
                'currentMonth' => 15,
                'previousMonth' => 13,
            ],
        ])->map(function ($stat) {
            $delta = $stat['currentMonth'] - $stat['previousMonth'];
            $stat['delta'] = $delta;
            $stat['trend'] = $delta > 0 ? 'up' : ($delta < 0 ? 'down' : 'flat');
            $stat['percentChange'] = $stat['previousMonth'] > 0
                ? round(($delta / $stat['previousMonth']) * 100, 1)
                : null;

            return $stat;
        });

        $monthlyAdmissions = [
            'labels' => [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ],
            'values' => [
                3100, 3320, 3495, 3660, 3785, 3920, 4010, 4125, 4280, 4375, 4480, 4605
            ],
        ];

        $consentEvents = [
            [
                'timestamp' => Carbon::now()->subHours(2)->toIso8601String(),
                'patient' => '0x7ab4...91c3',
                'hospital' => 'RS Medika Nusantara',
                'action' => 'Granted access for 90 days'
            ],
            [
                'timestamp' => Carbon::now()->subHours(6)->toIso8601String(),
                'patient' => '0x94ce...a672',
                'hospital' => 'RS Harapan Sentosa',
                'action' => 'Revoked chronic care access'
            ],
            [
                'timestamp' => Carbon::now()->subDay()->toIso8601String(),
                'patient' => '0x1ff2...de80',
                'hospital' => 'RS Jantung Prima',
                'action' => 'Extended emergency access to 30 days'
            ],
        ];

        return view('mdt.hospital-dashboard', [
            'summary' => $summary,
            'diseaseStats' => $diseaseStats,
            'monthlyAdmissions' => $monthlyAdmissions,
            'consentEvents' => $consentEvents,
        ]);
    }

    public function patientDashboard()
    {
        $walletAddress = '0x7ab4F483901c3D1129a4F5D981B12A77AA521C93';

        $medicalHistory = [
            [
                'date' => Carbon::now()->subMonths(9)->format('d M Y'),
                'provider' => 'RS Medika Nusantara',
                'diagnosis' => 'Diabetes Mellitus Tipe 2',
                'treatments' => ['Metformin 500mg', 'Edukasi diet rendah gula'],
                'files' => 4,
            ],
            [
                'date' => Carbon::now()->subMonths(6)->format('d M Y'),
                'provider' => 'RS Harapan Sentosa',
                'diagnosis' => 'Hipertensi Kronis',
                'treatments' => ['Amlodipine 10mg', 'Monitoring tekanan darah'],
                'files' => 2,
            ],
            [
                'date' => Carbon::now()->subMonths(3)->format('d M Y'),
                'provider' => 'RS Siloam Jakarta',
                'diagnosis' => 'Pemeriksaan Lab Rutin',
                'treatments' => ['Panel darah lengkap', 'Profil lipid'],
                'files' => 3,
            ],
        ];

        $activeAccesses = [
            [
                'hospital' => 'RS Medika Nusantara',
                'grantedAt' => Carbon::now()->subMonths(10)->format('d M Y'),
                'expiresAt' => Carbon::now()->addMonths(2)->format('d M Y'),
                'scopes' => ['Rekam medis lengkap', 'Hasil lab', 'Rekomendasi tindakan'],
                'status' => 'Active',
            ],
            [
                'hospital' => 'RS Harapan Sentosa',
                'grantedAt' => Carbon::now()->subMonths(5)->format('d M Y'),
                'expiresAt' => Carbon::now()->addDays(45)->format('d M Y'),
                'scopes' => ['Riwayat rawat inap', 'Medikasi'],
                'status' => 'Active',
            ],
        ];

        $revokedAccesses = [
            [
                'hospital' => 'RS Sehat Bersama',
                'revokedAt' => Carbon::now()->subDays(18)->format('d M Y'),
                'reason' => 'Perawatan selesai',
            ],
            [
                'hospital' => 'Klinik Pratama Mentari',
                'revokedAt' => Carbon::now()->subMonths(2)->format('d M Y'),
                'reason' => 'Akses darurat berakhir',
            ],
        ];

        return view('mdt.patient-dashboard', [
            'walletAddress' => $walletAddress,
            'medicalHistory' => $medicalHistory,
            'activeAccesses' => $activeAccesses,
            'revokedAccesses' => $revokedAccesses,
        ]);
    }
}
