<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Job;

class JobFactory extends Factory
{
    protected $model = Job::class;
    
    public function definition(): array
    {
        // Data realistis untuk job titles
        $jobTitles = [
            'Full Stack Developer',
            'Frontend Developer',
            'Backend Developer',
            'Mobile Developer (Flutter)',
            'Mobile Developer (React Native)',
            'DevOps Engineer',
            'UI/UX Designer',
            'Product Designer',
            'Data Analyst',
            'Data Scientist',
            'Software Engineer',
            'QA Engineer',
            'Project Manager',
            'Business Analyst',
            'Digital Marketing Specialist',
            'Content Writer',
            'System Administrator',
            'Database Administrator',
            'Cloud Engineer',
            'Machine Learning Engineer',
        ];

        // Companies - simpan di variable
        $companyName = fake()->randomElement([
            'Tech Innovators Indonesia',
            'Digital Solutions Corp',
            'Startup Hub Jakarta',
            'Cloud Systems Ltd',
            'Data Analytics Pro',
            'Mobile Apps Studio',
            'Web Agency Premium',
            'E-Commerce Giant',
            'FinTech Solutions',
            'EdTech Platform',
            'HealthTech Innovations',
            'Gaming Studio Indonesia',
            'AI Research Lab',
            'Cyber Security Firm',
            'Blockchain Ventures',
            'Software House Indo',
            'Creative Digital Agency',
            'Smart Technology',
            'Innovation Labs',
            'Future Tech Solutions',
        ]);

        // Locations Indonesia
        $locations = [
            'Jakarta',
            'Bandung',
            'Surabaya',
            'Yogyakarta',
            'Bali',
            'Semarang',
            'Medan',
            'Makassar',
            'Tangerang',
            'Depok',
            'Bekasi',
            'Malang',
            'Solo',
            'Batam',
            'Balikpapan',
        ];

        // Employment Types
        $employmentTypes = [
            'Full Time',
            'Part Time',
            'Internship',
            'Contract',
            'Freelance',
        ];

        // ✅ Generate logo URL menggunakan UI Avatars
        $logoUrl = $this->generateCompanyLogo($companyName);

        return [
            'title' => fake()->randomElement($jobTitles),
            'company_name' => $companyName,
            'company_logo' => $logoUrl, // 70% ada logo
            'description' => $this->generateJobDescription(),
            'requirements' => $this->generateRequirements(),
            'location' => fake()->randomElement($locations) . ', Indonesia',
            'employment_type' => fake()->randomElement($employmentTypes),
            'apply_link' => fake()->url(),
            'deadline' => fake()->dateTimeBetween('+1 week', '+2 months'),
        ];
    }

    /**
     * ✅ Generate company logo URL menggunakan UI Avatars API
     */
    protected function generateCompanyLogo(string $companyName): string
    {
        // Encode company name untuk URL
        $name = urlencode($companyName);
        
        // Random background colors (hex tanpa #)
        $colors = [
            '4F46E5', // Indigo
            '059669', // Green
            'DC2626', // Red
            '7C3AED', // Purple
            'F59E0B', // Amber
            '06B6D4', // Cyan
            'EC4899', // Pink
            '8B5CF6', // Violet
            '10B981', // Emerald
            'EF4444', // Red
            '3B82F6', // Blue
            '14B8A6', // Teal
            'F97316', // Orange
            'A855F7', // Purple
            '6366F1', // Indigo
        ];
        
        $bgColor = fake()->randomElement($colors);
        
        // ✅ Build UI Avatars URL dengan parameter lengkap
        $params = [
            'name' => $name,
            'size' => '200',              // Ukuran 200x200
            'background' => $bgColor,     // Warna background
            'color' => 'fff',             // Warna text putih
            'bold' => 'true',             // Text bold
            'rounded' => 'true',          // Rounded corners (seperti logo modern)
            'font-size' => '0.45',        // Ukuran font (0.45 = 45% dari canvas)
            'length' => '2',              // Jumlah karakter (2 huruf)
            'uppercase' => 'true',        // Uppercase
        ];
        
        $queryString = http_build_query($params);
        
        return "https://ui-avatars.com/api/?{$queryString}";
    }

    /**
     * Generate realistic job description
     */
    protected function generateJobDescription(): string
    {
        $descriptions = [
            "Kami adalah perusahaan teknologi yang sedang berkembang pesat dan mencari talenta terbaik untuk bergabung dengan tim kami. Posisi ini akan bertanggung jawab untuk mengembangkan dan maintain aplikasi yang berkualitas tinggi.",
            
            "Join our dynamic team and be part of our innovative projects. Kami mencari kandidat yang passionate di bidang teknologi dan siap menghadapi tantangan baru setiap hari.",
            
            "Perusahaan kami bergerak di bidang teknologi informasi dan sedang membuka kesempatan untuk individu yang talented dan berdedikasi. Anda akan bekerja dengan tim profesional dan mendapatkan pengalaman berharga.",
            
            "Bergabunglah dengan kami untuk mengembangkan solusi teknologi yang impactful. Kami menawarkan lingkungan kerja yang supportive dan kesempatan untuk berkembang.",
            
            "Sebagai bagian dari tim kami, Anda akan berkontribusi dalam proyek-proyek yang innovative dan challenging. Kami mencari individu yang proaktif dan memiliki passion tinggi di bidang teknologi.",
        ];

        return fake()->randomElement($descriptions) . "\n\n" .
               "Tanggung Jawab:\n" .
               "• Mengembangkan dan maintain aplikasi sesuai kebutuhan\n" .
               "• Berkolaborasi dengan tim untuk menghasilkan solusi terbaik\n" .
               "• Melakukan code review dan testing\n" .
               "• Dokumentasi teknis proyek\n" .
               "• Participate in agile development process\n\n" .
               "Benefit:\n" .
               "• Gaji kompetitif sesuai pengalaman\n" .
               "• BPJS Kesehatan & Ketenagakerjaan\n" .
               "• Flexible working hours\n" .
               "• Work from home options\n" .
               "• Training & development opportunities\n" .
               "• Annual team building & company trip";
    }

    /**
     * Generate realistic requirements
     */
    protected function generateRequirements(): string
    {
        $educationLevel = fake()->randomElement(['D3', 'S1', 'S1/S2']);
        $experience = fake()->numberBetween(1, 5);
        
        $techSkills = [
            ['PHP', 'Laravel', 'MySQL', 'Git', 'REST API'],
            ['JavaScript', 'React', 'Node.js', 'MongoDB', 'Express'],
            ['Python', 'Django', 'PostgreSQL', 'REST API', 'Docker'],
            ['Flutter', 'Dart', 'Firebase', 'Mobile Development', 'Git'],
            ['Java', 'Spring Boot', 'Microservices', 'Docker', 'Kubernetes'],
            ['Vue.js', 'TypeScript', 'Tailwind CSS', 'Responsive Design', 'Git'],
            ['React Native', 'TypeScript', 'Redux', 'Mobile Development', 'Firebase'],
            ['Angular', 'TypeScript', 'RxJS', 'Material Design', 'REST API'],
        ];

        $selectedSkills = fake()->randomElement($techSkills);
        
        $requirements = "Kualifikasi:\n";
        $requirements .= "• Minimal pendidikan {$educationLevel} jurusan Teknik Informatika/Sistem Informasi atau terkait\n";
        $requirements .= "• Pengalaman minimal {$experience} tahun di bidang yang sama\n";
        $requirements .= "• Menguasai " . implode(', ', $selectedSkills) . "\n";
        $requirements .= "• Mampu bekerja dalam tim maupun individu\n";
        $requirements .= "• Komunikasi yang baik dalam Bahasa Indonesia dan Inggris\n";
        $requirements .= "• Problem solving dan analytical thinking yang kuat\n";
        $requirements .= "• Attention to detail dan commitment terhadap kualitas\n";
        
        $bonusSkills = [
            "• Memiliki portfolio project atau GitHub aktif (nilai plus)",
            "• Pengalaman dengan Agile/Scrum methodology (nilai plus)",
            "• Bersedia untuk bekerja on-site/remote/hybrid",
            "• Fast learner dan adaptif dengan teknologi baru",
            "• Memiliki sertifikasi terkait (nilai plus)",
            "• Pengalaman memimpin tim kecil (nilai plus)",
        ];
        
        $requirements .= "\n" . fake()->randomElements($bonusSkills, 2, true)[0];
        $requirements .= "\n" . fake()->randomElements($bonusSkills, 2, true)[1];
        
        return $requirements;
    }

    /**
     * Job untuk Full Time
     */
    public function fullTime(): static
    {
        return $this->state(fn (array $attributes) => [
            'employment_type' => 'Full Time',
        ]);
    }

    /**
     * Job untuk Internship
     */
    public function internship(): static
    {
        return $this->state(fn (array $attributes) => [
            'employment_type' => 'Internship',
            'title' => fake()->randomElement([
                'Intern Full Stack Developer',
                'Intern Frontend Developer',
                'Intern Backend Developer',
                'Intern UI/UX Designer',
                'Intern Data Analyst',
                'Intern Mobile Developer',
                'Intern DevOps Engineer',
                'Intern Quality Assurance',
            ]),
        ]);
    }

    /**
     * Job untuk Part Time
     */
    public function partTime(): static
    {
        return $this->state(fn (array $attributes) => [
            'employment_type' => 'Part Time',
        ]);
    }

    /**
     * Job untuk Freelance
     */
    public function freelance(): static
    {
        return $this->state(fn (array $attributes) => [
            'employment_type' => 'Freelance',
        ]);
    }

    /**
     * Job dengan deadline urgent (kurang dari 2 minggu)
     */
    public function urgent(): static
    {
        return $this->state(fn (array $attributes) => [
            'deadline' => fake()->dateTimeBetween('now', '+2 weeks'),
        ]);
    }

    /**
     * Job dengan lokasi remote
     */
    public function remote(): static
    {
        return $this->state(fn (array $attributes) => [
            'location' => 'Remote - Indonesia',
        ]);
    }

    }